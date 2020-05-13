<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";


if(($method==='POST')&&(AGENCY_ID)){

                
		         		    $m             = new formModel();
		                $m->sql_nativo = " SELECT dato27  FROM form003  WHERE id in (".AGENCY_ID.")";
		                $m->internal   = true;
		                $res           = $m->all();


                    $m   = new formModel();
                    $arrayUrls = json_decode($res[0]['dato27']);
 			 

                    foreach ($arrayUrls as $key ) {
                    	if($request[0]!=$key){
    						          $newArray[] = $key;
                    	}
                    }

 		           
                    $m->table      = 'form003';
                    $m->dato27     = json_encode($newArray);
                    $m->updated(AGENCY_ID);            	 


          }else{

          	echo "no pase";


          }