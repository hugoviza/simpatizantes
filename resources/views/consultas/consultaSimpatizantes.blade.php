@extends('layouts.app')

@section('title', 'Consulta')

@section('content')

    <div class="row">

        <!-- RESUMEN LOCALIDADES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Localidades</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLocalidades }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-map-marker fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESUMEN SECCIONES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Secciones</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $totalSecciones }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-map fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESUMEN PROMOTORES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Promotores
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $totalPromotores }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESUMEN SIMPATIZANTES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Simpatizantes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSimpatizantes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-xl-6 col-md-6 mb-2">
            <label for="txtNombre" class="form-label">Simpatizante</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese nombres, apellidos, curp, clave ine, número ine (busqueda libre)" value="" required="" autocomplete="off" onkeypress="">
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtPromotor" class="form-label">Promotor</label>
            <div class="input-group input-loading" id="input-loading-promotor">
                <input type="text" class="form-control" id="txtPromotor" placeholder="Ingrese nombre promotor" value="" required="" autocomplete="off" onkeypress="">
                <input type="hidden" id="hdnPromotor">
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <label for="txtLocalidad" class="form-label">Localidad</label>
            <div class="input-group input-loading" id="input-loading-localidad">
                <input type="text" class="form-control" id="txtLocalidad" placeholder="Ingrese localidad" value="" required="" autocomplete="off" onkeypress="">
                <input type="hidden" id="hdnLocalidad">
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
            <label for="txtSeccion" class="form-label">Sección</label>
            <div class="input-group input-loading" id="input-loading-seccion">
                <input type="text" class="form-control" id="txtSeccion" placeholder="Ingrese clave de sección" value="" required="" autocomplete="off" onkeypress="return isNumber(event)">
                <input type="hidden" id="hdnSeccion">
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <a href="#" class="btn btn-primary btn-icon-split float-right" onclick="listarSimpatizantes()" style="margin-top: 24px">
                <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                </span>
                <span class="text" style="min-width: 150px">Buscar</span>
            </a>
        </div>

        <div class="col-12">
            
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-12">
            <h5 style="display: inline-block">Simpatizantes registrados</h5>

            <a href="#" class="btn btn-danger btn-icon-split float-right mb-2 ml-2" onclick="descargarReporte('pdf')">
                <span class="icon text-white-50">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </span>
                <span class="text" style="min-width: 150px">Generar PDF</span>
            </a>
            
            <a href="#" class="btn btn-success btn-icon-split float-right mb-2 ml-2" onclick="descargarReporte('xlsx')">
                <span class="icon text-white-50">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </span>
                <span class="text" style="min-width: 150px">Generar XLSX</span>
            </a>
        </div>
        <div class="col">
            <table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
                        <th>Fecha registro</th>
                        <th>Curp</th>
                        <th>Clave INE</th>
                        <th>Número INE</th>
                        <th>Sección</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Promotor</th>
                        <th>Documentos</th>
                    </tr>
                </thead>
                <tbody id="table-body-simpatizantes">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            listarSimpatizantes();

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
                    $("#txtLocalidad").val(ui.item.label);
                    $("#hdnLocalidad").val(ui.item.value);
                    return false;
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


        function listarSimpatizantes() {
            $.ajax({
                method: "POST",
                url: "{{ asset('/simpatizantes') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nombre: document.getElementById('txtNombre').value.trim(),
                    idPromotor: document.getElementById('hdnPromotor').value.trim(),
                    idSeccion: document.getElementById('hdnSeccion').value.trim(),
                    idLocalidad: document.getElementById('hdnLocalidad').value.trim(),
                    fechaInicio: toDateSQL(document.getElementById('txtFechaInicio').value.trim()),
                    fechaFin: toDateSQL(document.getElementById('txtFechaFin').value.trim()),
                },
                beforeSend: () => {
                    console.log("enviando");
                    abrirLoading('Consultando simpatizantes');
                },
                success: (arraySimpatizantes) => {
                    let tableBody = document.getElementById("table-body-simpatizantes");
                    if(arraySimpatizantes.length > 0) {
                        let html = '';
                        arraySimpatizantes.forEach(simpatizante => {

                            let documentosURL = simpatizante.docsURL.split('|sep|');
                            let documentosName = simpatizante.docsNames.split('|sep|');
                            let botonesDocumentos = '';
                            documentosURL.forEach((url, index) => {
                                if(url != '') {
                                    botonesDocumentos += `<a href="{{ asset('/') }}/storage/${documentosURL[index]}" target="_blank" class="btn btn-primary btn-circle btn-sm  mr-2" data-toggle="tooltip" data-placement="bottom" title="${documentosName[index]}">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </a>`;
                                }
                            });

                            html += `<tr>
                                <td>${simpatizante.nombre} ${simpatizante.apellidoPaterno} ${simpatizante.apellidoMaterno}</td>
                                <td>${simpatizante.fechaHoraAlta || ''}</td>
                                <td>${simpatizante.curp || ''}</td>
                                <td>${simpatizante.claveElector || ''}</td>
                                <td>${simpatizante.numeroElector || ''}</td>
                                <td>${simpatizante.claveSeccion || ''}</td>
                                <td>${simpatizante.localidad || ''}</td>
                                <td>${armarDomicilio(simpatizante) || ''} </td>
                                <td>${simpatizante.telefono || ''}</td>
                                <td>${simpatizante.promotor || ''}</td>
                                <td style="text-align: center">${botonesDocumentos}</td>
                            </tr>`;
                        });
                        tableBody.innerHTML = html;
                        $('[data-toggle="tooltip"]').tooltip();
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="10">No se encontraron simpatizantes</td></tr>`;
                    }
                    swal.close();
                },
                error: (error, status) => {
                    console.log("error", error);
                    swal("", error.responseText, "error");
                }
            });
        }

        function descargarReporte(tipoReporte = 'pdf') {
            let parametros = new URLSearchParams({
                    nombre: document.getElementById('txtNombre').value.trim(),
                    idPromotor: document.getElementById('hdnPromotor').value.trim(),
                    idSeccion: document.getElementById('hdnSeccion').value.trim(),
                    idLocalidad: document.getElementById('hdnLocalidad').value.trim(),
                    fechaInicio: toDateSQL(document.getElementById('txtFechaInicio').value.trim()),
                    fechaFin: toDateSQL(document.getElementById('txtFechaFin').value.trim()),
                });
            if(tipoReporte == 'xlsx') {
                var link = document.createElement('a');
                link.href =  "{{ asset('/simpatizantes/reporte') }}/"+tipoReporte+'?'+parametros;
                link.download = 'simpatizantes.xlsx';
                link.dispatchEvent(new MouseEvent('click'));
            } else {
                window.open(
                    "{{ asset('/simpatizantes/reporte') }}/"+tipoReporte+'?'+parametros,
                    "DescriptiveWindowName",
                    "resizable,scrollbars,status"
                );
            }
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
    </script>
@endsection
