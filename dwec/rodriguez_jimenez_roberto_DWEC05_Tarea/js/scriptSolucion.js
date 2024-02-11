window.onload = () => {

    // Declaración de los componentes
    const FORMULARIO = document.getElementById('formulario');

    // Inputs
    const INP_NOMBRE = document.getElementById('nombre');
    const INP_APELLIDOS = document.getElementById('apellidos');
    const INP_EMAIL = document.getElementById('email');

    // Botones
    const BTN_LIMPIAR = document.getElementById('button');
    const BTN_ENVIAR = document.getElementById('enviar');

    // Eventos
    INP_NOMBRE.addEventListener('blur', (e) => {
        toUpper(e);
    });

    INP_APELLIDOS.addEventListener('blur', (e) => {
        toUpper(e);
    });

    INP_EMAIL.addEventListener('blur', (e) => {
        validarEmail(e);
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
 * Imprime los mensajes de error en la pantalla.
 * 
 * @param {string} message 
 */
function imprimirError(message, component) {
    component.style.color = '#f00';

    let container = document.getElementById('errores');
    let p = document.createElement('p');
    let text = document.createTextNode(message);
    p.appendChild(text);
    container.appendChild(p);
}

/**
 * Transforma el texto del input en mayúsclas
 * @param {object} e componente que recibe la acción 
 */
const toUpper = (e) => {
    e.target.value = e.target.value.toUpperCase();
}

/**
 * Valida la edad con los requerimientos: 
 *  - Sólo valores numéricos.
 *  - Valores entre 0 y 105 años.
 *  - Si hay error, mostrar mensaje y poner el foco en el campo.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @param {Event} e valor del campo edad 
 */
const validarEdad = (e) => {
    let edad = e.target.value;
    let error = null;  // Nos aseguramos de que error tenga un valor no válido

    // Hay dos tipos de error: valor numérico y rango
    let message = [
        `${edad} no es un valor numérico`,
        `${edad} está fuera del rango entre 0 y 105 años`
    ];

    // Usamos el método isFinite(valor) que comprueba si el argumento es número finito.
    // Convierte el argumento en entero.
    // ¿Por qué no 'parseInt()'? parseInt convierte a entero el argumento hasta que
    // encuentra un carácter no válido.
    // parseInt y isFinite devuelven:
    //      parseInt("a35") NaN   isFinite("a35") false
    //      parseInt("35a")  35   isFinite("35a") false
    if (isFinite(edad)) {
        if (edad < 0 || edad > 105) {
            error = 1;
        }
    } else {
        error = 0;
    }

    if (error != null) {
        imprimirError(message[error], e.target);
    }

}

/**
 * Validar el E-MAIL. Utilizar una expresión regular que nos permita comprobar 
 * que el e-mail sigue un formato correcto. 
 * Si se produce algún error mostrar el mensaje en el contenedor "errores" 
 * y poner el foco en el campo E-MAIL. 
 * @param {Event} e 
 */
const validarEmail = (e) => {

    // Limpiamos los caracteres blancos que pudiera haber al principo y al final
    let email = e.target.value.trim();

    // Se divide el email en cuatro grupos: usuario, @ dominio y extensión de dominio.
    // Grupo 1: usuario
    //      Se compone de letras, mayúsculas o minúsculas, guión alto y bajo y punto.
    //      Debe aparecer, como mínimo, una vez.
    // Grupo 2: @
    //      Es obligatorio que aparezca
    // Grupo 3: Dominio
    //      Grupo de letras, mayúsculas y minúsculas, números y guiones alto y bajo.
    //      Solo aparece una vez.
    // Grupo 4: Niveles de dominio.
    //      Compuesto por un punto seguido por entre 2 y 4 letras munúsculas o mayúsculas.
    //      Este grupo puede aparecer 1 o 2 veces.
    // Antes y después de la cadena, no puede haber nada: ^ ... $

    // Patrón buscado
    let pattern = /^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_]+(\.[a-zA-Z]{2,4}){1,2}$/;

    if (!email.match(pattern)) {
        imprimirError(`El correo ${email} tiene un formato incorrecto`, e.target);
    }

}

/**
 * Validar el NIF. Utilizar una expresión regular que permita solamente 8 números 
 * un guión y una letra. Si se produce algún error mostrar el mensaje en el contenedor 
 * "errores" y poner el foco en el campo NIF. No es necesario validar que la letra 
 * sea correcta. 
 * 
 * @param {Event} e 
 */
const validarNif = (e) => {

    // Limpiamos los caracteres blancos que pudiera haber al principo y al final
    let nif = e.target.value.trim();

    // Patrón buscado
    // Grupo de números: \d{8} indica que debe contener exactamente 8 dígitos
    // Grupo de letras: [a-z]{1} debe haber exactamente una letra, entre a y z.
    // Antes de los números no puede haber nada: ^
    // Después de la letra no puede haber nada: $
    // Entre los números y las letras debe haber un guión, sin espacios: -
    // El flag i indica que se no se distinguen mayúsculas y minúsculas.
    let pattern = /^\d{8}-[a-z]{1}$/gi;


    if (!nif.match(pattern)) {
        imprimirError(`El correo ${nif} tiene un formato incorrecto`, e.target);
    }
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

    if (!texto.match(pattern)) {
        imprimirError(`El correo ${texto} tiene un formato incorrecto`, e.target);
    }
}

const limpiar = () => {
    alert('limpiar formulario');
}