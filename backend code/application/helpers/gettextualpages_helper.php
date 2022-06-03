<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function getTextualPages($activePages) {
	$ci = &get_instance();
	$arr = $ci->config->item('no_dynamic_pages');
	if (empty($activePages)) {
		return $activePages;
	}
	$withDuplicates = array_merge($activePages, $arr);
	return array_diff($withDuplicates, array_diff_assoc($withDuplicates, array_unique($withDuplicates)));
}
