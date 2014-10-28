<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?> 
<!-- Js init -->
<script src="<?php bloginfo('template_url'); ?>/js/sidebar.js"></script>

      <div class="row-fluid">
        <!--<div class="span6">
          <div class="box gradient color_25 height_xbig">
            <div class="title row-fluid">
              <h4 class="pull-left"><span>Task List</span></h4>
              <div class="btn-toolbar pull-right ">
                <div class="btn-group"> <a class="btn">Add New +</a></div>
              </div>
            </div>            
			<?php echo do_shortcode('[todochecklist priority=1 assigned=1 deadline=1 progress=1 addedby=1 date=1 editlink=1]'); ?>
          </div>
        </div>
		-->
		
			<div class="span12">
			  <div class="box gradient color_24">
				<div class="title row-fluid">
				  <h4 class="pull-left"><span>Ideas</span></h4>
				</div>
				<div class="content">
				  <?php echo do_shortcode('[ideas id="modal-1" mode="inline" visibility="1"]'); ?>
				</div>
			  </div>
			</div>
		<!--
        <div class="span6">
          <div class="box color_2 ">
            <div class="title row-fluid">
              <h4 class="pull-left"><span>Messages</span></h4>
              <div class="btn-toolbar pull-right ">
                <div class="btn-group"> <a class="btn">View All</a></div>
              </div>
            </div>
            <div class="content row-fluid">
			
				<?php /* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_activity_loop() */ ?>

				<?php do_action( 'bp_before_activity_loop' ) ?>

				<?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ) ) ) : ?>

					<?php if ( empty( $_POST['page'] ) ) : ?>
						<ul class="messages_layout">
					<?php endif; ?>

					<?php $activity_li_class = 'from_user left'; ?>
					<?php while ( bp_activities() ) : bp_the_activity(); ?>
					<?php $activity_li_class = ($activity_li_class == 'from_user left') ? 'by_myself right' : 'from_user left'; ?>	
					<?php $user_displayname = bp_core_get_user_displayname( $GLOBALS['activities_template']->activity->user_id ); ?>			
					<?php $user_username = bp_members_get_user_nicename($GLOBALS['activities_template']->activity->user_id); ?>	
							
					<li class="<?=$activity_li_class;?>"> <a class="avatar" href="<?php bp_activity_user_link() ?>"><?php bp_activity_avatar( 'type=thumb&width=50&height=50' ) ?></a>
					  <div class="message_wrap"> <span class="arrow"></span>
						<div class="info"> <a href="<?php bp_activity_user_link() ?>" title="<?php _e( 'Go to '.$user_displayname. '\'s member page.', 'buddypress' ); ?>"><?php echo $user_username; ?></a> <span class="author"><a href="<?php bp_activity_user_link() ?>" title="<?php _e( 'Go to '.$user_displayname. '\'s member page.', 'buddypress' ); ?>">@<?php echo $user_displayname; ?></a></span></div>
						<div class="text" style="width:100%"><?php bp_activity_content_body() ?></div>
						<div class="footer">
							<span class="time"><?php echo bp_core_time_since( bp_get_activity_date_recorded() ); ?></span>
							<div class="actions pull-right hidden-phone">
							  <ul class="pull-right">
								<li>
								<?php if ( is_user_logged_in() && bp_activity_can_comment() ) : ?>
								<a href="<?php bp_get_activity_comment_link() ?>" class="button acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id() ?>"><i class=" gicon-share-alt icon-white"></i>Reply</a> (<span><?php bp_activity_comment_count() ?></span>)</a>
								<?php endif; ?>
								</li>
								<li><a href="#"><i class=" gicon-share icon-white"></i>Share</a></li>
								<li>
								<?php if ( is_user_logged_in() ) : ?>
									<?php if ( !bp_get_activity_is_favorite() ) : ?>
									<a href="<?php bp_activity_favorite_link(); ?>" class="button fav bp-secondary-action" title="<?php esc_attr_e( 'Mark as Favorite', 'buddypress' ); ?>"><i class=" gicon-star icon-white"></i>Favorite</a></a>
									<?php else : ?>
									<a href="<?php bp_activity_unfavorite_link(); ?>" class="button unfav bp-secondary-action" title="<?php esc_attr_e( 'Remove Favorite', 'buddypress' ); ?>"><i class=" gicon-star icon-white"></i>Remove favorite</a></a>
									<?php endif; ?>
								<?php endif;?>						
								</li>
								<div class="activity-meta item-meta activity-header-info">
								</div>		
							  </ul>
							</div>
						</div>
					  </div>
					</li>						

					<?php endwhile; ?>

					<?php if ( bp_get_activity_count() == bp_get_activity_per_page() && $GLOBALS['bpLoadMore'] != 'hide' ) : ?>
						<li class="load-more">
							<a href="#more"><?php _e( 'Load More', 'buddypress' ) ?></a> &nbsp; <span class="ajax-loader"></span>
						</li>
					<?php endif; ?>

					<?php if ( empty( $_POST['page'] ) ) : ?>
						</ul>
					<?php endif; ?>

				<?php else : ?>
					<div id="message" class="messageBox note icon">
						<span><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ) ?></span>
					</div>
				<?php endif; ?>

				<?php do_action( 'bp_after_activity_loop' ) ?>

				<form action="#" name="activity-loop-form" id="activity-loop-form" method="post">
					<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ) ?>
				</form>

				<script type="text/javascript">
				/* Fix for BP default "load more" */
				if (jq) {

					// remove the default BP click event
					jq('ul.activity-list li.load-more a').unbind('click'); 
					// Assign a new click behavior for 'load more' (again, necessary because of dumb references to containers like "#content")
					jq('ul.activity-list li.load-more a').click(function() {
						$parent = jq(this).parent('li.load-more');
						$parent.addClass('loading');

						if ( null == jq.cookie('bp-activity-oldestpage') )
							jq.cookie('bp-activity-oldestpage', 1, {path: '/'} );
					
						var oldest_page = ( jq.cookie('bp-activity-oldestpage') * 1 ) + 1;
					
						jq.post( ajaxurl, {
							action: 'activity_get_older_updates',
							'cookie': encodeURIComponent(document.cookie),
							'page': oldest_page
						},
						function(response) {
							$parent.removeClass('loading');
							jq.cookie( 'bp-activity-oldestpage', oldest_page, {path: '/'} );
							jq("div.activity ul.activity-list").append(response.contents);
					
							$parent.hide();
						}, 'json' );
						
						return false;
					});
				}
				</script>


            </div>
          </div>
        </div> -->       
      </div>
	  
