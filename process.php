<?php
// process.php

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $contactId = $_GET['id'];

    // Read contacts
    $contacts = file('contacts.txt', FILE_IGNORE_NEW_LINES);

    $newContacts = '';
    foreach ($contacts as $contact) {
        $contactDetails = explode('|', $contact);
        if ($contactDetails[0] !== $contactId) {
            $newContacts .= $contact . "\n";
        }
    }

    file_put_contents('contacts.txt', $newContacts);

    // Log action
    $log = "[" . date('Y-m-d H:i:s') . "] Deleted contact: $contactId\n";
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
    <title>Processing...</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #f1f1f1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
        }
        h1 {
            color: #f1f1f1;
            font-size: 2rem;
        }
        p {
            color: #b0b0b0;
            font-size: 1rem;
        }
        a {
            color: #6200ea;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #3700b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Deleted</h1>
        <p>The contact has been successfully deleted. You will be redirected back to the dashboard shortly.</p>
        <p><a href="index.php">Go to Dashboard</a></p>
    </div>
</body>
</html>
