
<div class="cnt1050" style="margin-top: 30px">
    <div class="lfCol">
        <div class="menu">
            <ul>
                <?php
                    if ($_SESSION['type'] == 2) {
                        echo '<li><a href="'. site_url('acount/myadverts') .'">Мои объявления</a></li>';
                        echo '<li><a href="'. site_url('acount/addEditAdvert') .'">Добавить объявление</a></li>';
                        echo '<li><a href="'. site_url('acount/bids') .'">Заявки</a></li>';
//                        echo '<li><a href="'. site_url('acount/comments') .'">Комментарии</a></li>';
                        echo '<li><a href="'. site_url('acount/editProfile') .'">Ред. профиль</a></li>';
                        echo '<li><a href="'. site_url('acount/mycard') .'">Моя карточка</a></li>';
                        echo '<li><a href="'. site_url('acount/completeorders') .'">Выполненные заказы</a></li>';
                    } else if ($_SESSION['type'] == 0) {
                        echo '<li><a href="'. site_url('acount/myadverts') .'">Мои объявления</a></li>';
                        echo '<li><a href="'. site_url('acount/addEditAdvert') .'">Добавить объявление</a></li>';
                        echo '<li><a href="'. site_url('acount/bids') .'">Заявки</a></li>';
//                        echo '<li><a href="'. site_url('acount/comments') .'">Комментарии</a></li>';
                        echo '<li><a href="'. site_url('acount/editProfile') .'">Ред. профиль</a></li>';
                    } else {
                        echo '<li><a href="'. site_url('acount/editProfile') .'">Ред. профиль</a></li>';
                        echo '<li><a href="'. site_url('acount/bids') .'">Заявки</a></li>';
                        echo '<li><a href="'. site_url('acount/mycard') .'">Моя карточка</a></li>';
                        echo '<li><a href="'. site_url('acount/completeorders') .'">Выполненные заказы</a></li>';
                    }

                ?>

            </ul>
        </div>
    </div>
    <div class="rtCol">
        <?php
        //print_r($advertsList);
            //$this->load->view('accountAdverts');
//            $this->load->view('accountEditProfile');
            $this->load->view($viewName);

        ?>
    </div>
    <div style="clear: both;"></div>
</div>
<script src="<?php echo base_url('js/account.js')?>"></script>