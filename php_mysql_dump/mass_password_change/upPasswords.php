<?php
$mysqlhost = 'localhost';
$mysqluser = 'root';
$mysqlpass = '123123123';


$mysqli = new mysqli($mysqlhost, $mysqluser, $mysqlpass);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$dbs = require('./pass.php');
print_r($dbs);

foreach ($dbs as $dbNameAndUser=>$data){
	echo $sql ="
	CREATE OR REPLACE USER `$dbNameAndUser`@`localhost` IDENTIFIED BY '".$data['pass']."';";
	
	echo '
';
	if ($mysqli->query($sql) === TRUE) {
	  echo 'Создали!
';
	   
	}
	else {
	 echo 'Error: '. $mysqli->error;
	}
	$mysqli->query($sql);

	echo $sql ="GRANT ALL PRIVILEGES ON `$dbNameAndUser`.* TO `$dbNameAndUser`@`localhost` IDENTIFIED BY '".$data['pass']."';";
	
	echo '
';
	if ($mysqli->query($sql) === TRUE) {
	  echo 'Создали!
';
	   
	}
	else {
	 echo 'Error: '. $mysqli->error;
	}
	$mysqli->query($sql);


}

?>