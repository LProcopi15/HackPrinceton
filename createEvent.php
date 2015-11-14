<html>

<body>
    <?php
session_start();
?>


        <form name="riders" method=POST action=createEvent.php>
            <div id="test">
                <p>Date of Event:</p>
                <input type=text placeholder="Enter date for event" name="date">
                <br></br>
                <p>Destination:</p>
                <input type=text placeholder="Address of event" name="destination">
                <br></br>
            </div>
            <div id="users">
                <p>Friend's Username:</p>
                <input type=text placeholder="Username" name="name" id=input>
                <br></br>
                <input type='button' value="Add" onclick='processWritein()'>
                <br></br>
                <input type='button' value="Create Event" onclick='finalize()'>
            </div>
        </form>








        <script>
            nameArray = [];
            dbReady = [];

            function processData() {

                var httpRequest;

                var name = arguments[0]; // get name of friend

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

                // Set data to submit to server, based on the type of the action
                var data;
                data = 'name=' + name;


                // I have used POST here because GET requests may be cached.  For more 
                // details about this problem, see:
                // http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
                // Note that for POST, the Content-Type must be set accordingly
                httpRequest.open('POST', 'checkFriend.php', true);
                httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                /*send the name of the friend to a showUser function which will check the user's name against the database and if it is true then the friend will be displayed underneath their car*/

                httpRequest.onreadystatechange = function () {
                    showUser(httpRequest, name);
                };
                httpRequest.send(data);
            }


            //function that happens on click but i'm not sure this is really needed as a separate function??

            function processWritein() {
                var name = document.riders.name.value;
                var date = document.riders.date.value;
                var destination = document.riders.destination.value;
                dbReady.push(date);
                dbReady.push(destination);
                nameArray.push(name);
                processData(name);
            }

            function showUser(httpRequest, name) {
                if (httpRequest.readyState == 4) {
                    if (httpRequest.status == 200) {
                        test = document.getElementById("test");
                        test.style.display = 'none';
                        var confirmed = httpRequest.responseText;
                    }
                }
            }

            function finalize() {

                var httpRequest2

                if (window.XMLHttpRequest) {
                    httpRequest2 = new XMLHttpRequest();
                    if (httpRequest2.overrideMimeType) {
                        httpRequest2.overrideMimeType('text/xml');
                    }
                } else if (window.ActiveXObject) {
                    try {
                        httpRequest2 = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            httpRequest2 = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {}
                    }
                }
                if (!httpRequest2) {
                    alert('Giving up :( Cannot create an XMLHTTP instance');
                    return false;
                }


                var pushThis;
                pushThis = 'names=' + this.nameArray + '&rest=' + this.dbReady;
                httpRequest2.open('POST', 'finalize.php', true);
                httpRequest2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                httpRequest2.send(pushThis);
                window.location = "/HackPrinceton/views/index.php";


            }
        </script>


</body>

</html>