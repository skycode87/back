<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$method   = $_SERVER['REQUEST_METHOD'];
$request  = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$action   = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));



require_once '../../vendorSengrid/autoload.php';
require_once '../../formModel.php';
include_once 'email.php';



//branchs
define("_plan_", "form001");
define("_pack_", "form004");
define("_app_", "form005");
define("_user_", "form006");
define("_agent_", "form002");
define("_trans_", "form009");
define("_feat_", "form013");
define("_file_", "form012");
define("_agency_", "form003");
define("_log_", "form015");
define("_ref_", "form008");
define("_web_", "form020");
define("_lsd_", "form100");
define("_web_", "form020");
define("_track_", "form017");
define("_form_", "form016");
define("_blog_", "form021");
define("_master_", "form023");
define("_email_", "form022");
define("_logweb_", "form025");




$CREDENCIALES       = explode("lsd", $action);
$CREDENCIALES_ROLES = explode("PDR", $CREDENCIALES[2]);

for ($i        = 0;$i < count($CREDENCIALES_ROLES);$i++)
{
        if ($i == (count($CREDENCIALES_ROLES) - 1))
        {
                $ROLES .= "'" . $CREDENCIALES_ROLES[$i] . "'";
        }
        else
        {
                $ROLES .= "'" . $CREDENCIALES_ROLES[$i] . "',";
        }
}

$DATA       = agentByTOKEN($CREDENCIALES[0]);
$ACCESS__   = $CREDENCIALES[1];
$TOKEN2__   = $CREDENCIALES[3];
$LINK__     = $CREDENCIALES[4];

$TOKEN__    = $DATA['agent_token'];
$AGENCY__   = $DATA['agency_ID'];
$USER       = $DATA['agent_ID'];
$USER__     = $DATA['agent_ID'];
$USERNAME__ = $DATA['agent_name'];
$TYPE__     = $DATA['agency_type'];


if($DATA['agency_ID']){

        define("TOKEN_OBJECT", $CREDENCIALES[3]);
        define("LINK_OBJECT",$CREDENCIALES[4]);
        define("AGENT_ID", $DATA['agent_ID']);
        define("AGENT_NAME", $DATA['agent_name']);
        define("AGENCY_ID", $DATA['agency_ID']);
        define("AGENCY_TYPE", $DATA['agency_type']);    
        define("AGENCY_TOKEN", $DATA['agency_token']);    


        $_SESSION['AGENCY_ID']   =  $DATA['agency_ID'];
        $_SESSION['AG']          =  $DATA['agency_ID'];
        $_SESSION['AGENT_ID']    =  $DATA['agent_ID'];
        $_SESSION['AGENT_NAME']  =  $DATA['agent_name'];
        $_SESSION['AGENCY_SLACK']  =  $DATA['agency_webhook_slack'];
        $_SESSION['AGENCY_CLUUF']  =  $DATA['agency_endpoint_cluuf'];
        $_SESSION['AGENT_AVATAR']  =  $DATA['agent_avatar'];


}


// If Jotform realiza una solicitud 

if($_POST['submissionID']){

        $result = $_REQUEST['rawRequest'];
        $obj    = json_decode($result, true);
        $DATA   = agentByTOKENAGENCY($obj['jotform']);
        
        define("TOKEN_OBJECT", $obj['tokenObject']);
        define("AGENT_ID", '2');
        define("AGENT_NAME",'jotform');
        define("AGENCY_ID", $DATA['agency_ID']);
        define("AGENCY_TYPE", $DATA['agency_type']);    
        define("AGENCY_TOKEN", $DATA['agency_token']);    
}



$APP_STATUS[0] = 'Hold on';
$APP_STATUS[1] = 'Confirmed';
$APP_STATUS[2] = 'Canceled';

$REF_STATUS[0] = 'INACTIVE';
$REF_STATUS[1] = 'BASIC';
$REF_STATUS[2] = 'PREMIUM';

