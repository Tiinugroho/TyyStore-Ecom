@if (Auth::check()) <!-- Pengecekan apakah pengguna sudah login -->
    <div class="dropdown cart-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static">
            <div class="icon">
                <i class="icon-shopping-cart"></i>
                <span class="cart-count">{{ $jumlah_pesanan }}</span>
            </div>
            <p>Cart</p>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products">
                @php $subtotal = 0; @endphp
                @foreach ($products as $produk)
                    @php
                        $total_per_produk = $produk->tbstok->hargajual * $produk->jumlah_pesan;
                        $subtotal += $total_per_produk;
                    @endphp
                    <div class="product">
                        <div class="product-cart-details">
                            <h4 class="product-title">
                                <a href="product.html">{{ $produk->tbstok->nama_barang }}</a>
                            </h4>

                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $produk->jumlah_pesan }}</span>
                                x Rp. {{ number_format($produk->tbstok->hargajual, 0, ',', '.') }}
                            </span>
                        </div><!-- End .product-cart-details -->

                        <figure class="product-image-container">
                            <a href="product.html" class="product-image">
                                <img src="{{ asset('image/' . $produk->tbstok->cover) }}" alt="product">
                            </a>
                        </figure>
                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                    </div><!-- End .product -->
                @endforeach
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>Total</span>
                <span class="cart-total-price" id="subtotal">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="{{ url('/cart') }}" class="btn btn-primary">View Cart</a>
                <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                        class="icon-long-arrow-right"></i></a>
            </div><!-- End .dropdown-cart-action -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .cart-dropdown -->
@else
    <div class="dropdown cart-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static">
            <div class="icon">
                <i class="icon-shopping-cart"></i>
                <span class="cart-count">{{ $jumlah_pesanan }}</span>
            </div>
            <p>Cart</p>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products alert bg-danger text-white" >
                Anda harus login untuk melihat keranjang belanja. Silakan <a href="{{ route('login') }}">login</a> atau
                <a href="{{ url('register') }}">daftar</a> jika belum memiliki akun.
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <!-- Kosong karena pengguna belum login -->
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="{{ url('/login') }}" class="btn btn-primary">View Cart</a>
                <a href="{{ url('/login') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i
                        class="icon-long-arrow-right"></i></a>
            </div><!-- End .dropdown-cart-action -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .cart-dropdown -->
@endif
