@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Persewaan Gedung'))
@section('titleContent', __('Persewaan Gedung'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
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
                    <th>{{ __('Nama Gedung') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('Pembayaran') }}</th>
                    <th>{{ __('No PBB') }}</th>
                    <th>{{ __('No PLN') }}</th>
                    <th>{{ __('No PDAM') }}</th>
                    <th>{{ __('No Wifi') }}</th>
                    <th>{{ __('Status Gedung') }}</th>
                    <th>{{ __('Jatuh Tempo') }}</th>
                    @if (Auth::user()->role_id == 1)
                    <th>{{ __('Perubahan') }}</th>
                    @endif
                    <th>{{ __('Aksi') }}</th>
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
                        @if (Auth::user()->role_id == 1)
                        @if ($r->edit == 1)
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
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('rental.show',$r->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('rental.acc',$r->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('rental.reject',$r->id) }}">{{ __('Tolak') }}</a>
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