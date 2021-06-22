<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == $index ? 'active' : '' }}"
                            href="{{ route($index) }}">{{ __('Semua') }}
                            <span class="badge badge-{{ Request::route()->getName() == $index ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == $deny ? 'active' : '' }}"
                            href="{{ route($deny) }}">{{ __('Ditolak') }}
                            <span class="badge badge-{{ Request::route()->getName() == $deny ? 'white' : 'primary' }}">
                                {{ $dtotal }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>