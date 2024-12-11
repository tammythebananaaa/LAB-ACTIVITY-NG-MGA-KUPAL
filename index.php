<?php
// index.php

// Read contacts
$contacts = file('contacts.txt', FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Dashboard</title>
    <style>
        /* Dark theme styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f1f1f1;
        }
        header {
            background-color: #1f1f1f;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        header h1 {
            margin: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            color: #f1f1f1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #444;
            color: #f1f1f1;
        }
        table tr:nth-child(even) {
            background-color: #333;
        }
        table tr:hover {
            background-color: #555;
        }
        .btn {
            padding: 10px 20px;
            color: white;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #6200ea;
        }
        .btn-primary:hover {
            background-color: #3700b3;
        }
        .btn-edit {
            background-color: #03dac6;
        }
        .btn-edit:hover {
            background-color: #018786;
        }
        .btn-delete {
            background-color: #b00020;
        }
        .btn-delete:hover {
            background-color: #9b0000;
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact Dashboard</h1>
    </header>

    <div class="container">
        <h2>All Contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Category</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                <?php 
                    $contactDetails = explode('|', $contact);
                ?>
                <tr>
                    <td><?php echo $contactDetails[0]; ?></td>
                    <td><?php echo $contactDetails[1]; ?></td>
                    <td><?php echo $contactDetails[2]; ?></td>
                    <td><?php echo $contactDetails[3]; ?></td>
                    <td><?php echo $contactDetails[4]; ?></td>
                    <td>
                        <a href="edit_contact.php?id=<?php echo $contactDetails[0]; ?>" class="btn btn-edit">Edit</a>
                        <a href="process.php?action=delete&id=<?php echo $contactDetails[0]; ?>" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_contact.php" class="btn btn-primary">Add New Contact</a>
        <a href="insights.php" class="btn btn-primary">View Insights</a>
    </div>
</body>
</html>
