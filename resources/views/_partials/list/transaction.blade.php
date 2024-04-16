<div class="list">
    @forelse($transactions as $transaction)
        <div class="list-item">
            <div class="list-content">
                <h4 class="list-title">
                    {{ $transaction->member->nama }}
                    <span class="badge badge-primary">
                        {{ [
                            'baru' => 'Baru',
                            'proses' => 'Proses',
                            'selesai' => 'Selesai',
                            'diambil' => 'Diambil',
                        ][$transaction->status] }}
                    </span>
                </h4>
                <span class="list-subtitle">
                    {{ count($transaction->transactionDetail) }} Pesanan - {{ number_format($transaction->total) }}
                    <span class="badge badge-info">
                        {{ [
                            'dibayar' => 'Dibayar',
                            'belum_dibayar' => 'Belum dibayar',
                        ][$transaction->dibayar] }}
                    </span>
                </span>
            </div>
            <div class="list-append">
                <a href="{{ route('viewTransactionDetail', ['invoiceCode' => $transaction->kode_invoice])}}" class="btn btn-info btn-sm">Ubah</a>
            </div>
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>