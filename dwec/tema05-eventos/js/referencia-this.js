const identificar = (objeto) => {

    // Objeto hace referencia al control que llama a la función.

    let nombre = objeto.name;
    let id = objeto.id;
    let valor = objeto.value;
    let tipo = objeto.type;

    alert(`Datos del campo pulsado:\n\nNombre: ${nombre}\nID: ${id}\nValor: ${valor}\nTipo: ${tipo}`);
}
