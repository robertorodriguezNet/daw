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

/**
 * Deveulve los años resultantes de obtener la diferencia
 * entre dos fechas.
 * @param {Date} fecha la fecha de nacimiento
 * @returns la fecha resultante en formato 'aaaa'
 */
function getEdad(fecha) {
  // Obtener la edad en milisegundos
  // Date.now() obtiene el momento actual en milisegundos
  // edadEnMilisegundos es un objeto Date con el poder trabajar con fechas.
  let edadEnMilisegundos = new Date(Date.now() - fecha);

  // Devolvemos los años entre la edadEnMilisegundos y 1970.
  // El 1/1/1970 se toma como en inicio de la cuenta del tiempo (Timestamp)
  return Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);
}

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

  // -- APERTURA Y REDIMENSIÓN DE LA VENTANA ---------------------------
  // open(destino, título, opciones)
  // window no siempre tiene el control sobre el tamaño de la ventana.
  // No se indica el parámetro resizable=no para que se ejecute el evento onresize
  app = window.open("", "Aplicación", `width=${WIDTH},height=${HEIGHT}`);

  // La ventana no debería redimensionarse por defecto, pero no funciona.
  // Para ello uso el método onresize para capturar el evento cuando se
  // intenta cambiar el tamaño de la ventan.
  // resizeTo() establece en nuevo valor de la ventana.
  app.onresize = () => app.resizeTo(WIDTH, HEIGHT);

  // -- CONTENIDO PARA LA APLICACIÓN ------------------------------------
  // Llamar a la función que creará el contenido
  crearContenido();

  // -- GESTIÓN DE LOS DATOS QUE SE MOSTRARÁN EN LA VENTANA PRINCIPAL ---

  // Dias de la semana
  const semana = [
    "jueves",
    "viernes",
    "sábado",
    "domingo",
    "lunes",
    "martes",
    "miércoles",
  ];

  // Variable que se utiliza como un comodín para parsear los datos
  // recogidos del prompt
  let data;

  // Variable para html que se mostrará
  let html;

  // Para la fecha de tipo Dae
  let fecha;

  // Variables para los datos solicitados.
  let nombre_apellidos;
  let dia;
  let mes;
  let anno;

  document.write("<h1>TAREA DWEC03</h1>");

  // Solicitud de datos
  nombre_apellidos = app.prompt("Escriba su nombre y apellidos");
  dia = parseInt(app.prompt("Día de nacimiento"));
  mes = parseInt(app.prompt("Mes de nacimiento (número)"));
  anno = parseInt(app.prompt("Año de nacimiento"));
  fecha = new Date(anno, mes, dia);

  html = `Buenos días ${nombre_apellidos}.
  <br>
  Tu nombre tiene ${nombre_apellidos.length} caracteres, incluidos espacios.
  <br>
  La primera letra A de tu nombre está en la posición ${
    nombre_apellidos.indexOf("a") + 1
  }.
  <br>
  La última letra A de tu nombre está en la posición:  ${
    nombre_apellidos.lastIndexOf("a") + 1
  }.
  <br>
  Tu nombre menos las 3 primeras letras es:  ${nombre_apellidos.substring(3)}.
  <br>
  Tu nombre todo en mayúsculas es:   ${nombre_apellidos.toUpperCase()}.
  <br>
  Tu edad es: ${isNaN(getEdad(fecha)) ? " -- " : getEdad(fecha)} años.
  <br>
  Naciste un feliz ${
    typeof semana[fecha.getDay()] === "undefined"
      ? " -- "
      : semana[fecha.getDay()]
  } del año ${isNaN(anno) ? " ---- " : anno}.
  <br>
  El coseno de 180 es: ${Math.cos(180)}.
  <br>
  El número mayor de 6(34,7,23,75,35,19) es: ${Math.max(34, 7, 23, 75, 35, 19)}
  <br>
  Ejemplo de número al azar: ${parseInt(Math.random() * 1000)}
`;

  document.write(html);
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
