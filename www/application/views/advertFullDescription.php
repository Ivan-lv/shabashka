<div class="advertShell">
    <h3><?php echo $advertBody['title'] . ' - ' . $advertBody['price'] . 'р.'?></h3>
    <div class="advCatAndOwner">
        <div>
            <?php
             echo img(
                    ($ownerInf['photo'] === null) ?
                    'img/userWithoutPhoto.png' :
                    'img/masters/' . $ownerInf['photo']
                  );
            ?><br/>
            <?php echo $ownerInf['Surname'] . ' ' . $ownerInf['Name'];?>
        </div>
        <div>
            <p><h5>Категории:</h5></p>
            <p><?php
                    foreach($categories as $category) {
                        echo  "<span class=\"label label-info\">$category[name]</span> ";
                    }
                ?></p>
        </div>
    </div>
    <div class="advertDescr">
        <p><h5>Описание:</h5></p>
        <p><?php echo $advertBody['text']?></p>
    </div>
</div>