<?php

require_once(__DIR__ . '/../bootstrap/autoload.php');

$application = $container->get(Symfony\Component\Console\Application::class);

$application->add($container->get(Homework\Commands\CheckEquationCommand::class));

$application->run();