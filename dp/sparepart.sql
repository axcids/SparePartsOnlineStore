-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 08:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_number` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `product_price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'BMW'),
(2, 'Chevrolet'),
(3, 'Honda'),
(4, 'Jeep'),
(5, 'Nissan'),
(6, 'Volvo');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(128) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` varchar(500) NOT NULL,
  `response` varchar(255) DEFAULT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `email`, `title`, `content`, `response`, `status`) VALUES
(1, 'Reham', '', '', 'first message', 'Hello there, this is the first message.', NULL, 'Answered'),
(2, '', '', '', 'First Test ', 'This message sent from the contact form ', NULL, 'Answered'),
(3, '', '', '', 'First Test ', 'This message sent from the contact form ', NULL, 'Answered'),
(4, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Urgent ', 'This will work now :)', 'Hello there, We have received your message and we would like to notify you that it did work. Thank you!', 'Answered'),
(5, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Regarding the air filters ', 'Hello, \r\n\r\nI ant to buy all the  stock of air filters. please contact me on my email ASAP.\r\n\r\nregards', NULL, 'Not answered'),
(6, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Regarding the Volvo wheels ', 'Hi, \r\n\r\nIs there any discounts on Volvo wheels?  ', '1111111', 'Answered'),
(7, 'Maha', '', 'maha@email.com', 'Regarding the front lights of BMW', 'Hello there, \r\n\r\nI want to buy all the stock of the BMW front lights. could you please contact me as soon as possible.   ', NULL, 'Answered'),
(9, 'admin', 'admin', 're.s.alobaid@gmail.com', '', '', NULL, 'Answered'),
(10, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Hello ', 'Hello', '123', 'Answered'),
(11, 'Customer', 'admin', 'customer@email.com', 'Hello there', 'I just want to know what is the model of the BMW engine presented on your product page?', '2011', 'Answered'),
(12, 'Customer', 'admin', 'customer@email.com', 'Query regarding the VOLVO wheels', 'Hello there, \r\n\r\nWhat is the year model of these wheels? ', '2018', 'Answered'),
(13, 'Customer', 'admin', 'customer@email.com', 'Query regarding ramadan discounts ', 'Hello there would be there any discounts for Ramadan month?', 'No', 'Answered'),
(18, 'Rama ', 'admin', 'Rama@gmail.com', 'Hello there ', 'Good Website!', NULL, 'Answered'),
(19, 'Haya ', 'admin', 'Haya@gmail.com', 'Wonderful ', 'What a wonderful website very helpful thank you for your effort', NULL, 'No answer'),
(20, 'Customer', 'admin', 'customer@email.com', 'Message from contact page ', 'This is a message from the contact page ', 'Ok (y)', 'Answered'),
(21, 'Customer', 'admin', 'customer@email.com', 'Message from message page ', 'This is sent from message page ', NULL, 'Not answered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_qty` int(100) NOT NULL,
  `product_image` varchar(128) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_by` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_qty`, `product_image`, `category_name`, `product_price`, `product_status`, `created_by`) VALUES
(3, 'front-lights', 19, 'bmw-front-lights.jpg', 'BMW', '500', 'approved', 'reham'),
(4, 'wheel Rim', 40, 'J1126-JXD-Brand.jpg', 'Volvo', '2000', 'approved', 'reham'),
(5, 'Jeep air filter', 24, 'WS-002-1-simota-air-filter-(1).jpg', 'Jeep', '1200', 'approved', 'Maha'),
(10, 'Honda Auto-clutch', 43, 'Auto-clutch.jpg', 'Honda', '100', 'approved', 'Maha'),
(11, 'BMW 5-series Engine', 0, 'BMW engine.jpg', 'BMW', '25000', 'approved', 'reham'),
(13, 'ALLGT-Front-Head-Light BMW-S1000RR-2010-2011-2012', 4, 'ALLGT-Front-Head-Light BMW-S1000RR-2010-2011-2012.jpg', 'BMW', '2000', 'approved', 'reham'),
(14, 'volvo ford 2012 tires', 4, 'volvo ford 2012 tires.jpg', 'Volvo', '1500', 'approved', 'reham'),
(15, 'Cooling Fan Clutch for Nissan  1998-2005 ', 5, 'Cooling Fan Clutch for Toyota Landcruiser 1998-2005.jpg', 'Nissan', '900', 'approved', 'reham'),
(16, 'Car Electric Parts jeep cruise control,', 2, 'Car Electric Parts Toyota cruise control,.jpg', 'Jeep', '600', 'approved', 'reham'),
(17, 'honda_waterpump1_b-series_19200-p30-003', 1, 'honda_waterpump1_b-series_19200-p30-003.jpg', 'Honda', '500', 'approved', 'reham'),
(18, 'Master Power Window Switch 225401JK40D Replacement for 2009-2012', 19, 'Master Power Window Switch 225401JK40D Replacement for 2009-2012 chevrolet.jpg', 'Chevrolet', '500', 'approved', 'Maha'),
(19, 'MITZONE Power Steering Pump With Pulley Compatible with Jeep JK 2012-2017', 10, 'MITZONE Power Steering Pump With Pulley Compatible with Jeep JK 2012-2017.jpg', 'Jeep', '4000', 'approved', 'Maha'),
(20, 'Interior Mouldings Car A Pillar Speaker Decoration Cover Sticker for Nissan F150 Raptor 2009-2014 ', 25, 'Interior Mouldings Car A Pillar Speaker Decoration Cover Sticker for Nissan F150 Raptor 2009-2014.jpg', 'Nissan', '970', 'approved', 'Maha'),
(21, 'ZERTRAN Replacement for Rear Windshield Wiper Arm With Blade Set 9L1Z17526A jeep', 33, 'ZERTRAN Replacement for Rear Windshield Wiper Arm With Blade Set 9L1Z17526A jeep.jpg', 'Jeep', '350', 'approved', 'Maha'),
(22, 'Engine Air Cleaner Intake Duct Hose Assembly For 05-17 Nissan Frontier 05-12 Pathfinder 05-15 Xterra', 12, 'Engine Air Cleaner Intake Duct Hose Assembly For 05-17 Nissan Frontier 05-12 Pathfinder 05-15 Xterra 4.0L.jpg', 'Nissan', '540', 'approved', 'Maha'),
(23, 'Rear Bumper Left + Right Spacer Brackets Support for 2006-2011 Honda Civic', 14, 'Rear Bumper Left + Right Spacer Brackets Support for 2006-2011 Honda Civic.jpg', 'Honda', '209', 'approved', 'Maha'),
(24, 'MOTORHOT Catalytic Converter 16641 Compatible With 2006 2007 2008 2009 2010 2011 Honda Civic 1.8L', 6, 'MOTORHOT Catalytic Converter 16641 Compatible With 2006 2007 2008 2009 2010 2011 Honda Civic 1.8L.jpg', 'Honda', '3500', 'approved', 'Maha'),
(25, 'Driver Side Master Power Window Switch 35750-SDA-H12 Replacement for Honda Accord Sedan 2003 2004 20', 8, 'Driver Side Master Power Window Switch 35750-SDA-H12 Replacement for Honda Accord Sedan 2003 2004 2005 2006 2007.jpg', 'Honda', '970', 'approved', 'Maha'),
(26, 'armrest for Nissan sunny 2013 and above without USB ports', 1, 'armrest for Nissan sunny 2013 and above without USB ports.jpg', 'Nissan', '1400', 'approved', 'Maha'),
(27, '2PCS Windshield Washer Spray Assembly Jet Nozzles,For Nissan Cefiro 28930-2Y900', 8, '2PCS Windshield Washer Spray Assembly Jet Nozzles,For Nissan Cefiro 28930-2Y900.jpg', 'Nissan', '530', 'approved', 'Maha'),
(28, 'XINYUE-TEC Fuel Injection Electronic Throttle Body Assembly for Jeep Grand Cherokee 200 300 ', 8, 'XINYUE-TEC Fuel Injection Electronic Throttle Body Assembly for Jeep Grand Cherokee 200 300.jpg', 'Jeep', '1500', 'approved', 'Maha'),
(29, 'Front Windshield Washer Fluid Spray Jet Nozzle Pair 55156728AB,For Jeep Wrangler 2012 2011 2010 2009', 5, 'Front Windshield Washer Fluid Spray Jet Nozzle Pair 55156728AB,For Jeep Wrangler 2012 2011 2010 2009 2008 2007 2006.jpg', 'Jeep', '200', 'approved', 'Maha'),
(30, 'Vapor Canister Purge Valve fit For Buick Cadillac CTS Chevrolet GMC Saturn', 6, 'Vapor Canister Purge Valve fit For Buick Cadillac CTS Chevrolet GMC Saturn.jpg', 'Chevrolet', '230', 'approved', 'reham'),
(31, 'YC Compatible with Chevrolet Tahoe 2007-2014 Replacement Head Lamp HEADLIGHT ASSEMBLY REPLACEMENT (L', 1, 'YC Compatible with Chevrolet Tahoe 2007-2014 Replacement Head Lamp HEADLIGHT ASSEMBLY REPLACEMENT (Left).jpg', 'Chevrolet', '300', 'approved', 'reham');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_prand` varchar(20) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_number` varchar(20) NOT NULL,
  `product_status` varchar(20) NOT NULL,
  `tracking_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `user_id`, `product_id`, `product_name`, `product_prand`, `product_price`, `product_number`, `product_status`, `tracking_number`) VALUES
(4, '29', '4', 'wheel Rim', 'Volvo', '2000', '1', 'true', '3215291340'),
(5, '29', '3', 'front-lights', 'BMW', '500', '1', 'false', '9065905027');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_type` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `email`, `mobile`, `address`) VALUES
(2, 'admin', '123456', 'admin', 're.s.alobaid@gmail.com', '0123456789', '127.0.0.1'),
(4, 'reham', '123456', 'provider', 'reham@gmail.com', '6985786590', 'ksa'),
(26, 'Sara', '12345', 'customer', 'er@gmail.com', '0', ''),
(29, 'heba', '123', 'customer', 'heba@f.com', '505050505', 'Ryiadh, Aqiq'),
(41, 'Customer', '123456', 'customer', 'customer@email.com', '', ''),
(42, 'Maha', '123456', 'provider', 'maha@email.com', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_name` (`category_name`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_name`) REFERENCES `companies` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
