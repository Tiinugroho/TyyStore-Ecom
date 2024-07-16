@extends('client.layouts.layout')
@section('title', '- Upload Bukti Transaksi')
@section('page-name', '- Upload Bukti Transaksi')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('{{ url('client/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">Upload Bukti Transaksi<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload Bukti Transaksi</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to
                                enter your code</span></label>
                    </form>
                </div>
                <form action="{{ route('upload_bukti_transaksi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bukti_transaksi">Upload Bukti Transaksi</label>
                        <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                        <span class="btn-text">Upload Bukti Transaksi</span>
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
