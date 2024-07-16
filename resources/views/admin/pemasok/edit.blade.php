@extends('admin.layouts.layout')
@section('title', 'Edit Data Pemasok Barang')
@section('page-name', 'Edit Data Pemasok Barang')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Edit Data Pemasok Barang</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">

                <div class="col-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <?php
                            $rec = \DB::table('tbpemasok')->where('id', $id)->first();
                            ?>
                            <form action="{{ url('/admin/pemasok/' . $id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Nama Vendor</label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    placeholder="Nama Vendor" value="{{ $rec->nama }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">No Telp</label>
                                                <input type="text" class="form-control" name="nohp" id="nohp"
                                                    placeholder="No Telp" value="{{ $rec->nohp }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat"
                                                    placeholder="Alamat" value="{{ $rec->alamat }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Tanggal Kerja Sama</label>
                                                <input type="datetime-local" class="form-control" name="top" id="top"
                                                    placeholder="Tanggal Kerja Sama" value="{{ $rec->top }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <br>
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
