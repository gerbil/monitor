<?php
require_once('Autoload.php');
Jenkins_Autoloader::register();
$jenkins = new Jenkins('prov:providentprovident@rig-provident.tele2.net:8080');
$jobName = (isset($_GET['jobName']) ? $_GET['jobName'] : "");
$job = $jenkins->getJob($jobName);
?>
<div class="title row-fluid">
    <h5 class="pull-left">
        <span><?php echo '<a href="' . $job->getUrl() . '">' . $job->getName() . '</a>'; ?></span>
    </h5>
    <h5 class="pull-left" style="padding-top:45px;">
        <span><?php echo $job->getHealthReportDesc(); ?></span>
    </h5>
    <h5 class="pull-left" style="padding-top:85px;">
        <span>Latest build: <?php echo '<a href="' . $job->getLatestBuild()->url . '">' . $job->getLatestBuild()->number . '</a>'; ?></span>
    </h5>

    <div class="btn-toolbar pull-right ">
        <div class="btn-group">
            <div id="jenkinsMobileBuildControl">
               <?php echo '<a href="" class="btn start" name="' . $job->getName() . '" title="Start a new build" style="padding: 56px !important;"><img src="wp-content/themes/monitor/img/lbadd.png"></a>'; ?>
            </div>
        </div>
    </div>
</div>