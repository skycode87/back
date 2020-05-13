<?php

$WEB_TYPE[0] = 'HTML';
$WEB_TYPE[1] = 'Text';
$WEB_TYPE[2] = 'File';
$WEB_TYPE[3] = 'Image';
$WEB_TYPE[4] = 'Child';
$WEB_TYPE[5] = 'Root';
$WEB_TYPE[6] = 'Banner';
$WEB_TYPE[7] = 'Image + Link';
$WEB_TYPE[8] = 'Section Web';
$WEB_TYPE[9] = 'Icon + Text';
$WEB_TYPE[10] = 'Title';
$WEB_TYPE[11] = 'Title + Subtitle';
$WEB_TYPE[12] = 'Icon + Text + Link';


define("WEB_TYPE_HTML", 0);
define("WEB_TYPE_TEXT", 1);
define("WEB_TYPE_FILE", 2);
define("WEB_TYPE_IMAGE",3);
define("WEB_TYPE_CHILD",4);
define("WEB_TYPE_ROOT",5);
define("WEB_TYPE_BANNER",6);
define("WEB_TYPE_IMAGE_LINK",7);
define("WEB_TYPE_SECTIONWEB",8);
define("WEB_TYPE_ICON_TEXT)",9);
define("WEB_TYPE_TITLE",10);
define("WEB_TYPE_TITLE_SUBTITLE",11);
define("WEB_TYPE_ICON_TEXT_LINK)",12);



define("WEB_MODE_PRIVATE",1);
define("WEB_MODE_PUBLIC",5);

   $WEB['web_mode']         =  "dato12";
   $WEB['web_name'] 		    =  "dato01";
   $WEB['web_value']		    =  "dato02";
   $WEB['web_category'] 	  =  "dato03";
   $WEB['web_order'] 		    =  "dato04";
   $WEB['web_description']	=  "dato05";
   $WEB['web_url'] 			    =  "dato06";
   $WEB['web_title'] 		    =  "dato07";
   $WEB['web_subtitle']	    =  "dato08";
   $WEB['web_content']      =  "dato31";
   $WEB['web_url_title']    =  "dato09";
   $WEB['web_icon'] 		    =  "dato11";
   $WEB['web_visible']      =  "dato12";
   $WEB['web_rows']         =  "dato13";
   $WEB['web_type'] 		    =  "dato10";
   $WEB['web_root'] 		    =  "dato41";
   $WEB['web_token'] 		    =  "token";
   $WEB['web_id']           =  "id";



function updateServer($url){
   //notify(' no se website Updated');

/*
  notify('website Updated');
	$cURLConnection = curl_init();
	curl_setopt($cURLConnection, CURLOPT_URL,$url);
	curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
	curl_exec($cURLConnection);
	curl_close($cURLConnection);
*/

}



function updateCluuf($msj){
  notifySlack("The Website has been updated by *".$_SESSION['AGENT_NAME']."*  \n :grinning:  ".$msj,$_SESSION['AGENCY_SLACK']);
  $cURLConnection = curl_init();
  curl_setopt($cURLConnection, CURLOPT_URL,$_SESSION['AGENCY_CLUUF']);
  curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
  curl_exec($cURLConnection);
  curl_close($cURLConnection);
}





function addCategory($AGENCY__,$rootID){
        
        $sql = "SELECT              
        web.dato01      AS 'web_name'
        FROM   
       form020 web
       WHERE  web.dato40 in ('".$AGENCY__."') 
       AND web.dato41 in ('".$rootID."') 
       AND web.archived = 'no' limit 1 ";

        $m = new formModel();
        $m->sql_nativo = $sql;
        $m->internal = true;
        $res = $m->all();      
        return strtoupper($res[0]['web_name']);    
}

?>