<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="/assets_admin/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="/assets_admin/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="/assets_admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/assets_admin/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="/assets_admin/css/pace.min.css" rel="stylesheet" />
    <script src="/assets_admin/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets_admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets_admin/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets_admin/css/app.css" rel="stylesheet">
    <link href="/assets_admin/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"/>
    <title>Đổi Mật Khẩu</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="/assets_admin/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Đổi Mật Khẩu</h3>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="/admin/update-password" method="post">
                                            @csrf
                                            <input name="hash_reset" type="hidden" class="form-control" value="{{ $hash_reset }}">
                                            <div class="col-12">
                                                <label class="form-label">Mật Khẩu Mới</label>
                                                <input name="password" type="password" class="form-control" placeholder="Nhập vào mật khẩu">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Nhập Lại Mật Khẩu</label>
                                                <input name="re_password" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-end"> <a href="/admin/login">Đăng nhập</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đổi Mật Khẩu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="/assets_admin/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="/assets_admin/js/jquery.min.js"></script>
    <script src="/assets_admin/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets_admin/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets_admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="/assets_admin/js/app.js"></script>
</body>

</html>
