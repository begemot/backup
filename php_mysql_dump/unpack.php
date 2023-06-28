<?php

function unpackGz(){

$directory = __DIR__;

// Create a new subfolder for unpacking the files
$subfolder = 'unpacked_sql_files';
if (!file_exists($subfolder)) {
    mkdir($subfolder);
}

// Get a list of all SQL.gz files in the directory
$files = glob($directory . '/*.sql.gz');
print_r($directory);
// Unpack each file into the subfolder
foreach ($files as $file) {
    $filename = basename($file, '.gz');
    $outputFile = $subfolder . '/' . $filename;
    
    $input = gzopen($file, 'rb');
    $output = fopen($outputFile, 'wb');
    
    while (!gzeof($input)) {
        fwrite($output, gzread($input, 4096));
    }
    
    gzclose($input);
    fclose($output);
    
    echo "Unpacked file: $outputFile\n";
}

echo "All SQL.gz files have been unpacked.";
	
}