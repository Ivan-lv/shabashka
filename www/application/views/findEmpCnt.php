<!--content shell-->

<!--<pre>
    <?php /*print_r($masters); */?>
</pre>-->

<div class="cnt990">
    <h3>Найти работу</h3>
    <form class="form-inline searchForm">
        <div class="formLine1">
            <div>
                <label> Вид работ
                    <select class="span3">
                        <!--@todo: insert code here-->
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <label> Категория
                    <select class="span3">
                        <!--@todo: insert code here-->
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
                        <!--@todo: insert code here-->
                    </select>
                </label>
            </p>
        </div>
    </form>

    <!--result blocks-->


    <?php $this->load->view("emplResults");?>



</div>