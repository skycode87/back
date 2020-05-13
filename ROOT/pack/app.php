<?php

define("APP_WITHOUT_CONFIRMATION", 0);
define("APP_CONFIRMED", 1);
define("APP_CANCELED", 2);
define("APP_WAITING_AVAILABILITY",3);



   $APP['app_status']               =  "dato10";
   $APP['app_estado']               =  "dato01";
   $APP['app_comments']             =  "dato03";
   $APP['app_discount']             =  "dato04";
   $APP['app_promo']                =  "dato05";
   $APP['app_track']                =  "dato06";
   $APP['app_quantity']             =  "dato08";
   $APP['app_type']                 =  "dato09";
   $APP['app_cupon']                =  "dato11";
   $APP['app_longitude']            =  "dato13";
   $APP['app_altitude']             =  "dato14";
   $APP['app_country']              =  "dato15";
   $APP['app_survey']               =  "dato16";
   $APP['app_survey_details']       =  "dato17";
   $APP['app_register_by']          =  "dato18";
   $APP['app_confirmation_date']    =  "dato19";
   $APP['app_respon']               =  "dato20";
   $APP['app_send_confirmation']    =  "dato21";
   $APP['app_register_by']          =  "dato18";
   $APP['app_register_by']          =  "dato18";
   $APP['app_register_by']          =  "dato18";
   $APP['app_paid']                 =  "dato25";
   $APP['app_total']                =  "dato26";
   $APP['app_price']                =  "dato27";
   $APP['app_code']                 =  "code";
   $APP['app_token']                =  "token";
   $APP['app_id']                   =  "id";
   $APP['app_events']               =  "dato31";
   $APP['app_userId']               =  "dato42";
   $APP['app_planId']               =  "dato41";
   $APP['app_refId']                =  "dato40";
   $APP['app_created']              =  "created";

define("APP_STATUS_WAITING", 0);
define("APP_STATUS_CONFIRMED", 1);
define("APP_STATUS_CANCELLED", 2);

define("PLAN_PENDING", 0);
define("PLAN_OPEN", 1);
define("PLAN_CLOSE", 2);
define("PLAN_CANCELLED", 3);


define("USER_MAIN", 0);
define("USER_GUEST", 1);


function ref_status_name($x){
    $ref[0] = 'guest';
    $ref[1] = 'boss';
    return $ref[$x];
}


function app_payment_mode($mode){
  
    if( strtolower($mode)=='without payment'){
      return 10;
    }else if( strtolower($mode)=='cash'){
      return 0;
    }else if( strtolower($mode)=='credit card'){
      return 1;
    }else if( strtolower($mode)=='debit card'){
      return 2;
    }else {
      return 3;
    }

}


  
   $PLAN['plan_departure_date']     =  "dato01";
   $PLAN['plan_duration']           =  "dato02";
   $PLAN['plan_departure_time']     =  "dato03";
   $PLAN['plan_max_limit']          =  "dato06";
   $PLAN['plan_min_limit']          =  "dato07";
   $PLAN['plan_quantity']           =  "dato08";
   $PLAN['plan_price']              =  "dato09";
   $PLAN['plan_status']             =  "dato10";
   $PLAN['plan_colour']             =  "dato13";
   $PLAN['plan_close']              =  "dato14";
   $PLAN['plan_external_link']      =  "dato15";
   $PLAN['plan_external_date']      =  "dato16";
   $PLAN['plan_observation']        =  "dato31";
   $PLAN['plan_photo']              =  "dato30";
   $PLAN['plan_cost']               =  "dato25";
   $PLAN['plan_id']                 =  "id";
   $PLAN['plan_link']               =  "link";   
   $PLAN['plan_token']              =  "token";
   $PLAN['plan_code']               =  "code";
   $PLAN['plan_packId']             =  "dato41";
   $PLAN['plan_refererId']          =  "dato43";
   $PLAN['plan_created']            =  "created";

   $USR['user_fullname']           = "dato01";
   $USR['user_document']           = "dato02";
   $USR['user_ID_type']            = "dato03";
   $USR['user_email']              = "dato04";
   $USR['user_phone']              = "dato05";
   $USR['user_nationality']        = "dato06";
   $USR['user_location']           = "dato07";
   $USR['user_gender']             = "dato08";
   $USR['user_type']               = "dato10";
   $USR['user_additional_info']    = "dato12";
   $USR['user_id']                 =  "id";
   $USR['user_token']              =  "token";
   $USR['user_code']               =  "code";
   $USR['user_created']            =  "created";

   $TRANS['trans_fullname']                 = "dato01";
   $TRANS['trans_email2']                   = "dato02";
   $TRANS['trans_details']                  = "dato05";
   $TRANS['trans_type']                     = "dato09";
   $TRANS['trans_email']                    = "dato07";
   $TRANS['trans_mode']                     = "dato10";
   $TRANS['trans_reference_number']         = "dato11";
   $TRANS['trans_card_holder']              = "dato12";
   $TRANS['trans_comments']                 = "dato13";
   $TRANS['trans_aproved']                  = "dato14";
   $TRANS['trans_status']                   = "dato15";
   $TRANS['trans_paid']                     = "dato25";
   $TRANS['trans_pending']                  = "dato26";
   $TRANS['trans_total']                    = "dato27";
   $TRANS['trans_id']                       =  "id";
   $TRANS['trans_token']                    =  "token";
   $TRANS['trans_code']                     =  "code";
   $TRANS['trans_link']                     =  "link";
   $TRANS['trans_created']                  =  "created";
      


 

     


