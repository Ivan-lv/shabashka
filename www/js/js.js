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