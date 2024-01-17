<?php
// Template name: Home
get_header(); ?>
<?php $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
<section class="main_banner" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat center; ">
    <div class="ast-container">
        <h1>
            <?php echo get_field('title') ?>
        </h1>
        <h4>
            <?php echo get_field('description') ?>
        </h4>
    </div>
</section>
<section class="jobs_list">
    <div class="ast-container">
        <?php echo do_shortcode('[jobs]'); ?>
    </div>
</section>
<?php get_footer(); ?>