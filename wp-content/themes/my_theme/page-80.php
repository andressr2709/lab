<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<?php if (astra_page_layout() == 'left-sidebar'): ?>
	<?php get_sidebar(); ?>
<?php endif ?>
<div id="primary" <?php astra_primary_class(); ?>>
	<?php
	astra_primary_content_top();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Correct way to get the current page
	$args = [
		'post_type' => 'proyecto',
		'posts_per_page' => 10, // Correct key for the number of posts per page
		'paged' => $paged,
	];
	$query = new WP_Query($args);
	?>
	<div>
		<ul>
			<?php
			while ($query->have_posts()) {
				$query->the_post();
				?>
				
					

						<div class="card">
						<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
							<div class="container">
							<h2><?php the_title(); ?></h2>
							</div>
						</div>

						<div>
							
						</div>
					</a>
				
				<?php
			}
			wp_reset_postdata(); // Correct place to reset post data
			?>
		</ul>
		<div>
			<ul>
				<?php
				echo paginate_links(
					array(
						'total' => $query->max_num_pages,
						'current' => $paged,
						'format' => '?paged=%#%', // Correct format for pagination
					)
				);
				?>
			</ul>
		</div>
	</div>
	<?php
	astra_primary_content_bottom();
	?>
</div><!-- #primary -->
<?php
if (astra_page_layout() == 'right-sidebar'):
	get_sidebar();
endif;

get_footer();
?>