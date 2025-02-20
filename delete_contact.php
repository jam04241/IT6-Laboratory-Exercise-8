<?php
//JOSH ANDREI
$host = "localhost";
$username = "root";
$password = "";
$database = "contacts_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if `id` is passed in the URL
if (isset($_GET["id"])) {
    $contact_id = $_GET["id"];

    // Prepare and execute stored procedure for deleting contact
    $stmt = $conn->prepare("CALL DeleteContact(?)");
    $stmt->bind_param("i", $contact_id);

    if ($stmt->execute()) {
        echo "Contact deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();

// Redirect back to the main page
header("Location: listcontacts.php");
exit();
