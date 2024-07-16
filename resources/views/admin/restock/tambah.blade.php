@extends('admin.layouts.layout')

@section('title', 'Tambah Stok')
@section('page-name', 'Tambah Stok')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="container p-4">
                                <h1 class="app-page-title">Tambah Stok untuk {{ $barang->nama_barang }}</h1>
                                <h3>
                                    <img class="img-fluid" src="{{ asset('image/' . $barang->cover) }}" alt="cover"
                                        width="100">
                                </h3>
                                <form action="{{ route('admin.restock.store', ['id' => $barang->id]) }}" method="POST">
                                    @csrf

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-label mt-2">Nama Vendor</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $barang->pemasok->nama }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-label mt-2">Stok Awal</label>
                                                    <input type="number" class="form-control" placeholder="Stok Awal"
                                                        value="{{ $barang->saldoawal }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-label mt-2">Stok Akhir</label>
                                                    <input type="number" class="form-control" placeholder="Stok Awal"
                                                        value="{{ $barang->saldoakhir }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jumlah" class="form-label mt-2">Jumlah Stok yang Akan
                                                        Ditambah</label>
                                                    <input type="number" name="jumlah" class="form-control" id="jumlah"
                                                        placeholder="Masukkan jumlah stok" required>
                                                </div><br>
                                                <button type="submit" class="btn app-btn-secondary">Tambah Stok</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
