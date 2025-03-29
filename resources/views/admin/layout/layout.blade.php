<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>{{ $title }}</title>
        <!-- Favicon icon -->
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/assets/theme/images/logo1.png"
        />
        <!-- Pignose Calender -->
        <link
            rel="stylesheet"
            href="/assets/theme/plugins/pg-calendar/css/pignose.calendar.min.css"
        />
        <!-- Chartist -->
        <link
            rel="stylesheet"
            href="/assets/theme/plugins/chartist/css/chartist.min.css"
        />
        <link
            rel="stylesheet"
            href="/assets/theme/plugins/chartist-plugin-tooltips/css/chartist-plugintooltip.css"
        />
        <!-- Datatable -->
        <link
            rel="stylesheet"
            href="/assets/theme/plugins/tables/css/datatable/dataTables.bootstrap4.min.css"
        />
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="/assets/theme/css/style.css" />
        <!-- izitoast -->
        <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">
        <style>
            .header{
                height: 65px;
            }
            .nav-header{
                height: 65px;
                align-content: center;
            }
        </style>
        <!-- Tambahkan di dalam <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    </head>
    <body onload="hitungTotal()">
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
                        strokemiterlimit="10"
                    />
                </svg>
            </div>
        </div>
        <!--*******************
    Preloader end
    ********************-->
        <!--**********************************
    Main wrapper start
    ***********************************-->
        <div id="main-wrapper">
            <!--**********************************
    Nav header start
    ***********************************-->
            <div class="nav-header ">
                <div class="brand-logo">
                    <a href="/admin/dashboard" class="text-center py-2">
                        <b class="logo-abbr">
                            <img src="/assets/theme/images/logo1.png" alt="" style=" width: 100%;" />
                        </b>
                        <span class="logo-compact">
                            <img src="/assets/theme/images/logo1.png" alt="" style=" width: 100%;"/>
                    </span>
                        <span class="brand-title">
                            <img class="" src="/assets/theme/images/logo90.png" alt="" style=" width: 100%;"/>   
                        </span>
                    </a>
                </div>
            </div>
            <!--**********************************
    Nav header end
    ***********************************-->
            <!--**********************************
    Header start
    ***********************************-->
            <div class="header ">
                <div class="header-content clearfix">
                    <div class="nav-control">
                        <div class="hamburger">
                            <span class="toggle-icon"
                                ><i class="icon-menu"></i
                            ></span>
                        </div>
                    </div>
                    <div class="header-right">
                        <ul class="clearfix">
                            <li class="icons dropdown">
                                <div
                                    class="user-img c-pointer position-relative"
                                    data-toggle="dropdown"
                                >
                                    <span class="activity active"></span>
                                    <img
                                        src="/assets/theme/images/user/1.png"
                                        height="40"
                                        width="40"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="drop-down dropdown-profile animated fadeIn dropdown-menu"
                                >
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="/admin/profile/{{auth()->user()->id}}"
                                                    ><i class="icon-user"></i>
                                                    <span>Profile</span></a
                                                >
                                            </li>
                                            <li>
                                                <a href="/logout">
                                                    <i class="icon-key"></i>
                                                    <span>Logout</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--**********************************
Header end ti-comment-alt
***********************************-->
            <!--**********************************
Sidebar start
***********************************-->
            <div class="nk-sidebar">
                <div class="nk-nav-scroll">
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="/admin/dashboard" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i
                                ><span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <!-- list menu untuk admin -->
                        @if(Auth::user()->role == 'admin')
                        <li class="mega-menu mega-menu-sm">
                            <a
                                class="has-arrow"
                                href="javascript:void()"
                                aria-expanded="false">
                                <i class="icon-grid menu-icon"></i
                                ><span class="nav-text">Master</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="/admin/user">Manejement User</a></li>
                                <li>
                                    <a href="/admin/kategori">Kategori Status</a>
                                </li>
                                <li><a href="/admin/devisi">Devisi Magang</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/admin/settings" aria-expanded="false">
                                <i class="icon-settings menu-icon"></i>
                                <span class="nav-text">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.monitoring') }}" aria-expanded="false">
                                <i class="icon-graph menu-icon"></i>
                                <span class="nav-text">Monitoring</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!--**********************************
Sidebar end
***********************************-->
            <!--**********************************
Content body start
***********************************-->
            @yield('content')
            <!--**********************************
Content body end
***********************************-->
            <!--**********************************
Footer start
***********************************-->
            <div class="footer">
                <div class="copyright">
                    <p>
                    <strong><span id="yearss"></span></strong> PT Pos Indonesia.
                    </p>
                </div>
            </div>
            <!--**********************************Footer end***********************************-->
        </div>
        <!--**********************************
Main wrapper end
***********************************-->
        <!--**********************************
Scripts
***********************************-->
        <script>
        document.getElementById("yearss").textContent = new Date().getFullYear();
        </script>
        <script src="/assets/theme/plugins/common/common.min.js"></script>
        <script src="/assets/theme/js/custom.min.js"></script>
        <script src="/assets/theme/js/settings.js"></script>
        <script src="/assets/theme/js/gleek.js"></script>
        <script src="/assets/theme/js/styleSwitcher.js"></script>
        <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
        <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
        <!-- Chartjs -->
        <script src="/assets/theme/plugins/chart.js/Chart.bundle.min.js"></script>
        <!-- Circle progress -->
        <script src="/assets/theme/plugins/circle-progress/circle-progress.min.js"></script>
        <!-- Datamap -->
        <script src="/assets/theme/plugins/d3v3/index.js"></script>
        <script src="/assets/theme/plugins/topojson/topojson.min.js"></script>
        <script src="/assets/theme/plugins/datamaps/datamaps.world.min.js"></script>
        <!-- Morrisjs -->
        <script src="/assets/theme/plugins/raphael/raphael.min.js"></script>
        <script src="/assets/theme/plugins/morris/morris.min.js"></script>
        <!-- Pignose Calender -->
        <script src="/assets/theme/plugins/moment/moment.min.js"></script>
        <script src="/assets/theme/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
        <!-- ChartistJS -->
        <script src="/assets/theme/plugins/chartist/js/chartist.min.js"></script>
        <script src="/assets/theme/plugins/chartist-plugin-tooltips/js/chartist-plugintooltip.min.js"></script>
        <script src="/assets/theme/js/dashboard/dashboard-1.js"></script>
        <!-- Datatable -->
        <script src="/assets/theme/plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="/assets/theme/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/theme/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
        <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
        <!-- sweetalert -->
        <script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{asset('assets/js/page/modules-sweetalert.js')}}"></script>
        <script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
        
        @if(session('sukses'))
            <script>
            iziToast.success({
            title: 'Berhasil',
            message: '{{session("sukses")}}',
            position: 'topRight'
            });
            </script>

        @elseif(session('gagal'))
            <script>
            iziToast.error({
            title: 'Gagal',
            message: '{{session("gagal")}}',
            position: 'topRight'
            });
            </script>
        @elseif(session('warning'))
            <script>
            iziToast.warning({
            title: 'warning',
            message: '{{session("warning")}}',
            position: 'topRight'
            });
            </script>
        @elseif(session('berhasil'))
            <script>
            $(function() {
                swal('Transaksi Berhasil', 'Harap Tunggu', 'success', {
                buttons: false,
                timer: 2000,
                });
            });
            setTimeout(function() {
                window.open('/laporan/{{ session("berhasil") }}/print', '_blank');
            }, 2000);
            </script>
        @endif
        @stack('script')
    </body>
</html>
