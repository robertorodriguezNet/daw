<?php
require_once('classes/bd.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta MySQL</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Consult a un base de datos</h1>
        <h2>DWES - Ejercicios previos al primer parcial</h2>
    </header>

    <section id="enunciado">
        <h3>Enunciado</h3>
        <p>
            Completa el código para realizar una consulta que devuelva el número de registros en una tabla de base de
            datos MySQL.
        </p>
        <p class="pre">
&lt;?php
<span class="variable">$servername</span> <span class="symbol">=</span> <span class="string">"localhost"</span><span class="symbol">;</span>
<span class="variable">$username</span> <span class="symbol">=</span> <span class="string">"tu_usuario"</span><span class="symbol">;</span>
<span class="variable">$password</span> <span class="symbol">=</span> <span class="string">"tu_contraseña"</span><span class="symbol">;</span>
<span class="variable">$dbname</span> <span class="symbol">=</span> <span class="string">"tu_base_de_datos"</span><span class="symbol">;</span>

<span class="comment">// Completa la conexión a la base de datos</span>

<span class="comment">// Completa el código para realizar la consulta y obtener el número de registros</span>

<span class="comment">// Muestra el resultado</span>
?>
        </p>
    </section>


    <section id="ejercicio">

        <p>Tenemos la base de dasos <strong>poyecto</strong> del tema 3 de DWES y es la que voy a usar.</p>
        <p>La consulta se hará sobre la tabla <strong>productos</strong>.</p>

        <article>
            <h4>Conectando con <strong>MySQLi</strong></h4>
            <?php
            try{
                
                $MySQLConnection = getMySQLiConnection();  // Conectar con la base de datos

                $query = "SELECT count(*) as amount FROM productos";
                $result = $MySQLConnection->query($query);

                // La consulta nos devuelve un solo resultado
                $data = $result->fetch_object();
                
                $result->free();                           // Liberar la memoria

                closeMySQLConnection($MySQLConnection);    // Cerrar la conexión

                echo "<p>Productos: $data->amount</p>";    // Imprimir el resultado

            }catch(Exception $e){
                echo "<p class=\"error\">Error al conectar con la base de datos: " . $e->getMessage() . "</p>";
            }
            ?>
        </article>

        <article>
            <h4>Conexión con <strong>PDO</strong></h4>
            <?php
            try{
                $PDOConnection = getPDOConnection();

                $query = "SELECT count(*) as amount FROM productos";
                $result = $PDOConnection->query($query);
                $data = $result->fetchObject();

                closePDOConnection($PDOConnection);

                echo "<p>Productos: $data->amount</p>";    // Imprimir el resultado

            }catch(Exception $e){
                echo $e->getMessage();
            }
            ?>
        </article>


    </section>

    <section id="solucion">
        <h3>Solución</h3>

    </section>


    <script src="js/rectangulo.js"></script>
</body>

</html>