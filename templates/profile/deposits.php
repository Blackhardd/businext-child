<?php if( $deposits = PA()->deposit->get_by_user( get_current_user_id() ) ){ ?>
    <table class="ui single line table">
        <thead>
            <tr>
                <th><?=__('Type', 'bdd_deposit_administration');?></th>
                <th><?=__('Initial deposit', 'bdd_deposit_administration');?></th>
                <th><?=__('Current amount', 'bdd_deposit_administration');?></th>
                <th><?=__('Profit', 'bdd_deposit_administration');?></th>
                <th><?=__('Days past', 'bdd_deposit_administration');?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $deposits as $deposit ):
                $depositState = PA()->deposit->get_last_history( $deposit->id ); ?>
                <tr>
                    <td>
                        <?=PA()->deposit_type->get_single_title( $deposit->type_id ); ?>
                    </td>
                    <td class="collapsing center aligned">
                        <?=format_money( $deposit->amount ); ?>
                    </td>
                    <td class="collapsing center aligned">
                        <?=format_money( $depositState->amount ); ?>
                    </td>
                    <td class="positive collapsing center aligned">
                        <?=format_money( $depositState->profit ); ?>
                    </td>
                    <td class="collapsing center aligned">
                        <?=premialis_get_days_difference( $deposit->date ); ?>
                    </td>
                    <td class="collapsing">
                        <?php if( $deposit->withdraw_requested ): ?>
                            <button class="ui primary button fluid disabled"><?=__( 'Withdraw requested', 'bdd_deposit_administration' ); ?></button>
                        <?php else: ?>
                            <button class="ui primary button fluid" data-deposit-withdraw="<?=$deposit->id; ?>"><?=__( 'Withdraw', 'bdd_deposit_administration' ); ?></button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
}
else{ ?>
    <h5 class="ui header">
        <i class="info icon"></i>
        <div class="content">
            <?=__('No deposits', 'bdd_deposit_administration');?>
            <div class="sub header"><?=__('You don\'t have active deposits.', 'bdd_deposit_administration');?></div>
        </div>
    </h5>
<?php } ?>