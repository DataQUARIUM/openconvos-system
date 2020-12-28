<?php

$month = str_pad(rand(01,12), 2, "0", STR_PAD_LEFT);
$year = mt_rand (2000, 2014);
$day = str_pad(rand(01,28), 2, "0", STR_PAD_LEFT);

$seconds = str_pad(rand(01,59), 2, "0", STR_PAD_LEFT);
$minutes = str_pad(rand(01,59), 2, "0", STR_PAD_LEFT);
$hours = str_pad(rand(01,23), 2, "0", STR_PAD_LEFT);


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Start a session, load the library
session_start();
require_once('oauth/tumblroauth.php');

// Define the needed keys
$consumer_key = "<CONSUMER_KEY>";
$consumer_secret = "<CONSUMER_SECRET>";
$oauth_token = '<OAUTH_TOKEN>';
$oauth_token_secret = '<OAUTH_SECRET>';
$base_hostname = 'openconvos.org';

//posting URI - http://www.tumblr.com/docs/en/api/v2#posting
$post_URI = 'http://api.tumblr.com/v2/blog/'.$base_hostname.'/post';
$tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

// Make an API call with the TumblrOAuth instance. For text Post, pass parameters of type, title, and body

$crypto = array('md2','md5','md4','whirlpool','sha1','sha256','sha512','ripemd160','crc32b','haval160,5','haval192,5','haval256,5','tiger192,4','sha384','tiger160,3','tiger128,3','tiger160,4');

$salt = generateRandomString();

$parag = nl2br($_POST['textz']);



$select = $_POST['selectedValue'];

$tagz1 = $_POST['tag1'];
$hash1 = hash($crypto[array_rand($crypto)],$_POST['tag1'].$salt);
$tagz2 = $_POST['tag2'];
$hash2 = hash($crypto[array_rand($crypto)],$_POST['tag2'].$salt);
$tagz3 = $_POST['tag3'];
$hash3 = hash($crypto[array_rand($crypto)],$_POST['tag3'].$salt);
$tagz4 = $_POST['tag4'];
$hash4 = hash($crypto[array_rand($crypto)],$_POST['tag4'].$salt);
$tagz5 = $_POST['tag5'];
$hash5 = hash($crypto[array_rand($crypto)],$_POST['tag5'].$salt);



$sz = $_POST['titlez'];

$titlezz = rtrim($sz,".");

if (empty($titlezz)) {
 header('Location: http://openconvos.org/error1');
die();
}



if (strlen($titlezz) > 100) {
   $titlezz = substr($titlezz, 0, 100) . '...';
   
 }  




if ((!empty($tagz5)) && (!empty($tagz4))) {
$trans = array($tagz1 => $hash1, $tagz2 => $hash2, $tagz3 => $hash3, $tagz4 => $hash4, $tagz5 => $hash5);
$plz = strtr($parag,$trans);
}
elseif ((empty($tagz5)) && (!empty($tagz4))) {
$trans = array($tagz1 => $hash1, $tagz2 => $hash2, $tagz3 => $hash3, $tagz4 => $hash4);
$plz = strtr($parag,$trans);
}
elseif ((empty($tagz4)) && (!empty($tagz3))) {
$trans = array($tagz1 => $hash1, $tagz2 => $hash2, $tagz3 => $hash3);
$plz = strtr($parag,$trans);
}
elseif ((empty($tagz3)) && (!empty($tagz2))) {
$trans = array($tagz1 => $hash1, $tagz2 => $hash2);
$plz = strtr($parag,$trans);
}
elseif ((empty($tagz2)) && (!empty($tagz1))) {
$trans = array($tagz1 => $hash1);
$plz = strtr($parag,$trans);
}
else {
$plz = $parag;
}





if (empty($parag)) {
 header('Location: http://openconvos.org/error2');
die();
}










$datez = $_POST['datez'];
$video = $_POST['pollvideo'];
$audio = $_POST['polltext'];
$vidtext = "<b>VIDEO:</b>"."&nbsp;<a href='$video'>$video</a>"."<BR><BR>";
$audiotext = "<b>AUDIO:</b>"."&nbsp;<a href='$audio'>$audio</a>"."<BR><BR>";
$datetext = "This conversation was made on <b>".$datez."</b><BR><BR>";


if ($select == 'Yes') {

if ((!empty($video)) && (!empty($audio))) {

 

$parameters = array();
$parameters['type'] = "text";
$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $audiotext.$vidtext.$plz;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;
 
}

elseif ((!empty($video)) && (empty($audio))) {
 

 
$parameters = array();
$parameters['type'] = "text";

$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $vidtext.$plz;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;

}
elseif ((empty($video)) && (!empty($audio))) {
 


$parameters = array();
$parameters['type'] = "text";

$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $audiotext.$plz;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;

}


else {
$parameters = array();
$parameters['type'] = "text";
$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $plz;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;
}

}





if ($select == 'No') {

if ((!empty($video)) && (!empty($audio))) {

 

$parameters = array();
$parameters['type'] = "text";
$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $audiotext.$vidtext.$parag;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;
 
}

elseif ((!empty($video)) && (empty($audio))) {
 

 
$parameters = array();
$parameters['type'] = "text";

$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $vidtext.$parag;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;

}
elseif ((empty($video)) && (!empty($audio))) {
 


$parameters = array();
$parameters['type'] = "text";

$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $audiotext.$parag;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;

}


else {
$parameters = array();
$parameters['type'] = "text";
$parameters['title'] = stripslashes($titlezz);

$parameters['body'] = $parag;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;
}

}




$post = $tum_oauth->post($post_URI,$parameters);


//var_dump($tum_oauth);
echo "<br><br>";
var_dump($post);

// Check for an error.
if (201 == $tum_oauth->http_code) {
  echo $post->meta->msg;

 $zero = $post->response->id;
  echo "<br>id:".$post->response->id;
header("Location:http://openconvos.org/post/$zero"); 
}
else
{
header("Location:http://openconvos.org/error3"); 
}

 			
  
?>