<?php
 $db_host = '127.0.0.1';
 $db_name = 'Betaing';
 $db_user = 'juankn';
 $db_pass = 'SionDevelopers111';
 
 try{
  
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>