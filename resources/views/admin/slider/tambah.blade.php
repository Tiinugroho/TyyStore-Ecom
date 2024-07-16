@extends('admin.layouts.layout')
@section('title', 'Tambah Data Slider')
@section('page-name', 'Tambah Data Slider')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Tambah Data Slider</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">

                <div class="col-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form action="{{ url('admin/slider') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Upload Foto Banner</label>
                                                <input class="form-control" type="file" name="foto" id="foto">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label">Pajang</label>
                                                <select class="form-control" name="pajang">
                                                    <option value="" selected disabled>Pilih Pajang</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label">Tanggal Masuk</label>
                                                <input type="date" class="form-control" name="tglmasuk"
                                                    placeholder="Tanggal Masuk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
