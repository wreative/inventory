@extends('layouts.default')
@section('title', __('pages.title').__(' | Penolakan Perlengkapan'))
@section('titleContent', __('Perlengkapan'))
@section('breadcrumb', __('Penolakan'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
@endsection

@section('content')
@include('pages.data.components.notification')
@include('pages.data.components.header', ['index' => 'equipment.index', 'total' => $total,
'deny' => 'equipment.deny', 'dtotal'=>$dtotal])
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
                    <th>{{ __('Nama Perlengkapan') }}</th>
                    <th>{{ __('Merk') }}</th>
                    <th>{{ __('Harga Perolehan') }}</th>
                    <th>{{ __('Tanggal Perolehan') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Kondisi') }}</th>
                    <th>{{ __('Lokasi') }}</th>
                    <th>{{ __('Keterangan') }}</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection