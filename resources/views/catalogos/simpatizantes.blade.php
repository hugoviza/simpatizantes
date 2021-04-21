@extends('layouts.app')

@section('title', 'simpatizantes')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catálogo de simpatizantes</h1>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#card-registro" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="card-registro">
                    <h6 class="m-0 font-weight-bold text-primary">Formulario de registro de simpatizantes</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="card-registro" style="">
                    <div class="card-body" id="contenedor-formulario">
                        <div class="row">
                            <div class="col-sm-12">
                                <strong>Información personal</strong>
                                <hr class="mt-0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtNombre" class="form-label">Nombre*</label>
                                <input type="hidden" id="hdnSimpatizante" value="">
                                <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese nombre" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar nombre de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtApellidoPaterno" class="form-label">Apellido Paterno*</label>
                                <input type="text" class="form-control" id="txtApellidoPaterno" placeholder="Ingrese apellido paterno" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar apellido paterno de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtApellidoMaterno" class="form-label">Apellido Materno*</label>
                                <input type="text" class="form-control" id="txtApellidoMaterno" placeholder="Ingrese apellido materno" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar apellido materno de simpatizante.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCurp" class="form-label">CURP</label>
                                <input type="text" class="form-control" id="txtCurp" placeholder="Ingrese CURP" value="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)">
                                <div class="invalid-feedback">
                                    Se requiere ingresar CURP de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtClaveElector" class="form-label">Clave de elector*</label>
                                <input type="text" class="form-control" id="txtClaveElector" placeholder="Ingrese clave de elector" value="" required="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event);">
                                <div class="invalid-feedback">
                                    Se requiere ingresar clave de elector de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtNumeroElector" class="form-label">Número elector</label>
                                <input type="text" class="form-control" id="txtNumeroElector" placeholder="Ingrese número de elector" value="" autocomplete="off" onkeypress="return isNumber(event)">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número de elector de simpatizante.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCelular" class="form-label">Celular*</label>
                                <input type="text" class="form-control" id="txtCelular" placeholder="Ingrese número celular" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número de celular de simpatizante.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtPromotor" class="form-label">Promotor</label>
                                <input type="text" class="form-control" id="txtPromotor" placeholder="Ingrese nombre promotor" value="" required="" autocomplete="off" onkeypress="">
                                <input type="hidden" id="hdnPromotor">
                                <div class="invalid-feedback">
                                    Se requiere ingresar nombre de promotor.
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <strong>Domicilio</strong>
                                <hr class="mt-0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtDireccion" class="form-label">Dirección*</label>
                                <input type="text" class="form-control" id="txtDireccion" placeholder="Ingrese dirección" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar dirección de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 mb-3">
                                <label for="txtNumeroExterior" class="form-label" title="Número exterior">Núm. exterior*</label>
                                <input type="text" class="form-control" id="txtNumeroExterior" placeholder="Núm. exterior" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número exterior del domicilio.
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 mb-3">
                                <label for="txtNumeroInterior" class="form-label">Núm. interior</label>
                                <input type="text" class="form-control" id="txtNumeroInterior" placeholder="Núm. interior" value="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número interior del domicilio.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtColonia" class="form-label">Colonia*</label>
                                <input type="text" class="form-control" id="txtColonia" placeholder="Ingrese colonia" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar colonia de simpatizante.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCodigoPostal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="txtCodigoPostal" placeholder="Ingrese código postal" value="" autocomplete="off" onkeypress="return isNumber(event)">
                                <div class="invalid-feedback">
                                    Se requiere ingresar código postal de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtLocalidad" class="form-label">Localidad*</label>
                                <input type="text" class="form-control" id="txtLocalidad" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                                <input type="hidden" id="hdnLocalidad">
                                <div class="invalid-feedback">
                                    Se requiere ingresar localidad de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtSeccion" class="form-label">Sección*</label>
                                <input type="text" class="form-control" id="txtSeccion" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                                <input type="hidden" id="hdnSeccion">
                                <div class="invalid-feedback">
                                    Se requiere ingresar clave de sección de simpatizante.
                                </div>
                            </div>
                        </div>

                        <div class="row">
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLA PROMOTORES -->
    <div class="row mt-4">
        <div class="col-12">
            <h5>simpatizantes registrados</h5>
        </div>
    </div>

    <div style="height: 19px"></div>

    <div class="row mt-2">
        <div class="col-12">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CURP</th>
                        <th>Clave elector</th>
                        <th>Número elector</th>
                        <th>Celular</th>
                        <th>Domicilio</th>
                        <th>Localidad</th>
                        <th>Sección</th>
                        <th>Promotor</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body-simpatizantes">
                    <tr>
                        <td colspan="10">No se encontraron simpatizantes</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>

        $(document).ready(() => {
            obtenerListaSimpatizantes();

            $("#txtPromotor").autocomplete({
                source: function( request, response ) {
                    $("#hdnPromotor").val("");
                    $.ajax({
                        url: "{{ asset('/promotores/autocomplete') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            txtBusqueda: request.term
                        },
                        success: function( data ) {
                            console.log("resultados", data);
                            response( data );
                        }
                    });
                },
                _renderItem: function( ul, item ) {
                    return $( "<li>" )
                        .attr( "data-value", item.label )
                        .append( item.label )
                        .appendTo( ul );
                },
                select: function( event, ui ) {
                    console.log(ui.item.label)
                    $("#txtPromotor").val(ui.item.label);
                    $("#hdnPromotor").val(ui.item.value);
                    return false;
                },
            });

            $("#txtLocalidad").autocomplete({
                source: function( request, response ) {
                    $("#hdnLocalidad").val("");
                    $.ajax({
                        url: "{{ asset('/localidades/autocomplete') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            txtBusqueda: request.term
                        },
                        success: function( data ) {
                            console.log("resultados", data);
                            response( data );
                        }
                    });
                },
                _renderItem: function( ul, item ) {
                    return $( "<li>" )
                        .attr( "data-value", item.label )
                        .append( item.label )
                        .appendTo( ul );
                },
                select: function( event, ui ) {
                    console.log(ui.item.label)
                    $("#txtLocalidad").val(ui.item.label);
                    $("#hdnLocalidad").val(ui.item.value);
                    return false;
                },
            });

            $("#txtSeccion").autocomplete({
                source: function( request, response ) {
                    $("#hdnSeccion").val("");
                    $.ajax({
                        url: "{{ asset('/secciones/autocomplete') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            txtBusqueda: request.term
                        },
                        success: function( data ) {
                            console.log("resultados", data);
                            response( data );
                        }
                    });
                },
                _renderItem: function( ul, item ) {
                    return $( "<li>" )
                        .attr( "data-value", item.value )
                        .append( item.label )
                        .appendTo( ul );
                },
                select: function( event, ui ) {
                    console.log("select >>> ", ui);
                    $("#txtSeccion").val(ui.item.label);
                    $("#hdnSeccion").val(ui.item.value);
                    return false;
                },
            });
        });

        function obtenerListaSimpatizantes() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/simpatizantes') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                beforeSend: () => {
                    console.log("enviando");
                },
                success: (arraySimpatizantes) => {

                    let tableBody = document.getElementById("table-body-simpatizantes");
                    if(arraySimpatizantes.length > 0) {
                        let html = '';
                        arraySimpatizantes.forEach(simpatizante => {
                            html += `<tr>
                                <td>${simpatizante.nombre} ${simpatizante.apellidoPaterno} ${simpatizante.apellidoMaterno}</td>
                                <td>${simpatizante.curp}</td>
                                <td>${simpatizante.claveElector}</td>
                                <td>${simpatizante.numeroElector}</td>
                                <td>${simpatizante.telefono}</td>
                                <td>${armarDomicilio(simpatizante)} </td>
                                <td>${simpatizante.localidad}</td>
                                <td>${simpatizante.claveSeccion}</td>
                                <td>${simpatizante.promotor}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarSimpatizante('${simpatizante.idSimpatizante}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarSimpatizante('${simpatizante.idSimpatizante}','${simpatizante.nombre}');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.innerHTML = html;
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="10">No se encontraron simpatizantes</td></tr>`;
                    }
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function armarDomicilio(simpatizante) {
            let domicilio = "";

            if(simpatizante.domicilio != "") 
                domicilio += simpatizante.domicilio;

            if(simpatizante.numExt != "") 
                domicilio += (" #" + simpatizante.numExt);

            if(simpatizante.numInt != "") 
                domicilio += (" int. " + simpatizante.numInt);

            if(simpatizante.colonia != "") 
                domicilio += (", " + simpatizante.colonia);
            
            if(simpatizante.codigoPostal != "") 
                domicilio += (", " + simpatizante.codigoPostal);

                return domicilio;
        }

        function validarFormulario() {
            let txtNombre = document.getElementById("txtNombre").value.trim();
            let txtApellidoPaterno = document.getElementById("txtApellidoPaterno").value.trim();
            let txtApellidoMaterno = document.getElementById("txtApellidoMaterno").value.trim();
            let txtClaveElector = document.getElementById("txtClaveElector").value.trim();
            let txtCelular = document.getElementById("txtCelular").value.trim();
            let txtDireccion = document.getElementById("txtDireccion").value.trim();
            let txtNumeroExterior = document.getElementById("txtNumeroExterior").value.trim();
            let txtColonia = document.getElementById("txtColonia").value.trim();
            let hdnLocalidad = document.getElementById("hdnLocalidad").value.trim();
            let hdnSeccion = document.getElementById("hdnSeccion").value.trim();

            if(!txtNombre.length || !txtApellidoPaterno.length || !txtApellidoMaterno.length || !txtClaveElector.length 
                || !txtCelular.length || !txtDireccion.length || !txtNumeroExterior.length || !txtColonia.length || !hdnLocalidad.length || !hdnSeccion.length) {
                let contenedor = document.getElementById("contenedor-formulario");
                if(!contenedor.classList.contains('was-validated')) {
                    contenedor.classList.add('was-validated');
                }
            } else {
                guardarSimpatizante();
            }
        }

        function guardarSimpatizante() {
            let contenedor = document.getElementById("contenedor-formulario");
            if(contenedor.classList.contains('was-validated')) {
                contenedor.classList.remove('was-validated');
            }

            let hdnSimpatizante = document.getElementById("hdnSimpatizante").value.trim();
            let txtNombre = document.getElementById("txtNombre").value.trim();
            let txtApellidoPaterno = document.getElementById("txtApellidoPaterno").value.trim();
            let txtApellidoMaterno = document.getElementById("txtApellidoMaterno").value.trim();
            let txtCurp = document.getElementById("txtCurp").value.trim();
            let txtClaveElector = document.getElementById("txtClaveElector").value.trim();
            let txtNumeroElector = document.getElementById("txtNumeroElector").value.trim();
            let txtCelular = document.getElementById("txtCelular").value.trim();
            let txtDireccion = document.getElementById("txtDireccion").value.trim();
            let txtNumeroExterior = document.getElementById("txtNumeroExterior").value.trim();
            let txtNumeroInterior = document.getElementById("txtNumeroInterior").value.trim();
            let txtColonia = document.getElementById("txtColonia").value.trim();
            let txtCodigoPostal = document.getElementById("txtCodigoPostal").value.trim();
            let hdnLocalidad = document.getElementById("hdnLocalidad").value.trim();
            let txtLocalidad = document.getElementById("txtLocalidad").value.trim();
            let hdnSeccion = document.getElementById("hdnSeccion").value.trim();
            let txtSeccion = document.getElementById("txtSeccion").value.trim();
            let hdnPromotor = document.getElementById("hdnPromotor").value.trim();

            $.ajax({
                method: "PUT",
                url: "{{ asset('/simpatizantes') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idSimpatizante: hdnSimpatizante,
                    idLocalidad: hdnLocalidad,
                    idSeccion: hdnSeccion,
                    nombre: txtNombre,
                    apellidoMaterno: txtApellidoMaterno,
                    apellidoPaterno: txtApellidoPaterno,
                    domicilio: txtDireccion,
                    numExt: txtNumeroExterior,
                    numInt: txtNumeroInterior,
                    colonia: txtColonia,
                    codigoPostal: txtCodigoPostal,
                    claveElector: txtClaveElector,
                    numeroElector: txtNumeroElector,
                    curp: txtCurp,
                    seccion: txtSeccion,
                    localidad: txtLocalidad,
                    telefono: txtCelular,
                    idPromotor: hdnPromotor,
                },
                beforeSend: () => {
                    abrirLoading();
                },
                success: (response) => {
                    console.log("guardarSimpatizante >>> ", response);
                    swal("", response, "success");
                    limpiarFormulario();
                    obtenerListaSimpatizantes();
                },
                error: (error, status) => {
                    console.log("error", error);
                    obtenerListaSimpatizantes();
                    swal("", error.responseText, "error");
                }
            });
        }

        function onClick_editarSimpatizante(idSimpatizante) {
            $.ajax({
                method: "POST",
                url: "{{ asset('/simpatizantes') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {idSimpatizante},
                beforeSend: () => {
                    abrirLoading();
                },
                success: (arraySimpatizantes) => {

                    if(arraySimpatizantes.length > 0) {
                        limpiarFormulario();

                        // seteamos los datos para edición
                        document.getElementById("hdnSimpatizante").value = arraySimpatizantes[0].idSimpatizante;
                        document.getElementById("txtNombre").value = arraySimpatizantes[0].nombre;
                        document.getElementById("txtApellidoPaterno").value = arraySimpatizantes[0].apellidoPaterno;
                        document.getElementById("txtApellidoMaterno").value = arraySimpatizantes[0].apellidoMaterno;
                        document.getElementById("txtCurp").value = arraySimpatizantes[0].curp;
                        document.getElementById("txtClaveElector").value = arraySimpatizantes[0].claveElector;
                        document.getElementById("txtNumeroElector").value = arraySimpatizantes[0].numeroElector;
                        document.getElementById("txtCelular").value = arraySimpatizantes[0].telefono;
                        document.getElementById("txtDireccion").value = arraySimpatizantes[0].domicilio;
                        document.getElementById("txtNumeroExterior").value = arraySimpatizantes[0].numExt;
                        document.getElementById("txtNumeroInterior").value = arraySimpatizantes[0].numInt;
                        document.getElementById("txtColonia").value = arraySimpatizantes[0].colonia;
                        document.getElementById("txtCodigoPostal").value = arraySimpatizantes[0].codigoPostal;
                        document.getElementById("hdnLocalidad").value = arraySimpatizantes[0].idLocalidad;
                        document.getElementById("txtLocalidad").value = arraySimpatizantes[0].localidad;
                        document.getElementById("hdnSeccion").value = arraySimpatizantes[0].idSeccion;
                        document.getElementById("txtSeccion").value = arraySimpatizantes[0].claveSeccion;
                        document.getElementById("hdnPromotor").value = arraySimpatizantes[0].idPromotor;
                        document.getElementById("txtPromotor").value = arraySimpatizantes[0].promotor;

                        document.getElementById("btn-limpiar-formulario").style.display = "";
                        document.getElementById("span-btn-guardar").innerHTML = "Guardar";

                        window.scrollTo( 0, 0 );
                    }
                    swal.close();
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function onClick_eliminarSimpatizante(idSimpatizante, nombre) {
            //Primero preguntamos si se requiere bloquear
            swal({
                title: `¿Estás seguro eliminar al simpatizante ${nombre}?`,
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
                        url: "{{ asset('/simpatizantes') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {idSimpatizante},
                        beforeSend: () => {
                            abrirLoading();
                        },
                        success: (response) => {
                            obtenerListaSimpatizantes();
                            swal("", response, "success");
                        },
                        error: (error, status) => {
                            obtenerListaSimpatizantes();
                            console.log("error", error);
                            swal("", error.responseText, "error");
                        }
                    });
                }
            });
        }

        function limpiarFormulario() {
            document.getElementById("hdnSimpatizante").value = "";
            document.getElementById("txtNombre").value = "";
            document.getElementById("txtApellidoPaterno").value = "";
            document.getElementById("txtApellidoMaterno").value = "";
            document.getElementById("txtCurp").value = "";
            document.getElementById("txtClaveElector").value = "";
            document.getElementById("txtNumeroElector").value = "";
            document.getElementById("txtCelular").value = "";
            document.getElementById("txtDireccion").value = "";
            document.getElementById("txtNumeroExterior").value = "";
            document.getElementById("txtNumeroInterior").value = "";
            document.getElementById("txtColonia").value = "";
            document.getElementById("txtCodigoPostal").value = "";
            document.getElementById("hdnLocalidad").value = "";
            document.getElementById("txtLocalidad").value = "";
            document.getElementById("hdnSeccion").value = "";
            document.getElementById("txtSeccion").value = "";
            document.getElementById("hdnPromotor").value = "";
            document.getElementById("txtPromotor").value = "";

            document.getElementById("btn-limpiar-formulario").style.display = "none";
            document.getElementById("span-btn-guardar").innerHTML = "Agregar";
        }
    </script>
@endsection