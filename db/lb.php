<?php 

if (isset($_REQUEST['action'])) { $action = $_REQUEST['action']; }; $action = filter_var($action, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
if (isset($_REQUEST['server'])) {	$server = $_REQUEST['server']; }; $server = filter_var($server, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

switch ($action) {
	case "remove":
		$lb = new lb($server);
		echo $lb->remove();
		break;
	case "restore":	
		$lb = new lb($server);
		echo $lb->restore();
		break;
	case "status":	
		$lb = new lb($server);
		echo $lb->getLBStatus();
		break;
}	

class lb {
	
	private $user;
	private $password;
	private $url;
	private $server;	
	private $updateSql;
	private $statusSql;
	
	private $statusinlb;
	private $returntolb;
	private $active;
	
	public function __construct($server) {
		$this->server = $server;
		$this->updateSql = "update providentloadbalancer set statusinlb=:statusinlb, returntolb=:returntolb where servername=:servername";
		$this->statusSql = "select statusinlb, returntolb, active from providentloadbalancer where servername = :servername";
		$this->user = "provvos9";
		$this->password = "vosdbpass942";
		$this->url = "dbp-1.tele2.net/provvos7";
	}
	
	public function remove() {
		$conn = oci_connect($this->user,$this->password,$this->url);
		
		$this->statusinlb = 'INACTIVE';
		$this->returntolb = 'N';

		$stid = oci_parse($conn, $this->updateSql);		
		oci_bind_by_name($stid, ':statusinlb', $this->statusinlb);
		oci_bind_by_name($stid, ':returntolb', $this->returntolb);
		oci_bind_by_name($stid, ':servername', $this->server);
		
		$r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
		
		oci_commit($conn);
		
		oci_free_statement($stid);
		oci_close($conn);

		if (!$r) { return 'notok'; } else { return 'ok'; }
		
	}
	
	public function restore() {
		$conn = oci_connect($this->user,$this->password,$this->url);
		
		$this->statusinlb = 'INACTIVE';
		$this->returntolb = 'Y';
		
		$stid = oci_parse($conn, $this->updateSql);			
		oci_bind_by_name($stid, ':statusinlb', $this->statusinlb);
		oci_bind_by_name($stid, ':returntolb', $this->returntolb);
		oci_bind_by_name($stid, ':servername', $this->server);
		
		$r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
		
		oci_commit($conn);
		
		oci_free_statement($stid);
		oci_close($conn);
		
		if (!$r) { return 'notok'; } else { return 'ok'; }
		
	}
	
	public function getLBStatus() {
		
		$conn = oci_connect($this->user,$this->password,$this->url);		

		$stid = oci_parse($conn, $this->statusSql);				
		oci_bind_by_name($stid, ':servername', $this->server);
		oci_define_by_name($stid, 'STATUSINLB', $this->statusinlb);
		oci_define_by_name($stid, 'RETURNTOLB', $this->returntolb);
		oci_define_by_name($stid, 'ACTIVE', $this->active);
		
		$r = oci_execute($stid);
		
		oci_fetch($stid);
		
		/*$option = 'Status in LB: '.$this->statusinlb.'<br/>';
		$option .= 'Return to LB flag: '.$this->returntolb.'<br/>';
		$option .= 'Status of script flag: '.$this->status.'<br/>';*/
		
		// Logic: 
		// Options available only if status = Y
		// Remove option -> if RETURNTOLB = N and STATUSINLB = ACTIVE
		if ($this->statusinlb == 'ACTIVE' && $this->active == 'Y' && $this->returntolb == 'N') { 
			$option = '<a href="#" class="btn lbRemove '.$this->statusinlb.'" id="'.$this->server.'" title="ACTIVE | Remove from LB"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbremove.png"/></a>'; 
		} 
		// Restore option -> if RETURNTOLB = N and STATUSINLB = INACTIVE
		elseif ($this->statusinlb == 'INACTIVE' && $this->active == 'Y' && $this->returntolb == 'N') { 
			$option = '<a href="#" class="btn lbRestore '.$this->statusinlb.'" id="'.$this->server.'" title="INACTIVE | Restore in LB"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbadd.png"/></a>'; 
		} 
		// Restore in progress option -> if RETURNTOLB = Y and STATUSINLB = INACTIVE
		elseif ($this->statusinlb == 'INACTIVE' && $this->active == 'Y' && $this->returntolb == 'Y') {
			$option = '<a href="#" class="btn lbUnknown '.$this->statusinlb.'" id="'.$this->server.'" title="INACTIVE | Restore in process"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbhz.png"/></a>'; 
		}
		// Remove in progress option -> if RETURNTOLB = Y and STATUSINLB = INACTIVE
		elseif ($this->statusinlb == 'ACTIVE' && $this->active == 'Y' && $this->returntolb == 'Y') {
			$option = '<a href="#" class="btn lbUnknown '.$this->statusinlb.'" id="'.$this->server.'" title="ACTIVE | Remove in process"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbhz.png"/></a>'; 
		}
		// Script disabled option -> if ACTIVE = N
		elseif ($this->active == 'N') {
			$option = '<a href="#" class="btn lbUnknown" id="'.$this->server.'" title="LB script disabled"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbdisable.png"/></a>'; 
		}
		
		oci_free_statement($stid);
		oci_close($conn);
		
		return $option;
	}
	
	
}