<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue child scripts
 */

if(!function_exists( 'businext_child_enqueue_scripts' ) ) {
	function businext_child_enqueue_scripts() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ? '' : '.min';

		if(!is_page_template('page-clientportal.php')){
			wp_enqueue_style('businext-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ));
			wp_enqueue_style('businext-child-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ));
		}
	}
}

add_action( 'wp_enqueue_scripts', 'businext_child_enqueue_scripts' );


/**
 *	Reset password form shortcode
 */
 
add_shortcode( 'reset_password_form', 'premialis_reset_password_form' );

function premialis_reset_password_form(){
	if( isset( $_GET['login'] ) && isset( $_GET['key'] ) ){
		$login = esc_attr( $_GET['login'] );
		$key = esc_attr( $_GET['key'] );
	}
	
	return '
		<div id="password-reset-form">
			<form name="resetpassform" id="resetpassform" method="post" class="form" autocomplete="off">
				<div class="form__row">
					<div class="form__col_full">
						<label>' . __( 'New password', 'bdd_deposit_administration' ) . '</label>
						<input type="password" name="pass1" class="input" size="20" value="" autocomplete="off" required/>
					</div>
				</div>
				
				<div class="form__row">
					<div class="form__col_full">
						<label>' . __( 'Repeat new password', 'bdd_deposit_administration' ) . '</label>
						<input type="password" name="pass2" class="input" size="20" value="" autocomplete="off" required/>
					</div>
				</div>
				 
				<div class="form__row">
					<div class="form__col_full">
						<input type="submit" name="submit" value="' . __( 'Reset Password', 'bdd_deposit_administration' ) . '" />
					</div>
				</div>
				
				<input type="hidden" name="rp_login" value="' . $login . '" autocomplete="off" />
				<input type="hidden" name="rp_key" value="' . $key . '" />
				<input type="hidden" name="action" value="user_reset_password">
			</form>
		</div>
	';
}