$(function() {

    var url = "http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/db/alarms.php";
    var result = 0;

    function getAlarms(server) {
        $.ajax({
            url: url,
            type: "GET",
            async: false,
            data: "action=get&server=" + server,
            success: function(results) {
                result = results;
            }
        });
        return result;
    }

    function getOneAlarm(server, id) {
        $.ajax({
            type: "GET",
            async: false,
            data: "action=getone&server=" + server + "&id=" + id,
            url: url,
            success: function(results) {
                result = results;
            }
        });

        return result;
    }

    function updateOneAlarm(server, id) {
        data = $("#info-alarm form").serialize();
        $.ajax({
            type: "POST",
            async: false,
            data: "action=updateone&server=" + server + "&id=" + id + "&" + data,
            url: url,
            success: function(results) {
                result = results;
            }
        });

        if (result == 'ok') {
            $('#info-alarm').html(getOneAlarm(server, id));
            $('#' + server).html(getAlarms(server));

            $('#info-alarm div.alert').remove();
            $('#info-alarm').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> Alarm updated.</div>');
            $('#info-alarm div.alert').fadeOut(3000);
        } else {
            $('#info-alarm div.alert').remove();
            $('#info-alarm').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in update.</div>');
            $('#info-alarm div.alert').fadeOut(3000);
        }

        return result;
    }


    function deleteOneAlarm(server, id) {
        $.ajax({
            type: "POST",
            async: false,
            data: "action=deleteone&server=" + server + "&id=" + id,
            url: url,
            success: function(results) {
                result = results;
            }
        });

        if (result === 'ok') {
            $('#' + server).html(getAlarms(server));
            $('#main_container div.alert').remove();
            $('#main_container').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> Alarm removed.</div>');
            $('#main_container div.alert').fadeOut(3000);
            $('#info-alarm').trigger('reveal:close');
        } else {
            $('#main_container div.alert').remove();
            $('#main_container').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in remove.</div>');
            $('#main_container div.alert').fadeOut(3000);
        }

        return result;
    }

    function getAddOneAlarm(server, id) {
        $.ajax({
            type: "GET",
            async: false,
            data: "action=getaddone&server=" + server,
            url: url,
            success: function(results) {
                result = results;
            }
        });
        return result;
    }

    function addOneAlarm(server) {
        data = $("#info-alarm form").serialize();
        $.ajax({
            type: "POST",
            async: false,
            data: "action=addone&server=" + server + "&" + data,
            url: url,
            success: function(results) {
                result = results;
            }
        });

        if (result === 'ok') {
            $('#' + server).html(getAlarms(server));
            $('#info-alarm div.alert').remove();
            $('#info-alarm').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> Alarm added.</div>');
            $('#info-alarm div.alert').fadeOut(3000);
            //$('#info-alarm').trigger('reveal:close');
        } else {
            $('#info-alarm div.alert').remove();
            $('#info-alarm').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> ALL fields are mandatory!</div>');
            $('#info-alarm div.alert').fadeOut(3000);
        }

        return result;
    }

    // On table tr click find alarm server and alarm id -> get one alarm func
    $('table.alarms tr.alarm').live('click', (function() {

        var server = $(this).parents().eq(2).find('table').attr('id');
        var id = $(this).find('a').attr('href');

        alarmInfo = getOneAlarm(server, id);

        $('#info-alarm').html(alarmInfo);

        $('#info-alarm').reveal({
            animation: 'fadeAndPop', //fade, fadeAndPop, none
            animationspeed: 300, //how fast animtions are
            closeonbackgroundclick: true, //if you click background will modal close?
            dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
        });

        $('#info-alarm a.close-reveal-modal').live('click', (function() {
            $('#info-alarm').trigger('reveal:close');
        }));

    }));

    // On alarm ADD for button click add new alarm
    $('table.alarms tr.addAlarm').live('click', (function() {
        var server = $(this).parents().eq(2).find('table').attr('id');
        alarmInfo = getAddOneAlarm(server);

        $('#info-alarm').html(alarmInfo);

        $('#info-alarm').reveal({
            animation: 'fadeAndPop', //fade, fadeAndPop, none
            animationspeed: 300, //how fast animtions are
            closeonbackgroundclick: true, //if you click background will modal close?
            dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
        });

        $('#info-alarm a.close-reveal-modal').live('click', (function() {
            $('#info-alarm').trigger('reveal:close');
        }));

    }));

    // On alarm ADD for button inside alarm info click add new alarm
    $('#info-alarm button.add').live('click', (function() {
        var server = $(this).parents().eq(2).attr('action');
        addOneAlarm(server);
        return false;
    }));

    // On alarm UPDATE for button click update current alarm
    $('#info-alarm button.update').live('click', (function() {
        var server = $(this).parents().eq(2).attr('action');
        var id = $(this).parents().eq(2).attr('id');
        updateOneAlarm(server, id);
        return false;
    }));

    // On alarm DELETE for button click delete current alarm
    $('#info-alarm button.delete').live('click', (function() {
        var server = $(this).parents().eq(2).attr('action');
        var id = $(this).parents().eq(2).attr('id');
        if (confirm("Are you sure?")) {
            deleteOneAlarm(server, id);
        } else {
            e.preventDefault();
        }
        return false;
    }));

    // Page title changer from Vitalij_S_Novogo_Goda
    var message = new Array();
    var currMessage = 1;
    var curTitle = document.title;
    var changerTimer = 0;
    message[1] = "*** ALARM ***";
    message[2] = "... ALARM ...";
    function changer() {
        document.title = (message[currMessage++]);
        changerTimer = setTimeout(changer, 500);
        currMessage = ((currMessage >= message.length) ? 1 : currMessage);
    }

    // Get all alarms and set update refresh rate from config.js
    function updateAlarms() {
        $('#avos').html(getAlarms('avos'));
        $('#avk6b1').html(getAlarms('avk6b1'));
        $('#hgd0b1').html(getAlarms('hgd0b1'));
        $('#hgd0b2').html(getAlarms('hgd0b2'));
		$('#kstb1').html(getAlarms('kstb1'));
		$('#hgdb1').html(getAlarms('hgdb1'));
		$('#f-other').html(getAlarms('f-other'));
		$('#f-mobile').html(getAlarms('f-mobile'));
        $('#test').html(getAlarms('test'));
		$('#avostest').html(getAlarms('avostest'));

        if ($('table.alarms tr').hasClass('ALARM')) {
            changer();
            $('table.alarms tr.ALARM').css('background-color', 'red');
			/*
			$('.alert').remove();
            $('table.alarms tr.ALARM').each(function() {
                $('#main_container').prepend('<div class="alert alert-error alert-large"><a class="close" data-dismiss="alert">×</a><strong>Alarm!</strong> ' + $(this).text() + '</div>');
            });*/
        } else {
            $('.alert').remove();
            clearTimeout(changerTimer); // stop title changer
            document.title = curTitle; // restore page title
        }

        setTimeout(updateAlarms, alarmUpdateInterval);
    }
    updateAlarms();



});