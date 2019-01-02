<?php
	//define('PROJECT_ROOT', dirname(dirname(__FILE__)));
  //$rootPath = getenv('APP_ROOT_PATH') . "/rrms-buksu";
	$rootPath = "http://$_SERVER[HTTP_HOST]" . "/rrms-buksu/";
  //echo PROJECT_ROOT;
 // echo (substr(substr(__FILE__, strlen(realpath($_SERVER['DOCUMENT_ROOT']))), 0, - strlen(basename(__FILE__))));
  //echo substr(__FILE__, strlen(realpath($_SERVER['DOCUMENT_ROOT'])));
  //echo ($actual_link = "$_SERVER[HTTP_HOST]");
	define('PROJECT_ROOT', "http://" . $_SERVER['HTTP_HOST'] . "/rrms-buksu/");
	//echo PROJECT_ROOT;
	//echo (PROJECT_ROOT);
	define("PROJECT_ROOT_NOT_LINK", $_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/");
	define("PROJECT_FOLDER", "/rrms-buksu/");
?>