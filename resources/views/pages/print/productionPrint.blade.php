@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Alat Produksi'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th style="w-auto">{{ __('No') }}</th>
            <th class="w-auto">{{ __('Kode') }}</th>
            <th>{{ __('Nama Alat Produksi') }}</th>
            <th>{{ __('Merk') }}</th>
            <th>{{ __('Harga Perolehan') }}</th>
            <th>{{ __('Tanggal Perolehan') }}</th>
            <th>{{ __('Qty') }}</th>
            <th>{{ __('Kategori') }}</th>
            <th>{{ __('Kondisi') }}</th>
            <th>{{ __('Info') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($production as $number => $p)
        <tr>
            <td>{{ $number + 1 }}</td>
            <td class="w-25">{{ $p->code }}</td>
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
                @if ($p->category == null or $p->category == '')
                {{ __('Tidak Ada') }}
                @else
                {{ $p->relationCategory->name }}
                @endif
            </td>
            <td>
                {{ $p->condition }}
            </td>
            <td>
                {{ $p->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection