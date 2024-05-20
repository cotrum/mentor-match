<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if($dbOk){
  //select active user
  $q = "SELECT * FROM users WHERE isActive=1";
  $stmt = $db->prepare($q);
  $stmt->execute();
  $result = $stmt->get_result();

  //if there is an active user
  if($result->num_rows > 0){
    header("Location: ../../preferencesFolder/index.php");
  //if there is no active user, send an alert
  }else{
    session_start();
    $_SESSION['alert'] = 'Invalid email or password!';
    $stmt->close();
    $db->close();
    header("Location: ../index.php");
  }
}
?>