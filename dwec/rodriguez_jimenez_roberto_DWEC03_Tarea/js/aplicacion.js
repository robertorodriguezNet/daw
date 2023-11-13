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

  // Obtener los valores de los objetos.
  // Algunas de estas propiedades, y algún método, están obsoletas (noviembre de 2023).
  let documento = app.document;
  let url = location.href;
  let protocolo = location.protocol;

  // Para obtener la información del navegador se usa userAgent,
  // que contiene la información que da appCodeName() (obsoleta).
  let navegador = navigator.userAgent;

  // javaEnabled() en un método obsoleto.
  // No se recomienda su uso y la alternativa es consultar
  // la compatibilidad del navegador.
  let java = navigator.javaEnabled();

  // Header con el título.
  documento.write("<h3>Ejemplo de nueva ventana</h3>");

  // Lista de definiciones con los datos que se piden.
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

  // iframe solicitando una url que es rechazada.
  documento.write(`<iframe
  id="iframe-goole"
  title="Google"
  width="800"
  height="600"
  src="www.google.es">
</iframe>`);
}