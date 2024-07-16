<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="{{ url('admin/dashboard') }}"><img class="logo-icon me-2"
                    src="{{ url('tyystore.jpg') }}" alt="logo"><span class="logo-text">TyyStore</span></a>

        </div><!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/dashboard') }}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <li
                    class="nav-item has-submenu {{ request()->is('admin/barang') || request()->is('admin/restock') || request()->is('admin/mutasi') || request()->is('admin/slider') ? 'active' : '' }}">
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-1">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z" />
                                <path fill-rule="evenodd"
                                    d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Master Data</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-1"
                        class="collapse submenu submenu-1 {{ request()->is('admin/barang') || request()->is('admin/restock') || request()->is('admin/mutasi') || request()->is('admin/slider') ? 'show' : '' }}">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item {{ request()->is('admin/barang') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/barang') }}">Stok Barang</a></li>
                            <li class="submenu-item {{ request()->is('admin/restock') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/restock') }}">Tambah Stok Barang</a></li>
                            <li class="submenu-item {{ request()->is('admin/mutasi') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/mutasi') }}">Mutasi</a></li>
                            <li class="submenu-item {{ request()->is('admin/slider') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/slider') }}">Slider</a></li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item has-submenu {{ request()->is('admin/checkout') || request()->is('admin/pesanan') || request()->is('admin/setting') ? 'active' : '' }}">
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-2">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path fill-rule="evenodd"
                                    d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                <circle cx="3.5" cy="5.5" r=".5" />
                                <circle cx="3.5" cy="8" r=".5" />
                                <circle cx="3.5" cy="10.5" r=".5" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Data Pesanan</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-2"
                        class="collapse submenu submenu-2 {{ request()->is('admin/checkout') || request()->is('admin/pesanan') || request()->is('admin/setting') ? 'show' : '' }}">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item {{ request()->is('admin/checkout') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/checkout') }}">Checkout</a></li>
                            <li class="submenu-item {{ request()->is('admin/pesanan') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/pesanan') }}">Data Pesanan</a></li>
                            <li class="submenu-item {{ request()->is('admin/setting') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/setting') }}">Setting</a></li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item has-submenu {{ request()->is('admin/BarangKeluar') || request()->is('admin/BarangMasuk') || request()->is('admin/ReturnJual') || request()->is('admin/ReturnBeli') ? 'active' : '' }}">
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-3">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path fill-rule="evenodd"
                                    d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                <circle cx="3.5" cy="5.5" r=".5" />
                                <circle cx="3.5" cy="8" r=".5" />
                                <circle cx="3.5" cy="10.5" r=".5" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Data Laporan</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-3"
                        class="collapse submenu submenu-3 {{ request()->is('admin/BarangMasuk') || request()->is('admin/BarangKeluar') || request()->is('admin/ReturnJual') || request()->is('admin/ReturnBeli') ? 'show' : '' }}">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item {{ request()->is('admin/BarangMasuk') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/BarangMasuk') }}">Barang Masuk</a></li>
                            <li class="submenu-item {{ request()->is('admin/BarangKeluar') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/BarangKeluar') }}">Barang Keluar</a></li>
                            <li class="submenu-item {{ request()->is('admin/ReturnJual') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/ReturnJual') }}">Barang Return Jual</a></li>
                            <li class="submenu-item {{ request()->is('admin/ReturnBeli') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/ReturnBeli') }}">Barang Return Beli</a></li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item has-submenu {{ request()->is('admin/vendor') || request()->is('admin/user') || request()->is('admin/setting') ? 'active' : '' }}">
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-4">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                            </svg>
                        </span>

                        <span class="nav-link-text">Users</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path 
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-4"
                        class="collapse submenu submenu-4 {{ request()->is('admin/pemasok') || request()->is('admin/user') || request()->is('admin/setting') ? 'show' : '' }}">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item {{ request()->is('admin/pemasok') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/pemasok') }}">Vendor</a></li>
                            <li class="submenu-item {{ request()->is('admin/user') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/user') }}">Account</a></li>
                            <li class="submenu-item {{ request()->is('admin/setting') ? 'active' : '' }}"><a
                                    class="submenu-link" href="{{ url('admin/setting') }}">Setting</a></li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                        data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">External</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="submenu-3" class="collapse submenu submenu-3" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link" href="login.html">Login</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="signup.html">Signup</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link" href="reset-password.html">Reset
                                    password</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="404.html">404 page</a>
                            </li>
                        </ul>
                    </div>
                </li><!--//nav-item--> --}}

                <li class="nav-item">
                    <a class="nav-link" href="help.html">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Help</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
            </ul><!--//app-menu-->
        </nav><!--//app-nav-->
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="settings.html">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                    <path fill-rule="evenodd"
                                        d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Settings | &copy;AbynnTech&trade;</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                </ul><!--//footer-menu-->
            </nav>
        </div><!--//app-sidepanel-footer-->

    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->
