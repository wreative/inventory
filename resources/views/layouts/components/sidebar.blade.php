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
            <li class="{{ Request::route()->getName() == 'reports.index' ? 'active' : (
                Request::route()->getName() == 'reports.create' ? 'active' : '') }}">
                <a href="{{ route('reports.index') }}" class="nav-link"><i
                        class="fas fa-file-contract"></i><span>{{ __('Pengumpulan') }}</span></a>
            </li>
            @if (Auth::user()->roles == 2)
            <li class="menu-header">{{ __('Master') }}</li>
            <li class="{{ Request::route()->getName() == 'user.index' ? 'active' : (
                Request::route()->getName() == 'user.create' ? 'active' : (
                    Request::route()->getName() == 'user.edit' ? 'active' : '')) }}">
                <a href="{{ route('user.index') }}" class="nav-link"><i
                        class="fas fa-users"></i><span>{{ __('Karyawan') }}</span></a>
            </li>
            <li class="{{ Request::route()->getName() == 'division.index' ? 'active' : (
                Request::route()->getName() == 'division.create' ? 'active' : '') }}">
                <a href="{{ route('division.index') }}" class="nav-link"><i
                        class="fas fa-user-tag"></i><span>{{ __('Divisi') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Karyawan') }}</li>
            <li class="{{ Request::route()->getName() == 'reports-employee.index' ? 'active' : '' }}">
                <a href="{{ route('reports-employee.index') }}" class="nav-link"><i
                        class="fas fa-users"></i><span>{{ __('Pengumpulan') }}</span></a>
            </li>
            @endif
        </ul>
    </aside>
</div>