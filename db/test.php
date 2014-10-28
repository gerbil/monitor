<?php

$user = "provavk6";
$password = "provdbpass642";
$url = "dbp-1.tele2.net/provvos7";

$sql = "SELECT utl_raw.cast_to_varchar2(dbms_lob.substr(soresponsedata,2000,1)) FROM SORECORD S, SORESPONSE SR WHERE SR.SOID = S.SOID AND S.TRANSACTIONID='1002396501'";

$conn = oci_new_connect($user, $password, $url);
$stid = oci_parse($conn, $sql);
oci_execute($stid);
$result = oci_fetch_array($stid);
var_dump($result);
oci_free_statement($stid);
oci_close($conn);

$stomp = new Stomp('tcp://localhost:61613');