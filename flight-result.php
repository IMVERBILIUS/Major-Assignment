<?php
// Include your database connection file
include 'db_connect.php'; // Update with your actual file path

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
    $flight_origin = $_POST["flight_origin"] ?? "";
    $flight_destination = $_POST["flight_destination"] ?? "";
    $flight_date = $_POST["flight_date"] ?? "";
    $return_date = $_POST["return_date"] ?? "";
    $trip_type = $_POST["trip_type"] ?? "";

    // Retrieve location options from the database
    $sql_locations = "SELECT DISTINCT flight_origin FROM flight_result";
    $result_locations = mysqli_query($conn, $sql_locations);

    $sql_return_locations = "SELECT DISTINCT flight_destination FROM flight_result";
    $result_return_locations = mysqli_query($conn, $sql_return_locations);

    $sql_outbound = "SELECT fr.flight_result_id, fr.flight_date, fr.return_date, fr.flight_origin, fr.flight_destination, fr.flight_price, fr.departure_time, fr.arrival_time, al.airlines_name, al.airlines_images
            FROM flight_result fr
            INNER JOIN airlines al ON fr.airlines_id = al.airlines_id
            WHERE fr.flight_origin = '$flight_origin' AND fr.flight_destination = '$flight_destination' AND fr.flight_date = '$flight_date'
            ORDER BY fr.flight_price ASC"; // Added ORDER BY clause


    $result_outbound = mysqli_query($conn, $sql_outbound);

 
    if ($trip_type === "round") {
        $sql_return = "SELECT fr.flight_result_id, fr.flight_date, fr.return_date, fr.flight_origin, fr.flight_destination, fr.flight_price, fr.departure_time, fr.arrival_time, al.airlines_name, al.airlines_images
                FROM flight_result fr
                INNER JOIN airlines al ON fr.airlines_id = al.airlines_id
                WHERE fr.flight_origin = '$flight_destination' AND fr.flight_destination = '$flight_origin' AND fr.return_date = '$return_date'
                ORDER BY fr.flight_price ASC"; // Added ORDER BY clause


        $result_return = mysqli_query($conn, $sql_return);
    }
?>


    <?php include '../MJ/layout/Nav.php'; ?>

    <div class="container min-vh-100">
        <h2 class="mt-5 mb-4 text-center">Flight Details</h2>
        
        <!-- Form for selecting flight origin and destination -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-4">
            <div class="row">
                <div class="col">
                    <label for="flight_origin">From:</label>
                    <select name="flight_origin" id="flight_origin" class="form-control">
                        <?php while ($row_location = mysqli_fetch_assoc($result_locations)) : ?>
                            <option value="<?php echo $row_location['flight_origin']; ?>" <?php echo ($row_location['flight_origin'] == $flight_origin) ? 'selected' : ''; ?>><?php echo $row_location['flight_origin']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="flight_destination">To:</label>
                    <select name="flight_destination" id="flight_destination" class="form-control">
                        <?php mysqli_data_seek($result_return_locations, 0); ?>
                        <?php while ($row_return_location = mysqli_fetch_assoc($result_return_locations)) : ?>
                            <option value="<?php echo $row_return_location['flight_destination']; ?>" <?php echo ($row_return_location['flight_destination'] == $flight_destination) ? 'selected' : ''; ?>><?php echo $row_return_location['flight_destination']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="flight_date">Flight Date:</label>
                    <input type="date" name="flight_date" id="flight_date" class="form-control" value="<?php echo $flight_date; ?>">
                </div>
                <div class="col">
                    <label for="return_date">Return Date:</label>
                    <input type="date" name="return_date" id="return_date" class="form-control" value="<?php echo $return_date; ?>">
                </div>
                <div class="col">
                    <label for="trip_type">Trip Type:</label>
                    <select name="trip_type" id="trip_type" class="form-control">
                        <option value="one-way" <?php echo ($trip_type == 'one-way') ? 'selected' : ''; ?>>One Way</option>
                        <option value="round" <?php echo ($trip_type == 'round') ? 'selected' : ''; ?>>Round Trip</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning mt-3 mx-auto d-block" style="width: 150px;">Search</button>

        </form>
        
        <div class="row">
            <!-- Flight cards for outbound flights -->
            <?php while ($row_outbound = mysqli_fetch_assoc($result_outbound)) : ?>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <img src="../MJ/img/<?php echo $row_outbound["airlines_images"]; ?>" class="mr-3 img-fluid" alt="<?php echo $row_outbound["airlines_name"]; ?>" style="width: 100px;">
                                <div class="media-body">
                                    <h5 class="card-title"><?php echo $row_outbound["airlines_name"]; ?></h5>
                                    <p class="card-text">From: <?php echo $row_outbound["flight_origin"]; ?> -- To: <?php echo $row_outbound["flight_destination"]; ?></p>
                                    <p class="card-text">Departure Time: <?php echo $row_outbound["departure_time"]; ?> - Arrival Time: <?php echo $row_outbound["arrival_time"]; ?></p>
                                    <p class="card-text">Duration: <?php echo gmdate("H:i:s", strtotime($row_outbound["arrival_time"]) - strtotime($row_outbound["departure_time"])); ?></p>
                                    <p class="card-text">
                                        <h5 style="position: absolute; left: 91%; top: 30%;">Price:</h5>
                                        <span class="highlight-price">$<?php echo number_format($row_outbound["flight_price"], 2, ',', '.'); ?></span>
                                    </p>
                                </div>
                            </div>
                            <form action="passanger_book.php" method="post">
                                <!-- Hidden input fields -->
                                <input type="hidden" name="flight_id" value="<?php echo $row_outbound["flight_result_id"]; ?>">
                                <input type="hidden" name="flight_destination" value="<?php echo $row_outbound["flight_destination"]; ?>">
                                <input type="hidden" name="flight_date" value="<?php echo $row_outbound["flight_date"]; ?>">
                                <input type="hidden" name="return_date" value="<?php echo $row_outbound["return_date"]; ?>">
                                <input type="hidden" name="flight_duration" value="<?php echo gmdate("H:i:s", strtotime($row_outbound["arrival_time"]) - strtotime($row_outbound["departure_time"])); ?>">
                                <input type="hidden" name="departure_time" value="<?php echo $row_outbound["departure_time"]; ?>">
                                <input type="hidden" name="arrival_time" value="<?php echo $row_outbound["arrival_time"]; ?>">
                                <input type="hidden" name="flight_price" value="<?php echo $row_outbound["flight_price"]; ?>">
                                <input type="hidden" name="airline_name" value="<?php echo $row_outbound["airlines_name"]; ?>">
                                <!-- Book Now button -->
                                <button type="submit" class="btn btn-warning mt-2 mx-auto d-block">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php if ($trip_type === "round") : ?>
            <h2 class="mt-5 mb-4 text-center">Return Flight Details</h2>
            <div class="row">
                <!-- Flight cards for return flights -->
                <?php while ($row_return = mysqli_fetch_assoc($result_return)) : ?>
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img src="../MJ/img/<?php echo $row_return["airlines_images"]; ?>" class="mr-3 img-fluid" alt="<?php echo $row_return["airlines_name"]; ?>" style="width: 100px;">
                                    <div class="media-body">
                                        <h5 class="card-title"><?php echo $row_return["airlines_name"]; ?></h5>
                                        <p class="card-text">From: <?php echo $row_return["flight_origin"]; ?> -- To: <?php echo $row_return["flight_destination"]; ?></p>
                                        <p class="card-text">Departure Time: <?php echo $row_return["departure_time"]; ?> - Arrival Time: <?php echo $row_return["arrival_time"]; ?></p>
                                        <p class="card-text">Duration: <?php echo gmdate("H:i:s", strtotime($row_return["arrival_time"]) - strtotime($row_return["departure_time"])); ?></p>
                                        <p class="card-text">
                                            <h5 style="position: absolute; left: 91%; top: 30%;">Price:</h5>
                                            <span class="highlight-price">$<?php echo number_format($row_return["flight_price"], 2, ',', '.'); ?></span>
                                        </p>
                                    </div>
                                </div>
                                <form action="passanger_book.php" method="post">
                                <!-- Hidden input fields -->
                                <input type="hidden" name="flight_id" value="<?php echo $row_return["flight_result_id"]; ?>">
                                <input type="hidden" name="flight_destination" value="<?php echo $row_return["flight_destination"]; ?>">
                                <input type="hidden" name="flight_date" value="<?php echo $row_return["flight_date"]; ?>">
                                <input type="hidden" name="return_date" value="<?php echo $row_return["return_date"]; ?>">
                                <input type="hidden" name="flight_duration" value="<?php echo gmdate("H:i:s", strtotime($row_return["arrival_time"]) - strtotime($row_return["departure_time"])); ?>">
                                <input type="hidden" name="departure_time" value="<?php echo $row_return["departure_time"]; ?>">
                                <input type="hidden" name="arrival_time" value="<?php echo $row_return["arrival_time"]; ?>">
                                <input type="hidden" name="flight_price" value="<?php echo $row_return["flight_price"]; ?>">
                                <input type="hidden" name="airline_name" value="<?php echo $row_return["airlines_name"]; ?>">
                                <!-- Book Now button -->
                                <button type="submit" class="btn btn-warning mt-2 mx-auto d-block">Book Now</button>
                            </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <div class='container text-center mt-5'>
            <a href="index.php" class="btn btn-warning mb-5 ">Go Back to Home</a>
        </div>
    </div>

    <?php include '../MJ/layout/Footer.php'; ?>

<?php
    // Close the connection
    mysqli_close($conn);
} else {
    // If the form is not submitted via POST, handle the error accordingly
    echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error: Form submission method not allowed</h4><p>It looks like you're trying to access this page in an invalid way. Please go back to the home page and try again.</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
}
?>

