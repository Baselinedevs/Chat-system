<?php
//db details
session_start();
$db_username="root";
$db_pass="";
$db_name="onlinechats";
$table_reg="registration";
$table_pm="pm";

define("DB_HOST", "localhost");
define('DB_USERNAME',$db_username );
define('DB_PASS',$db_pass );
define('DB_NAME',$db_name );
include('class_db.php');
$db_obj = new database; 
?>