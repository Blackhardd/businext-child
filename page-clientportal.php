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
						<div class="clientPortal__pageTitle"><?=__( 'Hello,', 'bdd_deposit_administration' ) . ' <strong>' . premialis_get_user_fullname( get_current_user_id() ) . '</strong>!';?></div>

						<div class="clientPortal__menu">
							<ul class="clientPortal__menuList">
								<li><button class="clientPortal__btnLink" data-profile><?=__( 'Profile', 'bdd_deposit_administration' );?><i class="user outline icon" style="margin-left: 6px;"></i></button></li>
								<li><button class="clientPortal__btnLink" data-make_deposit><?=__( 'Make deposit', 'bdd_deposit_administration' );?><i class="chart bar outline icon" style="margin-left: 6px;"></i></button></li>
								<li><a class="clientPortal__btnLink" href="<?=wp_logout_url( home_url() );?>"><?=__( 'Sign Out', 'bdd_deposit_administration' );?><i class="sign out alternate icon" style="margin-left: 6px;"></i></a></li>
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
						<div class="ui dropdown item">
							<?=__( 'Graph options', 'bdd_deposit_administration' ); ?>
							<i class="dropdown icon"></i>
							<div class="menu">
								<div class="item active" data-graph="1,0"><?=__( 'Bonds', 'bdd_deposit_administration' ); ?> - <?=__( 'Profit', 'bdd_deposit_administration' ); ?></div>
								<div class="item" data-graph="1,1"><?=__( 'Bonds', 'bdd_deposit_administration' ); ?> - <?=__( 'Deposit amount', 'bdd_deposit_administration' ); ?></div>
								<div class="item" data-graph="2,0"><?=__( 'Mutual fund', 'bdd_deposit_administration' ); ?> - <?=__( 'Profit', 'bdd_deposit_administration' ); ?></div>
								<div class="item" data-graph="2,1"><?=__( 'Mutual fund', 'bdd_deposit_administration' ); ?> - <?=__( 'Deposit amount', 'bdd_deposit_administration' ); ?></div>
							</div>
						</div>
						
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

<script>
jQuery(function($){
	$(document).ready(function(){
		$('.menu .item').tab();
		
		bindGraphDataChanging();
		
		let current_date = new Date();
		
		$('.date').flatpickr({
			locale: 'cs',
			mode: 'range',
			dateFormat: 'Y-m-d',
			altInput: true,
			altFormat: "F j, Y",
			defaultDate: [current_date.setMonth(current_date.getMonth() - 1), 'today'],
			onReady: function(selectedDates, dateStr, instance){
				window.c_dates_range = selectedDates.map(date => this.formatDate(date, "Y-m-d"));
			},
			onClose: function(selectedDates, dateStr, instance){
				window.c_dates_range = selectedDates.map(date => this.formatDate(date, "Y-m-d"));
				getGraphData(window.c_current_graph_r[0], window.c_current_graph_r[1]);
			}
		});
		
		$('[data-profile]').click(function(e){
			$('#profile-modal').modal({
				closable: false,
				onApprove: function(){
					if($('#profile-modal form').parsley().validate()){
						let profileData = {
							action:		'user_update_password',
							pwd:		$('[name="profile-password_re"]').val()
						};
						
						$.ajax({
							url: bddData.ajaxurl,
							data: profileData,
							type: 'POST',
							success: function(data){
								let response = JSON.parse(data);
								
								$('#profile-modal form').removeClass('loading');
								$('#profile-modal .ui.input').addClass('disabled');
								$('#profile-modal .positive.button').addClass('disabled');
								
								if(document.querySelector('#profile-modal form .ui.positive.message') == null){
									let message_obj = document.createElement('div');
									
									message_obj.classList.add('ui', 'visible', 'positive', 'message');
									message_obj.innerHTML = '<div class="header">Success</div><p>' + response.message + '</p>';
									
									document.querySelector('#profile-modal form').append(message_obj);
								}
							},
							beforeSend: function(){
								$('#profile-modal form').addClass('loading');
							}
						});
					}
					
					return false;
				}
			})
			.modal('show');
		});
		
		getGraphData();
	});
	
	function bindGraphDataChanging(){
		window.c_current_graph_r = $('.menu .item.active[data-graph]').data('graph').split(',');
		
		$('[data-graph]').click(function(){
			window.c_current_graph_r = $(this).data('graph').split(',');
			
			getGraphData(window.c_current_graph_r[0], window.c_current_graph_r[1]);
		});
	}
	
	function getGraphData(deposit_type, graph_data){
		let request_data = {
			action: 	'get_graph_data',
			type: 		deposit_type,
			data:		graph_data,
			startDate:	window.c_dates_range[0],
			endDate:	window.c_dates_range[1]
		};
		
		$.ajax({
			url: bddData.ajaxurl,
			data: request_data,
			type: 'POST',
			success: function(data){
				$('.chartWrapper').removeClass('loading');
				
				let response = JSON.parse(data);
				
				updateGraph(response.labels, response.datasets[0]);
			},
			beforeSend: function(){
				$('.chartWrapper').addClass('loading');
			}
		});
	}
	
	function updateGraph(labels, data){
		removeGraphData();
		addGraphData(labels, data);
		
		window.depositsChart.update();
	}
	
	function removeGraphData(){
		window.depositsChart.data.datasets = [];
	}
	
	function addGraphData(labels, dataset){
		window.depositsChart.data.labels = labels;
		
		let new_data = {
			label: 				dataset.label,
			data: 				[],
			fill: 				dataset.fill,
			backgroundColor: 	dataset.backgroundColor,
			borderColor: 		dataset.borderColor,
			pointRadius: 		dataset.pointRadius,
			pointHoverRadius: 	dataset.pointHoverRadius
		};
		
		for(let i = 0; i < dataset.data.length; i++){
			new_data.data.push(dataset.data[i]);
		}
		
		window.depositsChart.data.datasets.push(new_data);
	}
});
</script>

<?php get_footer(); ?>