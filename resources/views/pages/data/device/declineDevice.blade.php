@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Device'))
@section('titleContent', __('Device'))
@section('breadcrumb', __('Penolakan'))
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
                    <th>{{ __('Masa Aktif') }}</th>
                    <th>{{ __('Masa Tenggang') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($device as $number => $w)
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
                        {{ date("d-m-Y", strtotime($d->active)) }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($d->grace)) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection