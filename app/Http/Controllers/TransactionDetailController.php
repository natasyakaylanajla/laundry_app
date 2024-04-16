<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionDetailController extends Controller
{
    public function viewTransactionDetail($invoiceCode)
    {
        $transaction = Auth::user()->outlet->transaction()->where('kode_invoice', $invoiceCode)->with('transactionDetail', 'transactionDetail.package')->first();
        $transactionDetails = $transaction->transactionDetail()->with('package')->orderBy('id', 'DESC')->get();
        $members = $transaction->member;
        $packages = Auth::user()->outlet->package()->get();

        $transaction->batas_waktu_formated = Carbon::parse($transaction->batas_waktu)->toDateTimeLocalString();

        $calculatedTransaction = Helpers::calculatedTransaction($transaction->toArray());

        $transaction->subtotal = $calculatedTransaction['subtotal'];
        $transaction->total = $calculatedTransaction['total'];
        $transaction->status_next = Helpers::getNextStatus($transaction->status);
        
        return view('dashboard.transaction.detail', [
            'members' => $members,
            'packages' => $packages,
            'transaction' => $transaction,
            'transactionDetails' => $transactionDetails,
        ]);
    }

    public function handleCreate(Transaction $transaction, Request $request)
    {
        $reqData = $request->validate([
            'id_paket' => 'required|integer|min:1'
        ]);

        $transaction->transactionDetail()->create([
            'id_paket' => $reqData['id_paket'],
            'qty' => 1,
            'keterangan' => null,
        ]);

        return back();
    }

    public function handleUpdate(TransactionDetail $transactionDetail, Request $request)
    {
        $reqData = $request->validate([
            'qty' => 'required|integer|min:1',
            'keterangan' => 'nullable',
        ]);

        $transactionDetail->update($reqData);

        return back();
    }

    public function handleDelete(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        return back();
    }
}
