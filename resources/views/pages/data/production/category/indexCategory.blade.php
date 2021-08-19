@extends('layouts.default')
@section('title', __('pages.title').__(' | Data Kategori Alat Produksi'))
@section('titleContent', __('Kategori Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
<div class="breadcrumb-item active">{{ __('Kategori') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('category-production.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Kategori Alat Produksi') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama Kategori') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $number => $c)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td>
                        {{ $c->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-action" href="{{ route('category-production.edit',$c->id) }}"
                            data-toggle="tooltip" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection