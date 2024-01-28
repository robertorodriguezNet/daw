// Establecemos las acciones de los botones cuando se llame
// al evento onload
window.onload = () => {

    btn_abrir = document.getElementById('btn-abrir');
    btn_cerrar = document.getElementById('btn-cerrar');

    btn_cerrar.disabled = true;

    btn_abrir.onclick = crearVentana;
    btn_cerrar.onclick = cerrarVentana;
}

// Ventana que se crea
let ventana;

// Constante (función) que crea la ventana.
const crearVentana = () => {

    // Cerrar la ventana si estuviera abierta
    if(ventana){
        cerrarVentana;
    }

    // Crear y abrir la ventana
    ventana = window.open('ventana.html','','height=300,widht=400,left=100,top=100');

    // Agregar el evento para detectar el cierre de la ventana
    ventana.addEventListener("beforeunload", 
                                function(){
                                    if(ventana != null ){
                                        cerrarVentana();
                                    }
                                },
                            false);

    // Cargar el contenido en la ventana
    ventana.onload = cargarContenido;

    btn_abrir.disabled = true;
    btn_cerrar.disabled = false;
}

// Cerrar la ventana
const cerrarVentana = () => {
    if(ventana){
        ventana.close();
        ventana = null;

        btn_abrir.disabled = false;
        btn_cerrar.disabled = true;
    }
}

// Escribir contenido en la ventana
const cargarContenido = () => {

    // Tenemos el objeto document en el que escribiremos el contenido
    let documento = ventana.document;
    
    // Crear un elemnento h1, el texto, añadir el texto al h1, y añadir el texto a la ventana
    let h1 = documento.createElement('h1');
    let textH1 = documento.createTextNode('Venta abierta con window.open()');
    h1.appendChild(textH1);
    documento.body.appendChild(h1);

    // Crear un texto que se insertará debajo del h1
    let p = documento.createElement('p');
    let textoP = documento.createTextNode('DWEC - Tema 3');
    p.appendChild(textoP);
    documento.body.appendChild(p);

    
}