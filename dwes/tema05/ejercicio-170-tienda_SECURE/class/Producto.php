<?php

class Producto extends Conexion
{

    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $familia;
    private $description;

    public function __construct()
    {
        parent::__construct();
    }



    // SETTER --------------------------------------------
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setNombre_corto($nombre_corto)
    {
        $this->nombre_corto = $nombre_corto;
    }

    public function setPvp($pvp)
    {
        $this->pvp = $pvp;
    }

    public function setFamilia($familia)
    {
        $this->familia = $familia;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    // -- MÉTODOS PARA HACER EL CRUD ----------------------------------------------

    /**
     * CREATE
     * Función que inserta un producto
     */
    function create()
    {

        $insert = "INSERT INTO productos(nombre, nombre_corto, pvp, familia, descripcion) 
        VALUES(:n, :c, :p, :f, :d)";
        $stmt = $this->conexion->prepare($insert);
        try {

            $stmt->execute([
                ':n' => $this->nombre,
                ':c' => $this->nombre_corto,
                ':p' => $this->pvp,
                ':f' => $this->familia,
                ':d' => $this->description
            ]);

        } catch (Exception $e) {
            die("Error al insertar un producto: " . $e->getMessage());
        }

    }

    /**
     * READ
     */
    function read(): array
    {
        $consulta = "SELECT * FROM productos WHERE id=:i";
        $stmt = $this->conexion->prepare($consulta);

        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $e) {
            die("Error al recuperar el producto: " . $e->getMessage());
        }

        // Se devuelve todo porque solo es una fila
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * UPADTE
     */
    function update()
    {
        $consulta = "UPDATE productos 
        SET nombre=:n, nombre_corto=:c, pvp:=p, familia=:f, descripcion=:d
        WHERE id=:id";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':c' => $this->nombre_corto,
                ':p' => $this->pvp,
                ':f' => $this->familia,
                ':d' => $this->description,
                ':i' => $this->id
            ]);
        } catch (PDOException $e) {
            die("Error al actualizar el producto: " . $e->getMessage());
        }
    }

    /**
     * DELETE
     */
    function delete(){
        $consulta = "DELETE productos WHERE id=:i";
        $stmt = $this->conexion->prepare($consulta);
        try{
            $stmt->execute([
                ':i' => $this->id
            ]);
        }catch(PDOException $e){
            die("Ocurrión un error al intentar borrar el producto: " . $e->getMessage() );
        }
    }

    // -- OTROS MÉTODOS ----------------------------------------------
    /**
     * Recupera todos los productos ordenados por nombre.
     * @return PDOStatement es el resultado de la consulta
     */
    function recuperarProductos():PDOStatement{
        $consulta = "SELECT * FROM productos ORDER BY nombre";
        $stmt = $this->conexion->prepare($consulta);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error al recuperar los productos: " . $e->getMessage());
        }
        return $stmt;
    }

    /**
     * Comprueba si el nombre corto ya existe y tiene el atributo 'unique'.
     * @return bool si el nombre corto ya existe.
     */
    function existeNombreCorto($nc):bool{

        $consulta = ($this->id == null)?
            "SELECT * FROM productos WHERE nombre_corto=:nc":
            "SELECT * FROM productos WHERE nombre_corto=:nc AND id!=:i";

        $stmt = $this->conexion->prepare($consulta);
        try{
            if($this->id == null){
                $stmt->execute([':nc' => $nc]);
            }else{
                $stmt->execute([':nc' => $nc, ':i' => $this->id]);
            }
        }catch(PDOException $e){
            die("Error al comprobar el nombre corto: " . $e->getMessage());
        }

        return ($stmt->rowCount() > 0);

    }
}