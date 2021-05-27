@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Persewaan Gedung'))
@section('titleContent', __('Edit Persewaan Gedung'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Persewaan Gedung') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $rental->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Nama Gedung') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->name }}"
                        class="form-control @error('name') is-invalid @enderror" name="name" readonly>
                    @error('name')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Alamat') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->address }}"
                        class="form-control @error('address') is-invalid @enderror" name="address" readonly>
                    @error('address')
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
                    <label>{{ __('No PBB') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pbb }}"
                        class="form-control @error('pbb') is-invalid @enderror" name="pbb" readonly>
                    @error('pbb')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Token PLN') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pln }}"
                        class="form-control @error('pln') is-invalid @enderror" name="pln" readonly>
                    @error('pln')
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
                    <label>{{ __('No PDAM') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pdam }}"
                        class="form-control @error('pdam') is-invalid @enderror" name="pdam" readonly>
                    @error('pdam')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Wifi') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->wifi }}"
                        class="form-control @error('wifi') is-invalid @enderror" name="wifi" readonly>
                    @error('wifi')
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
                    <label class="form-label">{{ __('Status Pembayaran') }}<code>*</code></label>
                    <div class="selectgroup w-100" id="status">
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="1" class="selectgroup-input"
                                {{ $rental->status == 'Lunas' ? 'checked' : 'disabled' }}>
                            <span class="selectgroup-button">{{ __('Lunas') }}</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="status" value="2" class="selectgroup-input"
                                {{ $rental->status == 'Belum' ? 'checked' : 'disabled' }}>
                            <span class="selectgroup-button">{{ __('Belum Lunas') }}</span>
                        </label>
                    </div>
                    @error('status')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="form-label">{{ __('Status Gedung') }}<code>*</code></label>
                    <div class="selectgroup w-100" id="rental">
                        <label class="selectgroup-item">
                            <input type="radio" name="rental" value="1" class="selectgroup-input"
                                {{ $rental->rental == 'Sewa' ? 'checked' : 'disabled' }}>
                            <span class="selectgroup-button">{{ __('Sewa') }}</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="rental" value="2" class="selectgroup-input"
                                {{ $rental->rental == 'Hak Milik' ? 'checked' : 'disabled' }}>
                            <span class="selectgroup-button">{{ __('Hak Milik') }}</span>
                        </label>
                    </div>
                    @error('rental')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Tanggal Jatuh Tempo') }}<code>*</code></label>
            <input value="{{ $rental->due }}" type="date" class="form-control @error('due') is-invalid @enderror"
                name="due" readonly>
            @error('due')
            <span class="text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
    </div>
</div>
@endsection