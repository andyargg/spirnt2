<?php

require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';
class PedidoController extends Pedido implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $pedido = new Pedido();
        $pedido->mesa_id = $parametros['mesa_id'];
        $pedido->usuario_id = $parametros['usuario_id'];
        $pedido->estado = $parametros['estado'];
        $pedido->crearPedido();

        $payload = json_encode(array("mensaje" => "Pedido creado con éxito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(array("listaPedidos" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerUno($request, $response, $args)
    {
        
    }
    public function BorrarUno($request, $response, $args)
    {
        
    }
    public function ModificarUno($request, $response, $args)
    {
        
    }
}

