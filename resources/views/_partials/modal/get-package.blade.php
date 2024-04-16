<div class="modal fade" id="{{ $modalId }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $modalTitle }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="list">
                    @forelse ($packages as $package)
                        <div class="list-item">
                            <div class="list-content">
                                <h4 class="list-title">
                                    {{ $package->nama_paket }}
                                    <span class="badge badge-info">
                                        {{ [
                                            'kiloan' => 'Kiloan',
                                            'selimut' => 'Selimut',
                                            'bed_cover' => 'Bed Cover',
                                            'kaos' => 'Kaos',
                                            'lain' => 'Lain',
                                        ][$package->jenis] }}
                                    </span>
                                </h4>
                                <span class="list-subtitle">{{ number_format($package->harga) }}</span>
                            </div>
                            <div class="list-append">
                                <form action="{{ route('handleCreateTransactionDetail', ['transaction' => $transactionId]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_paket" value="{{ $package->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Pilih</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>