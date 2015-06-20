<?php
function _get_type($sql){
	$temp_array = explode(' ', $sql);
	$temp = $temp_array[1];
	$temp_array = explode('_', $temp);
	$len = count($temp_array);
	$type = $temp_array[$len-2];
	return $type;
}
$sql = 'update tbUserPackageRedundancy_cf_webtips_82';
echo _get_type($sql);
?>