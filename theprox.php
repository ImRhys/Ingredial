<?php
$url = $_GET['url'];
$parameters = "";
foreach($_GET as $key => $value){
  if($key != "url") {
    $parameters = $parameters . "&" . $key . "=" . $value;
  }
}
$parameters = substr($parameters, 1);
$finalurl = $url . "?" . $parameters;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $finalurl);
$result = curl_exec($ch);
curl_close($ch);
header('Content-Type: application/json');
echo $result;