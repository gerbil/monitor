<?php

require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');
$job = $jenkins->getJob("Mobile%20provisioning");

function dismount($object)
{
    $reflectionClass = new ReflectionClass(get_class($object));
    $array = array();
    foreach ($reflectionClass->getProperties() as $property) {
        $property->setAccessible(true);
        $array[$property->getName()] = $property->getValue($object);
        $property->setAccessible(false);
    }
    return $array;
}

$results = dismount($job);

$build = $jenkins->getBuild("Mobile%20provisioning", $results['job']->lastBuild->number);

if ($_POST['command'] == 'start') {
   echo $jenkins->launchJob("Mobile%20provisioning");
} else if ($_POST['command'] == 'stop') {
   echo $build->stopBuild("Mobile%20provisioning", $results['job']->lastBuild->number);
};
