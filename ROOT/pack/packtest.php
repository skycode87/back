<?php

include_once "../main/common.php";
//include_once "pack.php";
//include_once "app.php";

//emailAppCreateWeb('1985');


// echo date("D d F",strtotime("2020-01-02"));

/*
$form001 = array(
  array('id' => '188','dato30' => 'vUy2NKoLSDKuw5mAN4uZ')
);


foreach ($form001  as $value) {

$file 	   = $value['dato30'];

$str 	   = '{"expiry":1578551400,"call":["remove"],"handle":"'.$file.'"}';
$policy    = base64_encode($str);
$signature = hash_hmac('sha256', $policy,'YWRKQ2CFVVDQVLMBIHGJMMEK44');


$data = "https://www.filestackapi.com/api/file/".$file."?key=AZjNS8FgSda0VCN1HG7Swz&policy=".$policy."&signature=".$signature;

curl_del($data);





}
*/


     	$m             = new formModel();
        $m->sql_nativo = " SELECT id,dato06 FROM form006 where dato06 <> '' and id > 1000";
        $m->internal   = true;
        $res           = $m->all();


foreach ($res  as $val) {

                //$m          = new formModel();
                //$m->table   = 'form006';
                //$m->dato06  = convert($val);
                //$m->updated($val['id']);
                echo convert($val['dato06']);

}
				

 function convert($res1){

             


$user_nationality = $val1;



if($user_nationality=='AF'){

 $newVal ='Afghanistan';

} else if($user_nationality=='AX'){

 $newVal ='Åland Islands';

} else if($user_nationality=='AL'){

 $newVal ='Albania';

} else if($user_nationality=='DZ'){

 $newVal ='Algeria';

} else if($user_nationality=='AS'){

 $newVal ='American Samoa';

} else if($user_nationality=='AD'){

 $newVal ='Andorra';

} else if($user_nationality=='AO'){

 $newVal ='Angola';

} else if($user_nationality=='AI'){

 $newVal ='Anguilla';

} else if($user_nationality=='AQ'){

 $newVal ='Antarctica';

} else if($user_nationality=='AG'){

 $newVal ='Antigua and Barbuda';

} else if($user_nationality=='AR'){

 $newVal ='Argentina';

} else if($user_nationality=='AM'){

 $newVal ='Armenia';

} else if($user_nationality=='AW'){

 $newVal ='Aruba';

} else if($user_nationality=='AU'){

 $newVal ='Australia';

} else if($user_nationality=='AT'){

 $newVal ='Austria';

} else if($user_nationality=='AZ'){

 $newVal ='Azerbaijan';

} else if($user_nationality=='BS'){

 $newVal ='Bahamas';

} else if($user_nationality=='BH'){

 $newVal ='Bahrain';

} else if($user_nationality=='BD'){

 $newVal ='Bangladesh';

} else if($user_nationality=='BB'){

 $newVal ='Barbados';

} else if($user_nationality=='BY'){

 $newVal ='Belarus';

} else if($user_nationality=='BE'){

 $newVal ='Belgium';

} else if($user_nationality=='BZ'){

 $newVal ='Belize';

} else if($user_nationality=='BJ'){

 $newVal ='Benin';

} else if($user_nationality=='BM'){

 $newVal ='Bermuda';

} else if($user_nationality=='BT'){

 $newVal ='Bhutan';

} else if($user_nationality=='BO'){

 $newVal ='Bolivia, Plurinational State of';

} else if($user_nationality=='BQ'){

 $newVal ='Bonaire, Sint Eustatius and Saba';

} else if($user_nationality=='BA'){

 $newVal ='Bosnia and Herzegovina';

} else if($user_nationality=='BW'){

 $newVal ='Botswana';

} else if($user_nationality=='BV'){

 $newVal ='Bouvet Island';

} else if($user_nationality=='BR'){

 $newVal ='Brazil';

} else if($user_nationality=='IO'){

 $newVal ='British Indian Ocean Territory';

} else if($user_nationality=='BN'){

 $newVal ='Brunei Darussalam';

} else if($user_nationality=='BG'){

 $newVal ='Bulgaria';

} else if($user_nationality=='BF'){

 $newVal ='Burkina Faso';

} else if($user_nationality=='BI'){

 $newVal ='Burundi';

} else if($user_nationality=='KH'){

 $newVal ='Cambodia';

} else if($user_nationality=='CM'){

 $newVal ='Cameroon';

} else if($user_nationality=='CA'){

 $newVal ='Canada';

} else if($user_nationality=='CV'){

 $newVal ='Cape Verde';

} else if($user_nationality=='KY'){

 $newVal ='Cayman Islands';

} else if($user_nationality=='CF'){

 $newVal ='Central African Republic';

} else if($user_nationality=='TD'){

 $newVal ='Chad';

} else if($user_nationality=='CL'){

 $newVal ='Chile';

} else if($user_nationality=='CN'){

 $newVal ='China';

} else if($user_nationality=='CX'){

 $newVal ='Christmas Island';

} else if($user_nationality=='CC'){

 $newVal ='Cocos (Keeling) Islands';

} else if($user_nationality=='CO'){

 $newVal ='Colombia';

} else if($user_nationality=='KM'){

 $newVal ='Comoros';

} else if($user_nationality=='CG'){

 $newVal ='Congo';

} else if($user_nationality=='CD'){

 $newVal ='Congo, the Democratic Republic of the';

} else if($user_nationality=='CK'){

 $newVal ='Cook Islands';

} else if($user_nationality=='CR'){

 $newVal ='Costa Rica';

} else if($user_nationality=='CI'){

 $newVal ='Côte d Ivoire';

} else if($user_nationality=='HR'){

 $newVal ='Croatia';

} else if($user_nationality=='CU'){

 $newVal ='Cuba';

} else if($user_nationality=='CW'){

 $newVal ='Curaçao';

} else if($user_nationality=='CY'){

 $newVal ='Cyprus';

} else if($user_nationality=='CZ'){

 $newVal ='Czech Republic';

} else if($user_nationality=='DK'){

 $newVal ='Denmark';

} else if($user_nationality=='DJ'){

 $newVal ='Djibouti';

} else if($user_nationality=='DM'){

 $newVal ='Dominica';

} else if($user_nationality=='DO'){

 $newVal ='Dominican Republic';

} else if($user_nationality=='EC'){

 $newVal ='Ecuador';

} else if($user_nationality=='EG'){

 $newVal ='Egypt';

} else if($user_nationality=='SV'){

 $newVal ='El Salvador';

} else if($user_nationality=='GQ'){

 $newVal ='Equatorial Guinea';

} else if($user_nationality=='ER'){

 $newVal ='Eritrea';

} else if($user_nationality=='EE'){

 $newVal ='Estonia';

} else if($user_nationality=='ET'){

 $newVal ='Ethiopia';

} else if($user_nationality=='FK'){

 $newVal ='Falkland Islands (Malvinas)';

} else if($user_nationality=='FO'){

 $newVal ='Faroe Islands';

} else if($user_nationality=='FJ'){

 $newVal ='Fiji';

} else if($user_nationality=='FI'){

 $newVal ='Finland';

} else if($user_nationality=='FR'){

 $newVal ='France';

} else if($user_nationality=='GF'){

 $newVal ='French Guiana';

} else if($user_nationality=='PF'){

 $newVal ='French Polynesia';

} else if($user_nationality=='TF'){

 $newVal ='French Southern Territories';

} else if($user_nationality=='GA'){

 $newVal ='Gabon';

} else if($user_nationality=='GM'){

 $newVal ='Gambia';

} else if($user_nationality=='GE'){

 $newVal ='Georgia';

} else if($user_nationality=='DE'){

 $newVal ='Germany';

} else if($user_nationality=='GH'){

 $newVal ='Ghana';

} else if($user_nationality=='GI'){

 $newVal ='Gibraltar';

} else if($user_nationality=='GR'){

 $newVal ='Greece';

} else if($user_nationality=='GL'){

 $newVal ='Greenland';

} else if($user_nationality=='GD'){

 $newVal ='Grenada';

} else if($user_nationality=='GP'){

 $newVal ='Guadeloupe';

} else if($user_nationality=='GU'){

 $newVal ='Guam';

} else if($user_nationality=='GT'){

 $newVal ='Guatemala';

} else if($user_nationality=='GG'){

 $newVal ='Guernsey';

} else if($user_nationality=='GN'){

 $newVal ='Guinea';

} else if($user_nationality=='GW'){

 $newVal ='Guinea-Bissau';

} else if($user_nationality=='GY'){

 $newVal ='Guyana';

} else if($user_nationality=='HT'){

 $newVal ='Haiti';

} else if($user_nationality=='HM'){

 $newVal ='Heard Island and McDonald Islands';

} else if($user_nationality=='VA'){

 $newVal ='Holy See (Vatican City State)';

} else if($user_nationality=='HN'){

 $newVal ='Honduras';

} else if($user_nationality=='HK'){

 $newVal ='Hong Kong';

} else if($user_nationality=='HU'){

 $newVal ='Hungary';

} else if($user_nationality=='IS'){

 $newVal ='Iceland';

} else if($user_nationality=='IN'){

 $newVal ='India';

} else if($user_nationality=='ID'){

 $newVal ='Indonesia';

} else if($user_nationality=='IR'){

 $newVal ='Iran, Islamic Republic of';

} else if($user_nationality=='IQ'){

 $newVal ='Iraq';

} else if($user_nationality=='IE'){

 $newVal ='Ireland';

} else if($user_nationality=='IM'){

 $newVal ='Isle of Man';

} else if($user_nationality=='IL'){

 $newVal ='Israel';

} else if($user_nationality=='IT'){

 $newVal ='Italy';

} else if($user_nationality=='JM'){

 $newVal ='Jamaica';

} else if($user_nationality=='JP'){

 $newVal ='Japan';

} else if($user_nationality=='JE'){

 $newVal ='Jersey';

} else if($user_nationality=='JO'){

 $newVal ='Jordan';

} else if($user_nationality=='KZ'){

 $newVal ='Kazakhstan';

} else if($user_nationality=='KE'){

 $newVal ='Kenya';

} else if($user_nationality=='KI'){

 $newVal ='Kiribati';

} else if($user_nationality=='KP'){

 $newVal ='Korea, Democratic People s Republic of';

} else if($user_nationality=='KR'){

 $newVal ='Korea, Republic of';

} else if($user_nationality=='KW'){

 $newVal ='Kuwait';

} else if($user_nationality=='KG'){

 $newVal ='Kyrgyzstan';

} else if($user_nationality=='LA'){

 $newVal ='Lao People s Democratic Republic';

} else if($user_nationality=='LV'){

 $newVal ='Latvia';

} else if($user_nationality=='LB'){

 $newVal ='Lebanon';

} else if($user_nationality=='LS'){

 $newVal ='Lesotho';

} else if($user_nationality=='LR'){

 $newVal ='Liberia';

} else if($user_nationality=='LY'){

 $newVal ='Libya';

} else if($user_nationality=='LI'){

 $newVal ='Liechtenstein';

} else if($user_nationality=='LT'){

 $newVal ='Lithuania';

} else if($user_nationality=='LU'){

 $newVal ='Luxembourg';

} else if($user_nationality=='MO'){

 $newVal ='Macao';

} else if($user_nationality=='MK'){

 $newVal ='Macedonia, the former Yugoslav Republic of';

} else if($user_nationality=='MG'){

 $newVal ='Madagascar';

} else if($user_nationality=='MW'){

 $newVal ='Malawi';

} else if($user_nationality=='MY'){

 $newVal ='Malaysia';

} else if($user_nationality=='MV'){

 $newVal ='Maldives';

} else if($user_nationality=='ML'){

 $newVal ='Mali';

} else if($user_nationality=='MT'){

 $newVal ='Malta';

} else if($user_nationality=='MH'){

 $newVal ='Marshall Islands';

} else if($user_nationality=='MQ'){

 $newVal ='Martinique';

} else if($user_nationality=='MR'){

 $newVal ='Mauritania';

} else if($user_nationality=='MU'){

 $newVal ='Mauritius';

} else if($user_nationality=='YT'){

 $newVal ='Mayotte';

} else if($user_nationality=='MX'){

 $newVal ='Mexico';

} else if($user_nationality=='FM'){

 $newVal ='Micronesia, Federated States of';

} else if($user_nationality=='MD'){

 $newVal ='Moldova, Republic of';

} else if($user_nationality=='MC'){

 $newVal ='Monaco';

} else if($user_nationality=='MN'){

 $newVal ='Mongolia';

} else if($user_nationality=='ME'){

 $newVal ='Montenegro';

} else if($user_nationality=='MS'){

 $newVal ='Montserrat';

} else if($user_nationality=='MA'){

 $newVal ='Morocco';

} else if($user_nationality=='MZ'){

 $newVal ='Mozambique';

} else if($user_nationality=='MM'){

 $newVal ='Myanmar';

} else if($user_nationality=='NA'){

 $newVal ='Namibia';

} else if($user_nationality=='NR'){

 $newVal ='Nauru';

} else if($user_nationality=='NP'){

 $newVal ='Nepal';

} else if($user_nationality=='NL'){

 $newVal ='Netherlands';

} else if($user_nationality=='NC'){

 $newVal ='New Caledonia';

} else if($user_nationality=='NZ'){

 $newVal ='New Zealand';

} else if($user_nationality=='NI'){

 $newVal ='Nicaragua';

} else if($user_nationality=='NE'){

 $newVal ='Niger';

} else if($user_nationality=='NG'){

 $newVal ='Nigeria';

} else if($user_nationality=='NU'){

 $newVal ='Niue';

} else if($user_nationality=='NF'){

 $newVal ='Norfolk Island';

} else if($user_nationality=='MP'){

 $newVal ='Northern Mariana Islands';

} else if($user_nationality=='NO'){

 $newVal ='Norway';

} else if($user_nationality=='OM'){

 $newVal ='Oman';

} else if($user_nationality=='PK'){

 $newVal ='Pakistan';

} else if($user_nationality=='PW'){

 $newVal ='Palau';

} else if($user_nationality=='PS'){

 $newVal ='Palestinian Territory, Occupied';

} else if($user_nationality=='PA'){

 $newVal ='Panama';

} else if($user_nationality=='PG'){

 $newVal ='Papua New Guinea';

} else if($user_nationality=='PY'){

 $newVal ='Paraguay';

} else if($user_nationality=='PE'){

 $newVal ='Peru';

} else if($user_nationality=='PH'){

 $newVal ='Philippines';

} else if($user_nationality=='PN'){

 $newVal ='Pitcairn';

} else if($user_nationality=='PL'){

 $newVal ='Poland';

} else if($user_nationality=='PT'){

 $newVal ='Portugal';

} else if($user_nationality=='PR'){

 $newVal ='Puerto Rico';

} else if($user_nationality=='QA'){

 $newVal ='Qatar';

} else if($user_nationality=='RE'){

 $newVal ='Réunion';

} else if($user_nationality=='RO'){

 $newVal ='Romania';

} else if($user_nationality=='RU'){

 $newVal ='Russian Federation';

} else if($user_nationality=='RW'){

 $newVal ='Rwanda';

} else if($user_nationality=='BL'){

 $newVal ='Saint Barthélemy';

} else if($user_nationality=='SH'){

 $newVal ='Saint Helena, Ascension and Tristan da Cunha';

} else if($user_nationality=='KN'){

 $newVal ='Saint Kitts and Nevis';

} else if($user_nationality=='LC'){

 $newVal ='Saint Lucia';

} else if($user_nationality=='MF'){

 $newVal ='Saint Martin (French part)';

} else if($user_nationality=='PM'){

 $newVal ='Saint Pierre and Miquelon';

} else if($user_nationality=='VC'){

 $newVal ='Saint Vincent and the Grenadines';

} else if($user_nationality=='WS'){

 $newVal ='Samoa';

} else if($user_nationality=='SM'){

 $newVal ='San Marino';

} else if($user_nationality=='ST'){

 $newVal ='Sao Tome and Principe';

} else if($user_nationality=='SA'){

 $newVal ='Saudi Arabia';

} else if($user_nationality=='SN'){

 $newVal ='Senegal';

} else if($user_nationality=='RS'){

 $newVal ='Serbia';

} else if($user_nationality=='SC'){

 $newVal ='Seychelles';

} else if($user_nationality=='SL'){

 $newVal ='Sierra Leone';

} else if($user_nationality=='SG'){

 $newVal ='Singapore';

} else if($user_nationality=='SX'){

 $newVal ='Sint Maarten (Dutch part)';

} else if($user_nationality=='SK'){

 $newVal ='Slovakia';

} else if($user_nationality=='SI'){

 $newVal ='Slovenia';

} else if($user_nationality=='SB'){

 $newVal ='Solomon Islands';

} else if($user_nationality=='SO'){

 $newVal ='Somalia';

} else if($user_nationality=='ZA'){

 $newVal ='South Africa';

} else if($user_nationality=='GS'){

 $newVal ='South Georgia and the South Sandwich Islands';

} else if($user_nationality=='SS'){

 $newVal ='South Sudan';

} else if($user_nationality=='ES'){

 $newVal ='Spain';

} else if($user_nationality=='LK'){

 $newVal ='Sri Lanka';

} else if($user_nationality=='SD'){

 $newVal ='Sudan';

} else if($user_nationality=='SR'){

 $newVal ='Suriname';

} else if($user_nationality=='SJ'){

 $newVal ='Svalbard and Jan Mayen';

} else if($user_nationality=='SZ'){

 $newVal ='Swaziland';

} else if($user_nationality=='SE'){

 $newVal ='Sweden';

} else if($user_nationality=='CH'){

 $newVal ='Switzerland';

} else if($user_nationality=='SY'){

 $newVal ='Syrian Arab Republic';

} else if($user_nationality=='TW'){

 $newVal ='Taiwan, Province of China';

} else if($user_nationality=='TJ'){

 $newVal ='Tajikistan';

} else if($user_nationality=='TZ'){

 $newVal ='Tanzania, United Republic of';

} else if($user_nationality=='TH'){

 $newVal ='Thailand';

} else if($user_nationality=='TL'){

 $newVal ='Timor-Leste';

} else if($user_nationality=='TG'){

 $newVal ='Togo';

} else if($user_nationality=='TK'){

 $newVal ='Tokelau';

} else if($user_nationality=='TO'){

 $newVal ='Tonga';

} else if($user_nationality=='TT'){

 $newVal ='Trinidad and Tobago';

} else if($user_nationality=='TN'){

 $newVal ='Tunisia';

} else if($user_nationality=='TR'){

 $newVal ='Turkey';

} else if($user_nationality=='TM'){

 $newVal ='Turkmenistan';

} else if($user_nationality=='TC'){

 $newVal ='Turks and Caicos Islands';

} else if($user_nationality=='TV'){

 $newVal ='Tuvalu';

} else if($user_nationality=='UG'){

 $newVal ='Uganda';

} else if($user_nationality=='UA'){

 $newVal ='Ukraine';

} else if($user_nationality=='AE'){

 $newVal ='United Arab Emirates';

} else if($user_nationality=='GB'){

 $newVal ='United Kingdom';

} else if($user_nationality=='US'){

 $newVal ='United States';

} else if($user_nationality=='UM'){

 $newVal ='United States Minor Outlying Islands';

} else if($user_nationality=='UY'){

 $newVal ='Uruguay';

} else if($user_nationality=='UZ'){

 $newVal ='Uzbekistan';

} else if($user_nationality=='VU'){

 $newVal ='Vanuatu';

} else if($user_nationality=='VE'){

 $newVal ='Venezuela, Bolivarian Republic of';

} else if($user_nationality=='VN'){

 $newVal ='Viet Nam';

} else if($user_nationality=='VG'){

 $newVal ='Virgin Islands, British';

} else if($user_nationality=='VI'){

 $newVal ='Virgin Islands, U.S.';

} else if($user_nationality=='WF'){

 $newVal ='Wallis and Futuna';

} else if($user_nationality=='EH'){

 $newVal ='Western Sahara';

} else if($user_nationality=='YE'){

 $newVal ='Yemen';

} else if($user_nationality=='ZM'){

 $newVal ='Zambia';

} else if($user_nationality=='ZW'){

 $newVal ='Zimbabwe';

} else  {

 $newVal ='';

}


return $newVal;

}






function curl_del($path)
{
    $url = $path;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $result;
}


//eyJleHBpcnkiOjE1Nzg1NTE0MDAsImNhbGwiOlsicmVtb3ZlIl0sImhhbmRsZSI6InhRc1NneWZUYm1ua1BBQVZDN1BjIn0=

//https://www.filestackapi.com/api/file/jdfB21xESMOsaFKwkEfe?key=m2jdl8QRqLyQdzknG2QY&policy=eyJleHBpcnkiOjE1Nzg1NTE0MDAsImNhbGwiOlsicmVtb3ZlIl0sImhhbmRsZSI6ImpkZkIyMXhFU01Pc2FGS3drRWZlIn0=&signature=fecf716d332f1be87eaaab6d30cf6c9ffbd24a7f653b6a004ce23545052e2750


// curl_init("http://www.example.com/");
?>

