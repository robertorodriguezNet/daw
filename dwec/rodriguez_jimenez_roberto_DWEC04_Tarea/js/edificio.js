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
   * Imprime la tarea en el documento HTML.
   * 
   * Es un método estático para que pueda ser usado desde fuera de la clase.
   * Se declara antes del constructor para que la clase pueda tener acceso 
   * al método, si se declarares después, no se reconocería.
   * 
   * @param { string } tarea que se debe imprimir
   */
  static imprimirTarea(tarea) {
    let ul = document.getElementById("tareas");
    let li = document.createElement("li");
    li.innerHTML = tarea;
    ul.appendChild(li);
  }

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
    Edificio.imprimirTarea(this.mostrarMensajeDeEdificioConstruido(this));
    
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
    Edificio.imprimirTarea(this.mostrarMensajeDePropietario(planta, puerta));
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
    return `Construido un nuevo edificio en la calle ${edificio._calle}, n.º ${edificio._numero}, CP: ${edificio._cp}`;
  }

/**
 * Cada vez que se añada un propietario a un piso de un edificio que muestre un mensaje.
 * @param {number} planta a la que petenece la puerta buscada.
 * @param {number} puerta buscada
 * @returns {string} mensaje que se imprimirá.
 */
  mostrarMensajeDePropietario(planta, puerta) {
    return `${this._plantas[planta][puerta]} es ahora el propietario de la puerta ${puerta} de la planta ${planta}`;
  }


}
// Fin de la clase edificios ----------------------

// -- Funcionalidad de la aplicacion ----------------------------------

// Declarar los edificios
Edificio.imprimirTarea("<strong>Crear 3 edificios: A, B, C</strong>");
let edificioA = new Edificio("Cebolla", 43, 99001);
let edificioB = new Edificio("Calabacín", 2, 99012);
let edificioC = new Edificio("Pepino", 22, 99002);

// Imprimir algunos datos de cada edificio
Edificio.imprimirTarea('<br><strong>Algunos datos:</strong>');
Edificio.imprimirTarea(`El código postal del edificioA es: ${edificioA.imprimeCodigoPostal()}`);
Edificio.imprimirTarea(`La calle del edificio C es: ${edificioC.imprimeCalle()}`);
Edificio.imprimirTarea(`El edificio B está situado en la calle ${edificioB.imprimeCalle()} número ${edificioB.imprimeNumero()}`);

// Cambiar algunos datos de cada edificio
Edificio.imprimirTarea('<br><strong>Cambiamos los datos:</strong>');
edificioA.modificarCodigoPostal(88001);
edificioC.modificarCalle('Pepinillo');
edificioB.modificarNumero(79);
edificioB.modificarCalle('Calabaza');
Edificio.imprimirTarea(`El nuvo código postal del edificioA es: ${edificioA.imprimeCodigoPostal()}`);
Edificio.imprimirTarea(`Ahora, la calle del edificio C es: ${edificioC.imprimeCalle()}`);
Edificio.imprimirTarea(`La nueva situación del edificio B es la calle ${edificioB.imprimeCalle()} número ${edificioB.imprimeNumero()}`);

// Agregar plantas y puertas
Edificio.imprimirTarea(`<br><strong>Agregar plantas y puertas (planta baja es 0):</strong>
  <ul >
    <li>Edifico A.: 3 plantas y 3 puertas por planta.</li>
    <li>Edifico B.: 2 plantas y 4 puertas por planta.</li>
    <li>Edifico c.: 4 plantas y 2 puertas por planta.</li>
  </ul>`);
edificioA.agregarPlantasYPuertas(3,3);
edificioB.agregarPlantasYPuertas(2,4);
edificioC.agregarPlantasYPuertas(4,2);

// Agregar propietarios
Edificio.imprimirTarea('<br><strong>Agregar propietarios:</strong>');
edificioA.agregarPropietario('Benito Boniato', 2, 2);
edificioA.agregarPropietario('Lorenza Coto',1,1);
edificioA.agregarPropietario('Aitor Tilla',0,1);
edificioA.agregarPropietario('Andrés Trozado',2,1);
edificioA.agregarPropietario('Lola Mento',2,0);
edificioA.agregarPropietario('Encarna Vales',1,2);
edificioA.agregarPropietario('Ana Tomía',0,2);

// Imprimir una lista de propietarios
Edificio.imprimirTarea(`<br><strong>Lista de propietarios de la calle ${edificioA.imprimeCalle()} número ${edificioA.imprimeNumero()} :</strong>`);
Edificio.imprimirTarea(edificioA.imprimePlantas());

// Agregar plantas
Edificio.imprimirTarea('<br><strong>Agregar 2 plantas, con 2 puertas cada una, al edificio A.</strong>');
edificioA.agregarPlantasYPuertas(2,2);

// Agregar propietarios a las plantas nuevas
Edificio.imprimirTarea('<br><strong>Agregar propietarios a las plantas nuevas:</strong>');
edificioA.agregarPropietario('Matías Queroso', 3, 1);
edificioA.agregarPropietario('Igor Dito',4,0);

// Listar nuevamente las plantas
Edificio.imprimirTarea('<br><strong>Así quedan las viviendas del edificio A:</strong>');
Edificio.imprimirTarea(edificioA.imprimePlantas());