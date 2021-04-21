function abrirLoading(mensaje = 'Cargando..') {
    let divSpinner = document.createElement('div');
    divSpinner.innerHTML = '<span class="text-center"></span>';
    divSpinner.classList.add('spinner-border');
    divSpinner.classList.add('text-primary');
    divSpinner.setAttribute('role', 'status');

    let divMensaje = document.createElement('div');
    divMensaje.innerHTML = 'Cargando...';
    divMensaje.classList.add("text-center");
    divMensaje.classList.add("mt-4");

    let divContenedor = document.createElement('div');
    divContenedor.appendChild(divSpinner);
    divContenedor.appendChild(divMensaje);

    swal({ 
        content: divContenedor,
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: false,
        className: 'swal-width-sm'
    });
}

function ValidarNumerosYLetras(e) {
    var keyCode = e.keyCode || e.which;
    //Regex for Valid Characters i.e. Alphabets and Numbers.
    var regex = /^[A-Za-z0-9]+$/;
    //Validate TextBox value against the Regex.
    var isValid = regex.test(String.fromCharCode(keyCode));
    return isValid;
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}