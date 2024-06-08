<?php
// Include your database connection file
include 'db_connect.php'; // Update with your actual file path

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Extract data from the form
    $flight_origin = $_GET["flight_origin"] ?? "";
    $flight_destination = $_GET["flight_destination"] ?? "";
    $flight_date = $_GET["flight_date"] ?? "";
    $return_date = $_GET["return_date"] ?? "";
    $trip_type = $_GET["trip_type"] ?? "";

    // Construct SQL query based on form data
    $sql = "SELECT fr.flight_result_id, fr.flight_date, fr.return_date, fr.flight_origin, fr.flight_destination, fr.flight_duration, fr.flight_price, al.airlines_name
    FROM flight_result fr
    INNER JOIN airlines al ON fr.airlines_id = al.airlines_id
    WHERE fr.flight_origin = '$flight_origin' AND fr.flight_destination = '$flight_destination' AND fr.flight_date = '$flight_date'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Flight Details</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <!-- Custom CSS -->
            <link rel="stylesheet" href="your-custom-styles.css"> <!-- Update with your custom styles file -->
        </head>
        <body>
            <?php include '../MJ/layout/Nav.php'; ?>

            <div class="container">
                <h2 class="mt-5 mb-4">Flight Details</h2>
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Flight <?php echo $row["flight_result_id"]; ?></h5>
                                    <p class="card-text">Destination: <?php echo $row["flight_destination"]; ?></p>
                                    <p class="card-text">Departure Date: <?php echo $row["flight_date"]; ?></p>
                                    <p class="card-text">Return Date: <?php echo $row["return_date"]; ?></p>
                                    <p class="card-text">Duration: <?php echo $row["flight_duration"]; ?></p>
                                    <p class="card-text">Price: <?php echo $row["flight_price"]; ?></p>
                                    <p class="card-text">Airline: <?php echo $row["airlines_name"]; ?></p>
                                    <a href="#" class="btn btn-warning">Book Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <?php include '../MJ/layout/Footer.php'; ?>
        </body>
        </html>
        <?php
    } else {
        echo "No flights available.";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // If the form is not submitted via GET, handle the error accordingly
    echo "Error: Form submission method not allowed.";
}
?>
