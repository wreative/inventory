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
            {{-- @if (Auth::user()->roles == 2 or Auth::user()->roles == 6 or Auth::user()->roles == 1) --}}
            {{-- <li class="{{ Request::route()->getName() == 'production.index' ? 'active' : (
                Request::route()->getName() == 'production.create' ? 'active' : (
                    Request::route()->getName() == 'production.edit' ? 'active' : (
                        Request::route()->getName() == 'production.show' ? 'active' : ''))) }}">
            <a class="nav-link" href="{{ route('production.index') }}"><i class="fas fa-users"></i>
                <span>{{ __('Alat Produksi') }}</span></a>
            </li> --}}
            <li class="nav-item dropdown">
                <a href="{{ route('production.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>{{ __('Alat Produksi') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('production.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('production.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('production.approv') }}">{{ __('Persetujuan') }}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('equipment.index') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>{{ __('Perlengkapan') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('equipment.index') }}">{{ __('Daftar') }}</a></li>
                    <li><a class="nav-link" href="{{ route('equipment.create') }}">{{ __('Tambah') }}</a></li>
                    <li><a class="nav-link" href="{{ route('equipment.approv') }}">{{ __('Persetujuan') }}</a></li>
                </ul>
            </li>
            <li class="{{ Request::route()->getName() == 'workshop.index' ? 'active' : (
                Request::route()->getName() == 'workshop.create' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('workshop.index') }}"><i class="fas fa-archive"></i>
                    <span>{{ __('Persewaan Gedung') }}</span></a>
            </li>
            <li class="{{ Request::route()->getName() == 'class.index' ? 'active' : (
                Request::route()->getName() == 'class.create' ? 'active' : (
                    Request::route()->getName() == 'class.edit' ? 'active' : '')) }}">
                <a class="nav-link" href="{{ route('class.index') }}"><i class="fas fa-chalkboard-teacher"></i>
                    <span>{{ __('Kendaraan') }}</span></a>
            </li>
        </ul>
    </aside>
</div>