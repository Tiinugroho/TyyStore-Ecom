@extends('admin.layouts.layout')
@section('title', 'Data Barang Masuk')
@section('page-name', 'Data Barang Masuk')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Data Barang Masuk</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <button id="export-csv" class="btn app-btn-secondary">Export CSV</button>
                            </div>
                            <div class="col-auto">
                                <form id="search-form" class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="date" id="search-orders" name="searchorders"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="dataTable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cell sortable">No<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Nama Vendor<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Gambar<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Nama Barang<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Kode<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Quantity<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Harga Beli Akhir<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Saldo Sebelum<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Saldo Setelah<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Tanggal<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Status<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Kode Status<i class="fas fa-sort sort-icon"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = $barangmasuk->firstItem(); // Nomor indeks dimulai dari halaman saat ini
                                            $isFirst = true; // Tandai bahwa ini adalah iterasi pertama
                                        @endphp
                                        @foreach ($barangmasuk as $item)
                                            <tr>
                                                <td class="cell"><span class="truncate">{{ $no }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $item->namavendor }}</span></td>
                                                <td class="cell"><img class="img-fluid"
                                                        src="{{ asset('image/' . $item->cover) }}" alt="cover"
                                                        width="100"></td>
                                                <td class="cell">
                                                    <span class="truncate">
                                                        @if ($item->status == 'masuk' || $item->status == 'keluar' || $item->status == 'return beli'|| $item->status == 'return jual')
                                                            {{ $item->nama_barang ? $item->nama_barang : 'Tidak Ada' }}
                                                        @else
                                                            {{ $item->pesanan_id ? $item->nama_barang : 'Tidak Ada' }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="cell"><span class="truncate">{{ $item->kode }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $item->jumlah }}</span></td>
                                                <td class="cell"><span class="truncate">Rp.
                                                        {{ number_format($item->price) }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $item->saldo_sebelum }}</span>
                                                </td>
                                                <td class="cell"><span class="truncate">{{ $item->saldo_setelah }}</span>
                                                </td>
                                                <td class="cell"><span class="truncate">{{ $item->tanggal }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $item->status }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $item->kode_status }}</span></td>
                                                
                                            </tr>
                                            @php
                                                $no++; // Increment nomor indeks
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-auto">
                            <!-- Showing information -->
                            Showing {{ $barangmasuk->firstItem() }} to {{ $barangmasuk->lastItem() }} of
                            {{ $barangmasuk->total() }} entries
                        </div>
                        <div class="col-auto ms-auto">
                            <!-- Pagination buttons -->
                            <nav class="app-pagination">
                                <ul class="pagination justify-content-center">
                                    <!-- Tombol Halaman Sebelumnya -->
                                    @if ($barangmasuk->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $barangmasuk->previousPageUrl() }}"
                                                aria-label="Previous">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Tombol Halaman -->
                                    @for ($i = 1; $i <= $barangmasuk->lastPage(); $i++)
                                        <li class="page-item {{ $i == $barangmasuk->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $barangmasuk->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Halaman Berikutnya -->
                                    @if ($barangmasuk->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $barangmasuk->nextPageUrl() }}"
                                                aria-label="Next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div><!--//col-->
                    </div><!--//row-->
                </div>
            </div>
        </div>
    </div>



@endsection
