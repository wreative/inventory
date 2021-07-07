@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Gedung'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th style="w-auto">{{ __('No') }}</th>
            <th class="w-auto">{{ __('Kode') }}</th>
            <th>{{ __('Nama Gedung') }}</th>
            <th>{{ __('Pembayaran') }}</th>
            <th>{{ __('Status Gedung') }}</th>
            <th>{{ __('Jatuh Tempo') }}</th>
            <th>{{ __('No PBB') }}</th>
            <th>{{ __('No PLN') }}</th>
            <th>{{ __('No PDAM') }}</th>
            <th>{{ __('No Wifi') }}</th>
            <th>{{ __('Alamat') }}</th>
            <th>{{ __('Info') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rental as $number => $r)
        <tr>
            <td>{{ $number + 1 }}</td>
            <td class="w-25">{{ $r->code }}</td>
            <td>
                {{ $r->name }}
            </td>
            <td>
                <span class="badge badge-info">
                    {{ $r->status }}
                </span>
            </td>
            <td>
                <span class="badge badge-info">
                    {{ $r->rental }}
                </span>
            </td>
            <td>
                {{ date("m-Y", strtotime($r->due)) }}
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
                {{ $r->address }}
            </td>
            <td>
                {{ $r->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection