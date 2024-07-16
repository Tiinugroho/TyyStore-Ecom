<header class="header header-2 header-intro-clearance">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p>Special collection already available.</p><a href="#">&nbsp;Read more ...</a>
            </div><!-- End .header-left -->

            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">Eur</a></li>
                                            <li><a href="#">Usd</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Indonesia</a></li>
                                            <li><a href="#">Spanish</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->

        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{url('/')}}" class="logo">
                    <img src="{{ url('logo2.jpg') }}" alt="Molla Logo" width="105"
                        height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div
                    class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search product ..." required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">
                <div class="wishlist">
                    <a href="{{ auth()->check() ? '/profile' : 'login' }}" title="My account">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                        @if (auth()->check())
                            <p>{{ auth()->user()->username }}</p>
                        @else
                            <p>Account</p> <!-- Or any default text you want to display -->
                        @endif
                    </a>
                </div><!-- End .compare-dropdown -->


                <div class="wishlist">
                    <a href="wishlist.html" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            {{-- <span class="wishlist-count badge">3</span> --}}
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div><!-- End .compare-dropdown -->

                @include('client.layouts.cart-list')
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static" title="Browse Categories">
                        Pilih Kategori
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                <li><a href="#">Baju</a></li>
                                <li><a href="#">Celana</a></li>
                                <li><a href="#">Jaket & Sweater</a></li>
                                <li><a href="#">Sepatu</a></li>
                                <li><a href="#">Tas</a></li>
                                <li><a href="#">Jam & Aksesoris</a></li>
                                <li><a href="#">Topi</a></li>
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container">
                            <a href="/" class="sf-with-ul">Home</a>
                        </li>
                        <li>
                            <a href="/" class="sf-with-ul">Shop</a>
                            <div class="megamenu megamenu-sm">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="menu-col">
                                            <div class="menu-title">Shop</div><!-- End .menu-title -->
                                            <ul>
                                                <li><a href="{{url('product')}}"><span>Shop List<span
                                                                class="tip tip-new">New</span></span></a></li>
                                            </ul>
                                            <div class="menu-title">Shop Pages</div><!-- End .menu-title -->
                                            <ul>
                                                <li><a href="{{ url('cart') }}">Cart</a></li>
                                                <li><a href="{{ url('checkout') }}">Checkout</a></li>
                                                <li><a href="{{ url('wishlist') }}">Wishlist</a></li>
                                                <li><a href="#">My Account</a></li>
                                                <li><a href="#">Lookbook</a></li>
                                            </ul>
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="banner banner-overlay">
                                            <a href="category.html" class="banner banner-menu">
                                                <img src="{{ url('client/assets/images/menu/banner-1.jpg') }}"
                                                    alt="Banner">
                                                <div class="banner-content banner-content-top">
                                                    <div class="banner-title text-white">Last
                                                        <br>Chance<br><span><strong>Sale</strong></span>
                                                    </div>
                                                    <!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                        </div><!-- End .banner banner-overlay -->
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-sm -->
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">Pages</a>
                            <ul>
                                <li>
                                    <a href="{{ url('about') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ url('contact') }}">Contact Us</a>
                                </li>
                                <li>
                                    <a href="{{ url('login') }}">Login</a>
                                </li>
                                <li>
                                    <a href="{{ url('blog') }}">Blog</a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-center -->

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
