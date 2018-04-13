<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//get values into the php code
$stockId = $_GET['stockId'];
$newQuantity = $_GET['quantity'];

//the sql query
$sql = "update stockitem
set Quantity = Quantity + '$newQuantity'
where SI_ID = '$stockId'";


//runs query
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

?>
