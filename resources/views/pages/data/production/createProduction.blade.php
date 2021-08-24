@extends('layouts.default')
@section('title', __('pages.title').__(' | Tambah Alat Produksi'))
@section('titleContent', __('Tambah Alat Produksi'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Alat Produksi') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Alat Produksi') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('production.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $code }}" name="code">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama Alat Produksi') }}<code>*</code></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required
                            autofocus>
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
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand"
                            required>
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
                        <input type="text" class="form-control currency @error('qty') is-invalid @enderror" name="qty"
                            required>
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
                            <input type="text" class="form-control currency @error('price_acq') is-invalid @enderror"
                                name="price_acq" required>
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
                        <input type="month" class="form-control @error('date_acq') is-invalid @enderror" name="date_acq"
                            required>
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
                        <input type="radio" name="condition" value="1" class="selectgroup-input" checked>
                        <span class="selectgroup-button">{{ __('Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="2" class="selectgroup-input">
                        <span class="selectgroup-button">{{ __('Tidak Ada') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="3" class="selectgroup-input">
                        <span class="selectgroup-button">{{ __('Rusak') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="condition" value="4" class="selectgroup-input">
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
                <label>{{ __('Kategori') }}<code>*</code></label>
                <select class="form-control select2 @error('category') is-invalid @enderror" name="category" required>
                    @foreach ($category as $c)
                    <option value="{{ $c->id }}">
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
                <textarea type="text" class="form-control @error('info') is-invalid @enderror" name="info" cols="150"
                    rows="10" style="height: 77px;"></textarea>
                @error('info')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="section-title mt-0">{{ __('Gambar') }}</div>
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
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.add') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var img = document.getElementById("img");
$("#img").on("change", function () {
    var imgList = [];
    for (var i = 0; i < img.files.length; i++) {
        imgList.push(img.files[i]);
    }
    $("#img_label").html(imgList.length + " Foto");
});

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