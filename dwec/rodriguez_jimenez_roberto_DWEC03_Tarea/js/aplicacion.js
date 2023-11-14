// Declaración de la ventana
let app;

// Dimensiones de la ventana
const WIDTH = 900;
const HEIGHT = 900;

/**
 * Constante que recibe la ejecución de una función que inicializa
 * los métodos onlick de los botones.
 */
const inicializar = () => {
  document.getElementById("iniciar-app").onclick = iniciarApp;
  document.getElementById("cerrar-app").onclick = cerrarApp;
};

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
  app.document.write(crearContenido());

  // -- GESTIÓN DE LOS DATOS QUE SE MOSTRARÁN EN LA VENTANA PRINCIPAL ---
  // A partir de aquí se desarrolla la segunda parte del ejercicio

  // Dias de la semana, ordenados sugún el inicio de la semana
  const semana = [
    "jueves",
    "viernes",
    "sábado",
    "domingo",
    "lunes",
    "martes",
    "miércoles",
  ];

  // Referenciamos la botonera para poder insertar los elementos correctamente
  let botonera = document.getElementById("botonera");

  // Establecemos el h1
  // Crear el elemento que se va a insertar
  let h1 = document.createElement('h1');

  // Crear el texto del elemento
  let h1Text = document.createTextNode('TAREA DWEC03');

  // Insertar el texto en el elemento
  h1.appendChild(h1Text);

  // Insertar el elemento en el cuerpo de la ventana principal
  // antes de la botonera
  document.body.insertBefore(h1,botonera);


  // Solicitud de datos
  let nombre_apellidos = app.prompt("Escriba su nombre y apellidos");
  let dia = parseInt(app.prompt("Día de nacimiento"));
  let mes = parseInt(app.prompt("Mes de nacimiento (número)"));
  let anno = parseInt(app.prompt("Año de nacimiento"));
  let fecha = new Date(anno, mes, dia);

  // Insertamos una lista como nodo para la ventana principal
  // y ajustamos los estilos.
  let lista = document.createElement('ul');
  lista.style.listStyle = 'none';
  lista.style.padding = 0;

  // Creamos los elementos de la lista
  lista.innerHTML = `<li>Buenos días ${nombre_apellidos}.</li>
  <li>Tu nombre tiene ${nombre_apellidos.length} caracteres, incluidos espacios.</li>
  <li>La primera letra A de tu nombre está en la posición ${nombre_apellidos.indexOf("a") + 1}</li>
  <li>Tu nombre menos las 3 primeras letras es:  ${nombre_apellidos.substring(3)}.</li>
  <li>Tu nombre todo en mayúsculas es:   ${nombre_apellidos.toUpperCase()}.</li>
  <li>Tu edad es: ${isNaN(getEdad(fecha)) ? " -- " : getEdad(fecha)} años.</li>
  <li>Naciste un feliz ${
        typeof semana[fecha.getDay()] === "undefined"
          ? " -- "
          : semana[fecha.getDay()]
      } del año ${isNaN(anno) ? " ---- " : anno}.</li>
  <li>El coseno de 180 es: ${Math.cos(180)}.</li>
  <li>El número mayor de 6(34,7,23,75,35,19) es: ${Math.max(34,7,23,75,35,19)}</li>
  <li>Ejemplo de número al azar: ${parseInt(Math.random() * 1000)}</li>`;

  // Inserta la lista antes de la botonera
  document.body.insertBefore(lista,botonera);

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
  let java = navigator.javaEnabled() ? "SÍ" : "NO";

  // Header con el título.
  return `<h3>Ejemplo de nueva ventana</h3>
    <dl>
      <dt>URL:</dt><dd>${url}</dd>
      <dt>Protocolo:</dt><dd>${protocolo}</dd>
      <dt>Navegador:</dt><dd>${navegador}</dd>
      <dt>Java habilitado:</dt><dd>Java ${java} disponible en esta ventana</dd>  
    </dl>

    <iframe id="iframe-goole" title="Google" width="800" height="600" src="www.google.es"></iframe>`;
}

/**
 * Deveulve los años resultantes de obtener la diferencia
 * entre dos fechas.
 * @param {Date} fecha la fecha de nacimiento
 * @returns la edad
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