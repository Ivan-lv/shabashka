<?php foreach ( $adverts as $advert) { ?>
<div>
    <p>date: <?php echo $advert['date']?></p>
    <p>title: <?php echo $advert['title']?></p>
</div>
<hr/>

<?php } ?>


<div class="pagination pagination-centered">
    <ul>
        <?php echo $this->pagination->create_links(); ?>
    </ul>
</div>