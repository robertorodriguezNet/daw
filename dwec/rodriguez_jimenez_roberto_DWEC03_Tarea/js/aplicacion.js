/**
 * Constante que recibe la ejecución de una función que inicializa
 * los métodos onlick de los botones.
 */
const inicializar = () => {
    document.getElementById("iniciar-app").onclick=iniciarApp;
    document.getElementById("cerrar-app").onclick=cerrarApp;
}

// Declaración de la ventana
let app;

/**
 * Se inicia la aplicación abriendo una nueva ventana
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Window/open
 */
const iniciarApp = () => {

    // open(destino, título, opciones)
    app = window.open('', 'Aplicación','width=1200,height=600');
}

/**
 * Cierre de la aplicación.
 */
const cerrarApp = () => {
    if(app){
        app.close();
        app = null;
    }
}