<!--
	    <div class="row-fluid">

			<div class="span6">
			  <div class="box gradient color_light">
				<div class="title row-fluid">
				  <h4 class="pull-left"><span>Next release [<script type="text/javascript">document.write(release)</script>]</span></h4>
				</div>
					<div class="content">
						 <div id="counter"></div>
						  <div class="desc">
							<div>Days</div>
							<div>Hours</div>
							<div>Minutes</div>
							<div>Seconds</div>
						  </div>
						  <br/>
					</div>
				</div>
			 </div>

		</div>			
		--> 
		 <!--<div class="span6">
			 <div class="box gradient color_light">
				<div class="title row-fluid">
				  <h4 class="pull-left"><span>Next release [<script type="text/javascript">document.write(release)</script>]</span></h4>
				</div>
					<div class="content">
						 <div id="counter"></div>
						  <div class="desc">
							<div>Days</div>
							<div>Hours</div>
							<div>Minutes</div>
							<div>Seconds</div>
						  </div>
						  <br/>
					</div>
				</div>
			 </div>
		
		<div class="span6">
			  <div class="box gradient color_light">
				<div class="title row-fluid">
				  <h4 class="pull-left"><span>Next release [<script type="text/javascript">document.write(release)</script>]</span></h4>
				</div>
					<div class="content">
						 <?php $args = array(
							'cal_id'                => 1,
							'month_incre'           => 0,
							'event_count'           => 3,
							'show_upcoming'         => 1,
							'number_of_months'      => 2
					); 
						if( function_exists('add_eventon')) {
							add_eventon($args); 
					};										
					?>
					</div>
				</div>
			 </div>-->
<?php } ?>