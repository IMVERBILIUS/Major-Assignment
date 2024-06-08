<?php
include_once('db_connect.php');

// Sanitize and validate input
$flight_origin = filter_input(INPUT_GET, 'flight_origin', FILTER_SANITIZE_STRING);
$flight_destination = filter_input(INPUT_GET, 'flight_destination', FILTER_SANITIZE_STRING);
$flight_date = filter_input(INPUT_GET, 'flight_date', FILTER_SANITIZE_STRING);
$return_date = filter_input(INPUT_GET, 'return_date', FILTER_SANITIZE_STRING);
$trip_type = filter_input(INPUT_GET, 'trip_type', FILTER_SANITIZE_STRING);

if ($trip_type == 'one-way') {
    $query = "
        SELECT flight_result.*, airlines.name as airline_name 
        FROM flight_result 
        JOIN airlines ON flight_result.airlines_id = airlines.airlines_id 
        WHERE flight_origin = ? AND flight_destination = ? AND flight_date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $flight_origin, $flight_destination, $flight_date);
} else {
    $query = "
        SELECT flight_result.*, airlines.name as airline_name 
        FROM flight_result 
        JOIN airlines ON flight_result.airlines_id = airlines.airlines_id 
        WHERE flight_origin = ? AND flight_destination = ? AND flight_date = ? AND return_date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $flight_origin, $flight_destination, $flight_date, $return_date);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Results</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .results-table {
            margin: 20px 0;
        }
        .results-table th, .results-table td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Flight Results</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped results-table">
                <thead>
                    <tr>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Departure Date</th>
                        <?php if ($trip_type == 'round'): ?>
                            <th>Return Date</th>
                        <?php endif; ?>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Airline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['flight_origin']); ?></td>
                            <td><?php echo htmlspecialchars($row['flight_destination']); ?></td>
                            <td><?php echo htmlspecialchars($row['flight_date']); ?></td>
                            <?php if ($trip_type == 'round'): ?>
                                <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                            <?php endif; ?>
                            <td><?php echo htmlspecialchars($row['flight_duration']); ?></td>
                            <td>$<?php echo htmlspecialchars($row['flight_price']); ?></td>
                            <td><?php echo htmlspecialchars($row['airline_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No flights found matching your criteria.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Back to Search</a>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
        });
    </script>
</body>
</html>
