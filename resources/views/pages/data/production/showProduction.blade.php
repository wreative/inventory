@extends('layouts.default')
@section('title', __('pages.title').__(' | Lihat Alat Produksi'))
@section('titleContent', __('Lihat Alat Produksi'))
@section('headerBack')
<div class="section-header-back">
    <a href="{{ route('production.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
@endsection
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
<div class="breadcrumb-item active">{{ __('Lihat Alat Produksi') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $production->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Nama Alat Produksi') }}</label>
                    <input type="text" class="form-control" value="{{ $production->name }}" name="name" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Merk') }}</label>
                    <input type="text" class="form-control" value="{{ $production->brand }}" name="brand" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Jumlah') }}</label>
                    <input type="text" class="form-control" value="{{ $production->qty }}" name="qty" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">{{ __('Kondisi') }}</label>
            <div class="selectgroup w-100" id="condition">
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="1" class="selectgroup-input"
                        {{ $production->condition == 'Ada' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Ada') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="2" class="selectgroup-input"
                        {{ $production->condition == 'Tidak Ada' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Tidak Ada') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="3" class="selectgroup-input"
                        {{ $production->condition == 'Rusak' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Rusak') }}</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="condition" value="4" class="selectgroup-input"
                        {{ $production->condition == 'Hilang' ? 'checked' : 'disabled' }}>
                    <span class="selectgroup-button">{{ __('Hilang') }}</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Kategori') }}<code>*</code></label>
            <select class="form-control @error('category') is-invalid @enderror" name="category" disabled>
                @foreach ($category as $c)
                <option value="{{ $c->id }}" {{ $production->category == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
                @endforeach
            </select>
            @error('category')
            <span class="text-danger" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Keterangan') }}</label>
            <textarea type="text" class="form-control" name="info" cols="150" rows="10" style="height: 77px;" readonly>
                    {{ $production->info }}
                </textarea>
        </div>
        @if($production->img != null)
        <div class="section-title mt-0">{{ __('Gambar') }}</div>
        <div class="gallery" data-item-height="100">
            @foreach(json_decode($production->img) as $i )
            <div class="gallery-item" data-image="{{ asset('storage')."/production/".$production->code."/".$i }}">
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection