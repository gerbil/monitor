// FlipClock init
$(function(){
	$('#counter').countdown({
		image: '/monitor/wp-content/themes/monitor/js/plugins/countdown/digits.png',
		startTime: dhm(timeLeft)+':60' //dhm function
	});
});