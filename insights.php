<?php
// insights.php
$contacts = file('contacts.txt', FILE_IGNORE_NEW_LINES);

// Categories analysis
$categories = array('Family' => 0, 'Friends' => 0, 'Work' => 0);
foreach ($contacts as $contact) {
    $contactDetails = explode('|', $contact);
    $categories[$contactDetails[3]]++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insights</title>
    <style>
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
        .insights-container {
            width: 70%;
            margin: 50px auto;
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-align: center;
            background-color: #6200ea;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #3700b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact Insights</h1>
    </header>

    <div class="insights-container">
        <h2>Category Distribution</h2>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category => $count) : ?>
                <tr>
                    <td><?php echo $category; ?></td>
                    <td><?php echo $count; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Back Button -->
        <a href="index.php" class="btn-back">Back to Dashboard</a>
    </div>
</body>
</html>
