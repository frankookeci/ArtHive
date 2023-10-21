<?php

if($_SERVER["REQUEST_METHOD"]==="POST")
{
    $mySQL=require __DIR__ . "/database.php";
    $sql=sprintf("SELECT * from user_data WHERE email='%s'",$mySQL->real_escape_string($_POST["email"]));


    $result =$mySQL->query($sql);
    $user = $result->fetch_assoc();


if($user){
  
    if(password_verify($_POST["password"], $user["password"])){
      session_start();
      session_regenerate_id();
      $_SESSION["user_id"] = $user["id"];


  header("location: ../buy/index.html");


   
      exit;
    
}
}
}
?>


