@extends('client.layouts.layout')
@section('title', '- Register')
@section('page-name', '- Register')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="form-box mt-5">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('login')}}">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('register')}}">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content-5">
                    <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form class="pt-3" action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">Your Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="email">Your email address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div><!-- End .form-group -->
                            
                            <div class="form-group">
                                <label for="phone">No. Handphone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" required>
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                    <label class="custom-control-label" for="register-policy">I agree to the <a
                                            href="#">privacy policy</a> *</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login  btn-f">
                                        <i class="icon-facebook-f"></i>
                                        Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div>
</div>
@endsection
