<?php
/*
 * Template Name: CLAS Website Home Page
 * Template Post Type: page
 */
get_header();
?>

<main>
	<?php
		//Slider. Function is located
		homeChooseHeaderMedia();
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
			<div class="col-sm-6">
				<h3>In The News</h3>
				<div class="container">
					<?php dynamic_sidebar('CLAS News Feed'); ?>
				</div>
			</div>

			<div class="col-sm-6">
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
