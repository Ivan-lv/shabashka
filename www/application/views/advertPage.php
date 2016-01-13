<div class="cnt990">

    <?php

        $this->load->view('advertFullDescription',
            array(
                'ownerInf'     => $ownerData[0],
                'categoryList' => $categories,
                'advertBody'   => $body[0]
            )
        );

    ?>

    <!-- comments -->
    <h3 style="margin-top: 40px;"><img src="<?php echo base_url('/img/comments_title.jpg');?>"/> Комментарии: </h3>
    <hr/>
    <?php
        if(isset($_SESSION['login'])) {
            if($_SESSION['login']){
                require('forms/commentsForm.php');
            }
        } else {?>
            <div class="alert alert-info">
                Только зарегестрированные пользователи могут оставлять комментарии
            </div>
        <?php }?>
    <div id="commentsShell"><a name="comments"></a>
    <?php

        foreach( $comments as $comment) {

            $key = array_search($comment['user_id'], array_column($CommentUserData, 'id'));

            echo '<div class="commentBlockShell">';
                echo '<div class="resLfPart" style="text-align: center">';
                echo "<p class=\"masterPhoto\">" .
                    img(($CommentUserData[$key]['photo'] === null) ?
                        'img/userWithoutPhoto.png' :
                        'img/masters/' . $CommentUserData[$key]['photo']) . "</p>";
                echo "<p class=\"masterName\" style=\"margin-bottom:0;\">
                        {$CommentUserData[$key]['Surname']} {$CommentUserData[$key]['Name']}</p>";
                echo "<p class=\"masterRaiting\">&nbsp;";
                for($i = 0; $i < $CommentUserData[$key]['rating']; $i++) { echo img("img/star.png"); }
                echo "</p>";
            echo "</div>";
            $date = new DateTime($comment['date']);
            echo '<div class="resMidPart">' . $date->format('d.m.Yг в H:s:i') . '<br>' . $comment['text'] . '</div>';
            echo '<div class="botPart">';
            echo '<div style="display: inline-block;">';
            //echo 'объявление: ' . $CommentUserData[$key]['title'];
            echo '</div>';
            echo '<div style="display: inline-block; text-align: right">';
            //echo '<a href="' . site_url('acount/jobs/' .$comment['id']) . '">ответить</a>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        }
    ?>
    </div>

</div>