<!--content shell-->
<script src="<?php echo base_url('js/findEmpCnt.js')?>"></script>
<!--<pre>
    <?php /*print_r($masters); */?>
</pre>-->
<div class="cnt990">
    <h3>Найти работу</h3>
    <form class="form-inline searchForm">
        <div class="formLine1">
            <div>
                <label> Категория
                    <select class="categories" id = "cat">
                        <?php
                        include_once('application/models/Categories.php');
                        $workType = new Categories();
                        $workType =  $workType->getCategories();
                        foreach ($workType as $wt) {
                            echo '<option value="'.$wt['id'].'">'.$wt['name'].'</option>';
                        }
                        ?>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <label> Вид работ
                    <select class="subCategories" id = "subCat">
                        <?php
                        include_once('application/models/Categories.php');
                        $workType = new Categories();
                        $workType =  $workType->getSubCategories();
                        foreach ($workType as $wt) {
                            echo '<option value="'.$wt['id'].'">'.$wt['name'].'</option>';
                        }
                        ?>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
            </div>
            <div>
                <button class="btn right"><i class="icon-search"></i> найти</button>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="formLine2">
            <p >Сортировать: &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#">по количеству заказов</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#">по рейтингу</a>&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
            <p style="text-align: right">
                <label> Выводить по
                    <select class="span1">
                        <option value="5"> 5 </option>
                        <option value="10"> 10 </option>
                        <option value="15"> 15 </option>
                        <option value="20"> 20 </option>
                    </select>
                </label>
            </p>
        </div>
    </form>
    <div class="searchResultShell">
        <!--result blocks-->


        <?php $this->load->view("emplResults");?>

    </div>

</div>