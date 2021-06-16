@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Alat Produksi'))
@section('titleContent', __('Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
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
                    <th>{{ __('Nama Alat Produksi') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    @if (Auth::user()->role_id == 1)
                    <th>{{ __('Perubahan') }}</th>
                    @endif
                    <th>{{ __('Aksi') }}</th>
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
                    @if (Auth::user()->role_id == 1)
                    <td>
                        @if (Auth::user()->role_id == 1)
                        @if ($p->edit == 1)
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
                                    href="{{ route('production.acc',$p->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('production.reject',$p->id) }}">{{ __('Tolak') }}</a>
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