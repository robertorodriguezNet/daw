
window.onload = () => {

    // Declaración de los componentes
    const FORMULARIO = document.getElementById('formulario');
    const BTN_LIMPIAR = document.getElementById('button');
    const BTN_ENVIAR = document.getElementById('enviar');

    // Eventos
    BTN_ENVIAR.addEventListener('click', procesarFormulario);

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
function setIntento(){

    // obtener los intentos e incrementarlos
    let intentos = getIntentos();
    intentos++;

    // Tiempo de vida de la cookie: 1 día
    let max_time = 24*60*60;

    // Establecemos la cookie, útil durante 5 min.
    document.cookie = `${encodeURIComponent('intentos')}=${encodeURIComponent(intentos)};path=/;max-age=${max_time};`;

}

/**
 * Devuelve el valor de la cookie 'intentos'
 */
function getIntentos(){

    // Patrón buscado
    let pattern = /intentos=\d+/;

    // Obtener las cookies decodificadas
    let cookies = document.cookie;

    // buscar el patrón entre la cadena de cookies
    if(cookies.match(pattern)){

        // tenemos las cookies con el formato nombre=valor;nombre=valor...
        let array_cookies = cookies.split(';');

        // Hay que conseguir el registro intentos=\d y para ello usamos la función filter 
        // que devuelve un array con las coincidencias
        const result = array_cookies.filter((array_cookies) => array_cookies.match(pattern));

        // Obtenemos un array con las coincidencias, que solo debe ser una
        let intentos = decodeURIComponent(result[0].substring(result[0].indexOf('=') +1));

        return intentos;

    }else{
        return 0;
    }

}

/**
 * Función que escribe en la pantalla el número de intentos de envío del formualrio.
 */
function escribirIntentos(){
    document.getElementById('intentos').innerHTML = 'Intento de envíos del formualario: ' + getIntentos();
}