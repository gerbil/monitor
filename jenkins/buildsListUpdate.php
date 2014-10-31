<?php
require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');
$job = $jenkins->getJob("Mobile%20provisioning");

for ($i = 0; $i <= 5; $i++) {
    $jobBuilds = $job->getBuilds();
    $currentBuildNumber = $jobBuilds[$i]->number;
    $currentBuild = $jenkins->getBuild($job->getName(), $currentBuildNumber);
    $currentBuildResult = $currentBuild->getResult();
    $currentBuildUrl = $currentBuild->getUrl();
    $currentBuildProgress = $currentBuild->getProgress();
    if ($currentBuildResult == "SUCCESS") {
        $status = 'success';
        $color = 'color_21';
    } elseif ($currentBuildResult == "RUNNING") {
        $status = 'inProgress';
        $color = 'color_0';
    } else {
        $status = 'fail';
        $color = 'color_25';
    }

    if ($status == 'inProgress') {
        echo '<div class="span2">
                <div class="box height_small title_big" style="width: 150px;">
                    <div style="width:' . $currentBuildProgress . '%; background: #fff;">
                       <div class="title">
                            <h5 style="margin: 5px 0 0 30px"><a class="center" href="' . $currentBuildUrl . '"> ' . $currentBuildNumber . '</a></h5>
                        </div>
                    </div>
                    <div class="btn-toolbar pull-right" ><div class="btn-group"><a href="" class="btn stop" title="Stop this build" style="padding: 4px !important; background: #6a6a6a;"><img src="wp-content/themes/monitor/img/lbremove.png"></a></div></div>
                </div>
             </div>';
    } else {
        echo '<div class="span2">
                <div class="box ' . $color . ' height_small title_big" style="width: 150px;">
                    <div class="">
                       <div class="title">
                            <h5 style="margin: 5px 0 0 30px"><a class="center" href="' . $currentBuildUrl . '"> ' . $currentBuildNumber . '</a></h5>
                        </div>
                    </div>
                </div>
             </div> ';

    }
};