// Inicialización de los elementos del formulario
const INP_BASE = document.getElementById("inp-base");
const INP_ALTURA = document.getElementById("inp-altura");
const BTN_CALCULAR = document.getElementById("btn-calcular");

// Estado inicial de los elementos
BTN_CALCULAR.disabled = true;

// Eventos para los input
INP_BASE.addEventListener('keyup',(e) => habilitarBotonCalcular());
INP_ALTURA.addEventListener('keyup', (e) => habilitarBotonCalcular());
BTN_CALCULAR.addEventListener('click',(e) => abrirVentana(e));
BTN_CALCULAR.addEventListener('keypress',(e) => abrirVentana(e));

// Funciones -------------------------------------------------------------
/**
 * @description Habilita un botón para ejecutar el cálculo del área del cuadrilátero.
 */
function habilitarBotonCalcular(){

    if(INP_BASE.value && INP_ALTURA.value >= 100){
        BTN_CALCULAR.disabled = false;
    }

}

/**
 * @description abre una ventana con las dimensiones dadas.
 * @param {Event} e evento desencadenado 
 */
function abrirVentana(e){

    /**
     * @description preventDefault evitaría que el evento al que llama el 
     * botón (click)se ejecutase, impidiendo que se recargase la página, 
     * pero permitiendo la ejecución del script
     */    
    // this.event.preventDefault();

    if(((e.type === "keypress") && (e.key === 'Enter')) || (e.type === 'click')){

        let ventana = window.open("","",`width=${INP_BASE.value},height=${INP_ALTURA.value}`);
        let body = ventana.document.body;

        ventana.document.title = "Área de un cuadrilátero";

        // Texto con las medidas
        let p_medidas = document.createElement('p');
        let text_medidas = document.createTextNode(`${INP_BASE.value} x ${INP_ALTURA.value}`);
        p_medidas.appendChild(text_medidas);

        // Texto con la superficie
        let p_area = document.createElement('p');
        let text_area = document.createTextNode(`Área: ${INP_BASE.value * INP_ALTURA.value}`);
        p_area.appendChild(text_area);

        body.appendChild(p_medidas);
        body.appendChild(p_area);

        // Estilo
        body.style.display = 'flex';
        body.style.flexDirection = 'column';
        body.style.justifyContent = 'center';
        body.style.alignContent = 'center';
        body.style.margin = 0;
        body.style.height = INP_ALTURA.value;

        p_medidas.style.textAlign = 'center';
        p_area.style.textAlign = 'center';
    
    }


}
