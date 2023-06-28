<?php
function upDatabases (){
	// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '123123123';

// Directory containing the SQL files
$directory = './unpacked_sql_files/';

// Create a new database connection
$connection = new PDO("mysql:host=$host;", $username, $password);

// Get a list of all SQL files in the directory
$files = glob($directory . '*.sql');

// Iterate through each file
foreach ($files as $file) {
    $databaseName = basename($file, '.sql');
    
    // Create the database if it doesn't exist
    $statement = $connection->prepare("CREATE DATABASE IF NOT EXISTS `$databaseName`;");
    $statement->execute();
    
    // Use the database
    $statement = $connection->prepare("USE `$databaseName`;");
    $statement->execute();
    
    // Read the SQL file content
    $sql = file_get_contents($file);
    
    // Execute the SQL queries
    $statements = explode(';', $sql);
    foreach ($statements as $statement) {
        if (!empty(trim($statement))) {
			echo $statement = str_replace("\", "", $statement)
            $connection->exec($statement);
        }
    }
    
    //echo "Executed SQL file: $file\n";
	break;
}

echo "All SQL files have been executed.";
}

?>