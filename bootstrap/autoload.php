<?php

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(true);

$builder->addDefinitions([
    Homework\Commands\CheckEquationCommand::class => DI\object()
        ->constructor(
            DI\get(\Hitenok\ValidatorAlgebraicEquation::class),
            DI\get(\Homework\FileSystem::class)
        ),
]);

$container = $builder->build();