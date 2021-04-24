<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simpatizantes</title>
    {{-- <link href="{{ asset('plantilla_admin/css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
    <style>
        table {
            border-collapse: collapse;
        }
        table, td {
            border: 1px solid #e3e6f0;
        }

        th {
            background-color: #e3e6f0;
            border: 1px solid #FFF;
        }

        th, td {
            padding: 0 5px 0 5px;
        }
    </style>
</head>
<body style="font-size: .5em">
    <h1 style="text-align: center">Reporte de simpatizantes</h1>
    <table class="" style="width: 100%">
        <thead>
            <tr>
                <th style="text-align: left; width: 150px;">Nombre</th>
                <th style="text-align: left; width: 50px;">Fecha registro</th>
                <th style="text-align: left; width: 80px;">Clave elector</th>
                <th style="text-align: left; width: 80px;">Número elector</th>
                <th style="text-align: left; width: 80px;">Curp</th>
                <th style="text-align: right; width: 50px;">Teléfono</th>
                <th style="text-align: left; width: 150px;">Dirección</th>
                <th style="text-align: left; width: 100px;">Localidad</th>
                <th style="text-align: right; width: 45px;">Sección</th>
                <th style="text-align: left; width: 100px;">Promotor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td style="width: 150px;">@php
                        echo $item->nombre . " "
                        . ($item->apellidoPaterno ? "$item->apellidoPaterno " : "") 
                        . ($item->apellidoMaterno ? "$item->apellidoMaterno " : "") ;
                    @endphp</td>
                    <td style="width: 80px">{{ $item->fechaHoraAlta }}</td>
                    <td style="width: 80px">{{ $item->claveElector }}</td>
                    <td style="text-align: left; width: 80px;">{{ $item->numeroElector }}</td>
                    <td style="width: 80px">{{ $item->curp }}</td>
                    <td style="text-align: right; width: 80px;">{{ $item->telefono }}</td>
                    <td style="width: 150px">@php
                        echo $item->domicilio . " "
                        . ($item->numExt ? "#$item->numExt" : "") 
                        . ($item->numInt ? " num. int. $item->numInt" : "") 
                        . ($item->numExt ? " #$item->numExt" : "") 
                        . ($item->colonia ? ", $item->colonia" : "") 
                        . ($item->codigoPostal ? " $item->codigoPostal" : "") ;
                    @endphp</td>
                    <td style="width: 100px">{{ $item->localidad }}</td>
                    <td style="text-align: right; width: 45px">{{ $item->claveSeccion }}</td>
                    <td style="text-align: left; width: 100px">{{ $item->promotor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>