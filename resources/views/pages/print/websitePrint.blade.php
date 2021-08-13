@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Website'))

@section('section')
<table class='table'>
    <thead>
        <tr>
            <th class="w-auto">
                {{ __('NO') }}
            </th>
            <th style="width: 15%">
                {{ __('Kode') }}
            </th>
            <th>{{ __('Nama') }}</th>
            <th>{{ __('Kategori') }}</th>
            <th style="width: 20%">{{ __('Jatuh Tempo') }}</th>
            <th class="w-100">{{ __('Keterangan') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($website as $number => $w)
        <tr>
            <td class="w-auto">
                {{ $number+1 }}
            </td>
            <td style="width: 15%">
                {{ $w->code }}
            </td>
            <td>
                {{ $w->name }}
            </td>
            <td class="w-auto">
                {{ $w->category }}
            </td>
            <td style="width: 20%">
                {{ date("d-m-Y", strtotime($w->due)) }}
            </td>
            <td class="w-100">
                {{ $w->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection