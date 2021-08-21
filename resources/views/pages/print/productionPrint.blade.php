@extends('layouts.print')

@section('name',Auth::user()->name)
@section('part',__('Alat Produksi'))

@section('section')
<table class='table '>
    <thead>
        <tr>
            <th class="w-auto">{{ __('Kategori') }}</th>
            <th class="w-auto">{{ __('No') }}</th>
            <th>{{ __('Code') }}</th>
            <th>{{ __('Nama Alat Produksi') }}</th>
            <th>{{ __('Merk') }}</th>
            <th>{{ __('Harga Perolehan') }}</th>
            <th>{{ __('Tanggal Perolehan') }}</th>
            <th>{{ __('Qty') }}</th>
            <th>{{ __('Kondisi') }}</th>
            <th>{{ __('Info') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($production as $number => $p)
        @if ($p->relationProduction->count() != 0)
        <tr>
            <td rowspan="{{ $p->relationProduction->count() }}">
                {{ $p->name }}
            </td>
            <td>
                {{ __('1') }}
            </td>
            <td>
                {{ $p->relationProduction[0]->code }}
            </td>
            <td>
                {{ $p->relationProduction[0]->name }}
            </td>
            <td>
                {{ $p->relationProduction[0]->brand }}
            </td>
            <td>
                {{ __('Rp.').number_format($p->relationProduction[0]->price_acq) }}
            </td>
            <td>
                {{ date("m-Y", strtotime($p->relationProduction[0]->date_acq)) }}
            </td>
            <td>
                {{ $p->relationProduction[0]->qty }}
            </td>
            <td>
                {{ $p->relationProduction[0]->condition }}
            </td>
            <td>
                {{ $p->relationProduction[0]->info }}
            </td>
        </tr>
        @for ($i=1; $i < $p->relationProduction->count();$i++)
            <tr>
                <td>
                    {{ $i+1 }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->code }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->name }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->brand }}
                </td>
                <td>
                    {{ __('Rp.').number_format($p->relationProduction[$i]->price_acq) }}
                </td>
                <td>
                    {{ date("m-Y", strtotime($p->relationProduction[$i]->date_acq)) }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->qty }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->condition }}
                </td>
                <td>
                    {{ $p->relationProduction[$i]->info }}
                </td>
            </tr>
            @endfor
            @endif
            @endforeach
    </tbody>
</table>
@endsection