@extends('layouts.default')
@section('title', __('pages.title').__(' | Pengumpulan Laporan'))
@section('titleContent', __('Pengumpulan Laporan'))

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table-striped table" id="report" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama Karyawan') }}</th>
                    <th>{{ __('Nama Laporan') }}</th>
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Divisi') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $number => $r )
                <tr>
                    <td class="text-center">
                        {{ $number + 1 }}
                    </td>
                    <td>
                        {{ $r->namek }}
                    </td>
                    <td>
                        {{ $r->name }}
                    </td>
                    <td>
                        {{ date("d-M-Y", strtotime($r->tgl)) }}
                    </td>
                    <td>
                        @if ($r->acc == 'Pending')
                        <span class="badge badge-info">{{ __('PENDING') }}</span>
                        @elseif ($r->acc == 'Ditolak')
                        <span class="badge badge-danger">{{ __('DITOLAK') }}</span>
                        @else
                        <span class="badge badge-success">{{ __('DITERIMA') }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $r->named }}
                    </td>
                    <td>
                        @if ($r->info != null)
                        {{ $r->info }}
                        @else
                        {{ __('Kosong') }}
                        @endif
                    </td>
                    <td>
                        <button onclick="getProgress({{ $r->id }})" class="btn btn-primary btn-action mb-1 mt-1 mr-1"
                            data-toggle="tooltip" title="Lihat progress"><i class="fas fa-eye"></i></button>
                        @if ($r->acc == 'Pending' )
                        <button onclick="accept({{ $r->id }},'{{ $r->username }}')"
                            class="btn btn-success btn-action mb-1 mt-1 mr-1" data-toggle="tooltip"
                            title="Terima Laporan"><i class="fas fa-check"></i></button>
                        <button onclick="decline({{ $r->id }},'{{ $r->username }}')"
                            class="btn btn-danger btn-action mb-1 mt-1 mr-1" data-toggle="tooltip"
                            title="Tolak Laporan"><i class="fas fa-times"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/laporan/laporan.js') }}"></script>
@endsection