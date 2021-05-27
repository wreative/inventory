@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Alat Produksi'))
@section('titleContent', __('Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
@endsection

@section('content')
<div class="card card-primary">
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
                    <th>{{ __('Tanggal Kir') }}</th>
                    <th>{{ __('Tanggal Pajak Tahunan') }}</th>
                    <th>{{ __('Tanggal STNK') }}</th>
                    <th>{{ __('Aksi') }}</th>
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
                        {{ date("d-m-Y", strtotime($v->kir)) }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($v->tax)) }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($v->stnk)) }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('vehicle.show',$v->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                @if (Auth::user()->roles == 1)
                                <a class="dropdown-item"
                                    href="{{ route('vehicle.edit',$v->id) }}">{{ __('pages.editItem') }}</a>
                                @endif
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
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="{{ route('vehicle.acc',$v->id) }}">{{ __('Setujui') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection