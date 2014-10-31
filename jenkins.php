<?php
/*
Template Name: Jenkins
*/
?>

<?php get_header(); ?>

    <div id="main_container" class="jenkins">
        <div class="row-fluid">
            <div class="span14 ">
                <div class="box color_11 title_big height_big production">
                    <!-- Main title -->
                    <div class="title">
                        <div class="row-fluid">
                            <div class="span12">
                                <h4><span>Production</span></h4>
                                <h4 style="padding-top:85px;"><span>jenkins tests</span></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job name, status and latest build -->
                    <div class="span7" style="float:right;">
                        <div class="row-fluid fluid">
                            <div class="span14">
                                <div class="box color_26 height_medium title_big job"></div>
                            </div>
                            <!-- Latest build logs -->
                            <div class="row-fluid fluid">
                                <div class="span14">
                                    <div class="box height_bigtitle_big logs" ></div>
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

<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/job.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/autoRefresh.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="./wp-content/themes/monitor/jenkins/js/init.js"></script>