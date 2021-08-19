@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Kendaraan'))
@section('titleContent', __('Kendaraan'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Kendaraan') }}</div>
@endsection

@section('content')
@include('pages.data.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'vehicle.index' ? 'active' : '' }}"
                            href="{{ route('vehicle.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'vehicle.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'vehicle.deny' ? 'active' : '' }}"
                            href="{{ route('vehicle.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'vehicle.deny' ? 'white' : 'primary' }}">
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
                    <th>{{ __('Nama Kendaraan') }}</th>
                    <th>{{ __('Jenis') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('No Plat') }}</th>
                    <th>{{ __('No Rangkah') }}</th>
                    <th>{{ __('No Mesin') }}</th>
                    <th>{{ __('Tanggal Kir') }}</th>
                    <th>{{ __('Tanggal Pajak Tahunan') }}</th>
                    <th>{{ __('Tanggal STNK') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicle as $number => $v)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $v->code }}
                    </td>
                    <td>
                        {{ $v->name }}
                    </td>
                    <td>
                        {{ $v->type }}
                    </td>
                    <td>
                        {{ $v->brand }}
                    </td>
                    <td>
                        {{ $v->plat }}
                    </td>
                    <td>
                        {{ $v->step }}
                    </td>
                    <td>
                        {{ $v->engine }}
                    </td>
                    <td>
                        @if ($v->kir != null)
                        {{ date("d-m-Y", strtotime($v->kir)) }}
                        @else
                        {{ __('Tidak Ada') }}
                        @endif
                    </td>
                    <td>
                        @if ($v->tax != null)
                        {{ date("d-m-Y", strtotime($v->tax)) }}
                        @else
                        {{ __('Tidak Ada') }}
                        @endif
                    </td>
                    <td>
                        @if ($v->stnk != null)
                        {{ date("d-m-Y", strtotime($v->stnk)) }}
                        @else
                        {{ __('Tidak Ada') }}
                        @endif
                    </td>
                    <td>
                        {{ $v->info }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection