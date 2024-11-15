<?php

require_once "./models/Pedido.php";

class AuthPedidos{
    public static function ValidarPedidoExisten($request, $handler){
        $parametros = $request->getParsedBody();

        if(isset($parametros['id'])){
            $mesa = Pedido::obtenerPedidoId($parametros['id']);
            if($mesa){
                return $handler->handle($request);
            }
        }
        throw new Exception('Mesa no existente');

    }

    public static function ValidarCamposAlta($request, $handler){
        $parametros = $request->getParsedBody();
        if(isset($parametros['usuarioId'], $parametros['mesaId'], $parametros['estado'] )){
            return $handler->handle($request);
        }
        throw new Exception('Campos Invalidos');
    }

    public static function ValidarCamposModificar($request, $handler){
        $parametros = $request->getParsedBody();
        if(isset($parametros['id'])){
            return $handler->handle($request);
        }
        throw new Exception('Campos Invalidos');
    }

    public static function ValidarEstado($request, $handler){
        $parametros = $request->getParsedBody();

        if(isset($parametros['id'])){
            $pedido = Pedido::obtenerPedidoIndividual($parametros['id']);

            if($pedido->estado == 'pendiente'){

            } else{
                throw new Exception('El pedido no se puede modificar porque se finalizo la preparacion o fue cancelado');
            }
        }
        throw new Exception('Campos Invalidos');
    }
}