// TODO: Если джоб бежит - делать пометку running и крутить скролл вниз пока running, потом снимать running и скролл не трогать

tests = {};
tests[1] = {
    jobName: 'Mobile provisioning',
    divId: 'MobileALL'
};
tests[2] = {
    jobName: 'Mobile provisioning SWE',
    divId: 'MobileSweden'
};
tests[3] = {
    jobName: 'Mobile provisioning LV',
    divId: 'MobileLatvia'
};
tests[4] = {
    jobName: 'Mobile provisioning CRO',
    divId: 'MobileCroatia'
};
tests[5] = {
    jobName: 'Mobile provisioning NL',
    divId: 'MobileNetherlands'
};

for (var test in tests) {

    function refresh(jobName,divId) {
        function getLogs() {
            $.ajax({
                url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/logsUpdate.php',
                type: "GET",
                data: {"jobName": jobName},
                success: function (results) {
                    $('div#' + divId + ' div.logs').html(results);
                    if ($('div#' + divId + ' > div.row-fluid.fluid > div.jobsList > div:nth-child(1) > div.inProgress').length) {
                        $('div#' + divId + ' div.logs').animate({scrollTop: 99999999}, 10);
                    }
                }
            });
        }

        setInterval(getLogs, 1000);
        getLogs();

        function getJob() {
            $.ajax({
                url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/buildUpdate.php',
                type: "GET",
                data: {"jobName": jobName},
                success: function (results) {
                    $('div#' + divId + ' div.job').html(results);
                }
            });
        }

        setInterval(getJob, 25000);
        getJob();

        function getJobsList() {
            $.ajax({
                url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/buildsListUpdate.php',
                type: "GET",
                data: {"jobName": jobName},
                success: function (results) {
                    $('div#' + divId + ' div.jobsList').html(results);
                }
            });
        }

        setInterval(getJobsList, 3000);
        getJobsList();

    };

    var jobName = tests[test]['jobName'];
    var divId = tests[test]['divId'];

    refresh(jobName, divId);

}
