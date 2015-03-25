<div id="photo_album_block">
    <?php foreach ($photos as $photo)
        echo "<div class='photo'><a href='img/$photo' target='_blank'><img src='img/thumb/$photo'></img></a></div>";
    ?>
</div>
