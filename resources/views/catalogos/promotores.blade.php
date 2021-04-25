@extends('layouts.app')

@section('title', 'Promotores')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catálogo de promotores</h1>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#card-registro" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="card-registro">
                    <h6 class="m-0 font-weight-bold text-primary">Formulario de registro de promotores</h6>
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
                                <input type="hidden" id="hdnPromotor" value="">
                                <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese nombre" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar nombre de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtApellidoPaterno" class="form-label">Apellido Paterno*</label>
                                <input type="text" class="form-control" id="txtApellidoPaterno" placeholder="Ingrese apellido paterno" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar apellido paterno de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtApellidoMaterno" class="form-label">Apellido Materno*</label>
                                <input type="text" class="form-control" id="txtApellidoMaterno" placeholder="Ingrese apellido materno" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar apellido materno de promotor.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCurp" class="form-label">CURP</label>
                                <input type="text" class="form-control" id="txtCurp" placeholder="Ingrese CURP" value="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)" onkeyup="this.value = this.value.toUpperCase();" maxlength="18">
                                <div class="invalid-feedback">
                                    Se requiere ingresar CURP de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtClaveElector" class="form-label">Clave de elector*</label>
                                <input type="text" class="form-control" id="txtClaveElector" placeholder="Ingrese clave de elector" value="" required="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event);" onkeyup="this.value = this.value.toUpperCase();" maxlength="18">
                                <div class="invalid-feedback">
                                    Se requiere ingresar clave de elector de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtNumeroElector" class="form-label">Número elector</label>
                                <input type="text" class="form-control" id="txtNumeroElector" placeholder="Ingrese número de elector" value="" autocomplete="off" onkeypress="return isNumber(event)">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número de elector de promotor.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCelular" class="form-label">Celular*</label>
                                <input type="text" class="form-control" id="txtCelular" placeholder="Ingrese número celular" value="" required="" autocomplete="off" onkeypress="return isNumber(event)" maxlength="10">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número de celular de promotor.
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
                                    Se requiere ingresar dirección de promotor.
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 mb-3">
                                <label for="txtNumeroExterior" class="form-label" title="Número exterior">Núm. exterior*</label>
                                <input type="text" class="form-control" id="txtNumeroExterior" placeholder="Núm. exterior" value="" required="" autocomplete="off" onkeypress="" maxlength="5">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número exterior del domicilio.
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 mb-3">
                                <label for="txtNumeroInterior" class="form-label">Núm. interior</label>
                                <input type="text" class="form-control" id="txtNumeroInterior" placeholder="Núm. interior" value="" autocomplete="off" onkeypress="" maxlength="5">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número interior del domicilio.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtColonia" class="form-label">Colonia*</label>
                                <input type="text" class="form-control" id="txtColonia" placeholder="Ingrese colonia" value="" required="" autocomplete="off" onkeypress="">
                                <div class="invalid-feedback">
                                    Se requiere ingresar colonia de promotor.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCodigoPostal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="txtCodigoPostal" placeholder="Ingrese código postal" value="" autocomplete="off" onkeypress="return isNumber(event)" maxlength="5">
                                <div class="invalid-feedback">
                                    Se requiere ingresar código postal de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtLocalidad" class="form-label">Localidad*</label>
                                <input type="text" class="form-control" id="txtLocalidad" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                                <input type="hidden" id="hdnLocalidad">
                                <div class="invalid-feedback">
                                    Se requiere ingresar localidad de promotor.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtSeccion" class="form-label">Sección*</label>
                                <input type="text" class="form-control" id="txtSeccion" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                                <input type="hidden" id="hdnSeccion">
                                <div class="invalid-feedback">
                                    Se requiere ingresar clave de sección de promotor.
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

    <!-- PROMOTORES -->
    <div class="row mt-4">
        <div class="col-12">
            <h5>Promotores registrados</h5>
        </div>
    </div>

    <!-- FILTROS -->
    <div class="row mt-5 mb-4">
        <div class="col-xl-6 col-md-6 mb-2">
            <label for="txtNombre_filtro" class="form-label">Promotor</label>
            <input type="text" class="form-control" id="txtNombre_filtro" placeholder="Ingrese nombres, apellidos, curp, clave ine, número ine (busqueda libre)" value="" required="" autocomplete="off" onkeypress="">
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtLocalidad_filtro" class="form-label">Localidad</label>
            <div class="input-group input-loading" id="input-loading-localidad">
                <input type="text" class="form-control" id="txtLocalidad_filtro" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                <input type="hidden" id="hdnLocalidad_filtro">
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtSeccion_filtro" class="form-label">Sección</label>
            <div class="input-group input-loading" id="input-loading-seccion">
                <input type="text" class="form-control" id="txtSeccion_filtro" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                <input type="hidden" id="hdnSeccion_filtro">
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-2">
            <label for="txtSeccion" class="form-label">Fecha registro</label>
            
            <div class="input-group">
                <input type="text" class="form-control" id="txtFechaInicio" placeholder="Fecha inicio (dia/mes/año)" autocomplete="off" onchange="validarFechaSeleccionada(this)" value="@php echo date('d/m/Y') @endphp">
                <div class="input-group-prepend">
                    <span class="input-group-text" id=""> y </span>
                </div>
                <input type="text" class="form-control" id="txtFechaFin" placeholder="Fecha final (dia/mes/año)" autocomplete="off" onchange="validarFechaSeleccionada(this)">
            </div>

        </div>

        <div class="col-xl-6 col-md-6 mb-2">
            <button class="btn btn-primary btn-icon-split float-right" onclick="obtenerListaPromotores()" style="margin-top: 24px">
                <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                </span>
                <span class="text" style="min-width: 150px">Buscar</span>
            </button>
        </div>

        <div class="col-12">
            
        </div>
    </div>
    <!-- FIN FILTROS -->

    <div class="row mt-2">
        <div class="col-12">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha registro</th>
                        <th>CURP</th>
                        <th>Clave elector</th>
                        <th>Número elector</th>
                        <th>Celular</th>
                        <th>Domicilio</th>
                        <th>Localidad</th>
                        <th>Sección</th>
                        <th style="text-align: center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body-promotores">
                    <tr>
                        <td colspan="10">No se encontraron promotores</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>

        $(document).ready(() => {
            obtenerListaPromotores();

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

            // Filtros
            // filtros
                $( "#txtFechaInicio" ).datepicker({
                    minDate: new Date(2021, 03, 1),
                    prevText: "Anterior",
                    nextText: "Siguiente",
                    dateFormat: "dd/mm/yy",
                });

                $( "#txtFechaFin" ).datepicker({
                    minDate: new Date(2021, 03, 1),
                    prevText: "Anterior",
                    nextText: "Siguiente",
                    dateFormat: "dd/mm/yy",
                });

                $("#txtLocalidad_filtro").autocomplete({
                    source: function( request, response ) {
                        $("#hdnLocalidad_filtro").val("");
                        enableInputLoading(document.getElementById('input-loading-localidad'));
                        $.ajax({
                            url: "{{ asset('/localidades/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-localidad'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-localidad'));
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
                        $("#txtLocalidad_filtro").val(ui.item.label);
                        $("#hdnLocalidad_filtro").val(ui.item.value);
                        return false;
                    },
                });

                $("#txtSeccion_filtro").autocomplete({
                    source: function( request, response ) {
                        $("#hdnSeccion_filtro").val("");
                        enableInputLoading(document.getElementById('input-loading-seccion'));
                        $.ajax({
                            url: "{{ asset('/secciones/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-seccion'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-seccion'));
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
                        $("#txtSeccion_filtro").val(ui.item.label);
                        $("#hdnSeccion_filtro").val(ui.item.value);
                        return false;
                    },
                });
            // fin filtros
        });

        function obtenerListaPromotores() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/promotores') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nombre: document.getElementById('txtNombre_filtro').value.trim(),
                    idSeccion: document.getElementById('hdnSeccion_filtro').value.trim(),
                    idLocalidad: document.getElementById('hdnLocalidad_filtro').value.trim(),
                    fechaInicio: toDateSQL(document.getElementById('txtFechaInicio').value.trim()),
                    fechaFin: toDateSQL(document.getElementById('txtFechaFin').value.trim()),
                },
                beforeSend: () => {
                    console.log("enviando");
                },
                success: (arrayPromotores) => {

                    let tableBody = document.getElementById("table-body-promotores");
                    if(arrayPromotores.length > 0) {
                        let html = '';
                        arrayPromotores.forEach(promotor => {
                            html += `<tr>
                                <td>${promotor.nombre} ${promotor.apellidoPaterno} ${promotor.apellidoMaterno}</td>
                                <td>${promotor.fechaHoraAlta || ''}</td>
                                <td>${promotor.curp || ''}</td>
                                <td>${promotor.claveElector || ''}</td>
                                <td>${promotor.numeroElector || ''}</td>
                                <td>${promotor.telefono || ''}</td>
                                <td>${armarDomicilio(promotor) || ''} </td>
                                <td>${promotor.localidad || ''}</td>
                                <td>${promotor.claveSeccion || ''}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarPromotor('${promotor.idPromotor}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarPromotor('${promotor.idPromotor}','${addSlashes(promotor.nombre)}');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.innerHTML = html;
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="10">No se encontraron promotores</td></tr>`;
                    }
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function armarDomicilio(promotor) {
            let domicilio = "";

            if(promotor.domicilio != "") 
                domicilio += promotor.domicilio;

            if(promotor.numExt != "") 
                domicilio += (" #" + promotor.numExt);

            if(promotor.numInt != "") 
                domicilio += (" int. " + promotor.numInt);

            if(promotor.colonia != "") 
                domicilio += (", " + promotor.colonia);
            
            if(promotor.codigoPostal != "") 
                domicilio += (", " + promotor.codigoPostal);

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

                if(!hdnLocalidad.length) {
                    swal("", "Seleccione una localidad válida", "warning");
                } else  if (!hdnSeccion.length) {
                    swal("", "Seleccione una sección válida", "warning");
                }

            } else {
                guardarPromotor();
            }
        }

        function guardarPromotor() {
            let contenedor = document.getElementById("contenedor-formulario");
            if(contenedor.classList.contains('was-validated')) {
                contenedor.classList.remove('was-validated');
            }

            let hdnPromotor = document.getElementById("hdnPromotor").value.trim();
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


            $.ajax({
                method: "PUT",
                url: "{{ asset('/promotores') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    idPromotor: hdnPromotor,
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
                },
                beforeSend: () => {
                    abrirLoading();
                },
                success: (response) => {
                    console.log("guardarPromotor >>> ", response);
                    swal("", response, "success");
                    limpiarFormulario();
                    obtenerListaPromotores();
                },
                error: (error, status) => {
                    console.log("error", error);
                    obtenerListaPromotores();
                    swal("", error.responseText, "error");
                }
            });
        }

        function onClick_editarPromotor(idPromotor) {
            $.ajax({
                method: "POST",
                url: "{{ asset('/promotores') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {idPromotor},
                beforeSend: () => {
                    abrirLoading();
                },
                success: (arrayPromotores) => {

                    if(arrayPromotores.length > 0) {
                        limpiarFormulario();

                        // seteamos los datos para edición
                        let hdnPromotor = document.getElementById("hdnPromotor").value = arrayPromotores[0].idPromotor;
                        let txtNombre = document.getElementById("txtNombre").value = arrayPromotores[0].nombre;
                        let txtApellidoPaterno = document.getElementById("txtApellidoPaterno").value = arrayPromotores[0].apellidoPaterno;
                        let txtApellidoMaterno = document.getElementById("txtApellidoMaterno").value = arrayPromotores[0].apellidoMaterno;
                        let txtCurp = document.getElementById("txtCurp").value = arrayPromotores[0].curp;
                        let txtClaveElector = document.getElementById("txtClaveElector").value = arrayPromotores[0].claveElector;
                        let txtNumeroElector = document.getElementById("txtNumeroElector").value = arrayPromotores[0].numeroElector;
                        let txtCelular = document.getElementById("txtCelular").value = arrayPromotores[0].telefono;
                        let txtDireccion = document.getElementById("txtDireccion").value = arrayPromotores[0].domicilio;
                        let txtNumeroExterior = document.getElementById("txtNumeroExterior").value = arrayPromotores[0].numExt;
                        let txtNumeroInterior = document.getElementById("txtNumeroInterior").value = arrayPromotores[0].numInt;
                        let txtColonia = document.getElementById("txtColonia").value = arrayPromotores[0].colonia;
                        let txtCodigoPostal = document.getElementById("txtCodigoPostal").value = arrayPromotores[0].codigoPostal;
                        let hdnLocalidad = document.getElementById("hdnLocalidad").value = arrayPromotores[0].idLocalidad;
                        let txtLocalidad = document.getElementById("txtLocalidad").value = arrayPromotores[0].localidad;
                        let hdnSeccion = document.getElementById("hdnSeccion").value = arrayPromotores[0].idSeccion;
                        let txtSeccion = document.getElementById("txtSeccion").value = arrayPromotores[0].claveSeccion;

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

        function onClick_eliminarPromotor(idPromotor, nombre) {
            //Primero preguntamos si se requiere bloquear
            swal({
                title: `¿Estás seguro eliminar al promotor ${nombre}?`,
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
                        url: "{{ asset('/promotores') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {idPromotor},
                        beforeSend: () => {
                            abrirLoading();
                        },
                        success: (response) => {
                            obtenerListaPromotores();
                            swal("", response, "success");
                        },
                        error: (error, status) => {
                            obtenerListaPromotores();
                            console.log("error", error);
                            swal("", error.responseText, "error");
                        }
                    });
                }
            });
        }

        function limpiarFormulario() {
            let hdnPromotor = document.getElementById("hdnPromotor").value = "";
            let txtNombre = document.getElementById("txtNombre").value = "";
            let txtApellidoPaterno = document.getElementById("txtApellidoPaterno").value = "";
            let txtApellidoMaterno = document.getElementById("txtApellidoMaterno").value = "";
            let txtCurp = document.getElementById("txtCurp").value = "";
            let txtClaveElector = document.getElementById("txtClaveElector").value = "";
            let txtNumeroElector = document.getElementById("txtNumeroElector").value = "";
            let txtCelular = document.getElementById("txtCelular").value = "";
            let txtDireccion = document.getElementById("txtDireccion").value = "";
            let txtNumeroExterior = document.getElementById("txtNumeroExterior").value = "";
            let txtNumeroInterior = document.getElementById("txtNumeroInterior").value = "";
            let txtColonia = document.getElementById("txtColonia").value = "";
            let txtCodigoPostal = document.getElementById("txtCodigoPostal").value = "";
            let hdnLocalidad = document.getElementById("hdnLocalidad").value = "";
            let txtLocalidad = document.getElementById("txtLocalidad").value = "";
            let hdnSeccion = document.getElementById("hdnSeccion").value = "";
            let txtSeccion = document.getElementById("txtSeccion").value = "";

            document.getElementById("btn-limpiar-formulario").style.display = "none";
            document.getElementById("span-btn-guardar").innerHTML = "Agregar";
        }
    </script>
@endsection