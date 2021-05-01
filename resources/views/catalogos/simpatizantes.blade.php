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
                                <input type="text" class="form-control" id="txtCurp" placeholder="Ingrese CURP" value="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event)" onkeyup="this.value = this.value.toUpperCase();" maxlength="18">
                                <div class="invalid-feedback">
                                    Se requiere ingresar CURP de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtClaveElector" class="form-label">Clave de elector*</label>
                                <input type="text" class="form-control" id="txtClaveElector" placeholder="Ingrese clave de elector" value="" required="" autocomplete="off" onkeypress="return ValidarNumerosYLetras(event);" onkeyup="this.value = this.value.toUpperCase();" maxlength="18">
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
                                <input type="text" class="form-control" id="txtCelular" placeholder="Ingrese número celular" value="" required="" autocomplete="off" onkeypress="return isNumber(event)" maxlength="10">
                                <div class="invalid-feedback">
                                    Se requiere ingresar número de celular de simpatizante.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtPromotor" class="form-label">Promotor*</label>
                                <div class="input-group input-loading" id="input-loading-promotor">
                                    <input type="text" class="form-control reset-hdn-onchange" id="txtPromotor" placeholder="Ingrese nombre promotor" value="" required="" autocomplete="off" onkeypress="">
                                    <input type="hidden" id="hdnPromotor">
                                </div>
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
                                    Se requiere ingresar colonia de simpatizante.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtCodigoPostal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="txtCodigoPostal" placeholder="Ingrese código postal" value="" autocomplete="off" onkeypress="return isNumber(event)" maxlength="5">
                                <div class="invalid-feedback">
                                    Se requiere ingresar código postal de simpatizante.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtLocalidad" class="form-label">Localidad*</label>
                                <div class="input-group input-loading" id="input-loading-localidad">
                                    <input type="text" class="form-control reset-hdn-onchange" id="txtLocalidad" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                                    <input type="hidden" id="hdnLocalidad">
                                </div>
                                <div class="invalid-feedback">
                                    Se requiere seleccionar localidad de simpatizante válida.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-3">
                                <label for="txtSeccion" class="form-label">Sección*</label>
                                <div class="input-group input-loading" id="input-loading-seccion">
                                    <input type="text" class="form-control reset-hdn-onchange" id="txtSeccion" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                                    <input type="hidden" id="hdnSeccion">
                                </div>
                                <div class="invalid-feedback">
                                    Se requiere seleccionar una clave de sección de simpatizante válida.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="txtSeccion" class="form-label">Documento 1</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file1" accept="image/x-png,image/jpeg,application/pdf" onchange="validarDocumento(this)">
                                    <label class="custom-file-label" for="file1">Seleccione IMAGEN / PDF</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="txtSeccion" class="form-label">Documento 2</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file2" accept="image/x-png,image/jpeg,application/pdf" onchange="validarDocumento(this)">
                                    <label class="custom-file-label" for="file2">Seleccione IMAGEN / PDF</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
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

    <!-- SIMPATIZANTES -->
    <div class="row mt-4">
        <div class="col-12">
            <h5>simpatizantes registrados</h5>
        </div>
    </div>

    <!-- FILTROS -->
    <div class="row mt-5 mb-4">
        <div class="col-xl-6 col-md-6 mb-2">
            <label for="txtNombre_filtro" class="form-label">Simpatizante</label>
            <input type="text" class="form-control" id="txtNombre_filtro" placeholder="Ingrese nombres, apellidos, curp, clave ine, número ine (busqueda libre)" value="" required="" autocomplete="off" onkeypress="">
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtPromotor_filtro" class="form-label">Promotor</label>
            <div class="input-group input-loading" id="input-loading-promotor-filtro">
                <input type="text" class="form-control reset-hdn-onchange" id="txtPromotor_filtro" placeholder="Ingrese nombre promotor" value="" required="" autocomplete="off" onkeypress="">
                <input type="hidden" id="hdnPromotor_filtro">
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtLocalidad_filtro" class="form-label">Localidad</label>
            <div class="input-group input-loading reset-hdn-onchange" id="input-loading-localidad-filtro">
                <input type="text" class="form-control" id="txtLocalidad_filtro" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                <input type="hidden" id="hdnLocalidad_filtro">
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

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtSeccion_filtro" class="form-label">Sección</label>
            <div class="input-group input-loading" id="input-loading-seccion-filtro">
                <input type="text" class="form-control reset-hdn-onchange" id="txtSeccion_filtro" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                <input type="hidden" id="hdnSeccion_filtro">
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <button class="btn btn-primary btn-icon-split float-right" onclick="obtenerListaSimpatizantes()" style="margin-top: 24px">
                <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                </span>
                <span class="text" style="min-width: 150px">Buscar</span>
            </button>
        </div>

        <div class="col-12">
            
        </div>
    </div>

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

            // reseteamos los hdn cuando cambie el texto
            $(".reset-hdn-onchange").change((event) => {
                if(event.currentTarget.value.trim() == '') {
                    let idInput = event.currentTarget.getAttribute('id');
                    let idInputHdn = idInput ? idInput.replace('txt', 'hdn') : undefined;
                    let inputHdn = document.getElementById(idInputHdn);

                    if(inputHdn) {
                        inputHdn.value = '';
                    }
                }
            });

            // registros
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

                $("#txtPromotor").autocomplete({
                    source: function( request, response ) {
                        $("#hdnPromotor").val("");
                        enableInputLoading(document.getElementById('input-loading-promotor'));
                        $.ajax({
                            url: "{{ asset('/promotores/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-promotor'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-promotor'));
                            }
                        });
                    },
                    select: function( event, ui ) {
                        $("#hdnPromotor").val(ui.item.idPromotor);
                    },
                });

                $("#txtLocalidad").autocomplete({
                    source: function( request, response ) {
                        $("#hdnLocalidad").val("");
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
                    select: function( event, ui ) {
                        $("#hdnLocalidad").val(ui.item.idLocalidad);
                    },
                });

                $("#txtSeccion").autocomplete({
                    source: function( request, response ) {
                        $("#hdnSeccion").val("");
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
                    select: function( event, ui ) {
                        $("#hdnSeccion").val(ui.item.idSeccion);
                    },
                });
            // fin registros

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

                $("#txtPromotor_filtro").autocomplete({
                    source: function( request, response ) {
                        $("#hdnPromotor_filtro").val("");
                        enableInputLoading(document.getElementById('input-loading-promotor-filtro'));
                        $.ajax({
                            url: "{{ asset('/promotores/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-promotor-filtro'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-promotor-filtro'));
                            }
                        });
                    },
                    select: function( event, ui ) {
                        $("#hdnPromotor_filtro").val(ui.item.idPromotor);
                    },
                });

                $("#txtLocalidad_filtro").autocomplete({
                    source: function( request, response ) {
                        $("#hdnLocalidad_filtro").val("");
                        enableInputLoading(document.getElementById('input-loading-localidad-filtro'));
                        $.ajax({
                            url: "{{ asset('/localidades/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-localidad-filtro'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-localidad-filtro'));
                            }
                        });
                    },
                    select: function( event, ui ) {
                        $("#hdnLocalidad_filtro").val(ui.item.idLocalidad);
                    },
                });

                $("#txtSeccion_filtro").autocomplete({
                    source: function( request, response ) {
                        $("#hdnSeccion_filtro").val("");
                        enableInputLoading(document.getElementById('input-loading-seccion-filtro'));
                        $.ajax({
                            url: "{{ asset('/secciones/autocomplete') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                txtBusqueda: request.term
                            },
                            success: function( data ) {
                                disableInputLoading(document.getElementById('input-loading-seccion-filtro'));
                                response( data );
                            },
                            error: () => {
                                disableInputLoading(document.getElementById('input-loading-seccion-filtro'));
                            }
                        });
                    },
                    select: function( event, ui ) {
                        $("#hdnSeccion_filtro").val(ui.item.idSeccion);
                    },
                });
            // fin filtros


        });

        function obtenerListaSimpatizantes() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/simpatizantes') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nombre: document.getElementById('txtNombre_filtro').value.trim(),
                    idPromotor: document.getElementById('hdnPromotor_filtro').value.trim(),
                    idSeccion: document.getElementById('hdnSeccion_filtro').value.trim(),
                    idLocalidad: document.getElementById('hdnLocalidad_filtro').value.trim(),
                    fechaInicio: toDateSQL(document.getElementById('txtFechaInicio').value.trim()),
                    fechaFin: toDateSQL(document.getElementById('txtFechaFin').value.trim()),
                },
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
                                <td>${simpatizante.claveElector || ''}</td>
                                <td>${simpatizante.numeroElector || ''}</td>
                                <td>${simpatizante.telefono || ''}</td>
                                <td>${armarDomicilio(simpatizante)} </td>
                                <td>${simpatizante.localidad || ''}</td>
                                <td>${simpatizante.claveSeccion || ''}</td>
                                <td>${simpatizante.promotor || ''}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="onClick_editarSimpatizante('${simpatizante.idSimpatizante}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="onClick_eliminarSimpatizante('${simpatizante.idSimpatizante}','${ addSlashes(simpatizante.nombre) }');">
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

            subirDocumentos()
            .then((arrayDocumentos) => {
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
                        arrayDocumentos
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
            })
            .catch((error) => {
                console.log(error);
                swal('', 'Error al guardar', 'error');
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
            $("#file1").val('');
            $("#file2").val('');
            $("#file1").siblings(".custom-file-label").addClass("selected").html('Seleccione IMAGEN / PDF');
            $("#file2").siblings(".custom-file-label").addClass("selected").html('Seleccione IMAGEN / PDF');

        }

        function validarDocumento(input) {
            let arrayNombre = input.value.trim().split('.');
            let arrayExtensionesPermitidas = ['pdf', 'jpg', 'png', 'jpeg'];
            if(!arrayExtensionesPermitidas.includes(arrayNombre[arrayNombre.length - 1].toLowerCase())) {
                swal('', 'El tipo de documento seleccionado no está permitido, solo se permiten documentos con extensiones pdf, jpg, png, jpeg' , 'error');
                input.value = null;
                // $(input).siblings(".custom-file-label").removeClass("selected").html('Seleccione IMAGEN / PDF');
            }
        }

        function subirDocumentos() {
            var formData = new FormData();
            var files1 = $('#file1')[0].files;
            var files2 = $('#file2')[0].files;
            
            // Check file selected or not
            if(files1.length > 0 ) {
                formData.append('file1',files1[0]);
            }
            
            if(files2.length > 0 ) {
                formData.append('file2',files2[0]);
            }

            return new Promise((resolve, reject) => {

                if(files1.length == 0 && files1.length == 0) {
                    resolve(['','']);
                }
                $.ajax({
                    method: "post",
                    url: "{{ asset('/simpatizantes/documentos') }}",
                    // url: "http://localhost/test/upload.php",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        abrirLoading();
                    },
                    success: (response) => {
                        resolve(response);
                    },
                    error: (error, status) => {
                        reject(error.responseText);
                    }
                });
            });
        }
    </script>
@endsection