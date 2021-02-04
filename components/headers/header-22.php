<header id="page-header" <?php Businext::header_class(); ?>>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">

						<?php get_template_part( 'components/branding' ); ?>

						<?php get_template_part( 'components/navigation' ); ?>

						<div class="header-right">
							<?php Businext_Templates::header_language_switcher(); ?>

							<?php Businext_Templates::header_social_networks( array(
								'tooltip_position' => 'bottom',
								'tooltip_skin'     => 'primary',
							) ); ?>

							<?php Businext_Templates::header_search_button(); ?>

							<?php Businext_Woo::render_mini_cart(); ?>

							<?php Businext_Templates::header_open_mobile_menu_button(); ?>


							<div class="header__premialisBtnWrap">
							<?php
							if(!function_exists('is_user_logged_in')){
								$user = wp_get_current_user();
								if(!empty($user->ID)){
									echo '<a href="'.home_url().'/client-portal/" class="header__loginBtn">'.__('Dashboard', 'bdd_deposit_administration').'</a>';
								}
								else{
									echo '<button class="header__loginBtn" data-custom-open="login-modal"><span>'.__('Login', 'bdd_deposit_administration').'</span></button>';
								}
							}
							else{
								if(is_user_logged_in()){
									echo '<a href="'.home_url().'/client-portal/" class="header__loginBtn">'.__('Dashboard', 'bdd_deposit_administration').'</a>';
								}
								else{
									echo '<button class="header__loginBtn" data-custom-open="login-modal"><span>'.__('Login', 'bdd_deposit_administration').'</span></button>';
								}
							}
							?>
							</div>
						</div>

						<?php
						$info_text     = Businext::setting( 'header_style_17_info_text' );
						$info_sub_text = Businext::setting( 'header_style_17_info_sub_text' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
