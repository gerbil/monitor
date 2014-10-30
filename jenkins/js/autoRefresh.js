var result = false;
function getLogs() {
    $.ajax({
        url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/logsUpdate.php',
        type: "GET",
        data: "",
        async: false,
        success: function(results) {
            result = results;
        }
    });
    return result;
}
function updateLogs() {
    $('div.logs').html(getLogs());
    setTimeout(updateLogs, 3000);
}
updateLogs();


var result = false;
function getJob() {
    $.ajax({
        url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/buildUpdate.php',
        type: "GET",
        data: "",
        async: false,
        success: function(results) {
            result = results;
        }
    });
    return result;
}
function updateJob() {
    $('div.job').html(getJob());
    setTimeout(updateJob, 4000);
}
updateJob();


var result = false;
function getJobsList() {
    $.ajax({
        url: 'http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/jenkins/jobsListUpdate.php',
        type: "GET",
        data: "",
        async: false,
        success: function(results) {
            result = results;
        }
    });
    return result;
}
function updateJobsList() {
    $('div.jobsList').html(getJobsList());
    setTimeout(updateJobsList, 10000);
}
updateJobsList();