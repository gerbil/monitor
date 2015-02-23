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

	public function __construct($server) {
		$this->server = $server;

        if ($this->server == "avk6-provident-f1.tele2.net" or $this->server == "hgd0-provident-f1.tele2.net" or $this->server == "hgd0-provident-f2.tele2.net") {
            $this->user = "provfmobile";
            $this->password = "LjgJDhsGJnSqmCkp";
            $this->url = "10.156.150.160/PROVDB";
        } elseif ($this->server == "kst-prov-f1" or $this->server == "hgd-prov-f1") {
            $this->user = "provfother";
            $this->password = "Tv5eVaaTL3T0wF9e";
            $this->url = "10.156.150.160/PROVDB";
        } elseif ($this->server == "kst-prov-f2" or $this->server == "kst-prov-f3" or $this->server == "hgd-prov-f2" or $this->server == "hgd-prov-f3") {
            $this->user = "provfmob";
            $this->password = "FJvA158CH3JL0hHw";
            $this->url = "10.156.150.160/PROVDB";
        }

		$this->updateSql = "update node_statuses set enabled=:enabled where host=:servername";
		$this->statusSql = "select host, enabled from node_statuses where host = :servername";

	}
	
	public function remove() {
		$conn = oci_connect($this->user,$this->password,$this->url);

        $this->enabled = '0';

		$stid = oci_parse($conn, $this->updateSql);
		oci_bind_by_name($stid, ':enabled', $this->enabled);
		oci_bind_by_name($stid, ':servername', $this->server);
		
		$r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
		
		oci_commit($conn);
		
		oci_free_statement($stid);
		oci_close($conn);

		if (!$r) { return 'notok'; } else { return 'ok'; }
		
	}
	
	public function restore() {
		$conn = oci_connect($this->user,$this->password,$this->url);

        $this->enabled = '1';
		
		$stid = oci_parse($conn, $this->updateSql);			
		oci_bind_by_name($stid, ':enabled', $this->enabled);
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
		oci_define_by_name($stid, 'ENABLED', $this->enabled);
		
		$r = oci_execute($stid);
		
		oci_fetch($stid);

		// Remove option
		if ($this->enabled == '1') {
			$option = '<a href="#" class="btn lbRemove" id="'.$this->server.'" title="Remove from LB"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbremove.png"/></a>';
		} 
		// Restore option
		elseif ($this->enabled == '0') {
			$option = '<a href="#" class="btn lbRestore" id="'.$this->server.'" title="Add to LB"><img src="http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/img/lbadd.png"/></a>';
		}
		
		oci_free_statement($stid);
		oci_close($conn);

        if (!$r) { return 'notok'; } else { return $option; }
	}
	
	
}