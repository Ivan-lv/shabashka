<div class="commentBlockShell">
<!--    <pre>-->
<!--        --><?php //print_r($userInfo);?>
<!--    </pre>-->
    <div class="resLfPart" style="text-align: center">
        <p class=\"masterPhoto\">
           <?php if($userInfo['photo'] === null) {
               echo '<img src="/img/userWithoutPhoto.png"/>';
           } else {
               echo '<img src="/img/masters/' . $userInfo['photo'] . '/>';
           }

           ?>
        </p>
        <p class=\"masterName\"><?php echo $userInfo['Surname'] . ' ' . $userInfo['Name']?></p>
        <p class=\"masterRaiting\">&nbsp;
        <?php
            for($i = 0; $i < $userInfo['rating']; $i++) { echo img("img/star.png"); }
        ?>
        </p>
        </div>
    <div class="resMidPart"><?php echo $comment['date'] . '<br>' . $comment['text'];?></div>
    <input type="hidden" name="comment_id" value="<?php $comment['id']?>"
    <div class="botPart">
        <div style="display: inline-block; text-align: right">
            <a href="<?php ?>">ответить</a>
        </div>
    </div>
</div>