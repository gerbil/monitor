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
?>
<div class="title row-fluid">
    <h5 class="pull-left">
        <span><?php echo '<a href="' . $results['job']->url . '">' . $results['job']->name . '</a>'; ?></span>
    </h5>
    <h5 class="pull-left" style="padding-top:45px;">
        <span><?php echo $results['job']->healthReport[0]->description; ?></span>
    </h5>
    <h5 class="pull-left" style="padding-top:85px;">
        <span>Latest build: <?php echo '<a href="' . $results['job']->lastBuild->url . '">' . $results['job']->lastBuild->number . '</a>'; ?></span>
    </h5>

    <div class="btn-toolbar pull-right ">
        <div class="btn-group">
            <div id="jenkinsMobileBuildControl">
                <a href="#" class="btn start" title="Start a new build" style="padding: 56px !important;"><img src="wp-content/themes/monitor/img/lbadd.png"></a>
                <a href="#" class="btn stop" title="Stop the build" style="padding: 56px !important; display: none;"><img src="wp-content/themes/monitor/img/lbremove.png"></a>
                <a href="#" class="btn inProgress" title="Build is in progress" style="padding: 56px !important; display: none;"><img src="wp-content/themes/monitor/img/lbhz.png"></a>
            </div>
        </div>
    </div>
</div>