@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Gedung'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th class="w-auto">
                {{ __('NO') }}
            </th>
            <th class="w-auto">
                {{ __('Kode') }}
            </th>
            <th>{{ __('Nama Gedung') }}</th>
            <th>{{ __('Status Gedung') }}</th>
            <th>{{ __('Jatuh Tempo') }}</th>
            <th>{{ __('No PBB') }}</th>
            <th>{{ __('PLN') }}</th>
            <th>{{ __('PDAM') }}</th>
            <th>{{ __('Indihome') }}</th>
            <th>{{ __('Alamat') }}</th>
            <th style="width: 100%">{{ __('Keterangan') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rental as $number => $r)
        <tr>
            <td class="w-auto">
                {{ $number+1 }}
            </td>
            <td class="w-auto">
                {{ $r->code }}
            </td>
            <td>
                {{ $r->name }}
            </td>
            <td>
                {{ $r->rental }}
            </td>
            <td>
                {{ date("d-m-Y", strtotime($r->due)).__(' (').$r->due_type.__(')') }}
            </td>
            <td>
                {{ $r->pbb == '' ? __('Tidak Ada') : $r->pbb }}
            </td>
            <td>
                {{ $r->pln == '' ? __('Tidak Ada') : $r->pln }}
                <br />
                {{ $r->pln == '' ? __('Tidak Ada') : __(' (').date("d-m-Y", strtotime($r->due_pln)).__(')') }}
            </td>
            <td>
                {{ $r->pdam == '' ? __('Tidak Ada') : $r->pdam }}
                <br />
                {{ $r->pdam == '' ? __('Tidak Ada') : __(' (').date("d-m-Y", strtotime($r->due_pdam)).__(')') }}
            </td>
            <td>
                {{ $r->wifi == '' ? __('Tidak Ada') : $r->wifi }}
                <br />
                {{ $r->wifi == '' ? __('Tidak Ada') : __(' (').date("d-m-Y", strtotime($r->due_wifi)).__(')') }}
            </td>
            <td>
                {{ $r->address }}
            </td>
            <td style="width: 100%">
                {{ $r->info }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection