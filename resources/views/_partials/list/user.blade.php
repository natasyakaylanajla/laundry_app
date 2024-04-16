<div class="list">
    @forelse($users as $user)
        <div class="list-item">
            @php($updateModalId = 'update-user-modal-' . $user->id)
            <div class="list-content">
                <h4 class="list-title">{{ $user->nama }}</h4>
                <span class="list-subtitle">{{ $user->username }}</span>
            </div>
            <div class="list-append">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $updateModalId }}">Ubah</button>
                @if($user->id != Auth::user()->id)
                    <form action="{{ route('handleDeleteUser', ['user' => $user->id]) }}" method="post" class="ml-2" onsubmit="return confirm('Yakin ingin menghapus pengguna ini')">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                @endif
            </div>
            @include('_partials.modal.update-user', [
                'modalId' => $updateModalId,
                'modalTitle' => 'Ubah data paket',
                'userId' => $user->id,
                'defaultValues' => [
                    'nama' => $user->nama,
                    'username' => $user->username,
                ]
            ])
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>