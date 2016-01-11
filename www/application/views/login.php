<div class="cntShell">
    <h3 style="text-align: center">Авторизация</h3>
    <form class="form-horizontal authForm" method="post" action="<?php echo site_url('/login') ?>" enctype="multipart/form-data">
            <?php
            if ($noAuth) {
                echo '<div style="margin-bottom: 40px; text-align: center; color:#dd514c">для выполнения этой функции требуется авторизация</div>';
            }
            if ($badAuth) {
                echo '<div style="margin-bottom: 40px; text-align: center; color:#dd514c">неверный логин или пароль</div>';
            }
            ?>

        <div class="control-group">
            <label class="control-label" for="inputLogin">Логин</label>
            <div class="controls">
                <input type="text" id="inputLogin" placeholder="введите логин" required="" name="Login">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Пароль</label>
            <div class="controls">
                <input type="password" id="inputPassword" placeholder="введите пароль" required="" name="Password">
            </div>
        </div>

        <div style="text-align: center">
            <button type="submit" class="btn btn-success">войти</button>
        </div>
<!--        <div style="text-align: center; margin-top: 40px"><a href="#">восстановить пароль</a></div>-->
    </form>
</div>
