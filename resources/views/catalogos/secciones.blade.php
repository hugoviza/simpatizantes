@extends('layouts.app')

@section('title', 'Secciones')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catálogo de secciones</h1>
    </div>

    <!-- DIVIDIMOS LA PANTALLA EN DOS SECCIONES -->
    <div class="row">
        <!-- FORMULARIO -->
        <div class="col-lg-4" id="contenedor-formulario">
            <div class="row mb-2">
                <div class="col-12">
                    <h5>Registrar sección</h5>
                </div>
            </div>

            <div class="col-sm-12 mb-3">
                <label for="txtClaveSeccion" class="form-label">Clave sección*</label>
                <input type="hidden" name="" id="hdnSeccion" value="">
                <input type="text" class="form-control" id="txtClaveSeccion" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                <div class="invalid-feedback">
                    Se requiere ingresar clave de la sección
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
                    <h5>Secciones registradas</h5>
                </div>
            </div>

            <div style="height: 19px"></div>
    
            <div class="row mt-2">
                <div class="col-12">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Clave sección</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-secciones">
                            <tr>
                                <td colspan="2">No se encontraron secciones</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            obtenerListaSecciones();
        });

        function obtenerListaSecciones() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/secciones') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                beforeSend: () => {
                    console.log("enviando");
                },
                success: (arraySecciones) => {

                    let tableBody = document.getElementById("table-body-secciones");
                    if(arraySecciones.length > 0) {
                        let html = '';
                        arraySecciones.forEach(seccion => {
                            html += `<tr>
                                <td>${seccion.claveSeccion ? seccion.claveSeccion : ""}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarSeccion('${seccion.idSeccion}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarSeccion('${seccion.idSeccion}','${seccion.claveSeccion}');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.innerHTML = html;
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="4">No se encontraron secciones</td></tr>`;
                    }
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function validarFormulario() {
            let txtClaveSeccion = document.getElementById("txtClaveSeccion").value.trim();

            if(!txtClaveSeccion.length) {
                let contenedor = document.getElementById("contenedor-formulario");
                if(!contenedor.classList.contains('was-validated')) {
                    contenedor.classList.add('was-validated');
                }
            } else {
                guardarSeccion();
            }
        }

        function guardarSeccion() {
            let hdnSeccion = document.getElementById("hdnSeccion");
            let txtClaveSeccion = document.getElementById("txtClaveSeccion");

            $.ajax({
                method: "PUT",
                url: "{{ asset('/secciones') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idSeccion: hdnSeccion.value,
                    claveSeccion: txtClaveSeccion.value,
                },
                beforeSend: () => {
                    abrirLoading();
                },
                success: (response) => {
                    console.log("guardarSeccion >>> ", response);
                    swal("", response, "success");
                    limpiarFormulario();
                    obtenerListaSecciones();
                },
                error: (error, status) => {
                    console.log("error", error);
                    obtenerListaSecciones();
                    swal("", error.responseText, "error");
                }
            });

        }

        function onClick_editarSeccion(idSeccion) {
            //descargamos la data de la seccion
            $.ajax({
                method: "POST",
                url: "{{ asset('/secciones') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {idSeccion},
                beforeSend: () => {
                    abrirLoading();
                },
                success: (arraySecciones) => {

                    if(arraySecciones.length > 0) {
                        limpiarFormulario();

                        // seteamos los datos para edición
                        document.getElementById("hdnSeccion").value = arraySecciones[0].idSeccion;
                        document.getElementById("txtClaveSeccion").value = arraySecciones[0].claveSeccion;
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

        function onClick_eliminarSeccion(idSeccion, seccion) {
            
            //Primero preguntamos si se requiere bloquear
            swal({
                title: `¿Estás seguro eliminar a la sección ${seccion}?`,
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
                        url: "{{ asset('/secciones') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {idSeccion},
                        beforeSend: () => {
                            abrirLoading();
                        },
                        success: (response) => {
                            obtenerListaSecciones();
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

            document.getElementById("hdnSeccion").value = "";
            document.getElementById("txtClaveSeccion").value = "";
            document.getElementById("btn-limpiar-formulario").style.display = "none";
            document.getElementById("span-btn-guardar").innerHTML = "Agregar";
        }
    </script>
@endsection