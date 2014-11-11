<?php
require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');

$jobName = (isset($_GET['jobName']) ? $_GET['jobName'] : "");
$job = $jenkins->getJob($jobName);

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
                 <div class="box ' . $color . ' height_small title_big">
                    <div class="btn-toolbar pull-right" ><div class="btn-group"><a href="" class="btn stop" title="Stop this build" style="padding: 4px !important; background: transparent;"><img src="wp-content/themes/monitor/img/lbremove.png"></a></div></div>
                    <div style="width: '.$currentBuildProgress. '%; height: 100%; background: #8fcf01;">
                        <div class="title">
                            <h5 style="padding: 5px 0 5px 20px"><a class="center" href="' . $currentBuildUrl . '"> ' . $currentBuildNumber . '</a></h5>
                        </div>
                    </div>
                </div>
              </div>';
    } else {
        echo '<div class="span2">
                <div class="box ' . $color . ' height_small title_big">
                   <div class="title">
                     <h5 style="padding: 7px 0 5px 35px"><a class="center" href="' . $currentBuildUrl . '"> ' . $currentBuildNumber . '</a></h5>
                   </div>
                </div>
             </div> ';
    }
};