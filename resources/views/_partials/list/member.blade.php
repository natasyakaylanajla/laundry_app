<div class="list">
    @forelse($members as $member)
        <div class="list-item">
            <div class="list-content">
                <h4 class="list-title">{{ $member->nama }} <span class="badge badge-info">{{ $member->jenis_kelamin }}</span></h4>
                <span class="list-subtitle">{{ $member->tlp }}</span>
                <p class="list-subtitle">{{ $member->alamat }}</p>
            </div>
            <div class="list-append">
                <form action="{{ route('handleCreateTransaction', ['member' => $member->id]) }}" method="post" class="mr-2">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Buat pesanan</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>