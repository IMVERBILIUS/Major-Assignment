<?php
$booking_ids_str = $_GET['booking_ids'] ?? '';
$booking_ids = explode(",", $booking_ids_str);

// Include database connection and function files
include 'db_connect.php';
require 'function.php';

// Fetch passenger name and flight result data associated with the selected booking IDs
$sql_data = "SELECT p.passenger_name, b.booking_id, f.flight_result_id, f.flight_date, f.return_date, f.flight_origin, f.flight_destination, f.flight_price, f.airlines_id, f.airport_id, f.departure_time, f.arrival_time
             FROM passenger p
             INNER JOIN booking b ON p.passenger_id = b.passenger_id
             INNER JOIN flight_result f ON b.flight_result_id = f.flight_result_id
             WHERE b.booking_id IN ('" . implode("','", $booking_ids) . "')";
$result_data = mysqli_query($conn, $sql_data);

// Create an associative array to store passenger and flight result data by booking ID
$booking_data = [];
while ($row = mysqli_fetch_assoc($result_data)) {
    $booking_data[$row['booking_id']] = [
        'passenger_name' => $row['passenger_name'],
        'flight_origin' => $row['flight_origin'],
        'flight_destination' => $row['flight_destination'],
        'flight_date' => $row['flight_date'],
        'flight_price' => $row['flight_price'],
    ];
}


// Calculate the payment amount based on the number of booking IDs
$payment_amount = array_sum(array_column($booking_data, 'flight_price'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"] ?? "";
    $amount = $_POST["amount"] ?? "";

    // Verify that the selected booking ID is valid
    if (!array_key_exists($booking_id, $booking_data)) {
        echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error!</h4><p>The selected booking ID is not valid.</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
        exit;
    }

    // Verify that the submitted amount matches the calculated payment amount
    if ($amount != $payment_amount) {
        echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error!</h4><p>The submitted amount does not match the calculated payment amount.</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
        exit;
    }

    // Prepare the data array to be passed to the function
    $data = [
        "amount" => $amount,
        "booking_id" => $booking_id
    ];

    // Insert payment details using the insertPayment function
    $result = insertPayment($data);

    if ($result === true) {
        echo "<script type='text/javascript'>
            alert('Payment has been successfully made and ticket confirmation will send to your email .');
            window.location ='index.php';
            </script>";
    } else {
        echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error!</h4><p>There was an error processing your payment: " . $result . "</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
    }

    // Close the connection
    mysqli_close($conn);
}
?>


<?php include '../MJ/layout/Nav.php'; ?>
    <div class="container min-vh-100">
        <h2 class="mt-5 mb-4 text-center">Payment Page</h2>



<!-- Display Flight Details -->
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h5 class="text-center">Flight Details</h5>
        <ul class="list-group">
            <?php foreach ($booking_data as $booking_id => $data): ?>
                <li class="list-group-item">
                    <strong>Passenger Name:</strong> <?php echo $data['passenger_name']; ?><br>
                    <strong>Flight Origin:</strong> <?php echo $data['flight_origin']; ?><br>
                    <strong>Flight Destination:</strong> <?php echo $data['flight_destination']; ?><br>
                    <strong>Flight Date:</strong> <?php echo $data['flight_date']; ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>



        <!-- Payment Form -->
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="booking_id">choose who wants to pay:</label>
                        <select name="booking_id" id="booking_id" class="form-control" required>
                            <?php foreach ($booking_data as $booking_id => $data): ?>
                                <option value="<?php echo $booking_id; ?>"><?php echo $data['passenger_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Payment Amount:</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="<?php echo htmlspecialchars($payment_amount); ?>" required readonly>
                    </div>
                    <button type="submit" class="btn btn-warning mt-3 mx-auto d-block" style="width: 150px;">Submit Payment</button>
                </form>
            </div>
        </div>

        <div class='container text-center mt-5'>
            <a href="index.php" class="btn btn-warning mb-5">Go Back to Home</a>
        </div>
    </div>
    <?php include '../MJ/layout/Footer.php'; ?>

