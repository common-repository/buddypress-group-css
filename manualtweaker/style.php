<?php
header("Content-Type: text/css");

$template = "template.css";
if(file_exists($template)) {
	$file_contents = implode("\n",file($template));

	$file_contents = str_replace("BP_COL_01",$_GET["c01"],$file_contents);
	$file_contents = str_replace("BP_COL_02",$_GET["c02"],$file_contents);
	$file_contents = str_replace("BP_COL_03",$_GET["c03"],$file_contents);
	$file_contents = str_replace("BP_COL_04",$_GET["c04"],$file_contents);
	$file_contents = str_replace("BP_COL_05",$_GET["c05"],$file_contents);
	$file_contents = str_replace("BP_COL_06",$_GET["c06"],$file_contents);
	$file_contents = str_replace("BP_COL_07",$_GET["c07"],$file_contents);
	$file_contents = str_replace("BP_COL_08",$_GET["c08"],$file_contents);
	$file_contents = str_replace("BP_COL_09",$_GET["c09"],$file_contents);
	$file_contents = str_replace("BP_COL_10",$_GET["c10"],$file_contents);
	$file_contents = str_replace("BP_COL_11",$_GET["c11"],$file_contents);
	$file_contents = str_replace("BP_COL_12",$_GET["c12"],$file_contents);
	$file_contents = str_replace("BP_COL_13",$_GET["c13"],$file_contents);
	$file_contents = str_replace("BP_COL_14",$_GET["c14"],$file_contents);
	$file_contents = str_replace("BP_COL_15",$_GET["c15"],$file_contents);
	$file_contents = str_replace("BP_COL_16",$_GET["c16"],$file_contents);
	
	echo($file_contents);
}

?>