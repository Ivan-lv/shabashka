/* открыть/закрыть подкатегории на главной */
$('.catItem').hover(function(e){
//  console.log($(this));
  $(this).find('div:last-child').slideToggle();
});