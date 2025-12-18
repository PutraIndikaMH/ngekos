<?php

namespace App\Interfaces;


interface TransactionRepositoryInterface{
    public function getDataTransactionFromSession();
    public function saveDataTransactionToSession($data);
    public function saveTransaction($data);
    public function getTransactionByCode($code);
    public function getTransactionByCodeEmailPhone($code, $email, $phone);
}
