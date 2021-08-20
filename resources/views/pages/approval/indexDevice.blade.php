@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Device'))
@section('titleContent', __('Device'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Device') }}</div>
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
                    <th>{{ __('Nama Pemegang HP') }}</th>
                    <th>{{ __('Nomor HP') }}</th>
                    <th>{{ __('Kode HP') }}</th>
                    <th>{{ __('Kode Kartu') }}</th>
                    <th>{{ __('Masa Aktif') }}</th>
                    @empty($user)
                    <th>{{ __('Aksi') }}</th>
                    @endempty
                </tr>
            </thead>
            <tbody>
                @foreach($device as $number => $d)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $d->code }}
                    </td>
                    <td>
                        {{ $d->name }}
                    </td>
                    <td>
                        {{ $d->no }}
                    </td>
                    <td>
                        {{ $d->code_phone }}
                    </td>
                    <td>
                        {{ $d->code_card }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($d->active)) }}
                    </td>
                    @empty($user)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('device.show',$d->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('device.acc',$d->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('device.reject',$d->id) }}">{{ __('Tolak') }}</a>
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