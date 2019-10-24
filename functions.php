<?php
// Add Pageproofer script 
add_action( 'wp_head','pp_script' );  
function pp_script() { ?> 
<script type="text/javascript">
(function (d, t) {
   var pp = d.createElement(t), s = d.getElementsByTagName(t)[0];
   pp.src = '//app.pageproofer.com/overlay/js/4486/1247';
   pp.type = 'text/javascript';
   pp.async = true;
   s.parentNode.insertBefore(pp, s);
})(document, 'script');
</script>
<?php
}
/* Replace secondary menu with espanol version */
add_filter( 'wp_nav_menu_args', function( $args ) {
    if ( 'secondary' === $args['theme_location'] && ( is_page( 'home-page-espanol' ) || is_page( 'spanish-page' ) || is_page( 'spanish-version' ) ) ) {
        $args['theme_location'] = 'espanol-top';
    }
	return $args;
} );
/* Replace primary menu with espanol version */
add_filter( 'wp_nav_menu_args', function( $args ) {
	if ( 'primary' === $args['theme_location'] && ( is_page( 'home-page-espanol' ) || is_page( 'spanish-page' ) || is_page( 'spanish-version' ) ) ) {
        $args['theme_location'] = 'espanol-menu';
    }
	return $args;
} );

// Adds page name to classes on page 
add_filter('body_class','page_class');
function page_class($classes) {
   global $wp_query;
   $page = '';
   $page = $wp_query->query_vars['pagename'];
   // add 'pagename' to the $classes array
   $classes[] = $page;
   // return the $classes array
   return $classes;
}
/* Set up the custom menus for Spanish */
function register_my_menus() {
  register_nav_menus (
    array (
	'espanol-menu' => __( 'Espanol Menu' ),
	'espanol-top' => __(' Espanol top' )
	)
  );
}
add_action( 'init', 'register_my_menus' );
/* Allows ACF to show custom fields */
add_filter('acf/settings/remove_wp_meta_box', '__return_false');
?>