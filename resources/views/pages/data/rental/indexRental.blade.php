@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Persewaan Gedung'))
@section('titleContent', __('Persewaan Gedung'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('rental.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Persewaan Gedung') }}</a>
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
                    <th>{{ __('Nama Gedung') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('Pembayaran') }}</th>
                    <th>{{ __('No PBB') }}</th>
                    <th>{{ __('No PLN') }}</th>
                    <th>{{ __('No PDAM') }}</th>
                    <th>{{ __('No Wifi') }}</th>
                    <th>{{ __('Status Gedung') }}</th>
                    <th>{{ __('Jatuh Tempo') }}</th>
                    <th>{{ __('Info') }}</th>
                    @isset($notuser)
                    <th>{{ __('Aksi') }}</th>
                    @endisset
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
                        {{ $r->address }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $r->rental }}
                        </span>
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
                        <span class="badge badge-info">
                            {{ $r->status }}
                        </span>
                    </td>
                    <td>
                        {{ date("m-Y", strtotime($r->due)) }}
                    </td>
                    <td>
                        {{ $r->info }}
                    </td>
                    @isset($notuser)
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