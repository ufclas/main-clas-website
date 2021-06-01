<?php
/**
 * Plugin Name: UFCLAS Main Website
 * Plugin URI: https://clas.ufl.edu
 * Description: This plugin is for custom functionality for the main CLAS website
 * Version: 1.0
 * Author: Efren Vasquez
 * Author URI: https://mediaservices.clas.ufl.edu
 */

/*==================================

Create custom page templates for Recognition Ceremonies

====================================*/
class ufCLASWebsite_PageTemplater {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new ufCLASWebsite_PageTemplater();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// Add your templates to this array.
		$this->templates = array(
			'public/templates/ufclas-main-website-home.php' => 'CLAS Home Page',
      'public/templates/ufclas-main-website-interior.php' => 'CLAS Interior Pages',
		);

	}

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __FILE__ ). get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

}
add_action( 'plugins_loaded', array( 'ufCLASWebsite_PageTemplater', 'get_instance' ) );

/*======================================

  Include public CSS file

=======================================*/
  function ufCLASWebsite_public_style() {
    if(is_page_template('public/templates/ufclas-main-website-home.php') || is_page_template('public/templates/ufclas-main-website-interior.php')){
      wp_enqueue_style('public-styles', plugin_dir_url(__FILE__).'public/css/styles.css');
    }
  }

  add_action('wp_enqueue_scripts', 'ufCLASWebsite_public_style');



/*======================================

  Pulls in news from https://news.clas.ufl.edu

=======================================*/
function clasNewsFeed($atts){
	 $currentBlogID = get_current_blog_id();

	 extract( shortcode_atts( array(
        'tag'   		 => "clas-news", //default class will be featured
        'eventtotal' => "3", //Total of events to show per page
				'site_id'    => ''
      ), $atts ) );

		$tp_blog_id = $site_id;
		switch_to_blog( $tp_blog_id );

	 $args = array(
         'post_type'         =>    array('post'),
				 'posts_per_page'		 =>    $eventtotal,
				 'tag'  						 => 	 $tag,
			   'orderby'					 =>		 'date',
			   'order'						 =>    'DESC',
	 	 );

	 $output = "";
	 $output .= "<div id='tribe-events-content' class='tribe-events-list'>";

	 $query = new WP_Query($args);

	 if($query->have_posts()){
		 while($query->have_posts()){
			 $query->the_post();

			 $output .= "<h4><a href='". get_the_permalink() ."' target='_blank'>" . get_the_title() . "</a></h4>";

 			 $output .= "<p class='publish-date'>Published on " . get_the_date() . "</p>";

			 $output .= "<p>" . get_the_excerpt() . "</p>";
		 }

	 $output .= "</div>";

	 switch_to_blog($currentBlogID);

	 $output .= "<div class='more-news'>";
	 $output .= "<a href='https://news.clas.ufl.edu/' target='_blank'>Read More News <em class='fas fa-chevron-double-right'></em>";
	 $output .= "</div>";

	 return $output;



	 }else {
		 $output .= "There are no recent news.";
		 return $output;
	 }


}

add_shortcode('clas-news-feed', 'clasNewsFeed');

