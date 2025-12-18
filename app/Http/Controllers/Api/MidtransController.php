<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class MidtransController extends Controller
{
    public function callback(Request $request){

        Log::info('Midtrans Callback received', $request->all());


        $serverKey = config('midtrans.serverKey');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if($hashedKey !== $request->signature_key){
            return response()-> json(['message'=> 'Invalid Signature Key'], 403);
        }



        $orderId = $request->order_id;
        $transaction = Transaction::where('code', $orderId)->first();

        if(!$transaction){
            return response()-> json(['message'=> 'Transaction Not Found'], 404);
        }
        $transactionStatus = $request->transaction_status;


        $transaction->load('boardingHouse');

        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);


        $message =
            "Halo, " .$transaction->name . "!" .PHP_EOL . PHP_EOL .
            "Kami telah menerima pembayaran Anda dengan kode booking: " . $transaction->code . "." . PHP_EOL .
            "Total pembayaran: Rp " . number_format($transaction->total_amount, 0, ',', '.') . "." . PHP_EOL . PHP_EOL .
            "Anda bisa datang ke kos: " . $transaction->boardingHouse->name. PHP_EOL .
            "Alamat: " . $transaction->boardingHouse->address . PHP_EOL .
            "Mulai Tanggal: ". date('d M Y', strtotime($transaction->start_date)) . PHP_EOL . PHP_EOL .
            "Terima kasih atas kepercayaan Anda! " . PHP_EOL .
            "Kami Tunggu Kedatangan Anda";

        switch($transactionStatus){
            case 'capture' :
                if($request->payment_type == 'credit_card'){
                    if($request->fraud_status == 'challenge'){
                        $transaction->update(['payment_status'=> 'pending']);
                    } else {
                        $transaction->update(['payment_status' => 'success']);
                    }
                }
            break;
            case 'settlement' :
                $transaction->update(['payment_status' => 'success']);

                $phoneNumber = $transaction->phone_number;
                if (!str_starts_with($phoneNumber, '+')) {
                    $phoneNumber = '+62' . ltrim($phoneNumber, '0');
                }

                Log::info('Sending WhatsApp notification', [
                    'original_phone' => $transaction->phone_number,
                    'formatted_phone' => $phoneNumber,
                    'transaction_code' => $transaction->code
                ]);

                try {
                    $result = $twilio->messages->create(
                        "whatsapp:" . $phoneNumber,
                        [
                            "from" => env('TWILIO_WHATSAPP_FROM'),
                            "body" => $message
                        ]
                    );
                    Log::info('WhatsApp sent successfully', ['twilio_sid' => $result->sid]);
                    return response()->json(['message' => 'Callback received successfully', 'twilio_sid' => $result->sid]);
                } catch (\Exception $e) {
                    Log::error('Twilio Error', [
                        'error_message' => $e->getMessage(),
                        'error_code' => $e->getCode(),
                        'phone_number' => $phoneNumber
                    ]);
                    return response()->json(['message' => 'Callback received, but WhatsApp failed', 'error' => $e->getMessage()], 500);
                }
                break;
            case 'pending' :
                $transaction->update(['payment_status'=> 'pending']);
                break;
            case 'deny' :
                $transaction->update(['payment_status'=> 'failed']);
                break;
            case 'expire' :
                $transaction->update(['payment_status'=> 'expired']);
                break;
            case 'cancel':
                $transaction->update(['payment_status'=> 'canceled']);
                break;
            default :
              $transaction->update(['payment_status'=> 'unknown']);
              break;
        }
        return response()->json(['message'=> 'Callback received successfully']);

    }
}
