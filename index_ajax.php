<?php
include_once("/include/config.php");
include("/include/DataTable.php");
$page = (isset($_POST['page'])  ? $_POST['page']  : "1");
$action = $_POST['todo'];
//$action = "loadDataTable";
switch($action)
{
	case "loadDataTable":
		loadDataTable();
	break;
	
	case "changePerPage":
		changePerPage();
	break;
	
	case "saveRecord":
		saveRecord();
	break;
	
	case "checkUniqueProducer":
		checkUniqueProducer();
	break;
	
	case "checkUniqueRegion":
		checkUniqueRegion();
	break;
	
	case "deleteRecord":
		deleteRecord();
	break;

}

function loadDataTable()
{
	global $page,$config;
	$pagination = false;
	session_start();
	$_SESSION['records_total'] = 0;
	$_SESSION['records_perpage'] = (isset($_SESSION['records_perpage']) ? $_SESSION['records_perpage'] : $config['default_perpage']);
	$objDataTable = new DataTable();
	$result = $objDataTable->fetchRecords();
	if($_SESSION['records_total'] > $_SESSION['records_perpage'])
	{
		//show pagination
		$pagination = true;
		$prev = $page - 1;							
    	$next = $page + 1;
		$lastpage = ceil($_SESSION['records_total'] / $_SESSION['records_perpage']);
		$lpm1 = $lastpage - 1;
	}
	
	print_r($result);	
	include "ajax/pagination.php";
}

function changePerPage()
{
	session_start();
	$_SESSION['records_perpage'] = $_POST['recperpage'];
	$result = array("result" => "Success");
	echo json_encode($result);
}

function saveRecord()
{
	$arr = array();
	$arr['id'] = $_POST['id'];
	$arr['producer'] = $_POST['producer'];
	$arr['name'] = $_POST['name'];
	$arr['region'] = $_POST['region'];
	$arr['cuvee'] = $_POST['cuvee'];
	$arr['color'] = $_POST['color'];
	$objDataTable = new DataTable();
	if($objDataTable->saveRecord($arr))
	{
		$result = array("result" => "Success");
	}
	else
	{
		$result = array("result" => "Fail");
	}
	echo json_encode($result);
}

function checkUniqueProducer()
{
	$id = $_POST['id'];
	$producer = $_POST['producer'];
	$objDataTable = new DataTable();
	if($objDataTable->checkUniqueProducer($id,$producer))
	{
		$result = array("result" => "Success");
	}
	else
	{
		$result = array("result" => "Fail");
	}
	echo json_encode($result);
}

function checkUniqueRegion()
{
	$id = $_POST['id'];
	$region = $_POST['region'];
	$objDataTable = new DataTable();
	if($objDataTable->checkUniqueRegion($id,$region))
	{
		$result = array("result" => "Success");
	}
	else
	{
		$result = array("result" => "Fail");
	}
	echo json_encode($result);
}

function deleteRecord()
{
	$id = $_POST['id'];
	$objDataTable = new DataTable();
	if($objDataTable->deleteRecord($id))
	{
		$result = array("result" => "Success");
	}
	else
	{
		$result = array("result" => "Fail");
	}
	echo json_encode($result);
}

?>