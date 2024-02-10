window.onload = () => {

    // Componenetes
    nombre = document.getElementById('nombre');

    // Eventos
    nombre.addEventListener('blur', convertirMayusculas);

}

let nombre;

// Funciones
const convertirMayusculas = () => {
    nombre.value = nombre.value.toUpperCase();
}