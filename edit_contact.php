<?php
// edit_contact.php

if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    $contacts = file('contacts.txt', FILE_IGNORE_NEW_LINES);
    foreach ($contacts as $contact) {
        $contactDetails = explode('|', $contact);
        if ($contactDetails[0] === $contactId) {
            $name = $contactDetails[0];
            $email = $contactDetails[1];
            $phone = $contactDetails[2];
            $category = $contactDetails[3];
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];

    $newContacts = '';
    foreach ($contacts as $contact) {
        $contactDetails = explode('|', $contact);
        if ($contactDetails[0] === $contactId) {
            $contact = "$name|$email|$phone|$category|".date('Y-m-d');
        }
        $newContacts .= $contact . "\n";
    }
    file_put_contents('contacts.txt', $newContacts);

    $log = "[" . date('Y-m-d H:i:s') . "] Edited contact: $name, $category\n";
    file_put_contents('activity_log.txt', $log, FILE_APPEND);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
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
        <h1>Edit Contact</h1>
    </header>

    <div class="form-container">
        <form action="edit_contact.php?id=<?php echo $contactId; ?>" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>

            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="Family" <?php echo ($category == 'Family') ? 'selected' : ''; ?>>Family</option>
                <option value="Friends" <?php echo ($category == 'Friends') ? 'selected' : ''; ?>>Friends</option>
                <option value="Work" <?php echo ($category == 'Work') ? 'selected' : ''; ?>>Work</option>
            </select>

            <button type="submit">Update Contact</button>
        </form>
    </div>
</body>
</html>
