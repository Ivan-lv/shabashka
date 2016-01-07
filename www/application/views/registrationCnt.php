<div class="cntShell">
    <h3 style="text-align: center">Регистрация</h3>
    <form class="form-horizontal regForm" method="post" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email" required=""><span></span><br/><span></span>
            </div>
        </div>
        <!--<div class="control-group">
            <label class="control-label" for="inputLogin">Логин</label>
            <div class="controls">
                <input type="text" id="inputLogin" placeholder="Логин" required="">
            </div>
        </div>-->
        <div class="control-group">
            <label class="control-label" for="inputPass">Пароль</label>
            <div class="controls">
                <input type="password" id="inputPass" placeholder="Пароль" required="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="chbCustomer">я-заказчик</label>
            <div class="controls">
                <input type="checkbox" id="chbCustomer" >
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="chbEmpl">я-соискатель</label>
            <div class="controls">
                <input type="checkbox" id="chbEmpl" >
            </div>
            <div style="color: red"></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputSurname">Фамилия</label>
            <div class="controls">
                <input type="text" id="inputSurname" placeholder="Фамилия" required="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputName">Имя</label>
            <div class="controls">
                <input type="text" id="inputName" placeholder="Имя" required="">
            </div>
            <div style="color: red"></div>
        </div>

        <div style="text-align: center">
            <button type="button" class="btn btn-success" id="sendBtn">Зарегистрироваться</button>
        </div>
    </form>
</div>

<script src="<?php echo base_url('js/reg.js')?>"></script>