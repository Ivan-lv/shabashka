/* �������/������� ������������ �� ������� */
$('.catItem').hover(function(e){
//  console.log($(this));
  $(this).find('div:last-child').slideToggle();
});