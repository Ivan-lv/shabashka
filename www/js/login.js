function hide($elem){
    $($elem).fadeOut(300);
}

function commit(){
    alert($('#popup').serialize())
    $.ajax({
        type:'post',
        url: '/index.php/login',
        data: $('#popup').serialize(),
        success:
            function(result){
                //result == какой-то html
                var data = $(result).filter('control-label');
                alert(data.length);
            }
    })
}

$(document).ready(function() {
    $('#togglePopup').click(function(e) {
        $('#popup').fadeIn(300);
        e.preventDefault();
        e.stopPropagation();
    });

    $('#login_popup_commit').click(function(e) {
        //$.post( '/index.php/login' , "bebe")
        commit();
    });
});

//скрытие на клик вне формы
$(document).mouseup(function (e){
    var div = $('#popup');
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        hide($('#popup'));
    }
});

//скрытие на Escape
$(document).keydown(function(e) {
    if (e.keyCode === 27) {
        hide($('#popup'));
    }
});

//отправка на Enter
$(document).keydown(function(e) {
    if (e.keyCode === 13) {
        commit();
    }
});