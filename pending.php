<html>

<body>
    <form name="friendRequests">
        <table id="theTable">
            <b>Current Friend Requests!</b><br></br>

            <?php
session_start();
$sessionID = $_SESSION["ID"];

	// Initialize the table from the database on the server

$db = mysqli_connect('localhost', 'root', 'password', 'test');
if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}


$checkPending = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = '$sessionID' and Status = 1");    
$rows = $checkPending->num_rows;

if($rows == 0){
echo "You have no pending requests at this time!";
}
    for ($ctr = 1; $ctr <= $rows; $ctr++){
        echo "<tr align = 'center'>";
        
        $row = mysqli_fetch_array($checkPending);
        $id = $row['Friend1'];
        $getName = mysqli_query($db,"SELECT * FROM Users WHERE ID = '$id'");
        $user = mysqli_fetch_array($getName);
        $name = $user['Name'];
        echo "<td>$name has requested to add you as a friend!</td>";
        ?>
                <div id="help">hi </div>
                <?php
        echo "<td><input type = 'submit' name = 'Accept' id = 'a'
                       value = 'Accept'
                       onclick = 'processRequest(2, $id)'></td>";
        echo "<td><input type = 'submit' name = 'Decline' id = 'd'
                       value = 'Decline'
                       onclick = 'processRequest(3, $id)'></td>";
        echo "</tr>";
  
    }
?>
        </table>
    </form>



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




            httpRequest.open('POST', 'updateFriendRequest.php', true);
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
                        window.location = "/HackPrinceton/landing-page/landing.html"
                        alert("?");

                    }
                    if (confirmed == "declined") {
                        help.innerHTML = "You have declined this request!";
                        window.location = "/HackPrinceton/landing-page/landing.html"
                    }
                }
            }
        }
    </script>









</body>

</html>