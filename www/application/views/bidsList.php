<?php // заявки для заказчика
    if(isset($bids['cutomerBids'])) {
 ?>
<p class="yellowLineBottom">Заявки на выполнение ваших заказов</p>

<?php if(count($bids['cutomerBids']) > 0) { ?>
<!--<pre>-->
<?php //print_r($bids['cutomerBids']);?>
<!--</pre>-->
<table class="table .table-striped">
    <thead>
        <th>№</th>
        <th></th>
        <th>Исполнитель</th>
        <th>Объявление</th>
        <th>Дата</th>
        <th></th>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($bids['cutomerBids']); $i++) {
            $date = new DateTime($bids['cutomerBids'][$i]['date']);
            $n = $i + 1; //. $bids['cutomerBids'][$i]['']
        ?>
            <tr>
                <td><?php echo $n;?></td>
                <td><?php if($bids['cutomerBids'][$i]['id_worker'] == $bids['cutomerBids'][$i]['id']) echo 'исполнитель'?></td>
                <td><?php echo $bids['cutomerBids'][$i]['Name'] . ' ' . $bids['cutomerBids'][$i]['Surname']; ?></td>
                <td><?php echo $bids['cutomerBids'][$i]['title']; ?></td>
                <td><?php echo $date->format('d.m.Y');?></td>
                <td>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            действие
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php
                                echo site_url('/employes/card/' . $bids['cutomerBids'][$i]['id']);
                                ?>">Смотреть карточку</a>
                            </li>
                            <li>
                                <a href="<?php
                                    echo site_url('/acount/bindMasterToAdvert/' . $bids['cutomerBids'][$i]['ordId']
                                        . '/' . $bids['cutomerBids'][$i]['id']);
                                ?>">назначить исполнителем</a>
                            </li>
                        </ul>
                    </div>

                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<?php } else {?>
            заявок не поступало
<?php }?>

<?php } ?>

<?php // поданные заявки
    if(isset($bids['masterBids'])) {
?>

    <p class="yellowLineBottom">Заявки которые подали Вы</p>

    <?php if (count($bids['masterBids']) > 0) {?>
    <table class="table .table-striped">
        <thead>
            <th>№</th>
            <th>Заказ</th>
            <th>дата заявки</th>
            <th></th>
        </thead>
        <tbody>
        <?php for($i = 0; $i < count($bids['masterBids']); $i++) {
            $date = new DateTime($bids['masterBids'][$i]['date']);
            $n = $i + 1;
            $bidId = $bids['masterBids'][$i]['bidID'];
        ?>
            <tr>
                <td><?php echo $n;?></td>
                <td><?php echo $bids['masterBids'][$i]['title']; ?></td>
                <td><?php echo $date->format('d.m.Y');?></td>
                <td><?php require('forms/unsubscribeToBidForm.php'); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else { ?>
        у вас ещё нет поданных заявок
<?php } ?>
<?php } ?>