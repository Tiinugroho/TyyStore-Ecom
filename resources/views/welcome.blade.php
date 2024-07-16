@extends('client.layouts.layout')

@section('content')
    <main class="main">
        @include('client.layouts.slider')

        <div class="mb-3 mb-lg-5"></div><!-- End .mb-3 mb-lg-5 -->

        @include('client.layouts.banner')

        <div class="mb-3"></div><!-- End .mb-6 -->
        {{-- Tampilkan bagian ini hanya jika user sudah login --}}
        @include('client.layouts.deal')

        <div class="mb-5"></div><!-- End .mb-5 -->

        @include('client.layouts.topsell')

        <div class="container">
            <hr class="mt-1 mb-6">
        </div><!-- End .container -->

        @include('client.layouts.blog-post')

    </main><!-- End .main -->
@endsection
