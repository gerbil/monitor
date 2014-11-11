<?php
require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');

$jobName = (isset($_GET['jobName']) ? $_GET['jobName'] : "");
$job = $jenkins->getJob($jobName);

$logs = $job->getLogs($job->getLatestBuild()->number);
$logsArray = preg_split("/\\r\\n|\\r|\\n/", $logs);

for ($i = 0; $i <= sizeof($logsArray); $i++) {
    echo $logsArray[$i] . '<br/>';
}
