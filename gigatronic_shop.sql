-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 11:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gigatronic_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `idAnswer` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `idPoll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`idAnswer`, `answer`, `idPoll`) VALUES
(1, 'Equipment', 1),
(2, 'Phones', 1),
(3, 'Computers', 1),
(4, 'Cooking', 2),
(5, ' Programming', 2),
(6, ' Sport', 2),
(7, 'Samsung J2', 3),
(8, ' Laptop bag', 3),
(9, ' Shaomi watch', 3);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `idArticle` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `newImage` varchar(255) DEFAULT NULL,
  `alt` varchar(255) NOT NULL,
  `idCategory` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArticle`, `name`, `description`, `price`, `image`, `newImage`, `alt`, `idCategory`) VALUES
(31, 'Anker Chrager', 'Charger ', 75.00, 'assets/img/shop/1702939401_anker-charger.jpg', 'assets/img/shop/1702939401_anker-charger.jpg', 'Charger', 1),
(32, 'HP Notebook', 'HP Laptop', 800.00, 'assets/img/shop/1702939775_hp-notebook.jpg', 'assets/img/shop/1702939775_hp-notebook.jpg', 'HP', 3),
(33, 'Invicta Pro', 'Invicta Casual Watch', 713.00, 'assets/img/shop/1702939804_invicta-pro.jpg', 'assets/img/shop/1702939804_invicta-pro.jpg', 'Watch', 1),
(34, 'Laptop Bag', 'Bag', 13.00, 'assets/img/shop/1702939851_laptop-bag.jpg', 'assets/img/shop/1702939851_laptop-bag.jpg', 'Bag', 1),
(35, 'LED Solar', 'LEDa', 212.00, 'assets/img/shop/1702939869_LED-solar.jpg', 'assets/img/shop/1702939869_LED-solar.jpg', 'LED', 1),
(36, 'T44 Mobile Phone', 'Mobile Phone Panasonic', 195.00, 'assets/img/shop/1702939894_panasonic-t44.jpg', 'assets/img/shop/1702939894_panasonic-t44.jpg', 'Mobile', 2),
(37, 'J2 Samsung', 'Mobile Samsung J2', 245.00, 'assets/img/shop/1702939927_samsungJ2.jpg', 'assets/img/shop/1702939927_samsungJ2.jpg', 'J2', 2),
(38, 'Headpones Sony', 'Sony Headset', 123.00, 'assets/img/shop/1702939947_sony-headset.jpg', 'assets/img/shop/1702939947_sony-headset.jpg', 'Headset', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int(30) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCategory`, `name`) VALUES
(1, 'Equipment'),
(2, 'Phones'),
(3, 'Computers');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `idOrder` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `orderStatus` enum('not processed','in preparation','sent','delivered') NOT NULL,
  `orderedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`idOrder`, `idUser`, `totalAmount`, `orderStatus`, `orderedAt`) VALUES
(2, 2, 3200.00, 'not processed', '2023-12-25 14:46:01'),
(3, 4, 1253.00, 'in preparation', '2023-12-25 15:31:41'),
(4, 4, 800.00, 'sent', '2023-12-25 16:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(30) NOT NULL,
  `menuLink` varchar(255) NOT NULL,
  `menuText` varchar(255) NOT NULL,
  `idMenuGroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `menuLink`, `menuText`, `idMenuGroup`) VALUES
(1, 'home', 'Home', 1),
(2, 'articles', 'Articles', 1),
(3, 'contact', 'Contact', 1),
(4, 'cart', 'Cart', 2),
(5, 'poll', 'Poll', 2),
(6, 'adminDashboard', 'Admin Dashboard', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `idMenuGroup` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`idMenuGroup`, `name`) VALUES
(1, 'all_users'),
(2, 'authorized_users'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `idOrderItems` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`idOrderItems`, `idOrder`, `idArticle`, `quantity`, `price`) VALUES
(2, 2, 32, 4, 800.00),
(3, 3, 31, 2, 75.00),
(4, 3, 36, 2, 195.00),
(5, 3, 33, 1, 713.00),
(6, 4, 32, 1, 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `idPoll` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`idPoll`, `question`, `active`) VALUES
(1, 'What do you prefer to buy?', b'1'),
(2, 'What do you do in free time?', b'0'),
(3, 'Your favorite article?', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idRole`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` bit(1) NOT NULL,
  `dateRegistration` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime DEFAULT current_timestamp(),
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `firstName`, `lastName`, `email`, `username`, `password`, `active`, `dateRegistration`, `dateModified`, `idRole`) VALUES
(1, 'Marko', 'Gačanović', 'marko@gmail.com', 'marko', 'c6c0d95e21b180ce7cd28ee7ced3c09a', b'1', '2023-12-19 15:39:47', '2023-12-20 14:51:11', 1),
(2, 'Sofija', 'Jovanovic', 'sofija@gmail.com', 'sofija', '3ffce8b5dc9b332323170b56dbfc0692', b'1', '2023-12-20 20:41:25', '2023-12-20 20:41:25', 2),
(3, 'Ivan', 'Gacanovic', 'ivan@gmail.com', 'ivan', 'fc4fbc062821bcc05d785042756a522f', b'1', '2023-12-23 14:18:18', '2023-12-23 14:18:18', 1),
(4, 'Petar', 'Markovic', 'pera@gmail.com', 'pera', '84ffab222c2cdb1c32cdae09f9907400', b'1', '2023-12-25 15:31:00', '2023-12-25 15:31:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `idVoting` int(11) NOT NULL,
  `idAnswer` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`idVoting`, `idAnswer`, `idUser`) VALUES
(1, 1, 3),
(2, 7, 2),
(3, 2, 4),
(4, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`idAnswer`),
  ADD KEY `idPoll` (`idPoll`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`),
  ADD KEY `idMenuGroup` (`idMenuGroup`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`idMenuGroup`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`idOrderItems`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`idPoll`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idRole` (`idRole`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`idVoting`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idAnswer` (`idAnswer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `idAnswer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `idMenuGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `idOrderItems` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `idPoll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `idVoting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`idPoll`) REFERENCES `poll` (`idPoll`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`);

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`idMenuGroup`) REFERENCES `menu_group` (`idMenuGroup`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `customer_order` (`idOrder`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`);

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`idAnswer`) REFERENCES `answer` (`idAnswer`),
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
