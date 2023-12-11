/*
Se pide:
•	Crear un objeto que nos permita instanciar edificios. 
  Cada vez que instanciemos un edificio le pasaremos la calle, número y código postal como parámetros. 
  Se pide además crear los siguientes métodos para el objeto Edificio: 
  o	agregarPlantasYPuertas(numplantas, puertas) // Se le pasa el número de plantas que queremos crear en el piso y el número de puertas por planta. Cada vez que se llame a este método, añadirá el número de plantas y puertas indicadas en los parámetros, a las que ya están creadas en el edificio.
  o	modificarNumero(numero) // Se le pasa el nuevo número del edificio para que lo actualice.
  o	modificarCalle(calle) // Se le pasa el nuevo nombre de la calle para que lo actualice.
  o	modificarCodigoPostal(codigo) // Se le pasa el nuevo número de código postal del edificio.
  o	imprimeCalle // Devuelve el nombre de la calle del edificio.
  o	imprimeNumero // Devuelve el número del edificio.
  o	imprimeCodigoPostal // Devuelve el código postal del edificio.
  o	agregarPropietario(nombre,planta,puerta) // Se le pasa un nombre de propietario, un número de planta y un número de puerta y lo asignará como propietario de ese piso.
  o	imprimePlantas // Recorrerá el edificio e imprimirá todos los propietarios de cada puerta.
•	Cada vez que se crea un edificio que muestre automáticamente un mensaje del estilo: 
  o	construido nuevo edificio en calle: xxxxxx, nº: xx, CP: xxxxx.
•	Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje del estilo: 
  o	xxxxxxxx es ahora el propietario de la puerta x de la planta x.

*/

/**
 * Clase que gestiona una colección de edificios.
 *
 * GestorDeEdificios tiene una colección de Edificio.
 * Debe tener funciones para trabajar con la colección.
 *
 * @author Roberto Rodríguez <roberto.rod.jim.1@educa.jcyl.es>
 * @class Representa una colección de edificios.
 */
class GestorDeEdificios {
  // Si se instancia el gestro de edificios sin un edificio,
  // se crea una colección vacía
  constructor(edificio = null) {
    this._gestor = edificio == null ? [] : [edificio];
  }

  /**
   * Agrega un edificio a la colección
   * @param {Edificio} edificio que se agrega a la colección.
   */
  setEdificio(edificio) {
    this._gestor[this._gestor.length] = edificio;
  }

  /**
   * Devuelve el edificio que se corresponde con los datos
   *
   * @param {string} calle del edificio
   * @param {string} numro del edificio
   * @param {number} cp C.P. del edificio
   * @returns { Edificio } edificio solicitado
   */
  getEdificio(calle, numero, cp) {
    /**
     * Utilizo la función filter para obtener el edificio pedidio.
     *
     * @see https://youtu.be/Ek81Oa9rlwY
     * @type Edificio
     */
    let edificio = this._gestor.filter(
      (e) => e._calle == calle && e._numero == numero && e._cp == cp
    );
    return edificio[0];
  }
}
// -- Fin de clase GestorDeEdificios ---------------------------------

/**
 * Clase que representa un edificio.
 *
 * Un Edificio tiene una calle, un número y un C.P. y una
 * colección de plantas.
 *
 * @author Roberto Rodríguez <roberto.rod.jim.1@educa.jcyl.es>
 * @class representa un edificio.
 */
class Edificio {
  /**
   * Constructor de la clase.
   *
   * @param {string} calle en la que se situa el edificio
   * @param {string} numero del edificio, string para poder llevar letras (s/n, 21bis, ...)
   * @param {number} cp del edificio
   */
  constructor(calle, numero, cp = 1000) {
    // Es una buena práctica comenzar el nombre del atributo con _
    /**
     * @type {string}
     */
    this._calle = calle;

    /**
     * @type {string}
     */
    this._numero = numero;

    /**
     * @type {number}
     */
    this._cp = cp;

    // Inicializar las plantas como un array vacío.
    // Una planta es una colección de puertas.
    this._plantas = [];

    // Imprime en el documento HTML el mensaje pasado como parámetro.
    this.imprimirTarea(this.mostrarMensajeDeEdificioConstruido(this));
  }

