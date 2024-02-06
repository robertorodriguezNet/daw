window.onload = () => {

    // Hay que comprobar si existe el componente fecha-recibida
    let fecha = document.getElementById('fecha-recibida');
    if(fecha != null){
        obtenerDia(fecha.innerHTML);
    }
}

const SEMANA = ['domingo','lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

/**
 * Obtiene el día de la semana
 * @param {String} fecha que se va a evaluar
 */
function obtenerDia(fecha){

    // Crear un objeto Date
    let date = new Date(fecha);

    // Componer el texto
    let p = document.createElement('p');
    let texto = document.createTextNode(`El día de la semana es ${SEMANA[date.getDay()]}`);
    p.setAttribute('style','text-align: center');
    p.appendChild(texto);

    let pre = document.getElementById('js-code');
    let nodo = document.getElementById('js');
    nodo.insertBefore(p,pre);

}
