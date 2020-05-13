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

                if ($res[0]['dato27'] == ''){
                
                    $arrayUrls[] = $_POST['agency_skip_urls_referrals'];
            
                }else{
            
                	  $arrayUrls   = json_decode($res[0]['dato27']);
                    $arrayUrls[] = $_POST['agency_skip_urls_referrals'];
            
                }

                $m->table      = 'form003';
                $m->dato27     = json_encode($arrayUrls);
                $m->updated(AGENCY_ID);

            	 

          }else{

          	echo "no pase";


          }