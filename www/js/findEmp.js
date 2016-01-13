function getSubcat(elem) {
    var idCat = elem.value;

    if (idCat == 0) {
        return;
    }
    $('#subCat')[0].disabled = true;
    $('#subCat').load('/index.php/Employes/getSubcategories', {idCat: idCat}, function() {
        $('#subCat')[0].disabled = false;
    })

}

function find(url) {
    if (url === undefined) { // если нажали на кнопку поиска, а не на пагинацию
        url = '/index.php/Employes/findd';
    }
    var selCat    = $('#cat')[0];
    var selSubCat = $('#subCat')[0];

    if (selCat.value == 0 ) {
        alert('выберите категорию');
        return;
    }
    data = {};
    data.category = selCat.value;
    if (selSubCat.value != "" && selSubCat.value != "0") {data.subcategory = selSubCat.value}
    else {data.subcategory = 0 }
    data.sortBy = $('input[type="radio"][name="group1"]:checked').val();
    data.count  = $('#count').val();
    data = JSON.stringify(data);
    // показываем preloader
    $(".searchResultShell").css('opacity', '0.3');
    $(".searchloader").css({
        'display': 'block',
        'top'    : $(".searchResultShell").height()/2 - 48 + 'px'
    });
    //подгружаем данные

    $('.searchResultShell').load(url, {params: data}, function() {
        // скрываем preloader
        $(".searchloader").css('display', 'none');
        $(".searchResultShell").css('opacity', '1');

        // весим обарботчик на пагинацию
        $('#resPagination').click(function(e) {
            if (e.target.getAttribute('href').indexOf('find') > -1) {
                e.preventDefault(e.target.getAttribute('href'));
                find(e.target.getAttribute('href'));
            }
        });
    });

}



$(document).ready(function() {
    $('label.js-rb').click(function(e) {
        if (e.target.tagName == 'LABEL') {
            $('.js-rb-sel')[0].classList.remove('js-rb-sel');
            e.target.classList.add("js-rb-sel");
        }
    });

    $('#resPagination').click(function(e) {
        console.log(e.target.getAttribute('href'));
        if (e.target.getAttribute('href').indexOf('find') > -1) {
            e.preventDefault();
            find(e.target.getAttribute('href'));
        }
    });

    $(".resBlock2").click(function(e) {
//      console.log(this);
      location.href = '/index.php/employes/card/' + this.getAttribute('data-uid')
    });
})

/*//var arrCopy = [];
jQuery(document).ready(function () {
    //var startFrom = 10;

    //document.getElementById('subCat').options.length = 0;


    /!*$("button.btn.right").click(function(){
        par= {
            'category' : $('#cat')[0],
            'subcategory' : $('#subCat')[0],
            'count' : $('#span1')[0],
            'sortBy' : $('#formLine2')[0]
        };


        par = JSON.stringify(par);
        $(".searchResultShell").load('Employes/getMasters',{data: par},function(){
        });
    });*!/
    //Показ данных комбобокса "вид работ" в зависимости
    //от выбранной категории
/!*    function setComboboxSubcategory() {
        var cbSub = document.getElementById('subCat');
        var cbCat = document.getElementById('cat');
        var chng = jQuery('.categories');
        for (var i = 0; i < 31; i++) {
            arrCopy.push(cbSub.options[i]);
        }

       chng.change(function () {
            var curInx = cbCat.selectedIndex;
            cbSub.options.length = 0;
            var j =0;
            switch (curInx) {
                case 0:
                    for (var i = 0; i < 5; i++) {
                        //alert($arrCopy.options[i].value);
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 1:
                    for (var i = 5; i < 10; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 2:
                    for (var i = 10; i < 13; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 3:
                    for (var i = 13; i < 17; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 4:
                    for (var i = 17; i < 21; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 5:
                    for (var i = 21; i < 24; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 6:
                    for (var i = 24; i < 27; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
                case 7:
                    for (var i = 27; i < 30; i++) {
                        cbSub.options[j++] = arrCopy[i];
                    }
                    break;
            }
        });
    }
    setComboboxSubcategory();*!/

    $("button.btn.right").click(function(){
        var selCat    = $('#cat')[0];
        var selSubCat = $('#subCat')[0];
/!*        var minVal    = $('#minVal')[0];
        var maxVal    = $('#maxVal')[0];*!/

        if (selCat.value == 0 ) {
            alert('выберите категорию');
            return;
        }
        data = {};
        data.category = selCat.value;
        data.page = 1;
        if (selSubCat.value != "" && selSubCat.value != "0") {data.subcategory = selSubCat.value}
/!*        if (document.forms[0].minVal.value != '' ) {data.priceMin = minVal.value}
        if (document.forms[0].maxVal.value != '' ) {data.priceMax = maxVal.value}*!/
        data.sortBy = $('input[type="radio"][name="group1"]:checked').val();
        data.count  = $('#count').val();
//  var data = {
//    :    ,
//    subcategory: (selSubCat.value == "") ?
//  }

        data = JSON.stringify(data);

        $('.searchResultShell').load('Employes/getMasters', {params: data}, function() {

        })

    });
});*/

