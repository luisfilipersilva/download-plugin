<?php

ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script

$path = "/var/www/...";
//$archive_file_name='download.zip';

$tempfile = $_GET['download_file'];
$new_files = explode(",", $tempfile);

foreach($new_files as $arq)
{
    $arr_files[ ] = $arq;
}

$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach($arr_files as $file){

    # download file
    $download_file = file_get_contents($path.$file);

    #add it to the zip
    $zip->addFromString(basename($file),$download_file);

}

# close zip
$zip->close();

# send the file to the browser as a download
header('Content-disposition: attachment; filename=download.zip');
header('Content-type: application/zip');
readfile($tmp_file);
