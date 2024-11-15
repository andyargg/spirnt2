<?php

class Pedido
{
    public $id;
    public $mesa_id;
    public $usuario_id;
    public $estado;
    public $fecha_pedido; 

    public function crearPedido()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos (mesa_id, usuario_id, fecha_pedido, estado) VALUES (:mesa_id, :usuario_id, :fecha_pedido, :estado)");
        $consulta->bindValue(':mesa_id', $this->mesa_id, PDO::PARAM_INT);
        $consulta->bindValue(':usuario_id', $this->usuario_id, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_pedido', date("Y-m-d"), PDO::PARAM_STR); 
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, mesa_id, usuario_id, fecha_pedido, estado FROM pedidos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedidoId($id){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedidoIndividual($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, codigoPedido, idMesa, idProducto, nombreCliente, sector, estado, importe, cantidad, fechaInicio, fechaCierre FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Pedido');
    }
}

