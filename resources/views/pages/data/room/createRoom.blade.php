@extends('layouts.default')
@section('title', __('pages.title').__(' | Tambah Ruangan'))
@section('titleContent', __('Tambah Ruangan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Ruangan') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Ruangan') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('room.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Nama Ruangan') }}<code>*</code></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required
                    autofocus>
                @error('name')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.add') }}</button>
        </div>
    </form>
</div>
@endsection