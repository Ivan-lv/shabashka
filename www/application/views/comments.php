<div class="commentsShell">
<?php
    foreach( $comments as $comment) {
    echo '<div class="commentBlockShell">';
        echo '<div class="resLfPart" style="text-align: center">';
        echo "<p class=\"masterPhoto\">" .
                    img(($comment['masterInfo']['photo'] === null) ?
                        'img/userWithoutPhoto.png' :
                        'img/masters/' . $comment['masterInfo']['photo']) . "</p>";
                echo "<p class=\"masterName\">{$comment['masterInfo']['Surname']} {$comment['masterInfo']['Name']}</p>";
                echo "<p class=\"masterRaiting\">&nbsp;";
                for($i = 0; $i < $comment['masterInfo']['rating']; $i++) { echo img("img/star.png"); }
                echo "</p>";
        echo "</div>";

        echo '<div class="resMidPart">' . $comment['text'] . '</div>';



        echo '<div class="botPart">';
                echo '<div style="display: inline-block;">';
                echo 'объявление: ' . $comment['masterInfo']['title'];
                echo '</div>';
                echo '<div style="display: inline-block; text-align: right">';
                    echo '<a href="' . site_url('acount/jobs/' .$comment['id']) . '">ответить</a>';
                echo '</div>';

        echo '</div>';
    echo '</div>';


    }
?>

</div>