function appSingle($rows,$ID,$WHERE="1=1"){

    $sql = " SELECT ";

    foreach ( $rows as $key=>$value){
             $sql = $sql." ".$value." AS ".$key.",";
    }

      $sql.=" '' as '' FROM   form005  WHERE id in (".$ID.")  and ".$WHERE." and archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res[0];
}



function tokenAgent($agentId,$TOKENOBJECT){
    
        $m               = new formModel();
        $m->sql_nativo   = "
        SELECT 
        agent.token     AS 'agent_token'
        From form002 agent 
        Where agent.dato40 in ('".$agentId."') and agent.dato01 in ('agent') and agent.archived='no' limit 1 ";
    
        $m->internal     = true;
     
        $agent            =  $m->all();

        return $agent[0]['agent_token']."lsd0lsd1lsd".$TOKENOBJECT."lsd3";
}


function PackByID($packId){

  $sql = "SELECT 
        agency.dato01   AS 'agency_name',
        agency.dato02   AS 'agency_email',
        agency.dato04   AS 'agency_phone',
        agency.dato05   AS 'agency_whatsapp',
        agency.dato06   AS 'agency_document',
        agency.dato08   AS 'agency_domain',
        agency.dato09   AS 'agency_owner',
        agency.dato10   AS 'agency_privatephone',
        agency.dato11   AS 'agency_privateemail',
        agency.dato12   AS 'agency_alias',
        agency.dato30   AS 'agency_avatar',        
        agency.id       AS 'agency_ID',        
        pack.dato01     AS 'pack_name',
        pack.dato03     AS 'pack_duration',
        pack.dato05     AS 'pack_contact',        
        pack.dato06     AS 'pack_max_limit',
        pack.dato07     AS 'pack_min_limit',
        pack.dato08     AS 'pack_price',
        pack.dato10     AS 'pack_status',
        pack.dato15     AS 'pack_phone', 
        pack.dato13     AS 'pack_departure',                        
        pack.dato30     AS 'pack_gallery',
        pack.dato31     AS 'pack_url_avatar',
        pack.dato32     AS 'pack_category',
        pack.dato35     AS 'pack_email_registration',
        pack.dato36     AS 'pack_email_closure',
        pack.dato35     AS 'pack_email_registration',
        pack.dato36     AS 'Pack_email_closure',        
        pack.dato37     AS 'pack_summary',
        pack.dato38     AS 'pack_itinerary',
        pack.dato39     AS 'google_maps_iframe',
        pack.token      AS 'pack_token',
        pack.id         AS 'pack_ID'
		FROM   form003 agency, 
		       form004 pack 
		WHERE  pack.id in ('".$packId."') 
		       AND agency.id     = pack.dato40";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res[0];
}

function findPlanExist($fecha,$hora,$packId,$agencyId){

 		$plan               = new formModel();
        $plan->sql_nativo   = "
        SELECT 
		plan.dato01     AS 'plan_departure_date',
        plan.dato02     AS 'plan_duration',
        plan.dato03     AS 'plan_departure_time',
        plan.dato05     AS 'plan_arrival_time',
        plan.dato06     AS 'plan_max_limit',
        plan.dato07     AS 'plan_min_limit',
        plan.dato08     AS 'plan_quantity',
        plan.dato09     AS 'plan_price',
        plan.dato10     AS 'plan_status',
        plan.dato11     AS 'plan_counter',
        plan.dato13     AS 'plan_colour',
        plan.dato25     AS 'plan_cost',
        plan.dato30     AS 'plan_photo',
        plan.link       AS 'plan_link',
        plan.id         AS 'plan_ID'
        From form001 plan 
        Where plan.dato01 in ('".$fecha."') and plan.dato03 in ('".ltrim($hora)."') and plan.dato40 in ('".$agencyId."') and plan.dato41 in ('".$packId."') and plan.archived='no' ";
     
        $plan->internal     = true;
     
        $rs_plan            =  $plan->all();

        if($rs_plan[0]['plan_ID']){

            return $rs_plan[0];
        }else{
            return $rs_plan[0] = false;
        }
}

function countAppByPlan($planID){

        $plan               = new formModel();
        $plan->sql_nativo   = "SELECT count(dato10) as cantidad, dato10 as status from form005 where dato41 in ('".$planID."') group by dato10";
        $plan->internal     = true;  
        $rs_plan            =  $plan->all();
        $rs_plan['total']   = 0;

        for ($i=0; $i < count($rs_plan); $i++) { 
             $rs_plan['total'] =  $rs_plan[$i]['cantidad'] + $rs_plan['total'];
        }


        if($rs_plan['total']>0){
            return $rs_plan;
        }else{
            return $rs_plan[0] = false;
        }
}

function countTicketsByPlan($planID){

        $plan               = new formModel();
        $plan->sql_nativo   = "SELECT dato08 as 'app_quantity' from form005 where ( dato10='1' || dato10='0' ) and dato41 in ('".$planID."') and archived='no' ";
        $plan->internal     = true;  
        $rs_plan            =  $plan->all();

        $total = 0;

        for ($i=0; $i < count($rs_plan); $i++) { 
             $total =  $rs_plan[$i]['app_quantity'] + $total;
        }

        return $total;     
}

function AppByID($appId){

 	      $sql = "SELECT 
        agency.dato01   AS 'agency_name',
        agency.dato02   AS 'agency_email',
        agency.dato04   AS 'agency_phone',
        agency.dato05   AS 'agency_whatsapp',
        agency.dato06   AS 'agency_document',
        agency.dato08   AS 'agency_domain',
        agency.dato09   AS 'agency_owner',
        agency.dato10   AS 'agency_privatephone',
        agency.dato11   AS 'agency_privateemail',
        agency.dato12   AS 'agency_alias',
        agency.dato18   AS 'agency_header_color',
        agency.dato30   AS 'agency_avatar',        
        agency.dato31   AS 'agency_logo_white',        
        agency.id       AS 'agency_ID',        
        pack.dato01     AS 'pack_name',
        pack.dato03     AS 'pack_duration',
        pack.dato06     AS 'pack_max_limit',
        pack.dato07     AS 'pack_min_limit',
        pack.dato08     AS 'pack_price',
        pack.dato10     AS 'pack_status',
        pack.dato30     AS 'pack_gallery',
        pack.dato31     AS 'pack_url_avatar',
        pack.dato32     AS 'pack_category',
        pack.dato34     AS 'pack_email_welcome',
        pack.dato35     AS 'pack_email_registration',
        pack.dato33     AS 'pack_email_confirmation',
        pack.dato36     AS 'pack_email_closure',
        pack.dato37     AS 'pack_summary',
        pack.dato38     AS 'pack_itinerary',
        pack.dato39     AS 'google_maps_iframe',
        pack.token      AS 'pack_token',
        pack.id         AS 'pack_id',
        plan.dato01     AS 'plan_departure_date',
        plan.dato02     AS 'plan_duration',
        plan.dato03     AS 'plan_departure_time',
        plan.dato05     AS 'plan_arrival_time',
        plan.dato06     AS 'plan_max_limit',
        plan.dato07     AS 'plan_min_limit',
        plan.dato08     AS 'plan_quantity',
        plan.dato09     AS 'plan_price',
        plan.dato10     AS 'plan_status',
        plan.dato11     AS 'plan_counter',
        plan.dato13     AS 'plan_colour',
        plan.dato25     AS 'plan_cost',
        plan.dato30     AS 'plan_photo',
        plan.id         AS 'plan_ID',
        plan.token      AS 'plan_token',                
        user.dato01     AS 'user_fullname',
        user.dato02     AS 'user_document',
        user.dato03     AS 'user_ID_type',
        user.dato04     AS 'user_email',
        user.dato05     AS 'user_phone',
        user.dato06     AS 'user_nationality',
        user.dato07     AS 'user_location',
        user.dato08     AS 'user_gender',
        user.token      AS 'user_token',
        user.dato09     AS 'user_type',
        user.dato10     AS 'user_main_language',
        user.dato11     AS 'user_country_of_birth',
        user.dato12     AS 'user_additional_info',
        user.id         AS 'user_ID',        
        app.dato01      AS 'app_status',
        app.dato03      AS 'app_comments',
        app.dato04      AS 'app_discount',
        app.dato05      AS 'app_promo',
        app.dato08      AS 'app_quantity',
        app.dato09      AS 'app_type',
        app.dato10      AS 'app_status',
        app.dato25      AS 'app_paid',
        app.dato26      AS 'app_total',
        app.dato27      AS 'app_price',
        app.code        AS 'app_code',
        app.token       AS 'app_token',
        app.dato18      AS 'app_register_by',
        app.dato19      AS 'app_confirmation_date',
        app.dato21      AS 'app_send_confirmation',
        app.id          AS 'app_ID'
		FROM   form006 user, 
		       form005 app, 
		       form014 website, 
		       form001 plan, 
		       form003 agency, 
		       form004 pack 
		WHERE  app.id in ('".$appId."') 
		       AND app.dato42      = user.id 
		       AND app.dato41      = plan.id
		       AND website.dato40  = agency.id 
		       AND plan.dato41     = pack.id";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res[0];
}


function archivarPlan($plan_id){

            $sql = "select count(plan.id) as 'total', plan.id  as 'id' from form001 plan join form005 app on app.dato41 = plan.id and app.archived='no' and plan.archived= 'no' and plan.id in (".$plan_id.") group by plan.id order by 1 desc ";

            $m             = new formModel();
            $m->sql_nativo = $sql;
            $m->internal   = true;
            $res1          = $m->all();

            if(!$res1[0]['id']){
                $m              = new formModel();
                $m->table     = 'form001';
                $m->archived    = 'yes';
                $m->updated(intval($plan_id));
            } 

}


