@extends('client.layouts.layout')
@section('title', '- Cart')
@section('page-name', '- Cart')
@section('content')
    <main class="main">
        @if (Auth::check())
            <div class="page-header text-center"
                style="background-image: url('{{ url('client/assets/images/page-header-bg.jpg') }}')">
                <div class="container">
                    <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <!-- ... -->
            <div class="page-content">
                <div class="cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga Produk</th>
                                                <th>Jumlah</th>
                                                <th>Total Harga Produk</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $subtotal = 0; @endphp
                                            @foreach ($products as $produk)
                                                @php
                                                    $total_per_produk = $produk->tbstok->hargajual * $produk->jumlah_pesan;
                                                    $subtotal += $total_per_produk;
                                                @endphp
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img src="{{ asset('image/' . $produk->tbstok->cover) }}" alt="Product image">
                                                                </a>
                                                            </figure>
                                                            <h3 class="product-title">
                                                                <a href="#">{{ $produk->tbstok->nama_barang }}</a>
                                                            </h3>
                                                        </div>
                                                    </td>
                                                    <td class="price-col">Rp. {{ number_format($produk->tbstok->hargajual, 0, ',', '.') }}</td>
                                                    <td class="quantity-col">
                                                        <div class="cart-product-quantity">
                                                            <input type="number" class="form-control update-quantity" name="tbpesanan[{{ $produk->id }}][jumlah_pesan]" value="{{ $produk->jumlah_pesan }}" min="1" max="99" step="1" required data-price="{{ $produk->tbstok->hargajual }}">
                                                            <input type="hidden" name="tbpesanan[{{ $produk->id }}][id]" value="{{ $produk->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="total-col">Rp. <span class="total-per-product">{{ number_format($total_per_produk, 0, ',', '.') }}</span></td>
                                                    <td class="remove-col">
                                                        <button class="btn-remove" data-product-id="{{ $produk->id }}"><i class="icon-close"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="cart-bottom">
                                        <button type="submit" class="btn btn-outline-dark-2" id="update-cart"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                    </div>
                                </form>
                                <form id="delete-form" action="{{ route('cart.destroy', 'to-be-replaced-with-product-id') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3>
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>Rp. <span id="subtotal">{{ number_format($subtotal, 0, ',', '.') }}</span></td>
                                            </tr>
                                            <tr class="summary-shipping">
                                                <td>Shipping:</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                                    </div>
                                                </td>
                                                <td>Rp. 0.00</td>
                                            </tr>
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                                    </div>
                                                </td>
                                                <td>Rp. 0.00</td>
                                            </tr>
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="express-shipping">Express:</label>
                                                    </div>
                                                </td>
                                                <td>Rp. 0.00</td>
                                            </tr>
                                            <tr class="summary-shipping-estimate">
                                                <td>Estimasi Lokasi Kamu<br> <a href="{{ url('profile') }}">Ganti Alamat</a></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>Rp. <span id="total">{{ number_format($subtotal, 0, ',', '.') }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                </div>
                                <a href="{{ url('product') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteButtons = document.querySelectorAll('.btn-remove');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const productId = this.getAttribute('data-product-id');
                            const confirmDelete = confirm("Are you sure you want to delete this product?");

                            if (confirmDelete) {
                                document.getElementById('delete-form').action = `/cart/${productId}`;
                                document.getElementById('delete-form').submit();
                            }
                        });
                    });
                });
            </script>
        @else
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Anda harus login untuk melihat keranjang belanja. Silakan <a href="{{ route('login') }}">login</a>
                    atau
                    <a href="{{ url('register') }}">daftar</a> jika belum memiliki akun.
                </div>
            </div>
        @endif
    </main>
@endsection
