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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <link rel="StyleSheet" href="style.css">

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
            <!-- RETRIEVE QUERY FROM TABLE -->
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
                            <button class="delete_btn" onclick="return confimationfunction()">Delete</button>
                        </a>
                    </div>
                    </td>

            </tr>
        <?php endwhile; ?>
    </table>
        <!-- ADD NEW CONTACT POPUP-->
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
            <button type="submit" onclick="return confimationfunction()">Add Contact</button>
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

                <button type="submit" onclick="return confimationfunction()">Save Changes</button>
                <button type="button" onclick="closeEditPopup()">Cancel</button>
            </form>
        </div>

    <script>

        // ADD CONTACT FUNCTION
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        // ADD CONTACT FUNCTION
        function confirmedit(){
            alert("Are you sure ya bitch?");
            closePopup()
        }
        function closePopup() {
            
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
        // EDIT CONTACT FUNCTION
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

        // ADD CONTACT
        function closeEditPopup() {
            document.getElementById('editOverlay').style.display = 'none';
            document.getElementById('editPopup').style.display = 'none';
        }
        // Confirmation for add / edit / delete
        function confimationfunction(){
            return confirm("Are you sure about this?");
        }
    </script>
</body>

</html>
<?php
$conn->close();
?>