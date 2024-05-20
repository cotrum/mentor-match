<?php
include '../../resources/databases/sqlLoginInfo.php';
$dbOk = true;

//if can access database
if($dbOk){
  //select active user
  $query = "SELECT userid FROM users WHERE isActive = 1";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $userID = intval($row['userid']);
  $result->free();

  //set a query to update preferences
  $updateQuery = "UPDATE preferences SET day = ?, night = ?, online = ?, inperson = ?, 
                  math = ?, english = ?, history = ?, computerScience = ?, science = ? WHERE userid = ?";

//ternary to determine whether or not the value was set to true or false. True means selected
  //preference, and false means the preferance was not selected. 
  $dayTimeForDb = isset($_POST["DayTime"]) ? 1 : 0;
  $nightTimeForDb = isset($_POST["NightTime"]) ? 1 : 0;
  $onelineForDb = isset($_POST["Online"]) ? 1 : 0;
  $inPersonForDb = isset($_POST["InPerson"]) ? 1 : 0;
  $mathForDb = isset($_POST["Math"]) ? 1 : 0;
  $englishForDb = isset($_POST["English"]) ? 1 : 0;
  $historyForDb = isset($_POST["History"]) ? 1 : 0;
  $computerScienceForDb = isset($_POST["ComputerScience"]) ? 1 : 0;
  $scienceForDb = isset($_POST["Science"]) ? 1 : 0;

  //updates preferences for specified user
  $statement = $db->prepare($updateQuery);
  $statement->bind_param("iiiiiiiiii", $dayTimeForDb, $nightTimeForDb, $onelineForDb, $inPersonForDb, $mathForDb, $englishForDb, $historyForDb, $computerScienceForDb, $scienceForDb, $userID);
  $statement->execute();
  $statement->close();
  $db->close();
}

//sends user back to index.php
header("Location: index.php");

?>