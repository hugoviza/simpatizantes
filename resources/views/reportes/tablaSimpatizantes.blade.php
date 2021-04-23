<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simpatizantes</title>
    <link href="{{ asset('plantilla_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body style="font-size: .7em">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Clave elector</th>
                <th>Número elector</th>
                <th>Curp</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Localidad</th>
                <th>Sección</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>@php
                        echo $item->nombre . " "
                        . ($item->apellidoPaterno ? "$item->apellidoPaterno " : "") 
                        . ($item->apellidoMaterno ? "$item->apellidoMaterno " : "") ;
                    @endphp</td>
                    <td>{{ $item->claveElector }}</td>
                    <td>{{ $item->numeroElector }}</td>
                    <td>{{ $item->curp }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>@php
                        echo $item->domicilio . " "
                        . ($item->numExt ? "#$item->numExt" : "") 
                        . ($item->numInt ? " num. int. $item->numInt" : "") 
                        . ($item->numExt ? " #$item->numExt" : "") 
                        . ($item->colonia ? ", $item->colonia" : "") 
                        . ($item->codigoPostal ? " $item->codigoPostal" : "") ;
                    @endphp</td>
                    <td>{{ $item->localidad }}</td>
                    <td>{{ $item->claveSeccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>