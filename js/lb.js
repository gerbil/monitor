// LB ACTIONS
var lbUrl = "http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/db/lb.php";
var result = 0;

function getLBStatus(server) {
	$.ajax({
		url : lbUrl,
		type : "GET",
		async : false,
		data : "action=status&server=" + server,
		success : function (results) {
			result = results;
		}
	});
	return result;
}

//Refresh for index page
function update() {
	$('#avk6-provident-f1').html(getLBStatus('avk6-provident-f1.tele2.net'));
	$('#hgd0-provident-f1').html(getLBStatus('hgd0-provident-f1.tele2.net'));
    $('#hgd0-provident-f2').html(getLBStatus('hgd0-provident-f2.tele2.net'));

	$('#kst-prov-f1').html(getLBStatus('kst-prov-f1'));
	$('#hgd-prov-f1').html(getLBStatus('hgd-prov-f1'));

    $('#kst-prov-f2').html(getLBStatus('kst-prov-f2'));
    $('#kst-prov-f3').html(getLBStatus('kst-prov-f3'));
    $('#hgd-prov-f2').html(getLBStatus('hgd-prov-f2'));
    $('#hgd-prov-f3').html(getLBStatus('hgd-prov-f3'));
	
	$('#avk6-provident-f1 a, #hgd0-provident-f1 a , #hgd0-provident-f2 a, #kst-prov-f1 a, #hgd-prov-f1 a, #kst-prov-f2 a, #kst-prov-f3 a, #hgd-prov-f2 a, #hgd-prov-f3 a').attr('style', 'padding: 56px !important;');

	setTimeout(update, updateInterval);
}
update();

// LB RESTORE/REMOVE ACTIONS
$('a.lbRemove').live('click', (function () {
		var server = $(this).attr('id');

		if (confirm("Are you sure?")) {

			$.ajax({
				url : lbUrl,
				type : "POST",
				async : false,
				data : "action=remove&server=" + server,
				success : function (results) {
					result = results;
				}
			});

			if (result == 'ok') {
				$('#' + server).html(getLBStatus(server));
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> LB status updated.</div>');
				$('#main_container div.alert').fadeOut(6000);
			} else {
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in update.</div>');
				$('#main_container div.alert').fadeOut(6000);
			}

		} else {
			e.preventDefault();
		}
		
		return false;
}));

$('a.lbRestore').live('click', (function () {
		var server = $(this).attr('id');

		if (confirm("Are you sure?")) {

			$.ajax({
				url : lbUrl,
				type : "POST",
				async : false,
				data : "action=restore&server=" + server,
				success : function (results) {
					result = results;
				}
			});

			if (result == 'ok') {
				$('#' + server).html(getLBStatus(server));
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> LB status updated.</div>');
				$('#main_container div.alert').fadeOut(6000);
			} else {
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in update.</div>');
				$('#main_container div.alert').fadeOut(6000);
			}

		} else {
			e.preventDefault();
		}

		return false;
}));
