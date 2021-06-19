@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Alat Produksi'))
@section('titleContent', __('Alat Produksi'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
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
                        <a class="nav-link {{ Request::route()->getName() == 'production.index' ? 'active' : '' }}"
                            href="{{ route('production.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'production.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'production.deny' ? 'active' : '' }}"
                            href="{{ route('production.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'production.deny' ? 'white' : 'primary' }}">
                                {{ $dtotal }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
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
                    <th>{{ __('Nama Alat Produksi') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Info') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($production as $number => $p)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $p->code }}
                    </td>
                    <td>
                        {{ $p->name }}
                    </td>
                    <td>
                        {{ $p->brand }}
                    </td>
                    <td>
                        {{ __('Rp.').number_format($p->price_acq) }}
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($p->date_acq)) }}
                    </td>
                    <td>
                        {{ $p->qty }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $p->condition }}
                        </span>
                    </td>
                    <td>
                        {{ $p->info }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection