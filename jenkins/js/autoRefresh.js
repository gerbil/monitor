tests = {};
tests[1] = {
    jobName: 'Mobile%20provisioning',
    divId: 'MobileAll'
};
tests[2] = {
    jobName: 'Mobile%20provisioning%20LV',
    divId: 'MobileLV'
};

for (var test in tests) {

    function refresh(jobName,divId) {
        function getLogs() {
            $.ajax({
                url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/logsUpdate.php',
                type: "GET",
                data: {"jobName": jobName},
                /*async: false,*/
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
                /*async: false,*/
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
                /*async: false,*/
                success: function (results) {
                    $('div#' + divId + ' div.jobsList').html(results);
                }
            });
        }

        setInterval(getJobsList, 10000);
        getJobsList();

    };

    var jobName = tests[test]['jobName'];
    var divId = tests[test]['divId'];

    refresh(jobName, divId);

}
