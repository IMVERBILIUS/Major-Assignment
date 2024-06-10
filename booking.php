<?php
// Include your database connection file
include_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve flight details from the form submission
    $flight_id = $_POST['flight_id'];
    $flight_destination = $_POST['flight_destination'];
    $flight_date = $_POST['flight_date'];
    $return_date = $_POST['return_date'];
    $flight_duration = $_POST['flight_duration'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $flight_price = $_POST['flight_price'];
    $airline_name = $_POST['airline_name'];

    // Here you can add more fields as necessary
}

?>

<?php include '../MJ/layout/Nav.php'; ?>

<div class="container min-vh-100">
    <h2 class="mt-5 mb-4 text-center">Booking Confirmation</h2>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <img src="../MJ/img/<?php echo $airline_name; ?>" class="mr-3 img-fluid" alt="<?php echo $airline_name; ?>" style="width: 100px;">
                        <div class="media-body">
                            <h5 class="card-title"><?php echo $airline_name; ?></h5>
                            <p class="card-text">From: <?php echo htmlspecialchars($flight_origin); ?> -- To: <?php echo htmlspecialchars($flight_destination); ?></p>
                            <p class="card-text">Departure Time: <?php echo htmlspecialchars($departure_time); ?> - Arrival Time: <?php echo htmlspecialchars($arrival_time); ?></p>
                            <p class="card-text">Duration: <?php echo htmlspecialchars($flight_duration); ?></p>
                            <p class="card-text">Price: $<?php echo number_format($flight_price, 2, ',', '.'); ?></p>
                        </div>
                    </div>
                    <form action="confirm_booking.php" method="post">
                        <!-- Hidden input fields -->
                        <input type="hidden" name="flight_id" value="<?php echo htmlspecialchars($flight_id); ?>">
                        <input type="hidden" name="flight_destination" value="<?php echo htmlspecialchars($flight_destination); ?>">
                        <input type="hidden" name="flight_date" value="<?php echo htmlspecialchars($flight_date); ?>">
                        <input type="hidden" name="return_date" value="<?php echo htmlspecialchars($return_date); ?>">
                        <input type="hidden" name="flight_duration" value="<?php echo htmlspecialchars($flight_duration); ?>">
                        <input type="hidden" name="departure_time" value="<?php echo htmlspecialchars($departure_time); ?>">
                        <input type="hidden" name="arrival_time" value="<?php echo htmlspecialchars($arrival_time); ?>">
                        <input type="hidden" name="flight_price" value="<?php echo htmlspecialchars($flight_price); ?>">
                        <input type="hidden" name="airline_name" value="<?php echo htmlspecialchars($airline_name); ?>">
                        <!-- Confirm Booking button -->
                        <button type="submit" class="btn btn-warning mt-2 mx-auto d-block" style="width: 150px;">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class='container text-center mt-5'>
        <a href="index.php" class="btn btn-warning mb-5">Go Back to Home</a>
    </div>
</div>

<?php include '../MJ/layout/Footer.php'; ?>
