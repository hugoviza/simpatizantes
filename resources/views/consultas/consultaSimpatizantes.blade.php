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

    <div class="row mt-4">
        <div class="col-sm-12">
            <h5>Simpatizantes registrados</h5>
        </div>
        <div class="col">
            <table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
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
        });

        function listarSimpatizantes() {
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
                                <td>${simpatizante.claveSeccion}</td>
                                <td>${simpatizante.localidad}</td>
                                <td>${armarDomicilio(simpatizante)} </td>
                                <td>${simpatizante.telefono}</td>
                                <td>${simpatizante.promotor}</td>
                                <td style="text-align: center">
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
