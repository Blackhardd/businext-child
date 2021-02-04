<?php if( $requests = PA()->deposit_request->get_by_user( get_current_user_id() ) ){ ?>
    <table class="ui table">
        <thead>
            <tr>
                <th><?=__('Type', 'bdd_deposit_administration');?></th>
                <th><?=__('Payment code', 'bdd_deposit_administration');?></th>
                <th><?=__('Date', 'bdd_deposit_administration');?></th>
                <th><?=__('Amount', 'bdd_deposit_administration');?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $requests as $request ): ?>
                <tr>
                    <td>
                        <?=PA()->deposit_type->get_single_title( $request->type_id ); ?>
                    </td>
                    <td>
                        <?=$request->payment_id; ?>
                    </td>
                    <td class="collapsing">
                        <?=$request->request_date; ?>
                    </td>
                    <td class="collapsing">
                        <?=format_money( $request->amount ); ?>
                    </td>
                    <td class="collapsing">
                        <button class="ui negative basic button fluid" data-request-cancel="<?=$request->id; ?>">
                            <i class="close icon"></i>
                            <?=__('Cancel', 'bdd_deposit_administration'); ?>
                        </button>
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
            <?=__('No requests', 'bdd_deposit_administration');?>
            <div class="sub header"><?=__('You don\'t have any pending requests now.', 'bdd_deposit_administration');?></div>
        </div>
    </h5>
<?php } ?>