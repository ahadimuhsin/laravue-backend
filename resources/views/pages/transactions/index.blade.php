@extends('layouts.default')
@section('title')
Data Transaksi
@endsection

@section('content')
<div class="orders"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Transaksi Masuk</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor</th>
                                    <th>Alamat</th>
                                    <th>Total Transaksi</th>
                                    <th>Status Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                @php $i = 1; @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{!!$item->address !!}</td>
                                    <td>{{ formatRupiah($item->transaction_total) }}</td>
                                    <td>
                                        @if( $item->transaction_status == 'PENDING')
                                            <span class="badge badge-info">
                                        @elseif($item->transaction_status == 'SUCCESS')
                                            <span class="badge badge-success">
                                        @elseif($item->transaction_status == 'FAILED')
                                            <span class="badge badge-danger">
                                        @else
                                            <span>
                                        @endif
                                                {{ $item->transaction_status }}
                                            </span>

                                    </td>
                                    <td>
                                        @if($item->transaction_status == 'PENDING')
                                            <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-sm"
                                                title="Success">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            <a href="{{ route('transactions.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-sm"
                                                title="Failed">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        @endif
                                        <a
                                        href="#showDetail"
                                        data-remote="{{ route('transactions.show', $item->id) }}"
                                        data-toggle="modal"
                                        data-target="#showDetail"
                                        data-title="Detail Transaksi {{ $item->uuid }}"
                                        class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin mau hapus data {{ $item->uuid }} ?')" class="d-inline">
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
                                    <td colspan="8" class="text-center p-5">Data Kosong</td>
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


