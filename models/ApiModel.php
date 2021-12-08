<?php

namespace Coppel\Rac\Models;

use Phalcon\Mvc\Model as Modelo;

class ApiModel extends Modelo
{
    public function holaMundo()
    {

        return "Hello world";
    }

    public function allUsers()
    {
        $de = \Phalcon\DI::getDefault();
        $response = array();

        $db = $de->get('conexion');
        $statement = $db->prepare("SELECT id,nombre,apellidos,edad,genero, fecha_alta,fecha_modificacion,status from usuarios order by id;");
        $statement-> execute();
        while ($entry = $statement->fetch()) {
              $resultSet = new \stdClass();

              $resultSet->id = $entry->id;
              $resultSet->nombre = $entry->nombre;
              $resultSet->apellidos = $entry->apellidos;
              $resultSet->edad = $entry->edad;
              $resultSet->genero = $entry->genero;
              $resultSet->fecha_alta = $entry->fecha_alta;
              $resultSet->fecha_modificacion = $entry->fecha_modificacion;
              $resultSet->status = $entry->status;
              array_push($response,$resultSet);
                $resultSet = null;
        }

        if(count($response) > 0){
            $response = array(
                'code' => 200,
                'message' => count($response).' usuarios encontrados',
                'usuarios' => $response
            );
       }else{
            $response = array(
                'code' => 400,
                'message' => 'Error al consultar usuarios'
            );
        }

        return $response;


    }

    public function oneUser($id)
    {
        $de = \Phalcon\DI::getDefault();
        $response = array();

        $db = $de->get('conexion');
        $statement = $db->prepare("SELECT id,nombre,apellidos,edad,genero, fecha_alta,fecha_modificacion,status from usuarios where id = $id order by id;");
        $statement-> execute();
        while ($entry = $statement->fetch()) {
              $resultSet = new \stdClass();

              $resultSet->id = $entry->id;
              $resultSet->nombre = $entry->nombre;
              $resultSet->apellidos = $entry->apellidos;
              $resultSet->edad = $entry->edad;
              $resultSet->genero = $entry->genero;
              $resultSet->fecha_alta = $entry->fecha_alta;
              $resultSet->fecha_modificacion = $entry->fecha_modificacion;
              $resultSet->status = $entry->status;
              array_push($response,$resultSet);
                $resultSet = null;
        }

        return $response;


    }

    public function altaUsers($datos)
    {
       

        $de = \Phalcon\DI::getDefault();
        $response = array();

        $db = $de->get('conexion');
        $statement = $db->prepare("insert into usuarios (nombre,apellidos,edad,genero,fecha_alta,fecha_modificacion,status)
                         values ('$datos->nombre','$datos->apellidos','$datos->edad','$datos->genero','now()','now()',true);");
        $statement-> execute();

        $count = $statement->rowCount();

       if($count == 1){
            $response = array(
                'code' => 200,
                'message' => 'Usuario creado correctamente'
            );
       }else{
            $response = array(
                'code' => 400,
                'message' => 'Error al crear el usuario'
            );
        }


       

        return $response;


    }

    public function cambioUsers($datos,$id)
    {
       

        $de = \Phalcon\DI::getDefault();
        $response = array();
        $db = $de->get('conexion');
        $statement = $db->prepare("update usuarios set nombre = '$datos->nombre', apellidos = '$datos->apellidos'
        ,edad = '$datos->edad', genero = '$datos->genero', fecha_modificacion = 'now()', status = '$datos->status' where id = ".$id.";");
        $statement-> execute();

        $count = $statement->rowCount();

       if($count == 1){
            $response = array(
                'code' => 200,
                'message' => 'Usuario modificado correctamente'
            );
       }else{
            $response = array(
                'code' => 400,
                'message' => 'Error al modificar el usuario'
            );
        }
        return $response;


    }

    public function borrarUsers($id)
    {
       

        $de = \Phalcon\DI::getDefault();
        $response = array();
        $db = $de->get('conexion');
        $statement = $db->prepare("Delete from usuarios where id =".$id);
        $statement-> execute();

        $count = $statement->rowCount();

       if($count == 1){
            $response = array(
                'code' => 200,
                'message' => 'Usuario eliminado correctamente'
            );
       }else{
            $response = array(
                'code' => 400,
                'message' => 'Error al eliminar el usuario'
            );
        }
        return $response;


    }

}
