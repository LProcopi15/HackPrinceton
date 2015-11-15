<head>
  <title>Add Friends.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom buttons -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
<nav>FUCK NAV BARS</nav>
<div class='container' style="margin-top: 120px;">
	<div id="friend_form">
		<h2 id="friend_title">Add a friend:</h2>
			<form role="form" action="../friendRequest.php" method="POST">
	    		<div class="form-group">
	    			<input type="text" class="form-control" placeholder="Enter Friend's Username" name="friendUsername" id="friendUsername">
	    		</div>
	        	<input type="submit" class="btn btn-default" name="submit" id="friend_submit">
			</form>
	</div>
</div>
<!--information on requests-->
 <form name="friendRequests">
        <div class="container">
        <table  class="table"   id="theTable">
            <h2 id="friend_title">Current Friend Requests:</h2><br></br>

<?php
session_start();
$sessionID = $_SESSION["ID"];

// Initialize the table from the database on the server

//$db = mysqli_connect('localhost', 'root', 'password', 'test');
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "test");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$testdatabase = mysql_select_db("test");

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}


$checkPending = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = '$sessionID' and Status = 1");    
$rows = $checkPending->num_rows;

if($rows == 0){
echo "<h3> You have no pending requests at this time! </h3>";
}
    for ($ctr = 1; $ctr <= $rows; $ctr++){
        echo '<tbody>';
        echo "<tr>";
        
        $row = mysqli_fetch_array($checkPending);
        $id = $row['Friend1'];
        $getName = mysqli_query($db,"SELECT * FROM Users WHERE ID = '$id'");
        $user = mysqli_fetch_array($getName);
        $name = $user['Name'];
        //not displaying name for Leah
        echo "<td>$name has requested to add you as a friend!</td>";
        ?>
                <?php
        echo "<td><input type='submit' name='Accept' id='a'
                       value='Accept'
                       onclick='processRequest(2, $id)' class='btn btn-default' style='color:black;'></td>";
        echo "<td><input type='submit' name='Decline' id='d'
                       value='Decline'
                       onclick='processRequest(3, $id)' class='btn btn-default' style='color:black;'></td>";
        echo "</tr>";
        echo '</tbody>';
    }
?>
</table>
</div>
</form>   

</body>
<style>
	body {
		background-color: #50B7A5;
		color: white;
		height: 
	}
	#friend_title {
		text-align: center;
		padding: 20px;
	}
	.form-group {
		margin: auto;
	}
	#friendUsername, #friend_submit {
			margin-top: 4px;
			margin-bottom: 6px;
	}
	#friend_form {
		width: 50%;
		margin: auto;
	}
</style>
<script>
        function processRequest() {

            var httpRequest;

            var type = arguments[0]; // get whether accepted or denied
            var id = arguments[1];

            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                //alert('XMLHttpRequest');
                httpRequest = new XMLHttpRequest();
                if (httpRequest.overrideMimeType) {
                    httpRequest.overrideMimeType('text/xml');
                }
            } else if (window.ActiveXObject) { // Older versions of IE
                //alert('IE -- XMLHTTP');
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {}
                }
            }
            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }

            // update the sql table to whether it is accept or decline 
            var data;
            data = 'type=' + type + '&id=' + id;




            httpRequest.open('POST', '../updateFriendRequest.php', true);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            /*send the name of the friend to a showTable function that will reprint the info but will say accepted or will be invisible if the user declines? maybe...we'll see */
            httpRequest.onreadystatechange = function () {
                showTable(httpRequest);
            };
            httpRequest.send(data);
        }


        //function that happens on click but i'm not sure this is really needed as a separate function??



        function showTable(httpRequest) {

            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    var confirmed = httpRequest.responseText;
                    help = document.getElementById("help");
                    if (confirmed == "accepted") {
                        window.location = "index.php"
                    

                    }
                    if (confirmed == "declined") {
                        help.innerHTML = "You have declined this request!";
                        window.location = "index.php"
                    }
                }
            }
        }
    </script>



