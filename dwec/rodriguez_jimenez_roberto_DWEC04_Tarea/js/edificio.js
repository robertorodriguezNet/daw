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
  constructor(calle, numero, cp) {
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
    this.mostrarMensajeDeEdificioConstruido(this);
    
  }

  /**
   * Agrega las plantas y las puertas por planta al edificio.
   * 
   * Las plantas se suman a las ya creadas en el edificio.
   * La planta 0 es la planta baja, por lo tanto, un edificio
   * de 3 plantas tendrá: bajo, 1º y 2º.
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
        this._plantas[i][j] = "";
      }
    }
  }

  /**
   * Modifica el número del edificio.
   *
   * @param {number} numero nuevo del edificio.
   */
  modificarNumero(numero) {
    this._numero = numero;
  }

  /**
   * Actualiza el nombre de la calle del edificio.
   *
   * @param {string} calle nueva.
   */
  modificarCalle(calle) {
    this._calle = calle;
  }

  /**
   * Modifica el CP del edificio.
   *
   * @param {number} codigo
   */
  modificarCodigoPostal(codigo) {
    this._cp = codigo;
  }

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
  agregarPropietario(nombre, planta, puerta) {

    // Asignar el propietario
    this._plantas[planta][puerta] = nombre;

    // Mostrar el mensaje
    document.write(this.mostrarMensajeDePropietario(planta, puerta));
  }

  /**
   * Recorre el edificio e imprime todos los propietarios de cada puerta.
   */
  imprimePlantas() {
    // Iniciamos el texto que se va a mostrar, creando una lista
    // para cada planta y otra para cada colección de puertas.
    let texto = "";

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

    return texto;
  }

  /**
   * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
   * @param { Edificio } edificio del que se muestran los datos.
   * @returns { string } mensaje de confirmación.
   */
  mostrarMensajeDeEdificioConstruido(edificio) {
    document.write(`<li>Construido un nuevo edificio en la calle ${edificio._calle}, n.º ${edificio._numero}, CP: ${edificio._cp}</li>`);
  }

/**
 * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
 * @param {number} planta a la que petenece la puerta buscada.
 * @param {number} puerta buscada
 * @returns {string} mensaje que se imprimirá.
 */
  mostrarMensajeDePropietario(planta, puerta) {
    return `<li>${this._plantas[planta][puerta]} es ahora el propietario de la puerta ${puerta} de la planta ${planta}</li>`;
  }


}
// Fin de la clase edificios ----------------------

// Declarar los edificios
document.write('<h2>Crear 3 edificios: A, B, C</h2><ul>');
let edificioA = new Edificio("Cebolla", 43, 99001);
let edificioB = new Edificio("Calabacín", 2, 99012);
let edificioC = new Edificio("Pepino", 22, 99002);
document.write('</ul>')

// Imprimir algunos datos de cada edificio
document.write('<h2>Algunos datos:</h2><ul>');
document.write(`<li>El código postal del edificioA es: ${edificioA.imprimeCodigoPostal()}</li>`);
document.write(`<li>La calle del edificio C es: ${edificioC.imprimeCalle()}</li>`);
document.write(`<li>El edificio B está situado en la calle ${edificioB.imprimeCalle()} número ${edificioB.imprimeNumero()}</li>`);
document.write('</ul>')

// Cambiar algunos datos de cada edificio
document.write('<h2>Cambiamos los datos:</h2><ul>');
edificioA.modificarCodigoPostal(88001);
edificioC.modificarCalle('Pepinillo');
edificioB.modificarNumero(79);
edificioB.modificarCalle('Calabaza');
document.write(`<li>El nuevo código postal del edificioA es: ${edificioA.imprimeCodigoPostal()}</li>`);
document.write(`<li>Ahora, la calle del edificio C es: ${edificioC.imprimeCalle()}</li>`);
document.write(`<li>La nueva situación del edificio B es la calle ${edificioB.imprimeCalle()} número ${edificioB.imprimeNumero()}</li>`);
document.write('</ul>');

// Agregar plantas y puertas
document.write(`<h2>Agregar plantas y puertas (planta baja es 0):</h2>
  <ul >
    <li>Edifico A.: 3 plantas y 3 puertas por planta.</li>
    <li>Edifico B.: 2 plantas y 4 puertas por planta.</li>
    <li>Edifico c.: 4 plantas y 2 puertas por planta.</li>
  </ul>`);
edificioA.agregarPlantasYPuertas(3,3);
edificioB.agregarPlantasYPuertas(2,4);
edificioC.agregarPlantasYPuertas(4,2);

// Agregar propietarios
document.write('<h2>Agregar propietarios:</h2><ul>');
edificioA.agregarPropietario('Benito Boniato', 2, 2);
edificioA.agregarPropietario('Lorenza Coto',1,1);
edificioA.agregarPropietario('Aitor Tilla',0,1);
edificioA.agregarPropietario('Andrés Trozado',2,1);
edificioA.agregarPropietario('Lola Mento',2,0);
edificioA.agregarPropietario('Encarna Vales',1,2);
edificioA.agregarPropietario('Ana Tomía',0,2);
document.write('</ul>');

// Imprimir una lista de propietarios
document.write(`<h2>Lista de propietarios de la calle ${edificioA.imprimeCalle()} número ${edificioA.imprimeNumero()} :</h2><ul>`);
document.write(edificioA.imprimePlantas());
document.write('</ul>');

// Agregar plantas
document.write('<h2>Agregar 2 plantas, con 2 puertas cada una, al edificio A.</h2>');
edificioA.agregarPlantasYPuertas(2,2);

// Agregar propietarios a las plantas nuevas
document.write('<h2>Agregar propietarios a las plantas nuevas:</h2><ul>');
edificioA.agregarPropietario('Matías Queroso', 3, 1);
edificioA.agregarPropietario('Igor Dito',4,0);
document.write('</ul>');

// Listar nuevamente las plantas
document.write('<h2>Así quedan las viviendas del edificio A:</h2><ul>');
document.write(edificioA.imprimePlantas());
document.write('</ul>');