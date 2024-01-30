<?php 
// scripts para conectar y consultar bases de datos

$user = 'gestor';
$pass = 'secreto';
$db = 'proyecto';
$host = 'localhost';
$port = 3306;

/**
 * Devuelve una conexión con la base de datos
 * 
 * @author Roberto Rodríguez <roberto.rodjim.1@educa.jcyl.es>
 * @return mysqli objeto con la conexión a la base de datos
 */
function getMySQLiConnection(): mysqli{

    // Declaramos globales las variables que vamos a usar
    global $user, $pass, $host, $db;

    // @ evita que se muestre un mensaje de error
    @$connection = new mysqli($host, $user, $pass, $db);

    // Comprobamos si hay error y lanzamos una excepción si lo hay.
    // La excepción debe ser capturada al realizar la conexión.
    if($connection->connect_errno != null){
        throw new Exception();
    }

    return $connection;
}

/**
 * Conectar con la base de datos a través de PDO
 */
function getPDOConnection(){

    // Declaramos globales las variables que vamos a usar
    global $user, $pass, $host, $db;

    // Montar el dsn (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    

    // Conectar
    try{

        $connection = new PDO($dsn,$user,$pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;

    }catch(Exception $e){
        echo "Error al conectar con la base de datos: " . $e->getMessage();
    }

}

/**
 * Cierra la conexión MYSQL
 */
function closeMySQLConnection(mysqli $connection){
    $connection->close();
}

/**
 * Cierra la conexión PDO
 */
function closePDOConnection(PDO $connection){

    // Para cerrar una conexión PDP, hay que establecerla en null
    $connection = null;
}