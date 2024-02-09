class Persona {

    nombre;
    apellidos;
    correo;

    constructor(nombre, apellidos, correo) {
        this.nombre = nombre;
        this.apellidos = apellidos;
        this.correo = correo;
    }

    mostrarDatos() {
        return 'Nombre: ' + this.nombre + ' ' + this.apellidos;
    }

}

/**
 * Hereda de Persona
 */
class Alumno extends Persona {

    ciclo;
    fechaNacimiento;
    curso;

    constructor(nombre, apellidos, correo, fechaNacimiento, ciclo, curso) {

        super(nombre, apellidos, correo);

        this.ciclo = ciclo
        this.fechaNacimiento = fechaNacimiento;
        this.curso = curso;
    }


    edad() {



    }

}

// Crear los alumnos
let persona1 = new Persona("Roberto", "Rodríguez", "roberto@clase.es", "05/10/1969", "DAW", "2º");
let persona2 = new Persona("Rafael", "García", "rafael@clase.es", "01/01/2000", "DAW", "2º");
let persona3 = new Persona("Mónica", "Pérez", "monica@clase.es", "01/02/2000", "DAW", "1º");

// Colección de alumnos
let alumnos = [
    persona1,
    persona2,
    persona3,
]

/**
 * Crear un nuevo alumno e insertarlo en el array de alumnos
 */
function mostrarDatos() {

    // Inicializar datos
    let nombre = document.getElementById('nombre').value;
    let apellidos = document.getElementById('apellidos').value;
    let correo = document.getElementById('correo').value;
    let fechaNacimiento = document.getElementById('fecha_nacimiento').value;
    let curso = document.getElementById('curso');

    let alumno = new Alumno(nombre, apellidos, correo, fechaNacimiento, ciclo, curso);

    alumnos.push(alumno);

    // Recorrer la colección
    let count = 0;
    alumnos.forEach(alumno => {

        let h = document.getElementById("h2_" + ++count);
        h.innerHTML = alumno.mostrarDatos();

    });

    abrirVentana();

};

/**
 * Abrir una ventana para mostrar los datos
 */
function abrirVentana(){

    let ventana = window.open("","","width=400, height=300");

    let documento = ventana.document;

    let ul = documento.createElement('ul');

    alumnos.forEach(alumno => {

        let li = documento.createElement('li');
        li.innerHTML = alumno.mostrarDatos() + " estudia " + alumno.curso;
        ul.appendChild(li);
    });
    documento.body.appendChild(ul);

    // setTimeout(ventana.close(), 1000);
}