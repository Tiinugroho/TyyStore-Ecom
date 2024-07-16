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
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Kode</th>
                                            <th class="cell">Nama User</th>
                                            <th class="cell">Jumlah Pesanan</th>
                                            <th class="cell">Harga Total</th>
                                            <th class="cell">Tanggal Pembelian</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Bukti Transaksi</th>
                                            <th class="cell">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="cell">{{ $loop->iteration }}</td>
                                                <td class="cell">{{ $order->kode }}</td>
                                                <td class="cell">{{ $order->username }}</td>
                                                <td class="cell">{{ $order->quantity }}</td>
                                                <td class="cell">Rp. {{ number_format($order->price) }}</td>
                                                <td class="cell">{{ $order->created_at }}</td>
                                                <td class="cell">
                                                    <span
                                                        class="btn btn-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }} text-white btn-sm rounded">{{ ucfirst($order->status) }}</span>
                                                </td>
                                                <td class="cell">
                                                    @if ($order->bukti_transaksi)
                                                        <img src="{{ asset('bukti_transaksi/' . $order->bukti_transaksi) }}"
                                                            alt="Bukti Transaksi" width="100">
                                                    @else
                                                        <span>Tidak ada bukti</span>
                                                    @endif
                                                </td>
                                                <td class="cell">
                                                    @if ($order->status == 'pending')
                                                        <form action="{{ url('admin/checkout/approve', $order->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Apakah pembayaran sudah sesuai dengan pesanan ini?')"
                                                                class="btn btn-success btn-sm text-white">Setuju</button>
                                                        </form>
                                                        <br>
                                                        <form action="{{ url('admin/checkout/cancel', $order->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Apakah pembayaran tidak sesuai dengan pesanan ini?')"
                                                                class="btn btn-danger btn-sm text-white">Tolak</button>
                                                        </form>
                                                    @endif
                                                    <br>
                                                    @if ($order->status == 'completed')
                                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#returnModal{{ $order->id }}">
                                                            Return Pesanan
                                                        </button>
                                                    @endif
                                                    <br>
                                                    <a href="{{ route('admin.checkout.detail', $order->kode) }}"
                                                        class="btn btn-info btn-sm text-white">Detail</a>
                                                </td>
                                            </tr>

                                            @if (isset($detail) && $order->kode == $id)
                                                <tr>
                                                    <td colspan="9">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Barang</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($detail as $item)
                                                                    <tr>
                                                                        <td>{{ $item->tbstok->nama_barang }}</td>
                                                                        <td>{{ $item->jumlah_pesan }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($item->jumlah_harga, 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="text-right mt-3">
                                                            <a href="{{ url('/admin/checkout') }}" class="btn btn-close">
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif

                                            <!-- Modal -->
                                            <div class="modal fade" id="returnModal{{ $order->id }}" tabindex="-1"
                                                aria-labelledby="returnModalLabel{{ $order->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="returnModalLabel{{ $order->id }}">
                                                                Konfirmasi Return Barang
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ url('admin/checkout/return', $order->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin mereturn Pesanan <strong>{{$order->kode}}</strong> ?</p>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger text-white">Return
                                                                    Pesanan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
