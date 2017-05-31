<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toDoDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$method = $_SERVER['REQUEST_METHOD'];   
if ($method === 'GET') {
    $getAllQuery = 'SELECT toDoItems.ID, toDoItems.Title, toDoStatus.Title AS Status FROM toDoItems, toDoStatus WHERE toDoStatus.ID = toDoItems.ToDoStatus ORDER BY toDoItems.ID;';
    $result = $conn->query($getAllQuery);
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    header('Content-type: application/json');
    echo json_encode($rows);
} else if ($method === 'POST') {
    $title = $_POST['Title'];
    $createNewQuery = "INSERT INTO toDoItems (Title,ToDoStatus) VALUES ('$title',1);";
    $conn->query($createNewQuery);
} else if ($method === 'PUT') {
    parse_str(file_get_contents("php://input"),$_PUT); 
    $id = $_PUT['ID'];
    $currentStatusQuery = "SELECT ToDoStatus FROM toDoItems WHERE ID = $id;";
    $result = $conn->query($currentStatusQuery);
    $row = $result->fetch_assoc();
    $status = $row['ToDoStatus'];
    $newStatus = "1";
    if ($status === "1") {
        $newStatus = "2";
    }
    echo $newStatus;
    $updateQuery = "UPDATE toDoItems SET ToDoStatus=$newStatus WHERE ID = $id;";
    $conn->query($updateQuery);
} else if ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"),$_DELETE);
    $id = $_DELETE['ID'];
    $deleteQuery = "DELETE FROM toDoItems WHERE ID = $id;";
    $result = $conn->query($deleteQuery);
}

$conn->close();
?>