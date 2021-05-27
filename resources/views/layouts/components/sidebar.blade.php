<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ __('pages.title') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">{{ __('pages.brand') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Menu Utama') }}</li>
            <li class="{{ Request::route()->getName() == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Data') }}</li>
            <li class="nav-item dropdown">
                <a href="{{ route('production.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-tools"></i>
                    <span>{{ __('Alat Produksi') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('production.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('production.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('production.approv') }}">{{ __('Persetujuan') }}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('equipment.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-toolbox"></i>
                    <span>{{ __('Perlengkapan') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('equipment.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('equipment.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('equipment.approv') }}">{{ __('Persetujuan') }}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('rental.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-building"></i>
                    <span>{{ __('Persewaan Gedung') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('rental.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('rental.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('rental.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('vehicle.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-truck"></i>
                    <span>{{ __('Kendaraan') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('vehicle.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('vehicle.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('vehicle.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->roles == 1)
            <li class="{{ Request::route()->getName() == 'users.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i>
                    <span>{{ __('Pengguna') }}</span></a>
            </li>
            @endif
        </ul>
    </aside>
</div>