$(document).ready(function() {

  var reEmail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
  var reNameSurn = /^[a-zа-яё-]+(-[a-zа-яё])*$/i;
  document.getElementById("inputEmail").onchange = function () {
    if (!reEmail.test(this.value)) {
      this.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = "некорректный адрес email";
      this.setAttribute('check','false');
      return;
    }
    this.nextElementSibling.innerHTML = '&nbsp;&nbsp;<img src="../img/loaderMini.gif"/>';
    $(this).load('/index.php/registration/check', {'data':this.value}, function(response) {
//    alert(response);
      switch (response){
        case '0': {
          this.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = "";
          this.nextElementSibling.innerHTML = ""; break;
        }
        case '1':{
          this.nextElementSibling.innerHTML = "";
          this.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = "пользователь с таким email уже существует";
          this.setAttribute('check','false');
        }
      }

    })

  }


  /* превалидация формы регистрации нового пользователя */
  document.getElementById("sendBtn").onclick = function() {
    var form = document.forms[0];
    var errorFlag = false;

    //проверяем логин (она же почта)
    if (form.inputEmail.getAttribute('check') == 'false') {
//    return;
      errorFlag = true;
    } else if (!reEmail.test(form.inputEmail.value)){
      form.inputEmail.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML == "введен не адрес эл. почты";
      errorFlag = true;
    }

    //проверяем пароль
    if(form.inputPass.value == "") {
      errorFlag = true;

    }

    //проверяем чекбоксы
    if (form.chbCustomer.checked != true && form.chbEmpl.checked != true) {
      form.chbEmpl.parentElement.nextElementSibling.innerHTML = "нужно выбрать хотябы один пункт";
      errorFlag = true;
    }

    //проверяем фамилию и имя
    if (!reNameSurn.test(form.inputSurname.value) || !reNameSurn.test(form.inputName.value)) {
      form.inputName.parentElement.nextElementSibling.innerHTML = "Имя и Фамилия могут состоять из символов" +
          " русского и англ. алфавита, а также знака тире";
      errorFlag = true;
    }

    if(!errorFlag) {
      //сразу предполагаем что это соискатель
      var typeOfUser = 1;
      if (form.chbEmpl.checked == true && form.chbCustomer.checked == true) {
        typeOfUser = 2;
      } else if (form.chbCustomer.checked == true){
        typeOfUser = 0
      }

      var params = {
        'Login':          form.inputEmail.value,
        'Password' :      form.inputPass.value,
        'user_category' : typeOfUser,
        'Surname'       : form.inputSurname.value,
        'Name'       :    form.inputName.value
      };
      data = {'data':JSON.stringify(params)};
//      paramsJson = JSON.stringify(paramsJson);
      sendRegistrationData(data);

    }

  }


  /* отправка данных на сервер для регистрации */
  function sendRegistrationData(sendData) {
    document.getElementById('sendBtn').innerHTML = 'подождите <img src="../img/loaderMini.png"/>';
    $.ajax({
      method: 'post',
      dataType: "text",
      url: '/index.php/registration/newUser',
      data: sendData,
      success: function(response) {
        document.getElementById('sendBtn').innerHTML = "Зарегистрироваться";
        if (response == '1') {alert("что-то пошло не так"); return;}
        window.location.href = '/';
      }
    });


  }
});


