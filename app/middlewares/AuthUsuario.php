<?php

class AutenticadorUsuario {

    public static function VerificarUsuario($request, $handler){
        $parametros = $request->getParsedBody(); 
        if (isset($parametros['rol']) && self::ValidarRolUsuario($parametros['rol'])) {
            return $handler->handle($request);
        }
        throw new Exception('No autorizado');
    }

    public static function ValidarPermisosDeRol($request, $handler, $rol = false){
        $parametros = $request->getParsedBody();
        if (isset($parametros['rol'])) {
            $rolUsuario = $parametros['rol'];
            if ((!$rol && $rolUsuario == 'socio') || ($rol && $rolUsuario == $rol) || $rolUsuario == 'socio') {
                return $handler->handle($request);
            }
        }
        throw new Exception('Acceso denegado');
    }

    public static function ValidarPermisosDeRolDoble($request, $handler, $rol1 = false, $rol2 = false){
        $parametros = $request->getParsedBody();
        if (isset($parametros['rol'])) {
            $rolUsuario = $parametros['rol'];
            if ((!$rol1 && $rolUsuario == 'socio') || ($rol1 && $rolUsuario == $rol1) || ($rol2 && $rolUsuario == $rol2) || ($rolUsuario == 'socio' || $rolUsuario == 'mozo')) {
                return $handler->handle($request);
            }
        }
        throw new Exception('Acceso denegado');
    }
    
    public static function ValidarCampos($request, $handler){
        $parametros = $request->getParsedBody();
        if (isset($parametros['nombre']) ||  isset($parametros['clave']) || isset($parametros['rol']) ) {
            return $handler->handle($request);
        }
        throw new Exception('Campos inválidos');
    }

    public static function ValidarCampoIdUsuario($request, $handler){
        $parametros = $request->getQueryParams();
        if (isset($parametros['idUsuario'])) {
            return $handler->handle($request);
        }
        throw new Exception('Campo idUsuario no encontrado');
    }

    public static function ValidarRolUsuario($rol){
        return in_array($rol, ['socio', 'bartender', 'cocinero', 'mozo', 'candybar']);
    }
}
