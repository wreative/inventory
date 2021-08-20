@extends('layouts.default')
@section('title', __('pages.title').__(' | Lihat Device'))
@section('titleContent', __('Lihat Device'))
@section('headerBack')
<div class="section-header-back">
    <a href="{{ route('device.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
@endsection
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Device') }}</div>
<div class="breadcrumb-item active">{{ __('Lihat Device') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $device->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Nama') }}</label>
                    <input type="text" value="{{ $device->name }}" class="form-control" name="name" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Merk') }}</label>
                    <input type="text" value="{{ $device->type }}" class="form-control" name="type" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No HP') }}</label>
                    <input type="text" value="{{ $device->no }}" class="form-control" name="no" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="form-label">{{ __('Whatsapp') }}</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="wa" value="Ya" class="selectgroup-input"
                                {{ $device->wa == 'Ya' ? 'checked' : '' }} disabled>
                            <span class="selectgroup-button">{{ __('Ya') }}</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="wa" value="Tidak" class="selectgroup-input"
                                {{ $device->wa == 'Tidak' ? 'checked' : '' }} disabled>
                            <span class="selectgroup-button">{{ __('Tidak') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Kode HP') }}</label>
                    <input type="text" value="{{ $device->code_phone }}" class="form-control" name="code_phone"
                        readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Kode Kartu') }}<code>*</code></label>
                    <input type="text" value="{{ $device->code_card }}" class="form-control" name="code_card" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Masa Aktif') }}</label>
                    <input type="text" value="{{ $device->active }}" class="form-control" name="active" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Divisi') }}</label>
                    <select class="form-control" name="division" disabled>
                        @foreach ($division as $d)
                        <option value="{{ $d->id }}" {{ $device->division == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection