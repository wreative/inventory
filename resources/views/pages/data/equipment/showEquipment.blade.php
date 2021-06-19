@extends('layouts.default')
@section('title', __('pages.title').__(' | Lihat Perlengkapan'))
@section('headerBack')
<div class="section-header-back">
    <a href="{{ route('equipment.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
@endsection
@section('titleContent', __('Lihat Perlengkapan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
<div class="breadcrumb-item active">{{ __('Lihat Perlengkapan') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $equipment->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Nama Perlengkapan') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $equipment->name }}" name="name" readonly>
                    @error('name')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Merk') }}</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                        value="{{ $equipment->brand }}" name="brand" readonly>
                    @error('brand')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Jumlah') }}</label>
                    <input type="text" class="form-control @error('qty') is-invalid @enderror"
                        value="{{ $equipment->qty }}" name="qty" readonly>
                    @error('qty')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">{{ __('Kondisi') }}</label>
            <div class="selectgroup w-100" id="condition">
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="1" class="selectgroup-input"
                        {{ $equipment->condition == 'Ada' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Ada') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="2" class="selectgroup-input"
                        {{ $equipment->condition == 'Tidak Ada' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Tidak Ada') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="3" class="selectgroup-input"
                        {{ $equipment->condition == 'Rusak' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Rusak') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="4" class="selectgroup-input"
                        {{ $equipment->condition == 'Hilang' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Hilang') }}</span>
                </label>
            </div>
            @error('condition')
            <span class="text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Keterangan') }}</label>
            <textarea type="text" class="form-control @error('info') is-invalid @enderror" name="info" cols="150"
                rows="10" style="height: 77px;" readonly>
                    {{ $equipment->info }}
                </textarea>
            @error('info')
            <span class="text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        @if($equipment->img != null)
        <div class="section-title mt-0">{{ __('Gambar') }}</div>
        <div class="gallery" data-item-height="100">
            @foreach(json_decode($equipment->img) as $i )
            <div class="gallery-item" data-image="{{ asset('storage')."/equipment/".$equipment->code."/".$i }}">
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection