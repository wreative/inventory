@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Device'))

@section('section')
<table class='table'>
    <thead>
        <tr>
            <th class="w-auto">
                {{ __('NO') }}
            </th>
            <th>{{ __('Nama Pemegang HP') }}</th>
            <th>{{ __('Nomor HP') }}</th>
            <th>{{ __('Kode HP') }}</th>
            <th>{{ __('Kode Kartu') }}</th>
            <th>{{ __('Merk') }}</th>
            <th>{{ __('Masa Aktif') }}</th>
            <th>{{ __('Whatsapp') }}</th>
            <th>{{ __('Divisi') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($device as $number => $d)
        <tr>
            <td class="w-auto">
                {{ $number+1 }}
            </td>
            <td>
                {{ $d->name }}
            </td>
            <td>
                {{ $d->no }}
            </td>
            <td>
                {{ $d->code_phone }}
            </td>
            <td>
                {{ $d->code_card }}
            </td>
            <td>
                {{ $d->type }}
            </td>
            <td>
                {{ date("d-m-Y", strtotime($d->active)) }}
            </td>
            <td>
                {{ $d->wa }}
            </td>
            <td>
                {{ $d->relationDivision->name }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection