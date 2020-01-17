<?php
    include $_SERVER['DOCUMENT_ROOT'].'/template/header.php';
?>

<form id="uploadPhotos" enctype="multipart/form-data" method="post">
    <input name="photos[]" type="file" accept="image/jpeg,image/png" required multiple>
    <input type="submit" value="Загрузить">
</form>

<p id="result"></p>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/template/footer.php';
?>