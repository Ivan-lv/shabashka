<div class="oneAdvAcShell">
    <div class="row">
        <div class="span2">
            <p class="advTitle"><?php echo $advert['Title']; ?></p>
            <?php $status = "";
            switch($advert['status']) {
                case 0: $status = '<span style="color:green">Активен</span>'; break;
                case 1: $status = '<span style="color:red">Выполнен</span>'; break;
                case 2: $status = '<span style="color:gray">Отменён</span>';
            }
            ?>
            <p><?php echo $status ?></p>
            <p ><?php echo $advert['price'] .'р.'?></p>
        </div>

        <div class="span6">
            <?php echo $advert['text'];?>
        </div>

        <div class="span1">
            <a href="<?php echo site_url('jobs/show/'.$advert['id']); ?>" title="посмотреть">
                <img src="<?php echo base_url('img/icon-eye.png'); ?>"</a>
            </a>
            <a href="<?php echo site_url('/jobs/show/' . $advert['id'] . '#comments');?>" title="комментарии">
                <img src="<?php echo base_url('img/icon-comment.png'); ?>"
            </a>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <img src="<?php echo base_url('img/icon-settings.png'); ?>"/>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo site_url('acount/addEditAdvert/'.$advert['id']) ?>"><i class="icon-edit"></i> редактировать</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('acount/removeAdvert/'.$advert['id']) ?>"><i class="icon-remove"></i> удалить</a>
                    </li>
                    <?php if($advert['id_worker'] != NULL) {?>
                    <li>
                        <a href="#completeAdv" data-toggle="modal" data-advid="<?php echo $advert['id'];?>">
                            <i class="icon-ok-circle"></i> изменить статус
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<!--<div class="resBlock3">
    <div class="resLfPart">


    </div>

    <div class="resMidPart">
        <div>

        </div>
    </div>

    <div class="botPart">

    </div>
</div>-->