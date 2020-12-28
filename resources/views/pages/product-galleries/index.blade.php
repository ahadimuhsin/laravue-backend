@extends('layouts.default')
@section('title')
Data Galeri Produk
@endsection

@section('content')
<div class="orders"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Galeri Produk</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Foto</th>
                                    <th>Default</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                @php $i = 1; @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        <img src="{{ url($item->photo) }}" alt=""/>
                                    </td>
                                    <td>{{ $item->is_default ? 'Ya' : 'Tidak'}}</td>
                                    <td>
                                        {{-- <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a> --}}web
                                        <form action="{{ route('product-gallery.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin mau hapus data {{ $item->product->name }} ?')" class="d-inline">
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
                                    <td colspan="5" class="text-center p-5">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        {{ $items->appends(Request::all())->links() }}
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


