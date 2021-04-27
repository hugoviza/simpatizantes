<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Simpatizantes - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('plantilla_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('plantilla_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('plantilla_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plantilla_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('plantilla_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('plantilla_admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('plantilla_admin/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('plantilla_admin/js/sweetalert.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <script src="{{ asset('js/funcionesGlobales.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <style>
        .form-label {
            margin-bottom: .2rem;            
        }

        .swal-width-sm: {
            width: 100px!important;
        }
        .custom-file-label::after { content: "Seleccionar";}

        .input-loading {
            position: relative;
        }
    </style>

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ asset('/') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Simpatizantes</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if ($session->get('nivelAcceso') === 'admin')
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ asset('/') }}">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Reportes</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            @endif

            <!-- Heading -->
            <div class="sidebar-heading">
                Catálogos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('/simpatizantes') }}">
                    <i class="fa fa-id-card" aria-hidden="true"></i>
                    <span>Simpatizantes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ asset('/promotores') }}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Promotores</span>
                </a>
            </li>

            
            @if ($session->get('nivelAcceso') === 'admin')


                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/usuarios') }}">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        <span>Usuarios</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/secciones') }}">
                        <i class="fa fa-map" aria-hidden="true"></i>
                        <span>Secciones</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/localidades') }}">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>Localidades</span>
                    </a>
                </li>
                
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $session->get('nombre')}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('plantilla_admin/img/undraw_profile.svg') }}">
                            </a>
                            
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ asset('login') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                                <a class="dropdown-item" href="@php echo str_replace('localhost', gethostbyname(trim(`hostname`)), asset('/') ) @endphp">
                                    @if ($session->get('nivelAcceso') === 'admin')
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Ruta de acceso en red local: <b>@php echo str_replace('localhost', gethostbyname(trim(`hostname`)), asset('/') ) @endphp</b>
                                    @endif
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Simpatizantes 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
        $(document).ready(() => {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    
    
</body>

</html>