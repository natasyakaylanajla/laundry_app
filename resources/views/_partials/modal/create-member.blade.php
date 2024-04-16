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
                
                <form action="{{ route('handleCreateMember') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="nama" type="text" class="form-control" placeholder="Masukkan nama member">
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Masukkan alamat member"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="jenis_kelamin" class="form-control">
                            @foreach ([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ] as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="tlp" type="tel" class="form-control" placeholder="Masukkan nomor telepon member">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Tambah</button>
                </form>
            
            </div>
        </div>
    </div>
</div>