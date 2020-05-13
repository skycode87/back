<?php
include_once "../main/common.php";
include_once "app.php";

if(($method==='POST')&&(AGENCY_ID)){

			   // UsageAPI('appCreatePayment',AGENCY_ID,AGENT_ID,AGENT_NAME);
			   
			    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);

			    echo $appId;


   			if($appId){

			    $database__ = AppByID($appId);

			   	$m 			= new formModel();
				$m->table  	= _trans_;
				$m->user   	= AGENT_ID;
				$m->archived= 'no';
				$m->created = $m->now__();
				$m->updated = $m->now__();
			    $m->link    = createLink(_trans_);
				$m->code 	= createCode(_trans_);
				$m->token 	= createToken(_trans_);
				$m->dato01 	= $database__['user_fullname']; 
				$m->dato02 	= $database__['user_email']; 
				$m->dato03 	= $database__['user_phone']; 
				$m->dato04 	= $database__['user_document']; 
				$m->dato05 	= $database__['pack_name']." ".$_POST['trans_reference_number']."  ".$_POST['trans_card_holder']."  ".$_POST['trans_comments']." ".$database__['plan_departure_date']." ".$database__['plan_departure_time']." [".CompleteCode($database__['app_code'])."]"; 
				$m->dato07 	= $database__['user_email']; 
				$m->dato09 	= 'input'; 
				$m->dato10 	= $_POST['trans_mode']; 
				$m->dato11 	= $_POST['trans_reference_number']; 
				$m->dato12 	= $_POST['trans_card_holder']; 
				$m->dato13 	= $_POST['trans_comments']; 
				$m->dato14 	= "approved"; 
				$m->dato26 	= floatval($database__['app_total'])-floatval(setMoney($_POST['trans_paid'])); 
				$m->dato25 	= floatval(setMoney($_POST['trans_paid'])); 
				$m->dato27 	= floatval($database__['app_total']); // el total a pagar
			    $m->dato40	= $appId; // id de la applicacion 
			    $m->dato41	= $database__['user_ID']; // id del cliente
			    $m->dato43  = $idCaja; 
			    $m->dato45	= AGENCY_ID; // id del cliente 
				$transId  	= $m->save();
							
							if($transId){
								EventAPP($app_['id'],$_POST['trans_paid'],'33'); 
								$app_paid = calculeTotalApp($database__['app_ID']);
							}

  		  	}
 
    }else{
    	echo "error en ID";
    }





function calculeTotalApp($appId){

     $m = new formModel();
	 $m->internal = true;
     $m->sql_nativo = "SELECT sum(dato25) as total_paid FROM form009  WHERE archived='no' and dato40 in (".$appId.") group by dato40";
     $trans__ = $m->all();


     $m = new formModel();
	 $m->internal = true;
     $m->sql_nativo = "SELECT dato26 as total  FROM form005  WHERE id in (".$appId.")";
     $app = $m->all();

	 $m = new formModel();
	 $m->table  	= "form005";
	 $m->dato25 	= $trans__[0]['total_paid']; 

	 $total['pending'] = floatval($app[0]['total'])-floatval($trans__[0]['total_paid']);

	if($total['pending']<=0){
				$m->dato01 	= 1; 
				$m->dato10  = 1;
	}

	$m->save($appId);

	$total['paid'] 	 = floatval($trans__[0]['total_paid']);
	
	return $total;

}



?>