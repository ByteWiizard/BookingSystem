-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 01:59 PM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coperson_shonell`
--

-- --------------------------------------------------------

--
-- Table structure for table `ical_events`
--

CREATE TABLE IF NOT EXISTS `ical_events` (
  `event_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `text` text NOT NULL,
  `event_pid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `added_date` date NOT NULL,
  `booking_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ical_events`
--

INSERT INTO `ical_events` (`event_id`, `admin_id`, `start_date`, `end_date`, `text`, `event_pid`, `cat_id`, `event_type`, `added_date`, `booking_status`) VALUES
(1, 1, '2017-06-30', '2017-07-08', 'Reserved - sandeep Testing', 1, 0, 'custumer', '2017-06-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lhk_about_details`
--

CREATE TABLE IF NOT EXISTS `lhk_about_details` (
  `about_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `about_profile_img` varchar(255) NOT NULL,
  `about_heading` varchar(255) NOT NULL,
  `about_content` longtext NOT NULL,
  `about_heading2` varchar(200) NOT NULL,
  `about_short_content` longtext,
  `about_inst_date` date NOT NULL,
  `about_update_date` date DEFAULT NULL,
  `about_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_about_details`
--

INSERT INTO `lhk_about_details` (`about_id`, `admin_id`, `about_profile_img`, `about_heading`, `about_content`, `about_heading2`, `about_short_content`, `about_inst_date`, `about_update_date`, `about_ip`) VALUES
(1, 1, '../uploads/about/emerisle.jpg', 'Discover Emerald Isle', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n', '', '', '2017-06-26', '2017-06-26', '127.0.0.1'),
(2, 1, '', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '', '', '2017-06-26', NULL, '127.0.0.1'),
(3, 1, '', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '', '', '2017-06-26', NULL, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_about_property`
--

CREATE TABLE IF NOT EXISTS `lhk_about_property` (
  `about_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `content2` longtext NOT NULL,
  `img` varchar(200) NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_about_property`
--

INSERT INTO `lhk_about_property` (`about_id`, `title`, `content`, `content2`, `img`, `create_date`, `update_date`) VALUES
(1, 'About the owner', 'It has been almost 20 years ago that we fell in love with Emerald Isle when our girls were very young. We have celebrated many special events and family reunions at Dunecastle. Our daughter Ashlie was even married on the sand right in front of the cottage. We have been blessed with 7 beautiful grandchildren and now enjoy our time there watching the dolphins swim and jump right in front of the cottage.', '', '', '2017-06-26 19:37:16', '2017-06-26 19:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_alternate_details`
--

CREATE TABLE IF NOT EXISTS `lhk_alternate_details` (
  `user_id` int(11) NOT NULL,
  `alt_name` varchar(100) NOT NULL,
  `alt_pass` varchar(100) NOT NULL,
  `alt_login_time` varchar(100) NOT NULL,
  `alt_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_amenities_details`
--

CREATE TABLE IF NOT EXISTS `lhk_amenities_details` (
  `amenity_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amenity_name` varchar(255) NOT NULL,
  `amenity_value` longtext NOT NULL,
  `amenity_add_date` date NOT NULL,
  `amenity_update_date` date NOT NULL,
  `amenity_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_amenity`
--

CREATE TABLE IF NOT EXISTS `lhk_amenity` (
  `amenity_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amenity_name` varchar(255) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `amenity_add_date` date NOT NULL,
  `amenity_update_date` date NOT NULL,
  `amenity_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_amenity`
--

INSERT INTO `lhk_amenity` (`amenity_id`, `property_id`, `admin_id`, `amenity_name`, `menu_order`, `amenity_add_date`, `amenity_update_date`, `amenity_ip`) VALUES
(1, 1, 1, 'Property Type:', 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(2, 1, 1, 'Meals:', 2, '2017-06-26', '2017-06-26', '61.12.74.142'),
(3, 1, 1, 'Floor Area', 3, '2017-06-26', '2017-06-26', '61.12.74.142'),
(4, 1, 1, 'House Rules', 4, '2017-06-26', '2017-06-26', '61.12.74.142'),
(5, 1, 1, 'LOCATION TYPE', 5, '2017-06-26', '2017-06-26', '61.12.74.142'),
(6, 1, 1, 'THEME', 6, '2017-06-26', '2017-06-26', '61.12.74.142'),
(7, 1, 1, 'GENERAL', 7, '2017-06-26', '2017-06-26', '61.12.74.142'),
(8, 1, 1, 'KITCHEN', 8, '2017-06-26', '2017-06-26', '61.12.74.142'),
(9, 1, 1, 'DINING', 9, '2017-06-26', '2017-06-26', '61.12.74.142'),
(10, 1, 1, 'Bathrooms:', 10, '2017-06-26', '2017-06-26', '61.12.74.142'),
(11, 1, 1, 'Bedrooms:', 11, '2017-06-26', '2017-06-26', '61.12.74.142'),
(12, 1, 1, 'ENTERTAINMENT', 12, '2017-06-26', '2017-06-26', '61.12.74.142'),
(13, 1, 1, 'OUTSIDE', 13, '2017-06-26', '2017-06-26', '61.12.74.142'),
(14, 1, 1, 'SUITABILITY', 14, '2017-06-26', '2017-06-26', '61.12.74.142'),
(15, 1, 1, 'ATTRACTIONS', 15, '2017-06-26', '2017-06-26', '61.12.74.142'),
(16, 1, 1, 'LEISURE ACTIVITIES', 16, '2017-06-26', '2017-06-26', '61.12.74.142'),
(17, 1, 1, 'LOCAL SERVICES &amp; BUSINESSES', 17, '2017-06-26', '2017-06-26', '61.12.74.142'),
(18, 1, 1, 'SPORTS &amp; ADVENTURE ACTIVITIES', 18, '2017-06-26', '2017-06-26', '61.12.74.142'),
(19, 2, 1, 'PROPERTY TYPE', 19, '2017-06-26', '2017-06-26', '61.12.74.142'),
(20, 2, 1, 'MEALS', 20, '2017-06-26', '2017-06-26', '61.12.74.142'),
(21, 2, 1, 'Floor Area', 21, '2017-06-26', '2017-06-26', '61.12.74.142'),
(22, 2, 1, 'House Rules', 22, '2017-06-26', '2017-06-26', '61.12.74.142'),
(23, 2, 1, 'LOCATION TYPE', 23, '2017-06-26', '2017-06-26', '61.12.74.142'),
(24, 2, 1, 'THEME', 24, '2017-06-26', '2017-06-26', '61.12.74.142'),
(25, 2, 1, 'GENERAL', 25, '2017-06-26', '2017-06-26', '61.12.74.142'),
(26, 2, 1, 'KITCHEN', 26, '2017-06-26', '2017-06-26', '61.12.74.142'),
(27, 2, 1, 'DINING', 27, '2017-06-26', '2017-06-26', '61.12.74.142'),
(28, 2, 1, 'Bathrooms:', 28, '2017-06-26', '2017-06-26', '61.12.74.142'),
(29, 2, 1, 'Bedrooms:', 29, '2017-06-26', '2017-06-26', '61.12.74.142'),
(30, 2, 1, 'ENTERTAINMENT', 30, '2017-06-26', '2017-06-26', '61.12.74.142'),
(31, 2, 1, 'OUTSIDE', 31, '2017-06-26', '2017-06-26', '61.12.74.142'),
(32, 2, 1, 'ATTRACTIONS', 32, '2017-06-26', '2017-06-26', '61.12.74.142'),
(33, 2, 1, 'LEISURE ACTIVITIES', 33, '2017-06-26', '2017-06-26', '61.12.74.142'),
(34, 2, 1, 'LOCAL SERVICES &amp; BUSINESSES', 34, '2017-06-26', '2017-06-26', '61.12.74.142'),
(35, 2, 1, 'SPORTS &amp; ADVENTURE ACTIVITIES', 35, '2017-06-26', '2017-06-26', '61.12.74.142');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_amenity_details`
--

CREATE TABLE IF NOT EXISTS `lhk_amenity_details` (
  `amen_id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL,
  `amen_value` varchar(255) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `amen_status` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `update_date` date NOT NULL,
  `amen_ip` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_amenity_details`
--

INSERT INTO `lhk_amenity_details` (`amen_id`, `amenity_id`, `amen_value`, `menu_order`, `amen_status`, `add_date`, `update_date`, `amen_ip`) VALUES
(1, 1, 'House', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(2, 2, 'Guests provide their own meals', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(3, 3, '2230 sq. ft.', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(4, 4, 'Max. occupancy: 10', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(5, 4, 'Minimum Age Limit for Renters', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(6, 4, 'Events Allowed', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(7, 4, 'Pets considered', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(8, 4, 'Children Welcome', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(9, 4, 'Non Smoking Only', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(10, 5, 'Beach View', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(11, 5, 'Beachfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(12, 5, 'Ocean View', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(13, 5, 'Oceanfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(14, 5, 'Water View', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(15, 5, 'Waterfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(16, 6, 'Away From It All', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(17, 6, 'Family', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(18, 6, 'Tourist Attractions', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(19, 7, 'Air Conditioning', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(20, 7, 'Linens Provided', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(21, 7, 'Clothes Dryer', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(22, 7, 'Living Room', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(23, 7, 'Heating', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(24, 7, 'Internet', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(25, 7, 'Iron &amp; Board', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(26, 7, 'Parking', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(27, 7, 'Washing Machine', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(28, 8, 'Coffee Maker', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(29, 8, 'Dishes &amp; Utensils', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(30, 8, 'Dishwasher', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(31, 8, 'Kitchen', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(32, 8, 'Microwave', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(33, 8, 'Oven', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(34, 8, 'Refrigerator', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(35, 8, 'Stove', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(36, 8, 'Toaster', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(37, 9, 'Dining Area', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(38, 9, 'Seating for 10 people', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(39, 10, '2 Bathrooms', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(40, 10, 'Bathroom 1 - toilet , combination tub/shower , Downstairs bathroom', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(41, 10, 'Bathroom 2 - toilet , combination tub/shower , Upstairs Jack and Jill bathroom', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(42, 10, 'Bathroom #1 is downstairs off of the living room between the downstairs bathrooms. It is a full bath, with tub, commode and sink. Bathroom #2 is upstairs between the bedrooms. It is a full bath, with a tub, commode and sink. Outside downstairs there is an', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(43, 11, '5 Bedrooms, Sleeps 10', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(45, 11, 'Bedroom 1 - 1 king , Ocean front view with private deck', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(47, 11, 'Bedroom 2 - 1 queen , Ocean front view with queen sized bed', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(48, 11, 'Bedroom 3 - 1 queen , Street side view', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(49, 11, 'Bedroom 4 - 1 queen , Street side view', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(50, 11, 'loft room - 2 twin/ single , Loft with two twin beds with view to downstairs living room', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(51, 12, 'DVD Player', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(52, 12, 'Ping Pong Table', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(53, 12, 'Satellite / Cable', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(54, 12, 'Game Room', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(55, 12, 'Games', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(56, 12, 'Television', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(57, 13, 'Balcony', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(58, 13, 'Deck / Patio', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(59, 13, 'Outdoor Grill', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(60, 14, 'Wheelchair Inaccessible', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(61, 15, 'Churches', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(62, 15, 'Cinemas', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(63, 15, 'Health/Beauty Spa', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(64, 15, 'Library', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(65, 15, 'Marina', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(66, 15, 'Museums', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(67, 15, 'Restaurants', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(68, 16, 'Antiquing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(69, 16, 'Beachcombing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(70, 16, 'Bird Watching', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(71, 16, 'Boating', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(72, 16, 'Miniature Golf', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(73, 16, 'Shelling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(74, 16, 'Shopping', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(75, 16, 'Sight Seeing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(76, 16, 'Walking', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(77, 16, 'Wildlife Viewing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(78, 17, 'ATM/bank', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(79, 17, 'Massage Therapist', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(80, 17, 'Groceries', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(81, 17, 'Laundromat', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(82, 17, 'Medical Services', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(83, 18, 'Cycling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(84, 18, 'Deep Sea Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(85, 18, 'Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(86, 18, 'Golf', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(87, 18, 'Jet Skiing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(88, 18, 'Pier Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(89, 18, 'Sailing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(90, 18, 'Scuba Diving or Snorkeling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(91, 18, 'Snorkeling/Diving', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(92, 18, 'Sound/Bay Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(93, 18, 'Surf Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(94, 18, 'Surfing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(95, 18, 'Swimming', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(96, 18, 'Wind-Surfing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(97, 19, 'House', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(98, 20, 'Guests provide their own meals', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(99, 21, '2200 sq. ft.', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(100, 22, 'Max. occupancy: 10', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(101, 22, 'Minimum Age Limit for Renters', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(102, 22, 'Events Allowed', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(103, 22, 'Pets Considered', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(104, 22, 'Children Welcome', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(105, 22, 'Non Smoking Only', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(106, 23, 'Beach View', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(107, 23, 'Beachfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(108, 23, 'Ocean View', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(109, 23, 'Oceanfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(110, 23, 'Waterfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(111, 24, 'Away From It All', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(112, 24, 'Family', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(113, 24, 'Historic', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(114, 24, 'Romantic', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(115, 24, 'Sports &amp; Activities', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(116, 24, 'Tourist Attractions', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(117, 25, 'Air Conditioning', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(118, 25, 'Clothes Dryer', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(119, 25, 'Heating', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(120, 25, 'Internet', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(121, 25, 'Linens Provided', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(122, 25, 'Living Room', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(123, 25, 'Parking', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(124, 25, 'Washing Machine', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(125, 26, 'Coffee Maker', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(126, 26, 'Dishes &amp; Utensils', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(127, 26, 'Dishwasher', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(128, 26, 'Kitchen', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(129, 26, 'Microwave', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(130, 26, 'Oven', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(131, 26, 'Refrigerator', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(132, 26, 'Stove', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(133, 26, 'Toaster', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(134, 27, 'Dining Area', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(135, 27, 'Seating for 10 people', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(136, 28, '2 Bathrooms', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(137, 28, 'Bathroom 1 - toilet , combination tub/shower , shower', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(138, 28, 'Bathroom 2 - toilet , combination tub/shower', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(139, 28, 'Bathroom 3 - outdoor shower', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(140, 29, '4 Bedrooms, Sleeps 10', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(141, 29, 'Bedroom 1 - 1 queen', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(142, 29, 'Bedroom 2 - 1 queen , Oceanfront', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(143, 29, 'Bedroom 3 - 1 queen', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(144, 29, 'Bedroom 4 - 1 queen , balcony off bedroom', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(145, 29, 'Loft - 2 twin/ single', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(146, 30, 'DVD Player', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(147, 30, 'Game Room', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(148, 30, 'Ping Pong Table', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(149, 30, 'Satellite / Cable', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(150, 30, 'Television', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(151, 31, 'Balcony', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(152, 31, 'Deck / Patio', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(153, 31, 'Outdoor Grill', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(154, 32, 'Churches', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(155, 32, 'Cinemas', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(156, 32, 'Library', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(157, 32, 'Marina', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(158, 32, 'Restaurants', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(159, 32, 'Ruins', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(160, 33, 'Antiquing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(161, 33, 'Beachcombing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(162, 33, 'Bird Watching', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(163, 33, 'Boating', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(164, 33, 'Miniature Golf', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(165, 33, 'Photography', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(166, 33, 'Scenic Drives', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(167, 33, 'Shelling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(168, 33, 'Shopping', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(169, 33, 'Sight Seeing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(170, 33, 'Walking', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(171, 33, 'Wildlife Viewing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(172, 34, 'ATM/bank', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(173, 34, 'Groceries', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(174, 34, 'Massage Therapist', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(175, 34, 'Medical Services', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(176, 35, 'Cycling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(177, 35, 'Deep Sea Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(178, 35, 'Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(179, 35, 'Golf', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(180, 35, 'Golf Privileges Optional', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(181, 35, 'Jet Skiing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(182, 35, 'Kayaking', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(183, 35, 'Parasailing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(184, 35, 'Pier Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(185, 35, 'Sailing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(186, 35, 'Scuba Diving or Snorkeling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(187, 35, 'Snorkeling', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(188, 35, 'Snorkeling/Diving', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(189, 35, 'Sound/Bay Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(190, 35, 'Surf Fishing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(191, 35, 'Surfing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(192, 35, 'Swimming', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(193, 35, 'Water Tubing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142'),
(194, 35, 'Wind-Surfing', 0, 1, '2017-06-26', '2017-06-26', '61.12.74.142');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_area_detail`
--

CREATE TABLE IF NOT EXISTS `lhk_area_detail` (
  `area_id` int(11) NOT NULL,
  `area_title` varchar(200) NOT NULL,
  `area_content` longtext NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_area_detail`
--

INSERT INTO `lhk_area_detail` (`area_id`, `area_title`, `area_content`, `create_date`, `update_date`) VALUES
(1, 'EMERALD ISLE Attractions', 'Emerald Isle is a town in Carteret County, North Carolina, United States. It is part of the Crystal Coast and is located entirely on Bogue Banks. The population was 3,655 at the 2010 census,but as many as 50,000 visitors inhabit the area during the summer season, filling up vacant rental properties that do not count toward official census results.<br />\r\n<br />\r\nToday, the oceanfront is lined with both large and small homes and duplexes. While there is a large scattering of condominiums, there are no oceanfront hotels, and Emerald Isle has maintained a family-oriented atmosphere.<br />\r\n<br />\r\nRecent beach renourishment projects in North Carolina, including Emerald Isle, have been both praised and questioned', '2017-06-26 11:56:05', '2017-06-28 14:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_area_info`
--

CREATE TABLE IF NOT EXISTS `lhk_area_info` (
  `id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `heading` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `icons` longtext NOT NULL,
  `added_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_area_info`
--

INSERT INTO `lhk_area_info` (`id`, `loc_id`, `admin_id`, `img`, `heading`, `content`, `sub_title`, `icons`, `added_date`) VALUES
(1, 0, '1', '../uploads/areainfo/bogue_lnlet_fishing_pier.jpg', 'Qm9ndWUgbG5sZXQgRmlzaGluZyBQaWVy', 'Welcome to a whole new Bogue Inlet Pier! As we move into the 2017 season with a complete reset, we hope you will be pleasantly surprised to experience our completely new pier house with the latest convenience items, improved rest room facilities, and walkways. Our winter rebuild project was quite a challenge considering we had a limited time to complete such a large task! We are running with reduced services at this writing and will do our very best to get back to normal soon. Surf&amp;rsquo;s Up Grill and Bar is next on the agenda for completion.', '', '', '2017-06-27 08:50:08'),
(2, 0, '1', '../uploads/areainfo/the_point.jpg', 'VGhlIFBvaW50', 'The two sand and water pictures were taken at the Point at the western most end of Emerald Isle. Beaches by nature change all the time. The sand can and often does change from morning to night. The profile of beaches can be altered by storms or just normal wave action. Sometimes man helps mother nature by doing beach nourishment.It has been fun to watch the changes at the Point over time.The beaches and shallow water were racing towards Bogue Inlet.', '', '', '2017-06-27 08:52:20'),
(3, 0, '1', '../uploads/areainfo/water_boggan.jpg', 'V2F0ZXIgVG93ZXIgUGFyaw==', 'This is the lovely park near the water tower off Coast Guard Rd. in Emerald Isle.All of the sculptures in the park are upcycled or recycled, as are the park materials. The gardens are supported by donations. Soon, the children will learn how to make signs to identify the native species and sculptures.There is a nice walk/bike path through the woods a pier with great views of the bridge and sound where you can launch your kayak and very nicely maintained public restrooms.', '', '', '2017-06-27 08:53:06'),
(4, 0, '1', '../uploads/areainfo/salty_pirate_water_park.jpg', 'U2FsdHkgUGlyYXRlIFdhdGVyIFBhcms=', 'Grab the kids and cool off with a day at the Salty Pirate Waterpark in Emerald Isle, formerly Water Boggan of Emerald Isle.&lt;br /&gt;\r\nThis family owned waterpark features a wide variety of water slides, wading pools and tubes to entertain kids of all ages. The park also includes an arcade and snack bar, and is located close to other fun family activities in Emerald Isle.', '', '', '2017-06-27 08:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_beach_place`
--

CREATE TABLE IF NOT EXISTS `lhk_beach_place` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `urllink` varchar(200) NOT NULL,
  `heading` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `added_date` date NOT NULL,
  `r_update_date` date NOT NULL,
  `r_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_beach_rules`
--

CREATE TABLE IF NOT EXISTS `lhk_beach_rules` (
  `rule_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(200) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_booking_details`
--

CREATE TABLE IF NOT EXISTS `lhk_booking_details` (
  `bok_det_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `prop_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `tot_amt` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `min_stay` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `g_amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `showextraname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `showextraamount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `req_num` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `after_off_amt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `card_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cvv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `card_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `expire_month` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `request_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `taxv` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `clean` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `totalnight` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adult` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `no_of_ppl` int(11) NOT NULL,
  `pets` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `addr` longtext COLLATE utf8_unicode_ci NOT NULL,
  `apply_rate` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `apply_rate_price` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `msg` longtext COLLATE utf8_unicode_ci NOT NULL,
  `added_date` date NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message_send_status` int(11) NOT NULL,
  `book_status` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lhk_booking_details`
--

INSERT INTO `lhk_booking_details` (`bok_det_id`, `property_id`, `admin_id`, `prop_name`, `checkin`, `checkout`, `tot_amt`, `min_stay`, `g_amount`, `showextraname`, `showextraamount`, `req_num`, `after_off_amt`, `card_no`, `cvv`, `card_type`, `expire_month`, `year`, `zip`, `country`, `state`, `city`, `request_id`, `tax`, `refund`, `taxv`, `clean`, `totalnight`, `name`, `fname`, `lname`, `email`, `phone`, `adult`, `children`, `no_of_ppl`, `pets`, `addr`, `apply_rate`, `apply_rate_price`, `msg`, `added_date`, `ip`, `message_send_status`, `book_status`) VALUES
(13, 1, 1, 'Dune Castle West', '2017-07-05', '2017-07-13', '4231.96', '7', '3354.29', '', '', '', '', '', '', '', '', '', '', '', '', '', 'TivSdue5TX', '427.67', '250.00', '12.75', '200.00', 8, 'Rishabh Jaiswal', 'Rishabh', 'Jaiswal', 'rishabhtech1990@gmail.com', '1212121212', NULL, 1, 2, '', '', 'Weekly Rate', '$1,935.00', 'testing', '2017-07-05', '182.64.68.81', 1, 0),
(6, 2, 1, 'Dune Castle East', '2017-06-09', '2017-06-16', '2420.4375', '', '1925', '', '', '', '', '', '', '', '', '', '', '', '', '', 'PRqfJEoqQx', '245.4375', '250', '12.75', '0', 7, 'shonnie singlwer', 'shonnie', 'singlwer', 'shonjsin@ol.com', '9197490677', NULL, 1, 10, 'No', '', '', '', '', '2017-07-03', '174.205.16.85', 0, 0),
(7, 2, 1, 'Dune Castle East', '2017-07-08', '2017-07-15', '3759.2125', '7', '2935', '', '', '', '', '', '', '', '', '', '', '', '', '', 'QFNjE7ts2O', '374.2125', '250', '12.75', '200', 7, 'craig singler', 'craig', 'singler', 'craig.singler@gmail.com', '919-332-1409', NULL, 3, 4, 'Yes', '', '', '', '', '2017-07-05', '174.226.133.20', 0, 0),
(12, 1, 1, 'Dune Castle West', '2017-08-01', '2017-08-08', '3559.21', '7', '2935.00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'xi68TCo97d', '374.21', '250.00', '12.75', '', 7, 'BRUCE WATSON', 'BRUCE', 'WATSON', 'bruce@personalwebsites.com', '3473528281', NULL, 2, 7, '', '', 'Weekly Rate', '$2,985.00', 'TEST', '2017-07-05', '182.64.68.81', 1, 0),
(11, 2, 1, 'Dune Castle East', '2017-07-15', '2017-07-22', '3809.21', '', '2985.00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'INEVm6IloE', '374.21', '250.00', '12.75', '200.00', 7, 'craig singler', 'craig', 'singler', 'craig.singler@gmail.com', '919-332-1409', NULL, 2, 4, '', '', '', '', '', '2017-07-05', '174.226.133.20', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lhk_client_details`
--

CREATE TABLE IF NOT EXISTS `lhk_client_details` (
  `client_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `req_num` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstdate` date NOT NULL,
  `lastdate` date NOT NULL,
  `adddate` date NOT NULL,
  `client_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_contact_details`
--

CREATE TABLE IF NOT EXISTS `lhk_contact_details` (
  `contact_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_email1` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_addr` text NOT NULL,
  `contact_content` longtext,
  `map_longitude` varchar(255) NOT NULL,
  `map_latitude` varchar(255) NOT NULL,
  `contact_det_insert_date` date NOT NULL,
  `contact_det_update_date` date DEFAULT NULL,
  `contact_det_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_contact_details`
--

INSERT INTO `lhk_contact_details` (`contact_id`, `admin_id`, `contact_name`, `contact_email`, `contact_email1`, `contact_phone`, `contact_addr`, `contact_content`, `map_longitude`, `map_latitude`, `contact_det_insert_date`, `contact_det_update_date`, `contact_det_ip`) VALUES
(1, 1, 'Craig Singler', 'craig.singler@gmail.com', '', '+1-919-332-1409', '', '1000 Overlook Ridge Rd, Wake Forest, NC 27587, USA', '', '', '2017-06-26', '2017-07-05', '182.64.68.81');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_current_special`
--

CREATE TABLE IF NOT EXISTS `lhk_current_special` (
  `current_id` int(11) NOT NULL,
  `beach_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modify_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lhk_current_special`
--

INSERT INTO `lhk_current_special` (`current_id`, `beach_id`, `img`, `heading`, `content`, `url`, `added_date`, `modify_date`) VALUES
(1, 0, '../uploads/specials/surfing.jpg', 'U3VyZmluZw==', '', '', '2017-06-27 08:43:45', ''),
(2, 0, '../uploads/specials/wind_surfing.jpg', 'V2luZCBTdXJmaW5n', '', '', '2017-06-27 08:44:20', ''),
(3, 0, '../uploads/specials/kite_surfing.jpg', 'S2l0ZSBTdXJmaW5n', '', '', '2017-06-27 08:44:48', ''),
(4, 0, '../uploads/specials/paddle_board.jpg', 'UGFkZGxlIEJvYXJk', '', '', '2017-06-27 08:45:11', ''),
(5, 0, '../uploads/specials/kayaking.jpg', 'S2F5YWtpbmc=', '', '', '2017-06-27 08:45:30', ''),
(6, 0, '../uploads/specials/fishing_on_bogue_lnlet_pier.jpg', 'RmlzaGluZyBPbiBCb2d1ZSBMbmxldCBQaWVy', '', '', '2017-06-27 08:45:50', '');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_dewey_facts`
--

CREATE TABLE IF NOT EXISTS `lhk_dewey_facts` (
  `fact_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_files`
--

CREATE TABLE IF NOT EXISTS `lhk_files` (
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_order` int(11) NOT NULL,
  `uploaded_img_date` date NOT NULL,
  `updated_img_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lhk_files`
--

INSERT INTO `lhk_files` (`image_id`, `property_id`, `admin_id`, `file_name`, `file_size`, `caption`, `menu_order`, `uploaded_img_date`, `updated_img_date`) VALUES
(1, 1, 1, '../uploads/1/1.jpg', 0, NULL, 1, '2017-06-26', '2017-06-26'),
(2, 1, 1, '../uploads/1/4.jpg', 0, NULL, 2, '2017-06-26', '2017-06-26'),
(3, 1, 1, '../uploads/1/6.jpg', 0, NULL, 3, '2017-06-26', '2017-06-26'),
(4, 1, 1, '../uploads/1/3.jpg', 0, NULL, 4, '2017-06-26', '2017-06-26'),
(5, 1, 1, '../uploads/1/5.jpg', 0, NULL, 5, '2017-06-26', '2017-06-26'),
(7, 1, 1, '../uploads/1/7.jpg', 0, NULL, 7, '2017-06-26', '2017-06-26'),
(8, 1, 1, '../uploads/1/10.jpg', 0, NULL, 8, '2017-06-26', '2017-06-26'),
(9, 1, 1, '../uploads/1/8.jpg', 0, NULL, 9, '2017-06-26', '2017-06-26'),
(10, 1, 1, '../uploads/1/9.jpg', 0, NULL, 10, '2017-06-26', '2017-06-26'),
(11, 1, 1, '../uploads/1/11.jpg', 0, NULL, 11, '2017-06-26', '2017-06-26'),
(12, 1, 1, '../uploads/1/12.jpg', 0, NULL, 12, '2017-06-26', '2017-06-26'),
(13, 1, 1, '../uploads/1/13.jpg', 0, NULL, 13, '2017-06-26', '2017-06-26'),
(14, 1, 1, '../uploads/1/14.jpg', 0, NULL, 14, '2017-06-26', '2017-06-26'),
(15, 1, 1, '../uploads/1/16.jpg', 0, NULL, 15, '2017-06-26', '2017-06-26'),
(16, 1, 1, '../uploads/1/17.jpg', 0, NULL, 16, '2017-06-26', '2017-06-26'),
(17, 1, 1, '../uploads/1/15.jpg', 0, NULL, 17, '2017-06-26', '2017-06-26'),
(18, 1, 1, '../uploads/1/18.jpg', 0, NULL, 18, '2017-06-26', '2017-06-26'),
(19, 1, 1, '../uploads/1/20.jpg', 0, NULL, 19, '2017-06-26', '2017-06-26'),
(20, 1, 1, '../uploads/1/19.jpg', 0, NULL, 20, '2017-06-26', '2017-06-26'),
(21, 1, 1, '../uploads/1/21.jpg', 0, NULL, 21, '2017-06-26', '2017-06-26'),
(22, 1, 1, '../uploads/1/22.jpg', 0, NULL, 22, '2017-06-26', '2017-06-26'),
(23, 1, 1, '../uploads/1/23.jpg', 0, NULL, 23, '2017-06-26', '2017-06-26'),
(24, 1, 1, '../uploads/1/24.jpg', 0, NULL, 24, '2017-06-26', '2017-06-26'),
(25, 2, 1, '../uploads/2/6.jpg', 0, NULL, 3, '2017-06-26', '2017-06-26'),
(26, 2, 1, '../uploads/2/2.jpg', 0, NULL, 2, '2017-06-26', '2017-06-26'),
(27, 2, 1, '../uploads/2/7.jpg', 0, NULL, 4, '2017-06-26', '2017-06-26'),
(28, 2, 1, '../uploads/2/5.jpg', 0, NULL, 5, '2017-06-26', '2017-06-26'),
(29, 2, 1, '../uploads/2/1.jpg', 0, NULL, 1, '2017-06-26', '2017-06-26'),
(30, 2, 1, '../uploads/2/8.jpg', 0, NULL, 6, '2017-06-26', '2017-06-26'),
(31, 2, 1, '../uploads/2/4.jpg', 0, NULL, 7, '2017-06-26', '2017-06-26'),
(32, 2, 1, '../uploads/2/10.jpg', 0, NULL, 8, '2017-06-26', '2017-06-26'),
(33, 2, 1, '../uploads/2/3.jpg', 0, NULL, 9, '2017-06-26', '2017-06-26'),
(34, 2, 1, '../uploads/2/12.jpg', 0, NULL, 10, '2017-06-26', '2017-06-26'),
(35, 2, 1, '../uploads/2/11.jpg', 0, NULL, 11, '2017-06-26', '2017-06-26'),
(36, 2, 1, '../uploads/2/9.jpg', 0, NULL, 12, '2017-06-26', '2017-06-26'),
(37, 2, 1, '../uploads/2/15.jpg', 0, NULL, 13, '2017-06-26', '2017-06-26'),
(38, 2, 1, '../uploads/2/14.jpg', 0, NULL, 14, '2017-06-26', '2017-06-26'),
(39, 2, 1, '../uploads/2/16.jpg', 0, NULL, 15, '2017-06-26', '2017-06-26'),
(40, 2, 1, '../uploads/2/17.jpg', 0, NULL, 16, '2017-06-26', '2017-06-26'),
(41, 2, 1, '../uploads/2/18.jpg', 0, NULL, 17, '2017-06-26', '2017-06-26'),
(42, 2, 1, '../uploads/2/19.jpg', 0, NULL, 18, '2017-06-26', '2017-06-26'),
(43, 2, 1, '../uploads/2/13.jpg', 0, NULL, 19, '2017-06-26', '2017-06-26'),
(44, 2, 1, '../uploads/2/20.jpg', 0, NULL, 20, '2017-06-26', '2017-06-26'),
(45, 2, 1, '../uploads/2/21.jpg', 0, NULL, 21, '2017-06-26', '2017-06-26'),
(46, 2, 1, '../uploads/2/22.jpg', 0, NULL, 22, '2017-06-26', '2017-06-26'),
(47, 2, 1, '../uploads/2/23.jpg', 0, NULL, 23, '2017-06-26', '2017-06-26'),
(48, 2, 1, '../uploads/2/24.jpg', 0, NULL, 24, '2017-06-26', '2017-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_front_attraction`
--

CREATE TABLE IF NOT EXISTS `lhk_front_attraction` (
  `f_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `f_img` varchar(255) NOT NULL,
  `f_heading` varchar(255) NOT NULL,
  `f_content` longtext NOT NULL,
  `f_caption` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  `f_update_date` date NOT NULL,
  `f_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_gallery`
--

CREATE TABLE IF NOT EXISTS `lhk_gallery` (
  `image_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_order` int(11) NOT NULL,
  `uploaded_img_date` date NOT NULL,
  `updated_image_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_home_details`
--

CREATE TABLE IF NOT EXISTS `lhk_home_details` (
  `home_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `home_heading` varchar(255) NOT NULL,
  `home_content` longtext NOT NULL,
  `other_content` longtext,
  `home_type` varchar(255) DEFAULT NULL,
  `home_video_url` varchar(200) NOT NULL,
  `home_no_of_bedrooms` varchar(255) DEFAULT NULL,
  `home_no_of_sleeps` varchar(255) DEFAULT NULL,
  `home_no_of_baths` varchar(255) DEFAULT NULL,
  `home_det_insert_date` date NOT NULL,
  `home_det_update_date` date DEFAULT NULL,
  `home_det_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_ical_events`
--

CREATE TABLE IF NOT EXISTS `lhk_ical_events` (
  `event_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `text` text NOT NULL,
  `event_pid` int(11) NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `added_date` date NOT NULL,
  `update_date` varchar(100) NOT NULL,
  `booking_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_ical_events`
--

INSERT INTO `lhk_ical_events` (`event_id`, `admin_id`, `start_date`, `end_date`, `text`, `event_pid`, `event_type`, `added_date`, `update_date`, `booking_status`) VALUES
(1, 1, '2016-06-11', '2016-06-18', 'Reserved - Evelyn Miller', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(2, 1, '2016-07-30', '2016-08-06', 'Reserved - mary ward', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(3, 1, '2016-09-03', '2016-09-10', 'Reserved - Cynthia Kendall', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(4, 1, '2017-05-20', '2017-05-27', 'Reserved - Alex Karasik', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(5, 1, '2015-10-10', '2015-10-17', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(6, 1, '2015-10-03', '2015-10-10', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(7, 1, '2016-03-26', '2016-03-30', 'Reserved - Kevin Minerd', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(8, 1, '2017-05-13', '2017-05-17', 'Reserved - Beth Honrine', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(9, 1, '2015-11-21', '2015-11-28', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(10, 1, '2015-08-15', '2015-08-22', 'Reserved', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(11, 1, '2017-05-27', '2017-06-03', 'Reserved - Christopher Hunt', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(12, 1, '2017-07-29', '2017-08-05', 'Reserved - Dustin Allis', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(13, 1, '2016-03-06', '2016-03-12', 'Tentative - Murry Facett', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(14, 1, '2016-08-13', '2016-08-20', 'Reserved - Jimmy Wagstaff', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(15, 1, '2015-09-05', '2015-09-12', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(16, 1, '2017-04-20', '2017-04-29', 'Reserved - Roxann Ellis', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(17, 1, '2017-08-26', '2017-09-02', 'Reserved - Kyle Thompson', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(18, 1, '2016-09-10', '2016-09-17', 'Reserved - Shawna Gray', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(19, 1, '2017-06-03', '2017-06-10', 'Reserved - Abigale Clair', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(20, 1, '2017-08-12', '2017-08-19', 'Reserved - Mary  Ward', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(21, 1, '2016-08-20', '2016-08-27', 'Reserved - Jennifer Sodmont', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(22, 1, '2017-11-18', '2017-11-25', 'Reserved - Lisa  Campbell', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(23, 1, '2016-04-02', '2016-05-21', 'Reserved - Block for repairs', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(24, 1, '2016-06-18', '2016-06-25', 'Reserved - heidi sargent', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(25, 1, '2017-06-17', '2017-06-24', 'Reserved - Evelyn Miller', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(26, 1, '2016-07-16', '2016-07-23', 'Reserved - Della Royston', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(27, 1, '2017-06-24', '2017-07-01', 'Reserved - Jan Wolterman Erschell', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(28, 1, '2015-08-22', '2015-08-29', 'Reserved - BLluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(29, 1, '2018-05-26', '2018-06-02', 'Reserved - Phil & Sonja Beaudoin', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(30, 1, '2017-07-08', '2017-07-15', 'Reserved - Angela Hall', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(31, 1, '2016-03-19', '2016-03-26', 'Reserved - Brenda Daniele', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(32, 1, '2016-06-04', '2016-06-11', 'Reserved - cynthia hunt', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(33, 1, '2016-06-25', '2016-07-02', 'Reserved - cyndie klim', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(34, 1, '2016-09-17', '2016-09-24', 'Reserved - Trina Combs', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(35, 1, '2015-09-19', '2015-09-26', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(36, 1, '2017-08-19', '2017-08-26', 'Reserved - Jo Ann Hatch', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(37, 1, '2017-07-15', '2017-07-22', 'Reserved - Walter Burkley', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(38, 1, '2017-07-01', '2017-07-08', 'Reserved - Joanna Sattin', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(39, 1, '2016-07-09', '2016-07-16', 'Reserved - Sharon Seeley', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(40, 1, '2017-08-05', '2017-08-12', 'Reserved - Amanda Rooney', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(41, 1, '2015-10-17', '2015-10-20', 'Reserved - Kathy Francis', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(42, 1, '2016-10-01', '2016-10-03', 'Reserved - Renee Griffin', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(43, 1, '2017-07-22', '2017-07-29', 'Reserved - Donna Sterling', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(44, 1, '2016-07-23', '2016-07-30', 'Reserved - Taryn Lazroff', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(45, 1, '2017-06-10', '2017-06-17', 'Reserved - Mama singler', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(46, 1, '2016-09-24', '2016-10-01', 'Reserved - Rita Price', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(47, 1, '2017-04-02', '2017-04-09', 'Reserved - rick seymour', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(48, 1, '2015-10-20', '2015-10-24', 'Reserved - BW Block', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(49, 1, '2016-07-02', '2016-07-09', 'Reserved - Jan Woltermann Erschell Erschell', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(50, 1, '2016-05-28', '2016-06-04', 'Reserved - Bonnie Bradberry', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(51, 1, '2015-09-12', '2015-09-19', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(52, 1, '2015-09-26', '2015-10-03', 'Reserved - Bluewater', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(53, 1, '2016-11-19', '2016-11-26', 'Reserved - Lisa  Campbell', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(54, 1, '2016-10-08', '2016-10-15', 'Reserved - Betty  Haily', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(55, 1, '2016-08-06', '2016-08-13', 'Reserved - Elizabeth Mahanna', 2, 'ical', '0000-00-00', '2017-07-05', 1),
(111, 1, '2017-08-12', '2017-08-19', 'Reserved - Mary Ward', 1, '0', '0000-00-00', '2017-07-05', 1),
(112, 1, '2016-06-11', '2016-06-18', 'Reserved - Janice Joyner', 1, '0', '0000-00-00', '2017-07-05', 1),
(113, 1, '2016-09-03', '2016-09-10', 'Reserved - Korrie Singler', 1, '0', '0000-00-00', '2017-07-05', 1),
(114, 1, '2016-03-19', '2016-03-26', 'Reserved - brenda daniele', 1, '0', '0000-00-00', '2017-07-05', 1),
(115, 1, '2017-05-13', '2017-05-20', 'Reserved - Vivian Roeder', 1, '0', '0000-00-00', '2017-07-05', 1),
(116, 1, '2016-06-18', '2016-06-25', 'Reserved - shonnie singler', 1, '0', '0000-00-00', '2017-07-05', 1),
(117, 1, '2017-04-08', '2017-04-15', 'Reserved - Jeanie Pappalardo', 1, '0', '0000-00-00', '2017-07-05', 1),
(118, 1, '2017-07-22', '2017-07-29', 'Reserved - Donna Sterling', 1, '0', '0000-00-00', '2017-07-05', 1),
(119, 1, '2017-06-03', '2017-06-10', 'Reserved - Christine Rubeck', 1, '0', '0000-00-00', '2017-07-05', 1),
(120, 1, '2016-08-20', '2016-08-27', 'Reserved - Susan Jones', 1, '0', '0000-00-00', '2017-07-05', 1),
(121, 1, '2016-08-13', '2016-08-20', 'Reserved - Stephanie  Boone', 1, '0', '0000-00-00', '2017-07-05', 1),
(122, 1, '2016-04-03', '2016-04-09', 'Reserved - block for repairs', 1, '0', '0000-00-00', '2017-07-05', 1),
(123, 1, '2017-08-05', '2017-08-12', 'Reserved - Amanda Rooney', 1, '0', '0000-00-00', '2017-07-05', 1),
(124, 1, '2017-08-19', '2017-08-26', 'Reserved - Enrique Ruiz', 1, '0', '0000-00-00', '2017-07-05', 1),
(125, 1, '2016-04-16', '2016-05-21', 'Reserved - Block for repairs', 1, '0', '0000-00-00', '2017-07-05', 1),
(126, 1, '2016-09-24', '2016-10-01', 'Reserved - Susan Franklin', 1, '0', '0000-00-00', '2017-07-05', 1),
(127, 1, '2016-09-17', '2016-09-24', 'Reserved - Eric combs', 1, '0', '0000-00-00', '2017-07-05', 1),
(128, 1, '2017-07-01', '2017-07-08', 'Reserved - richard allen', 1, '0', '0000-00-00', '2017-07-05', 1),
(129, 1, '2017-11-18', '2017-11-25', 'Reserved - Greg Myers', 1, '0', '0000-00-00', '2017-07-05', 1),
(130, 1, '2015-11-21', '2015-11-28', 'Reserved - block BW Bluewater', 1, '0', '0000-00-00', '2017-07-05', 1),
(131, 1, '2016-07-16', '2016-07-23', 'Reserved - Margaret Hopkin', 1, '0', '0000-00-00', '2017-07-05', 1),
(132, 1, '2015-09-12', '2015-09-25', 'Reserved - block  Bluewater', 1, '0', '0000-00-00', '2017-07-05', 1),
(133, 1, '2015-07-02', '2015-07-09', 'Reserved - bw', 1, '0', '0000-00-00', '2017-07-05', 1),
(134, 1, '2017-07-29', '2017-08-05', 'Reserved - Eric Bowman', 1, '0', '0000-00-00', '2017-07-05', 1),
(135, 1, '2015-09-05', '2015-09-12', 'Reserved - block bluewater', 1, '0', '0000-00-00', '2017-07-05', 1),
(136, 1, '2016-07-09', '2016-07-16', 'Reserved - Marylynn Antonelli', 1, '0', '0000-00-00', '2017-07-05', 1),
(137, 1, '2015-10-10', '2015-10-17', 'Reserved - BW Block', 1, '0', '0000-00-00', '2017-07-05', 1),
(138, 1, '2015-10-03', '2015-10-10', 'Reserved - Patricia Graetz', 1, '0', '0000-00-00', '2017-07-05', 1),
(139, 1, '2017-04-22', '2017-04-29', 'Reserved - Roxann Ellis', 1, '0', '0000-00-00', '2017-07-05', 1),
(140, 1, '2017-06-24', '2017-07-01', 'Reserved - Jan  Wolterman Erschell', 1, '0', '0000-00-00', '2017-07-05', 1),
(141, 1, '2016-11-19', '2016-11-26', 'Reserved - Greg Myers', 1, '0', '0000-00-00', '2017-07-05', 1),
(142, 1, '2015-12-26', '2016-01-02', 'Reserved - Christine Parks', 1, '0', '0000-00-00', '2017-07-05', 1),
(143, 1, '2017-07-08', '2017-07-15', 'Reserved - Anglea  Hall', 1, '0', '0000-00-00', '2017-07-05', 1),
(144, 1, '2016-07-30', '2016-08-06', 'Reserved - Mary Ward', 1, '0', '0000-00-00', '2017-07-05', 1),
(145, 1, '2016-05-28', '2016-06-04', 'Reserved - cortenay mcdonough', 1, '0', '0000-00-00', '2017-07-05', 1),
(146, 1, '2016-09-10', '2016-09-17', 'Reserved - Laura Holton', 1, '0', '0000-00-00', '2017-07-05', 1),
(147, 1, '2015-10-17', '2015-10-24', 'Reserved - bw block', 1, '0', '0000-00-00', '2017-07-05', 1),
(148, 1, '2015-09-26', '2015-10-03', 'Reserved - BW Blocked', 1, '0', '0000-00-00', '2017-07-05', 1),
(149, 1, '2016-07-02', '2016-07-09', 'Reserved - Ray  Woltermann', 1, '0', '0000-00-00', '2017-07-05', 1),
(150, 1, '2017-05-20', '2017-05-27', 'Reserved - Lisa Laughlin', 1, '0', '0000-00-00', '2017-07-05', 1),
(151, 1, '2016-07-23', '2016-07-30', 'Reserved - shannon metz', 1, '0', '0000-00-00', '2017-07-05', 1),
(152, 1, '2016-06-04', '2016-06-11', 'Reserved - Karl Hecky', 1, '0', '0000-00-00', '2017-07-05', 1),
(153, 1, '2015-07-25', '2015-08-29', 'Reserved - existing reservations BW Bluewater', 1, '0', '0000-00-00', '2017-07-05', 1),
(154, 1, '2016-10-01', '2016-10-08', 'Reserved - Joedy Pennington', 1, '0', '0000-00-00', '2017-07-05', 1),
(155, 1, '2018-05-26', '2018-06-02', 'Reserved - Phil & Sonja Beaudoin', 1, '0', '0000-00-00', '2017-07-05', 1),
(156, 1, '2017-06-10', '2017-06-17', 'Reserved - Mama Singler', 1, '0', '0000-00-00', '2017-07-05', 1),
(157, 1, '2017-05-27', '2017-06-03', 'Reserved - Nicholas Knuettel', 1, '0', '0000-00-00', '2017-07-05', 1),
(158, 1, '2016-06-25', '2016-07-02', 'Reserved - Betty Anne Davidson', 1, '0', '0000-00-00', '2017-07-05', 1),
(159, 1, '2016-05-21', '2016-05-28', 'Reserved - Thomas Simpson', 1, '0', '0000-00-00', '2017-07-05', 1),
(160, 1, '2016-03-26', '2016-04-03', 'Reserved - Kenneth Mullins', 1, '0', '0000-00-00', '2017-07-05', 1),
(161, 1, '2017-09-02', '2017-09-09', 'Reserved - Karen Gunzel', 1, '0', '0000-00-00', '2017-07-05', 1),
(162, 1, '2017-06-17', '2017-06-24', 'Reserved - Melody Apthorpe', 1, '0', '0000-00-00', '2017-07-05', 1),
(163, 1, '2017-07-15', '2017-07-22', 'Reserved - Ann Nelson', 1, '0', '0000-00-00', '2017-07-05', 1),
(164, 1, '2016-08-06', '2016-08-13', 'Reserved - Sherry kendrick', 1, '0', '0000-00-00', '2017-07-05', 1),
(165, 1, '2016-04-09', '2016-04-16', 'Reserved - Patricia Graetz', 1, '0', '0000-00-00', '2017-07-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lhk_ical_links`
--

CREATE TABLE IF NOT EXISTS `lhk_ical_links` (
  `i_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `property_heading` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `add_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL,
  `ical_add_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_ical_links`
--

INSERT INTO `lhk_ical_links` (`i_id`, `property_id`, `admin_id`, `property_heading`, `link`, `add_date`, `update_date`, `ical_add_ip`) VALUES
(1, 2, 1, 'VRBO', 'http://admin.vrbo.com/icalendar/443ce4dccb694feca0df22b8a114aa89.ics', '2017-07-05 13:07:32', '2017-07-05 13:07:32', '182.64.68.81'),
(2, 1, 1, 'VRBO', 'http://admin.vrbo.com/icalendar/1337f4bbb9834966b7fb3fa988a4c4dd.ics', '2017-07-05 13:09:51', '2017-07-05 13:09:51', '182.64.68.81');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_login_details`
--

CREATE TABLE IF NOT EXISTS `lhk_login_details` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `admin_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_login_details`
--

INSERT INTO `lhk_login_details` (`admin_id`, `user_name`, `user_pass`, `last_login`, `admin_ip`) VALUES
(1, 'admin', '3d70aabc217294e5657fdcdf134d412f', '2017-07-05 13:28:57', '182.64.68.81');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_logo`
--

CREATE TABLE IF NOT EXISTS `lhk_logo` (
  `logo_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `logo_img` varchar(255) NOT NULL,
  `logo_inst_date` date NOT NULL,
  `logo_update_date` date DEFAULT NULL,
  `logo_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_meta_tbl`
--

CREATE TABLE IF NOT EXISTS `lhk_meta_tbl` (
  `id` int(21) NOT NULL,
  `admin_id` int(21) NOT NULL,
  `property_id` varchar(255) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_Canonical_Link` varchar(255) NOT NULL,
  `meta_Heading_Tag` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `update_date` date NOT NULL,
  `ical_add_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_payment_initiate`
--

CREATE TABLE IF NOT EXISTS `lhk_payment_initiate` (
  `pinit_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `prop_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` date NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lhk_payment_initiate`
--

INSERT INTO `lhk_payment_initiate` (`pinit_id`, `property_id`, `admin_id`, `prop_name`, `name`, `email`, `request_id`, `checkin`, `checkout`, `phone`, `added_date`, `ip`, `msg`) VALUES
(1, 0, 1, '', '', '', '', '0000-00-00', '0000-00-00', '', '2017-06-30', '', ''),
(2, 1, 1, 'Dune Castle West', 'sandeep Testing', 'sandeep19upadhyay@gmail.com', 'jKYRFk5rdY', '2017-06-30', '2017-07-08', '1234567890', '2017-06-30', '', 'dgfdfg'),
(3, 1, 1, 'Dune Castle West', 'sandeep Testing', 'sandeep19upadhyay@gmail.com', 'jKYRFk5rdY', '2017-06-30', '2017-07-08', '1234567890', '2017-06-30', '', 'dgfdfg'),
(4, 1, 1, 'Dune Castle West', 'sandeep Testing', 'sandeep19upadhyay@gmail.com', 'jKYRFk5rdY', '2017-06-30', '2017-07-08', '1234567890', '2017-06-30', '', 'dgfdfg'),
(5, 2, 1, 'Dune Castle East', 'craig singler', 'craig.singler@gmail.com', 'INEVm6IloE', '2017-07-15', '2017-07-22', '919-332-1409', '2017-07-05', '', ''),
(6, 2, 1, 'Dune Castle East', 'craig singler', 'craig.singler@gmail.com', 'INEVm6IloE', '2017-07-15', '2017-07-22', '919-332-1409', '2017-07-05', '', ''),
(7, 1, 1, 'Dune Castle West', 'BRUCE WATSON', 'bruce@personalwebsites.com', 'xi68TCo97d', '2017-08-01', '2017-08-08', '3473528281', '2017-07-05', '', 'TEST'),
(8, 1, 1, 'Dune Castle West', 'BRUCE WATSON', 'bruce@personalwebsites.com', 'xi68TCo97d', '2017-08-01', '2017-08-08', '3473528281', '2017-07-05', '', 'TEST'),
(9, 1, 1, 'Dune Castle West', 'BRUCE WATSON', 'bruce@personalwebsites.com', 'xi68TCo97d', '2017-08-01', '2017-08-08', '3473528281', '2017-07-05', '', 'TEST'),
(10, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing'),
(11, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing'),
(12, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing'),
(13, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing'),
(14, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing'),
(15, 1, 1, 'Dune Castle West', 'Rishabh Jaiswal', 'rishabhtech1990@gmail.com', 'TivSdue5TX', '2017-07-05', '2017-07-13', '1212121212', '2017-07-05', '', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_profile_details`
--

CREATE TABLE IF NOT EXISTS `lhk_profile_details` (
  `profile_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `profile_name` varchar(255) NOT NULL,
  `website_name` varchar(255) NOT NULL,
  `profile_inst_date` date NOT NULL,
  `profile_update_date` date NOT NULL,
  `profile_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_profile_details`
--

INSERT INTO `lhk_profile_details` (`profile_id`, `admin_id`, `profile_img`, `profile_name`, `website_name`, `profile_inst_date`, `profile_update_date`, `profile_ip`) VALUES
(1, 1, '../uploads/profile/no-images.jpg', 'shonell', '', '2017-06-26', '2017-06-26', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_property_back_details`
--

CREATE TABLE IF NOT EXISTS `lhk_property_back_details` (
  `pro_back_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pro_king_bed` varchar(255) NOT NULL,
  `pro_queen_bed` varchar(255) NOT NULL,
  `pro_single_bed` varchar(255) NOT NULL,
  `pro_double_bed` varchar(255) NOT NULL,
  `pro_twin_bed` varchar(255) NOT NULL,
  `pro_sofa_bed` varchar(255) NOT NULL,
  `pro_bunk_bed` varchar(255) NOT NULL,
  `pro_cribs` varchar(255) NOT NULL,
  `pro_cot` varchar(255) NOT NULL,
  `pro_insert_date` date NOT NULL,
  `pro_update_date` date NOT NULL,
  `pro_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_property_default_rates`
--

CREATE TABLE IF NOT EXISTS `lhk_property_default_rates` (
  `pro_def_rate_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pro_def_rate_rates` varchar(200) NOT NULL,
  `pro_def_rate_check_in` varchar(200) NOT NULL,
  `pro_def_rate_check_out` varchar(200) NOT NULL,
  `pro_def_rate_min_stay` varchar(100) NOT NULL,
  `pro_def_rate_currency` varchar(100) NOT NULL,
  `add_fees` varchar(100) NOT NULL,
  `pro_cleaning_fee` varchar(255) DEFAULT NULL,
  `pro_refundable_amt` varchar(100) DEFAULT NULL,
  `pro_tax_fee` varchar(100) DEFAULT NULL,
  `can_policy` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `extra_notes` longtext NOT NULL,
  `pro_def_insert_date` varchar(100) NOT NULL,
  `pro_def_update_date` varchar(100) DEFAULT NULL,
  `pro_def_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_property_default_rates`
--

INSERT INTO `lhk_property_default_rates` (`pro_def_rate_id`, `property_id`, `admin_id`, `pro_def_rate_rates`, `pro_def_rate_check_in`, `pro_def_rate_check_out`, `pro_def_rate_min_stay`, `pro_def_rate_currency`, `add_fees`, `pro_cleaning_fee`, `pro_refundable_amt`, `pro_tax_fee`, `can_policy`, `notes`, `extra_notes`, `pro_def_insert_date`, `pro_def_update_date`, `pro_def_ip`) VALUES
(1, 2, 1, '200', '', '', '', '', '12.75', NULL, '250', NULL, '100% refund if canceled at least 60 days before arrival date', '', '', '2017-06-26 11:12:30', NULL, '61.12.74.142'),
(2, 1, 1, '200', '', '', '', '', '12.75', NULL, '250', NULL, '&lt;section&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;50% refund if canceled at least 30 days before arrival date.&lt;/li&gt;\r\n	&lt;li&gt;100% refund if canceled at least 60 days before arrival date.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/section&gt;', '', '', '2017-06-26 11:17:28', NULL, '61.12.74.142');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_property_details`
--

CREATE TABLE IF NOT EXISTS `lhk_property_details` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `featured` varchar(50) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `property_heading` varchar(255) NOT NULL,
  `property_heading1` varchar(250) DEFAULT NULL,
  `property_heading2` varchar(250) DEFAULT NULL,
  `property_head_title` varchar(255) DEFAULT NULL,
  `property_content` longtext,
  `other_content1` longtext,
  `other_content2` longtext,
  `masterbedroom` longtext NOT NULL,
  `bedrooms2` longtext NOT NULL,
  `bedrooms3` longtext NOT NULL,
  `property_acc_type` varchar(255) DEFAULT NULL,
  `property_address` varchar(255) DEFAULT NULL,
  `property_latt` varchar(255) DEFAULT NULL,
  `property_long` varchar(255) DEFAULT NULL,
  `property_status` varchar(100) DEFAULT NULL,
  `property_type` varchar(255) DEFAULT NULL,
  `property_no_of_bedrooms` varchar(255) DEFAULT NULL,
  `property_no_of_sleeps` varchar(255) DEFAULT NULL,
  `property_no_of_baths` varchar(255) DEFAULT NULL,
  `property_floor` varchar(255) DEFAULT NULL,
  `property_feet` varchar(255) DEFAULT NULL,
  `property_garage` varchar(255) DEFAULT NULL,
  `property_elevator` varchar(100) DEFAULT NULL,
  `pro_det_insert_date` date NOT NULL,
  `pro_det_update_date` date DEFAULT NULL,
  `pro_det_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_property_details`
--

INSERT INTO `lhk_property_details` (`id`, `property_id`, `featured`, `loc_id`, `admin_id`, `property_heading`, `property_heading1`, `property_heading2`, `property_head_title`, `property_content`, `other_content1`, `other_content2`, `masterbedroom`, `bedrooms2`, `bedrooms3`, `property_acc_type`, `property_address`, `property_latt`, `property_long`, `property_status`, `property_type`, `property_no_of_bedrooms`, `property_no_of_sleeps`, `property_no_of_baths`, `property_floor`, `property_feet`, `property_garage`, `property_elevator`, `pro_det_insert_date`, `pro_det_update_date`, `pro_det_ip`) VALUES
(1, 1, '', 0, 1, 'Dune Castle West', NULL, NULL, 'A Family Friendly Oceanfront Beach Duplex with adjoining door', 'Fully furnished 4 Bedroom including 1 King, 3 Queens and 2 twins in the Loft. 2 full Baths with outside shower', '<p>Dunecastle is a duplex with an adjoining door which give access to the east side.<br />\r\n<br />\r\nOceanfront with spectacular view. Fully furnished 4 Bedroom including 1 King, 3 Queens and 2 twins in the Loft. 2 full Baths with outside shower. Full equipped kitchen with three HD Flat Screen TVs and DVD Player. Laundry Room with Washer and Dryer. Game room with Ping Pong. Nearby Fishing, Golf Course, Library, Public Boat Ramp, Resturants, Shops and Grocery Stores. There is also a Dollar General around the corner for the extra convince.</p>\r\n', '', '', 'Yes', '', '', '2411 Ocean Dr, Emerald Isle, NC 28594, USA', '-76.9532921', '34.6763469', 'for rent', 'House', '4', '10', '2', '', '230', '', '3-7', '2017-06-26', '2017-06-28', '61.12.74.142'),
(2, 2, '', 0, 1, 'Dune Castle East', NULL, NULL, 'Family Friendly Oceanfront Beach Duplex With Adjoining Door', 'Dunecastle is oceanfront duplex with a spectacular view, the cottage faces south so you unbelievable sun rises and sun sets', '<p>This is a duplex with an adjoining door that can give direct access to the West Side.<br />\r\n<br />\r\nDunecastle is oceanfront duplex with a spectacular view, the cottage faces south so you unbelievable sun rises and sun sets. Fully furnished 4 bedroom including 4 queens and 2 twins in the loft. 2 full baths with an outside shower. Fully equipped kitchen with three HD Flat Screen TVs and DVD player. Laundry room with washer &amp; dryer game room with ping pong, nearby fishing, golf course, library, public boat access, restaurants, shops, and grocery stores. There is also a Dollar General right around the corner.</p>\r\n', '', '', 'Yes', '', '', '102 S Main St, Leland, MI 49654, USA', '-76.9556524', '34.6760292', 'for rent', 'House', '4', '10', '2', '', '230', '', '3-7', '2017-06-26', '2017-06-28', '61.12.74.142');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_property_listing`
--

CREATE TABLE IF NOT EXISTS `lhk_property_listing` (
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `property_heading` varchar(255) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `pro_add_insert_date` date NOT NULL,
  `pro_add_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_property_listing`
--

INSERT INTO `lhk_property_listing` (`property_id`, `admin_id`, `loc_id`, `property_heading`, `property_status`, `pro_add_insert_date`, `pro_add_ip`) VALUES
(1, 1, 0, 'Dune Castle West', 'for rent', '2017-06-26', '127.0.0.1'),
(2, 1, 0, 'Dune Castle East', 'for rent', '2017-06-26', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_property_new_rates`
--

CREATE TABLE IF NOT EXISTS `lhk_property_new_rates` (
  `pro_new_rate_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pro_new_rate_desc` varchar(255) NOT NULL,
  `pro_new_rate_sdate` date NOT NULL,
  `pro_new_rate_edate` date NOT NULL,
  `pro_new_rate_weekend_nt` varchar(255) NOT NULL,
  `pro_new_rate_week_nt` varchar(255) NOT NULL,
  `pro_new_rate_weekly_nt` varchar(255) NOT NULL,
  `pro_new_rate_monthly` varchar(255) NOT NULL,
  `pro_new_rate_event` varchar(100) NOT NULL,
  `pro_new_rate_min_stay` varchar(255) NOT NULL,
  `basedonguest` varchar(100) NOT NULL,
  `guestpernoght` varchar(100) NOT NULL,
  `pro_new_insert_date` date NOT NULL,
  `pro_new_update_date` date NOT NULL,
  `pro_new_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_property_new_rates`
--

INSERT INTO `lhk_property_new_rates` (`pro_new_rate_id`, `property_id`, `admin_id`, `pro_new_rate_desc`, `pro_new_rate_sdate`, `pro_new_rate_edate`, `pro_new_rate_weekend_nt`, `pro_new_rate_week_nt`, `pro_new_rate_weekly_nt`, `pro_new_rate_monthly`, `pro_new_rate_event`, `pro_new_rate_min_stay`, `basedonguest`, `guestpernoght`, `pro_new_insert_date`, `pro_new_update_date`, `pro_new_ip`) VALUES
(1, 2, 0, 'Summer', '2017-06-17', '2017-08-18', '', '', '2935', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(2, 2, 0, 'Early Fall', '2017-08-19', '2017-09-15', '', '', '1935', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(3, 2, 0, 'Late Fall', '2017-09-16', '2017-12-30', '', '321', '1285', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(4, 2, 0, 'Standard Rate', '0000-00-00', '0000-00-00', '', '333', '1100', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(5, 1, 0, 'Summer', '2017-06-17', '2017-08-18', '', '', '2935', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(6, 1, 0, 'Early Fall', '2017-08-19', '2017-09-15', '', '', '1935', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(7, 1, 0, 'Late Fall', '2017-09-16', '2017-11-30', '', '321', '1285', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(8, 1, 0, 'Winter', '2018-01-06', '2018-03-03', '', '321', '1285', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(9, 1, 0, 'Early Spring', '2018-03-31', '2018-06-02', '', '', '1525', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(10, 1, 0, 'Spring', '2018-06-03', '2018-06-15', '', '', '1925', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(11, 1, 0, 'Summer', '2018-06-16', '2018-08-18', '', '', '2985', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(12, 1, 0, 'Late Summer', '2018-08-19', '2018-09-15', '', '', '1935', '', '', '7', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(13, 1, 0, 'Fall', '2018-09-16', '2018-12-29', '', '', '1285', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142'),
(14, 1, 0, 'Standard Rate', '0000-00-00', '0000-00-00', '', '333', '1235', '', '', '3', '', '', '2017-06-26', '0000-00-00', '61.12.74.142');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_restaurant`
--

CREATE TABLE IF NOT EXISTS `lhk_restaurant` (
  `current_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modify_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_reviews_detail`
--

CREATE TABLE IF NOT EXISTS `lhk_reviews_detail` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `c_review` longtext NOT NULL,
  `c_place` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  `r_update_date` date DEFAULT NULL,
  `r_ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_reviews_detail`
--

INSERT INTO `lhk_reviews_detail` (`id`, `property_id`, `admin_id`, `img`, `c_name`, `heading`, `c_review`, `c_place`, `added_date`, `r_update_date`, `r_ip`) VALUES
(1, 1, 1, '', 'Roxann E.', 'Fantastic family vacation', '<p>From the planning to the arrival, Shonell &amp; Craig were super helpful. I am a planner, I like to have all my bases covered and this was not a problem at all. All of my emails were answered promptly.</p>\r\n\r\n<p>The house is exactly as described. We rented both sides as we are a family group consisting of 4 generations. Parents with kids on one side and the &quot;old&quot; people on the other. The connecting door was very helpful. If the door was open, the grandchildren knew that Mem &amp; Pep were up and they were free to come join us for breakfast.</p>\r\n\r\n<p>The beach is very clean and not crowded. Everyone enjoyed the week and we can&#39;t wait to do it again.</p>\r\n\r\n<p>The only draw back for us was the charcoal grill. We are used to gas so we had to remember to start the charcoal well in advance of dinner.</p>\r\n', '', '2017-06-26', NULL, NULL),
(2, 1, 1, '', 'Koral W.', 'Just lovely!', '<p>Thank you for a wonderful time with our family! We have been going here for years and it has recently been updated. It&#39;s just beautiful.</p>\r\n\r\n<p>It has become our family&#39;s quiet place during the summer &amp; spring; a place to get refreshed.</p>\r\n\r\n<p>The owners are very accommodating and the house has everything you would just about need to make yourself at home for the week.</p>\r\n\r\n<p>We are grateful for your home!</p>\r\n\r\n<p>Cannot wait to go again! Thank you!!!!!!</p>\r\n', '', '2017-06-26', NULL, NULL),
(3, 1, 1, '', 'Sherry K.', 'Beautiful week', 'We had a great week at Dunecastle west. Nice accommodations and 4 bedrooms plus a loft if you need it. Can&#39;t beat being right on the beach. Only downside is charcoal grill not gas grill.', '', '2017-06-26', NULL, NULL),
(4, 1, 1, '', 'Jan W.', 'My home away from home', '<p>We have been staying at this property for 10 years now. Our family rents both the east and west units. For one week in the summer, I call this my summer home. It is always fun to come back each year and see the new improvements made. We have stayed in several properties on Emerald Isle, but Dune Castle East and West in our favorite! The duplex has a joining door in the living area so that the properties are joined with out going outside. The house has everything you need for a fantastic get away. We will definitely be back!</p>\r\n\r\n<p>Jan E</p>\r\n', '', '2017-06-26', NULL, NULL),
(5, 1, 1, '', 'Betty Anne D.', 'Fantastic location, great for small kids', '<p>Our family had a fantastic time staying at Dune Castle West.</p>\r\n\r\n<p>1) Absolute favorite thing: the location&mdash;Emerald Isle and beach front. Because of the layout of Emerald Isle, there&rsquo;s no particular part of the beach that is crowded at any point. That&rsquo;s saying a lot since we were there close to July 4th. We spent a good deal of time hanging out on the spacious back deck of the house, watching the waves. It was awesome being beach front.</p>\r\n\r\n<p>2) The porch also had a nice umbrella and picnic table where I fed my kids lunch every day. That way they didn&rsquo;t have to get cleaned up to come inside and eat lunch.</p>\r\n\r\n<p>3) The kitchen was well stocked with various pots and pans we needed. The granite counter tops are gorgeous! There was also plenty of cabinet space to put our food for the week away without having to leave everything on the counter tops.</p>\r\n\r\n<p>4) The thermostat seemed brand new. The air conditioning was able to keep up with all the people coming and going throughout the day from the humid outside to the air conditioned inside.</p>\r\n\r\n<p>5) Ceiling fans in a few of the rooms were a nice bonus as well.</p>\r\n\r\n<p>6) Dresser space &ndash; I unpacked my kids&rsquo; stuff as well as my husband and I&rsquo;s stuff into a few of the dressers available. The storage space was helpful.</p>\r\n\r\n<p>7) Kid friendly - I have a 3 yr old and a 5 yr old and the house was pretty conducive to them. There were cute plastic fish-plates in cupboard that they used as well as kid-sized silverware. There was enough space in the bedrooms where kids could sleep on the floor with no problem.</p>\r\n\r\n<p>8) Laundry facilities &ndash; I used the washer and dryer in the downstairs area all week long. I definitely appreciated this convenience.</p>\r\n\r\n<p>9) Very cool aquarium nearby &ndash; I think it was a 15 min drive to the aquarium. My kids loved it.</p>\r\n\r\n<p>10) Incredibly responsive owner - I must&rsquo;ve asked 10,000 questions before, during and a few after our trip. Shonell was always so quick to respond. Even when I discovered a lot of my questions were already answered in the HomeAway app (hospitality tab) that I didn&rsquo;t realize was there. Bless you Shonell for being so kind to me!</p>\r\n\r\n<p>Overall we had a fabulous time and would highly recommend this house to any vacationers.</p>\r\n', '', '2017-06-26', NULL, NULL),
(6, 1, 1, '', 'Karl H.', 'Clean and well supplied. stayed June 4th to 11th 2016', '<p>My wife and I had a great time at Dune Castle West with our daughter, son in law and three grandchildren. The beach house is a perfect layout for this size family and I am glad to have found it. Being right on the beach was a real convenience for the many trips back and forth to retrieve a forgotten item or to grab a snack from the kitchen. We had a large canopy that we hauled down to the beach every morning which I highly suggest if you plan on staying on the beach for most of the day. The canopy provided us with the perfect shaded area to sit and watch the grandkids play in the surf and sand.</p>\r\n\r\n<p>We were especially grateful for the well supplied and clean accommodations that greeted us when we arrived. Dune Castle West, for us was all that was advertised and made our vacation one we will always remember.</p>\r\n\r\n<p>I do suggest that you check out Catherine&#39;s Martini Bar and Grill for the best meal you could imagine, excellent food.</p>\r\n\r\n<p>Honestly the only thing that could have made this vacation any better is if it were longer.</p>\r\n', '', '2017-06-26', NULL, NULL),
(7, 1, 1, '', 'Cortenay M.', 'Four Generation Family Gathering', '<p>The pictures don&#39;t show how much this house has been worked on and updated. I love the new blue color and there are new windows and the deck and balconies have been updated as well. This fit 4 generations. We held a wedding on the beach, and had a great time. They only thing I wish was that it had more than 2 bathrooms but we made it work. The owners were available whenever we had a question. A good vacation home for all.</p>\r\n', '', '2017-06-26', NULL, NULL),
(8, 1, 1, '', 'Patricia G.', 'Very nice owners', '<p>We had to cancel our family trip in October because of a hurricane and the owners were kind enough to accommodate us with a comp week. The house was what we expected.</p>\r\n', '', '2017-06-26', NULL, NULL),
(9, 1, 1, '', 'Kenneth M.', 'Fantastic stay - restful retreat for two families', '<p>We had a wonderful stay at Dune Castle West....a restful retreat for two families (4 adults/5 kids) plus one dog! The location is great....with unbelievable views....enjoying sunrises and sunsets. The overall layout worked very well for our two families....allowing for privacy....but the open family room/kitchen area is great for interacting. We also especially enjoyed the balcony off the upper master bedroom....wonderful for star gazing. Dune Castle West is a great home if you just want to plant yourself on the beach for a week....or if you want to use it as a home base while exploring the Crystal Coast.</p>\r\n', '', '2017-06-26', NULL, NULL),
(10, 1, 1, '', 'Anonymous', 'New Years week - multigenerational family retreat', '<p>We loved our time at Dune Castle West - it was exactly what we needed for our small, multigenerational retreat at the beach. The beds and bedrooms were comfortable and nicely decorated, and the general house layout was perfect for our family - grandma, parents and grandkids, plus our small dog. Access to the beach was easy and we loved getting out to walk several times a day. The upstairs master bedroom balcony was also great for enjoying private time and watching the kids down at the beach. The open design facilitated family gatherings. Topping it off, the ping pong table downstairs was a perfect place to go burn off energy and play together, and was great especially when it rained. I still have fond memories of the sounds of the kids playing and laughing while I worked on dinner. The kitchen had everything we needed to prepare healthy meals and even birthday cupcakes. It was hard to leave!!!</p>\r\n', '', '2017-06-26', NULL, NULL),
(11, 2, 1, '', 'Christopher H.', 'Great location', 'The house is in a great location and is perfect for families - just a short walk over the dunes on the walkway and you are on the beach. Far enough away from the main area that it is quiet, but close enough to be able to enjoy the amenities of the area. The kitchen was nice for cooking for our group of 8 and accommodating the 2 toddlers with us. Lots of room inside for the adults to have privacy and the kids to run amuck. The carpet could have used a little bit more cleaning attention prior to arrival and the owners could have been more communicative when issues arose, but overall, we would stay again.', '', '2017-06-26', NULL, NULL),
(12, 2, 1, '', 'Ashlie H.', 'Great private access to the beach', '<p>Very clean. Great private access to the beach. Nice open floor plan for visiting with family. Beautiful beach view. The kids loved having a &quot;sleepover&quot; in the loft. Some days we didn&#39;t even need to walk down to the beach. We got to enjoy it right from the comfort of the deck.</p>\r\n', '', '2017-06-26', NULL, NULL),
(13, 2, 1, '', 'Roxann E.', 'Fantastic Vacation', '<p>We are a multi-generational group , ranging in age from 3-73. Four generations vacationing together.</p>\r\n\r\n<p>We rented East &amp; West . It was nice for us &quot;older&quot; folks(as much as we love the grands) to shut our door and have some quiet time. The connecting door made it easy to be together for meals and socializing.</p>\r\n\r\n<p>All in all, it was a fantastic week. The grand children loved the fact that they could go to see Mem &amp; Pep every morning for breakfast ( as long as the connecting door was open, they knew we were up and it was ok to enter) . The weather was darn near perfect.</p>\r\n\r\n<p>On the two days that it did rain, we went to the Maritime museum. The older kids 8-11 enjoyed this, the younger kids, not so much. We also went to the Aquarium, a big hit for everyone.</p>\r\n\r\n<p>Again, I would like to thank Shonell &amp; Craig for all the help in answering questions and helping me to prepare for our vacation.</p>\r\n', '', '2017-06-26', NULL, NULL),
(14, 2, 1, '', 'Rick S.', 'Great place', 'Sometimes you just get lucky. I started looking for a place to go and spend a relaxing week on a beach somewhere. I started my search from the Gulf and worked my way up the east coast. Dune Castle was not recommended by anyone I knew, I just stumbled upon it and it turned out to be one of the best relaxing type vacations we have been on. It was everything I was looking for. Clean, comfortable, well equipped and right on the beach. There was only my wife and I so we rattled around in all that room but it would be equally as comfortable for any family or group. I will stay there again and would highly recommend Dune Castle to others.', '', '2017-06-26', NULL, NULL),
(15, 2, 1, '', 'Cindy K.', 'Paradise!', 'I would highly recommend Dune Castle East. My husband and I and our two adult children and their spouses had an amazing time! The view of the ocean from the deck was breathtaking and the short walk to the beach was great! The house was well equipped for the amount of people that we had staying there. We would definitely rent this property again.', '', '2017-06-26', NULL, NULL),
(16, 2, 1, '', 'Della R.', 'Our stay was great. Owners were very responsive to our inquires while we were there', 'We haven&#39;t stayed in an ocean front property in a long time and had forgotten how nice it is to witness the activity on the beach', '', '2017-06-26', NULL, NULL),
(17, 2, 1, '', 'Taryn L.', 'Wonderful!! Perfect beach location!', 'We had such a great stay this last week!!! My family of 4 went with friends who are a family of 5, and the house was plenty of room for 4 adults and 5 kids!! It was perfectly located right on the beach! You can see the ocean out the living room window!! It was our first time to Emerald Isle, but we will definitely be returning, and will hopefully get to stay at Dune Castle again!!!', '', '2017-06-26', NULL, NULL),
(18, 2, 1, '', 'Jan W.', 'My home away from home', '<p>We have been staying at this property for 10 years now. Our family rents both the east and west units. For one week in the summer, I call this my summer home. It is always fun to come back each year and see the new improvements made. We have stayed in several properties on Emerald Isle, but Dune Castle East and West in our favorite! The duplex has a joining door in the living area so that the properties are joined with out going outside. The house has everything you need for a fantastic get away. We will definitely be back!</p>\r\n\r\n<p>Jan E</p>\r\n', '', '2017-06-26', NULL, NULL),
(19, 2, 1, '', 'Cyndie K.', 'Dune Castle East July 2, 2016', '<p>Had a great stay during the week of June 25 till July 2, 2016. House was very clean and comfortable. Only suggestion is to leave a list of channels for the cable TV, other wise, everything was very nice and has great views of the ocean!! Would recommend to friends and family. House has a great proximity to shops, restaurants, mini golf, and the aquarium at Pine Knoll Shores ( which we highly recommend)!!</p>\r\n', '', '2017-06-26', NULL, NULL),
(20, 2, 1, '', 'Heidi S.', 'Amazing waterfront property with all the amenities!', '<p>June 18-25</p>\r\n\r\n<p>My family and I traveled to Emerald Isle, NC for our first stay in the area. First and foremost, what a wonderful experience. This is truly a family-friendly oceanfront beach duplex. While we only rented 1/2, we found this home to be quite spacious. Having 2 full bathrooms is truly a plus!</p>\r\n\r\n<p>Whether you just want to wade in the warm waters of NC or tackle some fishing on the pier, there are things to do for all. Everything is close; restaurants, grocery stores, aquarium, fishing, boating, etc. - you will not be disappointed.</p>\r\n\r\n<p>During our stay we found everything to be in perfect working order - right down to the crockpot. Spacious kitchen provided with every imaginable pot/pan you could imagine making our meals quite easy.</p>\r\n\r\n<p>Part of the process researching homes is to read up on reviews prior to booking. It gives folks a change to hear first-hand about one&#39;s experience. For me, I would make only one recommendation for this rental and that would be to provide linens to travelers. When I&#39;m traveling, having those linens available makes life that much simpler and one less item to worry about during the entire process.</p>\r\n\r\n<p>Would I rent here again? You bet. Perfect family setting with an equally amazing host family as well. Great memories for all of us and I do look forward to a future stay at this location.</p>\r\n\r\n<p>Thank you, Singler Family!</p>\r\n\r\n<p>ox</p>\r\n', '', '2017-06-26', NULL, NULL),
(21, 2, 1, '', 'Anonymous', 'Amazing week', '<p>We loved staying at Dune Castle East! Amazing view, right on the beach. We&#39;ll be back!</p>\r\n', '', '2017-06-26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lhk_social_links`
--

CREATE TABLE IF NOT EXISTS `lhk_social_links` (
  `social_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkdin` varchar(255) NOT NULL,
  `instragram` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `social_status` int(11) NOT NULL,
  `social_insert_date` date NOT NULL,
  `social_update_date` date DEFAULT NULL,
  `social_ip` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_social_links`
--

INSERT INTO `lhk_social_links` (`social_id`, `admin_id`, `facebook`, `twitter`, `linkdin`, `instragram`, `google_plus`, `social_status`, `social_insert_date`, `social_update_date`, `social_ip`) VALUES
(1, 1, 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.pinterest.com/', 'https://www.instagram.com/', '', 1, '2017-06-26', NULL, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_subscribe`
--

CREATE TABLE IF NOT EXISTS `lhk_subscribe` (
  `sub_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `statuss` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_tbl_area_information`
--

CREATE TABLE IF NOT EXISTS `lhk_tbl_area_information` (
  `area_id` int(11) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_tbl_highlights`
--

CREATE TABLE IF NOT EXISTS `lhk_tbl_highlights` (
  `high_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `menu_order` varchar(100) NOT NULL,
  `create_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_tbl_things_files`
--

CREATE TABLE IF NOT EXISTS `lhk_tbl_things_files` (
  `image_id` int(11) NOT NULL,
  `current_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_order` int(11) NOT NULL,
  `uploaded_img_date` date NOT NULL,
  `updated_img_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lhk_tpl_location`
--

CREATE TABLE IF NOT EXISTS `lhk_tpl_location` (
  `loc_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `loc_title` varchar(200) NOT NULL,
  `loc_img` varchar(200) NOT NULL,
  `loc_content` longtext NOT NULL,
  `loc_address` varchar(255) NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lhk_tpl_location`
--

INSERT INTO `lhk_tpl_location` (`loc_id`, `admin_id`, `loc_title`, `loc_img`, `loc_content`, `loc_address`, `create_date`, `update_date`) VALUES
(1, 1, 'S2F1YSdpIEFjdGl2aXRpZXM=', '', 'Soak up some sunshine and spend the day on the beach just steps away from our hotel. Once you&#39;ve enjoyed some fun in the sun, explore the local flavors and nearby hotspots like surf shops and boutique stores within walking distance. Nestled directly behind Bogue Inlet Fishing Pier, get easy access to this popular attraction whether you can wait for the fish to bite or enjoy the thrilling excitement of water sports. If you&#39;d rather admire the sea life than catch some, head to the NC Aquarium to see the impressive displays and colorful tropical varieties...', '', '', '2017-06-27 08:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `lhk_transaction`
--

CREATE TABLE IF NOT EXISTS `lhk_transaction` (
  `trans_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `prop_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trans_phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trans_amt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_curr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trans_checkin` date NOT NULL,
  `trans_checkout` date NOT NULL,
  `request_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  `trans_date` date NOT NULL,
  `trans_status` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lhk_transaction`
--

INSERT INTO `lhk_transaction` (`trans_id`, `property_id`, `admin_id`, `prop_name`, `transaction_id`, `trans_email`, `trans_name`, `trans_phone`, `trans_amt`, `trans_curr`, `trans_checkin`, `trans_checkout`, `request_id`, `msg`, `trans_date`, `trans_status`) VALUES
(1, 1, 1, 'Dune Castle West', '2SJ412975N562253P', 'sandeep19upadhyay@gmail.com', 'sandeep Testing', '1234567890', '10.00', 'USD', '2017-06-30', '2017-07-08', 'jKYRFk5rdY', 'dgfdfg', '2017-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lhk_why_dewey`
--

CREATE TABLE IF NOT EXISTS `lhk_why_dewey` (
  `why_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `added_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ical_events`
--
ALTER TABLE `ical_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `lhk_about_details`
--
ALTER TABLE `lhk_about_details`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `lhk_about_property`
--
ALTER TABLE `lhk_about_property`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `lhk_alternate_details`
--
ALTER TABLE `lhk_alternate_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `lhk_amenities_details`
--
ALTER TABLE `lhk_amenities_details`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `lhk_amenity`
--
ALTER TABLE `lhk_amenity`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `lhk_amenity_details`
--
ALTER TABLE `lhk_amenity_details`
  ADD PRIMARY KEY (`amen_id`);

--
-- Indexes for table `lhk_area_detail`
--
ALTER TABLE `lhk_area_detail`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `lhk_area_info`
--
ALTER TABLE `lhk_area_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lhk_beach_place`
--
ALTER TABLE `lhk_beach_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lhk_beach_rules`
--
ALTER TABLE `lhk_beach_rules`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `lhk_booking_details`
--
ALTER TABLE `lhk_booking_details`
  ADD PRIMARY KEY (`bok_det_id`);

--
-- Indexes for table `lhk_client_details`
--
ALTER TABLE `lhk_client_details`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `lhk_contact_details`
--
ALTER TABLE `lhk_contact_details`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `lhk_current_special`
--
ALTER TABLE `lhk_current_special`
  ADD PRIMARY KEY (`current_id`);

--
-- Indexes for table `lhk_dewey_facts`
--
ALTER TABLE `lhk_dewey_facts`
  ADD PRIMARY KEY (`fact_id`);

--
-- Indexes for table `lhk_files`
--
ALTER TABLE `lhk_files`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `lhk_front_attraction`
--
ALTER TABLE `lhk_front_attraction`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `lhk_gallery`
--
ALTER TABLE `lhk_gallery`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `lhk_home_details`
--
ALTER TABLE `lhk_home_details`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `lhk_ical_events`
--
ALTER TABLE `lhk_ical_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `lhk_ical_links`
--
ALTER TABLE `lhk_ical_links`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `lhk_login_details`
--
ALTER TABLE `lhk_login_details`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `lhk_logo`
--
ALTER TABLE `lhk_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `lhk_meta_tbl`
--
ALTER TABLE `lhk_meta_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lhk_payment_initiate`
--
ALTER TABLE `lhk_payment_initiate`
  ADD PRIMARY KEY (`pinit_id`);

--
-- Indexes for table `lhk_profile_details`
--
ALTER TABLE `lhk_profile_details`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `lhk_property_back_details`
--
ALTER TABLE `lhk_property_back_details`
  ADD PRIMARY KEY (`pro_back_id`);

--
-- Indexes for table `lhk_property_default_rates`
--
ALTER TABLE `lhk_property_default_rates`
  ADD PRIMARY KEY (`pro_def_rate_id`);

--
-- Indexes for table `lhk_property_details`
--
ALTER TABLE `lhk_property_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lhk_property_listing`
--
ALTER TABLE `lhk_property_listing`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `lhk_property_new_rates`
--
ALTER TABLE `lhk_property_new_rates`
  ADD PRIMARY KEY (`pro_new_rate_id`);

--
-- Indexes for table `lhk_restaurant`
--
ALTER TABLE `lhk_restaurant`
  ADD PRIMARY KEY (`current_id`);

--
-- Indexes for table `lhk_reviews_detail`
--
ALTER TABLE `lhk_reviews_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lhk_social_links`
--
ALTER TABLE `lhk_social_links`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `lhk_subscribe`
--
ALTER TABLE `lhk_subscribe`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `lhk_tbl_area_information`
--
ALTER TABLE `lhk_tbl_area_information`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `lhk_tbl_highlights`
--
ALTER TABLE `lhk_tbl_highlights`
  ADD PRIMARY KEY (`high_id`);

--
-- Indexes for table `lhk_tbl_things_files`
--
ALTER TABLE `lhk_tbl_things_files`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `lhk_tpl_location`
--
ALTER TABLE `lhk_tpl_location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `lhk_transaction`
--
ALTER TABLE `lhk_transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `lhk_why_dewey`
--
ALTER TABLE `lhk_why_dewey`
  ADD PRIMARY KEY (`why_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ical_events`
--
ALTER TABLE `ical_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_about_details`
--
ALTER TABLE `lhk_about_details`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lhk_about_property`
--
ALTER TABLE `lhk_about_property`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_alternate_details`
--
ALTER TABLE `lhk_alternate_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_amenities_details`
--
ALTER TABLE `lhk_amenities_details`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_amenity`
--
ALTER TABLE `lhk_amenity`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `lhk_amenity_details`
--
ALTER TABLE `lhk_amenity_details`
  MODIFY `amen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT for table `lhk_area_detail`
--
ALTER TABLE `lhk_area_detail`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_area_info`
--
ALTER TABLE `lhk_area_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lhk_beach_place`
--
ALTER TABLE `lhk_beach_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_beach_rules`
--
ALTER TABLE `lhk_beach_rules`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_booking_details`
--
ALTER TABLE `lhk_booking_details`
  MODIFY `bok_det_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `lhk_client_details`
--
ALTER TABLE `lhk_client_details`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_contact_details`
--
ALTER TABLE `lhk_contact_details`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_current_special`
--
ALTER TABLE `lhk_current_special`
  MODIFY `current_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lhk_dewey_facts`
--
ALTER TABLE `lhk_dewey_facts`
  MODIFY `fact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_files`
--
ALTER TABLE `lhk_files`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `lhk_front_attraction`
--
ALTER TABLE `lhk_front_attraction`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_gallery`
--
ALTER TABLE `lhk_gallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_home_details`
--
ALTER TABLE `lhk_home_details`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_ical_events`
--
ALTER TABLE `lhk_ical_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `lhk_ical_links`
--
ALTER TABLE `lhk_ical_links`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lhk_login_details`
--
ALTER TABLE `lhk_login_details`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lhk_logo`
--
ALTER TABLE `lhk_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_meta_tbl`
--
ALTER TABLE `lhk_meta_tbl`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_payment_initiate`
--
ALTER TABLE `lhk_payment_initiate`
  MODIFY `pinit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lhk_profile_details`
--
ALTER TABLE `lhk_profile_details`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_property_back_details`
--
ALTER TABLE `lhk_property_back_details`
  MODIFY `pro_back_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_property_default_rates`
--
ALTER TABLE `lhk_property_default_rates`
  MODIFY `pro_def_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lhk_property_details`
--
ALTER TABLE `lhk_property_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lhk_property_listing`
--
ALTER TABLE `lhk_property_listing`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lhk_property_new_rates`
--
ALTER TABLE `lhk_property_new_rates`
  MODIFY `pro_new_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `lhk_restaurant`
--
ALTER TABLE `lhk_restaurant`
  MODIFY `current_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_reviews_detail`
--
ALTER TABLE `lhk_reviews_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `lhk_social_links`
--
ALTER TABLE `lhk_social_links`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_subscribe`
--
ALTER TABLE `lhk_subscribe`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_tbl_area_information`
--
ALTER TABLE `lhk_tbl_area_information`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_tbl_highlights`
--
ALTER TABLE `lhk_tbl_highlights`
  MODIFY `high_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_tbl_things_files`
--
ALTER TABLE `lhk_tbl_things_files`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lhk_tpl_location`
--
ALTER TABLE `lhk_tpl_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_transaction`
--
ALTER TABLE `lhk_transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lhk_why_dewey`
--
ALTER TABLE `lhk_why_dewey`
  MODIFY `why_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
