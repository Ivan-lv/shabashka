var arrCopy = [];
jQuery(document).ready(function () {
    var startFrom = 10;
    $("button.btn.right").click(function(){
        par= {
            'category' : 0 ,
            'subcategory' : 0,
            'count' : 1,
            'sortBy' : 'rating'
        };


        par = JSON.stringify(par);
        $(".searchResultShell").load('Employes/getMasters',{data: par},function(){
        });
    });
   // var set_btn = document.get'btn right';
    //Показ данных комбобокса "вид работ" в зависимости
    //от выбранной категории
    function setComboboxSubcategory() {
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
    setComboboxSubcategory();
});

