<?php

$month = str_pad(rand(01,12), 2, "0", STR_PAD_LEFT);
$year = mt_rand (2000, 2014);
$day = str_pad(rand(01,28), 2, "0", STR_PAD_LEFT);

$seconds = str_pad(rand(01,59), 2, "0", STR_PAD_LEFT);
$minutes = str_pad(rand(01,59), 2, "0", STR_PAD_LEFT);
$hours = str_pad(rand(01,23), 2, "0", STR_PAD_LEFT);


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

$make = $_POST['crypto'];

$audiourl = $_POST['audiourl'];

$caption = $_POST['textz'];


$tagz1 = $_POST['tag1'];

$tagz2 = $_POST['tag2'];

$tagz3 = $_POST['tag3'];

$tagz4 = $_POST['tag4'];

$tagz5 = $_POST['tag5'];


if (empty($make) && (empty($audiourl))) {
 header('Location: http://openconvos.org/error4');
die();
}


if (empty($audiourl)) {
$parameters = array();
$parameters['type'] = "audio";
$dez = file_get_contents($_POST['crypto']);
$parameters['data'] = $dez;

$parameters['caption'] = $caption;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;


}

elseif (!empty($audiourl)) {
$parameters = array();
$parameters['type'] = "audio";

$parameters['external_url'] = $audiourl;

$parameters['caption'] = $caption;

$parameters['tags'] = stripslashes($_POST['tag1'].",".$_POST['tag2'].",".$_POST['tag3'].",".$_POST['tag4'].",".$_POST['tag5']);

$parameters['date'] = $day."-".$month."-".$year." ".$hours.":".$minutes.":".$seconds;
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