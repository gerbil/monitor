<?php
error_reporting(1);

if (isset($_REQUEST['action'])) { $action = $_REQUEST['action']; }; $action = filter_var($action, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if (isset($_REQUEST['server'])) {	$server = $_REQUEST['server']; }; $server = filter_var($server, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if (isset($_REQUEST['id'])) { $id = $_REQUEST['id']; }; $id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	

if (isset($_REQUEST['envname'])) { $envname = $_REQUEST['envname']; }; $envname = filter_var($envname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['checkname'])) { $checkname = $_REQUEST['checkname']; }; $checkname = filter_var($checkname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['description'])) { $description = $_REQUEST['description']; }; $description = filter_var($description, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['status'])) { $status = $_REQUEST['status']; }; $status = filter_var($status, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['curvalue'])) { $curvalue = $_REQUEST['curvalue']; }; $curvalue = filter_var($curvalue, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['vallimit'])) { $vallimit = $_REQUEST['vallimit']; }; $vallimit = filter_var($vallimit, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['limitmark'])) { $limitmark = $_REQUEST['limitmark']; }; $limitmark = filter_var($limitmark, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['sqlscript'])) { $sqlscript = $_REQUEST['sqlscript']; }; //$sqlscript = filter_var($sqlscript, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['active'])) { $active = $_REQUEST['active']; }; $active = filter_var($active, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['sendto'])) { $sendto = $_REQUEST['sendto']; }; $sendto = filter_var($sendto, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['alarmtype'])) { $alarmtype = $_REQUEST['alarmtype']; }; $alarmtype = filter_var($alarmtype, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['starttime'])) { $starttime = $_REQUEST['starttime']; }; $starttime = filter_var($starttime, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	
if (isset($_REQUEST['endtime'])) { $endtime = $_REQUEST['endtime']; }; $endtime = filter_var($endtime, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);	

switch ($action) {
	case "get":
		$alarms = new alarmResults($server);
		echo $alarms->getTable();
		break;
	case "getone":	
		$alarm = new alarmResults($server);
		echo $alarm->getForm($id);
		break; 
	case "getaddone":	
		$alarm = new alarmResults($server);
		echo $alarm->getAddForm();
		break; 
	case "addone":	
		$alarm = new alarmResults($server);
		echo $alarm->addOneAlarm($checkname,$envname,$description,$status,$curvalue,$vallimit,$limitmark,$sqlscript,$active,$sendto,$alarmtype,$starttime,$endtime);
		break; 
	case "updateone":			
		$alarm = new alarmResults($server);
		echo $alarm->updateAlarm($id,$envname,$checkname,$description,$status,$curvalue,$vallimit,$limitmark,$sqlscript,$active,$sendto,$alarmtype,$starttime,$endtime);
		break;
	case "deleteone":
		$alarm = new alarmResults($server);
		echo $alarm->deleteAlarm($id);
		break;
}


class alarmResults {		

	private $statusOk = '<i class="icon-ok-circle medium green"></i>';
	private $statusNotOk = '<i class="icon-minus-sign medium red"></i>';
	private $activeYes = '<i class="icon-ok medium white"></i>';
	private $activeNo = '<i class="icon-remove medium white"></i>';
	
	private $user;
	private $password;
	private $url;
	private $getAlarmsSql;
	private $getAlarmSql;
	private $deleteSql;
	private $addSql;
	
	private $server;
	private $alarms;
	
	public function __construct($server) {
		$this->server = $server;
		$this->getAlarmSql = "select * from providentmonitor where id=:id";
		$this->getAlarmsSql = "select * from providentmonitor order by checkname";
		$this->getUpdateSql = "update providentmonitor set envname=:envname, checkname=:checkname, description=:description, status=:status, curvalue=:curvalue, vallimit=:vallimit, limitmark=:limitmark, sqlscript=:sqlscript, active=:active, sendto=:sendto, alarmtype=:alarmtype, start_time=:starttime, end_time=:endtime where id=:id";
		$this->deleteSql = "delete from providentmonitor where id=:id";
		$this->addSql = "insert into providentmonitor values (:id, :envname, :checkname, :description, :status, :curvalue, :vallimit, :limitmark, :sqlscript, :active, :sendto, :alarmtype, :starttime, :endtime)";
		//$this->addSql = "insert into providentmonitor values (5, 'test', 'test', 'test', 'OK', 1, 2, 'test', 'test', 'NO', 'test', 'test', 'test', 'test')";
	
		switch ($this->server) {
			case "avos":
				$this->user = "provvos9";
				$this->password = "vosdbpass942";
				$this->url = "dbp-1.tele2.net/provvos7";
				break;
			case "avk6b1":
				$this->user = "provavk6";
				$this->password = "provdbpass642";
				$this->url = "dbp-1.tele2.net/provvos7";
				break;
			case "hgd0b1":
				$this->user = "provhgd01";
				$this->password = "provdbpass042";
				$this->url = "dbp-1.tele2.net/provvos7";
				break;
			case "hgdb1":
				$this->user = "provhgd01";
				$this->password = "ePYg1xDc5AjCShmR";
				$this->url = "10.156.150.160/PROVDB";
				break;
			case "hgd0b2":
				$this->user = "provhgd02";
				$this->password = "provdbpass042";
				$this->url = "dbp-1.tele2.net/provvos7";
				break;
			case "kstb1":
				$this->user = "provkst01";
				$this->password = "oJFaCddRjSYqa3GD";
				$this->url = "10.156.150.160/PROVDB";
				break;
			case "f-other":
				$this->user = "provfother";
				$this->password = "Tv5eVaaTL3T0wF9e";
				$this->url = "10.156.150.160/PROVDB";
				break;
			case "f-mobile":
				$this->user = "provfmobile";
				$this->password = "LjgJDhsGJnSqmCkp";
				$this->url = "10.156.150.160/PROVDB";
				break;
			case "test":
				$this->user = "provtest";
				$this->password = "test";
				$this->url = "hgd0-devdb-1.tele2.net/captest";
				break;
			case "vostest":
				$this->user = "vostest";
				$this->password = "test";
				$this->url = "hawk.corp.tele2.com/provtest";
				break;
            case "kstb2":
                $this->user = "provkst02";
                $this->password = "e2uPxreNbchUO80J";
                $this->url = "10.156.150.160/PROVDB";
                break;
            case "kstb3":
                $this->user = "provkst03";
                $this->password =  "x7du8shQcMbFpmm1";
                $this->url = "10.156.150.160/PROVDB";
                break;
            case "provhgd02":
                $this->user = "provhgd02";
                $this->password = "fQVEQLPjy8InVexu";
                $this->url = "10.156.150.160/PROVDB";
                break;
            case "provhgd03":
                $this->user = "provhgd03";
                $this->password = "RFMkcPynUUktLGcv";
                $this->url = "10.156.150.160/PROVDB";
                break;
            case "avosnew":
                $this->user = "provfmob";
                $this->password = "FJvA158CH3JL0hHw";
                $this->url = "obelix.corp.tele2.com/PROVDB";
                break;
            case "kstb1test":
                $this->user = "provtest";
                $this->password = "test";
                $this->url = "hawk.corp.tele2.com/provtest";
                break;
		}


	}
	
	public function getTable() {	

		$alarms = $this->getAlarms();
        $table = '';
		$table .= '<table id="'.$this->server.'" class="table table-striped table-bordered table-condensed table-hover alarms"><thead><tr><th>Name</th><th class="center">Active</th><th class="center">Status</th><th>Limit</th></tr></thead>';						
			foreach($alarms as $alarm=>$value) {	
				
				if ($value['STATUS']=="OK") { $status = $this->statusOk; } else { $status = $this->statusNotOk; };
				if ($value['ACTIVE']=="YES") { $active = $this->activeYes; } else { $active = $this->activeNo; };
				if (($value["STATUS"]=="ALARM") && ($value["ACTIVE"]=='YES')) { $alarmStatus = "ALARM"; }  else { $alarmStatus = ""; };
				
				$id = $value["ID"];	
				$alarmType = $value["ALARMTYPE"];
				$curValue = $value["CURVALUE"];
				$curLimit = $value["VALLIMIT"];	
					
				if ($alarmType == "LIMITUP") {					
									
					$curPercent = ($curValue/$curLimit)*100;
					
					if ($curPercent > 40 && $curPercent < 80) { $barStatus = 'progress-info'; } 
					elseif ($curPercent > 80) { $barStatus = 'progress-warning'; }
					elseif ($curPercent >= 100) { $barStatus = 'progress-danger'; }
					else { $barStatus = ''; };
				}
				else {
					$curPercent = 0;
				}
	
				$table .= '<tr class="'.$alarmStatus.' alarm"><td><a href="'.$id.'"></a>'.$value["CHECKNAME"].'</td><td class="center">'.$active.'</td><td class="center">'.$status.'</td><td><div class="progress alarmBar '.$barStatus.'" title="'.$curValue.' / '.$curLimit.'"><div class="bar" style="width: '.$curPercent.'%;"></div></div></td></tr>';
			}
			$table .= '<tr class="addAlarm"><td>Add new alarm</td><td class="center"></td><td class="center"></td><td class="center"><i class="icon-plus-sign medium white"></i></td></tr>';
			$table .= '</table>';		
			
			
		return $table;
	}
	
