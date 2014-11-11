<?php
/*
Template Name: Jenkins
*/
?>

<?php get_header(); ?>

<div id="main_container" class="jenkins">
    <div class="row-fluid">
        <div class="span14">
            <div class="box color_11 title_big height_big production">
                <!-- Main title -->
                <div class="title">
                    <div class="row-fluid">
                        <div class="span12">
                            <h4><span>Production</span></h4>
                            <h4 style="padding-top:85px;"><span>jenkins tests</span></h4>
                        </div>
                    </div>

                    <div class="menuTests">
                        <div class="span6 MobileAll">
                            <div class="box color12 height_small title_big">
                                <h5><a class="link active" href="#">ALL</a></h5>
                            </div>
                        </div>

                        <div class="span6 MobileLV">
                            <div class="box color12 height_small title_big">
                                <h5><a class="link" href="#">Latvia</a></h5>
                            </div>
                        </div>

                        <div class="span6 MobileCRO">
                            <div class="box color12 height_small title_big">
                                <h5><a class="link" href="#">Croatia</a></h5>
                            </div>
                        </div>

                        <div class="span6 MobileNL">
                            <div class="box color12 height_small title_big">
                                <h5><a class="link" href="#">Netherlands</a></h5>
                            </div>
                        </div>
                    </div>


                </div>


                <!-- Job name, status and latest build for Mobile provisioning ALL -->
                <div class="span7" style="float:right;" id="MobileAll">
                    <div class="row-fluid fluid">
                        <div class="span14">
                            <div class="box color_26 height_medium title_big job"></div>
                        </div>
                        <!-- Latest build logs -->
                        <div class="row-fluid fluid">
                            <div class="span14">
                                <div class="box height_bigtitle_big logs"></div>
                            </div>
                        </div>
                        <!-- Latest builds -->
                        <div class="jobsList"></div>
                    </div>
                </div>

                <!-- Job name, status and latest build for Mobile provisioning LV -->
                <div class="span7" style="float:right;" id="MobileLV">
                    <div class="row-fluid fluid">
                        <div class="span14">
                            <div class="box color_26 height_medium title_big job"></div>
                        </div>
                        <!-- Latest build logs -->
                        <div class="row-fluid fluid">
                            <div class="span14">
                                <div class="box height_bigtitle_big logs"></div>
                            </div>
                        </div>
                        <!-- Latest builds -->
                        <div class="jobsList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>

<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/buildControl.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/autoRefresh.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/menuTests.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/init.js"></script>