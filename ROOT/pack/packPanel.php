<?php
include_once "../main/common.php";
include_once "pack.php";



if(($method==='GET')&&(AGENCY_ID)){


        UsageAPI('packPanel',AGENCY_ID,AGENT_ID,AGENT_NAME);


        $packId      = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

          if($packId){

              $m             = new formModel();
              $m->sql_nativo = " SELECT  pack.dato01  AS 'pack_name'  FROM "._pack_." pack WHERE pack.id in ('".$packId."')";
              $m->internal   = true;
              $res1          = $m->all();
              $data['pack']  = $res1[0]['pack_name'];

          }else{
          echo "error";
          exit;
           }





            if($request[3]){

                      $m              = new formModel();
                      $m->sql_nativo  = "select id from form008  where token in ('".$request[3]."')";
                      $m->internal    = true;
                      $res            = $m->all();
                      $refId          = $res[0]['id'];

                      if($refId>0){
                       $refSQL = "AND ref.id          in (".$refId.")";
                      }
            }  


            if($request[3]=='All'){
               $refSQL = "";
            }


        $where='';

        if ( ($request[0]) && ( ($request[1]=='apps%20incoming') || ($request[1]=='apps incoming')  )  ) {
           $where = "AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') >= '".date('Y-m-d')."' ";
        }else  if ( ($request[0]) && ($request[1]) ) {
          $where = "AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') >= '".$request[0]."'  AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') <= '".$request[1]."' ";
        }else if($request[0]){
          $where = "AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') = '".$request[0]."' ";
        }


       $sql = "SELECT pack.dato01                       AS 'pack_name', 
       DATE_FORMAT(plan.dato01,'%Y-%m-%d')              AS 'plan_departure_date', 
       plan.dato03                                      AS 'plan_departure_time', 
       plan.token                                       AS 'plan_token', 
       plan.dato13                                      AS 'plan_color', 
       user.dato01                                      AS 'user_fullname', 
       user.dato02                                      AS 'user_document', 
       user.dato04                                      AS 'user_email', 
       user.dato05                                      AS 'user_phone', 
       user.dato06                                      AS 'user_nationality', 
       user.dato12                                      AS 'user_aditional_info', 
       app.dato08                                       AS 'app_quantity', 
       app.dato09                                       AS 'app_type', 
       app.dato10                                       AS 'app_status', 
       app.dato12                                       AS 'app_recently', 
       app.dato26                                       AS 'app_total', 
       app.dato27                                       AS 'app_price', 
       app.dato11                                       AS 'app_cupon', 
       app.code                                         AS 'app_code', 
       app.dato15                                       AS 'app_country', 
       app.token                                        AS 'app_token', 
       app.dato18                                       AS 'app_register_by', 
       ref.dato01                                       AS 'ref_fullname', 
       ref.token                                         AS 'ref_token', 
       app.id                                           AS 'app_ID', 
       Date_format(plan.dato01, '%a %d/%M/%Y %H:%i %p') AS 'app_date', 
       Date_format(app.created, '%a %d/%M/%Y %H:%i %p') AS 'app_created'
       FROM   form004 pack
       inner join  form001 plan on  plan.dato41 = pack.id 
       inner join  form005 app  on  app.dato41 = plan.id 
       inner join  form006 user on  app.dato42 = user.id 
       inner join  form008 ref on ref.id = app.dato40 
       WHERE  app.dato45 IN ('".AGENCY_ID."') AND app.archived = 'no' ".$where."   
       AND pack.archived = 'no' AND plan.archived='no' and pack.id in (".$packId.") and user.archived = 'no' and user.dato01 <> '' ORDER  BY plan.dato01 DESC Limit 50 ";

      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      


    $data['basic']     = $res;
    echo json_encode($data);
}