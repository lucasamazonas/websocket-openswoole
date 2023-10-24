<?php

declare(strict_types=1);

namespace App\Infra;

use Doctrine\DBAL\{DriverManager, Exception};
use Doctrine\ORM\{EntityManager, ORMSetup, Exception\MissingMappingDriverImplementation};

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
            'allowPublicKeyRetrieval' => true
        ];

        $connection = DriverManager::getConnection($params, $config);

        return new EntityManager($connection, $config);
    }
}