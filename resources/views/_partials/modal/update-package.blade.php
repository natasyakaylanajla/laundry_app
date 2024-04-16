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
                
                <form action="{{ route('handleUpdatePackage', ['package' => $packageId]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="nama_paket" type="text" class="form-control" placeholder="Masukkan nama paket" value="{{ $defaultValues['nama_paket'] }}">
                    </div>
                    <div class="form-group">
                        <select name="jenis" class="form-control">
                            @foreach ([
                                'kiloan' => 'Kiloan',
                                'selimut' => 'Selimut',
                                'bed_cover' => 'Bed Cover',
                                'kaos' => 'Kaos',
                                'lain' => 'Lain',
                            ] as $value => $label)
                                <option value="{{ $value }}" @if($defaultValues['jenis'] == $value) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="harga" type="number" class="form-control" placeholder="Masukkan harga paket" value="{{ $defaultValues['harga'] }}">
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Ubah</button>
                </form>
            
            </div>
        </div>
    </div>
</div>