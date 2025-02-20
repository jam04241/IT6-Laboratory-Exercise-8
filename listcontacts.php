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
$result = $conn->query("CALL ListAllContacts()");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 500px;
        }

        .popup input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .popup button {
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        .popup button:hover {
            background-color: #0056b3;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .add-contact {
            display: block;
            margin: 20px auto;
            color: #007BFF;
            text-decoration: none;
            font-size: 16px;
        }

        .add-contact:hover {
            text-decoration: underline;
        }

        .edit_btn {
            background-color: rgb(255, 213, 0);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete_btn {
            background-color: rgb(255, 0, 0);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;

        }
    </style>
    <script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        function openEditPopup(contact) {
            document.getElementById('editContactId').value = contact.id;
            document.getElementById('editFirstname').value = contact.firstname;
            document.getElementById('editLastname').value = contact.lastname;
            document.getElementById('editBirthdate').value = contact.birthdate;
            document.getElementById('editWorkphone').value = contact.workphone;
            document.getElementById('editHomephone').value = contact.homephone;
            document.getElementById('editEmail').value = contact.email;

            document.getElementById('editOverlay').style.display = 'block';
            document.getElementById('editPopup').style.display = 'block';
        }


        function closeEditPopup() {
            document.getElementById('editOverlay').style.display = 'none';
            document.getElementById('editPopup').style.display = 'none';
        }
    </script>
</head>

<body>
    <h2>Contact List</h2>
    <a href="#" class="add-contact" onclick="openPopup()">Add New Contact</a>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthdate</th>
            <th>Work Phone</th>
            <th>Home Phone</th>
            <th>Email</th>
            <th>Created By ID</th>
            <th>Created Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                <td><?php echo htmlspecialchars($row['birthdate']); ?></td>
                <td><?php echo htmlspecialchars($row['workphone']); ?></td>
                <td><?php echo htmlspecialchars($row['homephone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['createdByID']); ?></td>
                <td><?php echo htmlspecialchars($row['createdDate']); ?></td>
                <<td>
                    <div class="actions">
                        <button class="edit_btn" onclick='openEditPopup(<?php echo json_encode($row); ?>)'>Edit</button>
                        <a href="delete_contact.php?id=<?php echo $row['id']; ?>">
                            <button class="delete_btn">Delete</button>
                        </a>
                    </div>
                    </td>

            </tr>
        <?php endwhile; ?>
    </table>

    <div id="overlay" class="overlay" onclick="closePopup()"></div>
    <div id="popup" class="popup">
        <h2>Add New Contact</h2>
        <form action="process_contact.php" method="POST">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Laplacehe" required>
            <input type="date" name="birthdate" required>
            <input type="text" name="workphone" placeholder="Work Phone">
            <input type="text" name="homephone" placeholder="Home Phone">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Add Contact</button>
            <button type="button" onclick="closePopup()">Cancel</button>
        </form>
    </div>
    <div id="editOverlay" class="overlay" onclick="closeEditPopup()"></div>
    <div id="editPopup" class="popup">
        <h2>Edit Contact</h2>
        <form action="update.php" method="POST">

            <input type="hidden" id="editContactId" name="contact_id">

            <input type="text" id="editFirstname" name="firstname" placeholder="First Name" required>
            <input type="text" id="editLastname" name="lastname" placeholder="Last Name" required>
            <input type="date" id="editBirthdate" name="birthdate" required>
            <input type="text" id="editWorkphone" name="workphone" placeholder="Work Phone">
            <input type="text" id="editHomephone" name="homephone" placeholder="Home Phone">
            <input type="email" id="editEmail" name="email" placeholder="Email" required>

            <button type="submit">Save Changes</button>
            <button type="button" onclick="closeEditPopup()">Cancel</button>
        </form>
    </div>

</body>

</html>
<?php
$conn->close();
?>