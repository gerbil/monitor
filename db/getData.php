<?php

$meminstance = new Memcache();
$meminstance->pconnect('localhost', 11211);

$ordersCacheTime = 30;
$transactionsCacheTime = 300;

if (isset($_GET['server'])) {$server = $_GET['server']; $server = filter_var($server, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}
if (isset($_GET['interval'])) {$interval = $_GET['interval']; $interval = filter_var($interval, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);}
if (isset($_GET['action'])) {$action = $_GET['action']; $action = filter_var($action, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}

switch ($server) {
	case "avos":
        $user = "provvos9";
		$password = "vosdbpass942";
		$url = "dbp-1.tele2.net/provvos7";
        break;
    case "avk6b1":
        $user = "provavk6";
		$password = "provdbpass642";
		$url = "dbp-1.tele2.net/provvos7";
        break;
    case "hgd0b1":
        $user = "provhgd01";
		$password = "provdbpass042";
		$url = "dbp-1.tele2.net/provvos7";
        break;
    case "hgd0b2":
        $user = "provhgd02";
		$password = "provdbpass042";
		$url = "dbp-1.tele2.net/provvos7";
        break;
	case "kstb1":
        $user = "provkst01";
		$password = "oJFaCddRjSYqa3GD";
		$url = "10.156.150.160/PROVDB";
        break;
    case "hgdb1":
        $user = "provhgd01";
        $password = "ePYg1xDc5AjCShmR";
        $url = "10.156.150.160/PROVDB";
        break;
	case "test":
        $user = "provtest";
		$password = "test";
		$url = "hgd0-devdb-1.tele2.net/captest";
        break;
	case "avostest":
        $user = "avostest";
		$password = "test";
		$url = "hgd0-devdb-1.tele2.net/captest";
        break;
    case "avosnew":
        $user = "provfmob";
        $password = "FJvA158CH3JL0hHw";
        $url = "obelix.corp.tele2.com/PROVDB";
        break;
    case "kstb1test":
        $user = "provtest";
        $password = "test";
        $url = "hawk.corp.tele2.com/provtest";
        break;
}


switch ($action) {
    case "orders":
        $sql = "SELECT row_number() OVER (ORDER BY receipttimestamp) -1, COUNT(receipttimestamp) as count FROM sorecord WHERE receipttimestamp >= SYSDATE - (interval '".$interval."' minute) GROUP BY receipttimestamp ORDER BY receipttimestamp DESC";
        break;
    case "transactions_success":
        $sql = "select count(*) from sotransaction where starttimestamp > (SYSDATE - 1)";		
        break;
	case "transactions_failed":
        $sql = "select count(*) from sotransaction where starttimestamp > (SYSDATE - 1) and slestate != 'SUCCESS'";		
        break;
	case "transactions_mob_success":
        $sql = "select count(a.processid) as result from aeprocess a, aeplan b where a.startdate > (SYSDATE - 1) and a.processstate=3 and a.planid=b.planid and b.processname=('DS_Mobile_Source')";		
        break;
	case "transactions_mob_failed":
        $sql = "select count(a.processid) as result from aeprocess a, aeplan b where a.startdate > (SYSDATE - 1) and a.processstate=4 and a.planid=b.planid and b.processname=('DS_Mobile_Source')";		
        break;
}


$conn = oci_connect($user,$password,$url);

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$querykey = $server . md5($action);
$result =  $meminstance->get($querykey);

if (!$result) {
	$stid = oci_parse($conn, $sql);

	if (!$stid) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if (!$r) {
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	if ($action=="orders") {
		while ($row = oci_fetch_array($stid)) { 
			$result[] = array($row[0], $row[1]); 
		} 
			$meminstance->set($querykey, $result, MEMCACHE_COMPRESSED, $ordersCacheTime);
			echo json_encode($result);
			
	} else {
		while (oci_fetch($stid)) { 
			$result = oci_result($stid,1);
			$meminstance->set($querykey, $result, MEMCACHE_COMPRESSED, $transactionsCacheTime);
			echo json_encode($result); 			
		} 
	}

} else {
	echo json_encode($result); 
}

oci_free_statement($stid);
oci_close($conn);