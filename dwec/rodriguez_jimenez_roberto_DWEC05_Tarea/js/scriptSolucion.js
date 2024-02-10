window.onload = () => {

    // Declaración de los componentes
    const FORMULARIO = document.getElementById('formulario');

    // Inputs
    const INP_NOMBRE = document.getElementById('nombre');
    const INP_APELLIDOS = document.getElementById('apellidos');

    // Botones
    const BTN_LIMPIAR = document.getElementById('button');
    const BTN_ENVIAR = document.getElementById('enviar');

    // Eventos
    INP_NOMBRE.addEventListener('blur', (e) => {
        toUpper(e);
    });
    INP_NOMBRE.addEventListener('blur', (e) => {
        validarNombreApellido(e);
    });
    INP_APELLIDOS.addEventListener('blur', (e) => {
        toUpper(e);
    });
    INP_APELLIDOS.addEventListener('blur', (e) => {
        validarNombreApellido(e);
    });

    BTN_ENVIAR.addEventListener('click', procesarFormulario);
    BTN_LIMPIAR.addEventListener('click', limpiar);

}

// Funciones ****************************************************

// Procesa el formulario
const procesarFormulario = () => {

    // Establece y actualiza la cookie de intentos de envío del formualario
    setIntento();

    // Escribe los intentos en la página
    escribirIntentos();

    event.preventDefault();

};

// Registrar en su cookie el intento de envio del formulario
function setIntento() {

    // obtener los intentos e incrementarlos
    let intentos = getIntentos();
    intentos++;

    // Tiempo de vida de la cookie: 1 día
    let max_time = 24 * 60 * 60;

    // Establecemos la cookie, útil durante 5 min.
    document.cookie = `${encodeURIComponent('intentos')}=${encodeURIComponent(intentos)};path=/;max-age=${max_time};`;

}

/**
 * Devuelve el valor de la cookie 'intentos'
 */
const getIntentos = () => {
    // function getIntentos(){

    // Patrón buscado
    let pattern = /intentos=\d+/;

    // Obtener las cookies decodificadas
    let cookies = document.cookie;

    // buscar el patrón entre la cadena de cookies
    if (cookies.match(pattern)) {

        // tenemos las cookies con el formato nombre=valor;nombre=valor...
        let array_cookies = cookies.split(';');

        // Hay que conseguir el registro intentos=\d y para ello usamos la función filter 
        // que devuelve un array con las coincidencias
        const result = array_cookies.filter((array_cookies) => array_cookies.match(pattern));

        // Obtenemos un array con las coincidencias, que solo debe ser una
        let intentos = decodeURIComponent(result[0].substring(result[0].indexOf('=') + 1));

        return intentos;

    } else {
        return 0;
    }

}

/**
 * Función que escribe en la pantalla el número de intentos de envío del formualrio.
 */
function escribirIntentos() {
    document.getElementById('intentos').innerHTML = 'Intento de envíos del formualario: ' + getIntentos();
}

/**
 * Transforma el texto del input en mayúsclas
 * @param {object} e componente que recibe la acción 
 */
const toUpper = (e) => {
    e.target.value = e.target.value.toUpperCase();
}

/**
 * Validar los campos nombre y apellido.
 */
const validarNombreApellido = (e) => {

    // No puede haber ningún carácter ni antes ni después.
    // Se pide un conjunto de entre 3 y 12 que debe aparecer exactamente 1 vez.
    //      /^([a-z]{3-12}){1}$/

    // Opcionalmente puede haber un segundo nombre con las mismas careterísticas,
    // pero precedido de un espacio en blanco.
    //      /^([a-z]{3,12}){1}( [a-z]{2,12})?$/

    // El segundo nombre puede comenzar por una preposición o un artículo.
    // Este conjunto está formado por un espacio en blando y 2 o 3 letras.

    // Entre el primer y segundo grupo puede haber una preposición o un artículo

    // Flags: 
    //      g: global
    //      i: No distingue mayúsculas de minúsculas

    // Cadenas válidas probadas
    //  María de la O
    //  Benito 
    //  Benito Boniato
    //  Silvestre el Talones

    // let pattern = /^([a-záéíóú]{3,12}){1}(( [a-z]{1,3}){0,2} [a-záéíóú]{1,12})?$/gi;
    let pattern = /^([a-záéíóú]{3,12}){1}(( (de|la|del|de la|de las|de los|y){1}){0,1} [a-záéíóú]{1,12})?$/gi;

    // Valor del campo
    let texto = e.target.value.trim();

    if(!texto.match(pattern)){
        e.target.style.color = '#f00';

        let message = `Se ha producido un error en el campo ${e.target.id}`;
        let container = document.getElementById('errores');
        let p = document.createElement('p');
        let text = document.createTextNode(message);
        p.appendChild(text);
        container.appendChild(p);
        
    }
}

const limpiar = () => {
    alert('limpiar formulario');
}