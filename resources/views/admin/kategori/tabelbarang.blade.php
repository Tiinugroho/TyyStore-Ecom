<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Barang</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Data Barang </h3> --}}
                        <a href="" class="btn btn-primary">Tambah Barang</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th class="export-exclude">AKSI</th>
                                    <th class="export-exclude">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                            use Illuminate\Support\Facades\DB;
                                            
                                            $no = 0;
                                            foreach ($result as $key => $value) {
                                                $no++ ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>
                                        <a href="{{ url('#/' . $value->id) }}" class="btn btn-success"><i
                                                class="fas fa-edit"></i> Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('/' . $value->id) }}" method="post">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('Anda Yakin Menghapus?')"
                                                class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                            }
                                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
