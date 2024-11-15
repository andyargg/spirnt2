<?php

require_once "./models/Mesa.php";

class AuthMesas{
    public static function ValidarMesa($request, $handler){
        $parametros = $request->getParsedBody();

        if(isset($parametros['id'])){
            $mesa = Mesa::obtenerMesaId($parametros['id']);
            if($mesa){
                return $handler->handle($request);
            }
        }
        throw new Exception('Mesa no existente');
    }

    public static function ValidarMesaCodigoMesa($request, $handler){
        $parametros = $request->getParsedBody();
         
        if (isset($parametros['codigoMesa'])){
            $mesa = Mesa::obtenerMesaCodigoMesa($parametros['codigoMesa']);
            if ($mesa){
                return $handler->handle($request);
            }
        }
        throw new Exception('Mesa no existente');
    }

    public static function validarCampos($request, $handler){
        $parametros = $request->getParsedBody();
        
        if(isset($parametros['id'])){
            $codigo = $parametros['id'];
            $mesa = Mesa::obtenerMesaId($parametros['id']);
            if(self::ValidarMesaExistente($mesa)){
                return $handler->handle($request);
            }
        }
        throw new Exception('Campos invalidos');
    }

    public static function ValidarMesaCerrada($request, $handler){
        $parametros = $request->getParsedBody();
        $mesa = Mesa::obtenerMesaCodigoMesa($parametros['codigoMesa']);
        if($mesa->estado == "cerrada"){
            return $handler->handle($request);
        }
        throw new Exception('la mesa no esta cerrada');
    }

    public static function ValidarMesaExistente($mesa){
        if($mesa){
            return true;
        }
        return false;
    }
}