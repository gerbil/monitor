<?php 
/*
Template Name: Alarms
*/
?>

<?php get_header(); ?>

<!-- Js init -->
<script src="<?php bloginfo('template_url'); ?>/js/alarms.js"></script>

<div id="main_container">
	<div class="row-fluid">		
		<div class="span6 ">
			<div class="box color_26 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>AVK6B1</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="avk6b1"></div>
					</div> 
				</div>
			</div>
		</div> 	
		<div class="span6 ">
			<div class="box color_25 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>HGD0B1</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="hgd0b1"></div>
					</div> 
				</div>
			</div>
		</div> 
	</div>
	
	<div class="row-fluid">		
		<div class="span6 ">
			<div class="box color_2 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>HGD0B2</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="hgd0b2"></div>
					</div> 
				</div>
			</div>			
		</div>
		<div class="span6 ">
			<div class="box color_3 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
							<h4> <span>ACTIVEVOS</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="avos"></div>			
					</div>   										
				</div>
			</div>			
		</div>		
	</div>
	
	<div class="row-fluid">	
		<div class="span6 ">
			<div class="box color_22 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
							<h4> <span>KSTB1</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="kstb1"></div>			
					</div>   										
				</div>
			</div>			
		</div> 
		<div class="span6 ">
			<div class="box color_23_1 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>HGDB1</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="hgdb1"></div>
					</div>
				</div>
			</div> 		
		</div>
	</div>
	
	<div class="row-fluid">	
		<div class="span6 ">
			<div class="box color_23 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
							<h4> <span>F-MOBILE</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="f-mobile"></div>			
					</div>   										
				</div>
			</div>			
		</div> 
		<div class="span6 ">
			<div class="box color_23 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
							<h4> <span>F-OTHER</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="f-other"></div>			
					</div>   										
				</div>
			</div>			
		</div> 
	</div>
	
	
	<div class="row-fluid">	
		<div class="span6 ">
			<div class="box color_26 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>TEST</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="test"></div>
					</div>
				</div>
			</div> 		
		</div>
		<div class="span6 ">
			<div class="box color_20 title_big fill">
				<div class="title">
					<div class="row-fluid">
						<div class="span12">
						<h4> <span>ACTIVOS TEST</span> </h4>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row-fluid"> 
						<div id="avostest"></div>
					</div>
				</div>
			</div> 		
		</div>
	</div>
	
</div>

<div id="info-alarm" class="reveal-modal"><a class="close-reveal-modal">&#215;</a></div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>