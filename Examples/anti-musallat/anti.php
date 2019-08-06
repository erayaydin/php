<?php

$main = "/mnt/ext/";

$dirs = array_filter(glob($main.'*'), 'is_dir');

$deletePaths = [];

function deleteSubs($directory){
    global $deletePaths;
    $exeName = $directory."/".basename($directory).".exe";
    if(file_exists($exeName)){
        $deletePaths[] = $exeName;
    }

    $dirs = array_filter(glob($directory.'/*'), 'is_dir');
    foreach($dirs as $dir){
        echo "Handling ".$dir."...".PHP_EOL;

        deleteSubs($dir);
    }
}

foreach($dirs as $dir){
    echo "Handling ".$dir."...".PHP_EOL;

    deleteSubs($dir);
}

echo "===".PHP_EOL;
var_dump($deletePaths);
echo "===".PHP_EOL;

foreach($deletePaths as $deleteFile){
    unlink($deleteFile);
}

echo "CLEAR!".PHP_EOL;
