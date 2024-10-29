<?php
require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoController extends Producto implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        if (isset($parametros['nombre']) && isset($parametros['precio']) && isset($parametros['tipo'])) {
            $nombre = $parametros['nombre'];
            $precio = $parametros['precio'];
            $tipo = $parametros['tipo'];

            $producto = new Producto();
            $producto->nombre = $nombre;
            $producto->precio = $precio;
            $producto->tipo = $tipo;
            $producto->crearProducto();

            $payload = json_encode(array("mensaje" => "Producto creado con éxito"));
        } else {
            $payload = json_encode(array("mensaje" => "Faltan datos del producto"));
        }

    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
    }   

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $producto = Producto::obtenerProducto($id);
        $payload = json_encode($producto);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodos($request, $response, $args)
    {
        $lista = Producto::obtenerTodos();
        $payload = json_encode(array("listaProductos" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id = $args['id'];
        Producto::modificarProducto($id, $parametros['nombre'], $parametros['tipo'], $parametros['precio']);
        
        $payload = json_encode(array("mensaje" => "Producto modificado con éxito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Producto::borrarProducto($id);
        
        $payload = json_encode(array("mensaje" => "Producto borrado con éxito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
