<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";
include_once "agency.php";


$result = $_POST['rawRequest'];
$obj = json_decode($result, true);




    $fecha  = $_POST['plan01'] = $obj['q4_departureDate']['year']."-".$obj['q4_departureDate']['month']."-".$obj['q4_departureDate']['day'];
    $hora                    = $_POST['plan04'] = $obj['q5_departureTime']; 
    $user_document           = $_POST['user02'] = $obj['q11_passportDni']; 
    $user_nacionality        = $_POST['user06'] = $obj['q15_typeA'];     
    $user_additional_info    = $_POST['user12'] = $obj['q13_additionalInformation']; 
    $user_fullname           = $_POST['user01'] = $obj['q3_fullname']; 
    $user_email              = $_POST['user04'] = $obj['q14_email']; 
    $_POST['track']          = '';
    $cupon                   = $_POST['code']   = ''; 
    $_POST['app08']          = 1;



if(AGENCY_ID>0){


    $m             = new formModel();
    $m->sql_nativo = "SELECT id FROM form004 WHERE  (  REPLACE(dato14,'-','') LIKE '%".TOKEN_OBJECT."%'  OR  token in ('".TOKEN_OBJECT."') )";
    $m->internal   = true;
    $res           = $m->all();
    $packId        = $res[0]['id'];

    if (!$packId) exit;




    $_POST['dato10']         = 1;
    $fecha                   = $_POST['plan01'];
    $hora                    = $_POST['plan04'];
    $user_document           = $_POST['user02'];    
    $user_nacionality        = countryCode($_POST['user06']);    
    $user_additional_info    = $_POST['user12'];    
    $user_fullname           = $_POST['user01'];    
    $user_email              = $_POST['user04'];  
    $cupon                   = $_POST['code'];


      if($_POST['track']) {
          $_POST['track']              = $_POST['track'];    
      }else{
        $_POST['track']             = "";    
      }

  

    $DATABASE           = PackByID($packId);
    $OWNER              = 0;
    $codigo_referer_web = 'O7GCN';
    $packName           = $DATABASE['pack_name'];
    $agencyId           = $DATABASE['agency_ID'];
    $packPrice          = $DATABASE['pack_price'];
    $available_ticket   = true;


        $m           = new formModel();
        $m->table    = _user_;
        $m->archived = 'no';
        $m->created  = $m->now__();
        $m->updated  = $m->now__();
        $m->code     = createCode(_user_);
        $m->token    = createToken(_user_);
        $link        = createLink(_user_);
        $m->dato01   = ucfirst(strtolower($user_fullname));
        $m->dato04   = strtolower($user_email);
        $m->dato09   = "main";
        $m->dato12   = strtolower($user_additional_info);
        $m->dato06   = strtoupper($user_nacionality);
        $m->dato02   = $user_document;
        $m->dato40   = $packId;
        $m->dato41   = $OWNER;
        $m->dato45   = AGENCY_ID;
        $m->dato42   = AGENCY_ID;
        $userId      = $m->save();

        $plan_ = findPlanExist($_POST['plan01'], $hora, $packId, $agencyId);


        if ($plan_['plan_ID'] > 0) {

                    $tickets      = cantidadTickets($plan_['plan_ID']);    

                    $ticketsNow = ($tickets+1);

                    $max = $plan_['plan_max_limit'];
                    $min = $plan_['plan_min_limit'];

                    if( ($ticketsNow <= $plan_['plan_max_limit']) && ($ticketsNow >= ($plan_['plan_min_limit']))) {

                        $app_status       = 0;
                        $available_ticket = true;
                        $available_plan   = 'normal'; 

                    
                    }else  if( $ticketsNow > $plan_['plan_max_limit'])  {


                        $app_status       = 3;
                        $available_ticket = false;
                        $available_plan   = 'maximo'; 

                    
                    }else  if( $ticketsNow < $plan_['plan_min_limit'] )  {

                        $app_status       = 0;
                        $available_ticket = false;
                        $available_plan   = 'minimo'; 
                                          
                    }


                    // SI CON LA NUEVA APLICACION SE ALCANZA EL MINIMO ENTONCES DEBERIA ACTIVARSE EL PLAN.

                    if( $ticketsNow == $plan_['plan_min_limit'] )  {

                        $available_ticket = true;
                        $available_plan   = 'normal'; 
                                          
                    }



                    $plan_status        = $plan_['plan_status'];
                    $planId             = $plan_['plan_ID'];
                    $app['app_status']  = $app_status;
                    $app['price']       = $packPrice;
                    $app['userId']      = $userId;
                    $app['agencyId']    = $agencyId;
                    $app['packId']      = $packId;
                    $app['quantity']    = $_POST['app08'];
                    $app['total']       = ($packPrice * $_POST['app08']);
                    $app['planId']      = $planId;
                    $app['cupon']       = $cupon;
                    $app['country']     = $country;
                    $app['latitude']    = $latitude;
                    $app['longitude']   = $longitude;
                    $app['ip']          = json_encode($API2);
                    $app['refId']       = $codigo_referer_web;
                    $app['app_type']    = 'web';
                    $app['app_survey']  = 0;
                    $app['register_by'] = 'Website';
                    $app['app_track']   =  $_POST['track'];
                    $app['price']       = $packPrice;
                    $appId              = newApp($app);
            


            
        } else {

            $tickets = 1;    
            $available_plan   = 'minimo'; 

            
            $plan_status            = 0;
            $plan['packId']         = $packId;
            $plan['price']          = $DATABASE['pack_price'];
            $plan['plan_limit_max'] = $DATABASE['pack_max_limit'];
            $plan['plan_limit_min'] = $DATABASE['pack_min_limit'];
            $plan['departure_date'] = $_POST['plan01'];
            $plan['departure_time'] = $_POST['plan04'];
            $plan['userId']         = AGENT_ID;
            $plan['agencyId']       = AGENCY_ID;

            $max =  $plan['plan_limit_max'];
            $min =  $plan['plan_limit_min'];
            
            $planId                 = newPlan($plan);

            $app['price']       = $packPrice;
            $app['userId']      = $userId;
            $app['agencyId']    = $agencyId;
            $app['packId']      = $packId;
            $app['quantity']    = $_POST['app08'];
            $app['total']       = ($packPrice * $_POST['app08']);
            $app['planId']      = $planId;
            $app['country']     = $country;
            $app['latitude']    = $latitude;
            $app['longitude']   = $longitude;
            $app['ip']          = json_encode($API2);
            $app['cupon']       = $cupon;
            $app['refId']       = $codigo_referer_web;
            $app['app_status']  = '0';
            $app['app_type']    = 'web';
            $app['app_survey']  = 0;
            $app['register_by'] = 'Website';
            $app['app_track']   =  $_POST['track'];
            $app['price']       = $packPrice;
            $appId              = newApp($app);



        }


        if ($appId){

                    $database__     = AppByID($appId);

                    $status = '*App #'.$ticketsNow.'* [ Min: '.$min.'  | Max: '.$max.' ] ';


                    if ($available_plan=='normal'){

                                $correo = 'We have availability for the dates you requested';

                                emailAppCreateWebNormal($database__,$AGENCY);

                    }else if ($available_plan=='minimo'){

                                $correo = 'We’re checking the availability';

                                emailAppCreateWebMinimo($database__,$AGENCY);

                    }else if ($available_plan=='maximo'){

                                $correo = 'we don’t have availability for the date you requested ';

                                emailAppCreateWebMaximo($database__,$AGENCY);
                    }
                



                    $asunto_slack = "*A new app from the Website was registered | ".$database__['pack_name']."*  \n:date: ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") \n:ticket: ".$status." \n:envelope_with_arrow: *Email Sent:* ".$correo." \n:grin: ".$user_fullname." ".$user_email; 


                    $payload = array(
                            'payload' => json_encode(array(
                                'attachments' => array(
                                    0 => array(
                                        'fallback' => 'New application from the website',
                                        'color' => '#7ADF6E',
                                        'text' =>  $asunto_slack,
                                        'title' => '',
                                        'title_link' => '',
                                        'footer' => 'Capture Colombia Tours',
                                        'footer_icon' => ''
                                    )
                                )
                            ))
                    );
      
                    slack_($payload);  

                    echo $appId;

        }else{
            echo 'error';
            notify('Hubo un Error Registrando un App desde el Website \n '.json_enconde($_SERVER));
        }




}

