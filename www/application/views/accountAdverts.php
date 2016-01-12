<h4>Мои объявления</h4>
<div class="searchResultShell">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Активные()</a></li>
        <li><a href="#profile" data-toggle="tab">Завершенные()</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            активные
        </div>
        <div class="tab-pane fade" id="profile">
            неактивные
        </div>
    </div>

<?php foreach( $advertsList as $advert) { ?>
        <div class="resBlock3">
        <div class="resLfPart">
        <p class="resOrdName"><?php echo $advert['Title']; ?></p>


        <?php $status = "";
        switch($advert['status']) {
            case 0: $status = '<span style="color:green">Активен</span>'; break;
            case 1: $status = '<span style="color:red">Выполнен</span>'; break;
            case 2: $status = '<span style="color:gray">Отменён</span>';
        }
        ?>
        <p class="resStatus"><?php echo $status ?></p>
        <p class="resPrice"><?php echo $advert['price'] .'р.'?></p>

        </div>

        <div class="resMidPart">
            <div>
                <?php echo $advert['text'];?>
            </div>
        </div>

        <div class="botPart">
            <div style="display: inline-block;">
                <a href="<?php echo site_url('jobs/show/'.$advert['id'])?>">посмотреть</a>
            </div>
            <div style="display: inline-block; text-align: right">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        действие
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url('acount/addEditAdvert/'.$advert['id']) ?>">редактировать</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('acount/removeAdvert/'.$advert['id']) ?>">удалить</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        </div>
<?php } ?>

    <?php //@todo: сделать pagination ?>
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

