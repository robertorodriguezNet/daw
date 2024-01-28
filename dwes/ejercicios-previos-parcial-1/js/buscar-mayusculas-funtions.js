// Botón borrar del formulario
let btn_borrar = document.getElementById('btn-borrar');
if(btn_borrar != null){btn_borrar.onclick = () => {
    // Cargamos de nuevo la página pero sin los datos de formulario
    location.href = location.href;
}}
