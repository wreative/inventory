@extends('layouts.default')
@section('title', __('pages.title').__(' | Tambah Persewaan Gedung'))
@section('titleContent', __('Tambah Persewaan Gedung'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Persewaan Gedung') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Persewaan Gedung') }}</div>
@endsection

@section('content')
<h2 class="section-title">{{ $code }}</h2>
<p class="section-lead">
    {{ __('ID yang digunakan untuk mengidentifikasi setiap item') }}
</p>
<div class="card">
    <form method="POST" action="{{ route('rental.store') }}">
        @csrf
        <input type="hidden" value="{{ $code }}" name="code">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Nama Gedung') }}<code>*</code></label>
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
                        <label>{{ __('Alamat') }}<code>*</code></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            required>
                        @error('address')
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
                        <label>{{ __('No PBB') }}</label>
                        <input type="text" class="form-control @error('pbb') is-invalid @enderror" name="pbb">
                        @error('pbb')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">{{ __('Status Gedung') }}<code>*</code></label>
                        <div class="selectgroup w-100" id="rental">
                            <label class="selectgroup-item">
                                <input type="radio" name="rental" value="1" class="selectgroup-input" checked>
                                <span class="selectgroup-button">{{ __('Sewa') }}</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="rental" value="2" class="selectgroup-input">
                                <span class="selectgroup-button">{{ __('Hak Milik') }}</span>
                            </label>
                        </div>
                        @error('rental')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Kosongkan Kolom') }}</label>
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="checkbox" name="pln_null" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">{{ __('Kolom PLN') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="checkbox" name="pdam_null" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">{{ __('Kolom PDAM') }}</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="checkbox" name="wifi_null" value="1" class="selectgroup-input">
                        <span class="selectgroup-button">{{ __('Kolom Indihome') }}</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('No Token PLN') }}</label>
                        <input type="text" class="form-control @error('pln') is-invalid @enderror" name="pln">
                        @error('pln')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Jatuh Tempo PLN') }}</label>
                        <input type="text" class="form-control datepicker @error('due_pln') is-invalid @enderror"
                            name="due_pln">
                        @error('due_pln')
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
                        <label>{{ __('No PDAM') }}</label>
                        <input type="text" class="form-control @error('pdam') is-invalid @enderror" name="pdam">
                        @error('pdam')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Jatuh Tempo PDAM') }}</label>
                        <input type="text" class="form-control datepicker @error('due_pdam') is-invalid @enderror"
                            name="due_pdam">
                        @error('due_pdam')
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
                        <label>{{ __('No Indihome') }}</label>
                        <input type="text" class="form-control @error('wifi') is-invalid @enderror" name="wifi">
                        @error('wifi')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Tanggal Jatuh Tempo Indihome') }}</label>
                        <input type="text" class="form-control datepicker @error('due_wifi') is-invalid @enderror"
                            name="due_wifi">
                        @error('due_wifi')
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
                        <label>{{ __('Tanggal Jatuh Tempo') }}<code>*</code></label>
                        <input type="text" class="form-control datepicker @error('due') is-invalid @enderror" name="due"
                            required>
                        @error('due')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{ __('Jenis Jatuh Tempo Gedung') }}<code>*</code></label>
                        <select class="form-control selectric @error('due_type') is-invalid @enderror" name="due_type"
                            required>
                            <option value="Bulanan">
                                {{ __('Bulanan') }}
                            </option>
                            <option value="Tahunan">
                                {{ __('Tahunan') }}
                            </option>
                        </select>
                        @error('due_type')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
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
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.add') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/rentalStored.js') }}"></script>
@endsection