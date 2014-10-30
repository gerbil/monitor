$('div#jenkinsMobileBuildControl a.start').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=start",
            success: function (data) {
            },
            error: function (data) {
            }
        }
    )
    return false
});

$('div.jobsList a.stop').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=stop",
            success: function (data) {
            },
            error: function (data) {
            }
        }
    )
    return false
});