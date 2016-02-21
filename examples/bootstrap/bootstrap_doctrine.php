<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require __DIR__.'/bootstrap_general.php';

$paths = [__DIR__.'/../entities'];
$isDevMode = true;

// the connection configuration
$dbParams = [
    'driver' => 'pdo_sqlite',
    'path'   => __DIR__.'/../rulerz.db',
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$entityManager = EntityManager::create($dbParams, $config);

// compiler
$compiler = new \RulerZ\Compiler\Compiler(new \RulerZ\Compiler\EvalEvaluator());

// RulerZ engine
$rulerz = new \RulerZ\RulerZ(
    $compiler, [
        new \RulerZ\Compiler\Target\Sql\DoctrineQueryBuilder(),
        //new \RulerZ\Compiler\Target\ArrayVisitor([
        //    'length' => 'strlen'
        //]),
    ]
);

return [$entityManager, $rulerz];
