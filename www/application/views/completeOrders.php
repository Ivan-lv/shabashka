<h3>Мои выполненные заказы</h3>
<?php if(count($ordList) == 0) {echo "у вас нет выполненых заказов";}?>

<table class="table table-bordered">
    <thead>
        <th>№</th>
        <th>Заказчик</th>
        <th>Категория</th>
        <th>Цена</th>
    </thead>
    <?php
        for($i = 0; $i < count($ordList); $i++) {
            $n = $i + 1;
            echo '<tr>';
            echo "<td>$n</td>";
            echo "<td>{$ordList[$i]['Surname']} {$ordList[$i]['Name']}</td>";
            echo "<td>{$ordList[$i]['name']}</td>";
            echo "<td>{$ordList[$i]['price']}</td>";
            echo '</tr>';
        }

    ?>
</table>