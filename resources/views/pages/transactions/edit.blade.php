@extends('layouts.default')
@section('title')
Edit Data Transaksi
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4><strong>Edit Transaksi</strong></h4>
        <p>{{ $item->uuid }}</p>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('transactions.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-control-label">Nama Pemesan</label>
            <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') ? old('name') : $item->name }}">

            @error('name')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-control-label">Email</label>
            <input type="email" name="email"
            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : $item->email }}">

            @error('email')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="number" class="form-control-label">Nomor HP</label>
            <input type="text" name="number"
            class="form-control @error('number') is-invalid @enderror" value="{{ old('number') ? old('number') : $item->number }}">

            @error('number')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address" class="form-control-label">Alamat Pemesan</label>
            <textarea type="text" name="address"
            class="ckeditor form-control @error('address') is-invalid @enderror" rows="5">{{ old('address') ? old('address') : $item->address }}</textarea>

            @error('address')
            <div class="text-muted">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
                Update Transaksi
            </button>
        </div>
        </form>
    </div>
</div>
@endsection

@push('after-script')
<script>
    CKEditor.replace('address');
</script>
@endpush
