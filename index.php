<?php
/*
Theme Name: Monitor
*/
?>


<?php get_header(); ?>

<!-- Js plugins Init -->
<script src="<?php bloginfo('template_url'); ?>/js/index.js"></script>

<?php 

$avk6b1Status = 1;
$hgd0b1Status = 1;
$hgd0b2Status = 1;
$testStatus = 1;

?>
	
<?php $template_url = get_bloginfo('template_url'); ?>

    <div id="main_container">
      <div class="row-fluid">
        <div class="span6 ">
        <div class="box color_3 title_big height_big">
          <div class="title">
            <div class="row-fluid">
              <div class="span12">
                <h4> <span>Production</span> </h4>
              </div>
              <!-- End .span12 --> 
            </div>
            <!-- End .row-fluid --> 
            
          </div>
          <!-- End .title -->
          <div class="content" style="padding-top:35px;">
            <div id="prod_graph" style="width:100%;height:240px;"> </div>
          </div>
          </div>
        </div>
        <!-- End .box .span6-->
        <div class="span6">
          <div class="row-fluid fluid">
            <div class="span6">
              <div class="box color_26 height_medium title_big">
                <div class="title row-fluid">
					<h5 class="pull-left"><span>avk6b1</span></h5>
					  <div class="btn-toolbar pull-right ">
						<div class="btn-group"><div id="avk6-provident-f1"></div></div>
					  </div>
                  <!-- End .row-fluid --> 
                </div>
                <!-- End .title -->
                <div class="content" style="padding-top:28px;">
                  <div id="avk6b1_graph" style="width:100%;height:85px;"></div>
                  <div class="row-fluid description">
                    <div class="pull-left">LAST <script type="text/javascript">document.write((interval_cluster-120)*60)</script> SEC</div>
                    <div class="pull-right">NOW</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .span6 -->
            <div class="span6">
              <div class="box color_25 height_medium title_big">
                <div class="title row-fluid">
					<h5 class="pull-left"><span>hgd0b1</span></h5>
					  <div class="btn-toolbar pull-right ">
						<div class="btn-group"><div id="hgd0-provident-f1"></div></div>
					  </div>
                  <!-- End .row-fluid --> 
                </div>
                <!-- End .title -->
                <div class="content" style="padding-top:28px;">
                  <div id="hgd0b1_graph" style="width:100%;height:85px;"></div>
                  <div class="row-fluid description">
                    <div class="pull-left">LAST <script type="text/javascript">document.write((interval_cluster-120)*60)</script> SEC</div>
                    <div class="pull-right">NOW</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .span6 --> 
          </div>
          <!-- End .row-fluid -->
          <div class="row-fluid fluid">
            <div class="span6">
              <div class=" box color_2 height_medium title_big">
                <div class="title row-fluid">
					<h5 class="pull-left"><span>hgd0b2</span></h5>
					  <div class="btn-toolbar pull-right ">
						<div class="btn-group"><div id="hgd0-provident-f2"></div></div>
					  </div>
                  <!-- End .row-fluid --> 
                </div>
                <!-- End .title -->
                <div class="content" style="padding-top:28px;">
                  <div id="hgd0b2_graph" style="width:100%;height:85px;"></div>
                  <div class="row-fluid description">
                    <div class="pull-left">LAST <script type="text/javascript">document.write((interval_cluster-120)*60)</script> SEC</div>
                    <div class="pull-right">NOW</div>
                  </div>
                </div>
              </div>
            </div>
			<div class="span6">
              <div class=" box color_22 height_medium title_big ">
                <div class="title row-fluid">
					<h5 class="pull-left"><span>kstb1</span></h5>
					  <div class="btn-toolbar pull-right ">
						<div class="btn-group"><div id="avk6-provident-f2"></div></div>
					  </div>
                  <!-- End .row-fluid --> 
                </div>              
                <div class="content" style="padding-top:28px;">
                  <div id="kstb1_graph" style="width:100%;height:85px;"></div>
                  <div class="row-fluid description">
                    <div class="pull-left">LAST <script type="text/javascript">document.write((interval_cluster-120)*60)</script> SEC</div>
                    <div class="pull-right">NOW</div>
                  </div>
                </div>
                </div>
                </div>
              </div>
            </div>            
          </div>
            <!--
            <div class="span6">
              <div class=" box color_26 height_medium title_big ">
                <div class="title">
                  <div class="row-fluid">
                    <div class="span12">
                      <h5> </i><span>test</span> </h5>
                    </div>                    
                  </div>                  
                </div>                
                <div class="content" style="padding-top:28px;">
                  <div id="test_graph" style="width:100%;height:85px;"></div>
                  <div class="row-fluid description">
                    <div class="pull-left">LAST <script type="text/javascript">document.write((interval_test-120)/60)</script> HOURS</div>
                    <div class="pull-right">NOW</div>
                  </div>
                </div>
                </div>
                </div>
              </div>
            </div>            
          </div>
          --> 

	  
      <div class="row-fluid">
        <div class="row-fluid box color_2 title_medium height_medium2 bar_stats ">
          <div class="title hidden-phone">
            <h5><span>CLUSTER</span></h5>
          </div>
          <!-- End .title -->
          <div class="content row-fluid fluid numbers">
            <div class="span3 stats hidden-phone">
              <div id="cluster_platform" style="width:100%;height:65px;margin-top:7px"></div>
            </div>
            <div class="span2 average_ctr">
              <h1 class="value">99.8<span class="percent">%</span></h1>
              <div class="description mt15" >AVERAGE UPTIME</div>
            </div>
            <div class="span3 shown_left">  
                <div class="span6">
                  <div class="description">SUCCESS (<script type="text/javascript">document.write(data_cluster_transactions_mob_success)</script>)</div>
                  <h2 class="value"><script type="text/javascript">document.write(data_cluster_transactions_success)</script></h2>
                </div>
                <div class="span6 full">
                  <div class="description text_color_dark">FAILED (<script type="text/javascript">document.write(data_cluster_transactions_mob_failed)</script>)</div>
                  <h2 class="value text_color_dark"><script type="text/javascript">document.write(data_cluster_transactions_failed)</script></h2>			
				</div>	
				<div class="description" >ORDERS STATES STATS</div>
				<div class="row-fluid fluid">
					<div class="progress small">
					<script type='text/javascript'>document.write('<div class="bar white" style="width:'+data_cluster_percent+'%" title="'+Math.floor(data_cluster_percent)+'%"></div>')</script>
				</div>	
              </div>
            </div>
            <div class="span3 total_days">
              <div class="row-fluid">
                <div class="span6 total_clicks">
                  <h1 class="value"><script type="text/javascript">document.write(data_cluster_transactions_full)</script></h1>
                  <div class="description mt15" >TOTAL ORDERS TODAY</div>
                </div>
				<div class="span6 days_left">
                  <h1 class="value text_color_dark"><script type="text/javascript">document.write(daysLeft)</script></h1>
                  <div class="description mt15" >DAYS UNTILL RELEASE</div>
                </div>
              </div>
            </div>
            <div class="span1 stick top right result height_medium2"> <?php if ($avk6b1Status && $hgd0b1Status && $hgd0b2Status) { echo "<img src='".$template_url."/img/arrows_up.png'><div class='description mt15' >Good</div>"; } else {  echo "<img src='".$template_url."/img/arrows_down.png'><div class='description mt15' >Bad</div>"; }; ?></div>
          </div>
          <!-- End .row-fluid --> 
          <!-- End .content --> 
        </div>
        <!-- End .box --> 
        
      </div>
      <!-- End .row-fluid -->
      
      <div class="row-fluid">
        <div class="row-fluid box color_26 title_medium height_medium2 bar_stats ">
          <div class="title hidden-phone">
            <h5><span>test</span></h5>
          </div>
          <!-- End .title -->
          <div class="content row-fluid fluid numbers">
            <div class="span3 stats hidden-phone">
              <div id="test_platform" style="width:100%;height:65px;margin-top:7px"></div>
            </div>
            <div class="span2 average_ctr">
              <h1 class="value">99.8<span class="percent">%</span></h1>
              <div class="description mt15" >AVERAGE UPTIME</div>
            </div>
            <div class="span3 shown_left">  
                <div class="span6">
                  <div class="description">SUCCESS</div>
                  <h2 class="value"><script type="text/javascript">document.write(data_test_transactions_success)</script></h2>                
                </div>
                <div class="span6 full">
                  <div class="description text_color_dark">FAILED</div>
                  <h2 class="value text_color_dark"><script type="text/javascript">document.write(data_test_transactions_failed)</script></h2>			
				</div>	
				<div class="description" >ORDERS STATES STATS</div>
				<div class="row-fluid fluid">
					<div class="progress small"> 
					<script type='text/javascript'>document.write('<div class="bar white" style="width:'+data_test_percent+'%" title="'+Math.floor(data_test_percent)+'%"></div>')</script>
				</div>	
              </div>
            </div>
            <div class="span3 total_days">
              <div class="row-fluid">
                <div class="span6 total_clicks">
                  <h1 class="value"><script type="text/javascript">document.write(data_test_transactions_full)</script></h1>
                  <div class="description mt15" >TOTAL ORDERS TODAY</div>
                </div>
				<div class="span6 days_left">
                  <h1 class="value text_color_dark"><script type="text/javascript">document.write(daysLeft)</script></h1>
                  <div class="description mt15" >DAYS UNTILL RELEASE</div>
                </div>
              </div>
            </div>
			<div class="span1 stick top right result height_medium2"> <?php if ($testStatus) { echo "<img src='".$template_url."/img/arrows_up.png'><div class='description mt15' >Good</div>"; } else {  echo "<img src='".$template_url."/img/arrows_down.png'><div class='description mt15' >Bad</div>"; }; ?></div>
          </div>
          <!-- End .row-fluid --> 
          <!-- End .content --> 
        </div>
        <!-- End .box --> 
        
      </div>
      <!-- End .row-fluid -->
	  
	  
<?php get_sidebar(); ?>
 
    </div>
    <!-- End #container --> 
  </div>

<?php get_footer(); ?>