@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Kendaraan'))
@section('titleContent', __('Kendaraan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Kendaraan') }}</div>
@endsection

@section('content')
<div class="card">
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
                        {{ date("d-m-Y", strtotime($v->kir)) }}
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