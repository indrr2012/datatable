<?php
$_SERVER['DOCUMENT_ROOT'] = "c:/wamp/wamp/www/datatable";
include_once($_SERVER['DOCUMENT_ROOT'] . '/libs/mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/libs/pdoMapper.php');
global $config;
$config = array(
	 'DB_Type' => 'mysql',
    'DB_Host' => 'localhost',
    'DB_Name' => 'wine',
    'DB_User' => 'root',
    'DB_Passwd' => '',
	'default_perpage' => '10',
    'default_perpage_admin' => '10',
    'arr_perpage' => array(1, 2, 5, 10, 25, 50, 100),
    'page_range' => 5,
	'page' => 1
	);
$db = new pdoMySql($config['DB_Type'],$config['DB_Host'], $config['DB_Name'], $config['DB_User'], $config['DB_Passwd'], false);
// Connect to database.
$dbCon = $db->connect_to_db(); 

if($dbCon==false)
{
// If connection fail you can print the error... Note: Every operation you execute can try print this line, for get the latest error ocurred.
	echo $db->getError(); //Show error description if exist, else is empty.
}

pdoMapper::init($dbCon);


?>