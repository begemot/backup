<?php 
$mysqlhost = 'localhost';
$mysqluser = 'root';
$mysqlpass = 'mgILaztSLQb9QaSSZ6PnsopZ';


$mysqli = new mysqli($mysqlhost, $mysqluser, $mysqlpass);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$result = $mysqli->query('show databases', MYSQLI_USE_RESULT);
$dbArray = $result->fetch_all();

foreach ($dbArray as $db){
	print_r ($db);
	$dbname = $db[0];
	exec ('mysqldump --system=users -u'.$mysqluser.' -h'.$mysqlhost.' -pmgILaztSLQb9QaSSZ6PnsopZ '.$dbname.' | gzip > /home/php_mysql_dump/'.$dbname.'.sql.gz');
}



?>