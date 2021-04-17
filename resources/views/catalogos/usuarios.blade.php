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
                <input type="text" class="form-control" id="txtPassword" placeholder="Ingrese contraseña" value="" required="" autocomplete="off">
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
                    <span class="text">Agregar</span>
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
    })
    function validarFormulario() {
        let txtNombre = document.getElementById("txtNombre").value.trim();
        let txtUsuario = document.getElementById("txtUsuario").value.trim();
        let lstNivelAcceso = document.getElementById("lstNivelAcceso").value.trim();

        if(!txtNombre.length || !txtUsuario.length || !lstNivelAcceso.length) {
            let contenedor = document.getElementById("contenedor-formulario");
            if(!contenedor.classList.contains('was-validated')) {
                contenedor.classList.add('was-validated');
            }
        } else {
            registrarUsuario();
        }
    }

    function registrarUsuario() {
        let txtNombre = document.getElementById("txtNombre").value.trim();
        let txtUsuario = document.getElementById("txtUsuario").value.trim();
        let lstNivelAcceso = document.getElementById("txtNombre").value.trim();
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
                                `<button class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Bloquear">
                                    <i class="fas fa-ban"></i>
                                </button>`
                                :
                                `<button class="btn btn-success btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Desbloquear">
                                    <i class="fas fa-ban"></i>
                                </button>`
                            }
                                <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
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
                    // seteamos los datos para edición
                    document.getElementById("hdnUsuario").value = arrayUsuarios[0].idUsuario;
                    document.getElementById("btn-limpiar-formulario").style.display = "";
                    document.getElementById("label-txtPassword").innerHTML = "Cambiar contraseña";
                    document.getElementById("txtNombre").value = arrayUsuarios[0].nombre;
                    document.getElementById("txtUsuario").value = arrayUsuarios[0].usuario;
                    document.getElementById("lstNivelAcceso").value = arrayUsuarios[0].nivelAcceso;
                }
                swal.close();
            },
            error: (error, status) => {
                console.log("error", error);
                swal("", error.responseText, "error");
            }
        });
    }

    function limpiarFormulario() {
        document.getElementById("hdnUsuario").value = "";
        document.getElementById("btn-limpiar-formulario").style.display = "none";
        document.getElementById("label-txtPassword").innerHTML = "Contraseña";
        document.getElementById("txtNombre").value = "";
        document.getElementById("txtUsuario").value = "";
        document.getElementById("lstNivelAcceso").value = "";
        document.getElementById("txtPassword").value = "";
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