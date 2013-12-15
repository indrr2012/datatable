<?php
include("config.php");
class DataTable
{ 
	private $_username;
    private $_password;
    private $_dsn;
    private $_pdo;
	public $db_connect;
	private $config;
	public function __construct()
    {
		global $config;
        $this->_username = $config['DB_User'];
        $this->_password = $config['DB_Passwd'];
        $this->_dsn = sprintf("%s:host=%s;dbname=%s", $config['DB_Type'], $config['DB_Host'], $config['DB_Name']);
		$this->_pdo = new PDO($this->_dsn, $this->_username, $this->_password);
    }
	
	function fetchRecords()
	{
		global $page;
		$start = ($page - 1) *  $_SESSION['records_perpage']; 
		$sql = "select count(*) as CNT from winekamal";
		
		$statement = $this->_pdo->prepare($sql);
		
		$statement->execute();
		if($statement->errorCode() ==  '00000') {
			
			$vals = $statement->fetch(PDO::FETCH_ASSOC);
		
			$_SESSION['records_total'] = $vals['CNT'];
			
			if($_SESSION['records_total'] > 0 && $_SESSION['records_total'] == $start)
			{
				$page = $page - 1;
				$start = ($page - 1) *  $_SESSION['records_perpage']; 
			}
			
			$sql = "select w.*,
					(select count(*) from winekamal where region = w.region) as count_region,
					(select count(*) from winekamal where producer = w.producer) as count_producer from winekamal w".
					 " LIMIT :start, :per_page";
				
			$statement = $this->_pdo->prepare($sql);
			
			$statement->bindParam(":start", $start, PDO::PARAM_INT);
			$statement->bindParam(":per_page", intval($_SESSION['records_perpage']), PDO::PARAM_INT);
			
			$statement->execute();
			 
			if($statement->errorCode() ==  '00000') {
				$results = $statement->fetchAll(PDO::FETCH_ASSOC); 
				$data = "<center><table border='2'><tr><th>id</th><th>Producer</th><th>Name</th><th>Region</th><th>Cuvee</th><th>Color</th><th>Action</th></tr>";
				
				foreach($results as $result)
				{
					$data .= "<tr><td>".$result['idwine']."</td><td>".$result['producer']."</td><td>".$result['name']."</td><td>".
								$result['region']."</td><td>".$result['cuvee']."</td><td>".$result['color']."</td><td>";	
					if($result['count_region'] > 1 or $result['count_producer'] > 1)
					{
						$data .= "<a href='#' onclick='editField(".$result['idwine'].");'><img src='images/edit.png'/></a>";
						$data .= "<input type='hidden' id=producer_".$result['idwine']." value="."'".$result['producer']."'"." />";
						$data .= "<input type='hidden' id=name_".$result['idwine']." value="."'".$result['name']."'"." />";
						$data .= "<input type='hidden' id=region_".$result['idwine']." value="."'".$result['region']."'"." />";
						$data .= "<input type='hidden' id=cuvee_".$result['idwine']." value="."'".$result['cuvee']."'"." >";
						$data .= "<input type='hidden' id=color_".$result['idwine']." value="."'".$result['color']."'"." />";
					}
					$data .= "<a href='#' onclick='deleteField(".$result['idwine'].");'><img src='images/del.png'/></a>";
					$data .= "</td>";
					$data .= "</tr>";
				}
				$data .= "</table></center>";

				return $data;
			}
			else
			{
				return false;
			}
		}	
	}
	function saveRecord($arr)
	{
		$sql = "update winekamal
				set 
				producer = :producer,
				name = :name,
				region = :region,
				cuvee = :cuvee,
				color = :color
				where idwine = :idwine";
		$statement = $this->_pdo->prepare($sql);
		$statement->bindParam(':producer', $arr['producer']);
		$statement->bindParam(':name', $arr['name']);
		 $statement->bindParam(':region', $arr['region']);
		 $statement->bindParam(':cuvee', $arr['cuvee']);
		$statement->bindParam(':color', $arr['color']);
		 $statement->bindParam(':idwine', $arr['id']);
		$statement->execute();
		
		if($statement->errorCode() ==  '00000') {
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function checkUniqueProducer($id,$producer)
	{
		$sql = "select count(*) as CNT from winekamal
				where producer = :producer
				and idwine != :idwine";
		$statement = $this->_pdo->prepare($sql);
		$statement->bindParam(':producer', $producer);
		 $statement->bindParam(':idwine', $id);
		$statement->execute();
		
		if($statement->errorCode() ==  '00000') {
			$vals = $statement->fetch(PDO::FETCH_ASSOC);
			if($vals['CNT'] > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function  checkUniqueRegion($id,$region)
	{
		$sql = "select count(*) as CNT from winekamal
				where region = :region
				and idwine != :idwine";
		$statement = $this->_pdo->prepare($sql);
		$statement->bindParam(':region', $region);
		 $statement->bindParam(':idwine', $id);
		$statement->execute();
		
		if($statement->errorCode() ==  '00000') {
			$vals = $statement->fetch(PDO::FETCH_ASSOC);
			if($vals['CNT'] > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function deleteRecord($id)
	{
		$sql = "delete from winekamal
				where idwine = :idwine";
		
		$statement = $this->_pdo->prepare($sql);
		 $statement->bindParam(':idwine', $id);
		$statement->execute();
		
		if($statement->errorCode() ==  '00000') {
			return true;
		}
		else
		{
			return  false;
		}		
	}
	
}
?>  