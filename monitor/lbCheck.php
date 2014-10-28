<?php
//Can't check cause firewall closed to 91,90,89..
include 'simple_html_dom.php';

if (isset($_GET['server'])) {$server = $_GET['server']; $server = filter_var($server, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}
if (isset($_GET['action'])) {$action = $_GET['action']; $action = filter_var($action, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);}

switch ($server) {
    case "avk6b1":
        $url = "provavk6";
        break;
    case "hgd0b1":
		$url = "dbp-1.tele2.net/provvos7";
        break;
    case "hgd0b2":
		$url = "http://90.130.71.91:8080/admin-console/secure/summary.seam?path=-3%2FApplications%2FWeb+Application+%28WAR%29";
        break;
	case "test":
		$url = "http://90.131.20.70:8080/admin-console/secure/summary.seam?path=-3%2FApplications%2FWeb+Application+%28WAR%29";
        break;
}


function request($url,$post = 0){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url ); // отправляем на 
    curl_setopt($ch, CURLOPT_HEADER, 0); // пустые заголовки
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвратить то что вернул сервер
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);// таймаут4
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt'); // сохранять куки в файл 
    curl_setopt($ch, CURLOPT_COOKIEFILE,  dirname(__FILE__).'/cookie.txt');
    curl_setopt($ch, CURLOPT_POST, $post!==0 ); // использовать данные в post
		
    if($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}	
	
//$url = 'http://90.130.71.91:8080/admin-console/';
$data = request($url);
$data = str_get_html($data);
$auth = array(
        'login_form'=>'login_form',
		'login_form:name'=>'admin',
		'login_form:password'=>'admin',
		'login_form:submit'=>'Login',
        'javax.faces.ViewState'=>$data->find('input[name="javax.faces.ViewState"]',0)->value,
);
$data->clear();
unset($data);

$response = request($url,$auth);

$html = str_get_html($response);

$doc = new DOMDocument();
$doc->loadHTML($html);
//echo $doc->getElementById('resourceSummaryForm:dataTable:2:availability')->nodeValue;
echo $html;