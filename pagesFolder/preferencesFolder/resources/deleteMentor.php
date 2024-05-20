<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if ($dbOk) {
  //get the userid from the user that is active
  $query = "SELECT userid FROM users WHERE isActive = 1";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $userId = intval($row['userid']);
  $result->free();

  //checks that the mentor associated to this mentorId has been selected to be deleted
  if (isset($_POST['mentorId'])) {
     //deletes the row associated to this mentorId, from the specified userid's matches list.
    //This means that the user(mentee) is no longer associated to the mentor
    $query = "DELETE FROM allMatchesValues WHERE userid = ? AND mentorImgUrl = ?";
    $statement = $db->prepare($query);
    $userId = intval($userId);
    $img = $_POST['mentorId'];
    $statement->bind_param("is", $userId, $img); 
    $statement->execute();
    
    $statement->close();
  }
}


$db->close();
?>
