<div class="cnt990">
    <h3>Найти работу</h3>
    <form class="form-inline searchForm">
        <div>
            <label> Вид работ
                <select class="span3" id="cat" onchange="getSubcat(this)">
                   <option value="0"></option>
                    <?php
                        if(isset($selectedCat)) {
                            foreach ($categs as $categ) {
                                if($categ['id'] == $selectedCat) {
                                    echo "<option selected=\"selected\" value=\"$categ[id]\">$categ[name]</option>";
                                } else {
                                    echo "<option value=\"$categ[id]\">$categ[name]</option>";
                                }
                            }
                        } else {
                            foreach ($categs as $categ) {
                                echo "<option value=\"$categ[id]\">$categ[name]</option>";
                            }
                        }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
            <label> Категория
                <select class="span3" id="subCat">
                    <option value="0"></option>
                    <?php
                        if(isset($selectedSubcat)) {
                            foreach ($subCats as $subCat) {
                                if($subCat['id'] == $selectedSubcat) {
                                    echo "<option selected=\"selected\" value=\"$subCat[id]\">$subCat[name]</option>";
                                } else {
                                    echo "<option value=\"$subCat[id]\">$subCat[name]</option>";
                                }
                            }
                        } else {
                            foreach ($subCats as $subCat) {
                                echo "<option value=\"$subCat[id]\">$subCat[name]</option>";
                            }
                        }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
            <label> Стоимость от
                <input type="text" value="" class="span1" id="minVal"/>
            </label>
            <label> до
                <input type="text" value="" class="span1" id="maxVal"/>
            </label>&nbsp;&nbsp;
            <button type="button" class="btn" onclick="find()"><i class="icon-search"></i> найти</button>
        </div>
        <div class="formLine2">
            <p >Сортировать: &nbsp;&nbsp;&nbsp;&nbsp;
                <label class="js-rb js-rb-sel" style="padding-right: 12px">
                    <input type="radio" value="date" hidden="true" name="group1" checked style="display: none;"/>
                    по дате
                </label>
                <label class="js-rb" style="padding-right: 12px">
                    <input type="radio" value="price" hidden="true" name="group1" style="display: none;"/>
                    по цене
                </label>
<!--                <label class="js-rb">-->
<!--                    <input type="radio" value="status" hidden="true" name="group1" style="display: none;"/>-->
<!--                    по статусу-->
<!--                </label>-->

<!--                <a href="#">по цене</a>-->
<!--                <a href="#">по дате</a>-->
<!--                <a href="#">по статусу</a>-->
            </p>
            <p style="text-align: right">
                <label> Выводить по
                    <select class="span1" id="count">
                        <!--@todo: insert code here-->
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="">все</option>
                    </select>
                </label>
            </p>
        </div>
    </form>
    <div style="position: relative;">
    <div class="searchloader"><img src="<?php echo base_url('img/searchLoader.png')?>"/> </div>
        <div class="searchResultShell">


        <!--result blocks-->

            <?php $this->load->view("ordSearchRes");?>

        </div>
    </div>
</div>

<script src="<?php echo base_url('js/findJob.js')?>"></script>