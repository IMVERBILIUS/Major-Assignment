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
    $booking_ids = [];
    foreach ($_POST['passenger_name'] as $index => $passenger_name) {
        $booking_id = insertPassengers($_POST, $index);
        if($booking_id > 0){
            $booking_ids[] = $booking_id;
        } else {
            // handle error if needed
        }
    }

    if(!empty($booking_ids)){
        $booking_ids_str = implode(",", $booking_ids);
        echo "<script type='text/javascript'>
            alert('Booking has been made. Please proceed to payment.');
            window.location ='payment.php?booking_ids=$booking_ids_str';
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
    
    <form method="POST" action="" enctype="multipart/form-data" class="mb-4" id="passengerForm">
        <div id="passengerContainer">
            <div class="row passenger-row">
                <h4 class="col-12 mb-3">Passenger 1</h4>
                <div class="col-md-6 mb-3">
                    <label for="passenger_name_1">Passenger Name:</label>
                    <input type="text" name="passenger_name[]" id="passenger_name_1" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_contact_1">Passenger Contact:</label>
                    <input type="number" name="passenger_contact[]" id="passenger_contact_1" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_email_1">Passenger Email:</label>
                    <input type="email" name="passenger_email[]" id="passenger_email_1" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passenger_date_birth_1">Date of Birth:</label>
                    <input type="date" name="passenger_date_birth[]" id="passenger_date_birth_1" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nationality_1">Nationality:</label>
                    <input type="text" name="nationality[]" id="nationality_1" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passport_number_1">Passport Number:</label>
                    <input type="number" name="passport_number[]" id="passport_number_1" class="form-control">
                </div>
            </div>
        </div>
        
        <input type="hidden" name="booking_date" value="<?php echo $booking_date; ?>">
        <input type="hidden" name="flight_result_id" value="<?php echo $flight_id; ?>">
        <input type="hidden" name="total" value="<?php echo $flight_price; ?>">

        <div class="d-flex justify-content-center">
            <button type="button" id="addPassengerBtn" class="btn btn-warning mt-3 mx-2" style="width: 150px;">Add More Passenger</button>
            <button type="submit" name="submit" class="btn btn-warning mt-3 mx-2" style="width: 150px;">Submit Booking</button>
        </div>
    </form>
    <div class='container text-center mt-5'>
        <a href="index.php" class="btn btn-warning mb-5">Go Back to Home</a>
    </div>
</div>
<?php include '../MJ/layout/Footer.php'; ?>

<script>
    document.getElementById('addPassengerBtn').addEventListener('click', function() {
        var passengerContainer = document.getElementById('passengerContainer');
        var passengerCount = document.querySelectorAll('.passenger-row').length + 1;
        var newPassenger = document.createElement('div');
        newPassenger.classList.add('row', 'passenger-row');
        newPassenger.innerHTML = `
            <h4 class="col-12 mb-3">Passenger ${passengerCount}</h4>
            <div class="col-md-6 mb-3">
                <label for="passenger_name_${passengerCount}">Passenger Name:</label>
                <input type="text" name="passenger_name[]" id="passenger_name_${passengerCount}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="passenger_contact_${passengerCount}">Passenger Contact:</label>
                <input type="number" name="passenger_contact[]" id="passenger_contact_${passengerCount}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="passenger_email_${passengerCount}">Passenger Email:</label>
                <input type="email" name="passenger_email[]" id="passenger_email_${passengerCount}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="passenger_date_birth_${passengerCount}">Date of Birth:</label>
                <input type="date" name="passenger_date_birth[]" id="passenger_date_birth_${passengerCount}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nationality_${passengerCount}">Nationality:</label>
                <input type="text" name="nationality[]" id="nationality_${passengerCount}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="passport_number_${passengerCount}">Passport Number:</label>
                <input type="number" name="passport_number[]" id="passport_number_${passengerCount}" class="form-control">
            </div>
        `;
        passengerContainer.appendChild(newPassenger);
    });
</script>
