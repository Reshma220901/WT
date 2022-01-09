<?php
$username = $_POST['username'];
$password = $_POST['password'];

if ( !empty($username) || !empty($password))
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpwd = "";
	$dbname = "WT_Login_Page";
	
	//create connection
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$select = "Select username from Login_Details where username = ? Limit 1";
		$insert = "Insert into Login_Details (username, password) values (?,?)";
		
		//Prepare statement
		$stmt = $conn->prepare($select);
		$stmt -> bind_param("s", $username);
		$stmt -> execute();
		$stmt -> bind_result($username);
		$stmt -> store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum==0){
			$stmt->close();
			$stmt=$conn ->prepare($insert);
			$stmt ->bind_param("ss",$username, $password);
			$stmt -> execute();
?>
	<script>
		alert("Signed in Successfully");
		window.history.back();
	</script>
<?php
		}
		else{
?>
	<script>
		alert("User already exists");
		window.history.back();
	</script>
<?php
		}
		$stmt->close();
		$conn->close();
	}
}else {
		echo "All fields are required";
		die();
}
?>