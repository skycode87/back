<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
require '../vendorSengrid/autoload.php';
$APIKEYSENGRID = "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";
$method        = $_SERVER['REQUEST_METHOD'];
$request       = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$action        = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
$urlSlack = 'https://hooks.slack.com/services/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';
require_once '../constantesModel.php';
require_once '../formModel.php';
require_once 'bot.php';
include_once 'email.php';

$CREDENCIALES       = explode("lsd", $action);
$CREDENCIALES_ROLES = explode("PDR", $CREDENCIALES[2]);


if($_POST['recipe']){
  recipeDetails($_POST['recipe'],json_encode($_POST));
}


$ok['OK']    = 'yes';

$FRONTWEB = "http://ibusuite-ibusuites.1d35.starter-us-east-1.openshiftapps.com/";

for($i=0;$i<count($CREDENCIALES_ROLES);$i++){
    if( $i==(count($CREDENCIALES_ROLES)-1) ){
     $ROLES.= "'".$CREDENCIALES_ROLES[$i]."'";
    }else{
        $ROLES.=  "'".$CREDENCIALES_ROLES[$i]."',";
    } 
}

define("_plan_","form001");
define("_pack_","form004");
define("_app_","form005");
define("_user_","form006");
define("_agent_","form002");
define("_trans_","form009");
define("_feat_","form013");
define("_file_","form012");
define("_agency_","form003");
define("_log_","form015");
define("_ref_","form008");
define("_web_","form020");
define("_lsd_","form100");



/*
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
        agency.dato40   AS 'agency_type',
        agency.dato30   AS 'agency_avatar', 
        agency.token    AS 'agency_token', 
        agency.link     AS 'agency_link', 
        agency.id       AS 'agency_ID',        
        agent.dato01    AS 'agent_name',
        agent.token     AS 'agent_token',
        agent.dato03    AS 'agent_phone',
        agent.code      AS 'agent_code',
        agent.dato31    AS 'agent_avatar',
        agent.dato06    AS 'agent_email',
        agent.dato10    AS 'agent_role',
        agent.dato04    AS 'agent_login',
        agent.link      AS 'agent_link'
*/


$DATA           = agentByTOKEN($CREDENCIALES[0]);


$ACCESS__       = $CREDENCIALES[1];
$TOKEN2__       = $CREDENCIALES[3];
$LINK__         = $CREDENCIALES[4];

$TOKEN__        = $DATA['agent_token'];
$AGENCY__       = $DATA['agency_ID'];
$USER           = $DATA['agent_ID'];
$USER__         = $DATA['agent_ID'];
$USERNAME__     = $DATA['agent_name'];
$TYPE__         = $DATA['agency_type'];



define("_web_","form020");


$SYSTEM['app_accepted']                                = 1;
$SYSTEM['app_canceled']                                = 2;
$SYSTEM['survey_option01_value']                       = 1;
$SYSTEM['survey_option01_name']                        = 'Poor';
$SYSTEM['survey_option02_value']                       = 3;
$SYSTEM['survey_option02_name']                        = 'Good';
$SYSTEM['survey_option03_value']                       = 5;
$SYSTEM['survey_option03_name']                        = 'Excellent';
$SYSTEM['survey_url_form']                             = "https://ibusuites.com/form/survey/index.html";
$SYSTEM['survey_appClose_subject']                     = "Thanks for choosing us";
$SYSTEM['survey_appClose_title']   = "How was your experience with us?";
$SYSTEM['sys_backend_main']  = "https://backend.ibusuites.com/";
$SYSTEM['sys_backend']       = "https://backend.ibusuites.com/Cliente/";
$SYSTEM['sys_email_footer']  ="";
$SYSTEM['sys_email_title_sameday']  ="";
$SYSTEM['sys_email_title_anotherday']  ="";
$SYSTEM['sys_email_sayhello']  = "Welcome Aboard ";
$SYSTEM['sys_email_saygoodbye']  = "";
$SYSTEM['sys_email_planFull']    = "Sorry this tour is Full =(";
$SYSTEM['sys_email_saywelcome']  = " Welcome Abroad  ";


$SYSTEM['sys_background_email_color']  = "#F0FDFE";
$SYSTEM['sys_logo']                    = "http://backend.ibusuites.com/admin/config/logo_min.png";
$SYSTEM['sys_name']                    = "Yantra";
$SYSTEM['sys_phone']                   = "573186855563";

$SYSTEM['reviews_link']                = "http://g.page/capturecolombiatours/review";


$APP_STATUS[0] = 'Hold on';
$APP_STATUS[1] = 'Confirmed';
$APP_STATUS[2] = 'Canceled';

$REF_STATUS[0] = 'INACTIVE';
$REF_STATUS[1] = 'BASIC';
$REF_STATUS[2] = 'PREMIUM';

define("REF_STATUS_INACTIVE",0);
define("REF_STATUS_BASIC",1);
define("REF_STATUS_PREMIUM",2);



if($AGENCY__ ){
    $m = new formModel();
    $m->sql_nativo = " SELECT * FROM form020  WHERE dato40 in ('".$AGENCY__."') and archived = 'no' ";
    $m->internal = true;
    $res = $m->all();
}

for($i=0;$i<count($res);$i++){
  $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
}



//notify($SYSTEM['sys_email_saygoodbye']);

function systemByAgency($AGENCY__){

    $m = new formModel();
    $m->sql_nativo = " SELECT dato01 , dato02 FROM form020  WHERE dato40 in ('".$AGENCY__."') and archived = 'no' and dato03 = 'EMAIL TEMPLATE' ";
    $m->internal = true;
    $res = $m->all();

    for($i=0;$i<count($res);$i++){
        $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
    }

    return $SYSTEM;
}




function log_($title,$appID,$type){

    //0 -> neutral
    //1 -> good
    //2 -> bad 


    $m = new formModel();
    $m->sql_nativo = " SELECT plan.link as li FROM form005 app, form001 plan WHERE app.id in (".$appID.") and plan.id = app.dato41";
    $m->internal = true;
    $res = $m->all();

    $m           = new formModel();
    $m->table    = 'form015';
    $m->archived = 'no';
    $m->created  = $m->now__();
    $m->updated  = $m->now__();
    $m->dato10   = $type;
    $m->dato03   = $res[0]['link'];
    $m->dato01   = $title;
    $m->dato41   = 1;
    $m->dato40   = $appID;
    $m->dato42   = 1;
    $m->save();
  } 


  function UsageAPI($apiName,$AgencyID,$userID,$userName='Unknow'){

    if($userID!=2){
        $m           = new formModel();
        $m->table    = 'form101';
        $m->archived = 'no';
        $m->created  = $m->now__();
        $m->updated  = $m->now__();
        $m->dato10   = '1';
        $m->dato01   = $apiName;
        $m->dato03   = $userName;
        $m->dato02   = $_SERVER['REMOTE_ADDR'];
        $m->dato41   = $userID;
        $m->dato40   = $AgencyID;
        $m->save();
    }
  } 


function EventAPP($appID,$title,$type){

    if($appID){

            $EVENT_APP[3] = 'New application via website';
            $EVENT_APP[1] = 'New application via Referer';
            $EVENT_APP[2] = 'New application via System';
            $EVENT_APP[0] = 'New application ';


            $EVENT_APP[10] = 'Sending Email type  ';
            $EVENT_APP[11] = 'Sending Email Type Website Request ';
            $EVENT_APP[12] = 'Sending Email Type Confirmation ';
            $EVENT_APP[13] = 'Sending Email Type Survey';
            $EVENT_APP[14] = 'Sending Email Type Welcome';
            $EVENT_APP[15] = 'Sending Email Type Closure';
            $EVENT_APP[16] = 'Sending Email Type Message';

            $EVENT_APP[30]  = 'Change Status';
            $EVENT_APP[31]  = 'Update App Information';
            $EVENT_APP[32]  = 'Delete App';
            $EVENT_APP[33]  = 'Add Payment';
            $EVENT_APP[34]  = 'Reverse Payment';
            $EVENT_APP[35]  = 'Update Schedule';
            $EVENT_APP[36]  = 'Update User Information';


            $m = new formModel();
            $m->sql_nativo = " SELECT dato31  FROM form005  WHERE id in ('".$appID."')";
            $m->internal = true;
            $res = $m->all();

            $m           = new formModel();

                    if($res[0]['dato31']==''){
                        $event = $EVENT_APP[$type]."#".$title."#".$m->now__()."#".$type;
                    }else{
                        $event = $res[0]['dato31']."|".$EVENT_APP[$type]."#".$title."#".$m->now__()."#".$type;
                    }
            

            $m->table    = 'form005';
            $m->dato31   = $event;
            $m->updated($appID);


    }


  } 


 


function createCode($tabla){

  $x = 1;

  while ($x == 1) {
    
          $code = generateRandomString(10);
          $sql = "SELECT id FROM ".$tabla." WHERE  code='".$code."'";
          $m = new formModel();
          $m->sql_nativo = $sql;
          $m->internal = true;
          $res = $m->all();   

          if($res[0]['id']){
            $x = 1;
          }else{
            $x = 0;      
          }

  }

  return $code;
      
}   




function resetCode($table){


      $sql = "SELECT  * FROM ".$table;

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();      
    

      for($i=0;$i<count($res);$i++){
            $m            = new formModel();
            $m->table     = $table;
            $m->code      = createCode($table);
            $m->updated($res[$i]['id']); 
      }

}



function createToken($tabla){

  $x = 1;

  while ($x == 1) {

          $code = generateRandomString(100);
          $sql = "SELECT id FROM ".$tabla." WHERE  token='".$code."'";
          $m = new formModel();
          $m->sql_nativo = $sql;
          $m->internal = true;
          $res = $m->all();   

          if($res[0]['id']){
             echo "<br>No Paso ".$code;
            $x = 1;
          }else{
            echo "<br>Paso ".$code;
            $x = 0;      
          }

  }

  return $code;
      
}   


function resetToken($table){

      $sql = "SELECT  * FROM ".$table;

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();      
    

      for($i=0;$i<count($res);$i++){
            $m            = new formModel();
            $m->table     = $table;
            $m->token      = createToken($table);
            $m->updated($res[$i]['id']); 
      }

}



function createLink($tabla){

  $x = 1;

  while ($x == 1) {

          $code = generateRandomString(100);
          $sql = "SELECT id FROM ".$tabla." WHERE  link='".$code."'";
          $m = new formModel();
          $m->sql_nativo = $sql;
          $m->internal = true;
          $res = $m->all();   

          if($res[0]['id']){
             echo "<br>No Paso ".$code;
            $x = 1;
          }else{
            echo "<br>Paso ".$code;
            $x = 0;      
          }

  }

  return $code;
      
}   


function resetLink($table){

      $sql = "SELECT  * FROM ".$table;

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();      
    

      for($i=0;$i<count($res);$i++){
            $m            = new formModel();
            $m->table     = $table;
            $m->link      = createLink($table);
            $m->updated($res[$i]['id']); 
      }

}




function notify($text){

      $payload = array(
            'payload' => json_encode(array(
                'attachments' => array(
                    0 => array(
                        'fallback' => $text,
                        'color' => '#9A42AF',
                        'text' => $text,
                        'title_link' => '',
                        'footer' => 'Capture Colombia Tours',
                        'footer_icon' => ''
                    )
                )
            ))
        );

    $urlSlack = 'https://hooks.slack.com/services/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';
    define('SLACK_WEBHOOK', $urlSlack);
    $c = curl_init(SLACK_WEBHOOK);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_exec($c);
    curl_close($c);

}


function notifySystem($text,$type){

      $payload = array(
            'payload' => json_encode(array(
                'attachments' => array(
                    0 => array(
                        'fallback' => $text,
                        'color' => '#9A42AF',
                        'text' => $text,
                        'title_link' => '',
                        'footer' => 'Capture Colombia Tours',
                        'footer_icon' => ''
                    )
                )
            ))
        );

    $urlSlack = 'https://hooks.slack.com/services/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';
    define('SLACK_WEBHOOK', $urlSlack);
    $c = curl_init(SLACK_WEBHOOK);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_exec($c);
    curl_close($c);

}

function slack_($payload){

    $c = curl_init('https://hooks.slack.com/services/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');
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_exec($c);
    curl_close($c);

}


function getColor(){
return setColor();
}

function ok(){
    echo 'ok';
}


function setColor(){

$color[0]='#f9fafc';
$color[1]='#eef2e1';
$color[2]='#e2f1e0';
$color[3]='#dff0ee';
$color[4]='#dee9ef';
$color[5]='#dee1ef';
$color[6]='#dfdeef';
$color[7]='#e6deef';
$color[8]='#eedeef';
$color[9]='#efdeea';
$color[10]='#efdee4';
$color[11]='#efdedf';
$color[12]='#fff6e8';
$color[13]='#ffffe8';
$color[14]='#f3ffe8';
$color[15]='#eaffe8';
$color[16]='#e8fff8';
$color[17]='#e8fcff';
$color[18]='#e8f5ff';
$color[19]='#eae8ff';
$color[20]='#f0e8ff';
$color[21]='#f5e8ff';
$color[22]='#ffedfe';
$color[23]='#ffedf3';
$color[24]='#ffeded';
$color[25]='#edffed';

return $color[rand(0,24)];

}


//slack("Token : ".$TOKEN2__." / Reqs: ".$request[0]." / Agency: ".$AGENCY__." / User : ".$USER );

$TYPE   = $CREDENCIALES[1];
//$ROLE   = $USERDATA['role'];

if(($method==='GET')&&($request[0]=='hoftman')){
emailRegistroTour(44);
exit;
}

if( ($method==='GET') && ($request[0]=='telegram') ){
$bot = new BOTQuerys("867635336:AAHjPOo8wFXHB-iCmr67CCfq0yCEMsKSkI8","847875487");

/*$html ="<b>bold</b>, <strong>bold</strong>
<i>italic</i>, <em>italic</em>
<a href='http://www.example.com/'>inline URL</a>
<a href='tg://user?id=123456789'>inline mention of a user</a>
<code>inline fixed-width code</code>
<pre>pre-formatted fixed-width code block</pre>";*/

$bot->sendMessage($html); 
exit;
}

function telegram($text){    
$bot = new BOTQuerys("867635336:AAHjPOo8wFXHB-iCmr67CCfq0yCEMsKSkI8","847875487");
$bot->sendMessage($text); 
}


function FindBy__($table,$campo,$id,$select,$type="single"){
    $m = new formModel();
    $m->table  = $table;
    $m->select = $select;

    if($campo=='id')      $m->where__('id','=',$id);
    else if($campo=='token')   $m->where__('token','=',$id);
    else if($campo=='link')    $m->where__('link','=',$id);
    else if($campo=='dato40')  $m->where__('dato40','=',$id);
    else if($campo=='dato01')  $m->where__('dato01','=',$id);

    $m->internal = true;
    $res         = $m->all();

    //echo $m->sql__;

    if($type=="single") return $res[0];
    else if($type=="array")  return $res;
    else if($type=="json")   return json_encode($res);
}



function jsonOut($x){
$result['result'] = $x;
return json_encode($result);
}

function prepararMonto($monto){
  $monto =  trim(str_replace("$","",$monto));
  $monto =  trim(str_replace(".","",$monto));    
  $monto =  trim(str_replace(",",".",$monto));    
  return floatval($monto)+floatval(0.00);
}



function setMoney($monto){
  $monto =  trim(str_replace("$","",$monto));
  $monto =  trim(str_replace(".","",$monto));    
  $monto =  trim(str_replace(",",".",$monto));    
  return floatval($monto)+floatval(0.00);
}

function setCode($code){

              if($code<10){
                return '00000'.$code;
              }else if($code<100){
                return '0000'.$code;
              }else if($code<1000){
                return '000'.$code;
              }else if($code<10000){
                return '00'.$code;
              }else if($code<100000){
                return '0'.$code;
              }
}




function agentByTOKEN($agentTOKEN){

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
        agency.dato40   AS 'agency_type',
        agency.dato30   AS 'agency_avatar', 
        agency.token    AS 'agency_token', 
        agency.link     AS 'agency_link', 
        agency.id       AS 'agency_ID',        
        agent.dato01    AS 'agent_name',
        agent.token     AS 'agent_token',
        agent.dato03    AS 'agent_phone',
        agent.code      AS 'agent_code',
        agent.dato31    AS 'agent_avatar',
        agent.dato06    AS 'agent_email',
        agent.dato10    AS 'agent_role',
        agent.dato04    AS 'agent_login',
        agent.link      AS 'agent_link',
        agent.id        AS 'agent_ID'
FROM   form003 agency,
       form002 agent
WHERE  agent.token in ('".$agentTOKEN."') 
       AND agent.dato40    = agency.id 
       AND agency.archived = 'no'
       AND agent.archived  = 'no' ";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      $result = $res[0];

      return $result;
}



function CompleteCode($code){

              if($code<10){
                return '00000'.$code;
              }else if($code<100){
                return '0000'.$code;
              }else if($code<1000){
                return '000'.$code;
              }else if($code<10000){
                return '00'.$code;
              }else if($code<100000){
                return '0'.$code;
              }

}


function repararFecha($fecha){
    $x = explode("/",$fecha);
    $dia = $x[0];
    $mes = $x[1];
    $ano = $x[2];
    return $ano."-".$mes."-".$dia; 
}


function repararFecha3($fecha){
    $x = explode("/",$fecha);
    $dia = $x[1];
    $mes = $x[0];
    $ano = $x[2];
    return $ano."-".$mes."-".$dia; 
}

function repararFecha2($fecha){
    $x = explode("/",$fecha);
    $dia = $x[1];
    $mes = $x[0];
    $ano = $x[2];
    return $ano."-".$mes."-".$dia; 
}


function nuevaAplicacionTour1($params){

    $m          = new formModel();
    $m->table   = 'form005';
    $m->user    = 0;
    $m->archived= 'no';
    $m->created = $m->now__();
    $m->updated = $m->now__();
    $m->server  = json_encode($_SERVER);
    $m->code    = GenerarCode('form005',$params['agencyId']);
    $m->link    = generateRandomString(100);    
    $m->token   = $m->md7__(generateRandomString(11));
    $m->dato01  = 0; /* Estatus */
    $m->dato10  = 0; /* Estatus */
    $m->dato12  = ""; /* user id notificacion */    
    $m->dato09  = "web"; /* tipoUsuario */
    $m->dato26  = prepararMonto($params['total']);    
    $m->dato25  = prepararMonto(0);   
    $m->dato27  = prepararMonto($params['costo']);    /* Costo    */
    $m->dato08  = $params['cantidad']; /* Cantidad */
    $m->dato41  = $params['idTour']; /* Tour */
    $m->dato42  = $params['idClient']; /* Cliente */
    $m->dato45  = $params['idAgency']; /* Cliente */
    $appId      = $m->save();

    actualizarTotalesTour($params['idTour']);
    emailRegistroTour($appId);
    return $appId;

}





function repararFechaMMDDYYYY($fecha,$divisor="-"){

  /* $x = explode($divisor,$fecha);
    $dia = $x[1];
    $mes = $x[0];
    $ano = $x[2];
        return $ano."-".$mes."-".$dia; 
*/
        return $fecha;
}

function validarNumero($x){

    if(is_numeric($x)){
        return $x;
    }else{
        return 0;
    }
}



function MAILto__($email, $asunto, $mensaje)
{
  
    if(comprobar_email($email)==0){      
          echo "email Erroneo";
        return false;
    }


    $constante = new constanteModel();
  
    $to__      = $email;
    $subject   = $asunto;
    $from_name = "Capture Colombia Tours";
    $from_     = "ibusuite@qreatech.com";
    $html      = $mensaje;
    
    $from     = new SendGrid\Email($from_name, $from_);
    $subject  = $subject;
    $to       = new SendGrid\Email("ibusuites", $to__);
    $content  = new SendGrid\Content("text/html", $html);
    $mail     = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey   = $constante->ApiSengrid();
    $sg       = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    

    if ($response->statusCode() != "202") {
    //newEmail($asunto,$html,$email,'',$response,$response->statusCode());
    }else{
    //newEmail($asunto,$html,$email,'',$response,$response->statusCode());
    }


    
}


function sendEmailIntern($SYSTEM,$email,$asunto,$body){

    if(comprobar_email($email)==0){      
          echo " email:".$email." email Erroneo";
        return false;
    }

    $constante = new constanteModel();
    $to__      = $email;
    $subject   = $asunto;
    $from_name = 'Capture Colombia Tours';
    $from_     = "ibusuite@qreatech.com";
    $html      =   SystemTemplateEmail($SYSTEM,$body);
    $from     = new SendGrid\Email($from_name, $from_);
    $subject  = $subject;
    $to       = new SendGrid\Email("ibusuite", $to__);
    $content  = new SendGrid\Content("text/html", $html);
    $mail     = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey   = $constante->ApiSengrid();
    $sg       = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    


    if ($response->statusCode() != "202") {
        //telegram($response->statusCode()."-->".$response->body());
    }else{
        //telegram($response->statusCode()."-->".$response->body());
    }




}

//esta funcion se le coloca un email al final
function sendEmailBasic__($database_,$asunto, $mensaje,$email)
{

    if(comprobar_email($email)==0){      
          echo " email:".$email." email Erroneo";
        return false;
    }


    $constante = new constanteModel();
  
    $to__      = $email;
    $subject   = $asunto;
    $from_name = $database_['agency_name'];
    $from_     = "ibusuite@qreatech.com";
    $html      =  templateEmail__($database_,$mensaje);
    
    $from     = new SendGrid\Email($from_name, $from_);
    $subject  = $subject;
    $to       = new SendGrid\Email("ibusuite", $to__);
    $content  = new SendGrid\Content("text/html", $html);
    $mail     = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey   = $constante->ApiSengrid();
    $sg       = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    

    if ($response->statusCode() != "202") {

        //telegram($response->statusCode()."-->".$response->body());

    }else{
        //telegram($response->statusCode()."-->".$response->body());

    }

    
}

//esta funcion toma el email del User
function sendEmail__($database_,$asunto, $mensaje)
{
  

    if(comprobar_email($database_['user_email'])==0){      
          echo " email:".$database_['user_email']." email Erroneo";

        return false;
    }


    $constante = new constanteModel();
  
    $to__      = $database_['user_email'];
    $subject   = $asunto;
    $from_name = $database_['agency_name'];
    $from_     = "ibusuite@qreatech.com";
    $html      =  templateEmail__($database_,$mensaje);
    
    $from     = new SendGrid\Email($from_name, $from_);
    $subject  = $subject;
    $to       = new SendGrid\Email("ibusuite", $to__);
    $content  = new SendGrid\Content("text/html", $html);
    $mail     = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey   = $constante->ApiSengrid();
    $sg       = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    


    if ($response->statusCode() != "202") {

       ///telegram($response->statusCode()."-->".$response->body());

    }else{
       // telegram($response->statusCode()."-->".$response->body());

    }    



}



function templateEmail__($database_,$body){
    
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
                <tr style='background: ".$database_['agency_header_color'].";'>
                    <td align=\"center\">
                    <br>
                      <img width='150px' src='https://backend.ibusuites.com/".$database_['agency_logo_white']."' alt='".$database_['agency_name']."' />
                      <br>
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




function SystemTemplateEmail($SYSTEM,$body){
    
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
                <tr style='background: ".$SYSTEM['sys_background_email_color'].";'>
                    <td align=\"center\">
                    <br>
                      <img width='150px' src='".$SYSTEM['sys_logo']."' alt='".$SYSTEM['sys_name']."' />
                      <br>
                    </td>
                </tr>
                <tr>
                    <td class=\"content\">
                       ".$body."
                    </td>
                </tr>
                <td align=\"center\" style='background:#fcfcfc'><br><br>
                   <a style='border-radius:4px; padding:7px 40px; font-weight:bold; background:#154557; text-decoration: none; cursor:pointer; color:#fff' href='https://api.whatsapp.com/send?phone=".$SYSTEM['sys_phone']."'>
                     Customer Support 
                    </a><br><br><br><br>
                </td>
            </table>
        </td>
    </tr>
</table>
</body>
</html>";
}






function consola($msj="")
{

    if($msj==""){
        $arch = fopen ("consola.txt", "w+");
        fwrite($arch, "");
        fclose($arch);
    }else{
        $nombre_archivo1 = "consola.txt";
        $archivo1        = fopen($nombre_archivo1, "w");
        fwrite($archivo1,  $msj . "  \n");
    }

}


function recipeDetails($recipeName,$msj)
{
        $nombre_archivo =  "details/".$recipeName.".json";
        $archivo1        = fopen($nombre_archivo, "w");
        fwrite($archivo1,  $msj . "  \n");
}



/* new version */

function validarUser($action){
  $CREDENCIALES = explode("lsd", $action);
  
  $c = new formModel();
  $c->table  ="form002";
  $c->internal = true;
  $c->where__("token","=",$CREDENCIALES[0]);
  $res = $c->all();
    return $res[0];
}

function generateRandomString($length = 10) { 
    return strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length/2)).strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length/2)); 
} 



function GenerarCode($table,$agency){

              $m = new formModel();
              $m->internal = true;
              $m->sql_nativo = "SELECT code FROM ".$table." where dato45 in (".$agency.") order by id desc limit 1";
              $res = $m->all(); 

              if($res[0]['code']<1){
                $res[0]['code'] = 0;
              }

           return   $code = $res[0]['code']+1;

             /* if($code<10){
                return '00000'.$code;
              }else if($code<100){
                return '0000'.$code;
              }else if($code<1000){
                return '000'.$code;
              }else if($code<10000){
                return '00'.$code;
              }else if($code<100000){
                return '0'.$code;
              }*/

}




function GenerarCorrelativo($table,$agency){

              $m = new formModel();
              $m->internal = true;
              $m->sql_nativo = "SELECT code FROM ".$table." where dato45 in (".$agency.") order by id desc limit 1";
              $res = $m->all(); 

              if($res[0]['code']<1){
                $res[0]['code'] = 0;
              }

           return   $code = $res[0]['code']+1;

             /* if($code<10){
                return '00000'.$code;
              }else if($code<100){
                return '0000'.$code;
              }else if($code<1000){
                return '000'.$code;
              }else if($code<10000){
                return '00'.$code;
              }else if($code<100000){
                return '0'.$code;
              }*/

}




function comprobar_email($email){ 
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
        if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
            //miro si tiene caracter . 
            if (substr_count($email,".")>= 1){ 
                //obtengo la terminacion del dominio 
                $term_dom = substr(strrchr ($email, '.'),1); 
                //compruebo que la terminación del dominio sea correcta 
                if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                //compruebo que lo de antes del dominio sea correcto 
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                if ($caracter_ult != "@" && $caracter_ult != "."){ 
                    $mail_correcto = 1; 
                } 
                } 
            } 
        } 
    } 


    if ($mail_correcto) {
      return 1;   
  }else{
        slack($mail_correcto." Email incorrecto");
        return 0; 
  }

        
   
}


function templateEmailMain($params){
    
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
                <tr>
                    <td align=\"center\"><br><br><br>
                      <img width='150px' src='https://qreatech.com/tours/logolospatios.png' alt='CAPTURE COLOMBIA TOURS' /><br><br><br>
                    </td>
                </tr>
                <tr>
                    <td class=\"content\">
                       ".$params['body']."
                    </td>
                </tr>
                <td align=\"center\" style='background:#fcfcfc'><br><br>
                   <a style='border-radius:4px; padding:7px 40px; font-weight:bold; background:orange; text-decoration: none; cursor:pointer; color:#fff' href='https://api.whatsapp.com/send?phone=573104625861'>
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


function actualizarLimiteTour($idTour){
     	
}

function nuevoCliente($_PUT){

    $m      = new formModel();
    $m->table   = 'form006';
    $m->user    = 0;
    $m->archived    = 'no';
    $m->created     = $m->now__();
    $m->updated     = $m->now__();
    $m->server      = json_encode($_SERVER);
    $m->code    = GenerarCode('codeCliente');
    $m->token       =  $m->md7__(generateRandomString(11));
    $m->dato01  = $_PUT['fullname']; /* nombre */
    $m->dato02  = $_PUT['document']; /* Documento */
    $m->dato04  = $_PUT['email']; /* Email */
    $m->dato09  = 'principal'; /* principal  */
    $m->dato05  = $_PUT['phone']; /* Telefono */
    $m->dato12  = $_PUT['observation']; /* Observacion Medica  */
    return $m->save();
}

function actualizarTotalesTour($idTour){

    $totales = new formModel();
    $totales->internal = true;
    $totales->sql_nativo = "SELECT count(*) as totalcupos from form005 where dato41=".$idTour." and archived='no'  and dato01 in ('0','1')";
    $res1  = $totales->all();

    $m = new formModel();
    $m->internal = true;
    $m->sql_nativo = "SELECT  SUM(dato25) as pagado, SUM(dato26) as total FROM form005  WHERE dato41 in (". $idTour.") and archived ='no' and dato10 in (0,1) ";
    $totalPagadoTour = $m->all();
   
    $m          = new formModel();
    $m->table   = "form001";
    $m->dato26  = $totalPagadoTour[0]['pagado']; 
    $m->dato27  = $totalPagadoTour[0]['total']-$totalPagadoTour[0]['pagado']; 
    $m->dato28  = $totalPagadoTour[0]['total']; 
    $m->dato11  = $res1[0]['totalcupos']; 
    $m->save($idTour);

}




function nuevaAplicacionTour($_PUT){

    $m          = new formModel();
    $m->table   = 'form005';
    $m->user    = 0;
    $m->archived= 'no';
    $m->created = $m->now__();
    $m->updated = $m->now__();
    $m->server  = json_encode($_SERVER);
    $m->code    = GenerarCode('form005',$_PUT['idAgency']);
    $m->link    = generateRandomString(100);    
    $m->token   = $m->md7__(generateRandomString(11));
    $m->dato01  = 0; /* Estatus */
    $m->dato10  = 0; /* Estatus */
    $m->dato09  = "web"; /* tipoUsuario */
    $m->dato26  = prepararMonto($_PUT['total']);    
    $m->dato25  = prepararMonto(0);   
    $m->dato27  = prepararMonto($_PUT['costo']);    /* Costo    */
    $m->dato08  = $_PUT['cantidad']; /* Cantidad */
    $m->dato41  = $_PUT['idTour']; /* Tour */
    $m->dato42  = $_PUT['idClient']; /* Cliente */
    $m->dato45  = $_PUT['idAgency']; /* Cliente */
    $idApp = $m->save();

    actualizarTotalesTour($_PUT['idTour']);
    emailRegistroTour($_PUT['idClient']);
    return $idApp;
}


function slack($msj){
   
   /*
   $urlSlack = 'https://hooks.slack.com/services/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';
  define('SLACK_WEBHOOK', $urlSlack);
  $message = array('payload' => json_encode(array('text' => $msj)));
  $c = curl_init(SLACK_WEBHOOK);
  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($c, CURLOPT_POST, true);
  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  curl_exec($c);
  curl_close($c);*/

}

//function actualizarCostosTour($idTour,$_POST){
   
    /*$m          = new formModel();
    $m->table   = 'form001';
    $m->dato08  = prepararMonto($_POST['cantidad']); 
    $m->dato26  = prepararMonto($_POST['total']); 
    $m->dato27  = prepararMonto($_POST['costo']); 
    
    if($idTour){
        $m->save($idTour);
    } */
//  }


function nuevoTour($_PUT){


    $m                  = new formModel();
    $m->table           = "form001";
    $m->user            = 0;
    $m->archived        = 'no';
    $m->created         = $m->now__();
    $m->updated         = $m->now__();
    $m->server          = json_encode($_SERVER);
    $m->code            = GenerarCode('form001',$_PUT['idAgency']);
    $m->token           = $m->md7__(generateRandomString(11));
    $m->link            = generateRandomString(100);
    $m->dato01          = $_PUT['dato01']; /* Fecha destino */
    $m->dato03          = ltrim($_PUT['dato03']); /* Hora Salida */
    $m->dato06          = '20';  /*$_PUT['dato06'];  Limite Max */
    $m->dato07          = '4'; /*$_PUT['dato07'];  L imite Min */
    $m->dato40          = $_PUT['idAgency']; /* ID Agencia */
    $m->dato41          = $_PUT['idPackage']; /* ID Paquete */
    $m->dato42          = $_PUT['idResponsable']; /* ID RESPONSABLE */
    $m->dato45          = $_PUT['idAgency']; /* Cliente */

    $m->dato25          = prepararMonto($_PUT['dato25']); /* Costo Agencia */
    $m->dato10          = 0; /* Estatus */
    $m->dato11          = 1; /* contador */

    $m->dato13          = getColors();
    $m->dato26          = 0; /*  */
    $m->dato27          = 0; /*  */
    $m->dato28          = 0; /*  */
    $id = $m->save();

    return $id;
}

function find_plan($fecha,$hora,$packId,$agencyId){

        $plan               = new formModel();
        $plan->sql_nativo   = "SELECT * FROM form001 p Where p.dato01 in ('".$fecha."') and p.dato03 in ('".ltrim($hora)."') and p.dato40 in ('".$agencyId."') and p.dato41 in ('".$packId."') and p.archived='no' ";
        $plan->internal     = true;

        $rs_plan            =  $plan->all();


        if($rs_plan[0]['id']){
            return $rs_plan[0];
        }else{
            return $rs_plan[0] = false;
        }
}



function verificarExistenciaTour($fecha,$hora,$packId,$agencyId){

        $tour               = new formModel();
        $tour->sql_nativo   = "SELECT * FROM form001 p Where p.dato01 in ('".$fecha."') and p.dato03 in ('".ltrim($hora)."') and p.dato40 in ('".$agencyId."') and p.dato41 in ('".$packId."')  ";
        $tour->internal     = true;
        $tour               =  $tour->all();

        if($tour[0]['id']){
            return $tour[0];
        }else{
            return $tour[0] = false;
        }

}




function findID($table,$dato40,$token,$nameDato='dato40'){
	$m = new formModel();
    $m->table  = $table;
    $m->where__($nameDato,'=',$dato40);
    $m->where__('token','=',$token);
    $m->internal = true;
    $res = $m->all();
    return $res[0]['id'];
}

function findInfoIntern($table,$id){
	$m = new formModel();
    $m->table  = $table;
    $m->select = 'dato01,dato02,dato03,dato40,token,dato05,link  ';
    $m->where__('id','=',$id);
    $m->internal = true;
    $res = $m->all();
    return $res[0];
}

function findByID($table,$id){
	$m = new formModel();
    $m->table  = $table;
    $m->select = 'dato01,dato02,dato03,dato40,token,dato05,link  ';
    $m->where__('id','=',$id);
    $m->internal = true;
    $res = $m->all();
    return $res[0];
}

function searchFeatured($id){
    $m = new formModel();
    $m->table  = "form013";
    $m->select ='dato01';
    $m->where__('id','=',$id);
    $m->internal = true;    
    $res = $m->all();
    return trim($res[0]['dato01']);
}

function findIDIntern($table,$token,$link=false){
	  $m = new formModel();
    $m->table  = $table;
    $m->select ='id,link,dato01,dato02,dato03,dato04,dato40,token,dato05,dato06,dato07,dato08,dato09,dato10,dato40,dato41,dato42,dato45';
    $m->where__('token','=',$token);
    $m->internal = true;    
    $res = $m->all();
    if($link==true){
        return $res[0];
    }else{
        return $res[0]['id'];
    }
}

function findByLink($table,$link){
    $m = new formModel();
    $m->table  = $table;
    $m->where__('link','=',$link);
    $m->internal = true;
    $res = $m->all();
    return $res[0];
}

function totalesAppsbyTour($idTour){

        $m = new formModel();
        $m->sql_nativo = "SELECT sum(dato08) as 'total_clientes' , sum(dato26) as total_total, sum(dato25) as 'total_pago' , (sum(dato26)-sum(dato25)) as  'total_apagar'  FROM form005 where dato41 in (".$idTour.")";
         $m->internal = true;
         $totales = $m->all();
         return $totales[0];

}




function consultarCliente($idCliente){


$sql = "SELECT w.dato30  AS 'agency_logo', 
       c.dato01  AS 'contact_name', 
       c.dato04  AS 'contact_email', 
       c.id      AS 'contact_id', 
       c.dato03  AS 'contact_phone',
       p.dato01  AS 'date', 
       p.dato03  AS 'time', 
       g.dato01  AS 'agency_name', 
       g.dato02  AS 'agency_email', 
       g.dato12  AS 'agency_alias', 
       a.token   AS 'application_token', 
       c.code    AS 'application_code', 
       ag.dato31 AS 'avatar', 
       ag.dato35 AS 'welcomemsj', 
       ag.dato36 AS 'goodbyemsj', 
       ag.dato37 AS 'paquete_description', 
       ag.dato01 AS 'paquete', 
       a.dato08  AS 'cantidad', 
       a.dato26  AS 'total', 
       a.dato27  AS 'price' 
FROM   form006 c, 
       form005 a, 
       form014 w, 
       form001 p, 
       form003 g, 
       form004 ag 
WHERE  c.id in (".$idCliente.") 
       AND a.dato42 = c.id 
       AND p.id = a.dato41 
       AND g.id = p.dato40 
       AND w.dato40 = g.id 
       AND ag.id = p.dato41";

    $m = new formModel();
    $m->sql_nativo = $sql;
    $m->internal = true;
    $res = $m->all();      
    return $res[0];
}

function infoApp($idApp){

$sql = "SELECT 
       w.dato30  AS 'agency_logo', 
       c.dato01  AS 'contact_name', 
       c.dato04  AS 'contact_email', 
       c.id      AS 'contact_id', 
       c.dato03  AS 'contact_phone',
       p.dato01  AS 'date', 
       p.dato03  AS 'time', 
       g.dato01  AS 'agency_name', 
       g.dato02  AS 'agency_email', 
       g.dato12  AS 'agency_alias', 
       a.token   AS 'application_token', 
       c.code    AS 'application_code', 
       ag.dato31 AS 'avatar', 
       ag.dato35 AS 'welcomemsj', 
       ag.dato36 AS 'goodbyemsj', 
       ag.dato37 AS 'paquete_description', 
       ag.dato01 AS 'paquete', 
       a.dato08  AS 'cantidad', 
       a.dato26  AS 'total', 
       a.dato27  AS 'price'

FROM   form006 c, 
       form005 a, 
       form014 w, 
       form001 p, 
       form003 g, 
       form004 ag 
WHERE  a.id in (".$idApp.") 
       AND a.dato42 = c.id 
       AND p.id = a.dato41 
       AND g.id = p.dato40 
       AND w.dato40 = g.id 
       AND ag.id = p.dato41";

    $m = new formModel();
    $m->sql_nativo = $sql;
    $m->internal = true;
    $res = $m->all();      
    return $res[0];

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
        pack.dato35     AS 'email_registration_content',
        pack.dato36     AS 'email_closure_content',
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
        pack.dato35     AS 'email_registration_content',
        pack.dato35     AS 'pack_email_registration',
        pack.dato36     AS 'pack_closure_content',
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






function AppByAgency($agencyId){

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
        pack.dato06     AS 'pack_max_limit',
        pack.dato07     AS 'pack_min_limit',
        pack.dato08     AS 'pack_price',
        pack.dato10     AS 'pack_status',
        pack.dato30     AS 'pack_gallery',
        pack.dato31     AS 'pack_url_avatar',
        pack.dato32     AS 'pack_category',
        pack.dato35     AS 'email_registration_content',
        pack.dato36     AS 'email_closure_content',
        pack.dato37     AS 'pack_summary',
        pack.dato38     AS 'pack_itinerary',
        pack.dato39     AS 'google_maps_iframe',
        pack.token      AS 'pack_token',
        pack.id         AS 'pack_id',
        plan.dato01     AS 'plan_departure_date',
        plan.dato02     AS 'plan_duration',
        plan.dato04     AS 'plan_departure_time',
        plan.dato05     AS 'plan_arrival_time',
        plan.dato06     AS 'plan_max_limit',
        plan.dato07     AS 'plan_min_limit',
        plan.dato08     AS 'plan_quantity',
        plan.dato09     AS 'plan_price',
        plan.dato10     AS 'plan_status',
        plan.dato11     AS 'plan_counter',
        plan.dato13     AS 'plan_colour',
        plan.dato25     AS 'plan_cost',
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
        app.id          AS 'app_ID'
FROM   form006 user, 
       form005 app, 
       form014 website, 
       form001 plan, 
       form003 agency, 
       form004 pack 
WHERE  agency.id in ('".$agencyId."') 
       AND app.dato42      = user.id 
       AND app.dato41      = plan.id
       AND website.dato40  = agency.id 
       AND plan.dato41     = pack.id";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res;
}



function appDeleteTest(){


        exit;
    
        $ref = 'pedrolsdrojas';

        $sql = " SELECT id as 'appID',dato41 as 'planID' ,dato42 as 'userID' FROM form005 WHERE dato42 in ( SELECT id FROM form006 WHERE dato04 like ('%+"+$ref+"%') )  ";
       
  $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res;


        $m = new formModel();
        $m->sql_nativo = $sql;
        $m->internal = true;
        $res = $m->all();      
        exit;
        //borra los logs
        $m->execute_sql("DELETE  FROM 'form015' WHERE dato04 like ('%+"+$ref+"%')");
        //borro los survey
        $m->execute_sql("DELETE  FROM 'form019' WHERE dato01 like ('%+"+$ref+"%')");


        for($i=0;$i<count($res);$i++){
            $m->execute_sql("DELETE  FROM 'form001' WHERE id     = ".$res[0]['planID']); // borra plan
            $m->execute_sql("DELETE  FROM 'form009' WHERE dato40 = ".$res[0]['appID']);  // borra receipt
            $m->execute_sql("DELETE  FROM 'form006' WHERE id     = ".$res[0]['userID']); // borra user
            $m->execute_sql("UPDATE form012 SET archive = 'yes' WHERE dato40 = '".$res[0]['userID']."' and dato02='user' and dato04='user'"); // archiva los archivos de ese usuario
            $m->execute_sql("UPDATE form012 SET archive = 'yes' WHERE dato40 = '".$res[0]['planID']."' and dato02='plan' and dato04='plan'"); // archiva los archivos de ese usuario
        }


}

######## ARCHIVOS DE USER ########
//UPDATE form012 SET archive = 'yes' WHERE dato40 = '' and dato02='user' and dato04='user'

######## DELETE LOG DE USER ########
//DELETE  FROM 'form015' WHERE dato04 like ('%+test%')

######## APPID , PLANID , USERID  ########
//


function closePlans(){
        $m = new formModel();
        $m->execute_sql("UPDATE form001  SET  dato10='3' WHERE DATE_FORMAT(dato01,'%Y-%m-%d') < CURDATE() AND dato10='0' and archived='no' ");
}

function AgencyByDomain($agencyDomain){

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
        agency.token    AS 'agency_token',                
        agency.dato30   AS 'agency_avatar',        
        agency.id       AS 'agency_ID'
FROM   form003 agency
WHERE  agency.dato08 like ('%".$domain."%')";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res[0];

}

function AgencyByID($agencyId){

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
        agency.token    AS 'agency_token',        
        agency.dato30   AS 'agency_avatar',        
        agency.id       AS 'agency_ID'
FROM   form003 agency
WHERE  agency.id in ('".$agencyId."')";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res[0];
}



function AgentByID($agentId){

 $sql = "SELECT 
        agent.dato01   AS 'agent_fullname',
        agent.dato02   AS 'agent_id_document',
        agent.dato03   AS 'agent_phone',
        agent.dato04   AS 'agent_username',
        agent.dato05   AS 'agent_password',
        agent.link     AS 'agent_access',        
        agent.dato06   AS 'agent_email',
        agent.dato10   AS 'agent_role',
        agent.dato11   AS 'agent_document_type',
        agent.dato15   AS 'agent_role_description',
        agent.token    AS 'agent_token',        
        agent.dato31   AS 'agent_avatar',        
        agent.id       AS 'agent_ID',
        agent.dato32   AS 'agent_description',
        agent.dato13   AS 'agent_phone_optional',
        agent.dato15   AS 'agent_role_description',
        agent.dato16   AS 'agent_address'
FROM   form002 agent
WHERE  agent.id in ('".$agentId."')";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res[0];
}





function PlanByID($planId){

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
        pack.dato06     AS 'pack_max_limit',
        pack.dato07     AS 'pack_min_limit',
        pack.dato08     AS 'pack_price',
        pack.dato10     AS 'pack_status',
        pack.dato30     AS 'pack_gallery',
        pack.dato31     AS 'pack_url_avatar',
        pack.dato32     AS 'pack_category',
        pack.dato35     AS 'pack_email_registration',
        pack.dato36     AS 'pack_email_closure',
        pack.dato37     AS 'pack_summary',
        pack.dato38     AS 'pack_itinerary',
        pack.link       AS 'pack_link',
        pack.dato39     AS 'pack_maps_iframe',
        pack.id         AS 'pack_ID',
        plan.dato01     AS 'plan_departure_date',
        plan.dato02     AS 'plan_duration',
        plan.dato03     AS 'plan_departure_time',
        plan.dato05     AS 'plan_arrival_time',
        plan.dato06     AS 'plan_max_limit',
        plan.dato07     AS 'plan_min_limit',
        plan.dato08     AS 'plan_quantity',
        plan.dato09     AS 'plan_price',
        plan.dato10     AS 'plan_status',
        plan.dato14     AS 'plan_close',
        plan.dato11     AS 'plan_counter',
        plan.dato13     AS 'plan_colour',
        plan.dato25     AS 'plan_cost',
        plan.dato14     AS 'plan_close',
        plan.dato15     AS 'plan_external_link',
        plan.dato16     AS 'plan_external_date',
        plan.dato30     AS 'plan_photo',
        plan.id         AS 'plan_ID',
        plan.token      AS 'plan_token',
        agent.dato01    AS 'agent_name',
        agent.token     AS 'agent_token',
        agent.dato03    AS 'agent_phone',
        plan.token      AS 'token',
        plan.link       AS 'link',
        pack.token      AS 'pack_token',
        pack.dato34     AS 'pack_email_welcome'
FROM   form001 plan,
       form004 pack,
       form014 website,  
       form003 agency,
       form002 agent
WHERE  plan.id in ('".$planId."') 
       AND website.dato40  = agency.id 
       AND plan.dato41     = pack.id
       AND website.id      = agency.id
       AND agent.id        = plan.dato42";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      $result = $res[0];

        $m = new formModel();
        $m->sql_nativo = "SELECT sum(dato08) as 'total_clientes' , sum(dato26) as 'total_total', sum(dato25) as 'total_pago' , (sum(dato26)-sum(dato25)) as  'total_apagar'  FROM form005 where dato41 in (".$planId.") and dato09 <> 'invited' and archived='no' ";
         $m->internal = true;
         $totales = $m->all();

         $result['totales'] = $totales[0];

         $sql =  "update form005 set dato12='".date('Y-m-d')."' where dato41 in (".$planId.") and archived='no' ";
         $m->execute_sql($sql);

         return $result;
}





function infoTour($idTour){

 $sql = "SELECT w.dato30  AS 'agency_logo', 
       p.dato01  AS 'date', 
       p.dato03  AS 'time', 
       g.dato01  AS 'agency_name', 
       g.dato02  AS 'agency_email', 
       g.dato12  AS 'agency_alias', 
       ag.dato31 AS 'avatar', 
       ag.dato35 AS 'welcomemsj', 
       ag.dato36 AS 'goodbyemsj', 
       ag.dato37 AS 'paquete_description', 
       ag.dato01 AS 'paquete'
FROM   form014 w, 
       form001 p, 
       form003 g, 
       form004 ag 
WHERE  p.id in (".$idTour.") 
       AND g.id = p.dato40 
       AND w.dato40 = g.id 
       AND ag.id = p.dato41";

    $m = new formModel();
    $m->sql_nativo = $sql;
    $m->internal = true;
    $res = $m->all();      
    return $res[0];

}


function FindBy($table,$campo,$id,$select,$type="single"){
    $m = new formModel();
    $m->table  = $table;
    $m->select = $select;

    if($campo=='id')      $m->where__('id','=',$id);
    else if($campo=='token')   $m->where__('token','=',$id);
    else if($campo=='link')    $m->where__('link','=',$id);
    else if($campo=='dato40')  $m->where__('dato40','=',$id);
    else if($campo=='dato01')  $m->where__('dato01','=',$id);

    $m->internal = true;
    $res         = $m->all();

    //echo $m->sql__;

    if($type=="single") return $res[0];
    else if($type=="array")  return $res;
    else if($type=="json")   return json_encode($res);
}


?>