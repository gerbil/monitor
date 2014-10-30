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

for ($i = 0; $i <= 5; $i++) {
    $currentBuild = dismount($jenkins->getBuild("Mobile%20provisioning", $results['job']->builds[$i]->number));
    $currentBuildResult = $currentBuild['build']->result;
    if ($currentBuildResult == "SUCCESS") {
        $color = 'color_21';
    } elseif ($currentBuildResult == NULL) {
        $color = 'color_0';
    } else {
        $color = 'color_25';
    }
    echo '<div class="span2">
                <div class="box ' . $color . ' height_small title_big">
                   <div class="title">
                        <h5 style="margin: 5px 0 0 30px"><a class="center" href="' . $results['job']->builds[$i]->url . '">' . $results['job']->builds[$i]->number . '</a></h5>
                    </div>
                 </div>
              </div>';
}