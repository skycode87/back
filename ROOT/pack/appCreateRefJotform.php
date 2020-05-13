<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";
include_once "agency.php";


    $fecha  = $_POST['plan01'] = $obj['q4_departureDate']['year']."-".$obj['q4_departureDate']['month']."-".$obj['q4_departureDate']['day'];
   
    $hora                    = $_POST['plan04']      = $obj['q5_departureTime']; 
    $user_document           = $_POST['user02']      = $obj['q11_passportDni']; 
    $user_nacionality        = $_POST['user06']      = countryCode($obj['q15_nationality']);     
    $user_additional_info    = $_POST['user12']      = $obj['q13_additionalInformation']; 
    $user_fullname           = $_POST['user01']      = $obj['q3_fullname']; 
    $user_email              = $_POST['user04']      = $obj['q14_email']; 
    $register_by             = $_POST['app18']       = $obj['q20_typeA']; 
    $trans_mode              = $_POST['trans_mode']  = app_payment_mode($obj['q21_typeA21']); 
    $freeApp                 = $_POST['freeApp']     = $obj['freeApp']; 
    $quantityApp             = $_POST['app08']       = 1;
    $refererCode             = $obj['refererCode']; 




    // si costo plan no existe q22_typeA22 entonces el costo va hacer 0 y freeApp es true;
    if(isset($obj['q22_typeA22']) ){
         $costoPlan = $obj['q22_typeA22'];
    }else{
        $costoPlan = 0;
        $freeApp  = true;
    }




    $_POST['track']          = '';
    $cupon                   = $_POST['code']   = ''; 




