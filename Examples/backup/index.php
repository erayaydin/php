<?php

$source = "/srv/http/adfly";
$output = "/home/eray/Backup/web";

$maxSourceBackup = 4;
$maxSqlBackup = 7;

$sourceInterval = '-7 days';
$sqlInterval = '-1 day';

$dbUser = "root";
$dbPass = "toor";
$dbName = "afl";

$stderr = fopen('php://stderr', 'w');
$stdout = fopen('php://stdout', 'w');

if(!is_dir($output)){
    fwrite($stderr, $output." directory doesn't exists!".PHP_EOL);
    if(!mkdir($output)){
        fwrite($stderr, "Couldn't create ".$output." directory!".PHP_EOL);
        exit;
    }
}

if(!is_writable($output)){
    fwrite($stderr, $output." isn't writable!".PHP_EOL);
    exit;
}

if(!is_dir($output."/sql")){
    fwrite($stderr, $output."/sql directory doesn't exists!".PHP_EOL);
    if(!mkdir($output."/sql")){
        fwrite($stderr, "Couldn't create ".$output."/sql directory!".PHP_EOL);
        exit;
    }
}

if(!is_writable($output."/sql")){
    fwrite($stderr, $output."/sql isn't writable!".PHP_EOL);
    exit;
}

if(!is_dir($output."/source")){
    fwrite($stderr, $output."/source directory doesn't exists!".PHP_EOL);
    if(!mkdir($output."/source")){
        fwrite($stderr, "Couldn't create ".$output."/source directory!".PHP_EOL);
        exit;
    }
}

$sources = array_slice(scandir($output."/source"), 2);
$sqls    = array_slice(scandir($output."/sql"), 2);

$totalSource = count($sources);
$totalSqls   = count($sqls);

if(!$sources){
    createSource();
    exit;
}

// Check source
$latest = end($sources);
$exp = explode(".", $latest);
if(strtotime($exp[0]) < strtotime($sourceInterval)){
    $first = reset($sources);
    createSource();
    if($totalSource > $maxSourceBackup)
        unlink($first);
}

if(!$sqls){
    createSql();
    exit;
}

// Check sql
$latest = end($sqls);
$exp = explode(".", $latest);
if(strtotime($exp[0]) < strtotime($sqlInterval)){
    $first = reset($sources);
    createSql();
    if($totalSqls > $maxSqlBackup)
        unlink($first);
}

function createSql() {
    global $dbUser, $dbPass, $dbName;
    global $output;
    global $stdout;
    $name = date("Y-m-d");
    fwrite($stdout, "Creating ".$name." SQL".PHP_EOL);
    exec("mysqldump -u ".$dbUser." -p".$dbPass." ".$dbName." > ".$output."/sql/".$name.".sql");
}

function createSource() {
    global $source;
    global $output;
    global $stdout;
    $name = date("Y-m-d");
    chdir($source);
    fwrite($stdout, "Creating ".$name." Source Zip".PHP_EOL);
    exec("zip -r ".$output."/source/".$name.".zip .");
}
