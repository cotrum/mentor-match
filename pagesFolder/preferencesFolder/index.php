<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/style.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="resources/functionality.js"></script>
    <title>User Page</title>
</head>
<body>

  <div class="sidebarBackground"></div> 
  <img id="headerLogo" src="resources/mentorMatchImg.png" alt="logo">
  <!-- neccessary for colored background of sidebar -->
  <div class="signOut">
    <ul>
      <li><a href="../../index.html">Sign Out</a></li>
    </ul>
  </div>
  <div class="sidebar">
    <ul>
      <li><a id="findMatch">&#x1F90D; Find Your Match!</a></li>
      <li><a href="#preferences">&#9998; Preferences</a></li>
      <li><a href="#matches">&#128214; Matches</a></li>
    </ul>
    <div class="content">
      <div class="borderContent" id="preferences">
        <div class="preferencesList">
          <h1>PREFERENCES</h1>
          <?php
          
          include '../../resources/databases/sqlLoginInfo.php';
          $dbOk = true;

          //if can access database
          if($dbOk){
            //select the active user
            $query = "SELECT userid FROM users WHERE isActive = 1";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $userID = intval($row['userid']);
            $result->free();

            //get all the selected preferences of the user
            $query2 = "SELECT * FROM preferences WHERE userid = ?";
            $statement = $db->prepare($query2);
            $statement->bind_param('i', $userID);
            $statement->execute();
            $result2 = $statement->get_result();
            
            //go through each selected preference and print them out in a paragraph tag
           while($record = $result2->fetch_assoc()) {
            if($record['day'] == 1){
              echo '<p>Day Classes</p>';
            }
            if($record['night'] == 1){
              echo '<p>Night Classes</p>';
            }
            if($record['online'] == 1){
              echo '<p>Online </p>';
            }
            if($record['inperson'] == 1){
              echo '<p>In Person</p>';
            }
            if($record['math'] == 1){
              echo '<p>Math</p>';
            }
            if($record['english'] == 1){
              echo '<p>English</p>';
            }
            if($record['history'] == 1){
              echo '<p>History</p>';
            }
            if($record['computerScience'] == 1){
              echo '<p>Computer Science</p>';
            }
            if($record['science'] == 1){
              echo '<p>Science</p>';
            }
          }
          $result2->free();
        }
        $db->close();
        ?>
        </div>
        <div id="centerContent">
          <h1><i>Choose Your Preferences!</i></h1>
        </div>
        <div class="checkboxGroup">

          <form action="setPreferences.php" method="POST">
          <h2 class="checkboxTitles">Day/Night</h2>
            <label class="container">Day Time
              <input type="checkbox" name="DayTime" value="DayTime">
              <span class="checkmark"></span>
            </label>
            <label class="container">Night Time
              <input type="checkbox" name="NightTime" value="NightTime">
              <span class="checkmark"></span>
            </label>

            <h2 class="checkboxTitles">Virtual/In Person</h2>
            <label class="container">Online
              <input type="checkbox" name="Online" value="Online">
              <span class="checkmark"></span>
            </label>
            <label class="container">In Person
              <input type="checkbox" name="InPerson" value="InPerson">
              <span class="checkmark"></span>
            </label>

            <h2 class="checkboxTitles">Subject</h2>
            <label class="container">Math
              <input type="checkbox" name="Math" value="Math">
              <span class="checkmark"></span>
            </label>
            <label class="container">English
              <input type="checkbox" name="English" value="English">
              <span class="checkmark"></span>
            </label>
            <label class="container">Computer Science
              <input type="checkbox" name="ComputerScience" value="ComputerScience">
              <span class="checkmark"></span>
            </label>
            <label class="container">History
              <input type="checkbox" name="History" value="History">
              <span class="checkmark"></span>
            </label>
            <label class="container">Science
              <input type="checkbox" name="Science" value="Science">
              <span class="checkmark"></span>
            </label>

            <button type="submit" name="saveCheckbox" class="setPreferences">Continue</button>
          </form>
        </div>
      </div>
      <div class="borderContent" id="matches">
        <div id="centerContent">
          <h1>Matches</h1>
          
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

            //create an array
            $allMatchesArray = array();

            //select all the tutors that have matched with the current active user
            $query2 = "SELECT * FROM allMatchesValues WHERE userid = ?";
            $statement = $db->prepare($query2);
            $statement->bind_param("i", $userID);
            $statement->execute();
            $result2 = $statement->get_result();

            //if there is at least one match
            if ($result2->num_rows > 0) {
              //push the matches to an array
              while ($row2 = $result2->fetch_assoc()) {
                $mentorImgUrl = $row2['mentorImgUrl'];
                array_push($allMatchesArray, $mentorImgUrl);
              }
              //print out each mentor. An odd i value means that the mentor will be printed out 
              //with the format from the class "oddFormat". An even i value means that the mentor
              //will be printed out with the format from the class "evenFormat".
              $i = 0;
              foreach ($allMatchesArray as $mentorImgUrl) {
                if($i%2 == 0){
                  echo '<div class="evenFormat"> '. '<img class="mentorImgs" src="../swipeFolder/' . $mentorImgUrl .  '" alt="mentorImg">' . 
                       '<img src="resources/deleteImg.png"' . 'id="' . $mentorImgUrl .'" class="deleteMentorButton" alt="delete mentor"/>' .
                       '<div class="messageFormat"><p>Hi how can I help you!</p></div>'  . '</div>';
                }else{
                  echo '<div class="oddFormat"> '. '<img class="mentorImgs" src="../swipeFolder/' . $mentorImgUrl .  '" alt="mentorImg">' . 
                       '<img src="resources/deleteImg.png"' . 'id="' . $mentorImgUrl .'" class="deleteMentorButton" alt="delete mentor"/>' .
                       '<div class="messageFormat"><p>Hi how can I help you!</p></div>'  . '</div>';
                }
                $i++;
              }
              //if no matches found
            }else{
              echo "<p>No Matches Found</p>";
            }
            $db->close();
          }
          ?>

        </div>
      </div>
    </div>
  </div>
  
</body>
</html>
