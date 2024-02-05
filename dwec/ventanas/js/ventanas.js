window.onload = () => {

    // Abrir una ventana
    const APP = window.open("", "Pop-Up", "width=400,Height=300");

    let appH1 = document.createElement('h1');
    appH1.innerHTML = 'VENTANA ABIERTA';
    APP.document.body.appendChild(appH1);

    // Cuando la ventana se cierra, continuamos
    APP.onunload = () => continuar();

}

// Se ejecuta la segunda parte del ejercicio,
// escribir en la ventana de origen (la que llama al script)
let continuar = () => {

        // Escribir el encabezado
        let h1 = document.createElement('h1');
        h1.innerHTML = 'TAREA DWEC03';
        document.body.appendChild(h1);

        // Retrasar la ejecución del resto de código para dar
        // tiempo a escribir en la página
        setTimeout(pedirDatos,500);
}

// Pedimos el resto de los datos
let pedirDatos = () => {

    // Pedir el nombre
    let nombre = prompt("Escribe tu nombre");
    let p = document.createElement('p');
    let texto = document.createTextNode(nombre);
    p.appendChild(texto);
    document.body.appendChild(p);

    // Pedir el resto de datos
    // . . .
}