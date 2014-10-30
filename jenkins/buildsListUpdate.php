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
    $status = 'default';
    $currentBuild = dismount($jenkins->getBuild("Mobile%20provisioning", $results['job']->builds[$i]->number));
    $currentBuildResult = $currentBuild['build']->result;
    if ($currentBuildResult == "SUCCESS") {
        $status = 'success';
        $color = 'color_21';
    } elseif ($currentBuildResult == NULL) {
        $status = 'inProgress';
        $color = 'color_0';
    } else {
        $status = 'fail';
        $color = 'color_25';
    }

    echo '
             <div class="span2">
                <div class="box ' . $color . ' height_small title_big">
                   <div class="title">
                        <h5 style="margin: 5px 0 0 30px"><a class="center" href="' . $results['job']->builds[$i]->url . '">' . $results['job']->builds[$i]->number . '</a></h5>
                    </div>
                     ';

    if ($status == 'inProgress') {
        echo '<div class="btn-toolbar pull-right"><div class="btn-group"><a href="" class="btn stop" title="Stop this build" style="padding: 4px !important; background: #6a6a6a;"><img src="wp-content/themes/monitor/img/lbremove.png"></a></div></div>';
    };

    echo '</div></div>';

}