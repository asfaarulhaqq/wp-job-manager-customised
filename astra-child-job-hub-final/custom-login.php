<?php /* Template Name: Custom Login Pages */ ?>
<?php
get_header();
?>
<style type="text/css">
       
		#loginform label{
			font-size:18px !important;
		}
		#loginform{
			width:50% !important;
		}
        @media (max-width:480px){
            #loginform{
                width:100% !important;
                padding:0 20px;
            }
	    }
</style>
<div class="ast-container" style="justify-content: center;padding: 75px 0px;align-items: center;height:80vh;">
	<?php
	if ( ! is_user_logged_in() ) {
		$args = array(
			'redirect' => admin_url(), // redirect to admin dashboard.
			'form_id' => 'loginform',
			'label_username' => __( 'Username:' ),
			'label_password' => __( 'Password:' ),
			'label_remember' => __( 'Remember Me' ),
			'label_log_in' => __( 'Log Me In' ),
			 'remember' => true
		);
	wp_login_form( $args );
	}?>
</div>
<?php
$err_codes = isset( $_SESSION["err_codes"] )? $_SESSION["err_codes"] : 0;
    if( $err_codes !== 0 ){
        echo display_error_message(  $err_codes );
}
function display_error_message( $err_code ){
    // Invalid username.
    if ( in_array( 'invalid_username', $err_code ) ) {
        $error = '<strong>ERROR</strong>: Invalid username.';
    }
    // Incorrect password.
    if ( in_array( 'incorrect_password', $err_code ) ) {
        $error = '<strong>ERROR</strong>: The password you entered is incorrect.';
    }
    // Empty username.
    if ( in_array( 'empty_username', $err_code ) ) {
        $error = '<strong>ERROR</strong>: The username field is empty.';
    }
    // Empty password.
    if ( in_array( 'empty_password', $err_code ) ) {
        $error = '<strong>ERROR</strong>: The password field is empty.';
    }
    // Empty username and empty password.
    if( in_array( 'empty_username', $err_code )  &&  in_array( 'empty_password', $err_code )){
        $error = '<strong>ERROR</strong>: The username and password are empty.';
    }
return $error;
}
get_footer();
?>