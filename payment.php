<?php
$booking_id = $_GET['booking_id'] ?? '';

// Use $booking_id as needed for payment processing

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; // Ensure this file connects to your database

    $amount = $_POST["amount"] ?? "";
    $payment_date = date("Y-m-d");

    // Insert payment details into the database
    $sql_insert_payment = "INSERT INTO payment (payment_date, amount, booking_id) 
                           VALUES ('$payment_date', '$amount', '$booking_id')";

    if (mysqli_query($conn, $sql_insert_payment)) {
        echo "<script type='text/javascript'>
            alert('Payment has been successfully made.');
            window.location ='index.php';
            </script>";
    } else {
        echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error!</h4><p>There was an error processing your payment: " . mysqli_error($conn) . "</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container min-vh-100">
        <h2 class="mt-5 mb-4 text-center">Payment Page</h2>
        <p>Your booking ID is: <?php echo htmlspecialchars($booking_id); ?></p>
        <form method="POST" action="">
            <div class="form-group">
                <label for="amount">Payment Amount:</label>
                <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3 mx-auto d-block" style="width: 150px;">Submit Payment</button>
        </form>
        <div class='container text-center mt-5'>
            <a href="index.php" class="btn btn-warning mb-5">Go Back to Home</a>
        </div>
    </div>
</body>
</html>