<!--<div class="searchResultShell">-->

    <?php
    foreach($masters as $master) {
        echo '<div class="resBlock2" data-uid="'. $master['id'] .'">';
        echo '<div class="resLfPart">';

        echo img( ($master['photo'] === null) ?
            'img/userWithoutPhoto.png' :
            'img/masters/' . $master['photo'] );

        echo "<span class=\"resMasterName\">$master[Surname] $master[Name]</span>";

        echo '</div>';
        echo '<div class="resMidPart">';
        echo $master['text'];
        echo '</div>';
        echo '<div class="resRtPart">';
        echo '<p class="resRaiting">';
        for($i = 0; $i < $master['rating']; $i++) {
            echo img("img/star.png");
        }
        echo '</p>';
        echo '<p >Заказов выполнено:<br/> <span class="resOrdCount">' . $master['orders_complete'] . '</span></p>';
        echo '</div>';
        echo '</div>';
    }

    ?>

    <div class="pagination pagination-centered" id="resPagination")">
    <ul>
        <?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
<!--</div>-->