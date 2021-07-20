<?php

/**
 *  Adding client portal modal - Make Deposit
 */
add_action( 'wp_footer', 'kdc_make_deposit_modal' );

function kdc_make_deposit_modal(){
    if( is_page_template( 'page-clientportal.php' ) ){ ?>
        <div id="make-deposit-modal" class="ui tiny modal confirming confirm">
            <i class="close icon"></i>
            <div class="header"><?=__( 'Make deposit', 'bdd_deposit_administration' ); ?></div>

            <div class="content">
                <form id="make-deposit-form" class="ui form">
                    <div class="field">
                        <label><?=__( 'Type', 'bdd_deposit_administration' ); ?></label>
                        <select id="make-deposit-type" name="type" class="ui dropdown">
                            <option value="" selected disabled><?=__( 'Select type', 'bdd_deposit_administration' ); ?></option>
                            <?php foreach( PA()->deposit_type->get_all() as $type ): ?>
                                <option value="<?=$type->id; ?>" <?=( PA()->deposit_request->is_user_has_request( $type->id ) ) ? 'disabled' : ''; ?>><?=$type->title; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label><?=__( 'Amount', 'bdd_deposit_administration' ); ?></label>
                        <div class="ui disabled right labeled input">
                            <input id="make-deposit-amount" type="number" min="" max="" step="1000" name="amount" placeholder="<?=__( 'Enter amount', 'bdd_deposit_administration' ); ?>">
                            <div class="ui basic label">Kč</div>
                        </div>
                    </div>

                    <input type="hidden" name="user" value="<?=get_current_user_id(); ?>">
                    <input type="hidden" name="action" value="create_deposit_request">
                </form>
            </div>

            <div class="actions">
                <button class="ui positive right labeled icon button"><?=__( 'Send request', 'bdd_deposit_administration' ); ?><i class="checkmark icon"></i></button>
            </div>
        </div>
        <?php
    }
}


/**
 *  Adding client portal modal - Withdrawal Request
 */
add_action( 'wp_footer', 'kdc_request_withdrawal_modal' );

function kdc_request_withdrawal_modal(){
    $methods = PA()->withdraw->get_methods();

    if( is_page_template( 'page-clientportal.php' ) ){ ?>
        <div id="request-withdrawal-modal" class="ui tiny modal confirming confirm">
            <i class="close icon"></i>
            <div class="header"><?=__( 'Request withdrawal', 'bdd_deposit_administration' ); ?></div>

            <div class="content">
                <form id="request-withdrawal-form" class="ui form">
                    <div class="form-info-row">
                        <div class="form-info-row__label"><?=__( 'Amount', 'bdd_deposit_administration' ); ?></div>
                        <div class="form-info-row__value"><span class="amount" id="request-withdrawal-amount"></span> <span class="suffix"></span></div>
                    </div>

                    <div class="form-info-row">
                        <div class="form-info-row__label"><?=__( 'Profit', 'bdd_deposit_administration' ); ?></div>
                        <div class="form-info-row__value"><span class="amount" id="request-withdrawal-profit"></span> <span class="suffix"></span></div>
                    </div>

                    <div class="field">
                        <div class="ui right labeled input">
                            <input type="number" name="amount" min="1" max="" id="request-withdrawal-amount-input" placeholder="<?=__( 'Enter withdrawal amount', 'bdd_deposit_administration' ); ?>">
                            <div class="ui basic label">Kč</div>
                        </div>
                    </div>

                    <div class="grouped-fields">
                        <label><?=__( 'Withdrawal method', 'bdd_deposit_administration' ); ?></label>

                        <?php foreach( $methods as $key => $method ): ?>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="method" value="<?=$method->id; ?>" <?=( $key == 0 ) ? 'checked' : ''; ?>>
                                    <label><?=$method->title; ?> (<?=$method->fee; ?>%)</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-info-row">
                        <div class="form-info-row__label"><?=__( 'Payout', 'bdd_deposit_administration' ); ?></div>
                        <div class="form-info-row__value"><span class="amount" id="request-withdrawal-payout"></span> <span class="suffix">Kč</span></div>
                    </div>

                    <div class="form-info-row">
                        <div class="form-info-row__label"><?=__( 'Сommission', 'bdd_deposit_administration' ); ?></div>
                        <div class="form-info-row__value"><span class="amount" id="request-withdrawal-commision"></span> <span class="suffix">Kč</span></div>
                    </div>


                    <div class="form-info-row">
                        <div class="form-info-row__label"><?=__( 'Balance', 'bdd_deposit_administration' ); ?></div>
                        <div class="form-info-row__value"><span class="amount" id="request-withdrawal-balance"></span> <span class="suffix">Kč</span></div>
                    </div>

                    <input type="hidden" name="user" value="<?=get_current_user_id(); ?>">
                    <input type="hidden" name="action" value="withdrawal_create_request">
                </form>
            </div>

            <div class="actions">
                <button class="ui positive right labeled icon button"><?=__( 'Send request', 'bdd_deposit_administration' ); ?><i class="checkmark icon"></i></button>
            </div>
        </div>
        <?php
    }
}