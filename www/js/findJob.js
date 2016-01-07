function getSubcat(elem) {
  var idCat = elem.value;

  if (idCat == 0) {
    return;
  }
  $('#subCat')[0].disabled = true;
  $('#subCat').load('jobs/getSubcategories', {idCat: idCat}, function() {
    $('#subCat')[0].disabled = false;
  })

}

function find() {
  var selCat    = $('#cat')[0];
  var selSubCat = $('#subCat')[0];
  var minVal    = $('#minVal')[0];
  var maxVal    = $('#maxVal')[0];

  if (selCat.value == 0 ) {
    alert('выберите категорию');
    return;
  }
  data = {};
  data.category = selCat.value;
  data.page = 1;
  if (selSubCat.value != "" && selSubCat.value != "0") {data.subcategory = selSubCat.value}
  if (document.forms[0].minVal.value != '' ) {data.priceMin = minVal.value}
  if (document.forms[0].maxVal.value != '' ) {data.priceMax = maxVal.value}
  data.sortBy = $('input[type="radio"][name="group1"]:checked').val();
  data.count  = $('#count').val();
//  var data = {
//    :    ,
//    subcategory: (selSubCat.value == "") ?
//  }

  data = JSON.stringify(data);

  $('.searchResultShell').load('jobs/find', {params: data}, function() {

  })

}

$(document).ready(function() {
  $('label.js-rb').click(function(e) {
    if (e.target.tagName == 'LABEL') {
      $('.js-rb-sel')[0].classList.remove('js-rb-sel');
      e.target.classList.add("js-rb-sel");
    }



  });
})
