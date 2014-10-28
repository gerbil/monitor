<?php
/*
  Template Name: Journal
 */
?>

<?php get_header(); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box gradient color_24">
            <div class="title row-fluid">
                <h4 class="pull-left"><span>Journal</span></h4>
            </div>
            <div class="content">
                <?php echo do_shortcode('[ideas id="modal-1" mode="inline" visibility="1" default_type="journal" sections="ololo"]'); ?>
            </div>
        </div>
    </div>
</div>
        
<?php get_footer(); ?>