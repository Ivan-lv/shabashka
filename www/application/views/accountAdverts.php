<h4>Мои объявления</h4>
<div class="searchResultShell">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Активные(<?php echo count($advertsList['active']); ?>)</a></li>
        <li><a href="#profile" data-toggle="tab">Завершенные(<?php echo count($advertsList['completed']); ?>)</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <div class="modal hide fade" id="completeAdv">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Звершить объявление</h3>
                </div>
                <div class="modal-body">
                    <p>Ваше объявление <span class="advName"></span> будет перемещено в категорию "Завершенные"</p>
                    <p>ВАЖНО! Не забудьте оценить работу мастера</p>
                    <div class="rating-wrapper">
                        <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1" value="5"/>
                        <label for="rating-input-1-5" class="rating-star"></label>
                        <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1" value="4"/>
                        <label for="rating-input-1-4" class="rating-star"></label>
                        <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1" value="3"/>
                        <label for="rating-input-1-3" class="rating-star"></label>
                        <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1" value="2"/>
                        <label for="rating-input-1-2" class="rating-star"></label>
                        <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1" value="1"/>
                        <label for="rating-input-1-1" class="rating-star"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Отмена</a>
                    <a id="complAdvSend" href="#" class="btn btn-primary">Изменить статус</a>
                </div>
            </div>
            <?php
            if(count($advertsList['active']) > 0) {
                foreach( $advertsList['active'] as $advert) {
                    require('accountOneAdvert.php');
                    echo '<hr/>';
                }
            } else { ?>
                <div class="alert alert-info">У вас нет активных объявлений</div>
            <?php } ?>

        </div>
        <div class="tab-pane fade" id="profile">
            <?php
                if(count($advertsList['completed']) > 0) {
                    foreach( $advertsList['completed'] as $advert) {
                        require('accountOneAdvert.php');
                    }
                } else { ?>
                <div class="alert alert-info">У вас нет завершенных объявлений</div>
            <?php } ?>
        </div>
    </div>


    <?php //@todo: сделать pagination ?>
    <!--<div class="pagination pagination-centered">
        <ul>
            <li><a href="#">пред.</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">след.</a></li>
        </ul>
    </div>-->
</div>

