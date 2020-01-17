<?php

if(isset($_FILES['photos'])){
    $error = false;
    $allowed =  ['jpeg','png' ,'jpg'];
    $maxUploadFiles = 5;
    $maxUploadSize = 5; //мб
    $mimeType = ['image/png', 'image/jpeg'];
 
    $uploaddir = '/upload/';
 
    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . $uploaddir)){
        mkdir($_SERVER['DOCUMENT_ROOT'] . $uploaddir, 0777);
    }
    
    if(count($_FILES['photos']['name']) > $maxUploadFiles){
        $error = 'Ошибка. Вы загружаете больше '.$maxUploadFiles.' фото.';
    }
    elseif(count($_FILES['photos']['name']) === 1 && $_FILES['photos']['error'][0]){
        $error = 'Ошибка. Нужно загрузить хотя бы одно фото.';
    }
    else{
        foreach($_FILES as $file){
            foreach($file['name'] as $key => $name){
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = (string) finfo_file($finfo, $file['tmp_name'][$key]);
                    
                if(!in_array($mime, $mimeType) || !in_array(strtolower($ext),$allowed)){
                    $error = 'Ошибка. Неправильный формат фото.';
                }
                elseif($file['size'][$key] > $maxUploadSize*1048576){
                    $error = 'Ошибка. Размер фото больше '.$maxUploadSize.'мб.';
                }
                else{
                    if(!move_uploaded_file( $file['tmp_name'][$key], $_SERVER['DOCUMENT_ROOT'] . $uploaddir . basename($name))){
                        $error = 'Ошибка загрузки фото.';
                    }
                }
                finfo_close($finfo);
            }
        }
    }
 
    $data = array('error' => $error);
 
    echo mb_convert_encoding(json_encode($data),"UTF-8");
}
return;