<?php

declare(strict_types=1);

namespace App;

use Doctrine\DBAL\{DriverManager, Exception};
use Doctrine\ORM\{EntityManager, Exception\MissingMappingDriverImplementation, ORMSetup};

class EntityManagerCreator
{

    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     */
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../Entity"],
            isDevMode: true,
        );

        $params = [
            'host'     => $_ENV['DB_HOST'],
            'driver'   => $_ENV['DB_DRIVER'],
            'dbname'   => $_ENV['DB_NAME'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
        ];

        $connection = DriverManager::getConnection($params, $config);

        return new EntityManager($connection, $config);
    }

}