<div class="list">
    @forelse($packages as $package)
        <div class="list-item">
            @php($updateModalId = 'update-package-modal-' . $package->id)
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
                <button class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#{{ $updateModalId }}">Ubah</button>
                <form action="{{ route('handleDeletePackage', ['package' => $package->id]) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus paket ini')">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
            @include('_partials.modal.update-package', [
                'modalId' => $updateModalId,
                'modalTitle' => 'Ubah data paket',
                'packageId' => $package->id,
                'defaultValues' => [
                    'nama_paket' => $package->nama_paket,
                    'harga' => $package->harga,
                    'jenis' => $package->jenis,
                ]
            ])
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>