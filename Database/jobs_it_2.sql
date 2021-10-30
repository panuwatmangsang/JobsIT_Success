-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 07:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs_it_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `app_id` int(10) UNSIGNED NOT NULL,
  `app_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`app_id`, `app_name`, `app_email`, `app_password`, `created_at`, `updated_at`) VALUES
(7, 'panuwat', 'panuwatmangsang@gmail.com', '$2y$10$ID9Yf2YOJlyMC1Y4KFjH5ehUF13fAv8cEkoQkaZc.1/yVSGc.P70u', '2021-10-03 02:36:18', '2021-10-03 02:36:18'),
(8, 'pantakan', 'panuwatmangsang1@gmail.com', '$2y$10$m8gKZA2GLpYbocacCpb44.Y9VrMrUzAdmKzOx.mzCCuQox151z/ty', '2021-10-03 07:28:09', '2021-10-04 08:10:52'),
(9, 'karina', 'panuwatmangsang2@gmail.com', '$2y$10$qNTSwl9soezTs13FL2X2quF1YNJk8jbkVpHgPw/xWeWAjB3Hd28x6', '2021-10-05 01:40:24', '2021-10-05 01:40:24'),
(10, 'winter', 'panuwatmangsang3@gmail.com', '$2y$10$NMKNNq3J4Gm7z75UavQbye7pxaLSpX6YeaufhwsOf4qtSLQvQ8zda', '2021-10-05 01:59:32', '2021-10-05 01:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `entrepreneus`
--

CREATE TABLE `entrepreneus` (
  `ent_id` int(10) UNSIGNED NOT NULL,
  `ent_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_nature_work` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_name_contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entrepreneus`
--

