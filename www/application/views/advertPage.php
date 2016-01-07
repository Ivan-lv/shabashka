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
    <h3>Комментарии: </h3>
    <hr/>

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
            echo '<div class="resMidPart">' . $comment['text'] . '</div>';
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