$('div#MobileAll a.start').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=start&jobName=Mobile%20provisioning",
            success: function (data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        }
    )
    return false
});

$('div#MobileAll div.jobsList a.stop').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=stop&jobName=Mobile%20provisioning",
            success: function (data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        }
    )
    return false
});

$('div#MobileLV a.start').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=start&jobName=Mobile%20provisioning%20LV",
            success: function (data) {
            },
            error: function (data) {
            }
        }
    )
    return false
});

$('div#MobileLV div.jobsList a.stop').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/buildControl.php',
            type: 'POST',
            data: "command=stop&jobName=Mobile%20provisioning%20LV",
            success: function (data) {
            },
            error: function (data) {
            }
        }
    )
    return false
});