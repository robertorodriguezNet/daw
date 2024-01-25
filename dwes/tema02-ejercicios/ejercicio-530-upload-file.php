<?php
$title = 'Subiendo archivos';
$page = 'dwes';
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/head.php';
require_once 'classes.php';
function isTipoOk($tipo){
    if($tipo=="application/pdf") return true;
    return false;
}
function comprobarError($i){
        switch ($i){
            case 1:
                echo "<p>El fichero subido excede la directiva upload_max_filesize de php.ini.</p>";
                break;
            case 2:
                echo "<p>El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.</p>";
                break;
            case 3:
                echo "<p>El fichero fue sólo parcialmente subido.</p>";
                break;
            case 4:
                echo "<p>No se subió ningún fichero.</p>";
                break;
            case 6:
                echo "<p>No se pudo escribir en la carpeta temporal</p>";
                break;
            case 8:
                echo "<p>No se pudo escribir el fichero en el disco.</p>";

        }
}
?>

<section class="enunciado">
    <h4>Enunciado</h4>
    <p>
        Veamos un ejercicio resuelto donde detallamos el proceso de subir un archivo, controlaremos el tamaño máximo
        del archivo (ve cambiando los valores de MAX_FILE_SIZE para probar los errores) y el tipo del mismo.
    </p>
    <p>
        Crearemos un formulario con un input de tipo file para subir un documento PDF a una carpeta "documentos" del
        servidor. Comprueba errores, el tamaño máximo del archivo será de 50000 bytes.
    </p>

</section>

<section>

    <article>
        <h3>Valores que hay que ajustar en <strong>php.ini</strong></h3>
        <ul>
            <li>post_max_size</li>
            <li>upload_max_filesize</li>
            <li>file_uploads</li>
        </ul>
    </article>
    <article>
        <h3>Tipos de datos</h3>
        <p>
            El formulario debe especificar <span class="code">enctype="multiplatform/form-data"</span> y el campo para
            subir el fichero será un <strong>input</strong> de tipo <strong>file</strong>.
        </p>
        <p>
            Para procesar el formulario se utiliza el array global <strong>$_FILES</strong>:

        </p>
        <ul>
            <li>$_FILES['fichero']['name'];</li>
            <li>$_FILES['fichero']['type'];</li>
            <li>$_FILES['fichero']['size'];</li>
            <li>$_FILES['fichero']['tmp_name']</li>
            <li>$_FILES['fichero']['error']; código de error asociado a la subida.</li>
        </ul>
    </article>
    <article>
        <h3>Proceso del formulaio</h3>
        <ul>
            <li>Comprobar si se ha subido el archivo con <span
                    class="code">is_uploaded_file($_FILES['fichero'['tmp_name']])</span></li>
            <li>Comprobar el tipo de fichero con <span class="code">$_FILES['fichero']['type']</span> .</li>
            <li>Mover el archivo de la carpeta temporal a la final con <span
                    class="code">move_uploaded_file($_FILE['fichero']['tmp_name'], carpeta)</span></li>
        </ul>
    </article>
</section>


<?php
if (isset($_POST["enviar"])) {
    if (is_uploaded_file($_FILES["documento"]["tmp_name"])) {
        if (isTipoOk($_FILES["documento"]["type"])) {
            $nombre = $_FILES["documento"]["name"];
            move_uploaded_file($_FILES["documento"]["tmp_name"], "./documentos/" . $nombre);
            echo "<p>Archivo subido correctamente</p>";
        } else {
            echo "Error, El tipo del archivo no es <b>pdf</b>";
        }
    } else {
        echo "<p>Han habido errores, estos han sido:</p>";
        comprobarError($_FILES["documento"]["error"]);
    }
}else{
?>
<h3 class="text-center">Subida de un fichero</h3>
    <form name="fichero" action="<?php echo $_SERVER['PHP_SELF']; ?>" ENCTYPE="multipart/form-data" method="POST">
        <!-- Establecemos el tamaño máximo del archivo a 50000 bytes -->
        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
        <label for="file" style="font-weight: bold">Elige el Fichero: </label>&nbsp;<input type="file" name="documento" accept="application/pdf">
        <br><br>
        <button type="submit" value="Subir" name="enviar">Enviar</button>
        <button type="reset" value="reset">Limiar</button>
    </form>
<?php } ?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/daw/web/parts/footer.php';
?>