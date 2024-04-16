<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <h4 class="w-100 mb-0">{{ Auth::user()->outlet->nama }}</h4>
    <form action="{{ route('handleLogout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Keluar</button>
    </form>
</nav>