@extends('admin.layouts.layout')
@section('title', 'Data Mutasi')
@section('page-name', 'Data Mutasi')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <!-- Konten tabel -->
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="dataTable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cell sortable">No<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">No Bukti<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Jumlah<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Harga Sub Total<i class="fas fa-sort sort-icon"></i>
                                            </th>
                                            <th class="cell sortable">Tanggal<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Status<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Kode Status<i class="fas fa-sort sort-icon"></i></th>
                                            <th class="cell sortable">Aksi<i class="fas fa-sort sort-icon"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = $barang->firstItem(); // Nomor indeks dimulai dari halaman saat ini
                                        @endphp
                                        @foreach ($barang as $value)
                                            <tr>
                                                <td class="cell"><span class="truncate">{{ $no }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $value->no_bukti }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $value->total_qty }}</span>
                                                </td>
                                                <td class="cell"><span class="truncate">Rp.
                                                        {{ number_format($value->total_harga) }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $value->tanggal }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $value->status }}</span></td>
                                                <td class="cell"><span class="truncate">{{ $value->mk }}</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-detail"
                                                        data-bs-toggle="modal" data-bs-target="#detailModal"
                                                        data-no-bukti="{{ $value->no_bukti }}">
                                                        <i class="text-white fas fa-eye"></i>
                                                    </button>
                                                </td>
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

                    <!-- Informasi paginasi -->
                    <div class="row mb-4">
                        <div class="col-auto">
                            Showing {{ $barang->firstItem() }} to {{ $barang->lastItem() }} of {{ $barang->total() }}
                            entries
                        </div>
                        <div class="col-auto ms-auto">
                            <!-- Pagination buttons -->
                            <nav class="app-pagination">
                                <ul class="pagination justify-content-center">
                                    <!-- Tombol Halaman Sebelumnya -->
                                    @if ($barang->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $barang->previousPageUrl() }}"
                                                aria-label="Previous">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Tombol Halaman -->
                                    @for ($i = 1; $i <= $barang->lastPage(); $i++)
                                        <li class="page-item {{ $i == $barang->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $barang->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Halaman Berikutnya -->
                                    @if ($barang->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $barang->nextPageUrl() }}"
                                                aria-label="Next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody id="modal-body-content">
                            <!-- Konten tabel modal akan diisi melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.btn-detail');

            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const noBukti = this.getAttribute('data-no-bukti');

                    // Fetch data based on no_bukti
                    fetch(`/api/barang/${noBukti}`)
                        .then(response => response.json())
                        .then(data => {
                            const modalBodyContent = document.getElementById(
                                'modal-body-content');
                            modalBodyContent.innerHTML = '';

                            data.items.forEach(item => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${item.barang}</td>
                            <td>${item.qty}</td>
                            <td>Rp. ${new Intl.NumberFormat().format(item.harga)}</td>
                        `;
                                modalBodyContent.appendChild(row);
                            });
                        })
                        .catch(error => console.error('Error fetching data:', error));
                });
            });
        });
    </script>

@endsection