/*

function activarPlan($idPlan)
{

        $sql           = " SELECT id FROM form005 where dato41 in ($idPlan)  and archived='no' and dato10 in (0) ";
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        for ($i = 0;$i < count($res);$i++)
        {
             $database__     = AppByID($res['id']);
             emailAppCreateWebNormal($database__,$AGENCY);
        }
}




*/




/*
        if ($appId) {

            $database__     = AppByID($appId);
            
       
            if($available_ticket){




                   if($available_plan=='normal'){



                           if( listAppsConfirmadas(AGENCY_ID,$planId) >= $database__['plan_min_limit'] ){
                               
                               enviarConfirmacionAppsEnEspera(AGENCY_ID,$planId);

                            $asunto_slack = ":white_check_mark: *New app from the website*.This Tour has been opened. \n :bus: ".$database__['pack_name']." \n :date: ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") \n :email:A confirmation email has been sent to ".$database__['user_email'];

                            $asunto = "A confirmation email has been sent to ".$database__['user_email']." | New application was registered for ".$database__['pack_name']." on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].")";

                             $body = "A confirmation email has been sent to ".$database__['user_email']." <br> New application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].").";


                            }else{


                    $asunto_slack = " *New app from the website* is waiting for the opening of the tour :alarm_clock: \n :bus: ".$database__['pack_name']." \n :date: ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") \n :email: ".$database__['user_email'];


                    $asunto = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].")";

                    $body = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].").";


                                emailAppCreateWeb_available(AGENCY_ID,$database__);

                            }


                    
                   }else if($plan_status==1){


                   appSendConfirmation(AGENCY_ID,$appId);

                    $asunto_slack = ":white_check_mark: *New app from the website* \n :bus: ".$database__['pack_name']." \n :date: ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") \n :email: ".$database__['user_email'];


                    $asunto = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].")";

                     $body = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].").";


                   }

        
            
            }else{

                    $asunto = $asunto_slack = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") but there’s no available room. ".$database__['user_email']."  was informed.";
                    

                     $body = "A new application was registered for ".$database__['pack_name']."   on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") but there’s no available room. ".$database__['user_email']."  was informed. <br>
                        The limit  of the tour is ".$plan_['plan_max_limit']." applications.";
                        
                        emailAppCreateWeb_not_available(AGENCY_ID,$database__);  

            }





            $payload = array(
            'payload' => json_encode(array(
                'attachments' => array(
                    0 => array(
                        'fallback' => 'New application from the website',
                        'color' => '#7ADF6E',
                        'text' =>  $asunto_slack,
                        'title' => '',
                        'title_link' => '',
                        'footer' => 'Capture Colombia Tours',
                        'footer_icon' => ''
                    )
                )
            ))
            );
      
            slack_($payload);  


            echo $appId;
        }else{
            echo 'error';
        }
        }

function listAppsConfirmadas($agencyId,$planId){
        $m               = new formModel();
        $m->sql_nativo   = "SELECT count(id) as total from form005 where dato41 in ('".$planId."') and dato45 in ('".$agencyId."') and archived = 'no' and dato10='1' group by dato10  ";
        $m->internal     = true;  
        $apps            =  $m->all();

        if($apps[0]['total']>0){
                $total = $apps[0]['total'];
        }else{
                $total = 0;
        }


        return $total;
}
*/
  


       
?>