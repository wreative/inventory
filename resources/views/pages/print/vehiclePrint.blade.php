@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Kendaraan'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th style="w-auto">{{ __('No') }}</th>
            <th class="w-auto">{{ __('Kode') }}</th>
            <th>{{ __('Nama Kendaraan') }}</th>
            <th>{{ __('Jenis') }}</th>
            <th>{{ __('Merk') }}</th>
            <th>{{ __('No Plat') }}</th>
            <th>{{ __('No Rangkah') }}</th>
            <th>{{ __('No Mesin') }}</th>
            <th>{{ __('Tanggal Kir') }}</th>
            <th>{{ __('Tanggal Pajak Tahunan') }}</th>
            <th>{{ __('Tanggal STNK') }}</th>
            <th>{{ __('Keterangan') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicle as $number => $v)
        <tr>
            <td>{{ $number + 1 }}</td>
            <td class="w-25">{{ $v->code }}</td>
            <td>
                {{ $v->name }}
            </td>
            <td>
                {{ $v->type }}
            </td>
            <td>
                {{ $v->brand }}
            </td>
            <td>
                {{ $v->plat }}
            </td>
            <td>
                {{ $v->step }}
            </td>
            <td>
                {{ $v->engine }}
            </td>
            <td>
                @if ($v->kir != null)
                {{ date("d-m-Y", strtotime($v->kir)) }}
                @else
                {{ __('Tidak Ada') }}
                @endif
            </td>
            <td>
                @if ($v->tax != null)
                {{ date("d-m-Y", strtotime($v->tax)) }}
                @else
                {{ __('Tidak Ada') }}
                @endif
            </td>
            <td>
                @if ($v->stnk != null)
                {{ date("d-m-Y", strtotime($v->stnk)) }}
                @else
                {{ __('Tidak Ada') }}
                @endif
            </td>
            <td>
                {{ $v->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection