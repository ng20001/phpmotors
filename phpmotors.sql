-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 11, 2021 at 07:10 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(9, 'FNAME', 'LNAME', 'asdf@asdf.com', '$2y$10$yRvxQJ2OJPjymfnl0T4Vuu6bscz3GrlBBbX9/Fh/vaDJej/iwLIGa', '3', NULL),
(10, 'Admin', 'User', 'admin@cse340.net', '$2y$10$ZuLm6royxtReK8QLhmo2reuwl1dy2ASX3WeqTxslaPPPyuczVicO2', '3', NULL),
(13, 'test', 'test', 'test@test.com', '$2y$10$cvLdAQFSqMUxIrIcTRGkJ.XF7PphYItWKxYo8.y0EzjyIq7M00UNK', '1', NULL),
(14, 'abc', 'abc', 'asd@asd.com', '$2y$10$GkPqMNg3NtMDaRWsCfEKi.g50KKoz3iGyqdzfPrk3FZK3MXvZVoBS', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(11) NOT NULL,
  `invId` int(10) NOT NULL,
  `imgName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(18, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-11-27 13:29:01', 1),
(19, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-11-27 13:29:01', 1),
(20, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-11-27 13:29:38', 1),
(21, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-11-27 13:29:38', 1),
(22, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-11-27 13:29:51', 1),
(23, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-11-27 13:29:51', 1),
(24, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-11-27 13:30:00', 1),
(25, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-11-27 13:30:00', 1),
(26, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-11-27 13:30:18', 1),
(27, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-11-27 13:30:18', 1),
(28, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-11-27 13:30:30', 1),
(29, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-11-27 13:30:30', 1),
(30, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-11-27 13:30:47', 1),
(31, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-11-27 13:30:47', 1),
(32, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-11-27 13:30:58', 1),
(33, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-11-27 13:30:58', 1),
(34, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-11-27 13:31:10', 1),
(35, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-11-27 13:31:10', 1),
(36, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-11-27 13:31:25', 1),
(37, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-11-27 13:31:25', 1),
(38, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-11-27 13:31:38', 1),
(39, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-11-27 13:31:38', 1),
(40, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-11-27 13:31:49', 1),
(41, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-11-27 13:31:49', 1),
(42, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-11-27 13:32:00', 1),
(43, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-11-27 13:32:00', 1),
(44, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-11-27 13:32:16', 1),
(45, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-11-27 13:32:16', 1),
(46, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-11-27 13:32:45', 1),
(47, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-11-27 13:32:45', 1),
(48, 37, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-11-27 13:38:38', 1),
(49, 37, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-11-27 13:38:38', 1),
(50, 11, 'escalade2.jpg', '/phpmotors/images/vehicles/escalade2.jpg', '2021-11-28 04:44:49', 0),
(51, 11, 'escalade2-tn.jpg', '/phpmotors/images/vehicles/escalade2-tn.jpg', '2021-11-28 04:44:49', 0),
(52, 12, 'hummer2.jpg', '/phpmotors/images/vehicles/hummer2.jpg', '2021-11-28 04:45:30', 0),
(53, 12, 'hummer2-tn.jpg', '/phpmotors/images/vehicles/hummer2-tn.jpg', '2021-11-28 04:45:30', 0),
(54, 1, 'wrangler2.jpg', '/phpmotors/images/vehicles/wrangler2.jpg', '2021-11-28 04:45:50', 0),
(55, 1, 'wrangler2-tn.jpg', '/phpmotors/images/vehicles/wrangler2-tn.jpg', '2021-11-28 04:45:50', 0),
(56, 1, '5eDEiYi.jpg', '/phpmotors/images/vehicles/5eDEiYi.jpg', '2021-11-29 01:35:26', 0),
(57, 1, '5eDEiYi-tn.jpg', '/phpmotors/images/vehicles/5eDEiYi-tn.jpg', '2021-11-29 01:35:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.&#39;&#39;', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(36, 'ABCMake', 'ABCModel', '123', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image.png', '0', 2, 'Black', 5),
(37, 'DMC', 'DeLorean', 'So fast its almost like traveling in time.', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '10000', 5, 'Grey', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) NOT NULL,
  `clientId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(13, '123', '2021-12-02 04:09:28', 11, 9),
(14, '123', '2021-12-02 12:05:52', 1, 14),
(15, '123', '2021-12-02 12:08:05', 1, 14),
(16, '456', '2021-12-02 12:16:05', 1, 9),
(18, 'testing', '2021-12-11 05:33:03', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_inventory` (`invId`),
  ADD KEY `FK_reviews_clients` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
