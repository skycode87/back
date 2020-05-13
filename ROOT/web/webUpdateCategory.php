<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){
	    UsageAPI('webUpdateCategory',AGENCY_ID,AGENT_ID,AGENT_NAME);
		$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);
        $m = new formModel();
        $sql = "UPDATE "._web_." SET dato03 = '".sg(strtoupper($_POST['web_category']),50)."'  WHERE dato03 = '".$_POST['web_category_old']."'";
		$m->execute_sql($sql);
}

?>