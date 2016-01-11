function getSubcat(elem) {
  var idCat = elem.value;

  if (idCat == 0) {
    return;
  }
  $('#subCat')[0].disabled = true;
  $('#subCat').load('/index.php/jobs/getSubcategories', {idCat: idCat}, function() {
    $('#subCat')[0].disabled = false;
  })

}

function find(url) {
  if (url === undefined) { // если нажали на кнопку поиска, а не на пагинацию
    url = '/index.php/jobs/find';
  }
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
//  data.page = 1;
  if (selSubCat.value != "" && selSubCat.value != "0") {data.subcategory = selSubCat.value}
  if (document.forms[0].minVal.value != '' ) {data.priceMin = minVal.value}
  if (document.forms[0].maxVal.value != '' ) {data.priceMax = maxVal.value}
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
})
