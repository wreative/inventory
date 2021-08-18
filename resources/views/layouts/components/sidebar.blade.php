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
            <li class="nav-item dropdown {{ Request::route()->getName() == 'production.index' ? 'active' : (
                Request::route()->getName() == 'production.create' ? 'active' : (
                    Request::route()->getName() == 'production.approv' ? 'active' : (
                        Request::route()->getName() == 'production.edit' ? 'active' : (
                            Request::route()->getName() == 'production.show' ? 'active' : (
                                Request::route()->getName() == 'production.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('production.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-tools"></i>
                    <span>{{ __('Alat Produksi') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'production.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('production.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'production.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('production.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'production.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('production.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'equipment.index' ? 'active' : (
                Request::route()->getName() == 'equipment.create' ? 'active' : (
                    Request::route()->getName() == 'equipment.approv' ? 'active' : (
                        Request::route()->getName() == 'equipment.edit' ? 'active' : (
                            Request::route()->getName() == 'equipment.show' ? 'active' : (
                                Request::route()->getName() == 'equipment.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('equipment.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-toolbox"></i>
                    <span>{{ __('Perlengkapan') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'equipment.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('equipment.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'equipment.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('equipment.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'equipment.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('equipment.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'rental.index' ? 'active' : (
                Request::route()->getName() == 'rental.create' ? 'active' : (
                    Request::route()->getName() == 'rental.approv' ? 'active' : (
                        Request::route()->getName() == 'rental.edit' ? 'active' : (
                            Request::route()->getName() == 'rental.show' ? 'active' : (
                                Request::route()->getName() == 'rental.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('rental.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-building"></i>
                    <span>{{ __('Gedung') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'rental.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rental.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'rental.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rental.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'rental.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rental.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'vehicle.index' ? 'active' : (
                Request::route()->getName() == 'vehicle.create' ? 'active' : (
                    Request::route()->getName() == 'vehicle.approv' ? 'active' : (
                        Request::route()->getName() == 'vehicle.edit' ? 'active' : (
                            Request::route()->getName() == 'vehicle.show' ? 'active' : (
                                Request::route()->getName() == 'vehicle.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('vehicle.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-truck"></i>
                    <span>{{ __('Kendaraan') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'vehicle.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('vehicle.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'vehicle.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('vehicle.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'vehicle.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('vehicle.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'website.index' ? 'active' : (
                Request::route()->getName() == 'website.create' ? 'active' : (
                    Request::route()->getName() == 'website.approv' ? 'active' : (
                        Request::route()->getName() == 'website.edit' ? 'active' : (
                            Request::route()->getName() == 'website.show' ? 'active' : (
                                Request::route()->getName() == 'website.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('website.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-globe"></i>
                    <span>{{ __('Website') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'website.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'website.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'website.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('website.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'device.index' ? 'active' : (
                Request::route()->getName() == 'device.create' ? 'active' : (
                    Request::route()->getName() == 'device.approv' ? 'active' : (
                        Request::route()->getName() == 'device.edit' ? 'active' : (
                            Request::route()->getName() == 'device.show' ? 'active' : (
                                Request::route()->getName() == 'device.deny' ? 'active' : ''))))) }}">
                <a href="{{ route('device.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-mobile-alt"></i>
                    <span>{{ __('Device') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'device.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('device.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'device.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('device.create') }}">{{ __('Tambah') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'device.approv' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('device.approv') }}">{{ __('Persetujuan') }}</a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->role_id == 1)
            <li class="{{ Request::route()->getName() == 'users.index' ? 'active' : (
                Request::route()->getName() == 'users.create' ? 'active' : (
                    Request::route()->getName() == 'users.edit' ? 'active' : '')) }}">
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i>
                    <span>{{ __('Pengguna') }}</span></a>
            </li>
            <li class="{{ Request::route()->getName() == 'room.index' ? 'active' : (
                Request::route()->getName() == 'room.create' ? 'active' : (
                    Request::route()->getName() == 'room.edit' ? 'active' : '')) }}">
                <a class="nav-link" href="{{ route('room.index') }}"><i class="fas fa-map-marker-alt"></i>
                    <span>{{ __('Ruangan') }}</span></a>
            </li>
            <li class="{{ Request::route()->getName() == 'division.index' ? 'active' : (
                Request::route()->getName() == 'division.create' ? 'active' : (
                    Request::route()->getName() == 'division.edit' ? 'active' : '')) }}">
                <a class="nav-link" href="{{ route('division.index') }}">
                    <i class="fas fa-user-tag"></i>
                    <span>{{ __('Divisi') }}</span>
                </a>
            </li>
            @endif
        </ul>
    </aside>
</div>