<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tyy Store | Login</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Tyy Store | Login">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{ url('tyystore.jpg') }}">

    <!-- FontAwesome JS-->
    <script defer src="{{ url('admin2/assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ url('admin2/assets/css/portal.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="index.html">
                            <img class="logo-icon me-2" src="{{ url('logo2.jpg') }}" alt="logo">
                        </a>
                    </div>
                    <h2 class="auth-heading text-center mb-5">Log in to SiKANTIN</h2>
                    <div class="auth-form-container text-start">
                        <form class="pt-3" action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="singin-username">Username *</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="singin-password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div><!-- End .form-group -->

                            <br>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-secondary">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signin-remember">
                                    <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                </div><!-- End .custom-checkbox -->

                                <a href="#" class="forgot-link">Forgot Your Password?</a>
                            </div><!-- End .form-footer -->
                        </form>

                        <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link"
                                href="signup.html">here</a>.</div>
                    </div><!--//auth-form-container-->

                </div><!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                        <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                                style="color: #fb866a;"></i> by <a class="app-link"
                                href="http://themes.3rdwavemedia.com" target="_blank">Abynn Tech</a> for
                            developers</small>

                    </div>
                </footer><!--//app-auth-footer-->
            </div><!--//flex-column-->
        </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
        </div><!--//auth-background-col-->

    </div><!--//row-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check if there is a success message from the session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
            });
        @endif

        // Check if there is an error message from the session
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
            });
        @endif
    </script>

</body>

</html>
