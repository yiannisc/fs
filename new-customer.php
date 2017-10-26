<?php
include '_dbconn.inc';

// Get form data

$stype =    $_POST['type-service'];
$title =    $_POST['title'];
$fname =    $_POST['fname'];
$lname =    $_POST['lname'];
$oname =    $_POST['oname'];
$ctype =    $_POST['ctype'];

switch ($ctype) {
    case 0 :
        $type = '0';
        $name = $title . ' ' . $fname . ' ' . $lname;
        $service = $stype;
        break;

    case 1:
        $type = '1';
        $name = $oname;
        $service = $stype;
        break;

    case 2:
        $type = '2';
        $name = 'Anonymous';
        $service = $stype;
        break;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error) . "<br />";
    echo "Please go back and try again.";
} 

// Create SQL statement
$sql = "INSERT INTO queue (q_type, q_name, q_service)
VALUES ($type, '$name', $service)";

// Execute SQL and get result
if ($conn->query($sql) === TRUE) {
    echo "Record created";
    header('Location: http://testing.yiannis.uk/fs/'); //redirect
    exit();
} else {
    echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
    echo "Please go back and try again.";
}
// Close connection
$conn->close();
?>