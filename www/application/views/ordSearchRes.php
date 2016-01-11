

    <?php

    foreach( $advertsList as $advert) {
        $d = new DateTime($advert['date']);
        $p = $d->format('d.m.Yг.');
        echo '<div class="resBlock1" data-advId="'.$advert['id'].'" onclick="goToAdvert(this)">';
        echo '<div class="resLfPart">';
        echo "<p class=\"resOrdName\"> $advert[title] </p>";
        echo "<p class=\"resOrdInf\"><br/> <span class=\"resOrdDate\">$p</span></p>";
        echo "</div>";

        echo '<div class="resMidPart"><div>';
        echo $advert['text'];
        echo  '</div></div>';

        echo '<div class="resRtPart">';
        $status = "";
        switch($advert['status']) {
            case 0: $status = '<span style="green">Активен</span>'; break;
            case 1: $status = '<span style="red">Выполнен</span>'; break;
            case 2: $status = '<span style="gray">Отменён</span>';
        }

        echo "<p class=\"resStatus\">$status</p>";
        echo "<p class=\"resPrice\">{$advert['price']}р.</p>";
        echo '</div>';
        echo '</div>';
    }

    //@todo: сделать pagination

    ?>
    <div class="pagination pagination-centered" id="resPagination")">
        <ul>
            <?php echo $this->pagination->create_links(); ?>
        </ul>
    </div>