function appData($id,$alcance,$tipo,$select,$extra=" and 1=1"){


        if(($tipo=='app')||($tipo=='pack')){
            $where = " WHERE app.id in ('".$id."') ";
        }


        if($tipo=='plan'){
           $where = " WHERE plan.id in ('".$id."') and app.archived = 'no'  ";
        }
        

         $sql = "SELECT"; 

         $plan_select ="";
         $pack_select ="";
         $app_select  ="";

    if(($select=='*')||($select=='single')){

            if($alcance=='plan'){

            
                  $sql.= $plan_select.= " 
                  plan.dato01     AS 'plan_departure_date',
                  plan.dato02     AS 'plan_duration',
                  plan.dato03     AS 'plan_departure_time',
                  plan.dato05     AS 'plan_arrival_time',
                  plan.dato06     AS 'plan_max_limit',
                  plan.dato07     AS 'plan_min_limit',
                  plan.dato08     AS 'plan_quantity',
                  plan.dato09     AS 'plan_price',
                  plan.dato10     AS 'plan_status',
                  plan.dato11     AS 'plan_counter',
                  plan.dato13     AS 'plan_colour',
                  plan.dato25     AS 'plan_cost',
                  plan.dato30     AS 'plan_photo',
                  plan.id         AS 'plan_ID',
                  plan.id         AS 'plan_id',        
                  plan.token      AS 'plan_token',";

            }


            if(($alcance=='pack')||($alcance=='plan')){

                  $sql.= $pack_select.= " 
                  pack.dato01     AS 'pack_name',
                  pack.dato03     AS 'pack_duration',
                  pack.dato06     AS 'pack_max_limit',
                  pack.dato07     AS 'pack_min_limit',
                  pack.dato08     AS 'pack_price',
                  pack.dato10     AS 'pack_status',
                  pack.dato30     AS 'pack_gallery',
                  pack.dato31     AS 'pack_url_avatar',
                  pack.dato32     AS 'pack_category',
                  pack.dato34     AS 'pack_email_welcome',
                  pack.dato35     AS 'pack_email_registration',
                  pack.dato33     AS 'pack_email_confirmation',
                  pack.dato36     AS 'pack_email_closure',
                  pack.dato37     AS 'pack_summary',
                  pack.dato38     AS 'pack_itinerary',
                  pack.dato39     AS 'google_maps_iframe',
                  pack.token      AS 'pack_token',
                  pack.id         AS 'pack_id',";

            }



            if(($alcance=='app')||($alcance=='pack')||($alcance=='plan')){

                $sql.= $app_select.= " 
                user.dato01     AS 'user_fullname',
                user.dato02     AS 'user_document',
                user.dato03     AS 'user_ID_type',
                user.dato04     AS 'user_email',
                user.dato05     AS 'user_phone',
                user.dato06     AS 'user_nationality',
                user.dato07     AS 'user_location',
                user.dato08     AS 'user_gender',
                user.token      AS 'user_token',
                user.dato09     AS 'user_type',
                user.dato10     AS 'user_main_language',
                user.dato11     AS 'user_country_of_birth',
                user.dato12     AS 'user_additional_info',
                user.id         AS 'user_ID', 
                user.id         AS 'user_id',                       
                app.dato01      AS 'app_status',
                app.dato03      AS 'app_comments',
                app.dato04      AS 'app_discount',
                app.dato05      AS 'app_promo',
                app.dato08      AS 'app_quantity',
                app.dato10      AS 'app_status',
                app.dato11      AS 'app_cupon',
                app.dato25      AS 'app_paid',
                app.dato26      AS 'app_total',
                app.dato27      AS 'app_price',
                app.code        AS 'app_code',
                app.token       AS 'app_token',
                app.dato18      AS 'app_register_by',
                app.dato19      AS 'app_confirmation_date',
                app.dato21      AS 'app_send_confirmation',
                app.dato15      AS 'app_country',
                app.dato01      AS 'app_estado', 
                app.dato16      AS 'app_survey',
                app.dato17      AS 'app_survey_details',
                DATE_FORMAT(app.created,'%W %d/%m/%Y %h:%i %p ') AS 'app_created',
                app.id          AS 'app_ID',
                app.id          AS 'app_id',
                app.dato09      AS 'app_type',
                app.dato31      AS 'app_events',
                ref.created     AS 'ref_created',
                ref.dato01      AS 'ref_fullname',
                ref.code        AS 'ref_code',
                ref.token       AS 'ref_token',
                ref.id          AS 'ref_id',
                ref.dato02      AS 'ref_email',
                ref.dato03      AS 'ref_phone',
                ref.dato04      AS 'ref_alias',
                ref.dato05      AS 'ref_document',
                ref.dato06      AS 'ref_document_type',
                ref.dato10      AS 'ref_status',
                ref.dato07      AS 'ref_lastsesion',
                ref.dato08      AS 'ref_address',
                ref.dato31      AS 'ref_observation',
                ref.dato30      AS 'ref_avatar',
                CASE
                      WHEN ref.dato10 = 0 THEN 'guest'
                      WHEN ref.dato10 = 1 THEN 'boss'
                      ELSE ''
                END AS 'ref_status_name' ";
            }


    }else{

       $sql.= $select;

    }


    if($select=='single'){

      if($alcance=='plan') $sql = "SELECT ".substr($plan_select,0,-1);
      
      if($alcance=='app')  $sql = "SELECT ".substr($app_select,0,-1);
      
      if($alcance=='pack') $sql = "SELECT ".substr($pack_select,0,-1);

    }


    $sql.=" FROM   
    form005 app 
    join form006 user on app.dato42  = user.id 
    join form001 plan on app.dato41  = plan.id
    join form004 pack on plan.dato41 = pack.id
    left join form008 ref  on app.dato40  = ref.id ".$where." ".$extra;

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      


      if(($tipo=='plan')&&($select=='single')){
        return $res[0];
      } 
      
      if($tipo=='plan'){
        return $res;
      } 

      if($tipo=='app'){
        return $res[0];
      } 

}


