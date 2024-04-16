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
                
                <form action="{{ route('handleCreatePackage') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="nama_paket" type="text" class="form-control" placeholder="Masukkan nama paket">
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
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="harga" min="1" type="number" class="form-control" placeholder="Masukkan harga paket">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Tambah</button>
                </form>
            
            </div>
        </div>
    </div>
</div>