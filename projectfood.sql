-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 11:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `fid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` int(11) NOT NULL,
  `price` float NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `name`, `type`, `price`, `pic`) VALUES
(1, 'กระเพราหมูสับ', 1, 45, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.proudofficials.com%2Frecipe%2FFried-stir-basil-with-minced-pork-1&psig=AOvVaw3IcVLXYWW1I_MpGbkllpOm&ust=1678946120568000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCJCfguuf3f0CFQAAAAAdAAAAABAE'),
(2, 'ข้าวขาหมู', 1, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fth.theasianparent.com%2Fstewed-pork-leg-on-rice&psig=AOvVaw1CVwdWKLU7HU0gt5K6NtY0&ust=1678946414087000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCNCb6_ag3f0CFQAAAAAdAAAAABAE'),
(3, 'ข้าวไข่เจียว', 1, 40, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpantip.com%2Ftopic%2F34212466&psig=AOvVaw3adlTkQvYmIi_Yyya5kI33&ust=1678946566177000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKDCr7-h3f0CFQAAAAAdAAAAABAE'),
(4, 'ข้าวคลุกกะปิ', 1, 45, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wongnai.com%2Frecipes%2Fugc%2F0d33552b654c406898acee4a105c200c&psig=AOvVaw21TZwbYvQtsmmmNRMl4NuF&ust=1678954369495000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCMj4uMi-3f0CFQAAAAAdAAAAABAO'),
(5, 'ข้าวผัดกุ้ง', 1, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fcookpad.com%2Fth%2Frecipes%2F11710894-%25E0%25B8%2582%25E0%25B8%25B2%25E0%25B8%25A7%25E0%25B8%259C%25E0%25B8%2594%25E0%25B8%2581%25E0%25B8%2587&psig=AOvVaw2TOAAW9oG9yfMLP5hOHonY&ust=1678954446286000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCJChiO2-3f0CFQAAAAAdAAAAABAE'),
(6, 'ผัดผงกะหรี่ทะเล', 1, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.food-trick.com%2Fnews6363.html&psig=AOvVaw2ghWREMNEj4C1vZe_DCSN-&ust=1678954555934000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCOiFrqG_3f0CFQAAAAAdAAAAABAb'),
(7, 'ข้าวมันไก่', 1, 40, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.thairath.co.th%2Flifestyle%2Ffood%2F2447933&psig=AOvVaw11lk947K3kkDekB7sDz2nr&ust=1678954651997000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLD4886_3f0CFQAAAAAdAAAAABAE'),
(8, 'ข้าวหมูแดง', 1, 45, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.smeleader.com%2F%25E0%25B8%25A3%25E0%25B8%25A7%25E0%25B8%25A1%25E0%25B8%25AA%25E0%25B8%25B9%25E0%25B8%2595%25E0%25B8%25A3%25E0%25B8%2582%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B8%25A7%25E0%25B8%25AB%25E0%25B8%25A1%25E0%25B8%25B9%25E0%25B9%2581%25E0%25B8%2594%25E0%25B8%2587%2F&psig=AOvVaw3AYE5TRZgoB7jqSDZSVcLo&ust=1678954696121000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCPiR-OO_3f0CFQAAAAAdAAAAABAb'),
(9, 'หมูทอดกระเทียม', 1, 45, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpantip.com%2Ftopic%2F38932049&psig=AOvVaw2zRl8gk7FNcsPovE5cUc-a&ust=1678954821057000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKCT2J_A3f0CFQAAAAAdAAAAABAg'),
(10, 'ผัดไทย', 1, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.sanook.com%2Fwomen%2F185369%2F&psig=AOvVaw0YT1EiblNCgunOx6osGm0p&ust=1678954944638000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCJDBztrA3f0CFQAAAAAdAAAAABAE'),
(11, 'แกงเขียวหวาน', 2, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fguide.michelin.com%2Fth%2Fth%2Farticle%2Fdining-in%2Fhow-to-make-thai-green-curry-like-a-michelin-starred-restaurant&psig=AOvVaw0a8DyKP4-Y67WXKw16iurC&ust=1678954983022000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIiq5uzA3f0CFQAAAAAdAAAAABAE'),
(12, 'แกงส้ม', 2, 70, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ajinomoto.co.th%2Fth%2Frecipe%2F%25E0%25B8%25A7%25E0%25B8%25B4%25E0%25B8%2598%25E0%25B8%25B5%25E0%25B8%2597%25E0%25B8%25B3%25E0%25B9%2581%25E0%25B8%2581%25E0%25B8%2587%25E0%25B8%25AA%25E0%25B9%2589%25E0%25B8%25A1%25E0%25B8%2581%25E0%25B8%25B8%25E0%25B9%2589%25E0%25B8%2587%25E0%25B8%259C%25E0%25B8%25B1%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25A7%25E0%25B8%25A1&psig=AOvVaw2vwBj_oKNxLFy6LfKfq0wd&ust=1678955056226000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIiH3I_B3f0CFQAAAAAdAAAAABAE'),
(13, 'ต้มยำกุ้ง', 2, 80, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Ftravel.kapook.com%2Fview242610.html&psig=AOvVaw2DoQUxUcAyqheTpRqX5PeG&ust=1678955202741000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKjmxdXB3f0CFQAAAAAdAAAAABAI'),
(14, 'ไข่พะโล้', 2, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wongnai.com%2Frecipes%2Fugc%2F31ac8ea3cace4aac8758a1ab59c6dea7&psig=AOvVaw1BX833sx3dsZA_BaO3fFzu&ust=1678955122356000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLD5l6_B3f0CFQAAAAAdAAAAABAE\r\n'),
(15, 'น้ำตกหมู', 2, 60, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wongnai.com%2Frecipes%2Fslide-grilled-pork-salad&psig=AOvVaw06kX0ksutewSaw98LFm5ep&ust=1678955246116000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCNDeoOrB3f0CFQAAAAAdAAAAABAE'),
(16, 'ปลาสามรส', 2, 80, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fchefoldschool.com%2F2020%2F06%2F17%2F%25E0%25B8%259B%25E0%25B8%25A5%25E0%25B8%25B2%25E0%25B8%2597%25E0%25B8%25B1%25E0%25B8%259A%25E0%25B8%2597%25E0%25B8%25B4%25E0%25B8%25A1%25E0%25B8%25AA%25E0%25B8%25B2%25E0%25B8%25A1%25E0%25B8%25A3%25E0%25B8%25AA-%25E0%25B9%2580%25E0%25B8%25A1%25E0%25B8%2599%25E0%25B8%25B9%25E0%25B8%25AD%25E0%25B8%25B2%25E0%25B8%25AB%25E0%25B8%25B2%2F&psig=AOvVaw0gKPK-6kLZrwSD7VMBJf0v&ust=1678955301926000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIDI-4TC3f0CFQAAAAAdAAAAABAI'),
(17, 'ปูผัดผงกะหรี่', 2, 120, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.sgethai.com%2Farticle%2F5-%25E0%25B8%25AA%25E0%25B8%25B9%25E0%25B8%2595%25E0%25B8%25A3%25E0%25B9%2580%25E0%25B8%2594%25E0%25B9%2587%25E0%25B8%2594-%25E0%25B8%259B%25E0%25B8%25B9%25E0%25B8%259C%25E0%25B8%25B1%25E0%25B8%2594%25E0%25B8%259C%25E0%25B8%2587%25E0%25B8%2581%25E0%25B8%25B0%25E0%25B8%25AB%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B9%2588%2F&psig=AOvVaw2X2aOWf6FD-UrgC8KaFo1g&ust=1678955359359000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLCgr6DC3f0CFQAAAAAdAAAAABAE'),
(18, 'ผัดเผ็ดปลาดุก', 2, 60, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fkrua.co%2Frecipe%2F%25E0%25B8%259C%25E0%25B8%25B1%25E0%25B8%2594%25E0%25B9%2580%25E0%25B8%259C%25E0%25B9%2587%25E0%25B8%2594%25E0%25B8%259B%25E0%25B8%25A5%25E0%25B8%25B2%25E0%25B8%2594%25E0%25B8%25B8%25E0%25B8%2581%2F&psig=AOvVaw1VzDt62x5D1ELPBHb4VOVR&ust=1678955454394000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCICU2M3C3f0CFQAAAAAdAAAAABAE'),
(19, 'ลาบหมู', 2, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ietr.org%2F%25E0%25B8%25A5%25E0%25B8%25B2%25E0%25B8%259A%25E0%25B8%25AB%25E0%25B8%25A1%25E0%25B8%25B9-%25E0%25B9%2580%25E0%25B8%25A1%25E0%25B8%2599%25E0%25B8%25B9%25E0%25B8%25AA%25E0%25B8%25B8%25E0%25B8%2594%25E0%25B9%2580%25E0%25B9%2580%25E0%25B8%258B%25E0%25B9%2588%25E0%25B8%259A-%25E0%25B8%2581%25E0%25B8%25B1%25E0%25B8%259A%25E0%25B8%25AA%2F&psig=AOvVaw2ZDx9aZNhFqLDXK_ZJABBi&ust=1678955498612000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCOj2zuLC3f0CFQAAAAAdAAAAABAE'),
(20, 'ส้มตำ', 2, 40, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fhellokhunmor.com%2F%25E0%25B9%2582%25E0%25B8%25A0%25E0%25B8%258A%25E0%25B8%2599%25E0%25B8%25B2%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%25A3%25E0%25B9%2580%25E0%25B8%259E%25E0%25B8%25B7%25E0%25B9%2588%25E0%25B8%25AD%25E0%25B8%25AA%25E0%25B8%25B8%25E0%25B8%2582%25E0%25B8%25A0%25E0%25B8%25B2%25E0%25B8%259E%2F%25E0%25B8%25AA%25E0%25B8%25B9%25E0%25B8%2595%25E0%25B8%25A3%25E0%25B8%25AD%25E0%25B8%25B2%25E0%25B8%25AB%25E0%25B8%25B2%25E0%25B8%25A3%25E0%25B9%2580%25E0%25B8%259E%25E0%25B8%25B7%25E0%25B9%2588%25E0%25B8%25AD%25E0%25B8%25AA%25E0%25B8%25B8%25E0%25B8%2582%25E0%25B8%25A0%25E0%25B8%25B2%25E0%25B8%259E%2F%25E0%25B8%25AA%25E0%25B8%25B9%25E0%25B8%2595%25E0%25B8%25A3%25E0%25B8%25AA%25E0%25B9%2589%25E0%25B8%25A1%25E0%25B8%2595%25E0%25B8%25B3%25E0%25B9%2584%25E0%25B8%2597%25E0%25B8%25A2%2F&psig=AOvVaw2X99mGdMuVV-uO4EXMu1tZ&ust=1678955541437000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKCgivfC3f0CFQAAAAAdAAAAABAE'),
(21, 'ขนมชั้น', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fbakery-lover.com%2F2021%2F11%2F20%2F%25E0%25B8%2582%25E0%25B8%2599%25E0%25B8%25A1%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2589%25E0%25B8%2599-%25E0%25B8%2582%25E0%25B8%2599%25E0%25B8%25A1%25E0%25B9%2584%25E0%25B8%2597%25E0%25B8%25A2%25E0%25B9%2582%25E0%25B8%259A%25E0%25B8%25A3%25E0%25B8%25B2%25E0%25B8%2593%2F&psig=AOvVaw1XquslC2byPoklVX_r5fxW&ust=1678955584623000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCJjS14vD3f0CFQAAAAAdAAAAABAP'),
(22, 'ขนมเปียกปูน', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fxn--q3cp7eza.net%2F30%2F%25E0%25B8%2582%25E0%25B8%2599%25E0%25B8%25A1%25E0%25B9%2580%25E0%25B8%259B%25E0%25B8%25B5%25E0%25B8%25A2%25E0%25B8%2581%25E0%25B8%259B%25E0%25B8%25B9%25E0%25B8%2599%25E0%25B9%2583%25E0%25B8%259A%25E0%25B9%2580%25E0%25B8%2595%25E0%25B8%25A2%2F&psig=AOvVaw0XtR4CqwHddTg16cdilqqs&ust=1678955664667000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLiy97HD3f0CFQAAAAAdAAAAABAI'),
(23, 'ขนมลูกชุบ', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wongnai.com%2Frecipes%2Fugc%2F3b24cf4aeab248ebab26e9102f0224be&psig=AOvVaw2iOt5Gm8gICp0vpfNDbxzD&ust=1678955704448000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCNjf48TD3f0CFQAAAAAdAAAAABAE'),
(24, 'ข้าวเหนียวมะม่วง', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ofm.co.th%2Fblog%2Fmango-sticky-rice%2F&psig=AOvVaw0E9YlMlifKR8eTZt--Pz6n&ust=1678955758154000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIjzs97D3f0CFQAAAAAdAAAAABAE'),
(25, 'ทองหยอด', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ofm.co.th%2Fblog%2Fmango-sticky-rice%2F&psig=AOvVaw0E9YlMlifKR8eTZt--Pz6n&ust=1678955758154000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIjzs97D3f0CFQAAAAAdAAAAABAE'),
(26, 'ทองหยิบ', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wongnai.com%2Frecipes%2Ftong-yip-thai-dessert&psig=AOvVaw2s3ni2Uhoru7SvNd68aGXf&ust=1678955858264000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKizlo7E3f0CFQAAAAAdAAAAABAE'),
(27, 'บัวลอยไข่หวาน', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fcooking.kapook.com%2Fview91793.html&psig=AOvVaw2H4rt8uyFiGpDV_9R2srM0&ust=1678955894258000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCMiDp5_E3f0CFQAAAAAdAAAAABAE'),
(28, 'บิงซูสตอเบอร์รี่', 3, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.foodpanda.co.th%2Fth%2Frestaurant%2Fy8dh%2Fbingsu-yeoja&psig=AOvVaw3LK1RO35VeEEDm0n1MgEyG&ust=1678955943253000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCOCQ2LbE3f0CFQAAAAAdAAAAABAE'),
(29, 'ลอดช่อง', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fth.theasianparent.com%2Flod-chong-thai-dessert&psig=AOvVaw3TFXtJyVEYxaMcv59x8s2p&ust=1678956004930000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKCQk9TE3f0CFQAAAAAdAAAAABAE'),
(30, 'ไอศกรีมช็อกโกแลต', 3, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fkrua.co%2Frecipe%2Fchocolateicecream%2F&psig=AOvVaw0vOUPgStELsS6Xcfbs-FSa&ust=1678956066320000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLiLuPHE3f0CFQAAAAAdAAAAABAE'),
(31, 'ไก่ป๊อป', 4, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fth.theasianparent.com%2Fpopcorn-chicken-recipe&psig=AOvVaw1l78ZH6bXhsF8rPjdhsDCD&ust=1678956133287000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLDcrZHF3f0CFQAAAAAdAAAAABAI'),
(32, 'ขนมโตเกียว', 4, 49, 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.mamaexpert.com%2Fposts%2Fcontent-1104&psig=AOvVaw1BdlZLAGguSXLYYMA-UpNr&ust=1678956197662000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCMiClbDF3f0CFQAAAAAdAAAAABAE'),
(33, 'ชีสบอล', 4, 59, 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fmachthawika283.blogspot.com%2F2018%2F03%2Fcheese-balls.html&psig=AOvVaw3Hz3NegZ7Qp2d0qJgcCjls&ust=1678956224242000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCODR0bzF3f0CFQAAAAAdAAAAABAN'),
(34, 'ซูชิ', 4, 99, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.tsunagujapan.com%2Fth%2Faffordable-and-popular-7-recommended-sushi-restaurants-in-ueno%2F&psig=AOvVaw2Qy3XqdkDIlew9BGjae3Hu&ust=1678956304691000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLj4i-PF3f0CFQAAAAAdAAAAABAE'),
(35, 'โดนัทปลา', 4, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fxn--q3cp7eza.net%2F31%2F%25E0%25B9%2582%25E0%25B8%2594%25E0%25B8%2599%25E0%25B8%25B1%25E0%25B8%2597%2F&psig=AOvVaw3bTZCTr5oHYwaeOpmBZLz0&ust=1678956338322000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKj5lPPF3f0CFQAAAAAdAAAAABAJ'),
(36, 'ทาโกยากิ', 4, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fcooking.kapook.com%2Fview178316.html&psig=AOvVaw0jyE0DkdW0iIlbIcdxWfj7&ust=1678956388885000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCMjCvIvG3f0CFQAAAAAdAAAAABAE'),
(37, 'นักเก็ตไก่', 4, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.sgethai.com%2Farticle%2F%25E0%25B8%2599%25E0%25B8%25B1%25E0%25B8%2581%25E0%25B9%2580%25E0%25B8%2581%25E0%25B9%2587%25E0%25B8%2595-%25E0%25B8%25A7%25E0%25B8%25B4%25E0%25B8%2598%25E0%25B8%25B5%25E0%25B8%2597%25E0%25B8%25B3%25E0%25B8%2599%25E0%25B8%25B1%25E0%25B8%2581%25E0%25B9%2580%25E0%25B8%2581%25E0%25B9%2587%25E0%25B8%2595%2F&psig=AOvVaw3B0Rjutuf8jWgJwn9n3HnU&ust=1678956437847000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCOCg06LG3f0CFQAAAAAdAAAAABAE'),
(38, 'ปาท่องโก๋', 4, 39, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.coffeefavour.com%2Fdeep-fried-dough-stick-recipes%2F&psig=AOvVaw2uanVII9ck0_0pUcF2h1K4&ust=1678956472332000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIjT_bLG3f0CFQAAAAAdAAAAABAE'),
(39, 'เฟรนซ์ฟรายส์', 4, 59, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.foodpanda.co.th%2Fth%2Frestaurant%2Fi0cs%2Fhouse-french-fries-cheese&psig=AOvVaw0tYsMgEEHVTHPEKBIPkmWu&ust=1678956514296000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCODDgsfG3f0CFQAAAAAdAAAAABAE'),
(40, 'ลูกชิ้น', 4, 49, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ofm.co.th%2Fblog%2Fmeatball-business%2F&psig=AOvVaw3TTgt0rbqLbFYfyVhCnFYw&ust=1678956560322000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCIDFx93G3f0CFQAAAAAdAAAAABAP');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int(11) NOT NULL,
  `cusid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderamount`
--

CREATE TABLE `orderamount` (
  `oid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statusorder`
--

CREATE TABLE `statusorder` (
  `sid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statusorder`
--

INSERT INTO `statusorder` (`sid`, `name`) VALUES
(1, 'กำลังทำอาหาร'),
(2, 'การทำอาหารเสร็จสิ้น'),
(3, 'กำลังจัดส่ง'),
(4, 'จัดส่งเสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`tid`, `name`) VALUES
(1, 'อาหารจานเดียว'),
(2, 'กับข้าว'),
(3, 'ของหวาน'),
(4, 'ของทานเล่น');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `cusid` (`cusid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `orderamount`
--
ALTER TABLE `orderamount`
  ADD KEY `fid` (`fid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `statusorder`
--
ALTER TABLE `statusorder`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statusorder`
--
ALTER TABLE `statusorder`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`tid`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cusid`) REFERENCES `customer` (`cusid`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`status`) REFERENCES `statusorder` (`sid`);

--
-- Constraints for table `orderamount`
--
ALTER TABLE `orderamount`
  ADD CONSTRAINT `orderamount_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `food` (`fid`),
  ADD CONSTRAINT `orderamount_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
