<div class="container">
    <div class="heading heading-center mb-3">
        <h2 class="title">Products</h2><!-- End .title -->

        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
                    aria-controls="top-all-tab" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="top-baju-link" data-toggle="tab" href="#top-baju-tab" role="tab"
                    aria-controls="top-baju-tab" aria-selected="false">Baju</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="top-celana-link" data-toggle="tab" href="#top-celana-tab" role="tab"
                    aria-controls="top-celana-tab" aria-selected="false">Celana</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="top-sepatu-link" data-toggle="tab" href="#top-sepatu-tab" role="tab"
                    aria-controls="top-sepatu-tab" aria-selected="false">Sepatu</a>
            </li>
        </ul>
    </div><!-- End .heading -->

    <div class="tab-content">
        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
            <div class="products">
                <div class="row justify-content-center">

                    @foreach ($produks as $produk) 
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="{{ url('product-detail/' . $produk->id) }}">
                                    <img src="{{ asset('image/' . $produk->cover) }}" alt="Product image"
                                        class="product-image">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a
                                        href="{{ url('product-detail/' . $produk->id) }}">{{ $produk->nama_barang }}</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    Rp. {{ number_format($produk->hargajual, 2, ',', '.') }}
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="{{ url('product-detail/' . $produk->id) }}" class="btn-product btn-cart"><span>Detail Produk</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->

        <div class="tab-pane p-0 fade" id="top-baju-tab" role="tabpanel" aria-labelledby="top-baju-link">
            <div class="products">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <span class="product-label label-circle label-sale">Sale</span>
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-9-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-9-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Furniture</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Garden Armchair</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">$94,00</span>
                                    <span class="old-price">Was $94,00</span>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">New</span>
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-12-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-12-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Furniture</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">2-Seater</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $3.107,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-13-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-13-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Furniture</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $2.486,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane p-0 fade" id="top-decor-tab" role="tabpanel" aria-labelledby="top-decor-link">
            <div class="products">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-8-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-8-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Decor</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Madra Log Holder</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $401,00
                                </div><!-- End .product-price -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #333333;"><span
                                            class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #927764;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->

                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-11-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-11-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Decor</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Original Outdoor Beanbag</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $259,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-14-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-14-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Decor</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Cushion Set 3 Pieces</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $199,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-15-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-15-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Decor</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Cushion Set 3 Pieces</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $199,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane p-0 fade" id="top-light-tab" role="tabpanel" aria-labelledby="top-light-link">
            <div class="products">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-7-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-7-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Lighting</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Petite Table Lamp</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $401,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-10-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-10-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Lighting</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Carronade Large Suspension Lamp</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    $401,00
                                </div><!-- End .product-price -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #e8e8e8;"><span
                                            class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->

                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-16-1.jpg') }}"
                                        alt="Product image" class="product-image">
                                    <img src="{{ url('client/assets/images/demos/demo-2/products/product-16-2.jpg') }}"
                                        alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Lighting</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Carronade Table Lamp</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    $499,00
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
</div><!-- End .container -->
