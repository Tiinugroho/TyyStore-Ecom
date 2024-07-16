@extends('admin.layouts.layout')
@section('title', 'Tambah Data Stok Barang')
@section('page-name', 'Tambah Data Stok Barang')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Tambah Data Stok Barang</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">

                <div class="col-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form action="{{ url('admin/barang') }}" method="post" enctype="multipart/form-data"
                                class="settings-form">
                                @csrf <!-- csrf token -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_barang" class="form-label mt-2">Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang"
                                                    id="nama_barang" placeholder="Nama Barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Satuan</label>
                                                <select class="form-control" name="id_satuan" id="id_satuan" required>
                                                    <option value="" selected disabled>Pilih Satuan</option>
                                                    <?php
                                                    $rec = App\Models\tbsatuan::all();
                                                    foreach ($rec as $data) {
                                                        echo "<option value=\"$data->id\">$data->nama</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Kategori</label>
                                                <select class="form-control" name="id_kategori" id="id_kategori" required>
                                                    <option value="" selected disabled>Pilih Kategori</option>
                                                    <?php
                                                    $rec = App\Models\tbkategori::all();
                                                    foreach ($rec as $data) {
                                                        echo "<option value=\"$data->id\">$data->nama</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Stok Awal</label>
                                                <input type="number" class="form-control" name="saldoawal"
                                                    placeholder="Stok Awal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Harga Beli Akhir</label>
                                                <input type="number" class="form-control" name="hargabeliakhir"
                                                    placeholder="Harga Beli Akhir" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Harga Jual</label>
                                                <input type="number" class="form-control" name="hargajual"
                                                    placeholder="Harga Jual" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Tanggal Masuk</label>
                                                <input type="date" class="form-control" name="tglmasuk"
                                                    placeholder="Tanggal Masuk" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Cover Produk</label>
                                                <input type="file" class="form-control" name="cover" id="formfile"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Foto</label>
                                                <input type="file" class="form-control" name="foto[]" id="formfile"
                                                    multiple required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Pajang</label>
                                                <select class="form-control" name="pajang" required>
                                                    <option value="" selected disabled>Pilih Pajang</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label mt-2">Deskripsi</label>
                                        <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn app-btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
