@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Kategori Alat Produksi'))
@section('titleContent', __('Edit Kategori Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
<div class="breadcrumb-item active">{{ __('Kategori') }}</div>
<div class="breadcrumb-item active">{{ __('Edit') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('category-production.update',$category->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Nama Kategori Alat Produksi') }}<code>*</code></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $category->name }}" name="name" required autofocus>
                @error('name')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection