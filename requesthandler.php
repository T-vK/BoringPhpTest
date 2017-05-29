<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toDoDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(!empty($_POST['toDoStatus'])){
	$status = $_POST['toDoStatus'];
	$title = $_POST['toDoTitle'];
	if(strcmp($status, 'setEntry') == 0) {
		$statusType = 'open';
		$sql = "INSERT INTO toDoItems (Title, ToDoStatus) VALUES ('" . $title . "', '" . $statusType . "')";
		if ($conn->query($sql) === TRUE) {
			//echo "New To do item";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = "SELECT * FROM todoitems ORDER BY ID DESC LIMIT 1";
		$updatedResult = $conn->query($sql);

		if ($updatedResult->num_rows > 0) {
      $allToDos = array();
			while($row = $updatedResult->fetch_assoc()) {
				$latestEntryId = $row["ID"];
				$latestEntryTitle = $row["Title"];
				$latestEntryStatus = $row["ToDoStatus"];
				$allToDos[] = array('entryId' => $latestEntryId, 'entryTitle' => $latestEntryTitle, 'entryStatus' => $latestEntryStatus);
			}
      echo json_encode($allToDos);
		} else {
			echo "0 results";
		}
	} elseif(strcmp($status, 'finishEntry') == 0){
    $statusType = 'finished';


		$sql = "";

		if ($conn->query($sql) === TRUE) {
			echo "Updated item successfully!";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} elseif(strcmp($status, 'loadEntrys') == 0){
		$sql = "SELECT * FROM todoitems ORDER BY ID DESC";
		$updatedResult = $conn->query($sql);
		if ($updatedResult->num_rows > 0) {
      $allToDos = array();
			while($row = $updatedResult->fetch_assoc()) {
				$latestEntryId = $row["ID"];
				$latestEntryTitle = $row["Title"];
				$latestEntryStatus = $row["ToDoStatus"];
        $allToDos[] = array('entryId' => $latestEntryId, 'entryTitle' => $latestEntryTitle, 'entryStatus' => $latestEntryStatus);
			}
      echo json_encode($allToDos);
		} else {
			echo "0 results";
		}
	}

}
$conn->close();

?>
