function tabActiveStatus(){
    var li = $(".tabsNav li");
li.each(function(idx, li) {
    $(li).removeClass('is-active');
});
}



$('.tabsNav li').click(function(){
tabActiveStatus();
$(this ).toggleClass('is-active');
});