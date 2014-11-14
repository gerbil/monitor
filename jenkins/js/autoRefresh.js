tests = {};
tests[1] = {
    jobName: 'Mobile provisioning',
    divId: 'MobileALL'
};
tests[2] = {
    jobName: 'Mobile provisioning LV',
    divId: 'MobileLatvia'
};
tests[3] = {
    jobName: 'Mobile provisioning CRO',
    divId: 'MobileCroatia'
};
tests[4] = {
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
                }
            });
        }

        setInterval(getLogs, 10000);
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

        setInterval(getJob, 5000);
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

        setInterval(getJobsList, 5000);
        getJobsList();

    };

    var jobName = tests[test]['jobName'];
    var divId = tests[test]['divId'];

    refresh(jobName, divId);

}
