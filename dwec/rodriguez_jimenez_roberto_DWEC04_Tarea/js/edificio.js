class Edificio {
  /**
   * Constructor de la clase.
   *
   * @param {string} calle en la que se situa el edificio
   * @param {number} numero del edificio
   * @param {number} cp del edificio
   */
  constructor(calle, numero, cp) {
    // Es una buena práctica comenzar el nombre del atributo con _
    this._calle = calle;
    this._numero = numero;
    this._cp = cp;

    // Inicializar las plantas como un array vacío.
    // Una planta es una colección de puertas.
    this._plantas = [];

    // Son las puertas que tiene un planta.
    // Una puerta tiene un número y un propietario.
    this._puertas = [];

    // El propietario es un string
    this._propietario;
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
   * @param { Edificio } edificio del que se muestran los datos
   */
  mostrarMensajeDeEdificioConstruido(edificio) {
    alert(
      `Construido un nuevo edificio en la calle: ${this._calle}, n.º ${this._numero}, CP: ${this._cp}`
    );
  }

  /**
   * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
   * @returns
   */
  mostrarMensajeDePropietario() {
    return `${_propietario} es ahora el propietario de la puerta ${this._puertas} de la planta ${this._plantas}`;
  }
}

// Creamos una array de edificios
let edificios = [];

/**
 * Recupera los datos para crear un nuevo edificio.
 */
function agregarEdificio() {
  // Obtener los datos del nuevo edificio
  let calle = document.getElementById("calle");
  let numero = document.getElementById("numero");
  let cp = document.getElementById("cp");

  // Crear una instancia de Edifio
  let edificio = new Edificio(calle.value, numero.value, cp.value);

  // Mostramos el mensaje de que se ha creado el edificio
  edificio.mostrarMensajeDeEdificioConstruido();

  // Agregar el edificio a la colección de edificios
  edificios[edificios.length] = edificio;

  // Limpiar el formulario
  calle.value = "";
  numero.value = "";
  cp.value = "";

  // listar edificios
  document.getElementById("listado").innerHTML += `<tr>
      <td>${edificio._calle}</td>
      <td>${edificio._numero}</td>
      <td>${edificio._cp}</td>
      <td>
        <button type="button" onclick="modificar()">Modificar</button>
      </td>
    </tr>`;
}

function modificar(){
  alert("Modificar un edificio");
}

