<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <link href="{{ asset('plantilla_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('plantilla_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background-image: url({{ asset('logo.jpg') }})"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="txtUsuario" placeholder="Ingrese usuario" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="txtPassword" placeholder="Ingrese contraseña" autocomplete="off">
                                        </div>
                                        <a href="#" class="btn btn-primary btn-user btn-block" onclick="onClick_iniciarSesion()">
                                            Iniciar sesión
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('plantilla_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plantilla_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('plantilla_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('plantilla_admin/js/sb-admin-2.min.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function onClick_iniciarSesion() {
            let txtUsuario = document.getElementById("txtUsuario").value;
            let txtPassword = document.getElementById("txtPassword").value;

            if(txtUsuario.trim() == "") {
                swal("","Ingrese usuario","warning");
                return;
            }

            if(txtPassword.trim() == "") {
                swal("","Ingrese contraseña","warning");
                return;
            }

            $.ajax({
                method: "POST",
                url: "{{ asset('/login') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { txtUsuario, txtPassword },
                beforeSend: () => {
                    console.log("enviando")
                },
                success: (response) => {
                    console.log("response", response)
                    window.location.href = "{{ asset('/') }}";
                },
                error: (error, status) => {
                    console.log("error", error)
                    swal("",error.responseText, "error")
                }
            })
        }
    </script>

</body>
</html>