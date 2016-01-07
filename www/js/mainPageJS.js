jQuery(document).ready(function () {
  function htmSlider(sliderWrap) {
    /* обертка слайдера */
    var slideWrap = sliderWrap;//jQuery('.sliderCnt>div');
    /* ссылки на предудыщий и следующий слайд */
    var sliderTape = sliderWrap.children(".sliderCnt").children();
    var nextLink = sliderWrap.children('.rightSlider');
    var prevLink = sliderWrap.children('.sliderArrow');

    var currentLeftValue = 0;
    var slideWidth = jQuery('.item1').outerWidth() + 8;
    var maximumOffset = -slideWidth * sliderTape.children().length;

    /*  лик по ссылке на следующий слайд */
    nextLink.click(function () {
      if (currentLeftValue >  maximumOffset + 4 * slideWidth) {
        currentLeftValue -= slideWidth;
        sliderTape.animate({marginLeft: currentLeftValue + "px"}, 500);
      }
    });

    /*  лик по ссылке на предыдующий слайд */
    prevLink.click(function () {
      if (currentLeftValue <  0) {
        currentLeftValue += slideWidth;
        sliderTape.animate({marginLeft: currentLeftValue + "px"}, 500);
      }
    });


  }



  htmSlider($('div[data-slider="adverts"]')); // объ€влени€
  htmSlider($('div[data-slider="masters"]')); // мастера
});