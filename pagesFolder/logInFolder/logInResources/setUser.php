<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if($dbOk){
  //gets email and password that was posted to this file
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];

  //sets all users to inactive
  $updateQuery = "UPDATE users SET isActive = 0";
  $statement = $db->prepare($updateQuery);
  $statement->execute();
  $statement->close();

  //gets user associated to this specific email and password
  $q = "SELECT * FROM users WHERE email=? AND password=?";
  $stmt = $db->prepare($q);
  $stmt->bind_param("ss", $email, $pwd);
  $stmt->execute();
  $result = $stmt->get_result();

  //if user found, set it to active
  if($result->num_rows > 0){
    $query = "UPDATE users SET isActive=1 WHERE email=? AND password=?";
    $statement2 = $db->prepare($query);
    $statement2->bind_param("ss", $email, $pwd);
    $statement2->execute();
    $statement2->close();  
  }
  $db->close();
}
?>