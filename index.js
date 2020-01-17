'use strict';

$("form").submit(
    function(e){
        e.preventDefault();
        let data = new FormData(document.getElementById('uploadPhotos'));
        sendAjaxForm(data);
        return false; 
    }
);

function sendAjaxForm(data) {
    $.ajax({
        url:     './include/uploadPhoto.php',
        cache: false,
        contentType: false,
        processData: false,
        type:     "POST", 
        data: data,  
        success: function(response) { 
            response = JSON.parse(response);
            if(response.error == false ){
                $('#result').html('Фото успешно загружены!');
            }
            else{
                $('#result').html(response.error);
            }
    	},
    	error: function(response) { 
            $('#result').html('Ошибка. Данные не отправлены.');
    	}
 	});
}

$(".photos").on('click', 'input[type=checkbox]', function(e) {
    $.ajax({
        url:     './include/showPhoto.php',
        type:     "POST", 
        data: { 'photo_name': e.target.id },  
        success: function(response) { 
            $('.photos').html($(response));
    	},
    	error: function(response) { 
            $('.photos').html('Ошибка.');
    	}
 	});
});