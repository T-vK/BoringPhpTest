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
		$statusID = '1';
		$sql = "INSERT INTO toDoItems (Title, ToDoStatus) VALUES ('" . $title . "', '" . $statusID . "')";
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
	} elseif(strcmp($status, 'toggleEntryStatus') == 0){
    $toDoID = $_POST['toDoID'];
    if($toDoID){
      $getCurrentStatus = "SELECT ToDoStatus FROM todoitems WHERE ID = " . $toDoID . ";";
      $result = $conn->query($getCurrentStatus);
      $row = $result->fetch_assoc();
      //Open Status = 1
      //Closed Status = 2
      if(strcmp($row["ToDoStatus"], '1') == 0){
        $statusID = '2';

      } else if(strcmp($row["ToDoStatus"], '2') == 0){
        $statusID = '1';
      }

      $updateSql = "UPDATE todoitems SET ToDoStatus = " . $statusID . " WHERE ID = " . $toDoID . ";";
      $updatedResult = $conn->query($updateSql);
      $row = $updatedResult->fetch_assoc();
      $allToDos[] = array('entryId' => $row["ID"], 'entryTitle' => $row["Title"], 'entryStatus' => $row["ToDoStatus"]);
      echo json_encode($allToDos);

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
