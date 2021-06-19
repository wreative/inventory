@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Perlengkapan'))
@section('titleContent', __('Perlengkapan'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
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
                        <a class="nav-link {{ Request::route()->getName() == 'equipment.index' ? 'active' : '' }}"
                            href="{{ route('equipment.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'equipment.index' ? 'white' : 'primary' }}">
                                5
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'equipment.deny' ? 'active' : '' }}"
                            href="{{ route('equipment.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'equipment.deny' ? 'white' : 'primary' }}">
                                1
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
                    <th>{{ __('Nama Perlengkapan') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Lokasi') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipment as $number => $e)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $e->code }}
                    </td>
                    <td>
                        {{ $e->name }}
                    </td>
                    <td>
                        {{ $e->brand }}
                    </td>
                    <td>
                        {{ __('Rp.').number_format($e->price_acq) }}
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($e->date_acq)) }}
                    </td>
                    <td>
                        {{ $e->qty }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $e->condition }}
                        </span>
                    </td>
                    <td>
                        {{ $e->location }}
                    </td>
                    <td>
                        {{ $e->info }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection