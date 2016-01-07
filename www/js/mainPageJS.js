jQuery(document).ready(function () {
  function htmSlider(sliderWrap) {
    /* ������� �������� */
    var slideWrap = sliderWrap;//jQuery('.sliderCnt>div');
    /* ������ �� ���������� � ��������� ����� */
    var sliderTape = sliderWrap.children(".sliderCnt").children();
    var nextLink = sliderWrap.children('.rightSlider');
    var prevLink = sliderWrap.children('.sliderArrow');

    var currentLeftValue = 0;
    var slideWidth = jQuery('.item1').outerWidth() + 8;
    var maximumOffset = -slideWidth * sliderTape.children().length;

    /* ���� �� ������ �� ��������� ����� */
    nextLink.click(function () {
      if (currentLeftValue >  maximumOffset + 4 * slideWidth) {
        currentLeftValue -= slideWidth;
        sliderTape.animate({marginLeft: currentLeftValue + "px"}, 500);
      }
    });

    /* ���� �� ������ �� ����������� ����� */
    prevLink.click(function () {
      if (currentLeftValue <  0) {
        currentLeftValue += slideWidth;
        sliderTape.animate({marginLeft: currentLeftValue + "px"}, 500);
      }
    });


  }



  htmSlider($('div[data-slider="adverts"]')); // ����������
  htmSlider($('div[data-slider="masters"]')); // �������
});