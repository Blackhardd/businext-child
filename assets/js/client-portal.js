jQuery(document).ready(function($){
    $('.menu .item').tab();
    $('.ui.checkbox').checkbox({});

    let $make_deposit_trigger = $('[data-make-deposit]'),
        $make_deposit_modal = $('#make-deposit-modal'),
        $make_deposit_form = $('#make-deposit-form'),
        $make_deposit_type_select = $('#make-deposit-type'),
        $make_deposit_amount = $('#make-deposit-amount');

    $make_deposit_trigger.on('click', function(){
        $make_deposit_modal.modal({
            closable: false,
            onApprove: function($element){
                ajax_request(
                    $make_deposit_form[0],
                    false,
                    function(){
                        $make_deposit_form.addClass('loading');
                    },
                    function(data){
                        console.log(data);
                        $make_deposit_form.removeClass('loading');
                    }
                );

                return false;
            }
        }).modal('show');
    });

    $make_deposit_type_select.on('change', function(){
        if($(this).val()){
            $make_deposit_amount.parent().removeClass('disabled');
        }
        else{
            $make_deposit_amount.parent().addClass('disabled');
        }

        ajax_request(
            false,
            {
                action: 'get_deposit_type_data',
                id: $(this).val()
            },
            function(){
                $make_deposit_form.addClass('loading');
            },
            function(data){
                data = JSON.parse(data);

                $make_deposit_amount.attr('min', data.min_amount);
                $make_deposit_amount.attr('max', data.max_amount);
                $make_deposit_amount.attr('step', data.step);
                $make_deposit_amount.val(data.min_amount);

                $make_deposit_form.removeClass('loading');
            }
        );
    });


    let $request_withdrawal_triggers = $('[data-request-withdrawal]'),
        $request_withdrawal_modal = $('#request-withdrawal-modal'),
        $request_withdrawal_form = $('#request-withdrawal-form'),
        $request_withdrawal_profit = $('#request-withdrawal-profit'),
        $request_withdrawal_amount = $('#request-withdrawal-amount'),
        $request_withdrawal_amount_input = $('#request-withdrawal-amount-input'),
        $request_withdrawal_payout = $('#request-withdrawal-payout'),
        $request_withdrawal_commission = $('#request-withdrawal-commision'),
        $request_withdrawal_balance = $('#request-withdrawal-balance');


    $request_withdrawal_triggers.on('click', function(){
        let $self = $(this);

        $request_withdrawal_modal.modal({
            closable: false,
            onShow: function($element){
                ajax_request(
                    false,
                    {
                        action: 'get_withdrawal_form_data',
                        deposit: $self.data('request-withdrawal'),
                        method: $request_withdrawal_form.find('input[name="method"]:checked').val()
                    },
                    function(){
                        $request_withdrawal_form.addClass('loading');
                    },
                    function(data){
                        data = JSON.parse(data);

                        $request_withdrawal_profit.text(data.profit);
                        $request_withdrawal_amount.text(data.amount);
                        $request_withdrawal_amount_input.val(data.profit);
                        $request_withdrawal_amount_input.attr('max', data.profit);
                        $request_withdrawal_payout.text(data.payout);
                        $request_withdrawal_commission.text(data.commission);
                        $request_withdrawal_balance.text(data.balance);

                        $request_withdrawal_form.removeClass('loading');
                    }
                );
            },
            onApprove: function($element){
                console.log('Withdrawal request is sent.');

                return false;
            }
        }).modal('show');
    })

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
        }).modal('show');
    });

    if($('#deposits-chart').length){
        let formatter = new Intl.NumberFormat('cs-CZ', { style: 'currency', currency: 'CZK' });

        let chart_config = {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {

                    }
                ]
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top'
                },
                elements: {
                    point: {
                        pointStyle: 'circle'
                    },
                    line: {
                        tension: 0
                    }
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    titleMarginBottom: 12,
                    titleFontSize: 14,
                    bodyFontSize: 16,
                    backgroundColor: 'rgba(0,0,0,1)',
                    callbacks: {
                        label: function(item, data){
                            return data.datasets[item.datasetIndex].label + ': ' + formatter.format(item.yLabel);
                        }
                    }
                }
            }
        };
        let current_date = new Date();
        let chart_date_from = false,
            chart_date_to = false;

        let chart_deposit = 'all';

        let context = $('#deposits-chart')[0].getContext('2d');
        let chart = new Chart(context, chart_config);

        $('.date').flatpickr({
            locale: 'cs',
            mode: 'range',
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: "F j, Y",
            defaultDate: [current_date.setMonth(current_date.getMonth() - 1), 'today'],
            onReady: function(selected_dates, date_str, instance){
                let dates_array = selected_dates.map(date => this.formatDate(date, 'Y-m-d'));
                chart_date_from = dates_array[0];
                chart_date_to = dates_array[1];

                update_chart();
            },
            onClose: function(selected_dates, date_str, instance){
                let dates_array = selected_dates.map(date => this.formatDate(date, 'Y-m-d'));
                chart_date_from = dates_array[0];
                chart_date_to = dates_array[1];

                update_chart();
            }
        });

        $('#deposit-graph-select').on('change', function(){
            chart_deposit = $(this).val();
            update_chart();
        });

        function update_chart(){
            let data = {
                action: 'get_user_chart_data',
                deposit: chart_deposit,
                start_date: chart_date_from,
                end_date: chart_date_to
            };

            $.ajax({
                url: bddData.ajaxurl,
                data: data,
                type: 'POST',
                success: function(data){
                    $('.chartWrapper').removeClass('loading');
                    update_chart_data(JSON.parse(data));
                },
                beforeSend: function(){
                    $('.chartWrapper').addClass('loading');
                }
            });
        }

        function update_chart_data(data){
            reset_chart_data();
            add_chart_data(data);

            chart.update();
        }

        function add_chart_data(data){
            chart.data.labels = data.labels;

            for(let i = 0; i < data.datasets.length; i++){
                chart.data.datasets.push(data.datasets[i]);
            }
        }

        function reset_chart_data(){
            chart.data.datasets = [];
        }
    }

    /**
     *  Helpers
     */
    function ajax_request(form = false, data = false, before = function(){}, success = function(data){}){
        if(!form && !data){
            return;
        }

        let request_data = null;

        if(form && !data){
            request_data = new FormData(form);
        }
        else if(!form && data){
            request_data = data;
        }

        $.ajax({
            type: 'POST',
            url: bddData.ajaxurl,
            data: request_data,
            processData: (!(form && !data)),
            contentType: (form && !data) ? false : 'application/x-www-form-urlencoded',
            success: function(data){
                success(data);
            },
            beforeSend: function(){
                before();
            }
        });
    }
});