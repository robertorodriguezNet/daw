window.onload = () => {

    // La cadena buscada comienza con @ y continúa con letras.
    // A-z no equivale a A-Za-z ¿? pues comienza en 65 (A) y termina en 122 (z)
    // A-Za-z busca dos rangos: del 65 al 90 y del 97 al 122
    // + indica que debe aparecer al menos una vez y puede aparecer varias.
    // '*' indica que puede no aparecer
    // El modificador 'g' (global) indica que no debe dejar de buscar aunque encuentr alguno.
    const pattern = /@[A-z]+/g;

    const parrafo = document.getElementById('parrafo');

    let text = parrafo.innerText;

    // match() espera una expresión regular.
    // Devuelve un array con las apariciones
    let resultado = text.match(pattern);

    // console.log(resultado);
    // // --> Array["@Eduardo","@Carla"]

    resultado.forEach( value => {
        text = text.replace(value, `<a href="http://foo.com/?user=${value}">${value}</a>`);
    });

    let nuevoP = document.createElement('p');
    nuevoP.innerHTML = text;
    document.body.insertBefore(nuevoP, document.getElementById('codigo'));
    
}