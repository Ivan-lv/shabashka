

<div class="cnt800 cntShell" style="min-height: 0;">
    <h3>Личная карточка</h3>
    <div class="cardShell">
        <div class="cardLfPart">
            <?php echo img(($userInfo['photo'] === null) ? 'img/userWithoutPhoto.png' : 'img/masters/' . $userInfo['photo']) ?><br/>
            <span><?php echo $userInfo['Surname'] . ' ' . $userInfo['Name']; ?></span><br/>
            <?php
            for($i = 0; $i < $userInfo['rating']; $i++) { echo img("img/star.png"); }
            ?>
        </div>
        <div class="cardMidPart">
            <div>
                <p><strong>Категории</strong></p>
                <p>
                    <?php
                    foreach($Category as $category) {
                        echo  "<span class=\"label label-info\">$category[name]</span> ";
                    }
                    ?>
                </p>
            </div>
            <div><strong>Количество выполненых заказов: <?php echo $userInfo['orders_complete'] ?></strong></div>
        </div>
        <div class="cardRtPart">
            <p><strong>Skype: </strong><?php echo $userInfo['Skype'] ?></p>
            <p><strong>ICQ: </strong><?php echo $userInfo['icq'] ?></p>
            <p><strong>ном. тел: </strong><?php echo $userInfo['phone'] ?></p>
        </div>
    </div>
    <div style="margin: 20px 0 ">
        <p><strong>О себе: </strong> </p>
        <p style="padding: 0 15px;">
            <?php if ($userInfo['text'] != null) { echo $userInfo['text']; } ?>
        </p>
    </div>
</div>

<!--@todo: возможно здесь будет кнопка лдя назначения в исполнители-->


<hr/>
<div style="text-align: right">
    <a href="<?php echo site_url('/acount/editCard/' . $_SESSION['id']); ?>">редактировать карточку</a>
</div>
