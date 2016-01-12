/*
* 3 следующих функции используются на странице доб./ред. заказа
* */
function checkAdvertData() {
  var errArr = [];

  if (!/[A-zА-ЯЁа-яё\-\_]+/i.test($('#advText').val())) {
    errArr.push('текст объявления');
  }

  if (!/[A-zА-ЯЁа-яё\-\_]+/i.test($('#advTitle').val())) {
    errArr.push('заголовок объявления');
  }

  if (!/\d+/.test($('#advPrice').val())) {
    errArr.push('цена объявления');
  }

  return errArr;
}

function getDataFromForm() {
  var idSubcat = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for(var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked == true) {
      var idCat = checkboxes[i].getAttribute('idCat');
      idSubcat.push({idSubcat: checkboxes[i].value, idCat: idCat});
    }
  }
  var data = {
    title: $('#advTitle').val(),
    price: $('#advPrice').val(),
    text:  $('#advText').val(),
    id:    $('h3')[0].getAttribute('idOrd'),
    ids:   idSubcat
  };
  return data;
}

function sendAdvData() {
  var errors = checkAdvertData();
  if (errors.length > 0) {
    alert('введена некорректная информация в поля: ' + errors.join(', '))
    return;
  }

  var data = getDataFromForm();
  var sendData = JSON.stringify(data);
//  console.log(data);
//  console.log(sendData);
  document.getElementsByTagName('button')[0].innerHTML = 'подождите <img src="/img/loaderMini.png"/>';

  $.ajax({
    method: 'post',
    dataType: "text",
    url: '/index.php/acount/newAdvert',
    data: {data:sendData, op: $('h3')[0].getAttribute('variant')},
    success: function(response) {
      document.getElementsByTagName('button')[0].innerHTML = "Сохранить";
//      console.log(response);
      if (response != '0') {alert("что-то пошло не так"); return;}
      window.location.href = '/index.php/acount';
    }
  });
}


/*
* дальше функции используются на странице редактировать карточку
* */

function getDataFromForm2() {
  var idSubcat = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for(var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked == true) {
      var idCat = checkboxes[i].getAttribute('idCat');
      idSubcat.push({idSubcat: checkboxes[i].value, idCat: idCat});
    }
  }
  var textAboutMe = $('#aboutMe').val();
  var data = {
    text: (textAboutMe == "") ? '' : textAboutMe,
    ids:   idSubcat
  };
  return data;
}

function sendUserData() {
  var data = getDataFromForm2();
  var sendData = JSON.stringify(data);
//  console.log(data);
//  console.log(sendData);
  document.getElementsByTagName('button')[0].innerHTML = 'подождите <img src="/img/loaderMini.png"/>';

  $.ajax({
    method: 'post',
    dataType: "text",
    url: '/index.php/acount/updateCard',
    data: {data:sendData},
    success: function(response) {
      document.getElementsByTagName('button')[0].innerHTML = "Сохранить";
//      console.log(response);
      if (response != '0') {alert("что-то пошло не так"); return;}
      window.location.href = '/index.php/acount';
    }
  });
}