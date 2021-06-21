@extends('layouts.default')
@section('title', __('pages.title').__(' | Lihat Persewaan Gedung'))
@section('titleContent', __('Lihat Persewaan Gedung'))
@section('headerBack')
<div class="section-header-back">
    <a href="{{ route('rental.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
@endsection
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
<div class="breadcrumb-item active">{{ __('Lihat Persewaan Gedung') }}</div>
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
                    <input type="text" value="{{ $rental->name }}" class="form-control" name="name" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Alamat') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->address }}" class="form-control" name="address" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No PBB') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pbb }}" class="form-control" name="pbb" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Token PLN') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pln }}" class="form-control" name="pln" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No PDAM') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->pdam }}" class="form-control" name="pdam" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Wifi') }}<code>*</code></label>
                    <input type="text" value="{{ $rental->wifi }}" class="form-control" name="wifi" readonly>
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
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Tanggal Jatuh Tempo') }}<code>*</code></label>
            <input value="{{ $rental->due }}" type="date" class="form-control" name="due" readonly>
        </div>
        <div class="form-group">
            <label>{{ __('Keterangan') }}</label>
            <textarea type="text" class="form-control" name="info" cols="150" rows="10" style="height: 77px;" readonly>
                    {{ $rental->info }}
                </textarea>
        </div>
    </div>
</div>
@endsection