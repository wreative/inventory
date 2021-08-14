@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Persewaan Gedung'))
@section('titleContent', __('Persewaan Gedung'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th class="text-center">
                        {{ __('Kode') }}
                    </th>
                    <th>{{ __('Nama Gedung') }}</th>
                    <th>{{ __('Status Gedung') }}</th>
                    <th>{{ __('Jatuh Tempo') }}</th>
                    <th>{{ __('No PBB') }}</th>
                    <th>{{ __('No PLN') }}</th>
                    <th>{{ __('Jatuh Tempo PLN') }}</th>
                    <th>{{ __('PDAM') }}</th>
                    <th>{{ __('Jatuh Tempo PDAM') }}</th>
                    <th>{{ __('Indihome') }}</th>
                    <th>{{ __('Jatuh Tempo Indihome') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    @if (Auth::user()->role_id == 1)
                    <th>{{ __('Perubahan') }}</th>
                    @endif
                    @empty($user)
                    <th>{{ __('Aksi') }}</th>
                    @endempty
                </tr>
            </thead>
            <tbody>
                @foreach($rental as $number => $r)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $r->code }}
                    </td>
                    <td>
                        {{ $r->name }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $r->rental }}
                        </span>
                    </td>
                    <td>
                        @if ($r->due == null)
                        {{ __('Tidak Ada') }}
                        @else
                        {{ date("d-m-Y", strtotime($r->due)) }}
                        @endif
                        <span class="badge badge-info">
                            {{ $r->due_type }}
                        </span>
                    </td>
                    <td>
                        {{ $r->pbb == '' ? __('Tidak Ada') : $r->pbb }}
                    </td>
                    <td>
                        {{ $r->pln == '' ? __('Tidak Ada') : $r->pln }}
                    </td>
                    <td>
                        {{ $r->pln == '' ? __('Tidak Ada') : date("d-m-Y", strtotime($r->due_pln)) }}
                    </td>
                    <td>
                        {{ $r->pdam == '' ? __('Tidak Ada') : $r->pdam }}
                    </td>
                    <td>
                        {{ $r->pdam == '' ? __('Tidak Ada') : date("d-m-Y", strtotime($r->due_pdam)) }}
                    </td>
                    <td>
                        {{ $r->wifi == '' ? __('Tidak Ada') : $r->wifi }}
                    </td>
                    <td>
                        {{ $r->wifi == '' ? __('Tidak Ada') : date("d-m-Y", strtotime($r->due_wifi)) }}
                    </td>
                    <td>
                        {{ $r->address }}
                    </td>
                    <td>
                        {{ $r->info }}
                    </td>
                    @if (Auth::user()->role_id == 1)
                    <td>
                        @if (Auth::user()->role_id == 1)
                        @if ($r->edit == 1)
                        <span class="badge badge-warning">
                            {{ __('Edit') }}
                        </span>
                        @else
                        <span class="badge badge-danger">
                            {{ __('Hapus') }}
                        </span>
                        @endif
                        @endif
                    </td>
                    @endif
                    @empty($user)
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('rental.show',$r->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('rental.acc',$r->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('rental.reject',$r->id) }}">{{ __('Tolak') }}</a>
                            </div>
                        </div>
                    </td>
                    @endempty
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection