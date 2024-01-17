<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );
//require_once( get_template_directory() . 'jobhub-config.php' );



/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css?514545', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function add_script()
{
   wp_register_script('js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array ( 'jquery' ), 1.1, true);
   wp_enqueue_script( 'js');
}
add_action('wp_enqueue_scripts', 'add_script');

function custom_seperator($sep)
{
    return '-';
}

add_filter('document_title_separator', 'custom_seperator', 10);
function custom_html_title($title)
{
    if ( get_post_type( get_the_ID() ) == 'job_listing' ) {
        return array(
                    'title' => wpjm_get_the_job_title() . ' in ' . get_the_job_location(),
                    'site' => get_bloginfo('description')
                );
    }else{
        return $title;
    }
   
}
add_filter('document_title_parts', 'custom_html_title', 10);

// function custom_header_metadata() {
//     echo '<meta name="description" content="Apply today for the '.wpjm_get_the_job_title().' role at '.the_company_name().' in '.get_the_job_location().'. '.the_company_name().' is accepting applications for a '.wpjm_the_job_title().' in '.get_the_job_location().'.">';
// }
// add_action( 'wp_head', 'custom_header_metadata' );
    

function wpjm_widgets_init() {

    register_sidebar( array(
        'name' =>__( 'Job Listing Sidebar', 'wpjm'),
        'id' => 'sidebar-2',
        'description' => __( 'appears on job listing single page', 'wpjm' ),
        'before_widget' => '<div class="job_listing_custom_sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    }
    add_action( 'widgets_init', 'wpjm_widgets_init' );


  function wp_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] ?>);
			background-repeat: no-repeat;
			padding-bottom: 10px;
        }
		#login{
			font-family:'Lato',sans-serif !important;
		}
		
		.login form .input, .login input[type=password]{
			font-size: 16px !important;
			font-style: normal;
			font-weight: 400;
			line-height: 24px !important;
			width: 100% !important;
			padding: 12px 16px !important;
			border-radius: 4px;
			box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.05);
			color: var(--ast-form-input-text,#475569);
		}
		.wp-core-ui .button-primary{    
			background-color: #ffcd57 !important;
			border-color: #ffcd57 !important;
			font-family: 'Lato',sans-serif !important;
			font-weight: 600;
			font-size: 14px !important;
			/* line-height: 1em !important; */
			border-radius: 50px !important;
			padding: 0px 20px !important;
			color: #333 !important;
		}
		
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wp_login_logo' );  

function redirect_login_page() {
    $login_url  = home_url( '/login' );
    $url = basename($_SERVER['REQUEST_URI']); // get requested URL
    isset( $_REQUEST['redirect_to'] ) ? ( $url   = "wp-login.php" ): 0; // if users ssend request to wp-admin
    if( $url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET')  {
        wp_redirect( $login_url );
        exit;
    }
}
add_action('init','redirect_login_page');

function error_handler() {
    $login_page  = home_url( '/login' );
    global $errors;
    $err_codes = $errors->get_error_codes(); // get WordPress built-in error codes
    $_SESSION["err_codes"] =  $err_codes;
    wp_redirect( $login_page ); // keep users on the same page
    exit;
}
add_filter( 'login_errors', 'error_handler');
?>