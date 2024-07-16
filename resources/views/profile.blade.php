@extends('client.layouts.layout')
@section('title', '- Profile')
@section('page-name', '- Profile')
@section('content')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ url('client/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">My Account<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                        href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                        aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                        role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('logout') }}">Sign Out</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->


                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    @if (auth()->check())
                                        <p>Hello <span
                                                class="font-weight-normal text-dark">{{ auth()->user()->username }}</span>
                                            (<a href="{{ url('logout') }}">Log out</a>)
                                        @else
                                        <p>Hello <span class="font-weight-normal text-dark">User</span> (not logged in? <a
                                                href="{{ url('login') }}">Log in</a>)
                                    @endif

                                    <br>
                                    From your account dashboard you can view your <a href="#tab-orders"
                                        class="tab-trigger-link link-underline">recent orders</a>, manage your <a
                                        href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and
                                    <a href="#tab-account" class="tab-trigger-link">edit your password and account
                                        details</a>.</p>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    @if (auth()->check())
                                        <p>Your Orders</p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>KODE</th>
                                                            <th>NAMA USER</th>
                                                            <th>PRODUK</th>
                                                            <th>NAMA BARANG</th>
                                                            <th>JUMLAH PESANAN</th>
                                                            <th>HARGA TOTAL</th>
                                                            <th>TANGGAL PEMBELIAN</th>
                                                            <th>STATUS</th>
                                                            <th class="export-exclude">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach ($completedOrders as $value)
                                                            @php
                                                                $bgClass = '';
                                                                $statusText = '';

                                                                if ($value->status == 'completed') {
                                                                    $bgClass = 'bg-success text-white';
                                                                    $statusText = 'Completed';
                                                                } elseif ($value->status == 'pending') {
                                                                    $bgClass = 'bg-warning text-white';
                                                                    $statusText = 'Pending';
                                                                } elseif ($value->status == 'returned') {
                                                                    $bgClass = 'bg-danger text-white';
                                                                    $statusText = 'Returned';
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $no++ }}</td>
                                                                <td>{{ $value->kode }}</td>
                                                                <td>{{ $value->username }}</td>
                                                                <td><img class="img-fluid"
                                                                        src="{{ asset('image/' . $value->cover) }}"
                                                                        alt="cover" width="100"></td>
                                                                <td>{{ $value->namabarang }}</td>
                                                                <td>{{ $value->jumlahpesan }}</td>
                                                                <td>Rp. {{ number_format($value->jumlahharga) }}</td>
                                                                <td>{{ $value->tanggal }}</td>
                                                                <td><span
                                                                        class="{{ $bgClass }} p-2 rounded">{{ $statusText }}</span>
                                                                </td>
                                                                <td>
                                                                    @if ($value->status == 'completed')
                                                                        <form
                                                                            action="{{ url('admin/checkout', $value->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                onclick="return confirm('Apakah yakin anda ingin menghapus?')"
                                                                                class="btn btn-danger btn-sm">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    @else
                                        <p>No order has been made yet.</p>
                                        <a href="{{ url('product') }}" class="btn btn-outline-primary-2"><span>GO
                                                SHOP</span><i class="icon-long-arrow-right"></i></a>
                                    @endif
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                    aria-labelledby="tab-address-link">
                                    <?php
                                    // Assuming you are using Laravel's Auth facade
                                    $user = Auth::user();
                                    ?>
                                    <p>The following addresses will be used on the checkout page by default.</p>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Billing Address</h3><!-- End .card-title -->
                                                    @if (auth()->check())
                                                        <p>{{ $user->username }}<br>
                                                            {{ $user->address }}<br>
                                                            {{ $user->phone }}<br>
                                                            {{ $user->email }}<br>
                                                            <a href="#">Edit <i class="icon-edit"></i></a>
                                                        </p>
                                                    @else
                                                        <p>Username<br>
                                                            Address<br>
                                                            Phone<br>
                                                            Email<br>
                                                        </p>
                                                    @endif
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->

                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                                    <p>You have not set up this type of address yet.<br>
                                                        <a href="#">Edit <i class="icon-edit"></i></a>
                                                    </p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                    aria-labelledby="tab-account-link">
                                    <p>tes</p>
                                </div>

                                <div class="tab-pane fade" id="tab-account-edit" role="tabpanel"
                                    aria-labelledby="tab-account-link-edit">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Display Name *</label>
                                        <input type="text" class="form-control" required>
                                        <small class="form-text">This will be how your name will be displayed in the
                                            account section and in reviews</small>

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" required>

                                        <label>Current password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control">

                                        <label>New password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control">

                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control mb-2">

                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
