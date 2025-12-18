<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingShowRequest;
use App\Http\Requests\CustomerInformationStoreRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private TransactionRepositoryInterface $TransactionRepository;

     public function __construct(

         TransactionRepositoryInterface $TransactionRepository,
         BoardingHouseRepositoryInterface $boardingHouseRepository
     )
     {
        $this->TransactionRepository = $TransactionRepository;
        $this->boardingHouseRepository  = $boardingHouseRepository;
     }

    public function booking(Request $request, $slug){
        $this->TransactionRepository->saveDataTransactionToSession($request->all());

        return redirect()->route('booking.information', $slug);
    }

    public function check(){
        return view('pages.booking.check-booking');
    }

    public function information($slug){
        $transaction = $this->TransactionRepository->getDataTransactionFromSession();
        if (!$transaction || !isset($transaction['room_id'])) {
        return redirect()->route('kos.rooms', $slug)
               ->with('error', 'Pilih kamar terlebih dahulu sebelum melanjutkan pemesanan.');
    }
        $boardingHouse =$this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);


        return view('pages.booking.information', compact('transaction', 'boardingHouse', 'room'));
    }

    public function saveInformation(CustomerInformationStoreRequest $request, $slug)
    {
         $data =$request->validated();

         $this->TransactionRepository->saveDataTransactionToSession($data);

         return redirect()->route('booking.checkout', $slug);
    }

    public function checkout($slug){
        $transaction = $this->TransactionRepository->getDataTransactionFromSession();
        $boardingHouse =$this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);

         return view('pages.booking.checkout', compact('transaction', 'boardingHouse', 'room'));
    }

    public function payment(Request $request){
        $this->TransactionRepository->saveDataTransactionToSession($request->all());

        $transaction = $this->TransactionRepository->saveTransaction($this->TransactionRepository->getDataTransactionFromSession());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
         // Set sanitization on (default)
         \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
         // Set 3DS transaction for credit card to true
         \Midtrans\Config::$is3ds = config('midtrans.is3ds');

         // Generate finish URL dengan ngrok bypass parameter
         $finishUrl = url('/booking-success?order_id=' . $transaction->code . '&ngrok-skip-browser-warning=true');
         
         $params = [
            'transaction_details'=> [
                'order_id'=> $transaction->code,
                'gross_amount'=>$transaction->total_amount,
            ],
             'customer_details'=> [
                'first_name'=> $transaction->name,
                'email'=> $transaction->email,
                'phone'=> $transaction->phone_number,
             ],
             'callbacks' => [
                'finish' => $finishUrl,
             ]
        ];

        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        return redirect($paymentUrl);
    }

    public function success(Request $request){

        $transaction = $this->TransactionRepository->getTransactionByCode($request->order_id);

        if(!$transaction){
            return redirect()->route('home');
        }

        return view('pages.booking.success', compact('transaction'));
    }

    public function show(BookingShowRequest $request){
         $transaction = $this->TransactionRepository->getTransactionByCodeEmailPhone($request->code, $request->email, $request->phone_number);

         if(!$transaction){
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan');
         }
         return view('pages.booking.detail', compact('transaction'));
    }
}
