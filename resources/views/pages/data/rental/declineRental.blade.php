@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Persewaan Gedung'))
@section('titleContent', __('Persewaan Gedung'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
@endsection

@section('content')
@include('pages.data.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'rental.index' ? 'active' : '' }}"
                            href="{{ route('rental.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'rental.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'rental.deny' ? 'active' : '' }}"
                            href="{{ route('rental.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'rental.deny' ? 'white' : 'primary' }}">
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
                    <th>{{ __('Nama Gedung') }}</th>
                    <th>{{ __('Pembayaran') }}</th>
                    <th>{{ __('Status Gedung') }}</th>
                    <th>{{ __('Jatuh Tempo') }}</th>
                    <th>{{ __('No PBB') }}</th>
                    <th>{{ __('No PLN') }}</th>
                    <th>{{ __('No PDAM') }}</th>
                    <th>{{ __('No Wifi') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('Info') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rental as $number => $r)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $r->code }}
                    </td>
                    <td>
                        {{ $r->name }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $r->status }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $r->rental }}
                        </span>
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($r->due)) }}
                    </td>
                    <td>
                        {{ $r->pbb }}
                    </td>
                    <td>
                        {{ $r->pln }}
                    </td>
                    <td>
                        {{ $r->pdam }}
                    </td>
                    <td>
                        {{ $r->wifi }}
                    </td>
                    <td>
                        {{ $r->address }}
                    </td>
                    <td>
                        {{ $r->info }}
                    </td>
                    @isset($notUser)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('rental.show',$r->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('rental.edit',$r->id) }}">{{ __('pages.editItem') }}</a>
                                <form id="del-data{{ $r->id }}" action="{{ route('rental.destroy',$r->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $r->id }}').submit();">
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