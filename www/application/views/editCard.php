
<div class="cnt990">
    <h3>Моя карточка</h3>
    <form >

        <h4 style="border-bottom: 2px solid #ffff00">Отметьте ваши специализации</h4>
        <table >
            <?php


            $i = 0;
            foreach($categs as $categ) {
                if($i == 0) {
                    echo "<tr>";
                }
                echo "<td style=\"vertical-align: top; padding: 10px;\">";
                echo "<div style=\"padding: 5px; background-color: #ffff00\">$categ[name]</div>";
                echo "<div><ul style=\"list-style-type: none;\">";
                foreach($categ['subcats'] as $subcat) {
                    if(isset($masterInfo)) {
                        $checked = (in_array($subcat['id'], $masterInfo['idSubcats'])) ? 'checked' : '';
                    } else {
                        $checked = '';
                    }

                    echo "<li><label class=\"checkbox\">
                <input type=\"checkbox\" idCat=\"${categ['id']}\" value=\"${subcat['id']}\" $checked />"
                        . " $subcat[name]</label></li>";
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
        </table>
        <h4 style="border-bottom: 2px solid #ffff00">о себе: </h4>

            <textarea style="min-height: 200px; width: 975px; margin: auto;" id="aboutMe"><?php
                echo $masterInfo['text']
            ?></textarea>


        <div style="text-align: center; margin-top: 30px;">
            <button type="button" class="btn btn-success" onclick="sendUserData()">сохранить</button>
        </div>

    </form>

</div>


<script src="<?php echo base_url('js/account.js')?>"></script>



