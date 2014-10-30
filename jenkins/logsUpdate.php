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

$logs = $job->getLogs($results['job']->url, $results['job']->lastBuild->number);
$logsArray = preg_split("/\\r\\n|\\r|\\n/", $logs);
$logsArrayLast10lines = array_slice($logsArray, -20, 20);

for ($i = 0; $i <= sizeof($logsArrayLast10lines); $i++) {
    echo $logsArrayLast10lines[$i] . '<br/>';
}
