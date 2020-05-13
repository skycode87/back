<?php

$AGENT_TYPE[0] = 'HTML';
$AGENT_TYPE[1] = 'Text';
$AGENT_TYPE[2] = 'File';
$AGENT_TYPE[3] = 'Image';
$AGENT_TYPE[4] = 'Child';
$AGENT_TYPE[5] = 'Root';
$AGENT_TYPE[6] = 'Banner';
$AGENT_TYPE[7] = 'Image + Link';
$AGENT_TYPE[8] = 'Section Web';
$AGENT_TYPE[9] = 'Icon + Text';
$AGENT_TYPE[10] = 'Title';
$AGENT_TYPE[11] = 'Title + Subtitle';
$AGENT_TYPE[12] = 'Icon + Text + Link';


define("AGENT_TYPE_HTML", 0);
define("AGENT_TYPE_TEXT", 1);
define("AGENT_TYPE_FILE", 2);
define("AGENT_TYPE_IMAGE",3);
define("AGENT_TYPE_CHILD",4);
define("AGENT_TYPE_ROOT",5);
define("AGENT_TYPE_BANNER",6);
define("AGENT_TYPE_IMAGE_LINK",7);
define("AGENT_TYPE_SECTIONWEB",8);
define("AGENT_TYPE_ICON_TEXT)",9);
define("AGENT_TYPE_TITLE",10);
define("AGENT_TYPE_TITLE_SUBTITLE",11);
define("AGENT_TYPE_ICON_TEXT_LINK)",12);



define("AGENT_MODE_PRIVATE",1);
define("AGENT_MODE_PUBLIC",5);

   $AGENT['agent_fullname']           =  "dato01";
   $AGENT['agent_documentid'] 	      =  "dato02";
   $AGENT['agent_phone']		          =  "dato03";
   $AGENT['agent_username'] 	        =  "dato04";
   $AGENT['agent_password'] 	        =  "dato05";
   $AGENT['agent_email']	            =  "dato06";
   $AGENT['agent_role'] 			        =  "dato10";
   $AGENT['agent_document_type'] 	    =  "dato11";
   $AGENT['agent_phone_optional']     =  "dato13";
   $AGENT['agent_role_description']   =  "dato15";
   $AGENT['agent_address']            =  "dato16";
   $AGENT['agent_avatar']             =  "dato31";
   $AGENT['agent_description']        =  "dato32";
   $AGENT['agent_token'] 		          =  "token";
   $AGENT['agent_link']               =  "link";
   $AGENT['agent_id']                 =  "id";


function updateServer($url){
/*

  notify('website Updated');
	$cURLConnection = curl_init();
	curl_setopt($cURLConnection, CURLOPT_URL,$url);
	curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
	curl_exec($cURLConnection);
	curl_close($cURLConnection);
*/

}



?>