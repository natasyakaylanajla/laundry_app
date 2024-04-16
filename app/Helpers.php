<?php

namespace App;

class Helpers {
    public static function calculatedTransaction($transaction)
    {
        $tax = $transaction['pajak'];
        $addCost = $transaction['biaya_tambahan'];
        $disc = $transaction['diskon'];
        $subtotal = 0;

        foreach ($transaction['transaction_detail'] as $transactionDetail) {
            $subtotal = $transactionDetail['package']['harga'] * $transactionDetail['qty'];
        }

        $total = $subtotal + $tax + $addCost - $disc;

        return [
            'total' => $total,
            'subtotal' => $subtotal,
        ];
    }

    public static function injectCalculatedTransaction($transactions)
    {
        for ($i=0; $i < count($transactions); $i++) { 
            $calculatedTransaction = self::calculatedTransaction($transactions[$i]->toArray());

            $transactions[$i]->total = $calculatedTransaction['total'];
            $transactions[$i]->subtotal = $calculatedTransaction['subtotal'];
        }

        return $transactions;
    }

    public static function getNextStatus($currentStatus)
    {
        $status = [
            'baru',
            'proses',
            'selesai',
            'diambil',
        ];

        try {
            $statusIndex = array_search($currentStatus, $status);

            return $status[$statusIndex + 1];
        } catch (\Throwable $th) {
            return $currentStatus;
        }
    }
}