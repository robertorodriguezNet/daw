// Declaración de la ventana
let app;

/**
 * Constante que recibe la ejecución de una función que inicializa
 * los métodos onlick de los botones.
 */
const inicializar = () => {
  document.getElementById("iniciar-app").onclick = iniciarApp;
  document.getElementById("cerrar-app").onclick = cerrarApp;
};

// Dimensiones de la ventana
const WIDTH = 900;
const HEIGHT = 900;

/**
 * Se inicia la aplicación abriendo una nueva ventana
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Window/open
 */
const iniciarApp = () => {
  // Cerramos la ventana si ya tenemos una instancia
  if (app != null) {
    app.close();
  }

  // open(destino, título, opciones)
  // window no siempre tiene el control sobre el tamaño de la ventana.
  // No se indica el parámetro resizable=no para que se ejecute el evento onresize
  app = window.open("", "Aplicación", `width=${WIDTH},height=${HEIGHT}`);

  // La ventana no debería redimensionarse por defecto, pero no funciona.
  // Para ello uso el método onresize para capturar el evento cuando se
  // intenta cambiar el tamaño de la ventan.
  // resizeTo() establece en nuevo valor de la ventana.
  app.onresize = () => app.resizeTo(WIDTH, HEIGHT);

  // Llamar a la función que creará el contenido
  crearContenido();

};

/**
 * Cierre de la aplicación.
 */
const cerrarApp = () => {
  if (app) {
    app.close();
    app = null;
  }
};

/**
 * Función para dar contenido a la ventana abierta
 */
function crearContenido() {
  let documento = app.document;
  let url = location.href;
  let protocolo = location.protocol;
  let navegador = navigator.userAgent;
  let java = navigator.javaEnabled();

  documento.write("<h3>Ejemplo de nueva ventana</h3>");

  documento.write("<dl>");
  documento.write(`<dt>URL:</dt><dd>${url}</dd>`);
  documento.write(`<dt>Protocolo:</dt><dd>${protocolo}</dd>`);
  documento.write(`<dt>Navegador:</dt><dd>${navegador}</dd>`);
  documento.write(
    "<dt>Java habilitado:</dt><dd>Java " +
      (java ? "SI" : "NO") +
      " disponible en esta ventana</dd>"
  );
  documento.write("</dl>");

  documento.write(crearFrame("www.google.com",800,600));
}

/**
 * Función que crea un frame a la URL indicada y con la dimensión que
 * se recibe como parámtro.
 * @param {String} url - La URL que se cargará en el frame.
 * @param {Number} width - Ancho del frame.
 * @param {Number} height - Alto del frame.
 */
function crearFrame(url, width, height) {
    return `<iframe
    id="inlineFrameExample"
    title="Inline Frame Example"
    width="${width}"
    height="${height}"
    src="${url}">
  </iframe>`;
}
