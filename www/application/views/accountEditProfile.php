<div class="cntShell">
<!--    <h3 style="text-align: center"></h3>-->

    <form class="form-horizontal profileForm" method="post" enctype="multipart/form-data" action="saveProfile">
        <p style="border-bottom: 1px solid #ffff00">Ваш аватар</p>
        <div >
            <?php
            if (!$userData['photo']) {
                echo img('img/userWithoutPhoto.png');
                echo '<br/><input type="file"/>';
            } else {
                echo img('img/masters/' . $userData['photo']);
                echo '<br/><input type="file" />';
            }

            ?>
        </div>


        <p style="border-bottom: 1px solid #ffff00; margin-top: 20px;" >Контактная информация</p>

        <div class="control-group">
            <label class="control-label" for="inputSkype">Skype</label>
            <div class="controls">
                <input type="text" name="Skype" id="inputSkype" placeholder="Skype"  value="<?php echo $userData['Skype']?>"><span></span><br/><span></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputICQ">ICQ</label>
            <div class="controls">
                <input type="text" name="icq" id="inputICQ" placeholder="ICQ" value="<?php echo $userData['icq']?>"><span></span><br/><span></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPhone">номер тел.</label>
            <div class="controls">
                <input type="text" name="phone" id="inputPhone" placeholder="" value="<?php echo $userData['phone']?>"><span></span><br/><span></span>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="inputSurname">Фамилия</label>
            <div class="controls">
                <input type="text" name="Surname" id="inputSurname" placeholder="Фамилия" required="" value="<?php echo $userData['Surname']?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputName">Имя</label>
            <div class="controls">
                <input type="text" name="Name" id="inputName" placeholder="Имя" required="" value="<?php echo $userData['Name']?>">
            </div>
            <div style="color: red"></div>
        </div>

        <div style="text-align: center">
            <button type="submit" class="btn btn-success" id="sendBtn">Сохранить</button>
        </div>
    </form>
</div>

