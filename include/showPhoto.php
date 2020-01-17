<?php

$photos = array();
$allowed = ["jpg", "png", "gif"];  
$file_parts = array();
$ext="";

$dir = @opendir($_SERVER['DOCUMENT_ROOT'] . '/upload') or die("<p>На сервере нет фото.</p>");

while ($file = readdir($dir)){
    if($file=="." || $file == "..") continue;
    $file_parts = explode(".",$file);
    $ext = strtolower(array_pop($file_parts));
    $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $file;

    if(in_array($ext,$allowed)){
        if(isset($_POST['photo_name']) && $_POST['photo_name'] == $file){
            unlink($path);
            continue;
        }
        if(filesize($path) < 10*1024){
            $size = filesize($path) . 'б';
        }
        elseif(filesize($path) > 10*1024 && 
                filesize($path) < 1*1048576){
            $size = round(filesize($path) / 1000, 2) . 'кб';
        }
        else{
            $size = round(filesize($path) / 1000000, 2) . 'мб';
        }
        $photos['name'][] = $file;
        $photos['path'][] = './upload/' . $file;
        $photos['date'][] = date("d.m.Y", filectime($path));
        $photos['size'][] = $size;
    }

}

if(!count($photos)){
    die("<p>На сервере нет фото.</p>");
}

closedir($dir);
sort($photos['name'], SORT_NATURAL | SORT_FLAG_CASE);

if(isset($_POST['photo_name'])){
    $html = '';
    foreach ($photos['name'] as $key => $value){ 
        $html .= '<div class="photo">
                    <div class="img">
                        <img src="'.$photos['path'][$key].'" alt="">
                    </div>
                    <h3>'.$value.'</h3>
                    <p>Дата: '.$photos['date'][$key].'</p>
                    <p>Размер: '.$photos['size'][$key].'</p>
                    <input type="checkbox" id="'.$value.'">
                    <label for="'.$value.'">Удалить</label>
                </div>';
    }
    echo $html;
}