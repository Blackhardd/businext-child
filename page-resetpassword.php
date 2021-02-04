<?php
/**
 * Template Name: Reset Password
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Premialis
 * @since   1.0
 */

get_header( 'blank' );

if( isset( $_GET['login'] ) && isset( $_GET['key'] ) ){
	$login = esc_attr( $_GET['login'] );
	$key = esc_attr( $_GET['key'] );
}
else {
	wp_safe_redirect( home_url() );
} ?>

<div id="password-reset-form">
	<form name="resetpassform" id="resetpassform" method="post" class="form" autocomplete="off">
		<div class="form__row">
			<div class="form__col_full">
				<label><?=__( 'New password', 'bdd_deposit_administration' ); ?></label>
				<input type="text" name="pass1" id="password" size="20" value="" autocomplete="off" data-parsley-trigger="change" data-parsley-minlength="6" data-parsley-pattern="^[A-Za-z0-9]+$" required/>
			</div>
		</div>
		
		<div class="form__row">
			<div class="form__col_full">
				<label><?=__( 'Repeat new password', 'bdd_deposit_administration' ); ?></label>
				<input type="text" name="pass2" size="20" value="" autocomplete="off" data-parsley-trigger="change" data-parsley-minlength="6" data-parsley-pattern="^[A-Za-z0-9]+$" data-parsley-equalto="#password" required/>
			</div>
		</div>
		
		<div class="form__row">
			<div class="form__col_full">
				<input type="submit" name="submit" value="<?=__( 'Reset Password', 'bdd_deposit_administration' ); ?>" />
			</div>
		</div>
		
		<input type="hidden" name="rp_login" value="<?=$_GET['login']; ?>" autocomplete="off" />
		<input type="hidden" name="rp_key" value="<?=$key; ?>" />
		<input type="hidden" name="action" value="user_reset_password">
	</form>
</div>
		
<?php
get_footer( 'blank' );