
<div class="cnt990">
    <p style="margin-top: 20px;">
        <a href="<?php echo $_SERVER['HTTP_REFERER']?>"?><i class="icon-arrow-left"></i> Назад</a>
    </p>
    <h3 idOrd = "<?php echo (isset($advertInfo))? $advertInfo['advertBody']['id'] : ''?>"
        variant="<?php echo (isset($advertInfo))? 'edit' : 'add' ?>"><?php
        echo (isset($advertInfo)) ? 'Редактировать объявление "' . $advertInfo['advertBody']['title'] . '"'
                                        : 'Добавить новое объявление'?></h3>
    <form >
        <p>
            Название объявления <input type="text" maxlength="25" id="advTitle" value="<?php
                echo (isset($advertInfo)) ? $advertInfo['advertBody']['title'] : ''

            ?>" class="span3"/>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            Стоимость <input type="text" id="advPrice" value="<?php
                echo (isset($advertInfo)) ? $advertInfo['advertBody']['price'] : '' ?>" class="span2"/>
        </p>
        <p>
            текст объявления <br/>
            <textarea style="min-height: 200px; width: 620px; " id="advText"><?php
                echo (isset($advertInfo)) ? $advertInfo['advertBody']['text'] : ''
          ?></textarea>
        </p>

    <h4>Укажите к каким категориям относится объявление.
        Если категории не будут выбраны, то объявление попадет в категорию “Разное”</h4>
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
            if(isset($advertInfo)) {
                $checked = (in_array($subcat['id'], $advertInfo['idSubcats'])) ? 'checked' : '';
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


    </form>
    <div style="text-align: center;">
        <button class="btn btn-success" onclick="sendAdvData()">
            <?php echo (isset($advertInfo)) ? 'сохранить' : 'создать' ?>
        </button>
    </div>

</div>



<script src="<?php echo base_url('js/account.js')?>"></script>
