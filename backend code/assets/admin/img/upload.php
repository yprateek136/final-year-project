<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');

// print_r($_FILES);
$ds = DIRECTORY_SEPARATOR; //1
$storeFolder = 'uploadimages'; //2
$extension = array("jpeg", "jpg", "png", "gif", "svg");
$data = [];

if (!empty($_FILES)) {

	$tempFile = $_FILES['file']['tmp_name']; //3

	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	if (in_array($ext, $extension)) {
		$targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds; //4

		$count = iterator_count(new FilesystemIterator($storeFolder, FilesystemIterator::SKIP_DOTS));

		// $targetFile = $targetPath.$_GET['from'] . $count . "." . $ext; //5
		$targetFile = $targetPath. $count . "." . $ext; 

		if(move_uploaded_file($tempFile, $targetFile)) {
//6
			$data['status'] = "200";
			$data['url'] = $targetFile;
			$data['name'] = $count . "." . $ext;
		} else {
			$data['status'] = "403";
			$data['message'] = "Image Not Uploaded";
			$data['log'] = $_FILES["file"]["error"];
		}

	} else {
		$data['status'] = "401";
		$data['message'] = "Invalid Image Format";
	}
} else {
	$data['status'] = "402";
	$data['message'] = "Invalid Image";
}
echo json_encode($data);
?>