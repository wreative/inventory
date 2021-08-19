@extends('layouts.default')
@section('title', __('pages.title').__(' | Lihat Kendaraan'))
@section('titleContent', __('Lihat Kendaraan'))
@section('headerBack')
<div class="section-header-back">
    <a href="{{ route('vehicle.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
@endsection
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Kendaraan') }}</div>
<div class="breadcrumb-item active">{{ __('Lihat Kendaraan') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $vehicle->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Nama Kendaraan') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->name }}" class="form-control" name="name" autofocus readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Jenis') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->type }}" class="form-control" name="type" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Merk') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->brand }}" class="form-control" name="brand" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Plat') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->plat }}" class="form-control" name="plat" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Rangkah') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->step }}" class="form-control" name="step" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('No Mesin') }}<code>*</code></label>
                    <input type="text" value="{{ $vehicle->engine }}" class="form-control" name="engine" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Tanggal Kir') }}<code>*</code></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-calendar"></i>
                            </div>
                        </div>
                        <input type="text" value="{{ $vehicle->kir == null ? 'Tidak Ada' : $vehicle->kir }}"
                            class="form-control" name="kir" readonly>
                    </div>
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
                        <input type="text" value="{{ $vehicle->tax == null ? 'Tidak Ada' : $vehicle->tax }}"
                            class="form-control" name="tax" readonly>
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
                        <input type="text" value="{{ $vehicle->stnk == null ? 'Tidak Ada' : $vehicle->stnk }}"
                            class="form-control" name="stnk" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Keterangan') }}</label>
            <textarea type="text" class="form-control" name="info" cols="150" rows="10" style="height: 77px;" readonly>
                    {{ $vehicle->info }}
                </textarea>
        </div>
    </div>
</div>
@endsection