<?php
/* Template name: english-page */
/* Copy of GP page.php to display English version of blog */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
/* Slug of current page */
$slug = $_GET['slug'];
$page_post = get_page_by_path($slug);
$pageid = $page_post->ID;
/*
 echo 'Referer = ' . $referer;
 echo 'Path = ' . $path;
 echo 'Slug = ' . $slug;
 echo 'Pageid = ' . $pageid;
*/ 
?>

	<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			while ( have_posts() ) : the_post();
				/* Comment the following 2 lines and replace with custom code */			
				/* get_template_part( 'content', 'page' ); */
				?>
				<div class="english-link">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$val = get_the_title($pageid); ?>
				<h2><?php echo $val; ?></h2>
				<?php 
				$val = get_page($pageid);
				$val = $val->post_content;
				echo nl2br($val); 
				// Shortcode to generate form
				$shortcode = get_post_meta($pageid, 'english_shortcode', true);
				echo do_shortcode($shortcode); ?>
				</article>
				</div>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) : ?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

				<?php endif;

			endwhile;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

get_footer();
