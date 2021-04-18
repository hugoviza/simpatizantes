@extends('layouts.app')

@section('title', 'Localidades')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catálogo de localidades</h1>
    </div>

    <!-- DIVIDIMOS LA PANTALLA EN DOS SECCIONES -->
    <div class="row">
        
        <!-- FORMULARIO -->
        <div class="col-lg-4" id="contenedor-formulario">
            <div class="row mb-2">
                <div class="col-12">
                    <h5>Registrar localidad</h5>
                </div>
            </div>

            <div class="col-sm-12 mb-3">
                <label for="txtLocalidad" class="form-label">Localidad</label>
                <input type="hidden" name="" id="hdnLocalidad" value="">
                <input type="text" class="form-control" id="txtLocalidad" placeholder="Ingrese descripción de localidad" value="" required="" autocomplete="off">
                <div class="invalid-feedback">
                    Se requiere ingresar descripción de la localidad
                </div>
            </div>
    
            <div class="col-sm-12 mb-3">
                <label for="txtClave" class="form-label">Clave</label>
                <input type="text" class="form-control" id="txtClave" placeholder="Ingrese clave" value="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)">
                <div class="invalid-feedback">
                    Se requiere ingresar clave de localidad.
                </div>
            </div>
    
            <div class="col-sm-12 mb-3">
                <button class="btn btn-primary btn-icon-split float-right" onclick="validarFormulario()">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text" id="span-btn-guardar">Agregar</span>
                </button>

                <button class="btn btn-danger btn-icon-split float-right mr-2" style="display: none" id="btn-limpiar-formulario" onclick="limpiarFormulario()">
                    <span class="icon text-white-50">
                        <i class="fas fa-ban"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
            </div>
        </div>


        <!-- TABLA -->
        <div class="col-lg-8">
            <div class="row mb-2">
                <div class="col-12">
                    <h5>Localidades registradas</h5>
                </div>
            </div>

            <div style="height: 19px"></div>
    
            <div class="row mt-2">
                <div class="col-12">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Localidad</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-localidades">
                            <tr>
                                <td colspan="3">No se encontraron localidades</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            obtenerListaLocalidades();
        });

        function obtenerListaLocalidades() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/localidades') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                beforeSend: () => {
                    console.log("enviando");
                },
                success: (arrayLocalidades) => {

                    let tableBody = document.getElementById("table-body-localidades");
                    if(arrayLocalidades.length > 0) {
                        let html = '';
                        arrayLocalidades.forEach(localidad => {
                            html += `<tr>
                                <td>${localidad.claveLocalidad ? localidad.claveLocalidad : ""}</td>
                                <td>${localidad.localidad}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarLocalidad('${localidad.idLocalidad}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarLocalidad('${localidad.idLocalidad}','${localidad.localidad}');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.innerHTML = html;
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="4">No se encontraron localidades</td></tr>`;
                    }
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function validarFormulario() {
            let txtLocalidad = document.getElementById("txtLocalidad").value.trim();
            let txtClave = document.getElementById("txtClave").value.trim();

            if(!txtLocalidad.length) {
                let contenedor = document.getElementById("contenedor-formulario");
                if(!contenedor.classList.contains('was-validated')) {
                    contenedor.classList.add('was-validated');
                }
            } else {
                guardarLocalidad();
            }
        }

        function guardarLocalidad() {
            let hdnLocalidad = document.getElementById("hdnLocalidad");
            let txtLocalidad = document.getElementById("txtLocalidad");
            let txtClave = document.getElementById("txtClave");

            $.ajax({
                method: "PUT",
                url: "{{ asset('/localidades') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idLocalidad: hdnLocalidad.value,
                    localidad: txtLocalidad.value,
                    claveLocalidad: txtClave.value,
                },
                beforeSend: () => {
                    abrirLoading();
                },
                success: (response) => {
                    console.log("guardarLocalidad >>> ", response);
                    swal("", response, "success");
                    limpiarFormulario();
                    obtenerListaLocalidades();
                },
                error: (error, status) => {
                    console.log("error", error);
                    obtenerListaLocalidades();
                    swal("", error.responseText, "error");
                }
            });

        }

        function onClick_editarLocalidad(idLocalidad) {
            //descargamos la data de la localidad
            $.ajax({
                method: "POST",
                url: "{{ asset('/localidades') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {idLocalidad},
                beforeSend: () => {
                    abrirLoading();
                },
                success: (arrayLocalidades) => {

                    if(arrayLocalidades.length > 0) {
                        limpiarFormulario();

                        // seteamos los datos para edición
                        document.getElementById("hdnLocalidad").value = arrayLocalidades[0].idLocalidad;
                        document.getElementById("txtLocalidad").value = arrayLocalidades[0].localidad;
                        document.getElementById("txtClave").value = arrayLocalidades[0].claveLocalidad;
                        document.getElementById("btn-limpiar-formulario").style.display = "";
                        document.getElementById("span-btn-guardar").innerHTML = "Guardar";
                    }
                    swal.close();
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function onClick_eliminarLocalidad(idLocalidad, localidad) {
            
            //Primero preguntamos si se requiere bloquear
            swal({
                title: `¿Estás seguro eliminar a la localidad ${localidad}?`,
                text: "",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: false,
                        visible: true,
                        className: "btn",
                        closeModal: true,
                    },
                    confirm: {
                        text: `Si, Eliminar`,
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    }
                },
            })
            .then((sayYes) => {
                if (sayYes) {
                    $.ajax({
                        method: "DELETE",
                        url: "{{ asset('/localidades') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {idLocalidad},
                        beforeSend: () => {
                            abrirLoading();
                        },
                        success: (response) => {
                            obtenerListaLocalidades();
                            swal("", response, "success");
                        },
                        error: (error, status) => {
                            console.log("error", error);
                            swal("", error.responseText, "error");
                        }
                    });
                }
            });
        }

        function limpiarFormulario() {
            let contenedor = document.getElementById("contenedor-formulario");
            if(contenedor.classList.contains('was-validated')) {
                contenedor.classList.remove('was-validated');
            }

            document.getElementById("hdnLocalidad").value = "";
            document.getElementById("txtLocalidad").value = "";
            document.getElementById("txtClave").value = "";
            document.getElementById("btn-limpiar-formulario").style.display = "none";
            document.getElementById("span-btn-guardar").innerHTML = "Agregar";
        }

        function ValidarNumerosYLetras(e) {
            var keyCode = e.keyCode || e.which;
            //Regex for Valid Characters i.e. Alphabets and Numbers.
            var regex = /^[A-Za-z0-9]+$/;
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            return isValid;
        }
    </script>
@endsection