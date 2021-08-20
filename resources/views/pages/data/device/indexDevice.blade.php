@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Device'))
@section('titleContent', __('Device'))
@section('breadcrumb', __('Data'))
@section('titleButton')
<div class="section-header-button">
    <a href="{{ route('print',__('device')) }}" target="_blank" class="btn btn-primary">
        {{ __('Print') }}
    </a>
</div>
@endsection
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Device') }}</div>
@endsection

@section('content')
@include('pages.data.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'device.index' ? 'active' : '' }}"
                            href="{{ route('device.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'device.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'device.deny' ? 'active' : '' }}"
                            href="{{ route('device.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'device.deny' ? 'white' : 'primary' }}">
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
        <a href="{{ route('device.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Device') }}</a>
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
                    <th>{{ __('Nama Pemegang HP') }}</th>
                    <th>{{ __('Nomor HP') }}</th>
                    <th>{{ __('Kode HP') }}</th>
                    <th>{{ __('Kode Kartu') }}</th>
                    <th>{{ __('Masa Aktif') }}</th>
                    @isset($notUser)
                    <th>{{ __('Aksi') }}</th>
                    @endisset
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
                    @isset($notUser)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('device.show',$d->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('device.edit',$d->id) }}">{{ __('pages.editItem') }}</a>
                                <form id="del-data{{ $d->id }}" action="{{ route('device.destroy',$d->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $d->id }}').submit();">
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