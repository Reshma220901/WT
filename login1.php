<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login and Registration Form</title>
      <link rel="stylesheet" href="login.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
</html>
<?php
$username1 = $_POST['username1'];
$password1 = $_POST['password1'];

$dbhost = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbname = "WT_Login_Page";
	
//create connection
$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	
if (!$conn) {
	die("Connection failed: " . $conn->connect_error);
}else{
	$select = "Select username, password from Login_Details where username = ? and password=? Limit 1";
		
	//Prepare statement
	$stmt = $conn->prepare($select);
	$stmt -> bind_param("ss", $username1,$password1);
	$stmt -> execute();
	$stmt -> bind_result($username1,$password1);
	$stmt -> store_result();
	$rnum = $stmt->num_rows;
		
	if($rnum==0){
?>
	<script>
		alert("User doesn't exist.\nCheck your userId and password");
		window.history.back();
	</script>
<?php
	}
	else{
?>
	<script>
		alert("Logged in Successfully");
		window.location.href = 'wtnotes.html';
	</script>
<?php
	}
	$stmt->close();
	$conn->close();
}
?>