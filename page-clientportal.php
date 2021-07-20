<?php
/**
* Template Name: Client Portal
**/

get_header(); ?>
<div class="clientPortal">
	<div class="clientPortal__headerWrapper">
		<div class="ui grid container">
			<div class="row">
				<div class="column">
					<div class="clientPortal__header">
						<div class="clientPortal__pageTitle"><?=__( 'Hello,', 'bdd_deposit_administration' ); ?> <strong><?=premialis_get_user_fullname( get_current_user_id() ); ?></strong>!</div>

						<div class="clientPortal__menu">
							<ul class="clientPortal__menuList">
								<li><button class="clientPortal__btnLink" data-profile><?=__( 'Profile', 'bdd_deposit_administration' ); ?><i class="user outline icon" style="margin-left: 6px;"></i></button></li>
								<li><button class="clientPortal__btnLink" data-make-deposit><?=__( 'Make deposit', 'bdd_deposit_administration' ); ?><i class="chart bar outline icon" style="margin-left: 6px;"></i></button></li>
								<li><a class="clientPortal__btnLink" href="<?=wp_logout_url( home_url() );?>"><?=__( 'Sign Out', 'bdd_deposit_administration' ); ?><i class="sign out alternate icon" style="margin-left: 6px;"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clientPortal__content">
		<div class="ui grid container">
			<div class="row">
				<div class="column">
					<div class="ui text menu">
                        <select id="deposit-graph-select" class="ui dropdown">
                            <option value="all" selected><?=__( 'All deposits', 'bdd_deposit_administration' ); ?></option>
                            <?php foreach( PA()->deposit->get_by_user( get_current_user_id() ) as $key => $deposit ): ?>
                                <option value="<?=$deposit->id; ?>"><?=$deposit->id; ?></option>
                            <?php endforeach; ?>
                        </select>
						
						<div class="right menu">
							<div class="item">
								<div class="ui icon input">
									<input type="text" class="date">
									<i class="calendar link icon"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="ui container">
			<div class="row">
				<div class="chartWrapper">
					<canvas id="deposits-chart" style="width: 100%; height: 400px;"></canvas>
				</div>
			</div>
		</div>
		
		<div class="ui grid container">
			<div class="row">
				<div class="column">
					<a class="clientPortal__btnLink" style="margin-top: 20px;" href="<?=home_url();?>"><i class="arrow left icon"></i><?=__( 'Back to homepage', 'bdd_deposit_administration' );?></a>
				</div>
			</div>
			
			
			<div class="row">
				<div class="sixteen wide column">
					<div class="ui pointing menu" style="padding-top: 0;">
						<a class="item" data-tab="requests"><?=__( 'Requests', 'bdd_deposit_administration' ); ?></a>
						<a class="item active" data-tab="deposits"><?=__( 'Deposits', 'bdd_deposit_administration' ); ?></a>
						<a class="item" data-tab="withdraws"><?=__( 'Withdraws', 'bdd_deposit_administration' ); ?></a>
					</div>
					
					<div class="ui tab" data-tab="requests">
						<?php get_template_part( 'templates/profile/requests' ); ?>
					</div>
					
					<div class="ui tab active" data-tab="deposits">
						<?php get_template_part( 'templates/profile/deposits' ); ?>
					</div>
					
					<div class="ui tab" data-tab="withdraws">
						<?php get_template_part( 'templates/profile/withdrawals' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="profile-modal" class="ui tiny modal main">
	<i class="close icon"></i>
	<div class="header"><?=__( 'Profile', 'bdd_deposit_administration' ); ?></div>
	
	<div class="content">
		<form class="ui form">
			<div class="two fields">
				<div class="field">
					<div class="ui input">
						<input type="text" name="profile-password" id="profile-password" placeholder="<?=__( 'Enter new password', 'bdd_deposit_administration' ); ?>" required>
					</div>
				</div>
				<div class="field">
					<div class="ui input">
						<input type="text" name="profile-password_re" id="profile-password_re" placeholder="<?=__( 'Re-enter new password', 'bdd_deposit_administration' ); ?>" required data-parsley-equalto="#profile-password">
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="actions">
		<div class="ui positive right labeled icon button"><?=__( 'Save', 'bdd_deposit_administration' ); ?><i class="checkmark icon"></i></div>
	</div>
</div>
	
<div id="client-modal" class="ui tiny modal confirming confirm">
	<i class="close icon"></i>
	<div class="header"></div>
	
	<div class="content"></div>
	
	<div class="actions">
		<div class="ui positive right labeled icon button"><?=__( 'Send request', 'bdd_deposit_administration' ); ?><i class="checkmark icon"></i></div>
	</div>
</div>

<?php get_footer(); ?>