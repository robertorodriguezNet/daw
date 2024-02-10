window.onload = () => {

    let btn_consultar = document.getElementById('consultar');
    btn_consultar.onclick = () => {

        document.formulario.actores.forEach(actor => {
            if(actor.checked){
                alert(actor.value);
            }
        });

    }

}