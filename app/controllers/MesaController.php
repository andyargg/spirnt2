<?php
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController extends Mesa implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $mesa = new Mesa();
        $mesa->numero = $parametros['numero'];
        $mesa->capacidad = $parametros['capacidad'];
        $mesa->estado = $parametros['estado'];
        $mesa->fecha_creacion = date('Y-m-d');
        $mesa->crearMesa();

        $payload = json_encode(array("mensaje" => "Mesa creada con éxito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Mesa::obtenerTodos();
        $payload = json_encode(array("listaMesas" => $lista));
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
