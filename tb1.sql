-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 02:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airlines_id` int(10) NOT NULL,
  `airlines_name` varchar(50) DEFAULT NULL,
  `airlines_images` varchar(50) DEFAULT NULL,
  `airlines_contact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airlines_id`, `airlines_name`, `airlines_images`, `airlines_contact`) VALUES
(1, 'Air Asia', 'AirAsia.png', '093127123'),
(2, 'Batik Air', 'batik-air.png', '1235124'),
(3, 'Trans Nusa', 'trans-nusapng.png', '911'),
(4, 'Aero Dili', 'aero_dili.png', '*123#');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_id` int(10) NOT NULL,
  `airport_name` varchar(50) DEFAULT NULL,
  `city_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_id`, `airport_name`, `city_id`) VALUES
(1, 'JFK Airport', 1),
(2, 'LAX Airport', 2),
(3, 'ORD Airport', 3),
(4, 'IAH Airport', 4);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `flight_result_id` int(10) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `flight_result_id`, `total`) VALUES
(13, '2024-06-01', 5, 400.00),
(14, '2024-06-02', 6, 300.00),
(15, '2024-06-03', 7, 200.00),
(16, '2024-06-04', 8, 350.00);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(10) NOT NULL,
  `city_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'New York'),
(2, 'Los Angele'),
(3, 'Chicago'),
(4, 'Houston');

-- --------------------------------------------------------

--
-- Table structure for table `flight_result`
--

CREATE TABLE `flight_result` (
  `flight_result_id` int(10) NOT NULL,
  `flight_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `flight_origin` varchar(50) DEFAULT NULL,
  `flight_destination` varchar(50) DEFAULT NULL,
  `flight_duration` time DEFAULT NULL,
  `flight_price` decimal(10,2) DEFAULT NULL,
  `airlines_id` int(10) NOT NULL,
  `contry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_result`
--

INSERT INTO `flight_result` (`flight_result_id`, `flight_date`, `return_date`, `flight_origin`, `flight_destination`, `flight_duration`, `flight_price`, `airlines_id`, `contry_id`) VALUES
(5, '2024-06-10', '2024-06-19', 'New York', 'Los Angeles', '06:00:00', 350.00, 1, 1),
(6, '2024-06-11', '2024-06-19', 'Los Angeles', 'Chicago', '04:30:00', 250.00, 2, 2),
(7, '2024-06-12', '2024-06-18', 'Chicago', 'Houston', '03:00:00', 150.00, 3, 3),
(8, '2024-06-13', '2024-06-11', 'Houston', 'New York', '05:00:00', 300.00, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(11) NOT NULL,
  `passenger_name` varchar(255) DEFAULT NULL,
  `passenger_contact` int(11) DEFAULT NULL,
  `booking_id` int(10) NOT NULL,
  `passenger_email` varchar(255) DEFAULT NULL,
  `passenger_date_birth` date DEFAULT NULL,
  `nationality` varchar(11) DEFAULT NULL,
  `passport_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `passenger_name`, `passenger_contact`, `booking_id`, `passenger_email`, `passenger_date_birth`, `nationality`, `passport_number`) VALUES
(5, 'John Doe', 1234567890, 13, 'john@example.com', '1980-01-01', 'American', 987654321),
(6, 'Jane Smith', 2147483647, 14, 'jane@example.com', '1990-02-02', 'British', 876543210),
(7, 'Alice Johnson', 2147483647, 15, 'alice@example.com', '2000-03-03', 'Canadian', 765432109),
(8, 'Bob Brown', 2147483647, 16, 'bob@example.com', '1970-04-04', 'Australian', 654321098);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_booking`
--

CREATE TABLE `passenger_booking` (
  `passenger_id` int(11) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `passenger_name` varchar(50) DEFAULT NULL,
  `passenger_contact` int(11) DEFAULT NULL,
  `passenger_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger_booking`
--

INSERT INTO `passenger_booking` (`passenger_id`, `booking_id`, `passenger_name`, `passenger_contact`, `passenger_email`) VALUES
(1, 13, 'John Doe', 1234567890, 'john@example.com'),
(2, 14, 'Jane Smith', 2147483647, 'jane@example.com'),
(3, 15, 'Alice Johnson', 2147483647, 'alice@example.com'),
(4, 16, 'Bob Brown', 2147483647, 'bob@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `booking_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `amount`, `booking_id`) VALUES
(1, '2024-06-05', 400.00, 13),
(2, '2024-06-06', 300.00, 14),
(3, '2024-06-07', 200.00, 15),
(4, '2024-06-08', 350.00, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airlines_id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_id`),
  ADD KEY `FKairport267226` (`city_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `FKbooking952817` (`flight_result_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `flight_result`
--
ALTER TABLE `flight_result`
  ADD PRIMARY KEY (`flight_result_id`),
  ADD KEY `FKFlight_Res765791` (`contry_id`),
  ADD KEY `FKFlight_Res706376` (`airlines_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `FKpassenger722126` (`booking_id`);

--
-- Indexes for table `passenger_booking`
--
ALTER TABLE `passenger_booking`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `FKpassenger_693994` (`booking_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `FKpayment762427` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airlines_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `airport_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flight_result`
--
ALTER TABLE `flight_result`
  MODIFY `flight_result_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passenger_booking`
--
ALTER TABLE `passenger_booking`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airport`
--
ALTER TABLE `airport`
  ADD CONSTRAINT `FKairport267226` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FKbooking952817` FOREIGN KEY (`flight_result_id`) REFERENCES `flight_result` (`flight_result_id`);

--
-- Constraints for table `flight_result`
--
ALTER TABLE `flight_result`
  ADD CONSTRAINT `FKFlight_Res706376` FOREIGN KEY (`airlines_id`) REFERENCES `airlines` (`airlines_id`),
  ADD CONSTRAINT `FKFlight_Res765791` FOREIGN KEY (`contry_id`) REFERENCES `airport` (`airport_id`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `FKpassenger722126` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);

--
-- Constraints for table `passenger_booking`
--
ALTER TABLE `passenger_booking`
  ADD CONSTRAINT `FKpassenger_693994` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FKpayment762427` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
