<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Designated.</title>

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <?php
session_start();
?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Designated.</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="addFriend.php">Add Friend</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#top-page">History</a>
                    </li>
                    <li class="page-scroll">
                        <a href="bitcoinform.html">Pay</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<div class="container">
<div id= id="all_cont_bit">
    <div id="move-down" style="margin-top: 120px;">
        <div id="bit_form">
        <h2 class="bit_titles"> Create New Event: </h2>
        <form name="riders" method=POST action=createEvent.php>
            <div class="form-group" id="test">
                <label for="date">Date of Event:</label>
                <input type="text" placeholder="Enter date for event" name="date" class="form-control" id="date">
            </div>
            <div class="form-group" id="test">
                <label for="destination">Destination:</label>
                <input type="text" placeholder="Address of event" name="destination" class="form-control" id="destination">
            </div>

           
            <div id="users">
                <label for="name">Friends Username:</label>
                <input type=text placeholder="Username" name="name" id="input" class="form-control">
                
                <input type='button' class="btn btn-default" value="Add" onclick='processWritein()'>
                
                <input type='button' class="btn btn-default" value="Create Event" onclick='finalize()'>
            </div>
        </div>
        </form>
</div>
</div>
</div>
</div>
<style>
    body {
        background-color: #50B7A5;
        color: white;
        height: 
    }
    .bit_titles {
            padding: 15px;
            text-align: center;
    }
    #bit_form {
        width: 50%;
        margin: auto;
    }
    .form-group {
        margin: auto;
    }
    #input, #destination, #date {
            margin-top: 4px;
            margin-bottom: 6px;
        }
</style>







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