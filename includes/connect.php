<?php
require_once("constants.php");

//CONNECTING TO THE DB WITH MYSQLi
  $conn = mysqli_connect($db_Server, $db_User, $db_Pass, $db_Name);

//CHECKING FOR CONNECTION
  if (!$conn) {
   die('Connection failed: '. mysqli_connect_error());
  }
  
//START SESSION
  session_start();
?>