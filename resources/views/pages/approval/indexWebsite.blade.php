@extends('layouts.default')
@section('title', __('pages.title').__(' | Master Website'))
@section('titleContent', __('Website'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Website') }}</div>
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
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Kategori') }}</th>
                    <th>{{ __('Jatuh Tempo') }}</th>
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
                @foreach($vehicle as $number => $v)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $w->code }}
                    </td>
                    <td>
                        {{ $w->name }}
                    </td>
                    <td>
                        {{ $w->category }}
                    </td>
                    <td>
                        {{ date("d-m-Y", strtotime($w->due)) }}
                    </td>
                    <td>
                        {{ $w->info }}
                    </td>
                    @if (Auth::user()->role_id == 1)
                    <td>
                        @if (Auth::user()->role_id == 1)
                        @if ($v->edit == 1)
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
                            <a href="{{ route('website.show',$v->id) }}" class="btn btn-primary">{{ __('Lihat') }}</a>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('website.acc',$v->id) }}">{{ __('Setujui') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('website.reject',$v->id) }}">{{ __('Tolak') }}</a>
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