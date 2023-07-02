<?php

require_once (__DIR__.'/../utils.php');
$config = getConfig();

$sqlDumpDir = $config['dumpsDir'];

$mysqlhost = 'localhost';
$mysqluser = $config['db']['user'];
$mysqlpass = $config['db']['pass'];


$mysqli = new mysqli($mysqlhost, $mysqluser, $mysqlpass);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$result = $mysqli->query('show databases', MYSQLI_USE_RESULT);
$dbArray = $result->fetch_all();

foreach ($dbArray as $db){
	printWhite('Делаем дамп таблицы '.$db[0]);
	
	if (in_array( $db[0],$config['ignoredDataBases'])){
        printRed("Пропускаем таблицу!");
    } else {

        $dbname = $db[0];
        $command = 'mysqldump --system=users -uroot'.' -h'.$mysqlhost.' -p3c39ju8M8Cpj8KYjyc '.$dbname.' | gzip > '.$sqlDumpDir.'/'.$dbname.'.sql.gz';
        exec ($command);
     
        
    }
}



?>
