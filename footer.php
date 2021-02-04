<?php
/**
 * The template for displaying the footer.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Businext
 * @since   1.0
 */

?>
</div><!-- /.content-wrapper -->
<?php if( !is_page_template( 'page-clientportal.php' ) ){ get_template_part( 'components/footer' ); }?>
</div><!-- /.site -->

<?php
if( !is_user_logged_in() ){
	get_template_part( 'template-parts/form-login' );
}
?>


<div id="register-modal" class="micromodal" aria-hidden="true">
	<div class="micromodal__overlay" tabindex="-1">
		<div class="micromodal__inner" role="dialog" aria-modal="true" aria-labelledby="login-modal-title">
			<div class="modal__header">
				<button class="modal__close" aria-label="Close modal" data-custom-close></button>
			</div>
			
			<div class="modal__content">
				<div class="steps__wrapper">
					<div class="steps__header">
						<ul class="steps__list">
							<li data-step="1" class="active"><?=__('Registration', 'bdd_deposit_administration');?></li>
							<li data-step="2"><?=__('Deposit request', 'bdd_deposit_administration');?></li>
						</ul>
					</div>
					
					<div class="steps__step active" data-step="1">
						<form class="form" id="register">
							<div class="form__row">
								<div class="form__col_full">
									<div class="form__toggle">
										<input type="radio" name="register_userType" value="personal" id="register-userType-personal" checked="checked">
										<label for="register-userType-personal"><?=__('Personal', 'bdd_deposit_administration'); ?></label>
										<input type="radio" name="register_userType" value="company" id="register-userType-company">
										<label for="register-userType-company"><?=__('Company', 'bdd_deposit_administration'); ?></label>
									</div>
								</div>
							</div>
						
							<div class="form__row">
								<div class="form__col_half">
									<input type="text" name="register_firstName" id="register-firstName" placeholder="<?=__('First name', 'bdd_deposit_administration');?>" required="">
								</div>
								<div class="form__col_half">
									<input type="text" name="register_lastName" id="register-lastName" placeholder="<?=__('Last name', 'bdd_deposit_administration');?>" required="">
								</div>
							</div>
							
							<div class="form__fieldsGroup active" data-fields-group="personal">
								<div class="form__row">
									<div class="form__col_half">
										<input type="text" name="register_op" id="register-op" placeholder="<?=__('OP number', 'bdd_deposit_administration');?>" required="">
									</div>
									<div class="form__col_half">
										<input type="text" name="register_personalId" id="register-personalId" placeholder="<?=__('Personal identification number', 'bdd_deposit_administration');?>" data-parsley-trigger="input" data-parsley-maxlength="10" data-parsley-type="digits" required="">
									</div>
								</div>
							</div>
							
							<div class="form__fieldsGroup" data-fields-group="company">
								<div class="form__row">
									<div class="form__col_half">
										<input type="text" name="register_companyName" id="register-companyName" placeholder="<?=__('Company name', 'bdd_deposit_administration');?>">
									</div>
									<div class="form__col_half">
										<input type="text" name="register_companyId" id="register-companyId" placeholder="<?=__('Company number ID', 'bdd_deposit_administration');?>">
									</div>
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_half">
									<input type="email" name="register_email" id="register-email" placeholder="<?=__('Email', 'bdd_deposit_administration');?>" required="">
								</div>
								<div class="form__col_half">
									<input type="tel" name="register_phone" id="register-phone" placeholder="<?=__('Phone number', 'bdd_deposit_administration');?>" data-parsley-trigger="input" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" required="">
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_half">
									<input type="text" name="register_city" id="register-city" placeholder="<?=__('City', 'bdd_deposit_administration');?>" required="">
								</div>
								<div class="form__col_half">
									<input type="text" name="register_address" id="register-address" placeholder="<?=__('Address', 'bdd_deposit_administration');?>" required="">
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_full">
									<input type="text" name="register_iban" id="register-iban" placeholder="<?=__('Bank account number', 'bdd_deposit_administration');?>" required="">
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_full">
									<input type="text" name="register_designation" id="register-designation" placeholder="<?=__('Designation of the investment group', 'bdd_deposit_administration');?>">
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_full">
									<select name="register_delivery" id="register-delivery" required="">
										<option value=""><?=__('Method of sending the contract', 'bdd_deposit_administration');?></option>
										<option value="<?=__('Via email', 'bdd_deposit_administration');?>"><?=__('Via email', 'bdd_deposit_administration');?></option>
										<option value="<?=__('Via post', 'bdd_deposit_administration');?>"><?=__('Via post', 'bdd_deposit_administration');?></option>
										<option value="<?=__('By courier', 'bdd_deposit_administration');?>"><?=__('By courier', 'bdd_deposit_administration');?></option>
									</select>
								</div>
							</div>
							
							<div class="form__row">
								<div class="form__col_full">
									<label for="register-acceptance"><input type="checkbox" name="register_acceptance" id="register-acceptance" value="true" required=""><?=sprintf( __('Consent to the processing of %spersonal data%s', 'bdd_deposit_administration'), '<a href="https://premial.cz/zpracovani-osobnich-udaju/" class="premialis__link">', '</a>' );?></label>
								</div>
							</div>
						</form>
					</div>
					
					<div class="steps__step" data-step="2">
						<?php PA()->render_registration_order_form();?>
					</div>
				</div>
			</div>
			
			<div class="modal__footer">
				<button class="steps__btn steps__btn_next"><?=__('Register', 'bdd_deposit_administration');?></button>
			</div>
		</div>
	</div>
</div>


<?php wp_footer(); ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166609679-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166609679-1');
</script>
</body>
</html>
