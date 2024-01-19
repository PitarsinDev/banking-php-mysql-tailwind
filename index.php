<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['amount'], $_POST['action'])) {
        $username = $_POST['username'];
        $amount = $_POST['amount'];
        $action = $_POST['action'];

        $user_query = "SELECT id, balance FROM users WHERE username = '$username'";
        $user_result = mysqli_query($conn, $user_query);

        if ($user_result && mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);
            $user_id = $user['id'];

            if ($action === 'deposit') {
                $new_balance = $user['balance'] + $amount;
            } elseif ($action === 'withdraw' && $user['balance'] >= $amount) {
                $new_balance = $user['balance'] - $amount;
            } else {
                die('Unable to complete the transaction');
            }

            $transaction_query = "INSERT INTO transactions (user_id, amount, transaction_type) VALUES ($user_id, $amount, '$action')";
            $transaction_result = mysqli_query($conn, $transaction_query);

            $update_balance_query = "UPDATE users SET balance = $new_balance WHERE id = $user_id";
            $update_balance_result = mysqli_query($conn, $update_balance_query);

            if ($transaction_result && $update_balance_result) {
                echo 'Complete the transaction';
            } else {
                echo 'There was an error in making the transaction.';
            }
        } else {
            echo 'User not found';
        }
    } else {
        echo 'Please fill out the information completely.';
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a list</title>
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
    
        <div class='flex justify-center'>
            <div class='p-5'>
                <h1 class='text-zinc-700 text-center text-2xl'>Banking <span class='text-indigo-600'>System</span></h1>
            </div>
        </div>

    <div class='flex justify-center'>
        <form action="index.php" method="post" class='bg-indigo-600 rounded-xl p-5 text-white shadow-md'>
            <div>
                <label for="username" class='text-sm'>Username :</label>
                <input type="text" name="username" required class='rounded-full shadow-md text-indigo-600 pl-2 text-sm'>
            </div>
            <br>
            <div>
                <label for="amount" class='text-sm'>Amount of money :</label>
                <input type="number" name="amount" step="0.01" required class='rounded-full shadow-md text-indigo-600 px-2 text-sm'>
            </div>
            <br>
            <div>
                <label for="action" class='text-sm'>type :</label>
                <select name="action" required class='rounded-full shadow-md text-indigo-600 pl-2 text-sm'>
                    <option value="deposit">Deposit money</option>
                    <option value="withdraw">Withdraw money</option>
                </select>
            </div>
            
            <div class='pt-4'>
            <button type="submit" class='text-xs text-indigo-600 bg-white px-5 py-1 rounded-full shadow-md'>Make a list</button>
            </div>
        </form>
    </div>

        <div class='flex justify-center pt-10'>
            <a href="transactions.php" class='text-white bg-indigo-600 px-5 py-1 rounded-full shadow-md'>View list</a>
        </div>

</body>
</html>