@extends('layouts.default')
@section('title')
Tambah Data Produk
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4><strong>Tambah Produk</strong></h4>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name" class="form-control-label">Nama Produk</label>
            <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

            @error('name')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type" class="form-control-label">Tipe Produk</label>
            <input type="text" name="type"
            class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}">

            @error('type')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-control-label">Deskripsi Produk</label>
            <textarea name="description"  class="ckeditor form-control @error('description') is-invalid @enderror"
            rows="10">{{ old('description') }}</textarea>

            @error('description')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price" class="form-control-label">Harga Produk (Rp)</label>
            <input type="text" name="price"
            class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" onkeyup="formatRupiah(this, '')">

            @error('price')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity" class="form-control-label">Kuantitas Barang</label>
            <input type="number" name="quantity"
            class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">

            @error('quantity')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
                Tambah Barang
            </button>
        </div>
        </form>
    </div>
</div>
@endsection

@push('after-script')
<script>
    CKEditor.replace('description');
</script>
@endpush
