@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Ruangan'))
@section('titleContent', __('Edit Ruangan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Ruangan') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Ruangan') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('room.update',$room->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Nama Ruangan') }}<code>*</code></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $room->name }}"
                    name="name" required autofocus>
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