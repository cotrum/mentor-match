<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if($dbOk){
  //gets the data posted into this file
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];

  $query2 = "SELECT * FROM preferences";
  $result = $db->query($query2);
  $numRecords2 = $result->num_rows;
  //sets all users to inactive
  $updateQuery = "UPDATE users SET isActive=?";
  $statement = $db->prepare($updateQuery);
  $notActive = 0;
  $statement->bind_param("i", $notActive);
  $statement->execute();
  $statement->close();    
  $result->free();
  
  //creates a new user in the database, and sets it to active
  $insQuery = "insert into users (email, password, isActive) values(?,?,?)";
  $statement = $db->prepare($insQuery);
  $setActive = 1;
  $statement->bind_param("ssi",$email,$pwd,$setActive);
  $statement->execute();
  $statement->close();

  //sets the user's preferences to all initially be none
  $insQuery2 = "insert into preferences (day, night, online, inperson, math, english) values(?,?,?,?,?,?)";
  $statement2 = $db->prepare($insQuery2);
  $dayVal = 0;
  $nightVal = 0;
  $onlineVal = 0;
  $inpersonVal = 0;
  $mathVal = 0;
  $englishVal = 0;

  $statement2->bind_param("iiiiii", $dayVal, $nightVal, $onlineVal, $inpersonVal, $mathVal, $englishVal);
  $statement2->execute();
  $statement2->close();
  
}

$db->close();
?>