window.onload = () => {

    // Inicializar componentes
    inp_texto = document.getElementById('inp-texto');
    btn_comprobar = document.getElementById('btn-comprobar');

    // Sección en la que escribir el resultado
    seccion = document.getElementById("ejercicio");

    // Eventos para los botones
    btn_comprobar.addEventListener('click', comprobar);


}

// Componentes
let inp_texto;
let btn_comprobar;

// Sección en la que escribir el resultado
let seccion;

const PATTERN = "[A-Z]";

/** FUNCIONES *************************************** **/
const comprobar = () => {
    let texto = inp_texto.value;
    let mayusculas = [];

    // Recorrer la cadena de texto comprobando cada carácter
    for (let i in texto) {

        if (texto[i].match(PATTERN)) {
            mayusculas.push(texto[i])
        }
    }

    let ul = document.createElement('ul');

    mayusculas.forEach(e => {
        // console.log(e);
        let li = document.createElement('li');
        let texto = document.createTextNode(e);
        li.appendChild(texto);
        ul.appendChild(li);
    });

    seccion.appendChild(ul);
}