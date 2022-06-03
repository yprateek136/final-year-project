<?php

$_filetree = $_POST['filetree'];

function createFoldersAndMoveFiles($_filetree) 
{

    $nFolders = count($_filetree);

    foreach ($_filetree as $folder => $files) {
        createFolder($folder);
        moveFiles($files, $folder);

    }
}

function moveFiles($_files,$_folder) {

    $source = 'attachments/file_upload/';
    $destination = 'attachments/UploadFiles/';

    $nFiles = count($_files);
    for($i = 0; $i < $nFiles; $i++) {
        $file = $_files[$i];
        rename($source . $file, $destination .$_folder. '/' .$file);
      }
}

function createFolder($foldername) {
    $folders = explode("/", $foldername);

    $path = 'mypath/';
    $nFolders = count($folders);
    for($i = 0; $i < $nFolders; $i++){
        $newFolder = '/' . $folders[$i];
        $path .= $newFolder;

        if (!file_exists($path) && !is_dir($path)) {
            mkdir($path);
        }

    }
}

?>