window.onload = () => {

    btn_consultar = document.getElementById('boton');
    btn_consultar.addEventListener('click', () =>{

        // Obtener el select provincias
        let provincias = document.getElementById('provincias');

        let texto = provincias.options[provincias.selectedIndex].text;
        let valor = provincias.options[provincias.selectedIndex].value

        alert(`Datos de la opción seleccionada:\n\nTexto; ${texto}\nValor: ${valor}`);

    });


}

let btn_consultar;