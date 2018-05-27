<?php
require_once("connect.php"); 
 session_destroy();
 header('location: ../member/index.php');
?>