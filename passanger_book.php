<?php

require 'function.php';

$flight_id = $_POST["flight_id"] ?? "";
$flight_destination = $_POST["flight_destination"] ?? "";
$flight_date = $_POST["flight_date"] ?? "";
$return_date = $_POST["return_date"] ?? "";
$flight_duration = $_POST["flight_duration"] ?? "";
$departure_time = $_POST["departure_time"] ?? "";
$arrival_time = $_POST["arrival_time"] ?? "";
$flight_price = $_POST["flight_price"] ?? "";
$airline_name = $_POST["airline_name"] ?? "";
$booking_date = date("Y-m-d");

if(isset($_POST["submit"])){
    $booking_id = insertPassenger($_POST);
    if($booking_id > 0){
        echo "<script type='text/javascript'>
            alert('Booking has been made. Please proceed to payment.');
            window.location ='payment.php?booking_id=$booking_id';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Failed to make booking. Please try again.');
            window.location ='passenger_book.php';
            </script>";
    }
}
?>

<?php include '../MJ/layout/Nav.php'; ?>
    <div class="container min-vh-100">
        <h2 class="mt-5 mb-4 text-center">Add Passenger Details</h2>
        
        <form method="POST" action="" enctype="multipart/form-data" class="mb-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="passenger_name">Passenger Name:</label>
                    <input type="text" name="passenger_name" id="passenger_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_contact">Passenger Contact:</label>
                    <input type="number" name="passenger_contact" id="passenger_contact" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_email">Passenger Email:</label>
                    <input type="email" name="passenger_email" id="passenger_email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_date_birth">Date of Birth:</label>
                    <input type="date" name="passenger_date_birth" id="passenger_date_birth" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nationality">Nationality:</label>
                    <input type="text" name="nationality" id="nationality" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passport_number">Passport Number:</label>
                    <input type="number" name="passport_number" id="passport_number" class="form-control">
                </div>
            </div>
            
            <input type="hidden" name="booking_date" value="<?php echo $booking_date; ?>">
            <input type="hidden" name="flight_result_id" value="<?php echo $flight_id; ?>">
            <input type="hidden" name="total" value="<?php echo $flight_price; ?>">

            <button type="submit" name="submit"  class="btn btn-warning mt-3 mx-auto d-block" style="width: 150px;">Add Passenger</button>
        </form>
        <div class='container text-center mt-5'>
            <a href="index.php" class="btn btn-warning mb-5">Go Back to Home</a>
        </div>
    </div>
    <?php include '../MJ/layout/Footer.php'; ?>
