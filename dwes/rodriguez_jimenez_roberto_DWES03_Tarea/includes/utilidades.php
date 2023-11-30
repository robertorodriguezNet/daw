<?php

/**
 * Muestra un mensaje de error cuando se produce una excepción.
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @since 2023.11.30
 * @param string $mensaje que se muestra.
 * @param PDOException excepción que se ha lanzado.
 */
function mostrarExcepcion($mensaje, $excepcion)
{
    echo "<div class='container my-3'>
        <div class='row justify-content-center'>
            <div class='col text-center'>
                <h2>$mensaje</h2>
                <a href='listado.php' class='btn btn-primary'>Volver al listado</a>
            </div>
        </div>
    </div>";
}