function ContentEmailByID($agency){

    $m = new formModel();
    $m->sql_nativo = " SELECT * FROM form020  WHERE dato40 in ('".$agency."') and archived = 'no' ";
    $m->internal = true;
    $res = $m->all();

  	for($i=0;$i<count($res);$i++){
  	  $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
  	}

  	return $SYSTEM;
}
      


function agencyInfo($AGENCY_){

     $database = master('form003','agency','null','null',$AGENCY_,$_SESSION['AG'],'id in ('.$_SESSION['AG'].')');
  
     return $database[0]; 

}



function appSendEmail($agency,$appId,$message){

    $database__     = AppByID($appId);

    $SYSTEM         = ContentEmailByID($agency);

    $data['body']   = "
    
    <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$message."
    </p>
        ";
    
     sendEmail__($database__," Hi  ".$database__['user_fullname'], $data['body']);

}




function activarPlan($idPlan,$AGENCY)
{

        $sql           = " SELECT id FROM form005 where dato41 in ($idPlan)  and archived='no' and dato10 in (0) ";
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        for ($i = 0;$i < count($res);$i++)
        {

             $database__     = AppByID($res[$i]['id']);
             emailAppCreateWebNormal($database__,$AGENCY);
        }
}



function emailAppWelcome($agency,$database__){

   // $database__   = AppByID($appId);

    $SYSTEM         = ContentEmailByID($agency);

   
    $data['body']   = "

        <h2>Welcome abroad  ".$database__['user_fullname']."</h2>

        <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$database__['pack_email_welcome']."
        </p>

        <p style='font-size: 14px;line-height: 18px;padding: 20px 40px;background: #ffc1072e; margin-bottom: 30px; margin-top: 30px;'>
                <b>Tour Name: </b>".$database__['pack_name']."
                <br>
                <b>Departure Time: </b>".$database__['plan_departure_date']." / " .$database__['plan_departure_time']."
                <br>
                <b> # Tickets:</b> " .$database__['app_quantity']. "
                <br>
                <b>Price Unit:</b> " .number_format($database__['app_price'], 2, ",", "."). " COP
                <br>
                <b>Total: </b>".number_format($database__['app_total'], 2, ",", "."). " COP
                <br>
        </p>

        <p style='text-align:center'>
            ".$SYSTEM['sys_email_footer']."
        </p>";
    
  
     sendEmail__($database__, "Welcome abroad  ".$database__['user_fullname']." [ " . $database__['pack_name'] . " ] [" . $database__['agency_name'] . "]", $data['body']);
}


function emailAppClosure($agency,$appId){



    $database__     = AppByID($appId);

    $SYSTEM         = ContentEmailByID($agency);
       
    $url_good ="https://ibusuites.com/form/survey/index.html?code=".$database__['user_token']."&email=".$database__['user_email']."&token_app=".$database__ [$i]['app_token']."&think=3";

    $url_excellent ="https://ibusuites.com/form/survey/index.html?code=".$database__['user_token']."&email=".$database__['user_email']."&token_app=".$database__['app_token']."&think=5";

    $url_poor ="https://ibusuites.com/form/survey/index.html?code=".$database__['user_token']."&email=".$database__['user_email']."&token_app=".$database__['app_token']."&think=1";

    $data['body']   = "
            <p style='font-size:14px; line-height:18px;text-align: justify;'>
            ".$database__['pack_email_closure']."
            </p>

            <h3>How was your experience with us?</h3>
            <p style='text-align:center'>
            <a href='".$url_excellent."'  style='border-radius:4px; font-weight:bold; color:#fff; background:darkgreen; color:#fff; padding:15px 30px'>
            EXCELLENT
            </a>
            </p>
            <br>
            <p style='text-align:center'>
            <a href='".$url_good."'  style='border-radius:4px; font-weight:bold; color:#fff; background:orange; color:#fff; padding:15px 30px'>
            GOOD
            </a>
            </p>

               <p style='text-align:center'>
            <a href='".$url_poor."'  style='border-radius:4px; font-weight:bold; color:#fff; background:red; color:#fff; padding:15px 30px'>
            GOOD
            </a>
            </p>
           
            <p style='text-align:center'>
                ".$SYSTEM['sys_email_footer']."
            </p>";
        
      
         sendEmail__($database__," We hope you enjoyed your time with us!. ", $data['body']);
    }



function emailAppCreateWebMaximo($database__,$squema){

     $DATA_ = agencyInfo($squema);
   
     $data['body']   = "
        <p style='font-size:14px; line-height:18px'>
        ".$DATA_['agency_email_maximo_body']."
        </p>
          <p style='text-align:center'>
             ".$DATA_['agency_email_footer']."
        </p> ";

       sendEmail__($database__,$DATA_['agency_email_maximo_subject'], $data['body']);

}


