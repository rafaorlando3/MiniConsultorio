<?php 
    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

    require_once __DIR__.'/../vendor/autoload.php';

    $isDevMode = true;
    $configuration = Setup::createAnnotationMetadataConfiguration(
        [__DIR__.'/../src/Consultorio/entidades'], 
        $isDevMode
    );

    $connection = [
        'dbname' => 'consultorio',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'
    ];
    
    $entityManager = EntityManager::create($connection, $configuration)
?>