INSERT INTO `entrepreneus` (`ent_id`, `ent_name`, `ent_nature_work`, `ent_name_contact`, `ent_phone`, `ent_email`, `ent_password`, `ent_location`, `created_at`, `updated_at`) VALUES
(3, 'Nut Company', 'Ecommerce', 'panuwat mangsang', '0954967179', 'panuwatmangsang@gmail.com', '$2y$10$6i88NjILZpLlHb8OCtvlfera.J53IBVW/GLGXQn4v.KIdgS9B8sIS', 'lamphun', '2021-08-16 04:39:47', '2021-10-04 08:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `ent__profiles`
--

CREATE TABLE `ent__profiles` (
  `profile_company_id` int(10) UNSIGNED NOT NULL,
  `profile_name_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_company_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_company_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ent__profiles`
--

INSERT INTO `ent__profiles` (`profile_company_id`, `profile_name_company`, `profile_logo`, `profile_company_contact`, `profile_company_phone`, `profile_email`, `profile_company_address`, `profile_lat`, `profile_lng`, `created_at`, `updated_at`) VALUES
(3, 'Persec Co., Ltd.', '20211003103414.PNG', 'ธีรวัต', '080-662-3091', 'panuwatmangsang@gmail.com', 'หมู่บ้าน อรินสิริ สปอร์ต วิลเลท 49/181 หมู่ 2\r\nตำบลบ้านปึก อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130', '19.166223344040198', '100.27998369807446', '2021-10-03 03:32:56', '2021-10-03 03:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `history_id` int(10) UNSIGNED NOT NULL,
  `name_prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_old` int(11) NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dominant_language` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_learned` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `charisma` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alley` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `road` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_name_village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_home_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_alley` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_road` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_canton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`history_id`, `name_prefix`, `first_name`, `last_name`, `email`, `phone_number`, `birthday`, `year_old`, `profile`, `university`, `faculty`, `branch`, `gpa`, `educational`, `experience`, `dominant_language`, `language_learned`, `charisma`, `portfolio`, `name_village`, `home_number`, `alley`, `road`, `district`, `canton`, `province`, `postal_code`, `my_name_village`, `my_home_number`, `my_alley`, `my_road`, `my_district`, `my_canton`, `my_province`, `my_postal_code`, `created_at`, `updated_at`) VALUES
(7, 'นาย', 'ภาณุวัฒน์', 'มังสังข์', 'panuwatmangsang@gmail.com', '0954967179', '11/25/1998', 23, '20211003100034.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.30', 'ปริญญาตรี', 'ไม่มี', 'html css php', 'php python css js java html', 'ร้องเพลง', '20211003100034.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-03 02:42:29', '2021-10-03 03:00:34'),
(8, 'นาย', 'พันธการ', 'ปิงเมือง', 'panuwatmangsang1@gmail.com', '0931323287', '10/01/1999', 22, '20211003143311.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.00', 'ปริญญาตรี', 'ไม่มี', 'js html css', 'python css js java html', 'ร้องเพลง', '20211003143311.pdf', 'บ้านเหยี่ยน', '1', '-', '-', 'บ้านใหม่', 'เมือง', 'พะเยา', '56000', 'บ้านเหยี่ยน', '1', '-', '-', 'บ้านใหม่', 'เมือง', 'พะเยา', '56000', '2021-10-03 07:33:11', '2021-10-03 07:33:11'),
(9, 'นาง', 'คาริน่า', 'เอสป้า', 'panuwatmangsang2@gmail.com', '0954967179', '07/12/2000', 20, '20211005085516.jpg', 'มหาวิทยาลัยเกาหลีโซล', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิศวกรรมคอมพิวเตอร์', '3.50', 'ปริญญาตรี', '2 ปี', 'python', 'python php', 'เต้น', '20211005085516.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-05 01:55:16', '2021-10-05 01:55:16'),
(10, 'นาย', 'panuwat', 'mangsang', 'panuwatmangsang@gmail.com', '0954967179', '10/07/2021', 22, '20211018065430.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.00', 'ปริญญาตรี', 'ไม่มี', 'css', 'css', 'css', '20211018065430.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-17 23:54:30', '2021-10-17 23:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_searches`
--

CREATE TABLE `jobs_searches` (
  `jobs_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `a_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `jobs_name_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs_searches`
--

INSERT INTO `jobs_searches` (`jobs_id`, `user_id`, `a_id`, `jobs_name_company`, `logo`, `jobs_name`, `jobs_quantity`, `jobs_salary`, `jobs_type`, `location_work`, `start_post`, `stop_post`, `jobs_detail`, `jobs_contact`, `jobs_address`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(22, 'all', '1', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003161657.PNG', 'Front End Developer', '2', 'ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-24', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.029557927567264', '99.93113432614608', '2021-10-03 09:16:57', '2021-10-03 09:16:57'),
(23, 'all', '1', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003162059.PNG', 'Fullstack Magento Developer', '1', '50,000 - ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-21', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.030289318113148', '99.92986957028076', '2021-10-03 09:20:59', '2021-10-03 09:20:59'),
(24, 'all', '1', 'บริษัท ไอที ครีเอชั่น จำกัด', '20211003162316.PNG', 'Programmer (โปรแกรมเมอร์)', '3', '30,000 - 35,000 บาท', 'parttime', 'wfh', '2021-10-03', '2021-10-31', 'สวัสดิการ\r\n- ประกันสังคม\r\n- โบนัส\r\n- ค่าล่วงเวลา\r\n- งานสังสรรค์ประจำปี และอื่น ๆ ตามกฎหมายกำหนด', 'คุณอวยพร แฝดกลาง\r\nบริษัท ไอที ครีเอชั่น จำกัด\r\nเลขที่ 4 ซอยนนทบุรี 14/1\r\nตำบลบางกระสอ อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000\r\nโทรศัพท์ : 02-101-4944', 'เลขที่ 4 ซอยนนทบุรี 14/1\r\nตำบลบางกระสอ อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000', '19.030141805088093', '99.93146020102455', '2021-10-03 09:23:16', '2021-10-03 09:23:16'),
(25, 'all', '1', 'บริษัท แนชเชอรัล แอนด์ พรีเมี่ยม ฟู๊ด จำกัด', '20211003162617.PNG', 'Programmer', '1', 'ตามโครงสร้างบริษัท +ประสบการณ์', 'parttime', 'wfh', '2021-10-03', '2021-10-31', 'สวัสดิการ\r\n- ประกันสังคม\r\n- กองทุนเงินทดแทน\r\n- เบี้ยขยัน (บางตำแหน่ง)\r\n- เบี้ยเลี้ยง (บางตำแหน่ง)\r\n- ค่าล่วงเวลา\r\n- ค่าความถูกต้องของงาน (บางตำแหน่ง)\r\n- ค่าตำแหน่ง (บางตำแหน่ง)\r\n- เงินกู้ดอกเบี้ยอัตราพิเศษ\r\n- เงินเบิกล่วงหน้า', 'คุณนนท์ ฝ่ายสรรหาว่าจ้าง\r\nบริษัท แนชเชอรัล แอนด์ พรีเมี่ยม ฟู๊ด จำกัด\r\n194 ถนนคุ้มเกล้า\r\nแขวงลำปลาทิว เขตลาดกระบัง กรุงเทพมหานคร 10520\r\nโทรศัพท์ : 081-822-8257\r\nแฟกซ์ : 02-360-6188', '194 ถนนคุ้มเกล้า\r\nแขวงลำปลาทิว เขตลาดกระบัง กรุงเทพมหานคร 10520', '19.029369852302917', '99.92685572630421', '2021-10-03 09:26:17', '2021-10-03 09:26:17'),
(26, 'all', '1', 'บริษัท ฟอร์ท คอร์ปอเรชั่น จำกัด (มหาชน)', '20211003162952.PNG', 'Mobile Application Developer (Android)', '2', 'ตามโครงสร้างบริษัท', 'parttime', 'company', '2021-10-03', '2021-10-30', 'สวัสดิการ\r\n- ประกันสังคม\r\n- กองทุนสำรองเลี้ยงชีพ\r\n- โบนัสตามผลประกอบการ\r\n- ประกันชีวิตและประกันอุบัติเหตุ\r\n- ตรวจสุขภาพประจำปี\r\n- ฝึกอบรมทั้งภายในและภายนอกบริษัท\r\n- เงินช่วยเหลือพนักงาน', 'คุณปิยนาฎ\r\nบริษัท ฟอร์ท คอร์ปอเรชั่น จำกัด (มหาชน)\r\n1053/1 ถ.พหลโยธิน\r\nแขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 02-265-6700 ต่อ 1276', '1053/1 ถ.พหลโยธิน\r\nแขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400', '19.029919166117075', '99.92760289626223', '2021-10-03 09:29:52', '2021-10-03 09:29:52'),
(27, 'all', '1', 'บริษัท ซอฟท์ไทย แอพลิเคชั่น จำกัด', '20211003163447.PNG', '.Net Programmer', '2', '20,000 - 50,000 ตามประสบการณ์ และทักษะ', 'fulltime', 'company', '2021-10-03', '2021-10-21', 'สวัสดิการ\r\n- ประกันสังคม\r\n- ประกันสุขภาพ\r\n- Fitness room\r\n- ตรวจสุภาพประจำปี\r\n- เงินขยัน กรณีไม่ลาในเดือนนั้น\r\n- สวัสดิการเงิน OT\r\n- เงินช่วยเหลืองานสำคัญ (งานแต่งงาน,งานบวช และงานศพ)\r\n- เสื้อบริษัท', 'คุณวาสนา ทรงมะลิลา\r\nบริษัท ซอฟท์ไทย แอพลิเคชั่น จำกัด\r\n8 ซอยขวัญพัฒนา 2 ถนนดินแดง\r\nแขวงดินแดง เขตดินแดง กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 063-905-5838, 063-905-5839\r\nแฟกซ์ : 02-641-6503', '8 ซอยขวัญพัฒนา 2 ถนนดินแดง\r\nแขวงดินแดง เขตดินแดง กรุงเทพมหานคร 10400', '19.029817637275823', '99.93293670209064', '2021-10-03 09:34:47', '2021-10-03 09:34:47'),
(28, 'all', '1', 'บริษัท เอ็ม เอฟ เซอร์เจอรี่ เซ็นเตอร์ จำกัด', '20211003163736.PNG', 'Web Programmer/เจ้าหน้าที่ IT', '2', 'ตามโครงสร้างบริษัท', 'fulltime', 'company', '2021-10-03', '2021-10-10', 'สวัสดิการ\r\nและผลตอบแทนที่เกี่ยวข้อง\r\n- ประกันสังคม\r\n- ชุดฟอร์มพนักงาน\r\n- เบี้ยขยัน\r\n- ค่าครองชีพ\r\n- ค่าใบประกอบวิชาชีพ\r\n- ค่าทักษะเฉพาะทาง\r\n- ค่าภาษา\r\n- ค่าตำแหน่ง\r\n- ค่าประสบการณ์', 'ติดต่อ\r\nฝ่ายทรัพยากรบุคคล\r\nบริษัท เอ็ม เอฟ เซอร์เจอรี่ เซ็นเตอร์ จำกัด\r\n1223 ซอยลาดพร้าว 94 ถนนลาดพร้าว (อินทราภรณ์)\r\nแขวงพลับพลา เขตวังทองหลาง กรุงเทพมหานคร 10310\r\nโทรศัพท์ : 02-559-0151 - 5 ต่อ 107\r\nแฟกซ์ : 02-559-2808', '1223 ซอยลาดพร้าว 94 ถนนลาดพร้าว (อินทราภรณ์)\r\nแขวงพลับพลา เขตวังทองหลาง กรุงเทพมหานคร 10310', '19.028704617465532', '99.92475268519647', '2021-10-03 09:37:36', '2021-10-03 09:37:36'),
(29, 'all', '1', 'Mercular Co., Ltd.', '20211003164011.PNG', 'Senior Backend Developer', '2', 'Negotiate', 'fulltime', 'wfh', '2021-10-03', '2021-10-13', 'สวัสดิการ\r\nStandard Benefits:\r\nPerformance review/ Salary adjustment\r\nSocial Security\r\nGroup Insurance\r\nDiscount of Mercular’ products\r\n10 Days starting annual leave\r\nFlexible working hour\r\nCompany outing\r\nBirthday party', 'Khun Chayapat Wongsiriporn\r\nMercular Co., Ltd.\r\n139 17th FL, Sethiwan Tower, Pan Road,\r\nแขวงสีลม เขตบางรัก กรุงเทพมหานคร 10500\r\nโทรศัพท์ : 098-826-6970', '139 17th FL, Sethiwan Tower, Pan Road,\r\nแขวงสีลม เขตบางรัก กรุงเทพมหานคร 10500', '19.02919405630398', '99.92772549163729', '2021-10-03 09:40:11', '2021-10-03 09:40:11'),
(30, 'all', '1', 'บริษัท ดี.ที.ซี.เอ็นเตอร์ไพรส์ จำกัด', '20211003164750.PNG', 'Android Developer', '2', 'ตามโครงสร้างบริษัท', 'fulltime', 'company', '2021-10-03', '2021-10-13', 'สวัสดิการ\r\n1. โบนัส (ตามตำแหน่งและผลประกอบการ)\r\n2. กองทุนสำรองเลี้ยงชีพสูงสุด 10 %\r\n3. ตรวจสุขภาพประจำปี\r\n4. ท่องเที่ยวประจำปี\r\n5. กิจกรรมเสริมสร้างความสัมพันธ์ประจำปี (กีฬาสี, งานสังสรรค์ประจำปี, กิจกรรมตามวันสำคัญต่างๆ)', 'แผนกทรัพยากรบุคคล\r\nบริษัท ดี.ที.ซี.เอ็นเตอร์ไพรส์ จำกัด\r\n63 ซ.สรรพาวุธ 2 ถ.สุขุมวิท (ใกล้สี่แยกบางนา)\r\nแขวงบางนาเหนือ เขตบางนา กรุงเทพมหานคร 10260\r\nโทรศัพท์ : 1176 ต่อ 103 , 107, มือถือ 063-205-0664\r\nแฟกซ์ : 02-744-7667', '63 ซ.สรรพาวุธ 2 ถ.สุขุมวิท (ใกล้สี่แยกบางนา)\r\nแขวงบางนาเหนือ เขตบางนา กรุงเทพมหานคร 10260', '19.02933342962805', '99.92776986237548', '2021-10-03 09:47:50', '2021-10-03 09:47:50'),
(31, 'all', '1', 'บริษัท ดี.ที.ซี.เอ็นเตอร์ไพรส์ จำกัด', '20211003165249.PNG', 'Web Application Designer (UX/UI)', '1', 'ตามความสามารถ และประสบการณ์', 'fulltime', 'company', '2021-10-03', '2021-10-24', 'สวัสดิการ\r\n1. โบนัส (ตามตำแหน่งและผลประกอบการ)\r\n2. กองทุนสำรองเลี้ยงชีพสูงสุด 10 %\r\n3. ตรวจสุขภาพประจำปี\r\n4. ท่องเที่ยวประจำปี\r\n5. กิจกรรมเสริมสร้างความสัมพันธ์ประจำปี (กีฬาสี, งานสังสรรค์ประจำปี, กิจกรรมตามวันสำคัญต่างๆ)', 'ติดต่อ\r\nแผนกทรัพยากรบุคคล\r\nบริษัท ดี.ที.ซี.เอ็นเตอร์ไพรส์ จำกัด\r\n63 ซ.สรรพาวุธ 2 ถ.สุขุมวิท (ใกล้สี่แยกบางนา)\r\nแขวงบางนาเหนือ เขตบางนา กรุงเทพมหานคร 10260\r\nโทรศัพท์ : 1176 ต่อ 103 , 107, มือถือ 063-205-0664\r\nแฟกซ์ : 02-744-7667', '63 ซ.สรรพาวุธ 2 ถ.สุขุมวิท (ใกล้สี่แยกบางนา)\r\nแขวงบางนาเหนือ เขตบางนา กรุงเทพมหานคร 10260', '19.02944802092551', '99.92698643496287', '2021-10-03 09:52:49', '2021-10-03 09:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `myjobs_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_14_175547_create_applicants_table', 1),
(8, '2021_08_15_073132_create_entrepreneus_table', 4),
(9, '2021_08_20_110114_create_histories_table', 5),
(10, '2021_08_25_080833_create_portfolios_table', 6),
(11, '2021_08_25_083254_create_histories_table', 7),
(14, '2021_09_03_120552_create_ent__profiles_table', 10),
(17, '2021_08_31_072808_create_jobs_searches_table', 13),
(18, '2021_09_22_075048_create_my_jobs_table', 14),
(19, '2021_08_27_151832_create_histories_table', 15),
(20, '2021_09_29_132244_create_save_applicants_table', 16),
(21, '2021_10_20_095756_create_messages_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `my_jobs`
--

CREATE TABLE `my_jobs` (
  `myjobs_id` int(10) UNSIGNED NOT NULL,
  `history_id` int(11) NOT NULL,
  `jobs_id` int(11) NOT NULL,
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_name_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_location_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_start_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_stop_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myjobs_lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_jobs`
--

INSERT INTO `my_jobs` (`myjobs_id`, `history_id`, `jobs_id`, `action_type`, `message`, `user_id`, `a_id`, `myjobs_name_company`, `myjobs_logo`, `myjobs_name`, `myjobs_quantity`, `myjobs_salary`, `myjobs_type`, `myjobs_location_work`, `myjobs_start_post`, `myjobs_stop_post`, `myjobs_detail`, `myjobs_contact`, `myjobs_address`, `myjobs_lat`, `myjobs_lng`, `created_at`, `updated_at`) VALUES
(346, 7, 22, 'ApproveForm', 'GG ไอ้หนุ่ม', 'all', '4', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003161657.PNG', 'Front End Developer', '2', 'ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-24', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.029557927567264', '99.93113432614608', '2021-10-27 04:08:01', '2021-10-27 04:08:58'),
(347, 7, 25, 'FavoriteJobs', 'no interview', 'all', '1', 'บริษัท แนชเชอรัล แอนด์ พรีเมี่ยม ฟู๊ด จำกัด', '20211003162617.PNG', 'Programmer', '1', 'ตามโครงสร้างบริษัท +ประสบการณ์', 'parttime', 'wfh', '2021-10-03', '2021-10-31', 'สวัสดิการ\r\n- ประกันสังคม\r\n- กองทุนเงินทดแทน\r\n- เบี้ยขยัน (บางตำแหน่ง)\r\n- เบี้ยเลี้ยง (บางตำแหน่ง)\r\n- ค่าล่วงเวลา\r\n- ค่าความถูกต้องของงาน (บางตำแหน่ง)\r\n- ค่าตำแหน่ง (บางตำแหน่ง)\r\n- เงินกู้ดอกเบี้ยอัตราพิเศษ\r\n- เงินเบิกล่วงหน้า', 'คุณนนท์ ฝ่ายสรรหาว่าจ้าง\r\nบริษัท แนชเชอรัล แอนด์ พรีเมี่ยม ฟู๊ด จำกัด\r\n194 ถนนคุ้มเกล้า\r\nแขวงลำปลาทิว เขตลาดกระบัง กรุงเทพมหานคร 10520\r\nโทรศัพท์ : 081-822-8257\r\nแฟกซ์ : 02-360-6188', '194 ถนนคุ้มเกล้า\r\nแขวงลำปลาทิว เขตลาดกระบัง กรุงเทพมหานคร 10520', '19.029369852302917', '99.92685572630421', '2021-10-27 04:44:53', '2021-10-27 04:44:53'),
(348, 7, 22, 'RejectForm', 'no interview', 'all', '5', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003161657.PNG', 'Front End Developer', '2', 'ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-24', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.029557927567264', '99.93113432614608', '2021-10-30 09:21:54', '2021-10-30 09:31:20'),
(349, 7, 23, 'AppliForm', 'no interview', 'all', '3', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003162059.PNG', 'Fullstack Magento Developer', '1', '50,000 - ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-21', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.030289318113148', '99.92986957028076', '2021-10-30 09:22:10', '2021-10-30 09:31:35'),
(350, 7, 24, 'AppliForm', 'no interview', 'all', '2', 'บริษัท ไอที ครีเอชั่น จำกัด', '20211003162316.PNG', 'Programmer (โปรแกรมเมอร์)', '3', '30,000 - 35,000 บาท', 'parttime', 'wfh', '2021-10-03', '2021-10-31', 'สวัสดิการ\r\n- ประกันสังคม\r\n- โบนัส\r\n- ค่าล่วงเวลา\r\n- งานสังสรรค์ประจำปี และอื่น ๆ ตามกฎหมายกำหนด', 'คุณอวยพร แฝดกลาง\r\nบริษัท ไอที ครีเอชั่น จำกัด\r\nเลขที่ 4 ซอยนนทบุรี 14/1\r\nตำบลบางกระสอ อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000\r\nโทรศัพท์ : 02-101-4944', 'เลขที่ 4 ซอยนนทบุรี 14/1\r\nตำบลบางกระสอ อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000', '19.030141805088093', '99.93146020102455', '2021-10-30 09:22:22', '2021-10-30 09:22:22'),
(351, 8, 23, 'AppliForm', 'no interview', 'all', '2', 'กลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)', '20211003162059.PNG', 'Fullstack Magento Developer', '1', '50,000 - ตามประสบการณ์', 'parttime', 'company', '2021-10-03', '2021-10-21', 'สวัสดิการ\r\nด้านสุขภาพ\r\n1. ประกันสุขภาพ\r\n2. การตรวจสุขภาพประจำปี\r\n3. ค่ารักษาพยาบาล พนักงานและครอบครัว\r\n\r\nด้านประกัน\r\n1. ประกันอุบัติเหตุพนักงาน\r\n2. ประกันอุบัติเหตุครอบครัว (บิดา/มารดา/บุตร)\r\n3. ประกันชีวิตพนักงาน', 'แผนกสรรหาว่าจ้าง\r\nกลุ่มบริษัท เอสเอสยูพี (SSUP GROUP)\r\n89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400\r\nโทรศัพท์ : 084-387-8075, 02-642-6060-9 ต่อ 1619\r\nแฟกซ์ : 02-642-6304', '89/1 อาคาร ว. วิโรจน์ ซอยรัชฎภัณฑ์ ราชปรารถ\r\nแขวงมักกะสัน เขตราชเทวี กรุงเทพมหานคร 10400', '19.030289318113148', '99.92986957028076', '2021-10-30 09:22:50', '2021-10-30 09:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `save_applicants`
--

CREATE TABLE `save_applicants` (
  `save_app_id` int(10) UNSIGNED NOT NULL,
  `history_id` int(11) NOT NULL,
  `name_prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_old` int(11) NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dominant_language` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_learned` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `charisma` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alley` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `road` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_name_village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_home_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_alley` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_road` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_canton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `save_applicants`
--

INSERT INTO `save_applicants` (`save_app_id`, `history_id`, `name_prefix`, `first_name`, `last_name`, `email`, `phone_number`, `birthday`, `year_old`, `profile`, `university`, `faculty`, `branch`, `gpa`, `educational`, `experience`, `dominant_language`, `language_learned`, `charisma`, `portfolio`, `name_village`, `home_number`, `alley`, `road`, `district`, `canton`, `province`, `postal_code`, `my_name_village`, `my_home_number`, `my_alley`, `my_road`, `my_district`, `my_canton`, `my_province`, `my_postal_code`, `created_at`, `updated_at`) VALUES
(25, 7, 'นาย', 'ภาณุวัฒน์', 'มังสังข์', 'panuwatmangsang@gmail.com', '0954967179', '11/25/1998', 23, '20211003100034.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.30', 'ปริญญาตรี', 'ไม่มี', 'html css php', 'php python css js java html', 'ร้องเพลง', '20211003100034.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-27 04:43:40', '2021-10-27 04:43:40'),
(26, 8, 'นาย', 'พันธการ', 'ปิงเมือง', 'panuwatmangsang1@gmail.com', '0931323287', '10/01/1999', 22, '20211003143311.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.00', 'ปริญญาตรี', 'ไม่มี', 'js html css', 'python css js java html', 'ร้องเพลง', '20211003143311.pdf', 'บ้านเหยี่ยน', '1', '-', '-', 'บ้านใหม่', 'เมือง', 'พะเยา', '56000', 'บ้านเหยี่ยน', '1', '-', '-', 'บ้านใหม่', 'เมือง', 'พะเยา', '56000', '2021-10-27 04:43:45', '2021-10-27 04:43:45'),
(27, 9, 'นาง', 'คาริน่า', 'เอสป้า', 'panuwatmangsang2@gmail.com', '0954967179', '07/12/2000', 20, '20211005085516.jpg', 'มหาวิทยาลัยเกาหลีโซล', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิศวกรรมคอมพิวเตอร์', '3.50', 'ปริญญาตรี', '2 ปี', 'python', 'python php', 'เต้น', '20211005085516.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-27 04:43:52', '2021-10-27 04:43:52'),
(28, 10, 'นาย', 'panuwat', 'mangsang', 'panuwatmangsang@gmail.com', '0954967179', '10/07/2021', 22, '20211018065430.jpg', 'มหาวิทยาลัยพะเยา', 'เทคโนโลยีสารสนเทศและการสื่อสาร', 'วิทยาการคอมพิวเตอร์', '3.00', 'ปริญญาตรี', 'ไม่มี', 'css', 'css', 'css', '20211018065430.pdf', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', 'สันเหมือง', '12', '-', '-', 'หนองล่อง', 'เวียงหนองล่อง', 'ลำพูน', '51120', '2021-10-27 04:45:03', '2021-10-27 04:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `entrepreneus`
--
ALTER TABLE `entrepreneus`
  ADD PRIMARY KEY (`ent_id`);

--
-- Indexes for table `ent__profiles`
--
ALTER TABLE `ent__profiles`
  ADD PRIMARY KEY (`profile_company_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `jobs_searches`
--
ALTER TABLE `jobs_searches`
  ADD PRIMARY KEY (`jobs_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_jobs`
--
ALTER TABLE `my_jobs`
  ADD PRIMARY KEY (`myjobs_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `save_applicants`
--
ALTER TABLE `save_applicants`
  ADD PRIMARY KEY (`save_app_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `app_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `entrepreneus`
--
ALTER TABLE `entrepreneus`
  MODIFY `ent_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ent__profiles`
--
ALTER TABLE `ent__profiles`
  MODIFY `profile_company_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs_searches`
--
ALTER TABLE `jobs_searches`
  MODIFY `jobs_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `my_jobs`
--
ALTER TABLE `my_jobs`
  MODIFY `myjobs_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `save_applicants`
--
ALTER TABLE `save_applicants`
  MODIFY `save_app_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
