@extends('admin.layouts.layout')
@section('title', 'Data Pemasok Barang')
@section('page-name', 'Data Pemasok Barang')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-md-8">
                    <h1 class="app-page-title mb-0">Data Pemasok Barang</h1>
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
                                <a href="{{ url('admin/pemasok/create') }}" class="btn app-btn-secondary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 1a.5.5 0 0 1 .5.5v6h6a.5.5 0 0 1 0 1h-6v6a.5.5 0 0 1-1 0v-6h-6a.5.5 0 0 1 0-1h6v-6A.5.5 0 0 1 8 1z" />
                                    </svg>
                                    Tambah Data
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
                                <table id="dataTable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cell sortable" data-column="1">No <i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable" data-column="2">Kode <i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable" data-column="3">Nama Vendor <i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable" data-column="4">Alamat</th>
                                            <th class="cell sortable" data-column="5">No Telp</th>
                                            <th class="cell sortable" data-column="6">Tanggal Kerja Sama</th>
                                            <th class="cell">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = $result->firstItem(); // Nomor indeks dimulai dari halaman saat ini
                                        @endphp
                                        @foreach ($result as $key => $value)
                                        <tr>
                                            <td class="cell"><span class="truncate">{{ $no }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->kode }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->nama }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->alamat }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->nohp }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $value->top }}</span></td>
                                            <td class="cell">
                                                <a href="{{ url('admin/pemasok/' . $value->id) }}" class="btn btn-success btn-sm text-white">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('admin/pemasok', $value->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm('Apakah yakin anda ingin menghapus?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $no++; // Increment nomor indeks
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <div class="row mb-4">
                        <div class="col-auto">
                            <!-- Showing information -->
                            Showing {{ $result->firstItem() }} to {{ $result->lastItem() }} of {{ $result->total() }}
                            entries
                        </div>
                        <div class="col-auto ms-auto">
                            <!-- Pagination buttons -->
                            <nav class="app-pagination">
                                <ul class="pagination justify-content-center">
                                    <!-- Tombol Halaman Sebelumnya -->
                                    @if ($result->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $result->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Tombol Halaman -->
                                    @for ($i = 1; $i <= $result->lastPage(); $i++)
                                        <li class="page-item {{ $i == $result->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $result->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Halaman Berikutnya -->
                                    @if ($result->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $result->nextPageUrl() }}" aria-label="Next">&raquo;</a>
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
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection
