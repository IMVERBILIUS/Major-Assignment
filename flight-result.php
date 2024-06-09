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

    // Construct SQL query based on form data
    $sql = "SELECT fr.flight_result_id, fr.flight_date, fr.return_date, fr.flight_origin, fr.flight_destination, fr.flight_duration, fr.flight_price, al.airlines_name, al.airlines_images
            FROM flight_result fr
            INNER JOIN airlines al ON fr.airlines_id = al.airlines_id
            WHERE fr.flight_origin = '$flight_origin' AND fr.flight_destination = '$flight_destination' AND fr.flight_date = '$flight_date'
            ORDER BY fr.flight_price ASC"; // Added ORDER BY clause


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
            <style>
                /* Custom CSS to adjust layout */
                .card-body {
                    position: relative;
                }
                
                .flight-price-container {
                    position: absolute;
                    top: 35%;
                    right: 4%;
                    transform: translateY(-50%);
                }

                .flight-label {
                    font-weight: bold;
                    color: #FFA500;
                    font-size: large; /* Highlight color */
                }

                .flight-price {
                    font-size: 1.2em;
                    color: #FFA500; /* Highlight color */
                }
            </style>
        </head>
        <body>
            <?php include '../MJ/layout/Nav.php'; ?>

            <div class="container">
                <h2 class="mt-5 mb-4 text-center">Flight Details</h2>
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <img src="../MJ/img/<?php echo $row["airlines_images"]; ?>" class="mr-3 img-fluid" alt="<?php echo $row["airlines_name"]; ?>" style="width: 100px;">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $row["airlines_name"]; ?></h5>
                                            <p>
                                                From: <?php echo $row["flight_origin"]; ?> -- To: <?php echo $row["flight_destination"]; ?><br>
                                                Departure Time: <?php echo $row["flight_date"]; ?> ---- Duration: <?php echo $row["flight_duration"]; ?><br>
                                                Flight Number: <?php echo $row["flight_result_id"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Price label and Flight Price -->
                                    <div class="flight-price-container">
                                        <p class="flight-label">Price:</p>
                                        <p class="flight-price">$<?php echo number_format($row["flight_price"], 2, ',', '.'); ?></p>
                                    </div>
                                    <!-- Hidden input fields -->
                                    <form action="booking.php" method="post" class="text-center mt-3">
                                        <input type="hidden" name="flight_id" value="<?php echo $row["flight_result_id"]; ?>">
                                        <input type="hidden" name="flight_destination" value="<?php echo $row["flight_destination"]; ?>">
                                        <input type="hidden" name="flight_date" value="<?php echo $row["flight_date"]; ?>">
                                        <input type="hidden" name="return_date" value="<?php echo $row["return_date"]; ?>">
                                        <input type="hidden" name="flight_duration" value="<?php echo $row["flight_duration"]; ?>">
                                        <input type="hidden" name="flight_price" value="<?php echo $row["flight_price"]; ?>">
                                        <input type="hidden" name="airline_name" value="<?php echo $row["airlines_name"]; ?>">
                                        <!-- Book Now button -->
                                        <button type="submit" class="btn btn-warning mt-2">Book Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="row justify-content-center mt-4 mb-5">
                    <div class="col-md-6 text-center">
                        <a href="index.php" class="btn btn-warning">Go Back to Home</a>
                    </div>
                </div>
            </div>

            <?php include '../MJ/layout/Footer.php'; ?>
        </body>
        </html>
        <?php
    } else {
        echo "<div class='container text-center mt-5'><div class='alert alert-warning' role='alert'><h4 class='alert-heading'>No flights available</h4><p>Sorry, we couldn't find any flights that match your criteria. Please try again with different search parameters.</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // If the form is not submitted via GET, handle the error accordingly
    echo "<div class='container text-center mt-5'><div class='alert alert-danger' role='alert'><h4 class='alert-heading'>Error: Form submission method not allowed</h4><p>It looks like you're trying to access this page in an invalid way. Please go back to the home page and try again.</p><hr><a href='index.php' class='btn btn-warning'>Go Back to Home</a></div></div>";
}
?>
