-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2020 at 04:03 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ProCure`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(5) NOT NULL,
  `customer_firstName` varchar(255) NOT NULL,
  `customer_lastName` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phoneNo` varchar(255) NOT NULL,
  `customer_billingAddress1` varchar(255) NOT NULL,
  `customer_billingAddress2` varchar(255) NOT NULL,
  `customer_shippingAddress1` varchar(255) NOT NULL,
  `customer_shippingAddress2` varchar(255) NOT NULL,
  `customer_teamName` varchar(255) NOT NULL,
  `customer_orgName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_phoneNo`, `customer_billingAddress1`, `customer_billingAddress2`, `customer_shippingAddress1`, `customer_shippingAddress2`, `customer_teamName`, `customer_orgName`) VALUES
(6, 'Samihan', 'Deshmukh', 'sami25@gmail.com', '123456877', 'Pune asdadfasgfhgj jhddsjvjifnvjfjdfnvlo', 'jsjddvnjkasfvn jkszmddvn jkaszsdkdv nsd ', 'jdkv nszdjzfcv sdzv sdzd xvsdzvx sdv sdv', 'sfz  rsgv rsgvsz sdds sadgv wrasdgv asdg', 'Kratos', 'PCCOE pune, Maharashtra.'),
(7, 'Shruti', 'Subhedar', 'shreyassubhedar@gmail.com', '+919158881202', 'plot No. 3, sector G,Devgiri Hills, Near BSNL office, ', 'Shivaji Nagar  431001 Abad', 'Same as billing address', '', 'RAKA', 'ICICI Bank.'),
(8, 'Shreyas', 'Subhedar', 'shreyassubhedar@gmail.com', '+919158881202', 'plot No. 3, sector G,Devgiri Hills, Near BSNL office,', 'Shivaji Nagar 431001 Abad.', 'Same as billing address', '', 'XO', 'JNEC Aurangabad.'),
(9, 'Sarang', 'Mohrir', 'sarang@gmail.com', '1234567890', 'Vinus Paani Puri , Aurangabad.dawdvwdvdd', 'advf  fz sdfzb sdf efv fx sdzx d xddx d ', 'Vinus Paani Puri , Aurangabad. asdFSAFSf', 'asdv vazsf avd awsvd dvx asz as asc w ww', 'Plomo Varta', 'SGGS , Nanded'),
(11, 'Sammer', 'Fuddi', 'sameer@gmail.com', '1234567890', 'plot No. 35 sector A,Priya Apartment , d', ' Navi Mumbai , Maharashtra. ', 'Same as billing address', '', 'Vatika', 'GECA'),
(12, 'Sanket', 'Khamitkar', 'sanketbhai@gmail.com', '1234567890', 'N K orchid college of Engineering Solapur ', 'xdghgdg dnhd  dfdgheg  dgdhgdh', 'Same as billing address', 'hhhh', 'Arkayanam', 'N K Orchid'),
(13, 'last', 'customer', 'sasada@db.cgj', '+91-9405147897', 'qewqqewrqererwqerwqerqewrqerqerqwerqrqer', 'qewqqewrqererwqerwqerqewrqerqerqwerqwwww', 'Same as billing address', '', 'afeae', 'efqefe'),
(14, 'Seeta', 'Pant', 'seetababita@gmail.com', '+917985135468', 'plot No. 3, sector G,Devgiri Hills, Near BSNL office ', 'Shivaji Nagar  431001 Abad', 'Same as billing Address', '', 'Qwerty', 'dsf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '1234'),
('samihan25', 'samihan123'),
('ShreyasXO', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `note_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `note`, `note_tags`) VALUES
(4, 'You may align the content in header, footer and content body of the card as per your wish by using text utility classes e.g. text-center, text-right etc.', 'happy,cool,fine'),
(5, 'The width and height can be set for an element, by using 25%, 50%, 75%, 100%, and auto values. For instance, use w-25 (for remaining values, replace 25 with those values) for width utility and h-25 (for remaining values, replace 25 with those values) for height utility.', 'w,r,t,');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_tags` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_costPrice` varchar(255) NOT NULL,
  `product_sellingPrice` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_category`, `product_tags`, `product_description`, `product_costPrice`, `product_sellingPrice`, `product_quantity`) VALUES
('p1', 'Screw Fire Retardant Enclosure', '1.jpg', 'Mechanical', 'rtyu ytr', 'The word engine derives from Old French engin, from the Latin ingenium–the root of the word ingenious. Pre-industrial weapons of war, such as catapults, trebuchets and battering rams, were called si jgvv iytv viyttf i ', '100000', '50000', '3'),
('p2', 'Clutch', '4.jpg', 'Mechanical', 'Clutch, 7 mm', '7 mm A transmission is a machine in a power transmission system, which provides controlled application of the power trolled application of the power', '400', '600', '7'),
('p3', 'Engine', '5.jpg', 'Mechanical', 'qwert,tuiyu,tutu,io', 'The word engine derives from Old French engin, from the Latin ingenium–the root of the word ingenious. Pre-industrial weapons of war, such as catapults, trebuchets and battering rams, were called siege engines, and knowledge of how to con', '3454', '5000', '19'),
('p4', 'Engine Holder', '3.jpg', 'Mechanical', 'Engine, Allset, checking', 'An engine stand is a tool commonly used to repair large heavy gasoline or diesel engines. It uses a heavy cantilevered support structure to hold the engine in midair so that the mechanic has access to any exposed surface of the engine.', '1500', '2000', '20'),
('QY65974', 'Rim', '2.jpg', 'Mechanical', 'tytty iuyiuy oiiy tfgc ytuty ', 'rtutf yfiuyg ggfsuch as catapults, trebuchets and battering rams, were called si such as catapults,', '1000', '15000', '13'),
('SP3141', 'Special product', 'Farmvice logo.png', 'Project', 'njlhgcvhjk', 'fvhbjkl; 7 mm A transmission is a machine in a power transmission system, which provides controlled applicati...', '1000', '1200', '14'),
('UI87687', 'Gear Box Forging', '8.jpg', 'Mechanical', 'qwery, werwer, werwerw wrtw', 'A transmission is a machine in a power transmission system, which provides controlled application of the power', '1500', '2000', '15'),
('VC578865', 'Bingo', 'zombie-1801470_1280.jpg', 'Dead', 'Zombie, wow , awesome , smile', 'This is one of the zombie A transmission is a machine in a power transmission system, which provides controlled application of...', '2000', '2100', '19');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quotation_id` int(11) NOT NULL,
  `quote_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`quotation_id`, `quote_id`, `customer_id`, `date`, `sub_total`, `gst`, `discount`, `net_total`) VALUES
