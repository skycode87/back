<?php 

/*
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
ini_set("display_errors", 1);
date_default_timezone_set("America/Bogota");
*/

class Conexion {

    public $con;
    public $sql;


    public $insert_field__      = null;
    public $insert_value__      = null;

    public $where_value__       = null;
    public $set_update__        = null;
    public $where_condition__   = null;
    public $extra_sql__         = null;
    public $sql__;
    public $foreign_field__     = null;
    public $foreign_table__     = null;
    public $foreign_column__     = null;
    public $foreign_select__     = null;
    public $statesment           = '';
    public $prepare__               = '';
    
    public $error               = "error";
    public $internal            = false;
    public $select              = "false";

    public $server              = "https://qreatech.com/API/";
    public $status_inital       = "151"; /* En Config es Only Account */              
    public $agent_initial       = "103"; /* En Config es Only Account */     
    public $verSQL              = "";         
    public $sql_in              = false;         
    public $sql_nativo          = "0";
    public $tokenUser           ="";


    public function open(){
        $this->con = new mysqli("us-cdbr-east-06.cleardb.net", "b77167052670e3", "bce3dba6", "heroku_59520dcef0b43d9");

      

    }




    public function execute_sql($sql2){
        $this->open();
        $this->sql = $this->con->query($sql2);
        return $this->sql;    
    }



    public function MysqlgetJson($sql) {

        $this->open();

        if (!$resultado = $this->con->query($sql)) {
            echo "error";
            exit;
        }

        while ($result = $resultado->fetch_assoc()) {
            $filas[] = $result;
        }

        echo json_encode($filas);
    }



    public function Mysqlget($sql) {

        $this->open();

        if (!$resultado = $this->con->query($sql)) {
            echo "error";
            exit;
        }

        while ($result = $resultado->fetch_assoc()) {
            $filas[] = $result;
        }

        return $filas;
    }



    function id__()
    {
        return $this->con->insert_id;
    }


    public function where__($x,$y,$z){
        $this->where_condition__.= $x." ".$y."  '".$z."'  AND ";
    }



    public function where__IN($x,$y){
        $this->where_condition__.= $x." IN (".$y.")  AND ";
    }

    public function foreign__($ff,$ft,$fc="id",$fs=' * ')
    {

        $this->foreign_field__[] = $ff;
        $this->foreign_table__[] = $ft;
        $this->foreign_column__[] = $fc;
        $this->foreign_select__[] = $fs;

    }


    public function ta__($x){
       return  json_decode($x);
   }

   public function tj__($x){
       return  json_encode($x);
   }



   public function ejecucion()
   {

    $mode = "update";
    $request = "";

    for ($i=0; $i <count($this->where_value__) ; $i++) { 

        $this->set_update__.= $this->where_field__[$i]." = '".$this->where_value__[$i]."',";

        $this->insert_field__.=  "".$this->where_field__[$i].",";
        $this->insert_value__.=  "'".$this->where_value__[$i]."',";


    }


    $this->set_update__     = substr($this->set_update__,0,-1);
    $this->insert_field__   = substr($this->insert_field__,0,-1);
    $this->insert_value__   = substr($this->insert_value__,0,-1);


    if( $this->id != null ) {
        $sql =  "UPDATE ".$this->table." SET ".$this->set_update__."  WHERE id in ('".$this->id."')";
    }else  if( $this->where_condition__ != null ){
        $sql = "UPDATE ".$this->table." SET  ".$this->set_update__." WHERE ".$this->where_condition__." 1=1 ".$this->extra_sql__ ;
    }else{
        $sql = "INSERT INTO ".$this->table." (".$this->insert_field__ .") VALUES (".$this->insert_value__.");";
        $mode = "insert";
    }


    $nombre_archivo1 = "einstein.txt";
    $archivo1 = fopen($nombre_archivo1, "a");
    fwrite($archivo1, date("d m Y H:i:s")."-->".$_SERVER['REMOTE_ADDR']."-->".$sql."  \n");

    $this->sql__ = $sql;
    $this->open();
    $this->request  = $request;
    $mysqli         = $this->con;

    if ($stmt = $mysqli->prepare($this->sql__)) {

$this->statesment = $stmt->execute();

        if($this->statesment){

       
            
            if($mode == "insert") return $this->id__();
            if($mode == "update"){
                
                if($stmt->execute()==0){
                    return 0;
                }else{
                  return 1;
                }
                
                
            } 
            
        }else{
            return 0;
        }

    }else{
        return 0;
    }

}





public function foreign_query($table,$id,$column="id",$select){



    if ($resultado = $this->con->query("SELECT ".$select." FROM ".$table." WHERE ".$column."  in ('".$id."') ") ) {


        while ($result = $resultado->fetch_assoc()) {
            $myArray[] = $result;

        }

        return $myArray[0];
    }

}








public function updateAccess($userId){
     $this->open();
     $mysqli         = $this->con;
     $acceso        = md5(strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10)));
     $sql1          = "update form002 set dato08 = '".$acceso."' where id in ('".$userId."')";
     $stmt          = $mysqli->prepare($sql1);
     $stmt->execute();
     return $acceso;
}



