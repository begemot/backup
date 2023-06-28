<?php 
require ('./unpack.php');
require ('./createDb.php');
ini_set('memory_limit', '2G');
unpackGz();
upDatabases();
return;
$mysqlhost = 'localhost';
$mysqluser = 'root';
$mysqlpass = '123123123';


$mysqli = new mysqli($mysqlhost, $mysqluser, $mysqlpass);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
//$result = $mysqli->query('show databases', MYSQLI_USE_RESULT);
//$dbArray = $result->fetch_all();
$userNames = [];
foreach (glob("*.sql") as $filename) {
   // echo "$filename размер " . filesize($filename) . "\n";
	echo $dbName = str_replace('.sql','',$filename);
	$userNames[$dbName]=['pass'=>''];
	$sql = "CREATE DATABASE `$dbName` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
	
	// Performs the $sql query on the server to create the database
	if ($mysqli->query($sql) === TRUE) {
	  echo 'Database "tests" successfully created
';
	  
	  
	}
	else {
	 echo 'Error: '. $mysqli->error;
	}
	exec ("mysql -uroot  $dbName< $dbName.sql");
	
}
file_put_contents('./mass_password_change/pass.php','<?php return '.var_export($userNames,true).'?>');
return;
foreach ($dbArray as $db){
	print_r ($db);
	$dbname = $db[0];
	exec ('mysqldump --databases <database_name> -u'.$mysqluser.' -h'.$mysqlhost.' -p123123123 --databases '.$dbname.' > '.$dbname.'.sql');
}






?>