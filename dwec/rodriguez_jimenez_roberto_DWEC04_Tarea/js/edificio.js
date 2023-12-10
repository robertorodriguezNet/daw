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
  addEdificio(edificio) {
    this._gestor[this._gestor.length] = edificio;
  }
}

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
   * @param {number} numero del edificio
   * @param {number} cp del edificio
   */
  constructor(calle, numero, cp = 1000) {
    // Es una buena práctica comenzar el nombre del atributo con _
    /**
     * @type {string}
     */
    this._calle = calle;

    /**
     * @type {number}
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
    this.imprimirTarea(
        this.mostrarMensajeDeEdificioConstruido(this)
      );
  }

  /**
   * Agrega las plantas y las puertas por planta.
   *
   * @param {number} numplantas del edificio.
   * @param {number} puertas de cada planta.
   */
  agregarPlantasYPuertas(numplantas, puertas) {}

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
   *
   * @returns
   */
  imprimePlantas() {
    return null;
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
    let ul = document.getElementById('tareas');
    let li = document.createElement('li');
    li.innerHTML = tarea;
    ul.appendChild(li);
  }
}
// Fin de la clase edificios ----------------------

// Crear el gestor de edificios sin pasarle ningún edificio
let gestorDeEdificios = new GestorDeEdificios();

// Crear edificios y añadirlos a la colección
gestorDeEdificios.addEdificio(new Edificio("Pepino", 32, 99002));
gestorDeEdificios.addEdificio(new Edificio("Cebolla", 43, 99001));
gestorDeEdificios.addEdificio(new Edificio("Calabacín", 2, 99012));
