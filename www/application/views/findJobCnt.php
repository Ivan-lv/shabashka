<div class="cnt990">
    <h3>Найти работу</h3>
    <form class="form-inline searchForm">
        <div>
            <label> Вид работ
                <select class="span3" id="cat" onchange="getSubcat(this)">
                   <option value="0"></option>
                    <?php
                     foreach ($categs as $categ) {
                        echo "<option value=\"$categ[id]\">$categ[name]</option>";
                     }
                   ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
            <label> Категория
                <select class="span3" id="subCat">
                    <!--@todo: insert code here-->
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
                <label class="js-rb">
                    <input type="radio" value="status" hidden="true" name="group1" style="display: none;"/>
                    по статусу
                </label>

<!--                <a href="#">по цене</a>-->
<!--                <a href="#">по дате</a>-->
<!--                <a href="#">по статусу</a>-->
            </p>
            <p style="text-align: right">
                <label> Выводить по
                    <select class="span1" id="count">
                        <!--@todo: insert code here-->
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="0">все</option>
                    </select>
                </label>
            </p>
        </div>
    </form>
    <div class="searchResultShell">
    <!--result blocks-->
    <?php $this->load->view("ordSearchRes");?>
    </div>
</div>

<script src="<?php echo base_url('js/findJob.js')?>"></script>