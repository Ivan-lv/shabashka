<?php // заявки для заказчика
    if(isset($bids['cutomerBids'])) {
 ?>
<h4 class="yellowLineBottom">Заявки на выполнение ваших заказов</h4>

<?php if(count($bids['cutomerBids']) > 0) { ?>
            <?php foreach($bids['cutomerBids'] as $order) { ?>
                <?php if(count($order['bids']) == 0) continue;?>
                <div class="order-group-bids-shell">
                    <div>
                        <h5 style="text-align: center"><?php echo $order['title']?></h5>
<!--                        <div class="span2">--><?php //echo $order['title']?><!--</div>-->
<!--                        <div class="span4"></div>-->
                    </div>
                    <div>
                        <table class="table .table-striped">
                            <thead>
                                <th></th>
                                <th>Мастер</th>
                                <th>дата заявки</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($order['bids'] as $bid) {
                                        require('orderBlockWithBids.php');
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } ?>





<?php } else {?>
            <div class="alert alert-info">заявок не поступало</div>
<?php }?>

<?php } ?>

<?php // поданные заявки
    if(isset($bids['masterBids'])) {
?>

    <h4 class="yellowLineBottom" style="margin-top: 25px;">Заявки которые подали Вы</h4>

    <?php if (count($bids['masterBids']) > 0) {?>

            <table class="table .table-striped">
                <thead>
                    <th>№</th>
                    <th>Объявление</th>
                    <th>Дата подачи</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($bids['masterBids']); $i++) {
            $date = new DateTime($bids['masterBids'][$i]['date']);
            $n = $i + 1; //. $bids['cutomerBids'][$i]['']
        ?>
                        <tr>
                            <td><?php echo $n;?></td>
                            <td><?php echo $bids['masterBids'][$i]['title']?></td>
                            <td><?php echo $date->format('d.m.Y');?></td>
                            <td><?php
                                $bidId = $bids['masterBids'][$i]['bidID'];
                                require('forms/unsubscribeToBidForm.php');
                                ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

<?php } else { ?>
            <div class="alert alert-info">у вас нет поданных заявок</div>
<?php } ?>
<?php } ?>