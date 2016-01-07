<h4>Мои объявления</h4>
<div class="searchResultShell">

    <?php

    /*
    $advertsList = array(
        array(
            'id'    => 1,
            'name'  => 'Нужен повар !!!',
            'text'  => 'Нужен повар для приготовления Нужен повар для приготовления
                                пищи на праздник меню Нужен повар для приготовления
                                пищи на праздник меню пищи на праздник меню',
            'price' => 1000,
            'categ' => 'Ремонт бытовой техники',
            'dateAdded' => '12.05.2010',
            'status' => 0


        ),
        array(
            'id'    => 2,
            'name'  => 'Нужен повар !!!',
            'text'  => 'Нужен повар для приготовления Нужен повар для приготовления
                                пищи на праздник меню Нужен повар для приготовления
                                пищи на праздник меню пищи на праздник меню',
            'price' => 2000,
            'categ' => 'Ремонт бытовой техники',
            'dateAdded' => '12.05.2010',
            'status' => 0


        )

    );
    */



    foreach( $advertsList as $advert) {
        echo '<div class="resBlock3">';
        echo '<div class="resLfPart">';
        echo "<p class=\"resOrdName\"> $advert[Title] </p>";
        //echo "<p class=\"resOrdInf\">$advert[categ] <br/> <span class=\"resOrdDate\">$advert[dateAdded]</span></p>";

        $status = "";
        switch($advert['status']) {
            case 0: $status = '<span style="color:green">Активен</span>'; break;
            case 1: $status = '<span style="color:red">Выполнен</span>'; break;
            case 2: $status = '<span style="color:gray">Отменён</span>';
        }

        echo "<p class=\"resStatus\">$status</p>";
        echo "<p class=\"resPrice\">{$advert['price']}р.</p>";

        echo "</div>";

        echo '<div class="resMidPart"><div>';
        echo $advert['text'];
        echo  '</div></div>';

        echo '<div class="botPart">';
            echo '<div style="display: inline-block;">';
                echo '<a href="' . site_url('jobs/'.$advert['id']) . '">посмотреть</a>';
            echo '</div>';
            echo '<div style="display: inline-block; text-align: right">';
                echo '<a href="' . site_url('acount/addEditAdvert/'.$advert['id']) . '">редактировать</a>';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<a href="' . site_url('acount/removeAdvert/'.$advert['id']) . '">удалить</a>';
            echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //@todo: сделать pagination

    ?>


    <!--<div class="pagination pagination-centered">
        <ul>
            <li><a href="#">пред.</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">след.</a></li>
        </ul>
    </div>-->
</div>

