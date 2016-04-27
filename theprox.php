<?php
/**
 * Created by PhpStorm.
 * User: Isaacs
 * Date: 26/04/2016
 * Time: 20:45
 */
$url = $_GET['url'];
$parameters ="";
foreach($_GET as $key => $value){
  if($key != "url") {
    $parameters = $parameters."&".$key."=".$value;
  }
}
$parameters = substr($parameters, 1);
$finalurl = $url."?".$parameters;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $finalurl);
$result = curl_exec($ch);
curl_close($ch);
echo $result;