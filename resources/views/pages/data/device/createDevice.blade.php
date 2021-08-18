@extends('layouts.default')
@section('title', __('pages.title').__(' | Tambah Device'))
@section('titleContent', __('Tambah Device'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Device') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Device') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('device.store') }}">
        @csrf
        <input type="hidden" value="{{ $code }}" name="code">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama') }}<code>*</code></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required
                            autofocus>
                        @error('name')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tipe') }}<code>*</code></label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" name="type"
                            required>
                        @error('type')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Kode HP') }}<code>*</code></label>
                        <input type="text" class="form-control @error('code_phone') is-invalid @enderror"
                            name="code_phone" required>
                        @error('code_phone')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('No HP') }}<code>*</code></label>
                        <input type="text" class="form-control @error('no') is-invalid @enderror" name="no" required>
                        @error('no')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">{{ __('Whatsapp') }}<code>*</code></label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="wa" value="Ya" class="selectgroup-input" checked>
                                <span class="selectgroup-button">{{ __('Ya') }}</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="wa" value="Tidak" class="selectgroup-input">
                                <span class="selectgroup-button">{{ __('Tidak') }}</span>
                            </label>
                        </div>
                        @error('wa')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Masa Aktif') }}<code>*</code></label>
                        <input type="text" class="form-control datepicker @error('active') is-invalid @enderror"
                            name="active" required>
                        @error('active')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <div class="form-group">
                            <label>{{ __('Masa Tenggang') }}<code>*</code></label>
                            <input type="text" class="form-control datepicker @error('grace') is-invalid @enderror"
                                name="grace" required>
                            @error('grace')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Divisi') }}<code>*</code></label>
                <select class="form-control select2 @error('division') is-invalid @enderror" name="division" required>
                    @foreach ($division as $d)
                    <option value="{{ $d->id }}">
                        {{ $d->name }}
                    </option>
                    @endforeach
                </select>
                @error('division')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Aksesoris') }}</label>
                <textarea type="text" class="form-control @error('acc') is-invalid @enderror" name="acc" cols="150"
                    rows="10" style="height: 77px;"></textarea>
                @error('acc')
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