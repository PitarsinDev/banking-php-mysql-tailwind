<?php
include 'db.php';

$transactions_query = "SELECT * FROM transactions";
$transactions_result = mysqli_query($conn, $transactions_query);

if ($transactions_result && mysqli_num_rows($transactions_result) > 0) {
    echo '<h2 class="text-center p-5 text-xl text-indigo-600">List of money coming in and going out</h2>';
    echo '<div class="flex justify-center">';
    echo '<div>';
    echo '<table class="bg-indigo-600 text-white rounded-xl shadow-md">';
    echo '<tr><th class="border p-2">ID</th><th class="border p-2">User ID</th><th class="border p-2">Amount</th><th class="border p-2">Type</th><th class="border p-2">Date</th></tr>';

    while ($transaction = mysqli_fetch_assoc($transactions_result)) {
        
        echo '<tr>';
        echo '<td class="border p-2">' . $transaction['id'] . '</td>';
        echo '<td class="border p-2">' . $transaction['user_id'] . '</td>';
        echo '<td class="border p-2">' . $transaction['amount'] . '</td>';
        echo '<td class="border p-2">' . $transaction['transaction_type'] . '</td>';
        echo '<td class="border p-2">' . $transaction['transaction_date'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'Item not found';
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        *{
        font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class='flex justify-center p-5'>
        <a href="index.php" class='text-xs text-indigo-600'>
            Back to Home
        </a>
    </div>
</body>
</html>