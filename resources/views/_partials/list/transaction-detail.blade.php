<div class="list">
    @forelse($transactionDetails as $transactionDetail)
        @if ($transaction->dibayar == 'dibayar')
            <div class="list-item">
                <div class="list-content">
                    <h4 class="list-title">{{ $transactionDetail->package->nama_paket }} - {{ number_format($transactionDetail->package->harga) }}</h4>
                    <p class="list-subtitle">{{ $transactionDetail->keterangan }}</p>
                </div>
                <div class="list-append">
                    <span class="badge badge-info" style="font-size: 1.2rem;">{{ $transactionDetail->qty }}</span>
                </div>
            </div>
        @else
            <div class="list-item align-items-start">
                <div class="list-content">
                    <form action="{{ route('handleUpdateTransactionDetail', ['transactionDetail' => $transactionDetail->id]) }}" method="post" class="w-100">
                        @csrf
                        <h4 class="list-title mb-3">{{ $transactionDetail->package->nama_paket }} - {{ number_format($transactionDetail->package->harga) }}</h4>
                        <div class="form-group">
                            <input name="qty" min="1" type="number" class="form-control" style="width: 5rem" value="{{ $transactionDetail->qty }}">
                        </div>
                        <div class="form-group">
                            <textarea name="keterangan" cols="30" rows="2" class="form-control" placeholder="Masukkan keterangan">{{ $transactionDetail->keterangan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Ubah</button>
                    </form>
                </div>
                <div class="list-append">
                    <form action="{{ route('handleDeleteTransactionDetail', ['transactionDetail' => $transactionDetail->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endif
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>