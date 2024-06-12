<?php

session_start();
include_once("db_connect.php");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
    }
    return $rows;   
}
function insertPayment($data) {
    global $conn;

    $amount = $data["amount"];
    $booking_id = $data["booking_id"];
    $payment_date = date("Y-m-d");

    $sql_insert_payment = "INSERT INTO payment (payment_date, amount, booking_id) 
                           VALUES ('$payment_date', '$amount', '$booking_id')";

    if (mysqli_query($conn, $sql_insert_payment)) {
        return true;
    } else {
        return mysqli_error($conn);
    }
}


function insertPassengers($data, $index) {
    global $conn;
    $booking_date = mysqli_real_escape_string($conn, $data["booking_date"] ?? "");
    $flight_result_id = mysqli_real_escape_string($conn, $data["flight_result_id"] ?? "");
    $total = mysqli_real_escape_string($conn, $data["total"] ?? "");

    $passenger_name = mysqli_real_escape_string($conn, $data["passenger_name"][$index] ?? "");
    $passenger_contact = mysqli_real_escape_string($conn, $data["passenger_contact"][$index] ?? "");
    $passenger_email = mysqli_real_escape_string($conn, $data["passenger_email"][$index] ?? "");
    $passenger_date_birth = mysqli_real_escape_string($conn, $data["passenger_date_birth"][$index] ?? "");
    $nationality = mysqli_real_escape_string($conn, $data["nationality"][$index] ?? "");
    $passport_number = mysqli_real_escape_string($conn, $data["passport_number"][$index] ?? "");

    // Insert data into passenger table
    $sql_passenger = "INSERT INTO passenger (passenger_name, passenger_contact, passenger_email, passenger_date_birth, nationality, passport_number) VALUES ('$passenger_name', '$passenger_contact', '$passenger_email', '$passenger_date_birth', '$nationality', '$passport_number')";
    
    $result_passenger = mysqli_query($conn, $sql_passenger);
    
    if ($result_passenger) {
        // Retrieve auto-generated passenger_id
        $passenger_id = mysqli_insert_id($conn);

        // Insert data into booking table using the retrieved passenger_id
        $sql_booking = "INSERT INTO booking (passenger_id, booking_date, flight_result_id, total) VALUES ('$passenger_id', '$booking_date', '$flight_result_id', '$total')";
        
        $result_booking = mysqli_query($conn, $sql_booking);
        
        if ($result_booking) {
            return mysqli_insert_id($conn); // Return the booking ID
        } else {
            // Error handling for booking table insertion
            echo "Error: " . mysqli_error($conn);
            return -1; // or any appropriate error code
        }
    } else {
        // Error handling for passenger table insertion
        echo "Error: " . mysqli_error($conn);
        return -1; // or any appropriate error code
    }
}
?>
