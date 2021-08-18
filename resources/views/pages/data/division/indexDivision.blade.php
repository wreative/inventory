@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Divisi'))
@section('titleContent', __('Divisi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Divisi') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('division.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Divisi') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama Divisi') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($division as $number => $d)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td>
                        {{ $d->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-action" href="{{ route('division.edit',$d->id) }}"
                            data-toggle="tooltip" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form id="del-data{{ $d->id }}" action="{{ route('division.destroy',$d->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger btn-action mb-1 mt-1" style="cursor: pointer"
                                data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                data-confirm-yes="document.getElementById('del-data{{ $d->id }}').submit();"
                                data-toggle="tooltip" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection