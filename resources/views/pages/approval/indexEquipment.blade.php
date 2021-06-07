@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Perlengkapan'))
@section('titleContent', __('Perlengkapan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
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
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Lokasi') }}</th>
                    @if (Auth::user()->role_id == 1)
                    <th>{{ __('Perubahan') }}</th>
                    @endif
                    <th>{{ __('Aksi') }}</th>
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
                        @if (Auth::user()->role_id == 1)
                        @if ($e->edit == 1)
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
                            <a href="{{ route('equipment.show',$e->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('equipment.acc',$e->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('equipment.reject',$e->id) }}">{{ __('Tolak') }}</a>
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