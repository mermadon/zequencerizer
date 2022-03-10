
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function debug_to_console($data) {
	$output = $data;
	if (is_array($output))
		$output = implode(',', $output);

	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$servername = "mysql.carverkoella.com";
$username = "urlgrey";
$password = "dragondoomrainbow";
$dbname = "howzdies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST["feedback"]))
{
	$feedback  = $_POST["feedback"];
	$name = $_POST["userName"];
	$passage = $_POST["passage"];
	
	$sqlCheck = "";
	
	if ($result = $conn -> query("SELECT userFeedback FROM feedback WHERE (name = '$name' AND passage = '$passage')")) {
		
		while ($row = $result -> fetch_row()) {
			$sqlCheck = $row[0];
		  }
		// Free result set
		$result -> free_result();
	}else
	{
		echo "WHY";
	}

	if($sqlCheck == "")	{
		
		$sql = "INSERT INTO feedback (name, passage, userFeedback)
		VALUES ('$name', '$passage', '$feedback')";
		if ($conn->query($sql) === TRUE) {
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}else {
		$sql = "UPDATE feedback
		SET userFeedback = '$feedback'
		WHERE (name = '$name' AND passage = '$passage')";
		
		if ($conn->query($sql) === TRUE) {
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	$result = "ok great";
	
}
else if (!empty($_GET["userName"]))
{
	$userName = $_GET["userName"];
	$passage = $_GET["passage"];
	
	$sql = "SELECT * FROM feedback";
	
	
	if ($result = $conn -> query("SELECT userFeedback FROM feedback WHERE (name = '$userName' AND passage = '$passage')")) {
		
		while ($row = $result -> fetch_row()) {
			echo $row[0];
		  }
		// Free result set
		$result -> free_result();
	}else
	{
		echo "WHY";
	}
	
}



$conn->close();

?>