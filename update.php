<?php
//JOSH ANDREI
$host = "localhost";
$username = "root";
$password = "";
$database = "contacts_db";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_id = $_POST["contact_id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $birthdate = $_POST["birthdate"];
    $workphone = $_POST["workphone"];
    $homephone = $_POST["homephone"];
    $email = $_POST["email"];


    $stmt = $conn->prepare("CALL EditContact(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $contact_id, $firstname, $lastname, $birthdate, $workphone, $homephone, $email);

    if ($stmt->execute()) {
        echo "Contact updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();


header("Location: listcontacts.php");
exit();
