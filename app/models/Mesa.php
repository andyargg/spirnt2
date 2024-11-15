<?php
class Mesa
{
    public $id;
    public $numero;
    public $capacidad;
    public $estado;
    public $fecha_creacion;

    public function crearMesa()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (numero, capacidad, estado, fecha_creacion) VALUES (:numero, :capacidad, :estado, :fecha_creacion)");
        $consulta->bindValue(':numero', $this->numero, PDO::PARAM_INT);
        $consulta->bindValue(':capacidad', $this->capacidad, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);

        $consulta->execute();
    }


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, numero, capacidad, estado, fecha_creacion FROM mesas");
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }
    public static function obtenerMesaId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesaCodigoMesa($codigoMesa) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE codigo = :codigoMesa");
        $consulta->bindValue(':codigoMesa', $codigoMesa, PDO::PARAM_STR);
        $consulta->execute();
    
        return $consulta->fetchObject('Mesa');
    }
}