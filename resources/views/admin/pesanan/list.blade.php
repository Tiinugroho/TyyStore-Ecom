@extends('admin.layouts.layout')
@section('title', 'Data Stok Barang')
@section('page-name', 'Data Stok Barang')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Orders</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">

                                <select class="form-select w-auto">
                                    <option selected value="option-1">All</option>
                                    <option value="option-2">This week</option>
                                    <option value="option-3">This month</option>
                                    <option value="option-4">Last 3 months</option>

                                </select>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="#">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    Download CSV
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Nama User</th>
                                            <th class="cell">Produk</th>
                                            <th class="cell">Nama Barang</th>
                                            <th class="cell">Jumlah Pesanan</th>
                                            <th class="cell">Harga Total</th>
                                            <th class="cell">Tanggal Pembelian</th>
                                            <th class="cell">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            use Illuminate\Support\Facades\DB;
                                            $result=DB::table('tbpesanans')
                                            ->leftjoin ('users','users.id','=','tbpesanans.id_user')
                                            ->leftjoin ('tbstok','tbstok.id','=','tbpesanans.id_barang',)
                                            ->select('tbpesanans.*','users.username as username','tbstok.nama_barang as namabarang','tbstok.cover as cover')
                                            ->orderby('tbpesanans.id', 'DESC')
                                            ->get();
                                            $no = 0;
                                            foreach ($result as $key => $value) {
                                                $no++ ;
                                                $bgClass = '';
                                                
                                                if ($value->status == 'completed') {
                                                    $bgClass = 'bg-success text-white';
                                                } elseif ($value->status == 'returned') {
                                                    $bgClass = 'bg-danger text-white';
                                                }
                                                ?>
                                        <tr>
                                            <td class="cell"><span class="truncate">{{ $no }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->username }}</span></td>
                                            <td class="cell">
                                                <span class="truncate">
                                                <img class="img-fluid" src="{{ asset('image/' . $value->cover) }}" alt="cover" width="100">
                                                </span>
                                            </td>
                                            <td class="cell"><span class="truncate">{{ $value->namabarang }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->jumlah_pesan }}</span></td>
                                            <td class="cell"><span class="truncate">Rp.
                                                    {{ number_format($value->jumlah_harga) }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->tanggal }}</span></td>
                                            <td class="cell"><span
                                                    class="{{ $bgClass }} p-2 rounded">{{ $value->status }}</span>
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
        </div>
    </div>
@endsection
