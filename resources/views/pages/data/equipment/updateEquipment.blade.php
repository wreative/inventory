@extends('layouts.default')
@section('title', __('pages.title').__(' | Edit Perlengkapan'))
@section('titleContent', __('Edit Perlengkapan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Perlengkapan') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Perlengkapan') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $equipment->code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('equipment.update',$equipment->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama Perlengkapan') }}<code>*</code></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $equipment->name }}" name="name" required autofocus>
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
                            value="{{ $equipment->brand }}" name="brand" required>
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
                            value="{{ $equipment->qty }}" name="qty" required>
                        @error('qty')
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
                        <label>{{ __('Harga Perolehan') }}<code>*</code></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Rp.') }}
                                </div>
                            </div>
                            <input type="text" value="{{ $equipment->price_acq }}"
                                class="form-control currency @error('price_acq') is-invalid @enderror" name="price_acq"
                                required>
                        </div>
                        @error('price_acq')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Perolehan') }}<code>*</code></label>
                        <input type="month" value="{{ $equipment->date_acq }}"
                            class="form-control @error('date_acq') is-invalid @enderror" name="date_acq" required>
                        @error('date_acq')
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
                            {{ $equipment->condition == 'Ada' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="2" class="selectgroup-input"
                            {{ $equipment->condition == 'Tidak Ada' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Tidak Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="3" class="selectgroup-input"
                            {{ $equipment->condition == 'Rusak' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ __('Rusak') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="4" class="selectgroup-input"
                            {{ $equipment->condition == 'Hilang' ? 'checked' : '' }}>
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
                    {{ $equipment->info }}
                </textarea>
                @error('info')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="section-title mt-0">{{ __('Gambar') }}</div>
            <div class="gallery" data-item-height="100">
                @foreach(json_decode($equipment->img) as $i )
                <div class="gallery-item" data-image="{{ asset('storage')."/equipment/".$equipment->code."/".$i }}">
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="img[]"
                        accept="image/png, image/jpeg, image/jpg, image/svg" id="img" multiple>
                    <label class="custom-file-label" for="img" id="img_label">{{ __('Pilih File') }}</label>
                </div>
                @error('img')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <div class="fileListDisplay"></div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(".currency")
    .toArray()
    .forEach(function(field) {
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: "thousand"
        });
    });
</script>
@endsection