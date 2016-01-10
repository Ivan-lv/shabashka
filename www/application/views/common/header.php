<!DOCTYPE html>
<html>
<head>
    <title>Шабашка - интернет портал объявлений о подработках</title>
    <meta charset="utf-8"/>
    <?php echo link_tag('styles/bootstrap/css/bootstrap.min.css')?>
    <?php echo link_tag('styles/style.css') ?>

    <script src="<?php echo base_url('js/jquery_min.js')?>"></script>
    <script src="<?php echo base_url('styles/bootstrap/js/bootstrap.min.js')?>"></script>

</head>
<body>
<div class="pageShell">
    <div class="header">
        <div class="hCnt">
            <div>
                <a href="<?php echo base_url()?>"> <?php echo img('img/logo.png')?></a>
            </div>
            <div>
                <a href="<?php echo site_url('employes')?>">Найти мастера</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo site_url('jobs')?>">Найти работу</a>
            </div>
            <div>
                <?php $this->load->library('session');
//                    session_start();
                    if (isset($_SESSION['login'])) {
                        if ($_SESSION['login'] == 'true') {
                            echo "<a href=\"" . site_url('acount') . "\" sytle=\"\"> <i class=\"icon-user\"></i> " .
                                $_SESSION['name'] . "</a> &nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "<a href=\"" . site_url('login/logout') . "\">Выход</a>";
                        }
                    } else {
                        echo "<a href=\"" . site_url('login') . "\">Вход</a> &nbsp;&nbsp;&nbsp;&nbsp";
                        echo "<a href=\"" . site_url('registration') . "\">Регистрация</a>";
                    }
                ?>


            </div>
        </div>
    </div>
</div>
