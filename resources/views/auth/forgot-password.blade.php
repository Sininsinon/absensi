<!DOCTYPE html>
<html class="h-100" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>Reset Sandi</title>
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/assets/theme/images/logo1.png"
        />
        <link href="/assets/theme/css/style.css" rel="stylesheet" />
        <style>
            .bg-pos{
                position: relative;
                background-image: url('{{ asset("images/pos.jpg") }}');
                background-size: cover;  /* Membuat gambar menutupi seluruh elemen */
                background-position: center; /* Memastikan gambar berada di tengah */
                background-repeat: no-repeat; /* Mencegah gambar berulang */
            
                
            }
            .bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                backdrop-filter: blur(3px); /* Efek blur */
            }
        </style>
    </head>
    <body>
    <div class="h-100 bg-pos">
    <div class="bg-overlay"></div>
        <!--*******************
            Preloader start
            ********************-->
        <div id="preloader">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle
                        class="path"
                        cx="50"
                        cy="50"
                        r="20"
                        fill="none"
                        stroke-width="3"
                        strokemiterlimit="2"
                    />
                </svg>
            </div>
        </div>
        <!--*******************
            Preloader end
            ********************-->
        <div class="login-form-bg h-100 ">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-xl-6">
                        <div class="form-input-content" >
                            <div class="card login-form mb-0" >
                                <div class="card-body pt-5">
                                        <h4 class="text-center">
                                            Masukkan Email anda    
                                        </h4>
                                    <form
                                        class="mt-5 mb-5 login-input"
                                        action="{{ route('password.email') }}" method="POST"
                                    >
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="email" placeholder="Masukkan Email" required
                                            />
                                        </div>
                                        <button type="submit" class="btn login-form__btn submit w-100 ">Kirim Kode</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--**********************************
            Scripts
            ***********************************-->
            <script src="/assets/theme/plugins/common/common.min.js"></script>
            <script src="/assets/theme/js/custom.min.js"></script>
            <script src="/assets/theme/js/settings.js"></script>
            <script src="/assets/theme/js/gleek.js"></script>
            <script src="/assets/theme/js/styleSwitcher.js"></script>
    </body>
</html>
