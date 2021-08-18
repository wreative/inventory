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
            <th>{{ __('Masa Aktif') }}</th>
            <th>{{ __('Masa Tenggang') }}</th>
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
                {{ date("d-m-Y", strtotime($d->active)) }}
            </td>
            <td>
                {{ date("d-m-Y", strtotime($d->grace)) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection