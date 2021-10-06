<?php
/*
 * Template Name: CLAS Website Interior Pages
 * Template Post Type: page
 */

 get_header();
?>

<?php
	/*
	 * Uses the Featured Image as a hero image
	 */
	clasHeroImage();
?>

<main id="clas-home">
  <section class="link-container">
    <div class="container">
      <?php
        if(have_posts()){
          while(have_posts()){?>
            <?php the_title( '<h2 class="entry-title-interior"><span class="interior-h2">', '</span></h2>' ); ?>
            <?php
            the_post();
            the_content();
          }
        }
      ?>
    </div><!-- container -->
  </section>
</main>

<?php
	get_footer();
?>