public function all($id=null){


    if($this->tokenUser){
        $acceso = $this->updateAccess($this->tokenUser['id']);
    }else{
        $acceso = 0;
    }


    if( $id != null ){

        $w = " id in ('".$id."')";

    }else if($this->where_condition__ == null){
        $w = "1=1";
    }else{
        $w = $this->where_condition__." 1=1";
    }

    if($this->extra_sql__ == null)
    {
        $e = "";
    }else{
        $e = $this->extra_sql__;
    }

    $this->open();


    if($this->select!="false"){
        $sql001 = "SELECT  ".$this->select." , '".$acceso."' as access    FROM ".$this->table." WHERE ".$w." ".$e;
    }else{
        $sql001 = "SELECT * , 'hoftman' as pass , '".$acceso."' as access  FROM ".$this->table." WHERE ".$w." ".$e;
    }


    if($this->sql_in){
       $sql001 = "SELECT * , 'hoftman' as pass , '".$acceso."' as access   FROM ".$this->table." WHERE ".$w." ".$e;
   }




   if( strlen($this->sql_nativo) >5  ){
    $sql001 = $this->sql_nativo;
}


$cadena_de_texto = $sql001;
$cadena_buscada   = 'DELETE';
$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

if ($posicion_coincidencia === false) {


} else {

    $this->verSQL = $sql001;
    //$nombre_archivo1 = "hoftman.txt";
    //$archivo1 = fopen($nombre_archivo1, "a");
    //fwrite($archivo1, date("d m Y H:i:s")."-->Hacking bloqueado ".$_SERVER['REMOTE_ADDR']."-->".$sql001."  \n");

}


 //echo $sql001;

$this->sql__ = $sql001;
//$nombre_archivo1 = "hoftman.txt";
//$archivo1 = fopen($nombre_archivo1, "a");
//fwrite($archivo1, date("d m Y H:i:s")."-->".$_SERVER['REMOTE_ADDR']."-->".$sql001."  \n");


$resultado = $this->con->query($sql001);



if ($resultado = $this->con->query($sql001)) {

    while ($result = $resultado->fetch_assoc()) {
       $myArray[] = $result;
   }

   for ($y=0; $y < count($myArray) ; $y++) { 
        if( $this->foreign_table__ != null){
            for ($i=0; $i <count($this->foreign_table__) ; $i++) {
                $myArray[$y][$this->foreign_field__[$i]."_fk"] = $this->foreign_query( $this->foreign_table__[$i] , $myArray[$y][$this->foreign_field__[$i]],$this->foreign_column__[$i],$this->foreign_select__[$i]  );
            }
        }
    }


if(!$myArray){
 $myArray["pass"]="manhoft";
}






if(!$this->internal){

  //  print_r($myArray);

   $error = json_last_error();

   echo json_encode($myArray);

   if(json_last_error()){

    switch(json_last_error()) {
        case JSON_ERROR_NONE:
        echo ' - Sin errores';
        break;
        case JSON_ERROR_DEPTH:
        echo ' - Excedido tamaño máximo de la pila';
        break;
        case JSON_ERROR_STATE_MISMATCH:
        echo ' - Desbordamiento de buffer o los modos no coinciden';
        break;
        case JSON_ERROR_CTRL_CHAR:
        echo ' - Encontrado carácter de control no esperado';
        break;
        case JSON_ERROR_SYNTAX:
        echo ' - Error de sintaxis, JSON mal formado';
        break;
        case JSON_ERROR_UTF8:
        echo ' - Caracteres UTF-8 malformados, posiblemente están mal codificados';
        break;
        default:
        echo ' - Error desconocido';
        break;
    }


}


}else{
    return $myArray;

}

}

}





