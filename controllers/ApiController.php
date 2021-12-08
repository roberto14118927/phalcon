<?php

namespace Coppel\Rac\Controllers;

use Coppel\RAC\Controllers\RESTController;
use Coppel\RAC\Exceptions\HTTPException;
use Coppel\Rac\Models as Modelos;

class ApiController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\ApiModel();
    }

    public function holaMundo()
    {
        $response = null;

        try {
            $response = $this->modelo->holaMundo();
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

    public function allUsers()
    {
        $response = null;

        try {
            $response = $this->modelo->allUsers();
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

    public function oneUser($id)
    {

        if(!is_numeric($id)){
            return $this->respond(['response' => "Id invalido"]);
        }
        $response = null;

        try {
            $response = $this->modelo->oneUser($id);
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

    public function altaUsers()
    {

        $datos = $this->request->getJsonRawBody();
        
        $response = null;

        try {
            $response = $this->modelo->altaUsers($datos);
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

    public function cambioUsers($id)
    {

        $datos = $this->request->getJsonRawBody();
        
        $response = null;

        try {
            $response = $this->modelo->cambioUsers($datos,$id);
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

    public function borrarUsers($id)
    {

       
        $response = null;

        try {
            $response = $this->modelo->borrarUsers($id);
        } catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");

            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }

        return $this->respond(['response' => $response]);
    }

}
