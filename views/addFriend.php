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
                        <a href="index.html">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#page-top">Friends</a>
                    </li>
                    <li class="page-scroll">
                        <a href="/index.html#discountmap">Discount Map</a>
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
