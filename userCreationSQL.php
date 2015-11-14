<?php


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "test");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$testdatabase = mysql_select_db("test");

//Create new database named test
//$db = mysqli_connect('localhost', 'root', 'hello', 'test');
//$testdatabase = mysql_select_db("test");

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

//$db = mysqli_connect('localhost', 'root', 'password', 'test');

//if($_POST[''])
if ($_POST['facebook_name'] != null) {
	echo "hi";
	$name = $_POST['facebook_name'];
	$email = $_POST['facebook_email'];
	$username =  $_POST['facebook_username'];
	$password = 'password';
	$picture = $_POST['facebook_picture'];

	$query = "INSERT INTO Users(`Name`, `Username`, `Email`, `Password`, `imgdata`) VALUES('$name', '$username', '$email', '$password', '$picture')";

	$db->query($query) or die ("Invalid insert " .$db->error);
    header("Location: landing-page/login.html");

	echo 'Facebook Sign In';

}
else{
	if ($_POST['password1']==$_POST['password2']) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password1'];
		$picture = "https://www.teachforamerica.org/sites/default/files/styles/large/public/thumbnails/image/headshot.png?itok=EW2-dSgB";


		$query = "INSERT INTO Users(`Name`, `Username`, `Email`, `Password`, `imgdata`) VALUES('$name', '$username', '$email', '$password', '$picture')";

		$db->query($query) or die ("Invalid insert " .$db->error);
     header("Location: landing-page/login.html");
	}
	else {
		echo "Passwords do not match. Please go back to login";
	}
	echo 'Regular Sign in';
}

?>
