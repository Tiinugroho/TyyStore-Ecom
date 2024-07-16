@extends('admin.layouts.layout')
@section('title', 'Edit Data Slider')
@section('page-name', 'Edit Data Slider')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Edit Data Slider</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">

                <div class="col-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <?php
                            $rec = \DB::table('tbsliders')->where('id', $id)->first();
                            ?>
                            <form action="{{ url('/admin/slider/' . $id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="foto" class="form-label">Upload Foto</label>
                                                <input class="form-control" type="file" name="foto" id="foto">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pajang" class="form-label">Pajang</label>
                                                <select class="form-control" name="pajang" id="pajang">
                                                    <option value="" selected disabled>Pilih Pajang</option>
                                                    <option value="ya" {{ $rec->pajang == 'ya' ? 'selected' : '' }}>Ya
                                                    </option>
                                                    <option value="tidak" {{ $rec->pajang == 'tidak' ? 'selected' : '' }}>
                                                        Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label">Tanggal Masuk</label>
                                                <input type="date" class="form-control" name="tglmasuk"
                                                    placeholder="Tanggal Masuk" value="{{ $rec->tglmasuk }}">
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
