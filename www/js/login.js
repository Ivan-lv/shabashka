function hide($elem){
    $($elem).fadeOut(300);

}

function commit(){
    $.ajax({
        type:'post',
        url: 'http://shab.dev/index.php/login',
        data: {'Login': document.getElementById('login_inp').value, 'Password': document.getElementById('pass_inp').value, 'ajax' : true},
        //dataType: 'html',
        async:false,
        success:
            function(response) {
                if (response == 'bagLogin'){
                    //$('#bad_login_label').show();
                    $('#bad_login_label').fadeIn(500);
                    $('#bad_login_label').fadeOut(500);
                } else {
                    window.location.reload();
                }
            }
    })
}

$(document).ready(function() {
    $('#togglePopup').click(function(e) {
        $('#popup').fadeIn(300);
        $('bad_login_label').hide();
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
    if ( $('#popup').is(':visible')) {
        var div = $('#popup');
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            hide($('#popup'));
        }
    }
});

//скрытие на Escape
$(document).keydown(function(e) {
    if ( $('#popup').is(':visible')) {
        if (e.keyCode === 27) {
            hide($('#popup'));
        }
    }
});

//отправка на Enter
$(document).keydown(function(e) {
    if ( $('#popup').is(':visible')) {
        if (e.keyCode === 13) {
            commit();
        }
    }
});