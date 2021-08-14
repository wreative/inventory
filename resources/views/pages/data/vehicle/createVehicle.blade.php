@extends('layouts.default')
@section('title', __('pages.title').__(' | Tambah Kendaraan'))
@section('titleContent', __('Tambah Kendaraan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Kendaraan') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Kendaraan') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('vehicle.store') }}">
        @csrf
        <input type="hidden" value="{{ $code }}" name="code">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama Kendaraan') }}<code>*</code></label>
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
                        <label>{{ __('Jenis') }}<code>*</code></label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" name="type"
                            required>
                        @error('type')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Merk') }}<code>*</code></label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand"
                            required>
                        @error('brand')
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
                        <label>{{ __('No Plat') }}<code>*</code></label>
                        <input type="text" class="form-control @error('plat') is-invalid @enderror" name="plat"
                            required>
                        @error('plat')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('No Rangkah') }}<code>*</code></label>
                        <input type="text" class="form-control @error('step') is-invalid @enderror" name="step"
                            required>
                        @error('step')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('No Mesin') }}<code>*</code></label>
                        <input type="text" class="form-control @error('engine') is-invalid @enderror" name="engine"
                            required>
                        @error('engine')
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
                        <label>{{ __('Tanggal Kir') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('kir') is-invalid @enderror"
                                name="kir">
                            @error('kir')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <label class="custom-switch mt-2">
                            <input type="checkbox" name="kir_null" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">
                                {{ __('Kosongkan Tanggal Kir') }}
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Pajak Tahunan') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('tax') is-invalid @enderror"
                                name="tax" required>
                            @error('tax')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal STNK') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker @error('stnk') is-invalid @enderror"
                                name="stnk" required>
                            @error('stnk')
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
                    rows="10" style="height: 77px;"></textarea>
                @error('info')
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