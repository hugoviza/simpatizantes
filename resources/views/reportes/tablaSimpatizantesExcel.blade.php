<table class="" style="width: 100%">
    <thead>
        <tr>
            <th style="text-align: left; width: 30px;">Nombre</th>
            <th style="text-align: left; width: 30px;">Fecha registro</th>
            <th style="text-align: left; width: 30px;">Clave elector</th>
            <th style="text-align: left; width: 30px;">Número elector</th>
            <th style="text-align: left; width: 30px;">Curp</th>
            <th style="text-align: right; width: 30px;">Teléfono</th>
            <th style="text-align: left; width: 30px;">Dirección</th>
            <th style="text-align: left; width: 30px;">Localidad</th>
            <th style="text-align: right; width: 30px;">Sección</th>
            <th style="text-align: left; width: 30px;">Promotor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td style="width: 30px;">@php
                    echo $item->nombre . " "
                    . ($item->apellidoPaterno ? "$item->apellidoPaterno " : "") 
                    . ($item->apellidoMaterno ? "$item->apellidoMaterno " : "") ;
                @endphp</td>
                <td style="width: 30px">{{ $item->fechaHoraAlta }}</td>
                <td style="width: 30px">{{ $item->claveElector }}</td>
                <td style="text-align: left; width: 30px;">{{ $item->numeroElector }}</td>
                <td style="width: 30px">{{ $item->curp }}</td>
                <td style="text-align: right; width: 30px;">{{ $item->telefono }}</td>
                <td style="width: 30px">@php
                    echo $item->domicilio . " "
                    . ($item->numExt ? "#$item->numExt" : "") 
                    . ($item->numInt ? " num. int. $item->numInt" : "") 
                    . ($item->numExt ? " #$item->numExt" : "") 
                    . ($item->colonia ? ", $item->colonia" : "") 
                    . ($item->codigoPostal ? " $item->codigoPostal" : "") ;
                @endphp</td>
                <td style="width: 30px">{{ $item->localidad }}</td>
                <td style="text-align: right; width: 30px">{{ $item->claveSeccion }}</td>
                <td style="text-align: left; width: 30px">{{ $item->promotor }}</td>
            </tr>
        @endforeach
    </tbody>
</table>