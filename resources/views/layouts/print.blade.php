<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ mix('assets.css') }}">
</head>

<style>
    table,
    td,
    th,
    tr {
        border: 1px solid;
    }

    @media screen,
    print {
        body {
            font-size: 12pt;
        }

        .badge-info {
            color: black
        }
    }
</style>

<style type="text/css" media="print">
    @page {
        size: landscape;
    }
</style>

<body>
    <div class="text-left m-2">
        <h6>
            {{ __('Dibuat Tanggal : ').date("d-m-Y") }}
        </h6>
        <h6>
            {{ __('Dibuat Oleh : ').date("d-m-Y") }}
        </h6>
    </div>

    {{-- <table class='table '>
        <thead>
            <tr>
                <th class="w-auto">{{ __('No') }}</th>
    <th class="w-auto">{{ __('Tanggal') }}</th>
    <th>{{ __('Kategori') }}</th>
    <th>{{ __('Aktivitas') }}</th>
    <th>{{ __('Jam') }}</th>
    <th>{{ __('Status') }}</th>
    <th class="w-75">{{ __('Keterangan') }}</th>
    </tr>
    </thead>
    <tbody>
        @foreach($report as $number => $r)
        @php
        $count = count(json_decode($r->progress));
        @endphp
        <tr>
            <td rowspan="{{ $count }}">{{ $number + 1 }}</td>
            <td rowspan="{{ $count }}">{{ date("d-M-Y", strtotime($r->tgl)) }}</td>
            <td rowspan="{{ $count }}">
                @if ($r->category != null)
                @foreach(explode(',', $r->category) as $cat)
                <span class="badge badge-light">
                    {{ $cat }}
                </span>
                @endforeach
                @else
                <span class="badge ">
                    {{ __('Tidak ada') }}
                </span>
                @endif
            </td>
            <td>{{ json_decode($r->progress)[0] }}</td>
            @if ($r->time == "")
            <td>{{ __('Tidak Ada') }}</td>
            @else
            <td>{{ json_decode($r->time)[0] }}</td>
            @endif
            @if ($r->status == "")
            <td>{{ __('Tidak Ada') }}</td>
            @else
            <td>{{ json_decode($r->status)[0] }}</td>
            @endif
            <td rowspan="{{ $count }}"></td>
        </tr>
        @for ($i = 1; $i < $count; $i++) <tr>
            <td>{{ json_decode($r->progress)[$i] }}</td>
            @if ($r->time == "")
            <td>{{ __('Tidak Ada') }}</td>
            @else
            <td>{{ json_decode($r->time)[$i] }}</td>
            @endif
            @if ($r->status == "")
            <td>{{ __('Tidak Ada') }}</td>
            @else
            <td>{{ json_decode($r->status)[$i] }}</td>
            @endif
            </tr>
            @endfor
            @endforeach
    </tbody>
    </table> --}}

    <div class="text-center row mt-5">
        <div class="col">
            <div class="mb-5">{{ __('Pembuat') }}</div>
            <div class="mt-5">{{ __('(.........................)') }}</div>
        </div>
        <div class="col">
            <div class="mb-5">{{ __('Mengetahui') }}</div>
            <div class="mt-5">{{ __('(.........................)') }}</div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>