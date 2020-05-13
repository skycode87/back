<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";



if(($method==='POST')&&(AGENCY_ID)){



		        $m             = new formModel();
		        $m->sql_nativo = " SELECT dato28  FROM form003  WHERE id in (".AGENCY_ID.")";
		        $m->internal   = true;
		        $res           = $m->all();

                $m   = new formModel();

                if ($res[0]['dato28'] == ''){
                
                    $arrayUrls[] = $_POST['agency_notify_urls_referrals'];
            
                }else{
            
                	  $arrayUrls   = json_decode($res[0]['dato28']);
                    $arrayUrls[] = $_POST['agency_notify_urls_referrals'];
            
                }

                $m->table      = 'form003';
                $m->dato28     = json_encode($arrayUrls);
                $m->updated(AGENCY_ID);

            	 

          }else{

          	echo "no pase";


          }