<div class="advertShell">
    <h3><?php echo $advertBody['title'] . ' - ' . $advertBody['price'] . 'р.'?></h3>
    <div class="advCatAndOwner">
        <div>
            <?php
             echo img(
                    ($ownerInf['photo'] === null) ?
                    'img/userWithoutPhoto.png' :
                    'img/masters/' . $ownerInf['photo']
                  );
            ?><br/>
            <?php echo $ownerInf['Surname'] . ' ' . $ownerInf['Name'];?>
        </div>
        <div>
            <h5>Категории:</h5>
            <p><?php
                    foreach($categories as $category) {
                        echo  "<span class=\"label label-info\">$category[name]</span> ";
                    }
                ?></p>
        </div>
    </div>
    <div class="advertDescr">
        <h5>Описание:</h5>
        <p><?php echo $advertBody['text']?></p>
    </div>
    <!-- подача заявки -->
    <?php if(isset($sessionInfo)) {?>
    <div>
        <?php
            //  пользователь владелец объявления
            if($sessionInfo['isOwner']){
        ?>
            <a href="<?php echo site_url('acount/addEditAdvert/' . $advertBody['id']) ?>">редактировать</a>
            <a href="#">удалить</a>

        <?php //<!--пользователь не владелец объявления-->
            } else {
        ?>

            <?php if(isset($sessionInfo['bidInfo'])) {
//                    print_r($sessionInfo['bidInfo']);
                    $bidId = $sessionInfo['bidInfo'][0]['id'];
                    require('forms/unsubscribeToBidForm.php');
                } else {
                    $advID = $advertBody['id'];
                    require('forms/sendBidForm.php');
                } ?>
        <?php } ?>
    </div>
    <?php }?>
</div>