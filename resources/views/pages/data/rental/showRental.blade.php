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
                    <label>{{ __('Nama Gedung') }}</label>
                    <input type="text" value="{{ $rental->name }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Alamat') }}</label>
                    <input type="text" value="{{ $rental->address }}" class="form-control " disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No PBB') }}</label>
                    <input type="text" value="{{ $rental->pbb }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="form-label">{{ __('Status Gedung') }}</label>
                    <div class="selectgroup w-100" id="rental">
                        <label class="selectgroup-item">
                            <input type="radio" name="rental" value="1" class="selectgroup-input"
                                {{ $rental->rental == 'Sewa' ? 'checked' : '' }} disabled>
                            <span class="selectgroup-button">{{ __('Sewa') }}</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="rental" value="2" class="selectgroup-input"
                                {{ $rental->rental == 'Hak Milik' ? 'checked' : '' }} disabled>
                            <span class="selectgroup-button">{{ __('Hak Milik') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Kosongkan Kolom') }}</label>
            <div class="selectgroup selectgroup-pills">
                <label class="selectgroup-item">
                    <input type="checkbox" name="pln_null" value="1" class="selectgroup-input"
                        {{ $rental->pln == null ? 'checked' : '' }} disabled>
                    <span class="selectgroup-button">{{ __('Kolom PLN') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="checkbox" name="pdam_null" value="1" class="selectgroup-input"
                        {{ $rental->pdam == null ? 'checked' : '' }} disabled>
                    <span class="selectgroup-button">{{ __('Kolom PDAM') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="checkbox" name="wifi_null" value="1" class="selectgroup-input"
                        {{ $rental->wifi == null ? 'checked' : '' }} disabled>
                    <span class="selectgroup-button">{{ __('Kolom Indihome') }}</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Token PLN') }}</label>
                    <input type="text" value="{{ $rental->pln }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Tanggal Jatuh Tempo PLN') }}</label>
                    <input type="text" value="{{ $rental->pln =='' ? '' : $rental->due_pln }}" class="form-control"
                        disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No PDAM') }}</label>
                    <input type="text" value="{{ $rental->pdam }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Tanggal Jatuh Tempo PDAM') }}</label>
                    <input type="text" value="{{ $rental->pdam == '' ? '' : $rental->due_pln }}" class="form-control"
                        disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Indihome') }}</label>
                    <input type="text" value="{{ $rental->wifi }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Tanggal Jatuh Tempo Indihome') }}</label>
                    <input type="text" value="{{ $rental->pln == '' ? '' : $rental->due_pln }}" class="form-control"
                        disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Tanggal Jatuh Tempo') }}</label>
                    <input type="text" value="{{ $rental->due }}" class="form-control datepicker" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Jenis Jatuh Tempo') }}</label>
                    <select class="form-control" disabled>
                        <option value="Bulanan" {{ $rental->due_type == 'Bulanan'  ? 'selected' : '' }}>
                            {{ __('Bulanan') }}
                        </option>
                        <option value="Tahunan" {{ $rental->due_type == 'Tahunan'  ? 'selected' : '' }}>
                            {{ __('Tahunan') }}
                        </option>
                    </select>
                </div>
            </div>
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