if(($method==='POST')&&(AGENCY_ID)){


    $m              = new formModel();
    $m->sql_nativo  = "select token from form004  where code in ('".TOKEN_OBJECT."')";
    $m->internal    = true;
    $res            = $m->all();
    $packId         = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);


    if (!$packId) exit;



    $m              = new formModel();
    $m->sql_nativo  = "select * from "._ref_."  where code in ('".$refererCode."')";
    $m->internal    = true;
    $res            = $m->all();


    $refId          = $res[0]['id'];
    $refName        = $res[0]['dato01'];


    if((strlen($register_by) < 2 )||( $register_by=='')){
        $register_by = $refName;
    }else{
        $register_by = $register_by;
    }


    if($freeApp=='true'){
         //$user_document           = $_POST['user02'];    
         //$user_nacionality        = $_POST['user06'];  
    }else{
         $user_document           =  $_POST['user02'];    
         $user_nacionality        =  $_POST['user06'];  
    }


    // VERIFICA EL COSTO DEL TOUR, SINO TIENE VALOR LE ASIGNA FREEAPP = TRUE


    if( (!$costoPlan) || (strlen($costoPlan)<1) || ($costoPlan==0) ){
        $freeApp = true;
    } 




      if($_POST['track']) {
          $app_track               = $_POST['track'];    
      }else{
          $app_track               = "";    
      }
                
    $DATABASE           = PackByID($packId);
    $OWNER              = 0;
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

        $plan_ = findPlanExist($_POST['plan01'], $hora, $packId, AGENCY_ID);


        if ($plan_['plan_ID'] > 0) {



                    $tickets      = cantidadTickets($plan_['plan_ID']);    

                    $ticketsNow = ($tickets+1);

                    $max = $plan_['plan_max_limit'];
                    $min = $plan_['plan_min_limit'];

                    if( ($ticketsNow <= $plan_['plan_max_limit']) && ($ticketsNow >= ($plan_['plan_min_limit']))) {

                          if($freeApp == 'true'){
                                $app_status = 0;
                          }else{
                                $app_status = 1;
                          }

                 
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


                    if( $ticketsNow == $plan_['plan_min_limit'] )  {

                        $available_ticket = true;
                        $available_plan   = 'normal'; 
                        activarPlan($plan_['plan_ID'],$AGENCY);
                                          
                    }




            $plan_status        = $plan_['plan_status'];
            $planId             = $plan_['plan_ID'];
            $app['app_status']  = $app_status;
            $app['price']       = $packPrice;
            $app['userId']      = $userId;
            $app['agencyId']    = $agencyId;
            $app['packId']      = $packId;
            $app['quantity']    = 1;
            $app['total']       = ($packPrice * $quantityApp);
            $app['planId']      = $planId;
            $app['cupon']       = $cupon;
            $app['country']     = $country;
            $app['latitude']    = $latitude;
            $app['longitude']   = $longitude;
            $app['ip']          = json_encode($API2);
            $app['refId']       = $refId;
            $app['app_type']    = 'referer';
            $app['app_survey']  = 0;
            $app['register_by'] =  $register_by;
            $app['track']       =  $app_track;
            $app['freeApp']     = $freeApp;
            $appId              = newApp($app);

            if($appId) EventAPP($appId," Registered by ".$register_by." of ".$refName,'1'); 

        } else {



            
            $plan_status            = 0;
            $plan['packId']         = $packId;
            $plan['price']          = $DATABASE['pack_price'];
            $plan['plan_limit_max'] = $DATABASE['pack_max_limit'];
            $plan['plan_limit_min'] = $DATABASE['pack_min_limit'];
            $plan['departure_date'] = $fecha;
            $plan['departure_time'] = $hora;
            $plan['userId']         = 4;
            $plan['agencyId']       = AGENCY_ID;
            $planId                 = newPlan($plan);


            $ticketsNow = 1;    
            $available_plan   = 'minimo'; 
            $max =  $plan['plan_limit_max'];
            $min =  $plan['plan_limit_min'];


            $app['price']       = $packPrice;
            $app['userId']      = $userId;
            $app['agencyId']    = $agencyId;
            $app['packId']      = $packId;
            $app['quantity']    = $_POST['app08'];
            $app['total']       = ($packPrice * $quantityApp);
            $app['planId']      = $planId;
            $app['country']     = $country;
            $app['latitude']    = $latitude;
            $app['longitude']   = $longitude;
            $app['ip']          = json_encode($API2);
            $app['cupon']       = $cupon;
            $app['refId']       = $refId;
            $app['app_status']  = '0';
            $app['app_type']    = 'referer';
            $app['app_survey']  = 0;
            $app['register_by'] = $register_by;
            $app['freeApp']     = $freeApp;

            $appId              = newApp($app);

            if($appId) EventAPP($appId," Registered by ".$register_by." of ".$refName,'1'); 

        }





        if ($appId){

                    $database__     = AppByID($appId);

                    $status = '*App #'.$ticketsNow.'* [ Min: '.$min.'  | Max: '.$max.' ] ';




                    if ($available_plan=='normal'){

                                $correo = 'Welcome Email';

                                emailAppCreateWebWelcome($database__,$AGENCY);

                    }else if ($available_plan=='minimo'){
                 
                                $correo = 'Welcome Email';

                                emailAppCreateWebWelcome($database__,$AGENCY);


                    }else if ($available_plan=='maximo'){

                                $correo = 'we don’t have availability for the date you requested ';

                                emailAppCreateWebMaximo($database__,$AGENCY);
                    }
                





                    $asunto_slack = "*New app from by :nerd_face: ".$refName." / ".$register_by."* \n:bus: ".$database__['pack_name']."  \n:date: ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") \n:ticket: ".$status." \n:envelope_with_arrow: *Email Sent:* ".$correo." \n:grin: ".$user_fullname." ".$user_email; 


                    $payload = array(
                            'payload' => json_encode(array(
                                'attachments' => array(
                                    0 => array(
                                        'fallback' => 'New app from by :nerd_face: '.$refName.' | '.$register_by,
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


                    if($trans_mode=='10'){

                    }else{
                        efectuarPago(AGENCY_ID,$appId,$_POST);
                    }
      
                    slack_($payload);  
                    echo $appId;

        }else{
            echo 'error';
            notify('Hubo un Error Registrando un App desde el Website \n '.json_enconde($_SERVER));
        }

}




function efectuarPago($agencyId,$appId,$params){

    $database__ = AppByID($appId);

    $m          = new formModel();
    $m->table   = 'form009';
    $m->user    = '0';
    $m->archived= 'no';
    $m->created = $m->now__();
    $m->updated = $m->now__();
    $m->server  = json_encode($_SERVER);
    $m->token   = createToken('form009');
    $m->link    = createLink('form009');    
    $m->code    = GenerarCorrelativo('form009',$agencyId);
    
    $m->dato01  = $database__['user_fullname']; 
    $m->dato02  = $database__['user_email']; 
    $m->dato03  = $database__['user_phone']; 
    $m->dato04  = $database__['user_document']; 
    $m->dato05  = $database__['pack_name']." ".$database__['plan_departure_date']." ".$database__['plan_departure_time']." [".CompleteCode($database__['app_code'])."]"; 
    $m->dato07  = $database__['user_email']; 
    $m->dato09  = 'input'; 
    $m->dato10  = $params['trans_mode']; 
    $m->dato11  = 'N/E'; 
    $m->dato12  = ''; 
    $m->dato13  = ''; 
    $m->dato14  = "approved"; 
    $m->dato26  = floatval($database__['app_total'])-floatval(setMoney($database__['plan_cost'])); 
    $m->dato25  = floatval(setMoney($database__['plan_cost'])); 
    $m->dato27  = floatval($database__['app_total']); 
    $m->dato40  = $database__['app_ID'];  
    $m->dato41  = $database__['user_ID']; 
    $m->dato43  = $idCaja; 
    $m->dato45  = $agencyId;  
    $transId    = $m->save();                
    
            if($transId){
                EventAPP($appId,$database__['plan_cost'],'33'); 
                $app_paid = calculeTotalApp($database__['app_ID'],$params['freeApp']);
            }

}




function calculeTotalApp($appId,$freeApp){

     $m = new formModel();
     $m->internal = true;
     $m->sql_nativo = "SELECT sum(dato25) as total_paid FROM form009  WHERE archived='no' and dato40 in (".$appId.") group by dato40";
     $trans__ = $m->all();


     $m = new formModel();
     $m->internal = true;
     $m->sql_nativo = "SELECT dato26 as total  FROM form005  WHERE id in (".$appId.")";
     $app = $m->all();



     $m = new formModel();
     $m->table      = "form005";
     $m->dato25     = $trans__[0]['total_paid']; 


     $total['pending'] = floatval($app[0]['total'])-floatval($trans__[0]['total_paid']);


    if($freeApp=='false'){
           if($total['pending']<=0){
                        $m->dato01  = 1; 
                        $m->dato10  = 1;
            }
    }


    $m->save($appId);

    $total['paid']   = floatval($trans__[0]['total_paid']);
    
    return $total;

}



       
?>