define("REF_STATUS_INACTIVE", 0);
define("REF_STATUS_BASIC", 1);
define("REF_STATUS_PREMIUM", 2);


// funciones muy usadas
function systemByAgency($AGENCY_ID)
{


        $SYSTEM['app_accepted'] = 1;
        $SYSTEM['app_canceled'] = 2;
        $SYSTEM['survey_option01_value'] = 1;
        $SYSTEM['survey_option01_name'] = 'Poor';
        $SYSTEM['survey_option02_value'] = 3;
        $SYSTEM['survey_option02_name'] = 'Good';
        $SYSTEM['survey_option03_value'] = 5;
        $SYSTEM['survey_option03_name'] = 'Excellent';
        $SYSTEM['survey_url_form'] = "https://ibusuites.com/form/survey/index.html";
        $SYSTEM['survey_appClose_subject'] = "Thanks for choosing us";
        $SYSTEM['survey_appClose_title'] = "How was your experience with us?";
        $SYSTEM['sys_backend_main'] = "https://backend.ibusuites.com/";
        $SYSTEM['sys_backend'] = "https://backend.ibusuites.com/Cliente/";
        $SYSTEM['sys_email_footer'] = "";
        $SYSTEM['sys_email_title_sameday'] = "";
        $SYSTEM['sys_email_title_anotherday'] = "";
        $SYSTEM['sys_email_sayhello'] = "Welcome Aboard ";
        $SYSTEM['sys_email_saygoodbye'] = "";
        $SYSTEM['sys_email_planFull'] = "Sorry this tour is Full =(";
        $SYSTEM['sys_email_saywelcome'] = " Welcome Abroad  ";
        $SYSTEM['sys_background_email_color'] = "#F0FDFE";
        $SYSTEM['sys_logo'] = "http://backend.ibusuites.com/admin/config/logo_min.png";
        $SYSTEM['sys_name'] = "Yantra";
        $SYSTEM['sys_phone'] = "573186855563";
        $SYSTEM['reviews_link'] = "http://g.page/capturecolombiatours/review";


        $m             = new formModel();
        $m->sql_nativo = " SELECT dato01 , dato02 FROM form020  WHERE dato40 in ('" . $AGENCY_ID . "') and archived = 'no' and dato03 = 'EMAIL TEMPLATE' ";
        $m->internal   = true;
        $res           = $m->all();

        for ($i             = 0;$i < count($res);$i++)
        {
                $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
        }

        return $SYSTEM;
}


function log_($title, $appID, $type)
{

        $m             = new formModel();
        $m->sql_nativo = " SELECT plan.link as li FROM form005 app, form001 plan WHERE app.id in (" . $appID . ") and plan.id = app.dato41";
        $m->internal   = true;
        $res           = $m->all();

        $m             = new formModel();
        $m->table      = 'form015';
        $m->archived   = 'no';
        $m->created    = $m->now__();
        $m->updated    = $m->now__();
        $m->dato10     = $type;
        $m->dato03     = $res[0]['link'];
        $m->dato01     = $title;
        $m->dato41     = 1;
        $m->dato40     = $appID;
        $m->dato42     = 1;
        $m->save();
}

function UsageAPI($apiName, $AgencyID, $userID, $userName    = 'Unknow')
{

        if ($userID != 2)
        {
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

function EventAPP($appID, $title, $type)
{

        if ($appID)
        {

                $EVENT_APP[3]               = 'New application via website';
                $EVENT_APP[1]               = 'New application via Referer';
                $EVENT_APP[2]               = 'New application via System';
                $EVENT_APP[0]               = 'New application ';

                $EVENT_APP[10]               = 'Sending Email type  ';
                $EVENT_APP[11]               = 'Sending Email Type Website Request ';
                $EVENT_APP[12]               = 'Sending Email Type Confirmation ';
                $EVENT_APP[13]               = 'Sending Email Type Survey';
                $EVENT_APP[14]               = 'Sending Email Type Welcome';
                $EVENT_APP[15]               = 'Sending Email Type Closure';
                $EVENT_APP[16]               = 'Sending Email Type Message';

                $EVENT_APP[30]               = 'Change Status';
                $EVENT_APP[31]               = 'Update App Information';
                $EVENT_APP[32]               = 'Delete App';
                $EVENT_APP[33]               = 'Add Payment';
                $EVENT_APP[34]               = 'Reverse Payment';
                $EVENT_APP[35]               = 'Update Schedule';
                $EVENT_APP[36]               = 'Update User Information';
                $EVENT_APP[37]               = 'User Confirmed';
                $EVENT_APP[38]               = 'User Canceled';
                $EVENT_APP[39]               = 'Departure Date/Time Changed';

                $m             = new formModel();
                $m->sql_nativo = " SELECT dato31  FROM form005  WHERE id in ('" . $appID . "')";
                $m->internal   = true;
                $res           = $m->all();

                $m             = new formModel();

                if ($res[0]['dato31'] == '')
                {
                        $event         = $EVENT_APP[$type] . "#" . $title . "#" . $m->now__() . "#" . $type;
                }
                else
                {
                        $event         = $res[0]['dato31'] . "|" . $EVENT_APP[$type] . "#" . $title . "#" . $m->now__() . "#" . $type;
                }

                $m->table      = 'form005';
                $m->dato31     = $event;
                $m->updated($appID);

        }

}

function createCode($tabla)
{

        $x             = 1;

        while ($x == 1)
        {

                $code          = generateRandomString(10);
                $sql           = "SELECT id FROM " . $tabla . " WHERE  code='" . $code . "'";
                $m             = new formModel();
                $m->sql_nativo = $sql;
                $m->internal   = true;
                $res           = $m->all();

                if ($res[0]['id'])
                {
                        $x             = 1;
                }
                else
                {
                        $x             = 0;
                }

        }

        return $code;

}

function resetCode($table)
{

        $sql           = "SELECT  * FROM " . $table;

        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        for ($i             = 0;$i < count($res);$i++)
        {
                $m        = new formModel();
                $m->table = $table;
                $m->code  = createCode($table);
                $m->updated($res[$i]['id']);
        }

}

function createToken($tabla)
{

        $x             = 1;

        while ($x == 1)
        {

                $code          = generateRandomString(100);
                $sql           = "SELECT id FROM " . $tabla . " WHERE  token='" . $code . "'";
                $m             = new formModel();
                $m->sql_nativo = $sql;
                $m->internal   = true;
                $res           = $m->all();

                if ($res[0]['id'])
                {
                        $x = 1;
                }
                else
                {
                        $x = 0;
                }

        }

        return $code;

}

function resetToken($table)
{

        $sql           = "SELECT  * FROM " . $table;

        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        for ($i             = 0;$i < count($res);$i++)
        {
                $m        = new formModel();
                $m->table = $table;
                $m->token = createToken($table);
                $m->updated($res[$i]['id']);
        }

}

function createLink($tabla)
{

        $x             = 1;

        while ($x == 1)
        {

                $code          = generateRandomString(100);
                $sql           = "SELECT id FROM " . $tabla . " WHERE  link='" . $code . "'";
                $m             = new formModel();
                $m->sql_nativo = $sql;
                $m->internal   = true;
                $res           = $m->all();

                if ($res[0]['id'])
                {
                        $x = 1;
                }
                else
                {
                        $x = 0;
                }

        }

        return $code;

}

function resetLink($table)
{

        $sql           = "SELECT  * FROM " . $table;

        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        for ($i             = 0;$i < count($res);$i++)
        {
                $m        = new formModel();
                $m->table = $table;
                $m->link  = createLink($table);
                $m->updated($res[$i]['id']);
        }

}

function notify($text)
{

        $payload  = array(
                'payload'          => json_encode(array(
                        'attachments'          => array(
                                0          => array(
                                        'fallback'          => $text,
                                        'color'          => '#9A42AF',
                                        'text'          => $text,
                                        'title_link'          => '',
                                        'footer'          => 'Capture Colombia Tours',
                                        'footer_icon'          => ''
                                )
                        )
                ))
        );

        //notify ---> $urlSlack = 'https://hooks.slack.com/services/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';
       
        //notifications Channel
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


function notifySlack($text,$webhookAgency)
{

        $payload  = array(
                'payload'          => json_encode(array(
                        'attachments'          => array(
                                0          => array(
                                        'fallback'          => $text,
                                        'color'          => '#9A42AF',
                                        'text'          => $text,
                                        'title_link'          => '',
                                        'footer'          => 'Cluuf System',
                                        'footer_icon'          => ''
                                )
                        )
                ))
        );

        $urlSlack = $webhookAgency;
        define('SLACK_WEBHOOK', $urlSlack);
        $c = curl_init(SLACK_WEBHOOK);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_exec($c);
        curl_close($c);

}

function notifySystem($text, $type)
{

        $payload  = array(
                'payload'          => json_encode(array(
                        'attachments'          => array(
                                0          => array(
                                        'fallback'          => $text,
                                        'color'          => '#9A42AF',
                                        'text'          => $text,
                                        'title_link'          => '',
                                        'footer'          => 'Capture Colombia Tours',
                                        'footer_icon'          => ''
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

function slack_($payload)
{

        $c = curl_init('https://hooks.slack.com/services/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');
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_exec($c);
        curl_close($c);

}

function getColor()
{
        return setColor();
}

function ok()
{
        echo 'ok';
}

function setColor()
{

        $color[0] = '#f9fafc';
        $color[1] = '#eef2e1';
        $color[2] = '#e2f1e0';
        $color[3] = '#dff0ee';
        $color[4] = '#dee9ef';
        $color[5] = '#dee1ef';
        $color[6] = '#dfdeef';
        $color[7] = '#e6deef';
        $color[8] = '#eedeef';
        $color[9] = '#efdeea';
        $color[10] = '#efdee4';
        $color[11] = '#efdedf';
        $color[12] = '#fff6e8';
        $color[13] = '#ffffe8';
        $color[14] = '#f3ffe8';
        $color[15] = '#eaffe8';
        $color[16] = '#e8fff8';
        $color[17] = '#e8fcff';
        $color[18] = '#e8f5ff';
        $color[19] = '#eae8ff';
        $color[20] = '#f0e8ff';
        $color[21] = '#f5e8ff';
        $color[22] = '#ffedfe';
        $color[23] = '#ffedf3';
        $color[24] = '#ffeded';
        $color[25] = '#edffed';

        return $color[rand(0, 24) ];

}

//slack("Token : ".$TOKEN2__." / Reqs: ".$request[0]." / Agency: ".$AGENCY__." / User : ".$USER );
$TYPE = $CREDENCIALES[1];
//$ROLE   = $USERDATA['role'];


if (($method === 'GET') && ($request[0] == 'telegram'))
{
        $bot  = new BOTQuerys("867635336:AAHjPOo8wFXHB-iCmr67CCfq0yCEMsKSkI8", "847875487");

        /*$html ="<b>bold</b>, <strong>bold</strong>
        <i>italic</i>, <em>italic</em>
        <a href='http://www.example.com/'>inline URL</a>
        <a href='tg://user?id=123456789'>inline mention of a user</a>
        <code>inline fixed-width code</code>
        <pre>pre-formatted fixed-width code block</pre>";*/

        $bot->sendMessage($html);
        exit;
}

function telegram($text)
{
        $bot = new BOTQuerys("867635336:AAHjPOo8wFXHB-iCmr67CCfq0yCEMsKSkI8", "847875487");
        $bot->sendMessage($text);
}


function FindBy__($table, $campo, $id, $select, $type      = "single")
{
        $m         = new formModel();
        $m->table  = $table;
        $m->select = $select;

        if ($campo == 'id') $m->where__('id', '=', $id);
        else if ($campo == 'token') $m->where__('token', '=', $id);
        else if ($campo == 'link')  $m->where__('link', '=', $id);
        else if ($campo == 'dato40') $m->where__('dato40', '=', $id);
        else if ($campo == 'dato01') $m->where__('dato01', '=', $id);

        $m->internal = true;
        $res         = $m->all();

        if ($type == "single") return $res[0];
        else if ($type == "array") return $res;
        else if ($type == "json") return json_encode($res);
}


function findRow($table, $campo, $id, $select)
{
        $m         = new formModel();
        $m->table  = $table;
        $m->select = $select." as 'value' ";

        if ($campo == 'id') $m->where__('id', '=', $id);
        else if ($campo == 'token') $m->where__('token', '=', $id);
        else if ($campo == 'link')  $m->where__('link', '=', $id);
        else if ($campo == 'dato40') $m->where__('dato40', '=', $id);
        else if ($campo == 'dato01') $m->where__('dato01', '=', $id);
        $m->internal = true;
        $res         = $m->all();
        return $res[0]['value'];
}



function jsonOut($x)
{
        $result['result'] = $x;
        return json_encode($result);
}

function prepararMonto($monto)
{
        $monto = trim(str_replace("$", "", $monto));
        $monto = trim(str_replace(".", "", $monto));
        $monto = trim(str_replace(",", ".", $monto));
        return floatval($monto) + floatval(0.00);
}

function setMoney($monto)
{
        $monto = trim(str_replace("$", "", $monto));
        $monto = trim(str_replace(".", "", $monto));
        $monto = trim(str_replace(",", ".", $monto));
        return floatval($monto) + floatval(0.00);
}

function consola($msj  = "")
{

        if ($msj == "")
        {
                $arch = fopen("consola.txt", "w+");
                fwrite($arch, "");
                fclose($arch);
        }
        else
        {
                $nombre_archivo1 = "consola.txt";
                $archivo1        = fopen($nombre_archivo1, "w");
                fwrite($archivo1, $msj . "  \n");
        }

}

function setCode($code)
{

        if ($code < 10)
        {
                return '00000' . $code;
        }
        else if ($code < 100)
        {
                return '0000' . $code;
        }
        else if ($code < 1000)
        {
                return '000' . $code;
        }
        else if ($code < 10000)
        {
                return '00' . $code;
        }
        else if ($code < 100000)
        {
                return '0' . $code;
        }
}



function agentByTOKEN($agentTOKEN)
{

        $sql           = "SELECT 
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
        agency.dato19   AS 'agency_webhook_slack', 
        agency.dato21   AS 'agency_endpoint_cluuf',          
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
WHERE  agent.token in ('" . $agentTOKEN . "') 
       AND agent.dato40    = agency.id 
       AND agency.archived = 'no'
       AND agent.archived  = 'no' ";

        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();
        $result        = $res[0];

        return $result;
}




function agentByTOKENAGENCY($agencyTOKEN)
{

        $sql           = "SELECT 
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
        agency.dato19   AS 'agency_webhook_slack', 
        agency.dato21   AS 'agency_endpoint_cluuf',          
        agency.token    AS 'agency_token', 
        agency.link     AS 'agency_link', 
        agency.id       AS 'agency_ID'
FROM   form003 agency
WHERE  agency.token in ('".$agencyTOKEN."') 
       AND agency.archived = 'no' ";

        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();
        $result        = $res[0];
        return $result;
}


function CompleteCode($code)
{

        if ($code < 10)
        {
                return '00000' . $code;
        }
        else if ($code < 100)
        {
                return '0000' . $code;
        }
        else if ($code < 1000)
        {
                return '000' . $code;
        }
        else if ($code < 10000)
        {
                return '00' . $code;
        }
        else if ($code < 100000)
        {
                return '0' . $code;
        }

}


function formatDate($day){
 // "2020-02-01" -> Thu 01 February
     return  date("D d F",strtotime($day));
}

function repararFecha($fecha)
{
        $x   = explode("/", $fecha);
        $dia = $x[0];
        $mes = $x[1];
        $ano = $x[2];
        return $ano . "-" . $mes . "-" . $dia;
}

function repararFecha3($fecha)
{
        $x   = explode("/", $fecha);
        $dia = $x[1];
        $mes = $x[0];
        $ano = $x[2];
        return $ano . "-" . $mes . "-" . $dia;
}

function repararFecha2($fecha)
{
        $x   = explode("/", $fecha);
        $dia = $x[1];
        $mes = $x[0];
        $ano = $x[2];
        return $ano . "-" . $mes . "-" . $dia;
}

function repararFechaMMDDYYYY($fecha, $divisor = "-")
{
        return $fecha;
}

function validarNumero($x)
{

        if (is_numeric($x))
        {
                return $x;
        }
        else
        {
                return 0;
        }
}

function validarUser($action)
{
        $CREDENCIALES = explode("lsd", $action);

        $c            = new formModel();
        $c->table     = "form002";
        $c->internal  = true;
        $c->where__("token", "=", $CREDENCIALES[0]);
        $res = $c->all();
        return $res[0];
}

function generateRandomString($length        = 10)
{
        return strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") , 0, $length / 2)) . strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") , 0, $length / 2));
}

function GenerarCode($table, $agency)
{

        $m             = new formModel();
        $m->internal   = true;
        $m->sql_nativo = "SELECT code FROM " . $table . " where dato45 in (" . $agency . ") order by id desc limit 1";
        $res           = $m->all();

        if ($res[0]['code'] < 1)
        {
                $res[0]['code']               = 0;
        }

        return $code          = $res[0]['code'] + 1;

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

function GenerarCorrelativo($table, $agency)
{

        $m             = new formModel();
        $m->internal   = true;
        $m->sql_nativo = "SELECT code FROM " . $table . " where dato45 in (" . $agency . ") order by id desc limit 1";
        $res           = $m->all();

        if ($res[0]['code'] < 1)
        {
                $res[0]['code']               = 0;
        }

        return $code          = $res[0]['code'] + 1;

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

function comprobar_email($email)
{
        $mail_correcto = 0;
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@"))
        {
                if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " ")))
                {
                        //miro si tiene caracter .
                        if (substr_count($email, ".") >= 1)
                        {
                                //obtengo la terminacion del dominio
                                $term_dom      = substr(strrchr($email, '.') , 1);
                                //compruebo que la terminación del dominio sea correcta
                                if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@")))
                                {
                                        //compruebo que lo de antes del dominio sea correcto
                                        $antes_dom     = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                                        $caracter_ult  = substr($antes_dom, strlen($antes_dom) - 1, 1);
                                        if ($caracter_ult != "@" && $caracter_ult != ".")
                                        {
                                                $mail_correcto = 1;
                                        }
                                }
                        }
                }
        }

        if ($mail_correcto)
        {
                return 1;
        }
        else
        {
                return 0;
        }

}


function findByID($table, $id)
{
        $m         = new formModel();
        $m->table  = $table;
        $m->select = 'dato01,dato02,dato03,dato40,token,dato05,link  ';
        $m->where__('id', '=', $id);
        $m->internal = true;
        $res         = $m->all();
        return $res[0];
}



function objectID($table, $token , $agency_id = false)
{

        $ag =";";

        if($agency_id){

           $ag = "and dato45 in ('".$agency_id."');";
       
        }
        

        $m             = new formModel();
      
        $m->sql_nativo = " SELECT id FROM ".$table." WHERE token in ('".$token."') ".$ag;
      
        $m->internal   = true;
        $res           = $m->all();

        if($res[0]['id']){
                return $res[0]['id'];
        }else{
                 return false;
        }
               
}


function findByLink($table, $link)
{
        $m        = new formModel();
        $m->table = $table;
        $m->where__('link', '=', $link);
        $m->internal = true;
        $res         = $m->all();
        return $res[0];
}

function FindBy($table, $campo, $id, $select, $type      = "single")
{
        $m         = new formModel();
        $m->table  = $table;
        $m->select = $select;

        if ($campo == 'id') $m->where__('id', '=', $id);
        else if ($campo == 'token') $m->where__('token', '=', $id);
        else if ($campo == 'link') $m->where__('link', '=', $id);
        else if ($campo == 'dato40') $m->where__('dato40', '=', $id);
        else if ($campo == 'dato01') $m->where__('dato01', '=', $id);

        $m->internal = true;
        $res         = $m->all();

        //echo $m->sql__;
        if ($type == "single") return $res[0];
        else if ($type == "array") return $res;
        else if ($type == "json") return json_encode($res);
}


function sg($text,$long=200){

        return substr($text,0,$long);

}


function sendEmailAdmin__($agencyID,$asunto,$body,$email='false'){

    
    $VARIABLES_EMAIL    = varialesGlobalesEmails($agencyID);

    if($email=='false'){
        $email = $VARIABLES_EMAIL['email_admin'];
    }

    if(comprobar_email($email)==0){      
        notify('Error comprobando email sendEmailAdmin__ en common ');
    }else{

            $to__      = $email;
            $subject   = $asunto;
            $from_name = $VARIABLES_EMAIL['from_name'];
            $from_     = "ibusuite@qreatech.com";
            $html      =   __Template__($agencyID,$body);
            $from     = new SendGrid\Email($from_name, $from_);
            $subject  = $subject;
            $to       = new SendGrid\Email("ibusuite", $to__);
            $content  = new SendGrid\Content("text/html", $html);
            $mail     = new SendGrid\Mail($from, $subject, $to, $content);
            $apiKey   = "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"; 
            $sg       = new \SendGrid($apiKey);
            $response = $sg->client->mail()->send()->post($mail);
            
            if ($response->statusCode() != "202") {
                //telegram($response->statusCode()."-->".$response->body());
            }else{
                //telegram($response->statusCode()."-->".$response->body());
            }

    }

   
}

function messagePublic($AGENCY_ID,$msj){
                
                $database = varialesGlobalesSystem($AGENCY_ID);
                
                return "<div style='margin:auto;max-width:600px;margin-top:100px; text-align:center'>
                <p>
                <img src='".$database['logo_color']."' width='200px'><br><br><br>
                                ".$msj."
                </p><br><br>
                <a  style='border: 1px solid; padding: 7px 30px; text-decoration: none; position: relative; top: 10px; border-radius: 4px;' href='".$database['url_home']."'> Go to Website </a>
                </div>";

}

function __Template__($VARIABLES_EMAIL,$body){
    
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
                        <tr style='background:#F0FDFE'>
                            <td align=\"center\">
                               <br><img width='150px' src='https://backend.ibusuites.com/admin/Login/images/logo2.gif' alt='System Notification' /><br>
                            </td>
                        </tr>

                        <tr>
                            <td class=\"content\">
                               ".$body."
                            </td>
                        </tr>

                    
                        
                    </table>
                </td>
            </tr>
        </table>
        </body>
        </html>";
}

function varialesGlobalesEmails($agency){

    $m = new formModel();
    $m->sql_nativo = " SELECT * FROM form020  WHERE dato40 in ('".$agency."') and archived = 'no' and dato41 in (157) ";
    $m->internal = true;
    $res = $m->all();

        for($i=0;$i<count($res);$i++){
          $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
        }

        return $SYSTEM;
}



function varialesGlobalesSystem($agency){

    $m = new formModel();
    $m->sql_nativo = " SELECT * FROM form020  WHERE dato40 in ('".$agency."') and archived = 'no' and dato41 in (156) ";
    $m->internal = true;
    $res = $m->all();

        for($i=0;$i<count($res);$i++){
          $SYSTEM[$res[$i]['dato01']] = $res[$i]['dato02'];
        }

        return $SYSTEM;
}


function suprimirSelects($noselect,$rows){

        foreach($rows as $key=>$value){
                $SI.= $key.",";                     
        }

      
        $YES = explode(",",substr($SI,0,-1));
        $NO = explode(",",$noselect);


         foreach($YES as $Y){

                $paso  = true;
                foreach($NO as $N){

                  if($N==$Y) $paso = false;

          
                }
                if($paso) $TOTAL[] = $Y;
                             
          }
    return join(",",$TOTAL);;
}



function master($tabla,$alias,$select,$noselect,$rows,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";

 
    if($select!='null'){
         $ROW = explode(",",$select);
          for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
           }

    } 


    if($select=='null'){

         if($noselect=='null'){

          foreach ( $rows as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }

          
        }else{


               $selectFinal = suprimirSelects($noselect,$rows);
               $ROW = explode(",",$selectFinal);
               for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
               }

        }
    }


    
      $sql.=" '' as '' FROM  ".$tabla."  ".$alias." WHERE ".$alias.".dato45 in (".$AGENCY_ID.")  and  ".$alias.".archived = 'no' and ".$WHERE;
      

      if($alias=='web'){
        //notify($sql);
      }



      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}



function single($tabla,$alias,$Id,$select,$noselect,$rows,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";

    if($select!='null'){
         $ROW = explode(",",$select);
          for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
           }
    } 


    if($select=='null'){


         if($noselect=='null'){

          foreach ( $rows as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }

          
        }else{


               $selectFinal = suprimirSelects($noselect,$rows);
               $ROW = explode(",",$selectFinal);
               for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
               }

        }
    
    }
    



      $sql.=" '' as '' FROM  ".$tabla."  ".$alias." WHERE ".$alias.".dato45 in (".$AGENCY_ID.") and ".$alias.".id in (".$Id.") and  ".$alias.".archived = 'no' and ".$WHERE;
      
      if($alias=='pack'){
        //notify($sql);
       } 
        

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}





function singleNoId($tabla,$alias,$select,$noselect,$rows,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";

    if($select!='null'){
         $ROW = explode(",",$select);
          for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
           }
    } 


    if($select=='null'){


         if($noselect=='null'){

          foreach ( $rows as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }

          
        }else{


               $selectFinal = suprimirSelects($noselect,$rows);
               $ROW = explode(",",$selectFinal);
               for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
               }

        }
    
    }
    



      $sql.=" '' as '' FROM  ".$tabla."  ".$alias." WHERE ".$alias.".dato45 in (".$AGENCY_ID.") and  ".$alias.".archived = 'no' and ".$WHERE;
      
        

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}





/* No importa el numero de la agencia */
function masterPublic($tabla,$alias,$select,$noselect,$rows,$WHERE="1=1"){


    /* solo permite consultas a la table master */
    if($alias!='master') exit;


    $sql = " SELECT ";

 
    if($select!='null'){
         $ROW = explode(",",$select);
          for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
           }

    } 


    if($select=='null'){

         if($noselect=='null'){

          foreach ( $rows as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }

          
        }else{


               $selectFinal = suprimirSelects($noselect,$rows);
               $ROW = explode(",",$selectFinal);
               for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
               }

        }
    }


    
      $sql.=" '' as '' FROM  ".$tabla."  ".$alias." WHERE  ".$alias.".archived = 'no' and ".$WHERE;
      

      //if($alias=='web') echo $sql;



      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}





function countryCode($country){

$countries = array
(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BS' => 'The Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GM' => 'The Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
);

while ($name = current($countries)) {
    if ( trim(strtoupper($name)) == trim(strtoupper($country)) ) {
        return key($countries); 
    }
    next($countries);
}
 
 notify('no asocio la nacionalidad '.$country);
 return 0;

}


?>
