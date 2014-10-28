<?php
if (isset($_GET['server'])) {$server = $_GET['server']; $server = filter_var($server, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}
if (isset($_GET['action'])) {$action = $_GET['action']; $action = filter_var($action, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}

$url = 'http://hgd0-test:8080/admin-console/secure/resourceInstanceOperation.seam?selectedOperationName=stop&path=-34&actionMethod=secure%2FresourceInstanceOperation.xhtml%3AoperationAction.invokeOperation%28%29&conversationId=43';

//$postvar = "server=".$server."&action=".$action."";
		
$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
	curl_setopt($ch, CURLOPT_USERPWD, "admin:admin");

$result = curl_exec($ch);

var_dump($result);

curl_close($ch);  