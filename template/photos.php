<?php
    include $_SERVER['DOCUMENT_ROOT'].'/template/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/include/showPhoto.php';
?>

<div class="photos">
    <?php 
    foreach ($photos['name'] as $key => $value) : 
    ?>
        <div class="photo">
            <div class="img">
                <img src="<?= $photos['path'][$key] ?>" alt="">
            </div>
            <h3><?= $value ?></h3>
            <p>Дата: <?= $photos['date'][$key] ?></p>
            <p>Размер: <?= $photos['size'][$key] ?></p>
            <input type="checkbox" id="<?= $value ?>">
            <label for="<?= $value ?>">Удалить</label>
        </div>
    <?php endforeach; ?>
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/template/footer.php';
?>