<html>

<body>
    <?php
session_start();
?>

        <div id="test">
            <form name="riders" method=POST action=createEvent.php>
                <p>Date of Event:</p>
                <input type=text placeholder="Enter date for event" name="date">
                <br></br>

                <p>Friend's name:</p>
                <input type="text" name="name" value="">
                <br></br>
                <input type='button' value="Add" onclick='processWritein()'>
            </form>
        </div>


        <script>
            function processData() {

                var httpRequest;

                var name = arguments[0]; // get type of call

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
                processData(name);


            }

            function showUser(httpRequest, name) {
                if (httpRequest.readyState == 4) {
                    if (httpRequest.status == 200) {
                        test = document.getElementById("test");
                        var confirmed = httpRequest.responseText;
                        test.innerHTML += confirmed;
                    }
                }
            }
        </script>


</body>

</html>