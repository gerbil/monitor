$('div.MobileAll a').live('click', function () {
    $('div#MobileLV').hide();
    $('div.MobileLV a').removeClass('active');
    $('div#MobileNL').hide();
    $('div.MobileNL a').removeClass('active');
    $('div#MobileCRO').hide();
    $('div.MobileCRO a').removeClass('active');
    $('div#MobileAll').show();
    $('div.MobileAll a').addClass('active');
    return false;
});

$('div.MobileLV a').live('click', function () {
    $('div#MobileLV').show();
    $('div.MobileLV a').addClass('active');
    $('div#MobileNL').hide();
    $('div.MobileNL a').removeClass('active');
    $('div#MobileCRO').hide();
    $('div.MobileCRO a').removeClass('active');
    $('div#MobileAll').hide();
    $('div.MobileAll a').removeClass('active');
    return false;
});
