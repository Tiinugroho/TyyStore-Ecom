<div class="intro-slider-container">
    <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
        <?php 
        $produk = DB::table('tbsliders')
        ->where('tbsliders.pajang','ya')
        ->get();
        foreach ($produk as $value) {
        ?>
        <div class="intro-slide" style="background-image: url('{{ asset('slider/' . $value->foto) }}');">
            <div class="container intro-content">
                <h3 class="intro-subtitle text-dark">Bedroom Furniture</h3><!-- End .h3 intro-subtitle -->
                <h1 class="intro-title text-dark">Find Comfort <br>That Suits You.</h1><!-- End .intro-title -->

                <a href="category.html" class="btn btn-primary">
                    <span class="text-dark">Shop Now</span>
                    <i class="icon-long-arrow-right text-dark"></i>
                </a>
            </div><!-- End .container intro-content -->
        </div><!-- End .intro-slide -->
        <?php
        }
        ?>

    </div><!-- End .owl-carousel owl-simple -->

    <span class="slider-loader text-white"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->

<div class="brands-border owl-carousel owl-simple" data-toggle="owl"
    data-owl-options='{
        "nav": false, 
        "dots": false,
        "margin": 0,
        "loop": true,
        "responsive": {
            "0": {
                "items":2
            },
            "420": {
                "items":3
            },
            "600": {
                "items":4
            },
            "900": {
                "items":5
            },
            "1024": {
                "items":6
            },
            "1360": {
                "items":7
            }
        }
    }'>
    
    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/1.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/2.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/3.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/4.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/5.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/6.png') }}" alt="Brand Name">
    </a>

    <a href="#" class="brand">
        <img src="{{ url('client/assets/images/brands/7.png') }}" alt="Brand Name">
    </a>
</div><!-- End .owl-carousel -->
