<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function viewTransaction(Request $request)
    {
        $memberSearchQuery = $request->search_member;
        
        $members = Auth::user()->outlet->member()->orderBy('id', 'DESC');

        if ($memberSearchQuery) {
            $members = $members->where('nama', 'LIKE', "%{$memberSearchQuery}%");
        }

        $members = $members->limit(6)->get();

        $transactions = Auth::user()->outlet->transaction()->with('member', 'transactionDetail', 'transactionDetail.package')->orderBy('id', 'DESC')->paginate(10);

        $transactions = Helpers::injectCalculatedTransaction($transactions);

        return view('dashboard.transaction.index', [
            'members' => $members,
            'transactions' => $transactions,
        ]);
    }

    public function handleCreate(Member $member)
    {
        $transaction = Auth::user()->outlet->transaction()->create([
            'kode_invoice' => Str::uuid(),
            'id_member' => $member->id,
            'id_user' => Auth::user()->id,
            'batas_waktu' => Carbon::now()->addDay(5),
            'biaya_tambahan' => 0,
            'diskon' => 0,
            'pajak' => 0,
            'status' => 'baru',
            'dibayar' => 'belum_dibayar',
        ]);

        return redirect()->route('viewTransactionDetail', [
            'invoiceCode' => $transaction->kode_invoice,
        ]);
    }

    public function handleUpdate(Transaction $transaction, Request $request)
    {
        $reqData = $request->validate([
            'pajak' => 'required|integer|min:0',
            'biaya_tambahan' => 'required|integer|min:0',
            'diskon' => 'required|integer|min:0',
            'batas_waktu' => 'required|date',
        ]);

        $transaction->update($reqData);

        return back();
    }

    public function handleDelete(Transaction $transaction)
    {
        $transaction->delete();

        return back();
    }

    public function handlePayment(Transaction $transaction)
    {
        $transaction->update([
            'dibayar' => 'dibayar',
            'tgl_bayar' => Carbon::now(),
        ]);

        return back();
    }

    public function handleProcess(Transaction $transaction)
    {
        $nextStatus = Helpers::getNextStatus($transaction->status);

        $transaction->update([
            'status' => $nextStatus,
        ]);

        return back();
    }
}
