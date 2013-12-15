<?php
class pdoMapper extends pdoMySQL
{
    public static $db;
	
	function __construct(){}
	
	public static function init($dbCon)
    {
       self::$db = $dbCon;
    }
		
}