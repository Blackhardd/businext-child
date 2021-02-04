<?php if( $withdrawals = PA()->withdraw->get_accepted_by_user( get_current_user_id() ) ){ ?>
    <table class="ui table">
        <thead>
            <tr>
                <th><?=__('Type', 'bdd_deposit_administration');?></th>
                <th><?=__('Method', 'bdd_deposit_administration');?></th>
                <th><?=__('Amount', 'bdd_deposit_administration');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $withdrawals as $withdrawal ):
                $deposit = PA()->deposit->get_single( $withdrawal->deposit_id ); ?>
                <tr>
                    <td>
                        <?=PA()->deposit_type->get_single_title( $deposit->type_id ); ?>
                    </td>
                    <td>
                        <?=PA()->withdraw->get_method_title( $withdrawal->method_id ); ?>
                    </td>
                    <td class="collapsing">
                        <?=format_money( $withdrawal->amount ); ?>
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
            <?=__('No withdraws', 'bdd_deposit_administration');?>
            <div class="sub header"><?=__('You don\'t have any pending withdraws now.', 'bdd_deposit_administration');?></div>
        </div>
    </h5>
<?php } ?>