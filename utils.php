<?php
function getConfig(){
    $jsonString = file_get_contents(__DIR__.'/config.json');

// Decode the JSON string into an associative array
    return $data = json_decode($jsonString, true);


}

function getListOfIgniredDBs(){
    $config = getConfig();
    return $config['ignoredDataBases'];
}

function isDbCanBeDumped($dbName){
    $strings = getListOfIgniredDBs();

    $searchString = $dbName;

    if (in_array($searchString, $strings)) {
        return false;
    } else {
        return true;
    }
}

function printRed ($string){
    $colorRed = "\033[0;31m";
    $colorReset = "\033[0m";
    echo $colorRed . $string. $colorReset . "\n";
}
function printGreen ($string){
    $colorRed = "\033[0;33m";
    $colorReset = "\033[0m";
    echo $colorRed . $string. $colorReset . "\n";
}

function printWhite ($string){
    $colorRed = "\033[0;37m";
    $colorReset = "\033[0m";
    echo $colorRed . $string. $colorReset . "\n";
}
