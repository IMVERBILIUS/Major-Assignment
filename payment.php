<?php
$booking_id = $_GET['booking_id'] ?? '';

// Use $booking_id as needed for payment processing
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
      
    </div>
</body>
</html>
