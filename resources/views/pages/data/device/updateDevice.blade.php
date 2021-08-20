@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Device'))
@section('titleContent', __('Edit Device'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Device') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Device') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $device->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('device.update',$device->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama') }}<code>*</code></label>
                        <input type="text" value="{{ $device->name }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                        @error('name')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Merk') }}<code>*</code></label>
                        <input type="text" value="{{ $device->type }}"
                            class="form-control @error('type') is-invalid @enderror" name="type" required>
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
                        <label>{{ __('No HP') }}<code>*</code></label>
                        <input type="text" value="{{ $device->no }}"
                            class="form-control @error('no') is-invalid @enderror" name="no" required>
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
                                <input type="radio" name="wa" value="Ya" class="selectgroup-input"
                                    {{ $device->wa == 'Ya' ? 'checked' : '' }}>
                                <span class="selectgroup-button">{{ __('Ya') }}</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="wa" value="Tidak" class="selectgroup-input"
                                    {{ $device->wa == 'Tidak' ? 'checked' : '' }}>
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
                        <label>{{ __('Kode HP') }}<code>*</code></label>
                        <input type="text" value="{{ $device->code_phone }}"
                            class="form-control @error('code_phone') is-invalid @enderror" name="code_phone" required>
                        @error('code_phone')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Kode Kartu') }}<code>*</code></label>
                        <input type="text" value="{{ $device->code_card }}"
                            class="form-control @error('code_card') is-invalid @enderror" name="code_card" required>
                        @error('code_card')
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
                        <input type="text" value="{{ $device->active }}"
                            class="form-control datepicker @error('active') is-invalid @enderror" name="active"
                            required>
                        @error('active')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Divisi') }}<code>*</code></label>
                        <select class="form-control select2 @error('division') is-invalid @enderror" name="division"
                            required>
                            @foreach ($division as $d)
                            <option value="{{ $d->id }}" {{ $device->division == $d->id ? 'selected' : '' }}>
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
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection