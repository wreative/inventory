@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Kendaraan'))
@section('titleContent', __('Kendaraan'))
@section('breadcrumb', __('Data'))
@section('titleButton')
<div class="section-header-button">
    <a href="{{ route('print',__('vehicle')) }}" class="btn btn-primary">
        {{ __('Print') }}
    </a>
</div>
@endsection
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
    <div class="card-header">
        <a href="{{ route('vehicle.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Kendaraan') }}</a>
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
                    @isset($notUser)
                    <th>{{ __('Aksi') }}</th>
                    @endisset
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
                        {{ __('Tidak di isi') }}
                        @endif
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($v->tax)) }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($v->stnk)) }}
                    </td>
                    <td>
                        {{ $v->info }}
                    </td>
                    @isset($notUser)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('vehicle.show',$v->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('vehicle.edit',$v->id) }}">{{ __('pages.editItem') }}</a>
                                <form id="del-data{{ $v->id }}" action="{{ route('vehicle.destroy',$v->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $v->id }}').submit();">
                                        {{ __('pages.delItem') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </td>
                    @endisset
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection