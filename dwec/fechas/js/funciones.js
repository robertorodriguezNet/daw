window.onload = () => {

    // Inicializar componentes
    let slc_selector = document.getElementById('slc-selector');

    let btn_calcular = document.getElementById('btn-calcular');

    // Implementar los eventos
    slc_selector.addEventListener("change", (e) => {
        document.location.href = `${slc_selector.value}.php`;
    });

    if (btn_calcular != null) {
        btn_calcular.addEventListener("click", calcularDiaDeLaSemana);
    }


}

const SEMANA = ['domingo','lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

/**
 * Función para calcular el día de la semana
 */
let calcularDiaDeLaSemana = () => {

    // Obtener un objeto Date a partir de la fecha
    let texto = document.getElementById('inp-fecha').value;
    let fecha = new Date(texto);


    alert(SEMANA[fecha.getDay()]);

}