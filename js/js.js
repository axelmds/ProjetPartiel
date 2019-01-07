$('.pdt_btn').hide();

$(".product").mouseover(function(){

    $(this).find('.price').hide();
    $(this).find('.pdt_btn').show();

}).mouseleave(function(){

    $(this).find('.price').show();
    $(this).find('.pdt_btn').hide();

});
