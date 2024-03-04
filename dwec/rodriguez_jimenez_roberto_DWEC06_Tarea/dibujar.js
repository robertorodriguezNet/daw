onload = () => {

    // Elementos
    let paleta = document.getElementById("paleta");

    // Registrar el evento onClik sobre cada uno de los colores de la paleta.
    // Al hacer clic sobre ellos, se establece el color
    paleta.addEventListener("click", (e) => setColor(e));

    // Dibujar la tabla en la zona de dibujo
    document.getElementById('zonadibujo').appendChild(crearTabla());

}

// Guarda el estado del pincel
let pincelActivo = false;

/**
 * Crea la tabla sobre la que se pinta.
 * Registra los eventos necesarios para activos y desactivar el pincel
 * y para colorear las celdas.
 * Devuelve la tabla, no la dibuja.
 * @returns la tabla
 */
let crearTabla = () => {

    // Dibujar la tabla
    let tabla = document.createElement('table');
    tabla.style.border = "solid 1px #000";

    // Cabecera para la tabla
    let caption = document.createElement('caption');
    caption.innerHTML = "Haga CLICK en cualquier celda para activar/desactivar el Pincel";
    tabla.appendChild(caption);

    // El primer bucle crea las filas
    for (let i = 0; i < 30; i++) {

        // Construcción de las filas
        let tr = document.createElement('tr');

        // Bucle para crear las celdas
        for (let j = 0; j < 30; j++) {
            let td = document.createElement('td');
            td.style.border = "solid 1px #000";
            td.style.width = "10px";
            td.style.height = "10px";

            // Eventos
            // Hacemos click sobre alguno de los colores y cambiamos
            // el estado del pincel
            td.addEventListener('click', (e) => {

                // Establecemos el nuevo estado del pincel
                pincelActivo = !pincelActivo;

                // Modificamos el texto que muestra el estado del pincel
                document.getElementById('pincel').innerHTML =
                    (pincelActivo) ? 'PINCEL ACTIVADO...' : 'PINCEL DESACTIVADO...';

                // Coloreamos la celda que lanzó el evento
                colorear(e);  
            });

            // Coloreamos las celdas sobre las que pasa el cursor
            td.addEventListener('mouseover', (e) => colorear(e));

            // Añadir la celda a la fila
            tr.appendChild(td);
        }

        // Añadir la fila que se acaba de crear
        tabla.appendChild(tr);

    }

    return tabla;

}

/**
 * Colorea cada celda de la tabla
 */
let colorear = (e) => {
    // Se colorea si el pincel está activo
    if (pincelActivo) {
        e.target.setAttribute('class', getColorActivo());
    }
}

/**
 * Capturar el evento click de la tabla de colores y cambia la selección de las celdas.
 */
let setColor = (e) => {

    // Obtenemos las celdas de la tabla
    let tabla = document.getElementById('paleta');
    let filas = tabla.getElementsByTagName('tr');
    let celdas = filas[0].getElementsByTagName('td');

    // Recorremos todas las celdas para restablecer los colores
    for (let i = 0; i < celdas.length; i++) {

        // Obtenemos el color de cada celda
        let color = celdas[i].attributes['class'].nodeValue;

        // Comprobamos si está seleccionado y, si lo está
        // dividimos el valor sepárndolo por el espacio en blanco.
        // Le asignamos el primer valor que corresponde con el color.
        if (color.includes('seleccionado')) {
            let valores = color.split(" ");
            celdas[i].setAttribute('class', valores[0]);
        }
    }

    // Obtenemos el color seleccionado
    let colorSeleccionado = e.target.attributes['class'].nodeValue;

    // Insertamos el valor 'seleccionado' en el atributo 'class' si no lo tiene.
    if (!colorSeleccionado.includes('seleccionado')) {
        e.target.setAttribute('class', colorSeleccionado + ' seleccionado');
    }

}

// Devuelve el color activo
let getColorActivo = () => {

    // Obtenemos las celdas de la tabla
    let tabla = document.getElementById('paleta');
    let filas = tabla.getElementsByTagName('tr');
    let celdas = filas[0].getElementsByTagName('td');

    // Recorremos todas las celdas para restablecer los colores
    for (let i = 0; i < celdas.length; i++) {

        // Obtenemos el color de cada celda
        let color = celdas[i].attributes['class'].nodeValue;

        // Comprobamos si está seleccionado y, si lo está
        // dividimos el valor sepárndolo por el espacio en blanco.
        if (color.includes('seleccionado')) {
            let valores = color.split(" ");
            return valores[0];
        }
    }
    return null;
}
