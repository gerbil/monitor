$('div#jenkinsMobileBuildControl a').live('click', function () {
    $.ajax({
            url: './wp-content/themes/monitor/jenkins/startBuild.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: "",
            cache: false,
            success: function (data) {
            },
            error: function (data) {
            }
        }
    )
    return false
});