public function ARR__($json,$n=1){


 if($n>0){
     $arr[$n] = json_decode($json);
     return $arr[$n];
 }

 if($n==0){
     $arr = json_decode($json);
     return $arr;
 }



}


public function delete($id){
    $this->open();
    $mysqli = $this->con;
    if ($stmt = $mysqli->prepare("UPDATE ".$this->table." set archived='yes'  , archived_at = CURRENT_TIMESTAMP()  where id=? ")) {
        $stmt->bind_param("i",$id);
        return($stmt->execute());
    }
}


function date_sql($fecha)
{
    $ano = substr($fecha, -4);
    $mes = substr($fecha, -7, 2);
    $dia = substr($fecha, -10, 2);
    return "$ano/$mes/$dia";
}

public function datetime_now()
{
    return date('Y-m-d H:i:s');
}

public function now__()
{
    return date('Y-m-d H:i:s');
}

function md7__($x){
    return md5(md5($x)).md5($x);
}

function Sanitize($input, $type) {
  switch ($type) {
    // 1- Input Validation


    case 'password': // comprueba si $input es integer
    $output = md5($input);
    
    break;
    

    case 'int': // comprueba si $input es integer
    if (is_int(pg_escape_string($input))) {
     $output = $input;
 } else {
    $output = "";
}
break;

    case 'str': // comprueba si $input es string
    if (is_string(pg_escape_string($input))) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    case 'digit': // comprueba si $input contiene solo numeros
    if (ctype_digit($input)) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    case 'upper': // comprueba si $input contiene solo mayusculas
    if ($input == strtoupper($input)) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    case 'lower': // comprueba si $input contiene solo minusculas
    if ($input == strtolower($input)) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    case 'mobile': // comprueba si $input contiene 9 numeros
    if ((strlen($input) == 9) && (ctype_digit($input) == TRUE)) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    case 'email': // comprueba si $input tiene formato de email
    $reg_exp = "/^[-.0-9A-Z]+@([-0-9A-Z]+.)+([0-9A-Z]){2,4}$/i";
    if (preg_match($reg_exp, pg_escape_string($input))) {
        $output = $input;
    } else {
        $output = "";
    }
    break;
    
    
    case 'no_html': // los datos van a una pagina web, escapar para HTML
    $output = htmlentities(trim($input), ENT_QUOTES);
    break;
    
    case 'shell_arg': // los datos van al shell, escapar para shell argument
    $output = escapeshellarg(trim($input));
    break;
    
    case 'shell_cmd': // los datos van al shell, escapar para shell command
    $output = escapeshellcmd(trim($input));
    break;
    
    case 'url': // los datos forman parte de una URL, escapar para URL
    
      // htmlentities() traduce a HTML el separador &
    $output = htmlentities(urlencode(trim($input)));
    break;
    
    case 'comment': // los datos solo pueden contener algunos tags HTML
    $output = strip_tags($input, '<b><i><img>');
    break;
}
return $output;
}



/* PASSWORD */

public function password_create($pass)
{
    return password_hash ($pass, PASSWORD_DEFAULT);
}



public function getToken(){
    return md5(rand("10000000","123456789"));
}


public function getCodeToken($fecha,$clienteId,$agenteId,$referenciaId){
    return md5(md5($fecha).md5($clienteId).md5($agenteId).md5($referenciaId));
}


}


?>