  /**
   * Agrega las plantas y las puertas por planta al edificio.
   * Las plantas se suman a las ya creadas en el edificio.
   *
   * La planta 0 es la planta baja.
   *
   * @param {number} plantas del edificio.
   * @param {number} puertas de cada planta.
   */
  agregarPlantasYPuertas(plantas = 1, puertas = 1) {
    // El edificio puede tener a alguna planta
    let plantasActuales = this._plantas.length;

    // Recorrer las plantas del edificio que queremos agregar.
    // OJO! i contiene el índice de la planta pero, si ya hay
    // plantas, i se puede corresponder con plantas ya creadas.
    // Para evitar esto, i debe partir del último elemento de
    // de la lista de plantas.
    for (let i = plantasActuales; i < plantasActuales + plantas; i++) {
      // Cada planta contiene un array con las puertas.
      this._plantas.push(new Array(puertas));

      // Recorrer las puertas en cada planta.
      for (let j = 0; j < puertas; j++) {
        // A la planta se le asignan las puertas
        // A cada puerta se le asigna un propietario en blanco.
        this._plantas[i][j] = "Sin propietario";
      }
    }
  }

  /**
   * Modifica el número del edificio.
   *
   * @param {number} numero nuevo del edificio.
   */
  modificarNumero(numero) {}

  /**
   * Actualiza el nombre de la calle del edificio.
   *
   * @param {string} calle nueva.
   */
  modificarCalle(calle) {}

  /**
   * Modifica el CP del edificio.
   *
   * @param {number} codigo
   */
  modificarCodigoPostal(codigo) {}

  /**
   * Devuelve el nombre de la calle del edificio.
   *
   * @returns el nombre de la calle.
   */
  imprimeCalle() {
    return this._calle;
  }

  /**
   * Devuelve el número del edificio.
   *
   * @returns el número del edificio.
   */
  imprimeNumero() {
    return this._numero;
  }

  /**
   * Devuelve el código postal del edificio.
   *
   * @returns el código postal.
   */
  imprimeCodigoPostal() {
    return this._cp;
  }

  /**
   * Asigna un propietario a una puerta de una planta.
   *
   * @param {string} nombre del propietario.
   * @param {number} planta en la que está la puerta.
   * @param {number} puerta del propietario.
   */
  agregarPropietario(nombre, planta, puerta) {}

  /**
   * Recorre el edificio e imprime todos los propietarios de cada puerta.
   */
  imprimirPlantas() {
    // Iniciamos el texto que se va a mostrar, creando una lista
    // para cada planta y otra para cada colección de puertas.
    let texto = "<li><strong>Plantas</strong>";

    // Recorrer las plantas
    for (let planta in this._plantas) {
      texto += `<ul>
        <li>Planta ${planta}
          <ul>`;

      // Recorrer cada puerta de la planta
      for (let puerta in this._plantas[planta]) {
        texto += `<li>Puerta ${puerta}: ${this._plantas[planta][puerta]}</li>`;
      }

      texto += `</ul>
          </li>
        </ul>`;
    }

    texto += "</li>";

    this.imprimirTarea(texto);
  }

  /**
   * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
   * @param { Edificio } edificio del que se muestran los datos.
   * @returns { string } mensaje de confirmación.
   */
  mostrarMensajeDeEdificioConstruido(edificio) {
    return `Construido un nuevo edificio en la calle ${edificio._calle}, n.º ${edificio._numero}, CP: ${edificio._cp}`;
  }

  /**
   * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
   * @returns
   */
  mostrarMensajeDePropietario() {
    return `${_propietario} es ahora el propietario de la puerta ${this._puertas} de la planta ${this._plantas}`;
  }

  /**
   * Imprime la tarea en el documento HTML.
   * @param { string } tarea que se debe imprimir
   */
  imprimirTarea(tarea) {
    let ul = document.getElementById("tareas");
    let li = document.createElement("li");
    li.innerHTML = tarea;
    ul.appendChild(li);
  }
}
// Fin de la clase edificios ----------------------

// -- Funcionalidad de la aplicacion ----------------------------------

// Crear el gestor de edificios sin pasarle ningún edificio
let gestorDeEdificios = new GestorDeEdificios();

// Crear edificios y añadirlos a la colección
let edificio = new Edificio("Pepino", 32, 99002);
gestorDeEdificios.setEdificio(edificio);
edificio.agregarPlantasYPuertas(3, 3);
edificio.agregarPlantasYPuertas(2, 2);
edificio.imprimirPlantas();
edificio.imprimirTarea("<hr>");

// edificio = new Edificio("Cebolla", 43, 99001);
// gestorDeEdificios.setEdificio(edificio);
// edificio.agregarPlantasYPuertas(5, 2);
// edificio.imprimirPlantas();
// edificio.imprimirTarea('<hr>');

// edificio = new Edificio("Calabacín", 2, 99012);
// gestorDeEdificios.setEdificio(edificio);
// edificio.agregarPlantasYPuertas(2, 3);
// edificio.imprimirPlantas();
