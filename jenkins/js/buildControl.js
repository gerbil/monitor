$('a.start').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: 'command=start&jobName=' + this.name,
            success: function (data) {
                $('.info').show();
                if (data) {
                    $('.info').html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> Build started.</div>');
                } else {
                    $('.info').html('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Build start failed.</div>');
                }
                $('.info').fadeOut(3000);
            },
            error: function (data) {
                console.log(data);
            }
        }
    );
    return false
});

$('a.stop').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: 'command=stop&jobName=' + this.name,
            success: function (data) {
                $('.info').show();
                if (data) {
                    $('.info').html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> Build stopped.</div>');
                } else {
                    $('.info').html('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Build stop failed.</div>')
                }
                $('.info').fadeOut(3000);
            },
            error: function (data) {
                console.log(data);
            }
        }
    );
    return false
});