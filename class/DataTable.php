<?php
include "config.php";

class DataTable
{
	private $db_connect;
	public function __construct()
    {
  		$this->db_connect = mysql_connect(HOSTNAME,USER,PASSWORD);
		mysql_select_db("wine",$this->db_connect);
    }
	
	function fetchRecords()
	{
		$sql = "select w.*,
				(select count(*) from winetarp where region = w.region) as count_region,
				(select count(*) from winetarp where producer = w.producer) as count_producer from winetarp w";
		$result = mysql_query($sql);
		print_r(mysql_fetch_array($result));
	}
}
?>