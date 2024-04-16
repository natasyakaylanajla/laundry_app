<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private static function calculatedTransaction($times)
    {
        $outlet = Auth::user()->outlet;

        $transactions = $outlet->transaction()
            ->whereBetween('created_at', [$times['start'], $times['end']])
            ->whereIn('status', ['selesai', 'diambil'])
            ->where('dibayar', 'dibayar')
            ->with(['member', 'transactionDetail', 'transactionDetail.package'])
            ->get();

        $transactions = Helpers::injectCalculatedTransaction($transactions);

        return $transactions;
    }

    private static function calculatedMember($times)
    {
        $outlet = Auth::user()->outlet;

        $members = $outlet->member()
            ->whereBetween('created_at', [$times['start'], $times['end']])
            ->get();

        return $members;
    }

    private static function getTimesParameter(Request $request) {
        if ($request->start && $request->end) {
            $times = [
                'start' => Carbon::parse($request->start)->toDateString(),
                'end' => Carbon::parse($request->end)->toDateString(),
            ];
        } else {
            $times = [
                'start' => Carbon::now()->subDays(10)->toDateString(),
                'end' => Carbon::now()->addDays(1)->toDateString(),
            ];
        }

        return $times;
    }

    public function viewReport(Request $request)
    {
        $times = self::getTimesParameter($request);
        $transactions = self::calculatedTransaction($times);
        $members = self::calculatedMember($times);

        return view('dashboard.report.index', [
            'transactions' => $transactions,
            'members' => $members,
            'times' => $times,
        ]);
    }

    public function handlePrintMember(Request $request)
    {
        $times = self::getTimesParameter($request);
        $members = self::calculatedMember($times);

        return view('report.member', [
            'times' => $times,
            'members' => $members,
        ]);
    }

    public function handlePrintTransaction(Request $request)
    {
        $times = self::getTimesParameter($request);
        $transactions = self::calculatedTransaction($times);

        $summary = [
            'total_pesanan' => 0,
            'subtotal' => 0,
            'biaya_tambahan' => 0,
            'pajak' => 0,
            'diskon' => 0,
            'total' => 0,
        ];

        foreach ($transactions as $transaction) {
            $summary['total_pesanan'] += count($transaction->transactionDetail);
            $summary['subtotal'] += $transaction->subtotal;
            $summary['biaya_tambahan'] += $transaction->biaya_tambahan;
            $summary['pajak'] += $transaction->pajak;
            $summary['diskon'] += $transaction->diskon;
            $summary['total'] += $transaction->total;
        }

        return view('report.transaction', [
            'times' => $times,
            'transactions' => $transactions,
            'summary' => $summary,
        ]);
    }
}
