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
  <div class="container">
    <?php
      if(have_posts()){
        while(have_posts()){
          the_post();

          the_content();
        }
      }
    ?>
  </div>
</main>

<?php
	get_footer();
?>
