/* открыть/закрыть подкатегории на главной */
$('.catItem').hover(function(e){
//  console.log($(this));
  $(this).find('div:last-child').slideToggle();
});


// подача заявки
function subscribeToAdvert() {
  var  f = document.getElementById('subscribeToBidForm');
  f.sendBtn.innerHTML = 'подождите <img src="/img/loaderMini.png"/>';
  /**/
  $(f.parentElement).load('/index.php/acount/subscribeToBid', {advID: f.advID.value}, function(response) {
    console.log(response);
  })
}

function unsubscribeToBid(elem) {
  var bidId = elem.parentElement.bidId.value;
  elem.innerHTML = 'подождите <img src="/img/loaderMini.png"/>';
  $.ajax({
    type: 'POST',
    url : '/index.php/acount/unsubscribeBid',
    data: {'bidId':bidId},
    success: function() {
      window.location.reload();
    }
  })
}

//click advert element in findjob page
function goToAdvert(elem) {
  window.location = '/index.php/jobs/show/' + elem.getAttribute('data-advid');
}

/* insert comment */
function insertComment() {
  var commentText = $('#commentsForm .formText textarea').val();
  if (commentText.trim() == "") {
    alert('введите текст комментария');
    return;
  }
  var pageId = $('#commentsForm input[name="page_id"]').val();

  $('#commentsForm button[name="sendBtn"]')[0].innerHTML = 'подождите <img src="/img/loaderMini.png"/>';
  /**/
  $.ajax({
    type: 'POST',
    url : '/index.php/jobs/addComment',
    data: {
      'commentText':commentText,
      'pageId': pageId
    },
    success: function(response) {
      var commentsShell = $('#commentsShell')[0];
      commentsShell.innerHTML = response + commentsShell.innerHTML;
      $('#commentsForm button[name="sendBtn"]')[0].innerHTML = 'Добавить';
      commentText.value = "";
    }
  })

  //console.log(pageId);
}