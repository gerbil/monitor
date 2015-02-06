<?php 
/*
Template Name: Lb
*/
?>

<?php get_header(); ?>

<?php $template_url = get_bloginfo('template_url'); ?>

<div id="main_container">
	<div id="main_container">
      <div class="row-fluid">
        <div class="span12 ">
        <div class="box color_3 title_big height_big" style="height:460px;padding:5px;">
          <div class="title">
            <div class="row-fluid">
              <div class="span12">
                <h4> <span>Production</span> </h4>
				<h4 style="padding-top:85px;"> <span>Load balancer</span> </h4>
              </div>
              <!-- End .span12 --> 
            </div>
            <!-- End .row-fluid --> 
            
          </div>
		  
          <!-- End .title -->
          <div>
            <div class="span6" style="float:right;">
			
				<div class="row-fluid fluid">
					<div class="span6">
					  <div class="box color_26 height_medium title_big">
						<div class="title row-fluid">
							<h5 class="pull-left"><span>avk6</span></h5>
							<h5 class="pull-left" style="padding-top:45px;"><span>control</span></h5>
							  <div class="btn-toolbar pull-right ">
								<div class="btn-group"><div id="avk6-provident-f1"></div></div>
							  </div>
						  <!-- End .row-fluid --> 
						</div>
					  </div>
					</div>
					<!-- End .span6 -->
					<div class="span6">
					  <div class="box color_25 height_medium title_big">
						<div class="title row-fluid">
							<h5 class="pull-left"><span>hgd01</span></h5>
							<h5 class="pull-left" style="padding-top:45px;"><span>control</span></h5>
							  <div class="btn-toolbar pull-right ">
								<div class="btn-group"><div id="hgd0-provident-f1"></div></div>
							  </div>
						  <!-- End .row-fluid --> 
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
							<h5 class="pull-left"><span>hgd02</span></h5>
							<h5 class="pull-left" style="padding-top:45px;"><span>control</span></h5>
							  <div class="btn-toolbar pull-right ">
								<div class="btn-group"><div id="hgd0-provident-f2"></div></div>
							  </div>
						  <!-- End .row-fluid --> 
						</div>
					  </div>
					</div>
                </div>
				
				 <div class="row-fluid fluid">
					<div class="span6">
					  <div class=" box color_23_1 height_medium title_big">
						<div class="title row-fluid">
							<h5 class="pull-left"><span>hgdf1</span></h5>
							<h5 class="pull-left" style="padding-top:45px;"><span>control</span></h5>
							  <div class="btn-toolbar pull-right ">
								<div class="btn-group"><div id="hgd1-other"></div></div>
							  </div>
						  <!-- End .row-fluid --> 
						</div>
					  </div>
					</div>
					<div class="span6">
					  <div class=" box color_22 height_medium title_big ">
						<div class="title row-fluid">
							<h5 class="pull-left"><span>kstf1</span></h5>
							<h5 class="pull-left" style="padding-top:45px;"><span>control</span></h5>
							  <div class="btn-toolbar pull-right ">
								<div class="btn-group"><div id="kst1-other"></div></div>
							  </div>
						  <!-- End .row-fluid --> 
						</div>              
				  </div>
				</div>
				<!-- End .box .span6-->
        
                </div>
				
                </div>
                </div>
              </div>
            </div>            
          </div>
</div>
</div>             

<!-- Js plugins Init -->
<script src="<?php bloginfo('template_url'); ?>/js/lb.js"></script>

<?php get_sidebar(); ?>

<?php get_footer(); ?>