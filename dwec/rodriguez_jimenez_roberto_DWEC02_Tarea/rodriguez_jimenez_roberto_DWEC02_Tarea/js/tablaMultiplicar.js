const mostrarTabla = () => {
  this.event.preventDefault();
  const numero = Number(document.getElementById("numero").value);
  const bucle = document.getElementById("bucle").value;

  let tabla = document.getElementById("tabla");
  let tablaMultiplicar = `<h2>Tabla de multiplicar del numero ${numero} y bucle ${bucle}</h2>`;

  tablaMultiplicar += "<ul>";

  // Seleccionamos una función para cada uno de los
  // bucles que se quiera ejecutar.
  switch (bucle) {
    case "for":
      tablaMultiplicar += bucleFor(numero);
      break;
    case "while":
      tablaMultiplicar += bucleWhile(numero);
      break;
    case "doWhile":
      tablaMultiplicar += bucleDoWhile(numero);
      break;
    default:
  }

  tablaMultiplicar += "</ul>";
  tabla.innerHTML = tablaMultiplicar;
};

/**
 * Devuelve la table del número pasado como parámetro usando
 * el bucle for.
 * @param {} numero el número sobre el que recorrer la tabla
 * @returns el resultado de la tabla
 */
function bucleFor(multiplicando) {
  let resultado = "";
  let max = 10;
  for (let multiplicador = 0; multiplicador <= max; multiplicador++) {
    resultado += `<li>${multiplicando}*${multiplicador} = ${
      multiplicando * multiplicador
    }</li>`;
  }
  return resultado;
}

/**
 * Devuelve la table del número pasado como parámetro usando
 * el bucle while.
 * @param {} numero el número sobre el que recorrer la tabla
 * @returns el resultado de la tabla
 */
function bucleWhile(multiplicando) {
  let resultado = "";
  let multiplicador = 0;
  let max = 10;
  while (multiplicador <= max) {
    resultado += `<li>${multiplicando}*${multiplicador} = ${
      multiplicando * multiplicador
    }</li>`;
    multiplicador++;
  }
  return resultado;
}

/**
 * Devuelve la table del número pasado como parámetro usando
 * el bucle do while.
 * @param {} numero el número sobre el que recorrer la tabla
 * @returns el resultado de la tabla
 */
function bucleDoWhile(multiplicando) {
  let resultado = "";
  let multiplicador = 0;
  let max = 10;
  do {
    resultado += `<li>${multiplicando}*${multiplicador} = ${
      multiplicando * multiplicador
    }</li>`;
    multiplicador++;
  } while (multiplicador <= max);
  return resultado;
}

/**
 * Función que devuelve el resultado de la operación mediante el
 * desplazamiento de bits.
 *
 * @param {*} operando1
 * @param {*} operando2
 * @param {*} operacion si es multiplicación o división
 * @param {*} id identificación de la operación
 */
function oprearEnBinario(operando1, operando2, operacion, id) {
  // Dividimos el operando2 para obtener el número de desplazamientos.
  operando2 /= 2;

  // Obtener el resultado dependiendo de la operación
  let resultado =
    operacion === "*" ? operando1 << operando2 : operando1 >> operando2;

  // Re-escribir el contenido del span
  document.getElementById("operacion" + id).innerHTML = resultado;
}