function emailAppCreateWebOpened($agencyId,$planId){

        $m               = new formModel();
        $m->sql_nativo   = "SELECT id from form005 where dato41 in ('".$planId."') and dato45 in ('".$agencyId."') and archived = 'no' and dato10='0'  ";
        $m->internal     = true;  
        $apps            =  $m->all();


        for ($i=0; $i < count($apps); $i++) { 
             appSendConfirmation($agencyId,$apps[$i]['id']);
        }

        $m             = new formModel();
        $m->table      = 'form001';    
        $m->dato10     = 1;   
        $m->updated    = $m->now__();
        $m->updated($planId);

        $database__ = PackByID($apps[0]['id']);

        $asunto = "A Tour has been opened.";

        $body = "This tour ".$database__['pack_name']."  on ".formatDate($_POST['plan01'])." (".$_POST['plan04'].") has been opened. It has ".listAppsConfirmadas($agencyId,$planId)." confirmed applications.";


        sendEmailAdmin__(AGENCY_ID,$asunto,$body);
}


function emailAppCreateWebMinimo($database__,$squema){

    $DATA_ = agencyInfo($squema);

    $data['body']   = "
        <p style='font-size:14px; line-height:18px'>
        ".$DATA_['agency_email_minimo_body']."
        </p>
        <p style='text-align:center'>
             ".$DATA_['agency_email_footer']."
        </p> ";

       sendEmail__($database__,$DATA_['agency_email_minimo_subject'], $data['body']);
}


function emailAppCreateWebNormal($database__,$squema){
  

    $DATA_          = agencyInfo($squema);

    $SYSTEM         = ContentEmailByID($_SESSION['AGENCY_ID']);

    $url_ok         = $SYSTEM['backend_server']."/ROOT/pack/appUpdateStatus.php/".tokenAgent($_SESSION['AGENCY_ID'],$database__['app_token'])."/1";
    
    $url_cancel      = $SYSTEM['backend_server']."/ROOT/pack/appUpdateStatus.php/".tokenAgent($_SESSION['AGENCY_ID'],$database__['app_token'])."/2";


    $data['body']   = "
    
    <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$database__['pack_email_confirmation']."
    </p>

    <p style='text-align:center'>
            <a href=''  style='border-radius:4px; margin-top:30px; font-weight:bold; color:#fff; background:darkgreen; color:#fff; padding:7px 20px'>
                    Confirm Tour Attendance
            </a>  
    </p>

    <p style='text-align:center; padding-top:20px'>
        <a  href='' style='border-radius:4px; margin-top:30px; font-weight:bold; color:#fff;  background:darkred; color:#fff; padding:7px 20px'>
                Cancel booking
        </a>
    </p>



        <p style='font-size: 14px;line-height: 18px;padding: 20px 40px;background: #ffc1072e; margin-bottom: 30px; margin-top: 30px;'>
                <b>Tour Name: </b>".$database__['pack_name']."
                <br>
                <b>Departure Time: </b>".$database__['plan_departure_date']." / " .$database__['plan_departure_time']."
                <br>
                <b> # Tickets:</b> " .$database__['app_quantity']. "
                <br>
                <b>Price Unit:</b> " .number_format($database__['app_price'], 2, ",", "."). " COP
                <br>
                <b>Total: </b>".number_format($database__['app_total'], 2, ",", "."). " COP
                <br>
        </p>

         <p style='text-align:center'>
             ".$DATA_['agency_email_footer']."
        </p> ";
    
    

     sendEmail__($database__, " Confirmation email " . $database__['pack_name'] . "  [" . $database__['agency_name'] . "]", $data['body']);
}

function cantidadTickets($planID){

        $plan               = new formModel();
        $plan->sql_nativo   = "SELECT dato08 as 'app_quantity' from form005 where ( dato10='1' || dato10='0' || dato10='3' ) and dato41 in ('".$planID."') and archived='no' ";
        $plan->internal     = true;  
        $rs_plan            =  $plan->all();

        $total = 0;

        for ($i=0; $i < count($rs_plan); $i++) { 
             $total =  $rs_plan[$i]['app_quantity'] + $total;
        }

        return $total;     
}

function emailAppCreateWebWelcome($database__,$squema){

    $DATA_          = agencyInfo($squema);

    $data['body']   = "

        <h2>Welcome abroad  ".$database__['user_fullname']."</h2>

        <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$database__['pack_email_welcome']."
        </p>

        <p style='font-size: 14px;line-height: 18px;padding: 20px 40px;background: #ffc1072e; margin-bottom: 30px; margin-top: 30px;'>
                <b>Tour Name: </b>".$database__['pack_name']."
                <br>
                <b>Departure Time: </b>".$database__['plan_departure_date']." / " .$database__['plan_departure_time']."
                <br>
                <b> # Tickets:</b> " .$database__['app_quantity']. "
                <br>
                <b>Price Unit:</b> " .number_format($database__['app_price'], 2, ",", "."). " COP
                <br>
                <b>Total: </b>".number_format($database__['app_total'], 2, ",", "."). " COP
                <br>
        </p>

        <p style='text-align:center'>
             ".$DATA_['agency_email_footer']."
        </p> ";
    
  
     sendEmail__($database__, "Welcome abroad  ".$database__['user_fullname']." [ " . $database__['pack_name'] . " ] [" . $database__['agency_name'] . "]", $data['body']);
}

