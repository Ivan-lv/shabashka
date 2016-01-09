<?php // заявки для заказчика
    if(isset($bids['cutomerBids'])) {
 ?>
<p class="yellowLineBottom">Заявки на выполнение ваших заказов</p>

<?php if(count($bids['cutomerBids']) > 0) { ?>
<table class="table .table-striped">
    <thead>
        <th>№</th>
        <th>Исполнитель</th>
        <th>Объявление</th>
        <th>Дата</th>
        <th></th>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($bids['cutomerBids']); $i++) {
            $date = new DateTime($bids['cutomerBids'][$i]['date']);
            $n = $i + 1;
        ?>
            <tr>
                <td><?php echo $n;?></td>
                <td><?php echo $bids['cutomerBids'][$i]['Name'] . ' ' . $bids['cutomerBids'][$i]['Surname']; ?></td>
                <td><?php echo $bids['cutomerBids'][$i]['title']; ?></td>
                <td><?php echo $date->format('d.m.Y');?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-small">см. карточку</button>
                        <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">смотреть карточку</a></li>
                            <li><a href="#">назначить исполнителем</a></li>
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