let ventana = window.open("","Nueva ventana", "width=400,height=300");

let $comprobarCerrada = setInterval(
    () =>{
        if(ventana.closed){
            continuar();($comprobarCerrada);
            clearInterval
        }
    },
    1000
);

function continuar(){

}

// let comprobarCierre = setInterval(() => {   // guardo en esa variable la referencia a setinterval para eliminar luego esa función
//     if (ventana.closed === true) {    // compruebo si la ventana ya está cerrada
//         continuar();   // llamo a la función continuar
//         clearInterval(comprobarCierre)  // elimino que cada segundo lo vuelva a comprobar
//     }
// }, 1000)

// function continuar() {   // funcion continuar con todos los prompt y wirteln que me solicita sacar en la primera ventana
//     focus()
//     document.writeln("<h1>TAREA DEWEC03</H2><HR/>");
//    // ... continua con vuestras sentencias
// }