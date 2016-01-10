<form id="commentsForm">
    <p>Ваш комментарий: </p>
    <p class="formText">
        <textarea></textarea>
    </p>
    <p class="formControls"><button name="sendBtn" class="btn" type="button" onclick="insertComment()">Добавить</button></p>
    <input name="page_id" type="hidden" value="<?php echo $body[0]['id']?>"/>
</form>