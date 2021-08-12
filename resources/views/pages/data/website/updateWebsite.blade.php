@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Website'))
@section('titleContent', __('Edit Website'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Website') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Website') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $website->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('website.update',$website->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Nama') }}<code>*</code></label>
                <input type="text" value="{{ $website->name }}" class="form-control @error('name') is-invalid @enderror"
                    name="name" required autofocus>
                @error('name')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Kategori') }}<code>*</code></label>
                        <select class="form-control selectric @error('category') is-invalid @enderror"
                            value="{{ $website->category }}" name="category" required>
                            <option value="{{ __('Domain') }}" {{ $website->category == 'Domain' ? 'selected' : '' }}>
                                {{ __('Domain') }}
                            </option>
                            <option value="{{ __('Hosting') }}" {{ $website->category == 'Hosting' ? 'selected' : '' }}>
                                {{ __('Hosting') }}
                            </option>
                        </select>
                        @error('category')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Jatuh Tempo') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" value="{{ $website->due }}"
                                class="form-control datepicker @error('due') is-invalid @enderror" name="due" required>
                            @error('due')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Keterangan') }}</label>
                <textarea type="text" class="form-control @error('info') is-invalid @enderror" name="info" cols="150"
                    rows="10" style="height: 77px;">
                    {{ $website->info }}
                </textarea>
                @error('info')
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