(1, 'QT150420201', 6, '2020-04-15', 10210, 18, 50, 11997.8),
(2, 'QT150420202', 6, '2020-04-15', 6600, 18, 50, 7738),
(3, 'QT150420203', 8, '2020-04-15', 8000, 18, 50, 9390),
(4, 'QT010520204', 8, '2020-05-01', 18000, 18, 0, 21240),
(5, 'QT010620205', 7, '2020-06-01', 21000, 18, 0, 24780),
(6, 'QT010720206', 7, '2020-07-01', 100000, 18, 0, 118000),
(8, 'QT010820208', 9, '2020-08-01', 150000, 18, 0, 177000),
(9, 'QT010820209', 7, '2020-08-01', 58800, 18, 0, 69384),
(10, 'QT0108202010', 7, '2020-08-01', 58800, 18, 0, 69384),
(11, 'QT0108202011', 7, '2020-08-01', 58800, 18, 0, 69384),
(12, 'QT0108202012', 7, '2020-08-01', 58800, 18, 0, 69384),
(13, 'QT0108202013', 7, '2020-08-01', 58800, 18, 0, 69384),
(14, 'QT0108202014', 7, '2020-08-01', 58800, 18, 0, 69384),
(15, 'QT0108202015', 7, '2020-08-01', 58800, 18, 0, 69384),
(16, 'QT0108202016', 7, '2020-08-01', 58800, 18, 0, 69384),
(17, 'QT0108202017', 7, '2020-08-01', 58800, 18, 0, 69384),
(18, 'QT0108202018', 7, '2020-08-01', 58800, 18, 0, 69384),
(19, 'QT0108202019', 7, '2020-08-01', 58800, 18, 0, 69384),
(20, 'QT0101202020', 14, '2020-01-01', 63600, 18, 0, 75048),
(21, 'QT0101202021', 14, '2020-01-01', 63600, 18, 0, 75048),
(22, 'QT0101202022', 14, '2020-01-01', 63600, 18, 0, 75048),
(23, 'QT0101202023', 14, '2020-01-01', 63600, 18, 0, 75048),
(24, 'QT0101202024', 14, '2020-01-01', 63600, 18, 0, 75048);

-- --------------------------------------------------------

--
-- Table structure for table `quotation2`
--

CREATE TABLE `quotation2` (
  `quotation_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `prod_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation2`
--

INSERT INTO `quotation2` (`quotation_id`, `product_id`, `prod_quantity`) VALUES
(1, 'p1', 2),
(1, 'VC578865', 2),
(1, 'UI87687', 3),
(2, 'p2', 1),
(2, 'UI87687', 2),
(2, 'p4', 1),
(3, 'p4', 3),
(3, 'UI87687', 1),
(4, 'p4', 9),
(5, 'QY65974', 14),
(6, 'p1', 2),
(8, 'p1', 3),
(9, 'p1', 1),
(9, 'p2', 1),
(9, 'p3', 1),
(9, 'p4', 1),
(9, 'SP3141', 1),
(10, 'p1', 1),
(10, 'p2', 1),
(10, 'p3', 1),
(10, 'p4', 1),
(10, 'SP3141', 1),
(11, 'p1', 1),
(11, 'p2', 1),
(11, 'p3', 1),
(11, 'p4', 1),
(11, 'SP3141', 1),
(12, 'p1', 1),
(12, 'p2', 1),
(12, 'p3', 1),
(12, 'p4', 1),
(12, 'SP3141', 1),
(13, 'p1', 1),
(13, 'p2', 1),
(13, 'p3', 1),
(13, 'p4', 1),
(13, 'SP3141', 1),
(14, 'p1', 1),
(14, 'p2', 1),
(14, 'p3', 1),
(14, 'p4', 1),
(14, 'SP3141', 1),
(15, 'p1', 1),
(15, 'p2', 1),
(15, 'p3', 1),
(15, 'p4', 1),
(15, 'SP3141', 1),
(16, 'p1', 1),
(16, 'p2', 1),
(16, 'p3', 1),
(16, 'p4', 1),
(16, 'SP3141', 1),
(17, 'p1', 1),
(17, 'p2', 1),
(17, 'p3', 1),
(17, 'p4', 1),
(17, 'SP3141', 1),
(18, 'p1', 1),
(18, 'p2', 1),
(18, 'p3', 1),
(18, 'p4', 1),
(18, 'SP3141', 1),
(19, 'p1', 1),
(19, 'p2', 1),
(19, 'p3', 1),
(19, 'p4', 1),
(19, 'SP3141', 1),
(20, 'p1', 1),
(20, 'p2', 1),
(20, 'p3', 1),
(20, 'p4', 1),
(20, 'SP3141', 5),
(21, 'p1', 1),
(21, 'p2', 1),
(21, 'p3', 1),
(21, 'p4', 1),
(21, 'SP3141', 5),
(22, 'p1', 1),
(22, 'p2', 1),
(22, 'p3', 1),
(22, 'p4', 1),
(22, 'SP3141', 5),
(23, 'p1', 1),
(23, 'p2', 1),
(23, 'p3', 1),
(23, 'p4', 1),
(23, 'SP3141', 5),
(24, 'p1', 1),
(24, 'p2', 1),
(24, 'p3', 1),
(24, 'p4', 1),
(24, 'SP3141', 5);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `order_id`, `invoice_id`, `customer_id`, `date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`) VALUES
(1, 'OD150420201', 'PC20201', 6, '2020-04-15', 20000, 18, 0, 23550, 0, 23550),
(2, 'OD150420202', 'PC20202', 8, '2010-04-15', 12210, 19, 0, 14479.9, 0, 14479.9),
(3, 'OD150420203', 'PC20203', 9, '2020-04-15', 14010, 18, 0, 16481.8, 1000, 15481.8),
(6, 'OD010120206', 'PC20206', 12, '2020-01-01', 2400, 18, 0, 2832, 0, 2832),
(7, 'OD020220207', 'PC20207', 9, '2020-02-02', 15000, 18, 0, 17700, 17700, 0),
(8, 'OD010320208', 'PC20208', 8, '2020-03-01', 10, 18, 0, 11.8, 11, 0),
(9, 'OD010620209', 'PC20209', 9, '2020-06-01', 16800, 18, 0, 19824, 0, 19824),
(10, 'OD0107202010', 'PC202010', 12, '2020-07-01', 39000, 18, 0, 46020, 0, 46020),
(11, 'OD0105202011', 'PC202011', 9, '2020-05-01', 16000, 18, 0, 18880, 0, 18880),
(12, 'OD0107202012', 'PC202012', 7, '2020-07-01', 300000, 18, 0, 354000, 0, 354000),
(13, 'OD0109202013', 'PC202013', 8, '2020-09-01', 70600, 18, 0, 83308, 0, 83308),
(14, 'OD0110202014', 'PC202014', 11, '2020-10-01', 70900, 18, 0, 83662, 0, 83662),
(15, 'OD0110202015', 'PC202015', 11, '2020-10-01', 70900, 18, 0, 83662, 0, 83662),
(16, 'OD0110202016', 'PC202016', 11, '2020-10-01', 70900, 18, 0, 83662, 0, 83662),
(17, 'OD3011202017', 'PC202017', 7, '2020-11-30', 57600, 18, 0, 67968, 0, 67968),
(18, 'OD3011202018', 'PC202018', 7, '2020-11-30', 57600, 18, 0, 67968, 0, 67968),
(19, 'OD3011202019', 'PC202019', 7, '2020-11-30', 57600, 18, 0, 67968, 0, 67968),
(20, 'OD0101202020', 'PC202020', 8, '2020-01-01', 50600, 18, 0, 59708, 0, 59708),
(21, 'OD0101202021', 'PC202021', 8, '2020-01-01', 50600, 18, 0, 59708, 0, 59708),
(22, 'OD0101202022', 'PC202022', 8, '2020-01-01', 50600, 18, 0, 59708, 0, 59708),
(23, 'OD2911202023', 'PC202023', 8, '2020-11-29', 57000, 18, 0, 67260, 0, 67260),
(24, 'OD0101202024', 'PC202024', 14, '2020-01-01', 173200, 18, 0, 204376, 0, 204376);

-- --------------------------------------------------------

--
-- Table structure for table `transaction2`
--

CREATE TABLE `transaction2` (
  `transaction_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `prod_quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction2`
--

INSERT INTO `transaction2` (`transaction_id`, `product_id`, `prod_quantity`) VALUES
(1, 'p3', '4'),
(2, 'p1', '2'),
(2, 'p2', '3'),
(2, 'UI87687', '1'),
(2, 'VC578865', '4'),
(3, 'p1', '2'),
(3, 'UI87687', '1'),
(3, 'p4', '1'),
(3, 'p3', '2'),
(6, 'SP3141', '2'),
(7, 'QY65974', '10'),
(8, 'p1', '2'),
(9, 'VC578865', '8'),
(10, 'QY65974', '14'),
(10, 'p4', '9'),
(11, 'UI87687', '8'),
(12, 'p1', '6'),
(13, 'p3', '1'),
(13, 'p2', '1'),
(13, 'p1', '1'),
(13, 'QY65974', '1'),
(14, 'p2', '1'),
(14, 'p1', '1'),
(14, 'SP3141', '1'),
(14, 'VC578865', '1'),
(14, 'p4', '1'),
(14, 'QY65974', '1'),
(15, 'p2', '1'),
(15, 'p1', '1'),
(15, 'SP3141', '1'),
(15, 'VC578865', '1'),
(15, 'p4', '1'),
(15, 'QY65974', '1'),
(16, 'p2', '1'),
(16, 'p1', '1'),
(16, 'SP3141', '1'),
(16, 'VC578865', '1'),
(16, 'p4', '1'),
(16, 'QY65974', '1'),
(17, 'p1', '1'),
(17, 'p2', '1'),
(17, 'p3', '1'),
(17, 'p4', '1'),
(18, 'p1', '1'),
(18, 'p2', '1'),
(18, 'p3', '1'),
(18, 'p4', '1'),
(19, 'p1', '1'),
(19, 'p2', '1'),
(19, 'p3', '1'),
(19, 'p4', '1'),
(20, 'p1', '1'),
(20, 'p2', '1'),
(21, 'p1', '1'),
(21, 'p2', '1'),
(22, 'p1', '1'),
(22, 'p2', '1'),
(23, 'p3', '1'),
(23, 'p4', '1'),
(23, 'p1', '1'),
(24, 'p1', '3'),
(24, 'p2', '5'),
(24, 'p3', '3'),
(24, 'p4', '2'),
(24, 'SP3141', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