function appSendConfirmation($agency,$appId){

    $database__     = AppByID($appId);

    $SYSTEM         = ContentEmailByID($_SESSION['AG']);

    $url_ok         = $SYSTEM['backend_server']."/ROOT/pack/appUpdateStatus.php/".tokenAgent($_SESSION['AG'],$database__['app_token'])."/1";
    
    $url_cancel      = $SYSTEM['backend_server']."/ROOT/pack/appUpdateStatus.php/".tokenAgent($_SESSION['AG'],$database__['app_token'])."/2";


    $data['body']   = "
    
    <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$database__['pack_email_confirmation']."
    </p>

    <p style='text-align:center'>
            <a href='" . $url_ok . "'  style='border-radius:4px; margin-top:30px; font-weight:bold; color:#fff; background:darkgreen; color:#fff; padding:7px 20px'>
                    Confirm Tour Attendance
            </a>  
    </p>

    <p style='text-align:center; padding-top:20px'>
        <a  href='" . $url_cancel . "' style='border-radius:4px; margin-top:30px; font-weight:bold; color:#fff;  background:darkred; color:#fff; padding:7px 20px'>
                Cancel booking
        </a>
    </p>



        <p style='font-size: 14px;line-height: 18px;padding: 20px 40px;background: #ffc1072e; margin-bottom: 30px; margin-top: 30px;'>
                <b>Tour Name: </b>".$database__['pack_name']."
                <br>
                <b>Departure Time: </b>".$database__['plan_departure_date']." / " .$database__['plan_departure_time']."
                <br>
                <b> # Tickets:</b> " .$database__['app_quantity']. "
                <br>
                <b>Price Unit:</b> " .number_format($database__['app_price'], 2, ",", "."). " COP
                <br>
                <b>Total: </b>".number_format($database__['app_total'], 2, ",", "."). " COP
                <br>
        </p>

        <p style='text-align:center'>
            ".$SYSTEM['sys_email_footer']."
        </p>
        ";
    

     sendEmail__($database__, " Confirmation email " . $database__['pack_name'] . "  [" . $database__['agency_name'] . "]", $data['body']);
}


function emailAppCreateWeb_available($agency,$database__){


    $SYSTEM     = ContentEmailByID($agency);

   
    $data['body']   = "
        <p style='font-size:14px; line-height:18px;text-align: justify; !important'>
        ".$database__['pack_email_registration']."
        </p>

        <p style='font-size: 14px;line-height: 18px;padding: 20px 40px;background: #ffc1072e; margin-bottom: 30px; margin-top: 30px;'>
                <b>Tour Name: </b>".$database__['pack_name']."
                <br>
                <b>Departure Time: </b>".$database__['plan_departure_date']." / " .$database__['plan_departure_time']."
                <br>
                <b> # Tickets:</b> " .$database__['app_quantity']. "
                <br>
                <b>Price Unit:</b> " .number_format($database__['app_price'], 2, ",", "."). " COP
                <br>
                <b>Total: </b>".number_format($database__['app_total'], 2, ",", "."). " COP
                <br>
        </p>

        <p style='text-align:center'>
            ".$SYSTEM['sys_email_footer']."
        </p>";
    
  
     sendEmail__($database__, "Welcome to " . $database__['pack_name'] . "  [" . $database__['agency_name'] . "]", $data['body']);
}


function sendEmail__($database_,$asunto, $mensaje){
 

	    if(comprobar_email($database_['user_email'])==0){      
	   
            notify("email:".$database_['user_email']." ".$database_['user_fullname']." email Erroneo");
	   
      }else{


            $to__      = $database_['user_email'];
            $subject   = $asunto;
            $from_name = $database_['agency_name'];
            $from_     = "ibusuite@qreatech.com";
            $html      = sendEmail__Template($database_,$mensaje);
            $from      = new SendGrid\Email($from_name, $from_);
            $subject   = $subject;
            $to        = new SendGrid\Email("ibusuite", $to__);
            $content   = new SendGrid\Content("text/html", $html);
            $mail      = new SendGrid\Mail($from, $subject, $to, $content);
            //$apiKey    = "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"; 
            $apiKey    = "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"; 
            $sg        = new \SendGrid($apiKey);
            $response  = $sg->client->mail()->send()->post($mail);

            if ($response->statusCode() != "202") {
            }else{
            }

            newEmail($asunto,$database_['pack_name'],$to__,'202','1',$response->statusCode(),$database_['app_ID']);

      }

}


function sendEmailToEmail__($database_,$asunto, $mensaje,$email){


      if(comprobar_email($database_['user_email'])==0){      
            notify(" email:".$database_['user_email']." email Erroneo");
          return false;
      }

      $to__      = $email;
      $subject   = $asunto;
      $from_name = $database_['agency_name'];
      $from_     = "ibusuite@qreatech.com";
      $html      = sendEmail__Template($database_,$mensaje);
      $from      = new SendGrid\Email($from_name, $from_);
      $subject   = $subject;
      $to        = new SendGrid\Email("ibusuite", $to__);
      $content   = new SendGrid\Content("text/html", $html);
      $mail      = new SendGrid\Mail($from, $subject, $to, $content);
      $apiKey    = "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"; 
      $sg        = new \SendGrid($apiKey);
      $response  = $sg->client->mail()->send()->post($mail);

    if ($response->statusCode() != "202") {
    }else{
    }

    newEmail($asunto,$database_['pack_name'],$to__,'202','1',$response->statusCode(),$database_['app_ID']);

}



