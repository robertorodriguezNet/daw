window.onload = () => {

    // Inicializar los componentes
    form_date = document.getElementById('form-date');
    inp_date = document.getElementById('inp-date');

    // Eventos de los componentes
    inp_date.addEventListener('change',send);
}

// Componentes
let form_date;
let inp_date;

// Enviar el formulario
let send = () => {
    form_date.submit();
}