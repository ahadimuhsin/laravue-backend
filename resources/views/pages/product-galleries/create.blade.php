@extends('layouts.default')
@section('title')
Tambah Galeri Produk
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4><strong>Tambah Galeri Produk</strong></h4>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('product-gallery.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name" class="form-control-label">Nama Produk</label>
            {{-- <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
             --}}
             <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                 @foreach($products as $product)
                 <option value="{{ old('product_id') ? old('product_id') : $product->id }}">{{ $product->name }}</option>
                 @endforeach
             </select>

            @error('product-id')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo" class="form-control-label">Foto Produk</label>
            <input type="file" name="photo" accept="image/*"
            class="form-control @error('photo') is-invalid @enderror" value="{{ old('photo') }}">

            @error('photo')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_default" class="form-control-label">Default Foto Produk</label>
            <br>
            <label>
                <input type="checkbox" name="is_default"
            class="form-control @error('is_default') is-invalid @enderror" value="1">Ya
            </label>
            &nbsp;
            <label>
                <input type="checkbox" name="is_default"
            class="form-control @error('is_default') is-invalid @enderror" value="0">Tidak
            </label>

            @error('is_default')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
                Tambah Foto Produk
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
