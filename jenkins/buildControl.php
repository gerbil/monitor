<?php

require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');
$jobName = (isset($_POST['jobName']) ? $_POST['jobName'] : "");
$job = $jenkins->getJob($jobName);
$jobLatestBuildNumber = $job->getLatestBuild()->number;

if ($_POST['command'] == 'start') {
    echo $jenkins->launchJob($jobName);
} else if ($_POST['command'] == 'stop') {
    echo $jenkins->getBuild($jobName, $jobLatestBuildNumber)->stopBuild($jobName, $jobLatestBuildNumber);
};