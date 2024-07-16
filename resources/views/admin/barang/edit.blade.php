@extends('admin.layouts.layout')
@section('title', 'Edit Data Stok Barang')
@section('page-name', 'Edit Data Stok Barang')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Edit Data Stok Barang</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">

                <div class="col-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <?php
                            $rec = \DB::table('tbstok')->where('id', $id)->first();
                            ?>
                            <form action="{{ url('/admin/barang/' . $id) }}" method="POST" enctype="multipart/form-data">
                                {{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}"> --}}
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang"
                                                    id="nama_barang" placeholder="Nama" value="{{ $rec->nama_barang }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Satuan</label>
                                                <select class="form-control" name="id_satuan" id="id_satuan">
                                                    <option value="" selected disabled>Pilih Satuan</option>
                                                    <?php
                                                    $recSatuan = App\Models\tbsatuan::all();
                                                    foreach ($recSatuan as $satuan) {
                                                        $select = $satuan->id == $rec->id_satuan ? 'selected' : '';
                                                        echo "<option value=\"{$satuan->id}\" $select>{$satuan->nama}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Kategori</label>
                                                <select class="form-control" name="id_kategori" id="id_kategori">
                                                    <option value="" selected disabled>Pilih Kategori</option>
                                                    <?php
                                                    $recKategori = App\Models\tbkategori::all();
                                                    foreach ($recKategori as $kategori) {
                                                        $select = $kategori->id == $rec->id_kategori ? 'selected' : '';
                                                        echo "<option value=\"{$kategori->id}\" $select>{$kategori->nama}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Stok Awal</label>
                                                <input type="number" class="form-control" name="saldoawal" id="saldoawal"
                                                    placeholder="Stok Awal" value="{{ $rec->saldoawal }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Harga Beli Akhir</label>
                                                <input type="number" class="form-control" name="hargabeliakhir"
                                                    id="hargabeliakhir" placeholder="Harga Beli Akhir"
                                                    value="{{ $rec->hargabeliakhir }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Harga Jual</label>
                                                <input type="number" class="form-control" name="hargajual" id="hargajual"
                                                    placeholder="Harga Jual" value="{{ $rec->hargajual }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Tanggal Masuk</label>
                                                <input type="date" class="form-control" name="tglmasuk"
                                                    placeholder="Tanggal Masuk" value="{{ $rec->tglmasuk }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label mt-2">Pajang</label>
                                                <select class="form-control" name="pajang" id="pajang">
                                                    <option value="" selected disabled>Pilih Pajang</option>
                                                    <option value="ya" {{ $rec->pajang == 'ya' ? 'selected' : '' }}>Ya
                                                    </option>
                                                    <option value="tidak" {{ $rec->pajang == 'tidak' ? 'selected' : '' }}>
                                                        Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cover Produk -->
                                    <div class="form-group">
                                        <label for="" class="form-label mt-2" class="form-label">Cover
                                            Produk</label>
                                        <input class="form-control" type="file" name="cover" id="cover">
                                        @if ($rec->cover)
                                            <img class="mt-3" src="{{ asset('image/' . $rec->cover) }}" alt="Cover Produk"
                                                style="width: 100px; height: 100px;">
                                        @endif
                                    </div>
                                    <!-- Upload Foto -->
                                    <div class="form-group">
                                        <label for="" class="form-label mt-2" class="form-label">Upload
                                            Foto</label>
                                        <input class="form-control" type="file" name="foto[]" id="foto"
                                            multiple>
                                        @if ($rec->foto)
                                            @php
                                                $fotos = json_decode($rec->foto);
                                            @endphp
                                            @foreach ($fotos as $foto)
                                                <img class="mt-3" src="{{ asset('image/' . $foto) }}"
                                                    alt="Foto Produk" style="width: 100px; height: 100px;">
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- Deskripsi -->
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label mt-2">Deskripsi</label>
                                        <textarea class="form-control" id="desc" name="desc" rows="5" cols="8">{{ $rec->desc }}</textarea>
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
