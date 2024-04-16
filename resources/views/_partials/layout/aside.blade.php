@php
    $userRole = Auth::user()->role
@endphp
<aside class="main-sidebar elevation-4">
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (in_array($userRole, ['admin', 'kasir', 'owner']))
                    <li class="nav-item">
                        <a href="{{ route('viewReport') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
                @if (in_array($userRole, ['admin', 'kasir']))
                    <li class="nav-item">
                        <a href="{{ route('viewTransaction') }}" class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                @endif
                @if (in_array($userRole, ['admin']))
                    <li class="nav-item">
                        <a href="{{ route('viewOutlet') }}" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Konfigurasi</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
