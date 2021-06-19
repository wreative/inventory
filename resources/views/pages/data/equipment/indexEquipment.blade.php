@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Perlengkapan'))
@section('titleContent', __('Perlengkapan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
@endsection

@section('content')
@if(Session::has('status'))
<div class="alert alert-info alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ Session::get('status') }}
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'equipment.index' ? 'active' : '' }}"
                            href="{{ route('equipment.index') }}">{{ __('Semua') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'equipment.index' ? 'white' : 'primary' }}">
                                {{ $total }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'equipment.deny' ? 'active' : '' }}"
                            href="{{ route('equipment.deny') }}">{{ __('Ditolak') }}
                            <span
                                class="badge badge-{{ Request::route()->getName() == 'equipment.deny' ? 'white' : 'primary' }}">
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
        <a href="{{ route('equipment.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Perlengkapan') }}</a>
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
                    <th>{{ __('Nama Perlengkapan') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Lokasi') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    @isset($notUser)
                    <th>{{ __('Aksi') }}</th>
                    @endisset
                </tr>
            </thead>
            <tbody>
                @foreach($equipment as $number => $e)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $e->code }}
                    </td>
                    <td>
                        {{ $e->name }}
                    </td>
                    <td>
                        {{ $e->brand }}
                    </td>
                    <td>
                        {{ __('Rp.').number_format($e->price_acq) }}
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($e->date_acq)) }}
                    </td>
                    <td>
                        {{ $e->qty }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $e->condition }}
                        </span>
                    </td>
                    <td>
                        {{ $e->location }}
                    </td>
                    <td>
                        {{ $e->info }}
                    </td>
                    @isset($notUser)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('equipment.show',$e->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('equipment.edit',$e->id) }}">{{ __('pages.editItem') }}</a>
                                <form id="del-data{{ $e->id }}" action="{{ route('equipment.destroy',$e->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer"
                                        data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $e->id }}').submit();">
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