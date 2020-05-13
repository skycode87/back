<?php




function updateCluufPack($msj,$code){

 
 // notifySlack("The Website has been updated by *".$_SESSION['AGENT_NAME']."*  \n :grinning:  ".$msj,$_SESSION['AGENCY_SLACK']);

  $cURLConnection = curl_init();
  curl_setopt($cURLConnection, CURLOPT_URL,"https://capturecolombiatours.com/cluuf/system/loadPack.php?code=".$code);
  curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
  curl_exec($cURLConnection);
  curl_close($cURLConnection);

  // actualiza todos 
  updateCluufPacks();


}


function updateCluufPacks(){
 // notifySlack("The Website has been updated by *".$_SESSION['AGENT_NAME']."*  \n :grinning:  ".$msj,$_SESSION['AGENCY_SLACK']);
  $cURLConnection = curl_init();  
  curl_setopt($cURLConnection, CURLOPT_URL,"https://capturecolombiatours.com/cluuf/system/loadData.php");
  curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
  curl_exec($cURLConnection);
  curl_close($cURLConnection);
}




?>