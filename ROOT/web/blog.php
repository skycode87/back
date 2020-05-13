<?php

    $WEB_TYPE[0] = 'NOVISIBLE';
    $WEB_TYPE[1] = 'VISIBLE';
    $WEB_TYPE[2] = 'SCHEDULE';


    define("BLOG_VISIBLE", 1);
    define("BLOG_NOVISIBLE", 0);
    define("BLOG_SCHEDULE", 2);


   $BLOG['blog_name'] 		  =  "dato01";
   $BLOG['blog_title']      =  "dato02"; 
   $BLOG['blog_summary']	  =  "dato03";
   $BLOG['blog_autor']      =  "dato04";
   $BLOG['blog_category']   =  "dato05"; 
   $BLOG['blog_url'] 			  =  "dato06";
   $BLOG['blog_meta']      	=  "dato07";
   $BLOG['blog_tags']       =  "dato08";
   $BLOG['blog_type'] 		  =  "dato10";
   $BLOG['blog_masterId']  	=  "dato41";
   $BLOG['blog_token'] 		  =  "token";
   $BLOG['blog_content']    =  "dato31";
   $BLOG['blog_banner']     =  "dato32";
   $BLOG['blog_schedule']   =  "dato09";
   $BLOG['blog_created']    =  "created";
   $BLOG['blog_token']      =  "token";



function updateServer($url){
	$cURLConnection = curl_init();
	curl_setopt($cURLConnection, CURLOPT_URL,$url);
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