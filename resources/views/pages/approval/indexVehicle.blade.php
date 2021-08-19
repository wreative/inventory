@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Kendaraan'))
@section('titleContent', __('Kendaraan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Kendaraan') }}</div>
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
                    <th>{{ __('No Rangkah') }}</th>
                    <th>{{ __('No Mesin') }}</th>
                    <th>{{ __('Tanggal Kir') }}</th>
                    <th>{{ __('Tanggal Pajak Tahunan') }}</th>
                    <th>{{ __('Tanggal STNK') }}</th>
                    @if (Auth::user()->role_id == 1)
                    <th>{{ __('Perubahan') }}</th>
                    @endif
                    @empty($user)
                    <th>{{ __('Aksi') }}</th>
                    @endempty
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
                    @if (Auth::user()->role_id == 1)
                    <td>
                        @if (Auth::user()->role_id == 1)
                        @if ($v->edit == 1)
                        <span class="badge badge-warning">
                            {{ __('Edit') }}
                        </span>
                        @else
                        <span class="badge badge-danger">
                            {{ __('Hapus') }}
                        </span>
                        @endif
                        @endif
                    </td>
                    @endif
                    @empty($user)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('vehicle.show',$v->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('vehicle.acc',$v->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('vehicle.reject',$v->id) }}">{{ __('Tolak') }}</a>
                            </div>
                        </div>
                    </td>
                    @endempty
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection