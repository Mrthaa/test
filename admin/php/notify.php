<?php 
session_start();
require_once '../../php/db.php';
function add_notification($conn,$subjekt, $comment, $ID_user){

   $notify = "INSERT INTO notifications(subjekt, comment, ID_user) VALUES('{$subjekt}', '{$comment}',{$ID_user});";
   $result = mysqli_query($conn,$notify);
    
   }
  //add_notification($conn, 'Recenzent', 'byl přidána', $_SESSION['id_user']);


?>
