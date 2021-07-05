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
            font-size: 9pt;
        }

        h6 {
            font-size: 10pt;
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
            {{ __('Dibuat Oleh : ') }}@yield('name')
        </h6>
        <h6>
            {{ __('Bagian : ') }}@yield('part')
        </h6>
    </div>

    @yield('section')

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