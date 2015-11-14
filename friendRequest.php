<?php
session_start();

$friend = $_POST['friendUsername'];

//CURRENTPROFILE IS THE SESSION VARIABLE!!!
$currentProfile = $_SESSION["Username"];

$db = mysqli_connect('localhost', 'root', 'password', 'test');
if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

$friendsInfo = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$friend'");    
$matchID = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$currentProfile'");    
$getID = mysqli_fetch_array($matchID);
$IDone = $getID['ID'];

if(!$friendsInfo) {
	die("you suck: " . mysql_error());
}

 if($row = mysqli_fetch_array($friendsInfo)){
    $uniqueID = $row['ID'];
    $userEmail = $row['Email'];
    $exists = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend1 = '$IDone' and Friend2 = '$uniqueID'"); 
    $backwards = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = '$IDone' and Friend1 = '$uniqueID'"); 
     $equal = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = '$IDone' and Friend1 = '$IDone'"); 
     $equalbackwards = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = '$uniqueID' and Friend1 = '$uniqueID'");
     //can't add yourself, can't re request
     if($fetch = mysqli_fetch_array($exists)){
         header("Location: /HackPrinceton/addFriend.php");
     }
     if($fetch = mysqli_fetch_array($backwards)){
         header("Location: /HackPrinceton/addFriend.php");
     }
     if($fetch = mysqli_fetch_array($equalbackwards)){
         header("Location: /HackPrinceton/addFriend.php");
     }
     if($fetch = mysqli_fetch_array($equal)){
         header("Location: /HackPrinceton/addFriend.php");
     }
     
     else{
    $query = "insert into Relationship values ($IDone, $uniqueID, 1)"; 
   	$db->query($query) or die ("Invalid insert " . $db->error); 
     }
     header("Location: addFriend.php");
 ?>

    <!--   <form action = mailFriend.php method = "POST">
         <p>Add <?php echo $friend ?> ? </p>
         <input type = hidden name = "requesterUsername" value = <?php echo $currentProfile ?>>
         <input type = hidden name = "requesteeEmail" value = <?php echo $userEmail ?>>
         <input type = hidden name = "requesteeUsername" value = <?php echo $friend ?>>
         <input type = submit name = submit >
    </form>-->


    <?php
     //$_SESSION["friendMessage"]= "User added!";
     
        }

/*else{
    $_SESSION["friendMessage"] = "This person does not exist!";
   header("Location: addFriend.php");
}*/

 


?>