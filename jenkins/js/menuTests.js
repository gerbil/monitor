$('.menuTests a.link').live('click', function () {
    $('.menuTests a.link').removeClass('active');
    $(this).addClass('active');
    $('.span7').hide();
    $('#Mobile'+this.text).show();
    //console.log('#Mobile'+this.text);
});