	public function getForm($id) {
		$alarm = $this->getAlarm($id);
		
		if ($alarm["ACTIVE"] == "YES") {$alarmActiveOptions = '<option>YES</option><option>NO</option>'; } else {$alarmActiveOptions = '<option>NO</option><option>YES</option>'; };
		if ($alarm["ALARMTYPE"] == "LIMITUP") {$alarmTypeOptions = '<option>LIMITUP</option><option>LIMITDOWN</option>'; } else {$alarmTypeOptions = '<option>LIMITDOWN</option><option>LIMITUP</option>'; };
		if ($alarm["STATUS"] == "OK") {$statusOptions = '<option>OK</option><option>ALARM</option>'; } else {$statusOptions = '<option>ALARM</option><option>OK</option>'; };
		

		$form = '<h1>'.$alarm["CHECKNAME"].'</h1>';
		$form .= '<form class="form-horizontal" action="'.$this->server.'" id="'.$id.'">
					  <div class="control-group">
						<label class="control-label" for="checkname">Alarm name</label>
						<div class="controls">
							<textarea rows="1" class="field span9" name="checkname">'.$alarm["CHECKNAME"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="envname">Env name</label>
						<div class="controls">
							<textarea rows="1" class="field span9" name="envname">'.$alarm["ENVNAME"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="description">Alarm desc</label>
						<div class="controls">
						  <textarea rows="3" class="field span9" name="description">'.$alarm["DESCRIPTION"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="curvalue">Current value</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="curvalue">'.$alarm["CURVALUE"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="vallimit">Value limit</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="vallimit">'.$alarm["VALLIMIT"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="limitmark">Limit mark</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="limitmark">'.$alarm["LIMITMARK"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
						  <select id="status" name="status" class="field span2">'.$statusOptions.'</select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="sqlscript">SQL</label>
						<div class="controls">
							<textarea rows="6" class="field span9" name="sqlscript">'.$alarm["SQLSCRIPT"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="active">Active</label>
						<div class="controls">
						  <select id="active" name="active"  class="field span2">'.$alarmActiveOptions.'</select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="sendto">Send to</label>
						<div class="controls">
						  <textarea rows="1" class="field span4" name="sendto">'.$alarm["SENDTO"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="alarmtype">Alarm type</label>
						<div class="controls">
						  <select id="alarmtype" name="alarmtype" class="field span2">'.$alarmTypeOptions.'</select>
						</div>
					  </div>	
					  <div class="control-group">
						<label class="control-label" for="starttime">Start time</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="starttime">'.$alarm["START_TIME"].'</textarea>
						</div>
					  </div>	
					  <div class="control-group">
						<label class="control-label" for="endtime">End time</label>
						<div class="controls">
						  	<textarea rows="1" class="field span2" name="endtime">'.$alarm["END_TIME"].'</textarea>
						</div>
					  </div>
					  <div class="control-group">
						<div class="controls">
							<button type="submit" name="update" class="btn pull-right btn-success update">Update</button>
							<button type="delete" name="delete" class="btn pull-right btn-danger delete">Delete</button>
						</div>
					  </div>					  
				  </form>';
		$form .= '<a class="close-reveal-modal">&#215;</a>';
		return $form;
		
	}

	
	public function getAlarms() {		

		$conn = oci_connect($this->user,$this->password,$this->url);		
		
		if (!$conn) {
			$e = oci_error();
			//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			echo "<script>console.log( 'Host: " . $this->url . " | Error -> " . $e['message'] . "' );</script>";
		}
		
		$stid = oci_parse($conn, $this->getAlarmsSql);

		/*if (!$stid) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}*/

		$r = oci_execute($stid);
		/*if (!$r) {
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}*/

		while ($row = oci_fetch_array($stid, OCI_ASSOC)) { 
			$result[] = $row;		
		}
		
		oci_free_statement($stid);
		oci_close($conn);
		
		return $result;
		
	}
	
	public function getAlarm($id) {		
		
		$conn = oci_connect($this->user,$this->password,$this->url);

		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$stid = oci_parse($conn, $this->getAlarmSql);
		
		oci_bind_by_name($stid, ':id', $id);

		if (!$stid) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$row = oci_fetch_array($stid, OCI_ASSOC);
		//print_r($row);
			
		oci_free_statement($stid);
		oci_close($conn);
		
		return $row;

	}
	
	public function updateAlarm($id,$envname,$checkname,$description,$status,$curvalue,$vallimit,$limitmark,$sqlscript,$active,$sendto,$alarmtype,$starttime,$endtime) {	

		$conn = oci_connect($this->user,$this->password,$this->url);

		$stid = oci_parse($conn, $this->getUpdateSql);		
		oci_bind_by_name($stid, ':id', $id);
		oci_bind_by_name($stid, ':envname', $envname);
		oci_bind_by_name($stid, ':checkname', $checkname);
		oci_bind_by_name($stid, ':description', $description);
		oci_bind_by_name($stid, ':status', $status);
		oci_bind_by_name($stid, ':curvalue', $curvalue);
		oci_bind_by_name($stid, ':vallimit', $vallimit);
		oci_bind_by_name($stid, ':limitmark', $limitmark);
		oci_bind_by_name($stid, ':sqlscript', $sqlscript);
		oci_bind_by_name($stid, ':active', $active);
		oci_bind_by_name($stid, ':sendto', $sendto);
		oci_bind_by_name($stid, ':alarmtype', $alarmtype);
		oci_bind_by_name($stid, ':starttime', $starttime);
		oci_bind_by_name($stid, ':endtime', $endtime);
		
		$r = oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
		oci_commit($conn);
		oci_free_statement($stid);
		oci_close($conn);
		
		if (!$r) { return 'notok'; } else { return 'ok'; }

	}
	
	public function deleteAlarm($id) {	

		$conn = oci_connect($this->user,$this->password,$this->url);

		$stid = oci_parse($conn, $this->deleteSql);		
		oci_bind_by_name($stid, ':id', $id);
		
		$r = oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
		oci_commit($conn);
		oci_free_statement($stid);
		oci_close($conn);
		
		if (!$r) { return 'notok'; } else { return 'ok'; }

	}
	
	public function getAddForm() {
		$form = '<h1>New alarm</h1>';
		$form .= '<form class="form-horizontal" action="'.$this->server.'">
					  <div class="control-group">
						<label class="control-label" for="checkname">Alarm name</label>
						<div class="controls">
							<textarea rows="1" class="field span9" name="checkname"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="envname">Env name</label>
						<div class="controls">
							<textarea rows="1" class="field span9" name="envname"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="description">Alarm desc</label>
						<div class="controls">
						  <textarea rows="3" class="field span9" name="description"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="curvalue">Current value</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="curvalue"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="vallimit">Value limit</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="vallimit"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="limitmark">Limit mark</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="limitmark"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
						  <select id="status" name="status" class="field span2"><option>OK</option><option>ALARM</option></select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="sqlscript">SQL</label>
						<div class="controls">
							<textarea rows="6" class="field span9" name="sqlscript"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="active">Active</label>
						<div class="controls">
						  <select id="active" name="active"  class="field span2"><option>YES</option><option>NO</option></select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="sendto">Send to</label>
						<div class="controls">
						  <textarea rows="1" class="field span3" name="sendto"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="alarmtype">Alarm type</label>
						<div class="controls">
						  <select id="alarmtype" name="alarmtype" class="field span2"><option>LIMITUP</option><option>LIMITDOWN</option></select>
						</div>
					  </div>	
					  <div class="control-group">
						<label class="control-label" for="starttime">Start time</label>
						<div class="controls">
						  <textarea rows="1" class="field span2" name="starttime"></textarea>
						</div>
					  </div>	
					  <div class="control-group">
						<label class="control-label" for="endtime">End time</label>
						<div class="controls">
						  	<textarea rows="1" class="field span2" name="endtime"></textarea>
						</div>
					  </div>
					  <div class="control-group">
						<div class="controls">
							<button type="submit" name="add" class="btn pull-right btn-success add">Add</button>
						</div>
					  </div>					  
				  </form>';
		$form .= '<a class="close-reveal-modal">&#215;</a>';
		return $form;
		
	}
	
	public function addOneAlarm($checkname,$envname,$description,$status,$curvalue,$vallimit,$limitmark,$sqlscript,$active,$sendto,$alarmtype,$starttime,$endtime) {	

		$conn = oci_connect($this->user,$this->password,$this->url);
		$stid = oci_parse($conn, 'select max(id) as ID from providentmonitor');
		oci_define_by_name($stid, 'ID', $id);
		$r = oci_execute($stid);
		oci_fetch($stid);
		oci_free_statement($stid);
		
		$id += 1;
		
		$stid = oci_parse($conn, $this->addSql);		
		oci_bind_by_name($stid, ':id', $id);
		oci_bind_by_name($stid, ':checkname', $checkname);
		oci_bind_by_name($stid, ':envname', $envname);
		oci_bind_by_name($stid, ':description', $description);
		oci_bind_by_name($stid, ':status', $status);
		oci_bind_by_name($stid, ':curvalue', $curvalue);
		oci_bind_by_name($stid, ':vallimit', $vallimit);
		oci_bind_by_name($stid, ':limitmark', $limitmark);
		oci_bind_by_name($stid, ':sqlscript', $sqlscript);
		oci_bind_by_name($stid, ':active', $active);
		oci_bind_by_name($stid, ':sendto', $sendto);
		oci_bind_by_name($stid, ':alarmtype', $alarmtype);
		oci_bind_by_name($stid, ':starttime', $starttime);
		oci_bind_by_name($stid, ':endtime', $endtime);
		
		$r = oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
		oci_commit($conn);	
		oci_close($conn);

		if (!$r) { return 'notok'; } else { return 'ok';  }
		
	}
	
}
