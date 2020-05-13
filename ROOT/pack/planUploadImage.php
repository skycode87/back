<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";


if(($method==='POST')&&(AGENCY_ID)){


	
	    $planId 	   = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);


	    if(!$planId) exit;
                


		        $m             = new formModel();
		        $m->sql_nativo = " SELECT dato30  FROM form001  WHERE id in (".$planId.")";
		        $m->internal   = true;
		        $res           = $m->all();

                $m   = new formModel();

                if ($res[0]['dato30'] == ''){
                        $arrayImages[]         = $_POST['dato01'];
                }else{
              
              		 $arrayImages = json_decode($res[0]['dato30']);
 					 $arrayImages[] =$_POST['dato01'];

              
                }

                $m->table      = 'form001';
                $m->dato30     = json_encode($arrayImages);
                $m->updated($planId);

            	 

          }else{

          	echo "no pase";


          }