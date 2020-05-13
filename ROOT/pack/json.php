<?php
include_once "../main/common.php";
if(AGENCY_ID){	
	 $file       = "../data/".AGENCY_TOKEN.TOKEN_OBJECT.".json";
     echo file_get_contents($file);
}
?>