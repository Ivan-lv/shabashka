<table class="table .table-striped">
    <thead>
        <th>№</th>
        <th>Исполнитель</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?php
        for($i = 0; $i < count($bids); $i++) {
            echo '<tr>';
                $n = $i + 1;
                echo "<td>$n</td>";
                echo "<td>{$bids[$i]['Name']} {$bids[$i]['Surname']}</td>";
                $date = new DateTime($bids[$i]['date']); //('d.m.Y', $bids[$i]['date']);
                echo "<td>подал заявку на объявление: \"{$bids[$i]['title']}\" &nbsp;&nbsp; {$date->format('d.m.Y')}</td>";
                echo "<td><a href=\"" . site_url('employes/card/' . $bids[$i]['id']) . "\">смотреть карточку</a> </td>";
            echo '</tr>';
        }
        ?>
    </tbody>
</table>