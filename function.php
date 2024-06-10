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

function insertPassenger($data) {
    global $conn;
    
    // Escape and retrieve data from the $data array
    $passenger_name = mysqli_real_escape_string($conn, $data["passenger_name"] ?? "");
    $passenger_contact = mysqli_real_escape_string($conn, $data["passenger_contact"] ?? "");
    $passenger_email = mysqli_real_escape_string($conn, $data["passenger_email"] ?? "");
    $passenger_date_birth = mysqli_real_escape_string($conn, $data["passenger_date_birth"] ?? "");
    $nationality = mysqli_real_escape_string($conn, $data["nationality"] ?? "");
    $passport_number = mysqli_real_escape_string($conn, $data["passport_number"] ?? "");

    // Insert data into passenger table
    $sql_passenger = "INSERT INTO passenger (passenger_name, passenger_contact, passenger_email, passenger_date_birth, nationality, passport_number) VALUES ('$passenger_name', '$passenger_contact', '$passenger_email', '$passenger_date_birth', '$nationality', '$passport_number')";
    
    $result_passenger = mysqli_query($conn, $sql_passenger);
    
    if ($result_passenger) {
        // Retrieve auto-generated passenger_id
        $passenger_id = mysqli_insert_id($conn);

        // Insert data into booking table using the retrieved passenger_id
        $booking_date = mysqli_real_escape_string($conn, $data["booking_date"] ?? "");
        $flight_result_id = mysqli_real_escape_string($conn, $data["flight_result_id"] ?? "");
        $total = mysqli_real_escape_string($conn, $data["total"] ?? "");

        // Modify the query to use $passenger_id
        $sql_booking = "INSERT INTO booking (passenger_id, booking_date, flight_result_id, total) VALUES ('$passenger_id', '$booking_date', '$flight_result_id', '$total')";
        
        $result_booking = mysqli_query($conn, $sql_booking);
        
        if ($result_booking) {
            // Return the booking ID
            return mysqli_insert_id($conn);
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