function sendEmail__Template($database_,$body){

 $SYSTEM 		= ContentEmailByID($database_['agency_ID']);

    
 return  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width\"/>
    <!-- For development, pass document through inliner -->
    <link rel=\"stylesheet\" href=\"css/simple.css\">
    <style type=\"text/css\">

	* { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif; line-height: 1.65; }

	img { max-width: 100%; margin: 0 auto; display: block; }

	body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }

	a { color: #71bc37; text-decoration: none; }

	a:hover { text-decoration: underline; }

	.text-center { text-align: center; }

	.text-right { text-align: right; }

	.text-left { text-align: left; }

	.button { display: inline-block; color: white; background: #71bc37; border: solid #71bc37; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

	.button:hover { text-decoration: none; }

	h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

	h1 { font-size: 32px; }

	h2 { font-size: 28px; }

	h3 { font-size: 24px; }

	h4 { font-size: 20px; }

	h5 { font-size: 16px; }

	p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

	.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }

	.container table { width: 100% !important; border-collapse: collapse; }

	.container .masthead { padding: 80px 0; background: #71bc37; color: white; }

	.container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

	.container .content { background: white; padding: 30px 35px; }

	.container .content.footer { background: none; }

	.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

	.container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

	.container .content.footer a:hover { text-decoration: underline; }


	    </style>
	</head>
	<body>
	<table class=\"body-wrap\">
	    <tr>
	        <td class=\"container\">
	            <table>
                        <tr style='background:#dedede'>
	                    <td align=\"center\">
	                       <br><img width='150px' src='".$SYSTEM['logo_color']."' alt='".$database_['agency_name']."' /><br>
	                    </td>
	                </tr>

	                <tr>
	                    <td class=\"content\">
	                       ".$body."
	                    </td>
	                </tr>

	                <td align=\"center\" style='background:#fcfcfc'><br><br>
	                   <a style='border-radius:4px; padding:7px 40px; font-weight:bold; background:orange; text-decoration: none; cursor:pointer; color:#fff' href='https://api.whatsapp.com/send?phone=".$database_['agency_phone']."'>
	                    Chat with Us!!
	                    </a><br><br><br><br><br><br>
	                </td>
	                
	            </table>
	        </td>
	    </tr>
	</table>
	</body>
	</html>";
}


function newPlan($params)
{
    
    $m           = new formModel();
    $m->table    = "form001";
    $m->user     = 0;
    $m->archived = 'no';
    $m->created  = $m->now__();
    $m->updated  = $m->now__();    
    $m->code     = createCode('form001');
    $m->token    = createToken('form001');
    $m->link     = createLink('form001');
    $m->dato01   = $params['departure_date'];
    $m->dato03   = ltrim($params['departure_time']);
    $m->dato06   = $params['plan_limit_max'];
    $m->dato07   = $params['plan_limit_min'];
    $m->dato40   = $params['agencyId'];
    $m->dato41   = $params['packId'];
    $m->dato45   = $params['agencyId'];
    $m->dato42   = 0;
    $m->dato25   = setMoney($params['price']);
    $m->dato10   = 0;
    $m->dato11   = 1;
    $m->dato13   = setColor();
    $m->dato26   = 0;
    $m->dato27   = 0;
    $m->dato28   = 0;
    $id          = $m->save();    
    return $id;

}

function newApp($params)
{
    
    $m           = new formModel();
    $m->table    = 'form005';
    $m->user     = 0;
    $m->archived = 'no';
    $m->created  = $m->now__();
    $m->updated  = $m->now__();

    $m->code     = createCode('form005');
    $m->token    = createToken('form005');
    $m->link     = createLink('form005');

    $m->dato01   = $params['app_status'];
    $m->dato06   = $params['app_track'];
    $m->dato10   = $params['app_status'];
    $m->dato11   = $params['cupon'];
    $m->dato12   = '';
    $m->dato16   = '0';
    $m->dato09   = $params['app_type'];

    $m->dato26   = setMoney($params['total']);
    $m->dato25   = setMoney(0);
    $m->dato27   = setMoney($params['price']);
           

    $m->dato13   = $params['latitude'];
    $m->dato14   = $params['longitude'];

    $m->dato15   = $params['country'];
    $m->dato18   = $params['register_by'];

    $m->dato32   = $params['ip'];
    $m->dato08   = $params['quantity'];

    $m->dato40   = $params['refId'];

    $m->dato41   = $params['planId'];
    /* Tour */
    $m->dato42   = $params['userId'];
    /* Cliente */
    $m->dato43   = $params['userId'];
    $m->dato45   = $params['agencyId'];
    /* Cliente */
    $appId       = $m->save();
    
    //actualizarTotalesTour($params['tourId']);
    //emailRegistroTour($appId);
    return $appId;
}


?>