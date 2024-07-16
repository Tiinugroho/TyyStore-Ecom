@extends('client.layouts.layout')
@section('title', '- Checkout')
@section('page-name', '- Checkout')
@section('content')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ url('client/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="summary">
                                    <h3 class="summary-title">Billing Details</h3>
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr>
                                                <td>Full Name:</td>
                                                <td>{{ Auth::user()->username }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone Number:</td>
                                                <td>{{ Auth::user()->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td>{{ Auth::user()->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3>
                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $subtotal = 0; @endphp
                                            @foreach ($products as $produk)
                                                <input type="hidden"
                                                    name="products[{{ $produk->id }}][tbstok][hargajual]"
                                                    value="{{ $produk->tbstok->hargajual }}">
                                                <input type="hidden" name="products[{{ $produk->id }}][jumlah_pesan]"
                                                    value="{{ $produk->jumlah_pesan }}">
                                                @php
                                                    $total_per_produk =
                                                        $produk->tbstok->hargajual * $produk->jumlah_pesan;
                                                    $subtotal += $total_per_produk;
                                                @endphp
                                                <tr>
                                                    <td>{{ $produk->tbstok->nama_barang }}</td>
                                                    <td>{{ $produk->jumlah_pesan }}</td>
                                                    <td>Rp. {{ number_format($produk->tbstok->hargajual, 2) }}</td>
                                                    <td>Rp. {{ number_format($total_per_produk, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td colspan="3">Rp. {{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping:</td>
                                                <td colspan="3">Free shipping</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td colspan="3">Rp. {{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="form-group">
                                                        <label for="bukti_transaksi">Upload Proof of Payment</label>
                                                        <input type="file" class="form-control" name="bukti_transaksi"
                                                            id="bukti_transaksi" required>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- QR Code -->
                                    <div class="qr-code">
                                        {!! QrCode::size(200)->generate(route('checkout')) !!}
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
