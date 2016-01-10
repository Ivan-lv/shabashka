<!--content block-->
<div class="cntShell">
<!--slider for orders-->
<div class="sliderShell" data-slider="adverts">
    <div class="sliderArrow"></div><!--
   --><div class="sliderCnt">
        <div><!--


              <?php
                echo '<!--';
                foreach($adverts as $advert){
                    $text = (strlen($advert['text']) > 115) ? substr($advert['text'], 0, 115) . "..." : $advert['text'];
                    echo '--><div class="item1" data-advid="'.$advert['id'].'" onclick="goToAdvert(this)">';
                    echo "<p>$advert[title]</p>"; // @todo: проверить name ли?!!
                    echo "<p style=\"height: 56px;\">$text</p>";
                    echo "<p>{$advert['price']}р.</p>"; // @todo: проверить price ли?!!
                    echo '</div><!--';
                }
                echo '-->'
              ?>
        </div>
    </div><!--
   --><div class="rightSlider"></div>
</div>
<!--
       <pre>
            <?php
/*                foreach($categs as $c) {
                    print_r($c['subcats']);
                }

                echo site_url('home');

            */?>
        </pre>-->

<!--categories-->
<table class="catShell">
    <tbody>

    <?php
        $i = 0;
        foreach($categs as $categ) {
            if($i == 0) {
                echo "<tr>";
            }
            echo "<td>";
            echo '<div class="catItem">';
            echo "<div>" . img('img/' . $categ['picture']) ."</div>";
            echo "<div class=\"catName\">$categ[name]</div>";
            echo "<div><ul>";
            foreach($categ['subcats'] as $subcat) {
                echo "<li><a href=\"". site_url("jobs/find/${categ['id']}/${subcat['id']}") . "\">" .
                    "$subcat[name]</a></li>";
            }
            echo "</ul></div>";
            echo "</div>"; // .catItem
            echo "</td>";

            if($i == 2) {
                echo "</tr>";
                $i = 0;
                continue;
            }
            $i++;
        }
    ?>

    </tbody>
</table>

<!--<pre>

<?php /*//print_r($masters) */?>

</pre>-->


<!--slider for masters-->
<h3 style="text-align: center">Лучшие мастера</h3>
<div class="sliderShell" data-slider="masters">
    <div class="sliderArrow"></div><!--
 --><div class="sliderCnt">
        <div>

            <?php
            foreach($masters as $master) {

                echo "<div class=\"sliderItem2\" data-userId=\"$master[id]\" >";
                echo "<p class=\"masterPhoto\">" .
                    img(($master['photo'] === null) ?
                        'img/userWithoutPhoto.png' :
                        'img/masters/' . $master['photo']) . "</p>";
                echo "<p class=\"masterName\">$master[Surname] $master[Name]</p>";
                //echo "<p class=\"masterCat\">Категории: Уход и присмотр</p>";
                echo "<p class=\"masterRaiting\">&nbsp;";
                for($i = 0; $i < $master['rating']; $i++) { echo img("img/star.png"); }
                echo "</p>";
                echo '</div>';

            }
            ?>


        </div>
    </div><!--
 --><div class="rightSlider"></div>
</div>

</div>

<script src="<?php echo base_url('js/mainPageJS.js') ?>"></script>