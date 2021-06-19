@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Persewaan Gedung'))
@section('titleContent', __('Persewaan Gedung'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
@endsection

@section('content')
@if(Session::has('status'))
<div class="alert alert-info alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ Session::get('status') }}
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'rental.index' ? 'active' : '' }}"
                            href="{{ route('rental.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'rental.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'rental.deny' ? 'active' : '' }}"
                            href="{{ route('rental.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'rental.deny' ? 'white' : 'primary' }}">
                                {{ $dtotal }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <table class="table-striped table" id="tables" width="100%">
        <thead>
            <tr>
                <th class="text-center">
                    {{ __('NO') }}
                </th>
                <th class="text-center">
                    {{ __('Kode') }}
                </th>
                <th>{{ __('Nama Gedung') }}</th>
                <th>{{ __('Pembayaran') }}</th>
                <th>{{ __('Status Gedung') }}</th>
                <th>{{ __('Jatuh Tempo') }}</th>
                <th>{{ __('No PBB') }}</th>
                <th>{{ __('No PLN') }}</th>
                <th>{{ __('No PDAM') }}</th>
                <th>{{ __('No Wifi') }}</th>
                <th>{{ __('Alamat') }}</th>
                <th>{{ __('Info') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rental as $number => $r)
            <tr>
                <td class="text-center">
                    {{ $number+1 }}
                </td>
                <td class="text-center">
                    {{ $r->code }}
                </td>
                <td>
                    {{ $r->name }}
                </td>
                <td>
                    {{ $r->address }}
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $r->rental }}
                    </span>
                </td>
                <td>
                    {{ $r->pbb }}
                </td>
                <td>
                    {{ $r->pln }}
                </td>
                <td>
                    {{ $r->pdam }}
                </td>
                <td>
                    {{ $r->wifi }}
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $r->status }}
                    </span>
                </td>
                <td>
                    {{ date("m-Y", strtotime($r->due)) }}
                </td>
                <td>
                    {{ $r->info }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    <table class="table-striped table" id="tables" width="100%">
        <thead>
            <tr>
                <th class="text-center">
                    {{ __('NO') }}
                </th>
                <th class="text-center">
                    {{ __('Kode') }}
                </th>
                <th>{{ __('Nama Gedung') }}</th> P
                <th>{{ __('Alamat') }}</th>
                <th>{{ __('Pembayaran') }}</th> P
                <th>{{ __('No PBB') }}</th> P
                <th>{{ __('No PLN') }}</th>
                <th>{{ __('No PDAM') }}</th>
                <th>{{ __('No Wifi') }}</th>
                <th>{{ __('Status Gedung') }}</th> P
                <th>{{ __('Jatuh Tempo') }}</th> P
                <th>{{ __('Info') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rental as $number => $r)
            <tr>
                <td class="text-center">
                    {{ $number+1 }}
                </td>
                <td class="text-center">
                    {{ $r->code }}
                </td>
                <td>
                    {{ $r->name }}
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $r->rental }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $r->status }}
                    </span>
                </td>
                <td>
                    {{ date("m-Y", strtotime($r->due)) }}
                </td>
                <td>
                    {{ $r->pbb }}
                </td>
                <td>
                    {{ $r->pln }}
                </td>
                <td>
                    {{ $r->pdam }}
                </td>
                <td>
                    {{ $r->wifi }}
                </td>
                <td>
                    {{ $r->address }}
                </td>
                <td>
                    {{ $r->info }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection