/************************************************************************************ Main monitors refresh rate */
updateInterval = 90000;

/************************************************************************************ Alarms refresh rate */
alarmUpdateInterval = 90000;

/************************************************************************************ Dates for clock & releases */
release = "2014-11-11T00:00:00+03:00"; //Specially for firefox
releaseDate = new Date(release); //Release date full

release = "2014-11-11 00:00:00"; //Human readable again for pages
/************************************************************************************ Configuration for db queries */
interval_test = 240; // 120 mins = +2 HRS GMTs
interval_cluster = 121; // 1 min really

/************************************************************************************ Release date untill function */
timeLeft = releaseDate.getTime() - Date.now();

daysLeft = Math.floor(timeLeft / 86400000); // For monitors

function dhm(t){
    var cd = 24 * 60 * 60 * 1000,
        ch = 60 * 60 * 1000,
        d = Math.floor(t / cd),
        h = '0' + Math.floor( (t - d * cd) / ch),
        m = '0' + Math.round( (t - d * cd - h * ch) / 60000);
    return [d, h.substr(-2), m.substr(-2)].join(':');
}
