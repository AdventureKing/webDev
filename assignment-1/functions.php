<?php

function destorySession(){
  $_SESSION = array();


  if(session_id != "" || isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-259200,'/');
  }
  session_destroy();
  header("Location: register.html");
}


 ?>
