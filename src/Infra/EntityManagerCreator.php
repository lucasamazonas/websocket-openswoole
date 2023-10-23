<?php

declare(strict_types=1);

namespace App\Infra;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

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
            'host' => 'localhost',
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'foo',
        ];

        $connection = DriverManager::getConnection($params, $config);

        return new EntityManager($connection, $config);
    }
}