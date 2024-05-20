<?php

include '../../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if ($dbOk) {
  //select the user that is active
  $query = "SELECT userid FROM users WHERE isActive = 1";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $userID = intval($row['userid']);
  $result->free();

  //create an array
  $allMatchesArray = array();

  //select all the rows from allMatchesValues that are associated to the active user
  $query2 = "SELECT * FROM allMatchesValues WHERE userid = ?";
  $statement = $db->prepare($query2);
  $statement->bind_param("i", $userID);
  $statement->execute();
  $result2 = $statement->get_result();

  //if there is at least one row associated to this user
  if ($result2->num_rows > 0) {
    //add each matched mentor's imgUrl to the array
    while ($row2 = $result2->fetch_assoc()) {
      $mentorId = $row2['mentorid'];
      array_push($allMatchesArray, $mentorId);
    }
  }

  // Return the JSON version of the array
  header('Content-Type: application/json');
  echo json_encode($allMatchesArray);
}

$db->close();
?>
