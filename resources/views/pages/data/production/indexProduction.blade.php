@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Alat Produksi'))
@section('titleContent', __('Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
@endsection

@section('content')
@include('pages.data.components.notification')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'production.index' ? 'active' : '' }}"
                            href="{{ route('production.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'production.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'production.deny' ? 'active' : '' }}"
                            href="{{ route('production.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'production.deny' ? 'white' : 'primary' }}">
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
        <a href="{{ route('production.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Alat Produksi') }}</a>
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
                    <th>{{ __('Nama Alat Produksi') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Info') }}</th>
                    @isset($notUser)
                    <th>{{ __('Aksi') }}</th>
                    @endisset
                </tr>
            </thead>
            <tbody>
                @foreach($production as $number => $p)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $p->code }}
                    </td>
                    <td>
                        {{ $p->name }}
                    </td>
                    <td>
                        {{ $p->brand }}
                    </td>
                    <td>
                        {{ __('Rp.').number_format($p->price_acq) }}
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($p->date_acq)) }}
                    </td>
                    <td>
                        {{ $p->qty }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $p->condition }}
                        </span>
                    </td>
                    <td>
                        {{ $p->info }}
                    </td>
                    @isset($notUser)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('production.show',$p->id) }}"
                                class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('production.edit',$p->id) }}">{{ __('pages.editItem') }}</a>
                                <form id="del-data{{ $p->id }}" action="{{ route('production.destroy',$p->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $p->id }}').submit();">
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