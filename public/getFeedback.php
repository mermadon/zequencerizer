
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


$sql = "SELECT * FROM feedback";

if ($result = $conn -> query($sql)) {

    $response = array();
	
	while ($row = $result -> fetch_row()) {
			$response[] = $row;
	}

    // save the JSON encoded array
    $jsonData = json_encode($response);
    echo $jsonData;
	
    // Free result set
    $result -> free_result();
}else
{
    echo "WHY";
}
	




$conn->close();

?>