<style><?php include 'php.css'; ?></style>
<?php 
$username2 = $_POST['username2'];
$password2 = '';

$dbhost = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbname = "WT_Login_Page";
	
//create connection
$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	
if (!$conn) {
	die("Connection failed: " . $conn->connect_error);
}else{
	$select = "Select username,password from Login_Details where username = ? Limit 1";
		
	//Prepare statement
	$stmt = $conn->prepare($select);
	$stmt -> bind_param("s", $username2);
	$stmt -> execute();
	$stmt -> bind_result($username2,$password2);
	$result = $stmt -> get_result();
	$rnum = $result->num_rows;
		
	if($rnum==0){
?>
	<script>
		alert("User doesn't exist");
		window.history.back();
	</script>
<?php
	}
	else{
		echo '<h3 style="color:#483D8B;"> 
		Please Note...</h3>';
		while($row = $result->fetch_assoc()) {
			echo '<p style="color:#483D8B; font-size: 25px;"><br>Your username: '. $row["username"]. "<br>Your Password: ". $row["password"]."<br><p>";
		}
		echo '<h3 style="color:#483D8B; font-style:Candara"><a href="index.html">Try to Login now.</a><h3>';
	}
	$stmt->close();
	$conn->close();
}

?>