function abrirLoading(mensaje = 'Cargando..') {
    let divSpinner = document.createElement('div');
    divSpinner.innerHTML = '<span class="text-center"></span>';
    divSpinner.classList.add('spinner-border');
    divSpinner.classList.add('text-primary');
    divSpinner.setAttribute('role', 'status');

    let divMensaje = document.createElement('div');
    divMensaje.innerHTML = mensaje;
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

function enableInputLoading(element) {
    let divSpinner = document.createElement('div');
    divSpinner.innerHTML = '<span class="text-center"></span>';
    divSpinner.classList.add('spinner-border');
    divSpinner.classList.add('text-primary');
    divSpinner.setAttribute('role', 'status');
    divSpinner.style.position = 'absolute';
    divSpinner.style.top = '0';
    divSpinner.style.bottom = '0';
    divSpinner.style.right = '10px';
    divSpinner.style.margin = 'auto';
    divSpinner.style.width = '20px';
    divSpinner.style.height = '20px';
    divSpinner.style.zIndex = '3';
    element.appendChild(divSpinner)
}

function disableInputLoading(element) {
    element.childNodes.forEach((child) => { 
        if(child.classList && child.classList.contains('spinner-border')) { 
            element.removeChild(child);
        } 
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

function addSlashes(text) {
    return (text+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
}