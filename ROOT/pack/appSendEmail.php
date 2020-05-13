<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";



if(AGENCY_ID){

    UsageAPI('appSendEmail',AGENCY_ID,AGENT_ID,AGENT_NAME);
    
    $planId        = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);


    if (!$planId) exit;


        if($_POST['ListaDeEmails']==''){

             if($_POST['emails']!=''){

                $_POST['emails'] = substr($_POST['emails'], 0, -1);
                $_POST['emails'] = substr($_POST['emails'], 1 );

                $email = explode(",", trim($_POST['emails']));


                foreach ($email as $key) {

                    $key = substr($key, 0, -1);
                    $key = substr($key, 1 );
                    appSendEmail(AGENCY_ID,objectID(_app_,$key,AGENCY_ID,$_POST['emails']),$_POST['app_message_quill']);

                }


                    
                }


             }else{



                $m               = new formModel();

                $m->sql_nativo   = "SELECT app.id as app_id FROM  form005 app join form001 plan on app.dato41 = plan.id where plan.archived = 'no' and app.archived ='no' and app.dato45 in (".AGENCY_ID.") and app.dato10 in (".intval($_POST['ListaDeEmails']).") and plan.id in (".$planId.") ";

                $m->internal     = true;
             
                $res           =  $m->all();

                
                foreach ($res as $key) {

                    appSendEmail(AGENCY_ID,$key['app_id'],$_POST['app_message_quill']);

                }



             }

   
       
       


        //$m->updated($appId);

          //  appSendMessage(AGENCY_ID,$appId); 



        }else{



        }

        



  
?>