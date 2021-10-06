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

<main id="clas-interior">
  <section class="link-container">
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
</main>

<?php
	get_footer();
?>
