<div id="login-modal" class="micromodal" aria-hidden="true">
	<div class="micromodal__overlay" tabindex="-1">
		<div class="micromodal__inner" role="dialog" aria-modal="true" aria-labelledby="login-modal-title">
			<div class="modal__header">
				<button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
			</div>
			<div class="modal__content">
				<form name="loginform" id="loginform" method="post" class="form">
					<div class="form__row">
						<div class="form__col_full">
							<label><?=__( 'Login or email', 'bdd_deposit_administration' );?><br />
							<input type="text" name="lgn" /></label>
						</div>
					</div>
					<div class="form__row">
						<div class="form__col_full">
							<label><?=__( 'Password', 'bdd_deposit_administration' );?><br />
							<input type="password" name="pwd" /></label>
						</div>
					</div>
					<div class="form__row">
						<div class="form__col_full">
							<label><input name="rememberme" type="checkbox" value="forever" /> <?=__( 'Remember me', 'bdd_deposit_administration' );?></label>
						</div>
					</div>
					<div class="form__row">
						<div class="form__col_full">
							<input type="submit" name="wp-submit" value="<?=__( 'Sign on', 'bdd_deposit_administration' );?>" />
						</div>
					</div>
					
					<input type="hidden" name="testcookie" value="1" />
					<input type="hidden" name="action" value="user_signon" />
				</form>
				
				<form name="lostpasswordform" id="lostpasswordform" action="<?=wp_lostpassword_url(); ?>" method="post" class="form hidden">
					<p><?=__( 'Enter your email address and we\'ll send you a link you can use to pick a new password.', 'bdd_deposit_administration' ); ?></p>
					
					<div class="form__row">
						<div class="form__col_full">
							<label><?=__( 'Email', 'bdd_deposit_administration' ); ?></label>
							<input type="text" name="login">
						</div>
					</div>
			 
					<div class="form__row">
						<div class="form__col_full">
							<input type="submit" name="submit" value="<?=__( 'Reset Password', 'bdd_deposit_administration' ); ?>"/>
						</div>
					</div>
					
					<input type="hidden" name="action" value="user_lost_password">
				</form>
				
				<button class="button button_text" data-lpf><?=__( 'Forgot password?', 'bdd_deposit_administration' ); ?></button>
			</div>
		</div>
	</div>
</div>