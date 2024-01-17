<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div class="job_head">
	<div class="ast-container">
		<div class="row">
			<div class="col-12 single_job_listing">
				<div class="d-flex meta">
					<div class="flex-shrink-0 company_logo">
						<?php the_company_logo(); ?>
					</div>
					<div class="flex-grow-1 ms-3">
						<h1 class="job_title_top">
							<?php the_title(); ?>
						</h1>
						<div class=""><img
								src="<?php echo get_stylesheet_directory_uri() . '/assets/images/clock.png'; ?>" /> <?php the_job_publish_date(); ?></div>
						<a href="<?php the_job_permalink(); ?>">
							<div class="company_name">
								<?php the_company_name('<strong>', '</strong> '); ?>
							</div>
						</a>
						<div class="">
							<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/pin.png'; ?>" />
							<?php the_job_location(false); ?>
						</div>
						<?php
						$job_salary = the_job_salary('', '', false);
						if (!empty($job_salary)): ?>
							<div class="salary">Pay
								<?php echo esc_html($job_salary); ?>
							</div>
							<?php
						endif;
						?>
					</div>
				</div>
			</div>
			<div class="col-2">
				<?php if (candidates_can_apply()): ?>
					<?php get_job_manager_template('job-application.php'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="ast-container">
	<?php if (astra_page_layout() == 'left-sidebar'): ?>

		<!-- <?php get_sidebar(); ?> -->

	<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->
	<?php if (astra_page_layout() == 'right-sidebar'): ?>
	<aside id="secondary" class="job_listing_custom_sidebar widgets">
		<h2>More Available Positions</h2>
		<div>
			<?php
			$args = array(
				'posts_per_page' => 5,
				'post_type' => 'job_listing',
				'orderby' => 'rand',
			);
			$latest_posts = new WP_query($args);
			?>
			<ul>
				<?php
				if ($latest_posts->have_posts()) {
					while ($latest_posts->have_posts()) {
						$latest_posts->the_post(); ?>
						<li class="sidebar_jobs">
							<div class="d-flex align-middle">
								<div class="flex-shrink-0 suitcase_logo">
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/suitcase.png'; ?>" />
								</div>
								<div class="flex-grow-1 job_name">
									<h3>
										<?php echo get_the_title(); ?>
									</h3>
									<div class=""><img
											src="<?php echo get_stylesheet_directory_uri() . '/assets/images/pin.png'; ?>" />
										<?php the_job_location(false); ?></div>
								</div>
							</div>
						</li>
					<?php
					}
					wp_reset_postdata();
				} else { ?>
					<div>
						<h3 class="no_blogs_found">No Blogs Found</h3>
					<?php } ?>
			</ul>
		</div>
		<!-- \\\\\\ -->
		<?php
		$args = array(
			'posts_per_page' => 3,
			'post_type' => 'post',
			'orderby' => 'rand',
		);
		$random_posts = new WP_query($args);
		?>
		<div class="side_blogs_para">
			<?php
			if ($random_posts->have_posts()) {
				while ($random_posts->have_posts()) {

					$random_posts->the_post(); ?>
					<div class="sidebar_blogs">
						<div class="flex-grow-1 job_name">
							<h3>
								<a href="<?php echo get_the_permalink(); ?>">
									<?php echo get_the_title(); ?>
								</a>
							</h3>
							<div>
								<?php echo get_the_excerpt(); ?>
							</div>
						</div>
					</div>
				<?php }
				wp_reset_postdata();

			} else { ?>
				<div>
					<h3 class="no_blogs_found">No Blogs Found</h3>
				<?php } ?>
			</div>
		</div>
	</aside>
		<?php endif; ?>
	<?php get_footer(); ?>