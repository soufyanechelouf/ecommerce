-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2022 at 01:21 PM
-- Server version: 8.0.28
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int DEFAULT NULL,
  `Visibility` tinyint NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint NOT NULL DEFAULT '0',
  `image` varchar(225) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT 'images/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`, `image`) VALUES
(11, 'Refrigerateur', 'refrigerateur tres puissant de haute gamme', 1, 0, 0, 0, 'images/default.jpg'),
(12, 'Lave-linge', 'here a small description of this ccategory', 2, 0, 0, 0, 'images/default.jpg'),
(13, 'climatiseur', 'here a small description of this category', 3, 0, 0, 0, 'images/default.jpg'),
(14, 'Lave-vaisselle', 'here a small description of this category', 4, 0, 0, 0, 'images/default.jpg'),
(15, 'TVs', 'here a small description of this category', 6, 0, 0, 0, 'images/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint NOT NULL,
  `Approve` tinyint NOT NULL DEFAULT '1',
  `Cat_ID` int NOT NULL,
  `Member_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(1, 'brandt1 freeze', 'its a small describtion about this ', '25000', '2020-01-02', 'germany', 'layout/images/r1.png', '1', 0, 1, 11, 1),
(2, 'smart screen 45\"', 'its a small describtion about this product', '70', '2020-01-02', 'korea', 'layout/images/s3.jpg', '5', 0, 1, 15, 1),
(3, 'rzerzeaz', 'erazer', '8965', '2020-01-02', 'germany', 'layout/images/r2.png', '1', 0, 1, 11, 1),
(4, 'aspirev5', 'zeazeaz', '452000', '2020-01-02', 'germany brandt', 'layout/images/r3.png', '1', 1, 1, 11, 1),
(5, 'azzea', 'eezeaz', '46566', '2020-01-02', 'germany', 'layout/images/r4.jpg', 'brandt', 0, 1, 11, 1),
(6, 'LG climatiseur 12000 BTU', 'LG climatiseur 12000 BTU robuste et bon', '300', '2020-01-02', 'korea', 'layout/images/cl1.jpg', '5', 0, 1, 13, 1),
(7, 'climatiseur samsung 1800 BTU', 'climatiseur samsung 1800 BTU un des solide azerty azery', '350', '2020-01-02', 'japan', 'layout/images/cl2.jpg', '8', 0, 1, 13, 1),
(8, 'frezzer Toshiba 6000 BTU', 'frezzer Toshiba 6000 BTU a small decscription about it', '150', '2020-01-02', 'korea', 'layout/images/cl1.jpg', '4', 0, 1, 13, 1),
(9, 'brandt machine a laver', ' this is a smal description about brandt machine a laver', '300', '2020-01-02', 'france', 'layout/images/l5.jpg', 'brandt', 0, 1, 12, 1),
(10, 'lave linge starlight 350V', ' this is a smal description about lave linge starlight 350v', '400', '2020-01-02', 'algerie', 'layout/images/l4.jpg', '6', 1, 1, 12, 1),
(11, 'lg lave linge hyper 5g X Turbo', ' this is a smal description about lg hyper', '500', '2020-01-02', 'japan', 'layout/images/l3.png', '5', 0, 1, 12, 1),
(12, 'toshiba lave vaissele clean25', ' this is a smal description about toshiba lave vaissele clean25', '600', '2020-01-02', 'japan', 'layout/images/lv1.jpg', '4', 0, 1, 14, 1),
(13, 'eniem clean vaissele', ' this is a smal description about eniem clean', '400', '2020-01-02', 'algerie', 'layout/images/lv2.jpg', '3', 0, 1, 14, 1),
(14, 'LG cleaner G6 Smart OS', ' this is a smal description about G6 azerty azerty', '550', '2020-01-02', 'korea', 'layout/images/lv3.jpg', '5', 0, 1, 14, 1),
(15, 'starlight lave vaissele total S9', ' this is a smal description about starlight s9 azeryy azeerty', '400', '2020-01-02', 'algerie', 'layout/images/lv1.jpg', '6', 0, 1, 14, 1),
(16, 'starlight 40\" smart', ' this is a smal description about ', '50', '2020-01-02', 'algerie', 'layout/images/s2.jpg', '6', 0, 1, 15, 1),
(17, 'lg screen tv curve 60\"', 'this is a small description about azertyazerty', '80', '2020-01-02', 'korea', 'layout/images/s3.jpg', '5', 1, 1, 15, 1),
(18, 'brandt tv 55\" HD', 'this is a smal azerty azerty', '55', '2020-01-02', 'france', 'layout/images/s2.jpg', 'brandt', 1, 1, 15, 1),
(19, 'lave linge LG g9 power factor', 'this is a smal des azerty azerty azerty azeert', '500', '2020-01-02', 'japan', 'layout/images/l4.jpg', '5', 1, 1, 12, 1),
(20, 'air conditioner brandt 12000 BTU', 'this is a small azerty azerty aazert', '3000', '2020-01-02', 'france', 'layout/images/cl22.jpg', 'brandt', 0, 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `userid` int DEFAULT NULL,
  `itemid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL COMMENT 'to identify user',
  `Username` varchar(255) NOT NULL COMMENT 'username to login',
  `Password` varchar(255) NOT NULL COMMENT 'password to login',
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupeID` int NOT NULL DEFAULT '0',
  `TrustStatus` int NOT NULL DEFAULT '0' COMMENT 'Seller rank',
  `RegStatus` int NOT NULL DEFAULT '1' COMMENT 'UserAproval',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupeID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(1, 'sofnet', 'd954de0dd0269e2f2bccd25b0f340ad0fcc15ff3', 'sofnetby@gmail.com', 'chelouf soufyane', 1, 0, 1, '0000-00-00'),
(2, 'gamal', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'gamal@gmail.com', 'gamal ahmad', 0, 0, 1, '0000-00-00'),
(4, 'ihab', '0df4ab017385e9aa3324400d725f59ea31c57132', 'karim@gmail.com', 'karim amin', 0, 0, 1, '0000-00-00'),
(5, 'amino', 'c7f3965f622c375a5d4c6fc4b0774462f88cbc39', 'amio@gfd.com', 'amino', 0, 0, 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `cmment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT COMMENT 'to identify user', AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `cmment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
