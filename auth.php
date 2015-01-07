<?php

if (!isset($_SERVER["HTTP_AUTH_USER"] ) || !isset($_SERVER["HTTP_AUTH_PASS"] )){
  fail();
}

$username=$_SERVER["HTTP_AUTH_USER"] ;
$userpass=$_SERVER["HTTP_AUTH_PASS"] ;
$protocol=$_SERVER["HTTP_AUTH_PROTOCOL"] ;

// Return localhost port 992 for IMAP, deny other protocols
if ($protocol=="imap") {
  $server_ip="127.0.0.1";
  $backend_port=992;
} else {
  fail();
}

// Authenticate the user or fail
if (!authuser($username,$userpass)){
  fail();
  exit;
}

pass($server_ip, $backend_port, $username, $userpass);
 
//END
 
 
function authuser($user,$pass){
  // As for now we directly pass credentials to backend server
  return true;
}
 
function fail(){
  header("Auth-Status: Invalid login or password");
  exit;
}
 
function pass($server,$port,$user,$pass){
  header("Auth-Status: OK");
  header("Auth-Server: $server");
  header("Auth-Port: $port");
  header("Auth-User: $user");
  header("Auth-Pass: $pass");
  exit;
}

?>
