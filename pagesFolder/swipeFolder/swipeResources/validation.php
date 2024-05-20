<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if($dbOk){
  //checks if the mentorUrl was posted
  $mentorUrlBool = isset($_POST['imageUrl']) ? $_POST['imageUrl'] : null;
  //if it was posted
  if($mentorUrlBool != null){
    //select active user
    $query = "SELECT userid FROM users WHERE isActive = 1";
    $result = $db->query($query); 
    $row = $result->fetch_assoc();
    $userID = intval($row['userid']);
    $result->free();
    
    //insert a row with active user id, and mentor's imageUrl into allMatchesValues table
    $insQuery = "INSERT INTO allMatchesValues (userid, mentorImgUrl) values(?,?)";
    $statement = $db->prepare($insQuery);
    $mentorUrl = $_POST['imageUrl'];
    $statement->bind_param("is", $userID, $mentorUrl);
    $statement->execute();
    $statement->close();
  }
}

$db->close();
?>


