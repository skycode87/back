<?php
include_once "../main/common.php";
include_once "pack.php";

if(($method==='GET')&&(AGENCY_ID)){


      //  UsageAPI('searchPanel',AGENCY_ID,AGENT_ID,AGENT_NAME);


        $limit = 30;
        $where='';



       if ( ($request[0]=='0') ) {
       
  
         $user_search = " 1=1 ";

          $where = $user_search ;
      
        }else if ( ($request[0]=='1') && ($request[2]!='') ) {
       

         $user_search = "  ( user.dato01 like '%".$request[2]."%'  or user.dato02 like '%".$request[2]."%' or user.dato04 like '%".$request[2]."%' ) ";

    $where = $user_search ;


        }else if ( ($request[0]!='') && ($request[2]=='All') ) {
       

           $limit = 200;

         $where = " DATE_FORMAT(plan.dato01,'%Y-%m-%d') >= '".$request[0]."'  AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') <= '".$request[1]."' ";
      
        }else if ( ($request[0]!='') && ($request[1]!='') && ($request[2]!='') ) {
       


          $where = " ( user.dato01 like '%".$request[2]."%'  or user.dato02 like '%".$request[2]."%'  or user.dato04 like '%".$request[2]."%' )  AND DATE_FORMAT(plan.dato01,'%Y-%m-%d') >= '".$request[0]."'  AND  DATE_FORMAT(plan.dato01,'%Y-%m-%d') <= '".$request[1]."' ";

           $limit = 200;
             
      
        }else if ( ($request[0]=='') && ($request[2]!='') ) {
       

           $limit = 200;


         $user_search = "  ( user.dato01 like '%".sg($request[2],10)."%'  or user.dato02 like '%".$request[2]."%' user.dato04 like '%".sg($request[2],10)."%' ) ";

          $where = $user_search ;
      
        }else{

         $limit = 200;


         $user_search = "  ( user.dato01 like '%".sg($request[2],10)."%'  or user.dato02 like '%".$request[2]."%' user.dato04 like '%".sg($request[2],10)."%' ) ";

          $where = $user_search ;


        }


  
        $sql = "SELECT pack.dato01                       AS 'pack_name', 
       DATE_FORMAT(plan.dato01,'%Y-%m-%d')              AS 'plan_departure_date', 
       plan.dato03                                      AS 'plan_departure_time', 
       plan.token                                        AS 'plan_token', 
       plan.dato13                                      AS 'plan_color', 
       user.dato01                                      AS 'user_fullname', 
       user.dato02                                      AS 'user_document', 
       user.dato04                                      AS 'user_email', 
       user.dato05                                      AS 'user_phone', 
       user.dato06                                      AS 'user_nationality', 
       app.dato08                                       AS 'app_quantity', 
       app.dato09                                       AS 'app_type', 
       app.dato10                                       AS 'app_status', 
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
       FROM   form003 agency 
       inner join  form004 pack on  pack.dato40 = agency.id
       inner join  form001 plan on  plan.dato41 = pack.id 
       inner join  form005 app  on  app.dato41 = plan.id 
       inner join  form006 user on  app.dato42 = user.id 
       inner join  form008 ref on ref.id = app.dato40 
       WHERE  agency.id IN ('".AGENCY_ID."') AND app.archived = 'no' AND ".$where."   
       AND pack.archived = 'no' and user.dato01 <> ''  ORDER  BY plan.dato01 DESC Limit ".$limit;

      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      

     /* for($i=0;$i<count($res);$i++){
         $m              = new formModel();
         $metodo = '';
          
           $m->sql_nativo  = "select  CASE
            WHEN trans.dato10 = '0' THEN 'Cash'
            WHEN trans.dato10 = '1' THEN 'Debit'
            WHEN trans.dato10 = '2' THEN 'Credit'
            WHEN trans.dato10 = '3' THEN 'Other'
            END  AS 'metodo' from form009 trans where trans.dato40 in ('".$res[$i]['app_ID']."') and trans.archived = 'no' limit 1  ";

          $m->internal    = true;
          $res2           = $m->all();
          $res[$i]['metodo'] =  $res2[0]['metodo'];
      }*/

    $data['basic']     = $res;
    echo json_encode($data);
}