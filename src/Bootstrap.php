<?php
declare(strict_types=1);

require_once __DIR__ . "/../src/config/route/RouterClass.php";

$routeClass = new RouterClass();
$routeData = $routeClass->getRoutePath();
$routeParams = $routeClass->getRouteParams();
$routeControllerClass = $routeData['controllerClass'];
$routeControllerClassMethod = $routeData['methodName'];
 $object = new $routeControllerClass();
$object->$routeControllerClassMethod($routeParams);

