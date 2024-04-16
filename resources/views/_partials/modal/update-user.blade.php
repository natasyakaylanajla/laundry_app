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
                
                <form action="{{ route('handleUpdateUser', ['user' => $userId]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="nama" type="text" class="form-control" placeholder="Masukkan nama pengguna" value="{{ $defaultValues['nama'] }}">
                    </div>
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Masukkan username pengguna" value="{{ $defaultValues['username'] }}">
                    </div>
                    <div class="form-group">
                        <input name="password" type="text" class="form-control" placeholder="Masukkan password pengguna">
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Ubah</button>
                </form>
            
            </div>
        </div>
    </div>
</div>