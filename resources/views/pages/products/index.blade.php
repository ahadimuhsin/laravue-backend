@extends('layouts.default')
@section('title')
Data Produk
@endsection

@section('content')
<div class="orders"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Produk</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ formatRupiah($product->price) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{ route('products.gallery', $product->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-picture-o"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('Yakin mau hapus data {{ $product->name }} ?')" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm destroy" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        {{ $products->appends(Request::all())->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


