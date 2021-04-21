@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios del portal</h1>
    </div>

    <!-- DIVIDIMOS LA PANTALLA EN DOS SECCIONES -->
    <div class="row">
        
        <!-- FORMULARIO -->
        <div class="col-lg-4" id="contenedor-formulario">
            <div class="row mb-2">
                <div class="col-12">
                    <h5>Registrar usuario</h5>
                </div>
            </div>

            <div class="col-sm-12 mb-3">
                <label for="txtNombre" class="form-label">Nombre completo</label>
                <input type="hidden" name="" id="hdnUsuario" value="">
                <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese nombre" value="" required="" autocomplete="off">
                <div class="invalid-feedback">
                    Se requiere ingresar nombre de la persona.
                </div>
            </div>
    
            <div class="col-sm-12 mb-3">
                <label for="txtUsuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="txtUsuario" placeholder="Ingrese usuario" value="" required="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)">
                <div class="invalid-feedback">
                    Se requiere ingresar usuario.
                </div>
            </div>
    
            <div class="col-sm-12 mb-3">
                <label for="txtPassword" class="form-label" id="label-txtPassword" >Contraseña</label>
                <input type="text" class="form-control" id="txtPassword" placeholder="Ingrese contraseña" value="" required="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)">
                <div class="invalid-feedback">
                    Se requiere ingresar usuario.
                </div>
            </div>
    
            <div class="col-sm-12 mb-4">
                <label for="lstNivelAcceso" class="form-label">Nivel de acceso</label>
                <select name="" id="lstNivelAcceso" class="form-control" required="">
                    <option value="">Seleccione</option>
                    <option value="admin">Administrador</option>
                    <option value="capturista">Capturista</option>
                </select>
                <div class="invalid-feedback">
                    Seleccione nivel de acceso.
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
                    <h5>Usuarios registrados</h5>
                </div>
            </div>

            <div style="height: 19px"></div>
    
            <div class="row mt-2">
                <div class="col-12">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Nivel acceso</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-usuarios">
                            <tr>
                                <td colspan="4">No se encontraron usuarios</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(() => {
        obtenerListaUsuarios();
    });

    function validarFormulario() {
        let txtNombre = document.getElementById("txtNombre").value.trim();
        let txtUsuario = document.getElementById("txtUsuario").value.trim();
        let txtPassword = document.getElementById("txtPassword");
        let lstNivelAcceso = document.getElementById("lstNivelAcceso").value.trim();

        if(!txtNombre.length || !txtUsuario.length || !lstNivelAcceso.length || (txtPassword.getAttribute("required") != null && !txtPassword.value.trim().length)) {
            let contenedor = document.getElementById("contenedor-formulario");
            if(!contenedor.classList.contains('was-validated')) {
                contenedor.classList.add('was-validated');
            }
        } else {
            guardarUsuario();
        }
    }

    function guardarUsuario() {
        let hdnUsuario = document.getElementById("hdnUsuario");
        let txtNombre = document.getElementById("txtNombre");
        let txtUsuario = document.getElementById("txtUsuario");
        let txtPassword = document.getElementById("txtPassword");
        let lstNivelAcceso = document.getElementById("lstNivelAcceso");

        $.ajax({
            method: "PUT",
            url: "{{ asset('/usuarios') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                idUsuario: hdnUsuario.value,
                nombre: txtNombre.value,
                usuario: txtUsuario.value,
                password: txtPassword.value,
                nivelAcceso: lstNivelAcceso.value,
            },
            beforeSend: () => {
                abrirLoading();
            },
            success: (response) => {
                console.log("guardarUsuario >>> ", response);
                swal("", response, "success");
                limpiarFormulario();
                obtenerListaUsuarios();
            },
            error: (error, status) => {
                console.log("error", error);
                obtenerListaUsuarios();
                swal("", error.responseText, "error");
            }
        });

    }

    function obtenerListaUsuarios() {
        $.ajax({
            method: "POST",
            url: "{{ asset('/usuarios') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            beforeSend: () => {
                console.log("enviando");
            },
            success: (arrayUsuarios) => {

                let tableBody = document.getElementById("table-body-usuarios");
                if(arrayUsuarios.length > 0) {
                    let html = '';
                    arrayUsuarios.forEach(usuario => {
                        html += `<tr>
                            <td>${usuario.nombre}</td>
                            <td>${usuario.usuario}</td>
                            <td>${usuario.nivelAcceso == 'admin' ? 'Administrador' : 'Capturista'}</td>
                            <td style="text-align: center">
                                <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarUsuario('${usuario.idUsuario}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            ${usuario.activo ?
                                `<button class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Bloquear" onclick="onClick_bloquearUsuario('${usuario.idUsuario}', 0, '${addSlashes(usuario.usuario)}')">
                                    <i class="fas fa-ban"></i>
                                </button>`
                                :
                                `<button class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Desbloquear" onclick="onClick_bloquearUsuario('${usuario.idUsuario}', 1, '${addSlashes(usuario.usuario)}')">
                                    <i class="fas fa-ban"></i>
                                </button>`
                            }
                                <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarUsuario('${usuario.idUsuario}','${addSlashes(usuario.usuario)}');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                    });
                    tableBody.innerHTML = html;
                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    tableBody.innerHTML = `<tr><td colspan="4">No se encontraron usuarios</td></tr>`;
                }
            },
            error: (error, status) => {
                console.log("error", error);
                swal("", error.responseText, "error");
            }
        });
    }

    function onClick_editarUsuario(idUsuario) {
        $.ajax({
            method: "POST",
            url: "{{ asset('/usuarios') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {idUsuario},
            beforeSend: () => {
                abrirLoading();
            },
            success: (arrayUsuarios) => {

                if(arrayUsuarios.length > 0) {
                    limpiarFormulario();

                    // seteamos los datos para edición
                    document.getElementById("hdnUsuario").value = arrayUsuarios[0].idUsuario;
                    document.getElementById("btn-limpiar-formulario").style.display = "";
                    document.getElementById("label-txtPassword").innerHTML = "Cambiar contraseña";
                    document.getElementById("txtNombre").value = arrayUsuarios[0].nombre;
                    document.getElementById("txtPassword").removeAttribute("required");
                    document.getElementById("txtUsuario").value = arrayUsuarios[0].usuario;
                    document.getElementById("lstNivelAcceso").value = arrayUsuarios[0].nivelAcceso;
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

    function onClick_bloquearUsuario(idUsuario, activo, usuario) {
        
        //Primero preguntamos si se requiere bloquear
        swal({
            title: `¿Estás seguro de ${activo == 1 ? "desbloquear" : "bloquear"} al usuario ${usuario}?`,
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
                    text: `Si, ${activo == 1 ? "desbloquear" : "bloquear"}`,
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
                    method: "POST",
                    url: "{{ asset('/usuarios/bloquear') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {idUsuario, activo},
                    beforeSend: () => {
                        abrirLoading();
                    },
                    success: (response) => {
                        obtenerListaUsuarios();
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

    function onClick_eliminarUsuario(idUsuario, usuario) {
        
        //Primero preguntamos si se requiere bloquear
        swal({
            title: `¿Estás seguro eliminar al usuario ${usuario}?`,
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
                    url: "{{ asset('/usuarios') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {idUsuario},
                    beforeSend: () => {
                        abrirLoading();
                    },
                    success: (response) => {
                        obtenerListaUsuarios();
                        swal("", response, "success");
                    },
                    error: (error, status) => {
                        console.log("error", error);
                        swal("", error.responseText, "error");
                        obtenerListaUsuarios();
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

        document.getElementById("hdnUsuario").value = "";
        document.getElementById("btn-limpiar-formulario").style.display = "none";
        document.getElementById("label-txtPassword").innerHTML = "Contraseña";
        document.getElementById("txtNombre").value = "";
        document.getElementById("txtUsuario").value = "";
        document.getElementById("lstNivelAcceso").value = "";
        document.getElementById("txtPassword").value = "";
        document.getElementById("txtPassword").setAttribute("required", true);
        document.getElementById("span-btn-guardar").innerHTML = "Agregar";
    }
</script>

@endsection