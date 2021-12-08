<?php

namespace Coppel\RAC\Modules;

use PDO;
use Phalcon\Mvc\Micro\Collection;

class Module implements IModule
{
    public function __construct()
    {
    }

    public function registerLoader($loader)
    {
        $loader->registerNamespaces([
            'Coppel\Rac\Controllers' => __DIR__ . '/controllers/',
            'Coppel\Rac\Models' => __DIR__ . '/models/'
        ], true);
    }

    public function getCollections()
    {
        $collection = new Collection();

        $collection->setPrefix('/api')
            ->setHandler('\Coppel\Rac\Controllers\ApiController')
            ->setLazy(true);

        $collection->get('/ejemplo', 'holaMundo');

        $collection->get('/usuarios', 'allUsers');
        $collection->get('/usuarios/{id}', 'oneUser');

        $collection->post('/altausuarios', 'altaUsers');
        $collection->post('/cambiousuarios/{id}','cambioUsers');

        $collection->get('/borrarusuarios/{id}','borrarUsers');

        return [
            $collection
        ];
    }

    public function registerServices()
    {
        $di = \Phalcon\DI::getDefault();

        $di->set('conexion', function () use ($di) {
            $config = $di->get('config')->db;

            return new PDO(
                "pgsql:host={$config->host};dbname={$config->dbname};",
                $config->username,
                $config->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );
        });

        $di->set('logger', function () {
            return new \Katzgrau\KLogger\Logger('logs');
        });
    }
}
