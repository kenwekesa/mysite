<?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "Mysite";
 
  $conn = mysqli_connect($dbhost,$dbuser,$dbpass,"$db");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
      }
   
?>