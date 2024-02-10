window.onload = () => {

    // Componentes
    btn_marcar = document.getElementById('marcar');
    btn_desmarcar = document.getElementById('desmarcar');
    chb_verano = document.getElementById('verano');

    // Inicializar componentes
    chb_verano.checked = false;
    btn_desmarcar.disabled = true;

    // Eventos
    btn_marcar.addEventListener('click', marcar);
    btn_desmarcar.addEventListener('click', desmarcar);
    chb_verano.addEventListener('change', () => {
        if (this.checked) {
        }else{
        }
    });

}

// Declarar componentes
let chb_verano,
    btn_marcar,
    btn_desmarcar;


// Funciones
const marcar = () => {
    chb_verano.checked = true;
    btn_marcar.disabled = true;
    btn_desmarcar.disabled = false;
}

const desmarcar = () => {
    chb_verano.checked = false;
    btn_marcar.disabled = false;
    btn_desmarcar.disabled = true;
}
