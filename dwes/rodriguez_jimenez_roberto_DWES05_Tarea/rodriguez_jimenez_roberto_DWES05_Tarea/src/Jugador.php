<?php
namespace Clases;

use PDO;
use PDOException;
use PDOStatement;


class Jugador extends Conexion
{
    private $id;
    private $nombre;
    private $apellidos;
    private $dorsal;
    private $posicion;
    private $barcode;

    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
    }



    // -- SETTERS ----------------------------------------------------
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;
    }

    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * CREATE
     * Crea un jugador en la base de datos
     */
    public function create(): void
    {
        $insert = "INSERT INTO jugadores (nombre, apellidos, dorsal, posicion, barcode)
         VALUES(:n, :a, :d, :p, :b)";

        $stmt = $this->conexion->prepare($insert);

        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':a' => $this->apellidos,
                ':d' => $this->dorsal,
                ':p' => $this->posicion,
                ':b' => $this->barcode
            ]);
        } catch (PDOException $e) {
            die("Error al insertar el nuevo jugador: " . $e->getMessage());
        }
    }

    /**
     * Comprueba si el código de barras existe dentro del conjunto de jugadores.
     * @param string $barcode el código en formato texto
     * @return bool true|false 
     */
    public static function existsBarcode(string $barcode): bool
    {

        // Obtener el listado de jugadores.
        // Es un array de objetos "Jugador"
        $listado = self::getListadoJugadores();

        // Recorremos el listado para comprobar si el código pasado existe
        foreach ($listado as $jugador) {

            // Retornamos true si el código existe.
            if ($jugador->barcode === $barcode) {
                return true;
            }
        }

        // Si se ha salido del bucle, es que el código no existe.
        return false;
    }

    /**
     * Comprueba si el dorsal existe dentro del conjunto de jugadores.
     * @param string $dorsal
     * @return bool true|false 
     */
    public static function existsDorsal(string $dorsal): bool
    {

        // Obtener el listado de jugadores.
        // Es un array de objetos "Jugador"
        $listado = self::getListadoJugadores();

        // Recorremos el listado para comprobar si el código pasado existe
        foreach ($listado as $jugador) {

            // Retornamos true si el código existe.
            if ($jugador->dorsal == $dorsal) {
                return true;
            }
        }

        // Si se ha salido del bucle, es que el código no existe.
        return false;
    }

    /**
     * Devuelve el conjunto de registros de jugadores.
     * @return PDOStatement resuldato de la consula.
     */
    public static function getListadoJugadores(): array
    {

        $consulta = "SELECT * FROM jugadores ORDER BY dorsal";
        $cnx = new Conexion();
        $stmt = $cnx->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error al recuperar el listado de los jugadores: " . $e->getMessage());
        }
        $cnx = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * Obtiene el listado de opciones de tipo enum del campo 'posicion'
     * en la tabla de jugadores.
     * 
     * @author Roberto Rodriguez Jiménez <roberto.rodjim.1@educa.jcyl.es>
     * @return array colección con las opciones.
     */
    public static function getPosiciones(): array
    {

        // Ejecutar la consulta
        $consulta = "SELECT column_type
        FROM information_schema.COLUMNS
        WHERE table_schema = 'practicaunidad5'
            AND TABLE_NAME = 'jugadores' 
            AND column_name = 'posicion'";

        $cnx = new Conexion();
        $stmt = $cnx->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error al recuperar las posiciones: " . $e->getMessage());
        }

        // Obtener los resultados
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        // var_dump($result);
        $linea = $result[0]->column_type;

        // Lo que contiene la línea
        // enum('Portero','Defensa','Lateral Izquierdo','Late...')
        $resultado = preg_match_all(
            '/\'[A-Za-z ]+\'/',
            $linea,
            $posiciones_temporales
        );

        // Array final que se va a devolver
        $final = [];
        // Posiciones temporales es un array
        $posiciones = $posiciones_temporales[0];

        // Se eliminan las comillas simples y se agrega cada opción al array
        foreach ($posiciones as $posicion) {
            $final[] = str_ireplace("'", "", $posicion);
        }

        $cnx = null;
        return $final;

    }

    /**
     * Comprueba si la tabla jugadores está vacía.
     * @return bool true|false si está o no vacía.
     */
    public static function isEmptyJugadores(): bool
    {
        // Consultamos el número de registros del array recibido
        // VSC trata el código como un error al esperar un array y encontar
        // PDOStatement, pero getListadoJugadores() devuelve un array.
        return count(self::getListadoJugadores()) == 0;
    }
    public function __toString(): string
    {
        return "
            $this->dorsal <br> 
            $this->nombre <br> 
            $this->apellidos <br> 
            $this->posicion <br> 
            $this->barcode 
        ";
    }

}