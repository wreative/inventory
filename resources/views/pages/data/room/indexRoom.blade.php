@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Ruangan'))
@section('titleContent', __('Ruangan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Ruangan') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('room.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Ruangan') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama Ruangan') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($room as $number => $e)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td>
                        {{ $e->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-action"
                            href="{{ route('production.edit',$e->id) }}">{{ __('pages.editItem') }}</a>
                        <form id="del-data{{ $e->id }}" action="{{ route('production.destroy',$e->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger btn-action mb-1 mt-1" style="cursor: pointer"
                                data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                data-confirm-yes="document.getElementById('del-data{{ $e->id }}').submit();">
                                {{ __('pages.delItem') }}
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