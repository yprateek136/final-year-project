<?php
$file = $_REQUEST['fileUrl'];
$data = [];
if (!unlink($file)) {
	$data['status'] = '401';
	$data['message'] = "Error Deleting.";
} else {
	$data['status'] = '200';
	$data['message'] = "Deleted.";
}
echo json_encode($data);
?>