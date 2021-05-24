@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Alat Produksi'))
@section('titleContent', __('Edit Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Alat Produksi') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $production->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('production.update',$production->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama') }}<code>*</code></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $production->name }}" name="name" required autofocus>
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
                        <input type="text" class="form-control @error('brand') is-invalid @enderror"
                            value="{{ $production->brand }}" name="brand" required>
                        @error('brand')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Jumlah') }}<code>*</code></label>
                        <input type="text" class="form-control @error('qty') is-invalid @enderror"
                            value="{{ $production->qty }}" name="qty" required>
                        @error('qty')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">{{ __('Kondisi') }}<code>*</code></label>
                <div class="selectgroup w-100" id="condition">
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="1" class="selectgroup-input"
                            {{ $production->condition == 'Ada' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="2" class="selectgroup-input"
                            {{ $production->condition == 'Tidak Ada' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Tidak Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="3" class="selectgroup-input"
                            {{ $production->condition == 'Rusak' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Rusak') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="4" class="selectgroup-input"
                            {{ $production->condition == 'Hilang' ? 'checked' : '' }}>
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
                    rows="10" style="height: 77px;">
                    {{ $production->info }}
                </textarea>
                @error('info')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
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
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection