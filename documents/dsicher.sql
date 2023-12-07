-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2023 at 11:56 AM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsicher`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `cash` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `user`, `password`, `creation_date`, `cash`) VALUES
(1, 'MonkeyKing', '$2y$10$QDaaBQEj4ai62A70lMVQgedTt3VTfnN/FG/q/hkLVBhFaTiUli.5W', '2023-11-09', '10000.00'),
(5, 'test1', '$2y$10$QDaaBQEj4ai62A70lMVQgedTt3VTfnN/FG/q/hkLVBhFaTiUli.5W', '2023-11-13', '1000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `account_value`
-- (See below for the actual view)
--
CREATE TABLE `account_value` (
`accVal` decimal(35,2)
,`id` int(11)
,`aDate` date
);

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `lot_num` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ticker` varchar(4) DEFAULT NULL,
  `num_shares` decimal(6,0) DEFAULT NULL,
  `purchase_price` decimal(6,2) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`lot_num`, `id`, `ticker`, `num_shares`, `purchase_price`, `purchase_date`) VALUES
(16, 1, 'AAPL', '10', '186.70', '2023-11-10'),
(17, 1, 'AAPL', '10', '182.10', '2023-11-11'),
(19, 1, 'NVDA', '10', '486.20', '2023-11-13'),
(29, 1, 'AMZN', '10', '143.35', '2023-11-12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `lot_value`
-- (See below for the actual view)
--
CREATE TABLE `lot_value` (
`TotalValue` decimal(12,2)
,`ticker` varchar(4)
,`Price` decimal(6,2)
,`Previous` decimal(6,2)
,`Shares` decimal(6,0)
,`Basis` decimal(12,2)
,`Lot` int(11)
,`LotOwner` int(11)
,`l_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `price_history`
--

CREATE TABLE `price_history` (
  `price_date` date NOT NULL,
  `ticker` varchar(4) NOT NULL,
  `price` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_history`
--

INSERT INTO `price_history` (`price_date`, `ticker`, `price`) VALUES
('2023-11-10', 'AAPL', '186.70'),
('2023-11-10', 'AMD', '125.53'),
('2023-11-10', 'AMZN', '146.13'),
('2023-11-10', 'NVDA', '485.89'),
('2023-11-11', 'AAPL', '182.10'),
('2023-11-11', 'AMD', '123.78'),
('2023-11-11', 'AMZN', '144.66'),
('2023-11-11', 'NVDA', '481.77'),
('2023-11-12', 'AAPL', '183.50'),
('2023-11-12', 'AMD', '117.46'),
('2023-11-12', 'AMZN', '143.35'),
('2023-11-12', 'NVDA', '483.56'),
('2023-11-13', 'AAPL', '184.80'),
('2023-11-13', 'AMD', '116.79'),
('2023-11-13', 'AMZN', '142.59'),
('2023-11-13', 'NVDA', '486.20'),
('2023-11-14', 'AAPL', '187.44'),
('2023-11-14', 'AMD', '119.88'),
('2023-11-14', 'AMZN', '145.80'),
('2023-11-14', 'NVDA', '496.56'),
('2023-11-15', 'AAPL', '188.01'),
('2023-11-15', 'AMD', '118.00'),
('2023-11-15', 'AMZN', '143.20'),
('2023-11-15', 'NVDA', '488.88'),
('2023-11-16', 'AAPL', '189.71'),
('2023-11-16', 'AMD', '119.83'),
('2023-11-16', 'AMZN', '142.83'),
('2023-11-16', 'NVDA', '494.80'),
('2023-11-17', 'AAPL', '189.69'),
('2023-11-17', 'AMD', '120.62'),
('2023-11-17', 'AMZN', '145.18'),
('2023-11-17', 'NVDA', '492.98');

-- --------------------------------------------------------

--
-- Stand-in structure for view `price_movement`
-- (See below for the actual view)
--
CREATE TABLE `price_movement` (
`ticker` varchar(4)
,`price` decimal(6,2)
,`pDate` date
,`one_day` decimal(6,2)
,`three_day` decimal(6,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `ticker` varchar(5) NOT NULL,
  `company_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ticker`, `company_name`) VALUES
('AAPL', 'Apple'),
('AMD', 'Advanced Micro Devices'),
('AMZN', 'Amazon'),
('NVDA', 'Nvidia');

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_prices`
-- (See below for the actual view)
--
CREATE TABLE `stock_prices` (
`ticker` varchar(4)
,`CurrentPrice` decimal(6,2)
);

-- --------------------------------------------------------

--
-- Structure for view `account_value`
--
DROP TABLE IF EXISTS `account_value`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsicher`@`localhost` SQL SECURITY DEFINER VIEW `account_value`  AS  select if(`lot_value`.`TotalValue` is not null,sum(`lot_value`.`TotalValue`) + `account`.`cash`,`account`.`cash`) AS `accVal`,`account`.`id` AS `id`,`lot_value`.`l_date` AS `aDate` from (`account` left join `lot_value` on(`lot_value`.`LotOwner` = `account`.`id`)) group by `account`.`id`,`lot_value`.`l_date` ;

-- --------------------------------------------------------

--
-- Structure for view `lot_value`
--
DROP TABLE IF EXISTS `lot_value`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsicher`@`localhost` SQL SECURITY DEFINER VIEW `lot_value`  AS  select `lots`.`num_shares` * `stockStats`.`currentPrice` AS `TotalValue`,`lots`.`ticker` AS `ticker`,`stockStats`.`currentPrice` AS `Price`,`stockStats`.`Yesterday` AS `Previous`,`lots`.`num_shares` AS `Shares`,`lots`.`num_shares` * `lots`.`purchase_price` AS `Basis`,`lots`.`lot_num` AS `Lot`,`lots`.`id` AS `LotOwner`,`stockStats`.`pDate` AS `l_date` from (`lots` join (select `p`.`ticker` AS `ticker`,`p`.`price` AS `currentPrice`,`p`.`price_date` AS `pDate`,`o`.`price` AS `Yesterday` from (`price_history` `p` left join `price_history` `o` on(`o`.`price_date` = `p`.`price_date` - interval 1 day and `p`.`ticker` = `o`.`ticker`))) `stockStats` on(`lots`.`ticker` = `stockStats`.`ticker`)) where `lots`.`purchase_date` <= `stockStats`.`pDate` ;

-- --------------------------------------------------------

--
-- Structure for view `price_movement`
--
DROP TABLE IF EXISTS `price_movement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsicher`@`localhost` SQL SECURITY DEFINER VIEW `price_movement`  AS  select `day_history`.`Ticker` AS `ticker`,`day_history`.`today` AS `price`,`day_history`.`pDate` AS `pDate`,`day_history`.`yesterday` AS `one_day`,`t`.`price` AS `three_day` from (((select `p`.`ticker` AS `Ticker`,`p`.`price` AS `today`,`p`.`price_date` AS `pDate`,`o`.`price` AS `yesterday` from (`price_history` `p` left join `price_history` `o` on(`o`.`price_date` = `p`.`price_date` - interval 1 day and `p`.`ticker` = `o`.`ticker`)))) `day_history` left join `price_history` `t` on(`t`.`price_date` = `day_history`.`pDate` - interval 3 day and `t`.`ticker` = `day_history`.`Ticker`)) ;

-- --------------------------------------------------------

--
-- Structure for view `stock_prices`
--
DROP TABLE IF EXISTS `stock_prices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dsicher`@`localhost` SQL SECURITY DEFINER VIEW `stock_prices`  AS  select `price_history`.`ticker` AS `ticker`,`price_history`.`price` AS `CurrentPrice` from `price_history` where `price_history`.`price_date` = '2023-11-17' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`lot_num`,`id`),
  ADD KEY `id` (`id`),
  ADD KEY `ticker` (`ticker`);

--
-- Indexes for table `price_history`
--
ALTER TABLE `price_history`
  ADD PRIMARY KEY (`price_date`,`ticker`),
  ADD KEY `ticker` (`ticker`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`ticker`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `lot_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`ticker`) REFERENCES `stocks` (`ticker`);

--
-- Constraints for table `price_history`
--
ALTER TABLE `price_history`
  ADD CONSTRAINT `price_history_ibfk_1` FOREIGN KEY (`ticker`) REFERENCES `stocks` (`ticker`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
