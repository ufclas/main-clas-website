<?php
/*
 * Template Name: CLAS Website Home Page
 * Template Post Type: page
 */
get_header();
?>

<main id="clas-main">
	<?php
	//Gets settings from the customizer

	$slider_category = get_theme_mod('featured_category', 0);
	$slider_number_of_posts = get_theme_mod('number_of_posts_to_show', 5);
	$slider_style = get_theme_mod('featured_style', 'slider-dark');

	$slider_query = new WP_Query(array(
		'cat' => $slider_category,
		'posts_per_page' => $slider_number_of_posts,
	));

	if ( $slider_query->have_posts() ):

		// Get slider speed and convert it to miliseconds
		$slider_speed = get_theme_mod('featured_speed', 7);
		$slider_speed = $slider_speed * 1000;
		$slider_disable_link = get_theme_mod('featured_disable_link', 0);
	?>
	<main class="carousel-row" aria-label="Featured Storie Carousel">
		<div class="carousel-wrap">
			<div id="featured-carousel" class="carousel slide" data-ride="carousel" data-interval="<?php echo $slider_speed; ?>" aria-labelledby="carousel-heading" aria-describedby="carousel-desc">
				<h2 id="carousel-heading" class="sr-only"><?php _e('Featured Posts', 'ufclas-emily'); ?></h2>
				<p id="carousel-desc" class="sr-only"><?php _e('Use the previous and next buttons to change the displayed slide.', 'ufclas-emily'); ?></p>

				<!-- Indicators -->
				<?php if ( $slider_query->post_count > 1 ): ?>
				<ol class="carousel-indicators">
				<?php for( $i=0; $i<$slider_query->post_count; $i++){
				    $slider_class = (0 == $i)? 'active':''; ?>
				    <li data-target="#featured-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $slider_class; ?>"></li>
				<?php } ?>
				</ol>
			<?php endif; ?>

				<div class="carousel-inner row">
					<?php
					while( $slider_query->have_posts() ): $slider_query->the_post();
					$custom_meta = get_post_custom( get_the_ID() );
					$image_type = ( isset($custom_meta['custom_meta_image_type']) )? $custom_meta['custom_meta_image_type'][0]:NULL;
					$slider_first_id = $slider_query->posts[0]->ID;
					$slide_url = esc_url( get_permalink() );
					$slide_thumbnail = ( has_post_thumbnail() )? get_the_post_thumbnail( get_the_ID(), 'half-width-thumb'):'';

					// Slider classes
					$slider_classes = array();
					$slider_classes[] = ( $slider_first_id == get_the_ID() )? 'active':'';
					$slider_classes[] = ( !empty( $slider_style ) )? esc_attr( $slider_style ):'';


					//Full-Size Image Output
					 if ($image_type): ?>
				 <div class="item full-image-feature <?php echo join(' ', $slider_classes); ?>" id="item-<?php the_ID(); ?>">
						<?php if ( has_post_thumbnail() ): ?>
						<div class="slide-image">
						<?php the_post_thumbnail( 'full-width-thumb' ); ?>
						</div>
						<?php endif; ?>

						<div class="carousel-caption">
					    <?php
					    if( !$slider_disable_link ){ // Add link to the title
								the_title( sprintf('<h3><a href="%s">', $slide_url), '</a></h3>' );
								}
								else {
								the_title( '<h3>', '</h3>' );
								}
							?>
					    <p><?php the_excerpt(); ?></p>
						</div>
					</div><!-- .item -->
				<?php else: ?>

				<!-- Half-Width Image Output -->
				<div class="item half-image-feature <?php echo join(' ', $slider_classes); ?>" id="item-<?php the_ID(); ?>">
					<div class="slide-image">
						<?php
							if( !$slider_disable_link ){ // Add link to the image and title
							echo '<a href="' . $slide_url . '">' . $slide_thumbnail . '</a>';
							}
							else{
							echo $slide_thumbnail;
							}
						?>
					</div>

					<div class="carousel-caption">
					  <?php
							if( !$slider_disable_link ){ // Add link to the image and title
							the_title( sprintf('<h3><a href="%s">', $slide_url), '</a></h3>' );
							}
							else{
							the_title( '<h3>', '</h3>' );
							}
						?>
					    <p><?php the_excerpt(); ?></p>
					</div>
				</div><!-- .item -->
				<?php endif; ?>

				<?php endwhile; ?>
			</div><!-- .carousel-inner -->

			<?php if ( $slider_query->post_count > 1 ): ?>
				<a class="left carousel-control" href="#featured-carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only"><?php _e( 'Previous', 'ufclas-emily' ); ?></span>
				</a>
				<a class="right carousel-control" href="#featured-carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only"><?php _e( 'Next', 'ufclas-emily' ); ?></span>
				</a>
			<?php endif; ?>

			</div><!-- .carousel -->
		</div><!-- .carousel-wrap -->
	</main><!-- .carousel-row -->
	<?php
	endif;

	// Restore original post data
	wp_reset_postdata();
	?>

	<section class="link-container">
		<h2>Your Journey Begins Here</h2>
		<div class="container">
			<?php
				if(have_posts()){
					while(have_posts()){
						the_post();

						the_content();
					}
				}
			?>
		</div><!-- container -->
	</section>

	<section class="news-spotlight">
		<?php dynamic_sidebar('CLAS News Spotlight'); ?>
	</section>

	<section class="news-events">
		<div class="row">
			<div class="col-md-6">
				<h3>In The News</h3>
				<div class="container">
					<?php dynamic_sidebar('CLAS News Feed'); ?>
				</div>
			</div>

			<div class="col-md-6">
				<h3>Upcoming Events</h3>
				<div class="container">
					<?php dynamic_sidebar('CLAS Events'); ?>
				</div>
			</div>
		</div>
	</section>

	<section class="other-information">
		<?php dynamic_sidebar('CLAS Bottom Blocks'); ?>
	</section>
</main>

<?php
	get_footer();
?>
