@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Perlengkapan'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th style="w-auto">{{ __('No') }}</th>
            <th class="w-auto">{{ __('Kode') }}</th>
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
            <td>{{ $number + 1 }}</td>
            <td class="w-25">{{ $e->code }}</td>
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
                {{ $e->condition }}
            </td>
            <td>
                {{ $e->relationRoom->name }}
            </td>
            <td>
                {{ $e->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection