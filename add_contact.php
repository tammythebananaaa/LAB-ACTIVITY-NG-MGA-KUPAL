<?php
// add_contact.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $date_added = date('Y-m-d');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } else {
        // Append to contacts.txt
        $contact = "$name|$email|$phone|$category|$date_added\n";
        file_put_contents('contacts.txt', $contact, FILE_APPEND);

        // Log action
        $log = "[" . date('Y-m-d H:i:s') . "] Added contact: $name, $category\n";
        file_put_contents('activity_log.txt', $log, FILE_APPEND);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
    <style>
        /* Dark theme styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1f1f1f;
            color: white;
            text-align: center;
            padding: 40px 0;
        }
        header h1 {
            margin: 0;
        }
        .form-container {
            width: 70%;
            margin: 50px auto;
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 15px;
            margin: 12px 0;
            border: 1px solid #444;
            border-radius: 5px;
            font-size: 1em;
            background-color: #333;
            color: #f1f1f1;
        }
        button {
            background-color: #6200ea;
            color: white;
            padding: 14px 20px;
            border: none;
            font-weight: 600;
            border-radius: 5px;
            width: 100%;
        }
        button:hover {
            background-color: #3700b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Contact</h1>
    </header>

    <div class="form-container">
        <form action="add_contact.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" required>

            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="Family">Family</option>
                <option value="Friends">Friends</option>
                <option value="Work">Work</option>
            </select>

            <button type="submit">Add Contact</button>
        </form>
    </div>
</body>
</html>
