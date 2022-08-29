-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 02:56 PM
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
-- Database: `sparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_number` varchar(20) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `exp_date` varchar(50) NOT NULL,
  `provider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_image`, `product_number`, `product_name`, `category_name`, `product_price`, `added_date`, `exp_date`, `provider`) VALUES
(44, '49', 'contentsdfdsinfo.autozone.webp', '1', ' Duralast Four Wheel Drive Actuators SW9290', 'Volvo', '88', '27/04/2022 02:37AM', '27/04/2022 02:42AM', ''),
(43, '49', 'contedsfgsdntinfo.autozone.webp', '1', ' Plasticolor Red R Racing Sport Steering Wheel Cover', 'Jeep', '555', '27/04/2022 02:37AM', '27/04/2022 02:42AM', ''),
(35, '41', 'contensdfdstinfo.autozone.webp', '3', ' Duralast Gold Alternator DLG3512-18-10', 'Volvo', '1665', '27/04/2022 02:53AM', '27/04/2022 02:58AM', ''),
(33, '41', 'contentinfo.autozone.webp', '1', ' Duralast Gold Alternator DLG2642-8-10', 'Nissan', '122', '27/04/2022 02:55AM', '27/04/2022 03:00AM', '');

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
(21, 'Customer', 'admin', 'customer@email.com', 'Message from message page ', 'This is sent from message page ', NULL, 'Not answered'),
(22, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Hello there ', 'Hey ', NULL, 'Not answered'),
(23, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Test ', 'Test', NULL, 'Not answered'),
(24, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Hey ', 'Hey', NULL, 'Not answered'),
(25, 'admin', 'admin', 're.s.alobaid@gmail.com', 'Hey ', 'Hey ', NULL, 'Not answered'),
(26, 'Suha ', 'admin', 'Suha@email.com', 'I want to open provider account ', 'Hello admin, \r\n\r\nCould you tell what are the requirements to open a provider account? \r\n\r\nThanks  ', NULL, 'No answer');

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
(33, ' Duralast Gold Alternator DLG2642-8-10', 22, 'contentinfo.autozone.webp', 'Nissan', '122', 'approved', 'admin'),
(34, ' Duralast Gold Alternator DLG5504-6', 320, 'contentisdfsdnfo.autozone.webp', 'Jeep', '444', 'approved', 'admin'),
(35, ' Duralast Gold Alternator DLG3512-18-10', 34, 'contensdfdstinfo.autozone.webp', 'Volvo', '555', 'approved', 'admin'),
(36, ' Duralast Brake Rotor 77122DL', 43, 'contentfdgfsdinfo.autozone.webp', 'Chevrolet', '666', 'approved', 'reham'),
(37, ' Duralast Gold Starter DLG3236S', 34, 'fgfdgfdg.webp', 'Nissan', '4544', 'approved', 'admin'),
(38, ' Duralast Wheel Bearing/Hub Assembly DL513339', 43, 'dfsgdsfgs.webp', 'Jeep', '433', 'approved', 'admin'),
(39, ' ACDelco Front Wheel Drive Motor Mount 13227719', 44, 'contentdsfgsdinfo.autozone.webp', 'Honda', '443', 'approved', 'admin'),
(40, ' Continental/VDO A/C Heater Blower Motor Wheel PM4638', 44, 'contendfdstinfo.autozone.jpg', 'Chevrolet', '555', 'approved', 'admin'),
(41, ' Keystone Collision Wheel ALY02399U90', 86, 'contesdfdsfntinfo.autozone.webp', 'Honda', '888', 'approved', 'admin'),
(42, ' AutoSmart 16in Plastic Hubcap', 65, 'contentinfo.autozonfdgfsde.webp', 'BMW', '666', 'approved', 'reham'),
(43, ' Plasticolor Red R Racing Sport Steering Wheel Cover', 52, 'contedsfgsdntinfo.autozone.webp', 'Jeep', '555', 'approved', 'reham'),
(44, ' Duralast Four Wheel Drive Actuators SW9290', 9, 'contentsdfdsinfo.autozone.webp', 'Volvo', '88', 'approved', 'reham');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_prand` varchar(50) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_number` varchar(50) NOT NULL,
  `product_status` varchar(50) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `exp_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `user_id`, `product_id`, `product_name`, `product_image`, `product_prand`, `product_price`, `product_number`, `product_status`, `tracking_number`, `added_date`, `exp_date`) VALUES
(52, '41', '36', ' Duralast Brake Rotor 77122DL', 'contentfdgfsdinfo.autozone.webp', 'Chevrolet', '666', '1', 'true', '6987177934', '25/04/2022 05:43PM', '25/04/2022 05:48PM'),
(53, '52', '36', ' Duralast Brake Rotor 77122DL', 'contentfdgfsdinfo.autozone.webp', 'Chevrolet', '666', '1', 'true', '4412573867', '26/04/2022 05:50PM', '26/04/2022 05:55PM'),
(54, '41', '36', ' Duralast Brake Rotor 77122DL', 'contentfdgfsdinfo.autozone.webp', 'Chevrolet', '666', '1', 'true', '4372624507', '27/04/2022 02:46AM', '27/04/2022 02:51AM'),
(55, '41', '44', ' Duralast Four Wheel Drive Actuators SW9290', 'contentsdfdsinfo.autozone.webp', 'Volvo', '88', '1', 'true', '4414864719', '27/04/2022 02:46AM', '27/04/2022 02:51AM'),
(56, '41', '43', ' Plasticolor Red R Racing Sport Steering Wheel Cov', 'contedsfgsdntinfo.autozone.webp', 'Jeep', '555', '1', 'true', '1819635654', '27/04/2022 02:46AM', '27/04/2022 02:51AM'),
(57, '41', '42', ' AutoSmart 16in Plastic Hubcap', 'contentinfo.autozonfdgfsde.webp', 'BMW', '666', '1', 'true', '1960120522', '27/04/2022 02:46AM', '27/04/2022 02:51AM');

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
  `address` varchar(50) NOT NULL,
  `sec_question` varchar(255) NOT NULL,
  `sec_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `email`, `mobile`, `address`, `sec_question`, `sec_answer`) VALUES
(2, 'admin', '123456', 'admin', 're.s.alobaid@gmail.com', '0123456789', '127.0.0.1', '', ''),
(4, 'reham', '123456', 'provider', 'reham@gmail.com', '6985786590', 'ksa', '', ''),
(26, 'Sara', '12345', 'customer', 'er@gmail.com', '0', '', '', ''),
(29, 'heba', '123', 'customer', 'heba@f.com', '0505050505', 'Ryiadh, Aqiq', '', ''),
(41, 'Customer', '123456', 'customer', 'customer@email.com', '', '', '', ''),
(42, 'Maha', '123456', 'provider', 'maha@email.com', '', '', '', ''),
(47, 'customer', 'Ab123456789!', 'customer', 'customer@a.com', '0123456789', 'Riyadh', '', ''),
(48, 'Maha ', 'Xx123456789!', 'customer', 'Maha@email.com', '0123456789', 'Riyadh', '', ''),
(49, 'Reem', 'Reem!123456', 'customer', 'reem@gmail.com', '0123456789', 'Riyadh', 'What was your first car?', 'BMW'),
(50, 'Amal', 'Amal!123456', 'customer', 'Amal@gmail.com', '0123456789', 'Riyadh', 'What was your first car?', 'Amal'),
(51, 'Raghad', 'Ra!123456789', 'customer', 'Raghad@email.com', '', 'Riyadh', 'What was your first car?', 'Ford'),
(52, 'Suha', 'Suha!147147', 'customer', 'Suha@email.com', '0123456789', 'Dammam', 'What was your first car?', 'Ford'),
(53, 'Noura ', 'Noura!147147', 'customer', 'Noura@email.com', '0123456789', 'Riyadh', 'What city were you born in?', 'Riyadh'),
(54, 'Reem147', 'Reem!147147', 'customer', 'Reem@email.com', '0123456789', 'Jeddah', 'What was your favorite food as a child', 'Nothing specific'),
(56, 'Rawan ', 'Ra!147147', 'provider', 'Rawan@ACDelco.com', '0123456789', 'Riyadh', 'What was your first car?', 'GMC'),
(58, 'Haya', 'Haya!147147', 'provider', 'Haya@aps.com', '0123456789', 'Riyadh', 'What was your first car?', 'Chevy Malibu '),
(59, 'Provider', 'Pa!147147', 'provider', 'provider@email.com', '0123456789', 'Riyadh', 'What was your first car?', 'JEEP');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
