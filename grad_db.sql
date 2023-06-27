-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 04:22 AM
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
-- Database: `healthcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulane-unit`
--

CREATE TABLE `ambulane-unit` (
  `ambulane-id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('44856660-4ae8-4e75-88df-bff05bf4d430', 7, 3, '2023-05-27 07:07:53', '2023-05-27 07:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('5514df8d-625a-46b0-a413-f5d7041107f5', 1, 21, 'Hello, \r\nI wanna ask about my tests', NULL, 1, '2023-06-19 17:13:36', '2023-06-19 17:14:28'),
('68d46753-5c8e-4296-8fd3-97eaf15edbdd', 1, 2, 'I will do that', NULL, 1, '2023-06-17 14:57:12', '2023-06-17 14:57:47'),
('86d2bb81-78b9-45e3-b30d-67c3ee1ca09b', 21, 1, 'We are working on them', NULL, 0, '2023-06-19 17:15:10', '2023-06-19 17:15:10'),
('8f583cf3-5d56-4bc3-95bf-c94f86c466ef', 1, 2, 'Hello doctor, I feel that I have skin rash. My skin is red, and I have itchy and peeling.', NULL, 1, '2023-06-17 14:52:44', '2023-06-17 14:55:19'),
('bb653162-857f-4a45-a609-dddb06074327', 2, 1, 'Do not take your medicine again and let us meet at the clinic as soon as possible to check your health status', NULL, 1, '2023-06-17 14:56:29', '2023-06-17 14:56:40'),
('e0be2784-06ba-4491-9174-598ed74f0fbb', 2, 1, 'Hello Osama, you look like you have drug allergy', NULL, 1, '2023-06-17 14:55:26', '2023-06-17 14:56:40'),
('e2ff80ca-bff2-4215-ac97-9c7abd3dd1f2', 2, 1, 'You are welcome', NULL, 1, '2023-06-17 14:58:09', '2023-06-17 14:58:16'),
('e3b21812-e5ba-4296-8e8b-76389f60d1b7', 1, 2, 'Thank you doctor Ahmed', NULL, 1, '2023-06-17 14:57:42', '2023-06-17 14:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `disease_id` int(11) NOT NULL,
  `disease_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`disease_id`, `disease_name`) VALUES
(1, 'Diabetes Type-1'),
(2, 'Diabetes Type-2'),
(3, 'Gestational Diabetes'),
(4, 'CHD'),
(5, 'CKD');

-- --------------------------------------------------------

--
-- Table structure for table `disease_test`
--

CREATE TABLE `disease_test` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(225) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cost` int(5) NOT NULL,
  `disease_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease_test`
--

INSERT INTO `disease_test` (`test_id`, `test_name`, `description`, `cost`, `disease_id`) VALUES
(1, 'Complete Blood Count', 'Doctors use CBC to look at the concentrations of different types of blood cells someone has in their blood. ', 120, NULL),
(2, 'Basic Metabolic Panel', 'BMP usually checks for levels of eight compounds in the blood:\ncalcium, glucose, sodium, potassium, bicarbonate, chloride, blood urea nitrogen (BUN), creatinine\nAbnormal results may indicate:\nkidney disease, diabetes', 140, NULL),
(3, 'Glomerular Filtration Rate', 'GFR - one of the most common blood tests to check for chronic kidney disease. It tells how well your kidneys are filtering. ', 100, 5),
(4, 'Creatinine Blood and Urine Tests ', 'Check the levels of creatinine which is a waste product that your kidneys remove from your blood', 150, 5),
(5, 'Albumin Urine Test', 'Checks for albumin which is a protein that can pass into the urine if the kidneys are damaged', 100, 5),
(6, 'Fasting Plasma Glucose Test', 'Measures your blood glucose level at a single point in time. For the most reliable results, your doctor will give you the test in the morning after you have fasted for at least 8 hours. (Diabetes)\r\n', 150, NULL),
(7, 'Hemoglobin A1C', 'Blood test that provides your average levels of blood glucose over the last 3 months (Diabetes)\r\n', 200, NULL),
(9, 'Oral Glucose Tolerance Test', 'OGTT helps doctors detect type 2 diabetes, prediabetes, and gestational diabetes.', 250, NULL),
(10, 'Glucose Challenge Screening Test', 'You drink a glucose syrup solution given by your doctor. Your blood is drawn an hour later to measure your blood sugar level.', 200, 3),
(11, 'Cholesterol Test', 'Measures the fats in the blood. ', 150, 4),
(12, 'High-sensitivity C-reactive protein', 'Plays a major role in the process of atherosclerosis.hs-CRP tests help determine the risk of heart disease before symptoms are present. Higher hs-CRP levels are associated with a higher risk of heart attack, stroke and cardiovascular disease.\r\n', 200, 4),
(13, 'Cardiac Troponin Test', 'Doctors use a cardiac troponin test to help diagnose a heart attack. Troponin is a protein in the heart. If damage occurs to the heart, it sends troponin into the bloodstream.', 200, 4),
(14, 'Thyroid Function Tests', 'If levels of the hormone(thyroxine) are too high or too low, it can cause a slow or fast heartbeat and may lead to palpitations.', 200, 4),
(15, 'B-type Natriuretic Peptide ', 'This test measures levels of a protein called BNP in the blood. If the heart has to work harder to pump blood, it creates more BNP, so higher levels may indicate heart failure.', 170, 4),
(16, 'Coagulation Tests ', 'Measure how well your blood clots and how long it takes for your blood to clot. Examples include the prothrombin time (PT) test and fibrinogen activity test.\r\n', 150, NULL),
(17, 'Hidden Blood Stool Test', 'Determines if the cause of the diarrhea is due to parasites, amoebas, or pathogens such as salmonella.', 120, NULL),
(18, 'Blood Enzyme Tests', 'Measure the levels of specific enzymes in the body. ', 100, NULL),
(20, 'ABO Typing ', 'Determine the patient\'s blood type', 90, NULL),
(21, 'Erythrocyte Sedimentation Rate', 'is the rate at which red blood cells in anticoagulated whole blood descend in a standardized tube over a period of one hour', 150, NULL),
(22, 'FibroTest ', 'Generate a measure of fibrosis and necroinflammatory activity in the liver.', 300, NULL),
(23, 'Vitamin-D Test ', 'Measures the level of vitamin D in your blood to make sure you have enough for your body to work well. Vitamin D is essential for healthy bones and teeth. It also helps keep your muscles, nerves, and immune system working normally.', 200, NULL),
(24, 'Total Calcium Blood Test', 'Measure the amount of calcium you have in your blood. ', 250, NULL),
(25, 'Pregnancy-associated Plasma Protein Screening', 'This is a protein made by the placenta in early pregnancy. Abnormal levels are linked to a higher risk for chromosome problems.', 250, NULL),
(26, 'Vitamin-B Test', 'Vitamin B testing checks for inadequate levels of B vitamins in the body', 150, NULL),
(27, 'DHEA-sulfate Serum Test', 'The dehydroepiandrosterone (DHEA) hormone comes from your adrenal glands. This test measures whether it’s too high or too low.', 130, NULL),
(28, 'Serum Iron Test', 'Used to measure the total amount of iron in the blood\r\n', 150, NULL),
(29, 'CPK Isoenzymes Test', 'Measures the creatine phosphokinase (CPK) in the blood.', 200, NULL),
(30, 'Sputum Culture', 'Is a test to detect and identify bacteria or fungi that infect the lungs or breathing passages.', 350, NULL),
(31, 'Liver Function Test', 'Blood tests used to help diagnose and monitor liver disease or damage. The tests measure the levels of certain enzymes and proteins in your blood or how well the liver is performing its normal functions of producing protein and clearing bilirubin', 150, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `speciality` varchar(40) NOT NULL,
  `doc_image` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `start_work` date NOT NULL,
  `date_of_birthday` date DEFAULT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `name`, `speciality`, `doc_image`, `email`, `phone`, `password`, `address`, `start_work`, `date_of_birthday`, `country`) VALUES
(1, 'Ahmed Elsadany', 'Adult Cardiology', 'doc.jpg', 'ahmedelsadney1@gmail.com', '01075643694', '123456789', 'Benha', '2016-02-24', '1992-07-14', 'Egypt'),
(2, 'Ali Mohamed', 'Cardiology', 'doc-2.jpg', 'alimohamed@gmail.com', '01254784125', '1122334455', 'Banha', '2013-04-03', '1989-08-25', 'Egypt'),
(3, 'Doaa Abdullah', 'Obstetricians and Gynecologist', 'doc-1.jpg', 'doaaabdullah@gmail.com', '01209887654', '12345678910', 'Cairo', '2017-04-20', '1988-11-08', 'Egypt'),
(4, 'Nabil Samir', 'Diabetologist and Cardiovascular', 'doc-4.jpg', 'nabilsamir@gmail.com', '01123456672', '11233455677', 'Faisal Street, Hassan Mohamed', '2011-10-14', '1980-11-08', 'Egypt'),
(5, 'Amr Samy', 'Adult Nephrology', 'doc-5.jpg', 'amrsamy@gmail.com', '01099873561', '1234555678', 'Nasr City', '2012-04-17', '1985-11-25', 'Egypt'),
(6, 'Mahmoud Zohny', 'Cardiology', 'doc-3.jpg', 'mahmoudzohny@gmail.com', '01276168892', '123215665', 'Ragheb Street, Helwan', '2015-04-17', '1986-02-20', 'Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `doctor-patient`
--

CREATE TABLE `doctor-patient` (
  `MRN` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor-patient`
--

INSERT INTO `doctor-patient` (`MRN`, `doctor_id`, `created_at`) VALUES
(1, 1, '2023-05-01 09:45:58'),
(1, 2, '2023-05-31 21:42:23'),
(2, 1, '2023-06-18 19:46:08'),
(2, 3, '2023-06-18 19:47:57'),
(3, 1, '2023-06-18 19:47:12'),
(3, 2, '2023-06-18 19:49:12'),
(3, 4, '2023-06-18 19:48:55'),
(4, 1, '2023-06-18 19:47:28'),
(4, 3, '2023-06-18 19:48:15'),
(5, 1, '2023-06-18 19:47:39'),
(5, 6, '2023-06-18 19:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labunit`
--

CREATE TABLE `labunit` (
  `lab_id` int(11) NOT NULL,
  `lab_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labunit`
--

INSERT INTO `labunit` (`lab_id`, `lab_name`, `email`, `address`, `password`) VALUES
(1, 'Al-Mokhtaber', 'alaaibrahimmahfoz@gmail.com', 'Benha, Qalubia, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(2, 'Al Borg', 'AlBorg@gmail.com', 'Benha, Qalubia, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(3, 'Alfa Laboratory', 'Alfa@gmail.com', 'Benha, Qalubia, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(4, 'Faraby Laboratory', 'faraby@gmail.com', 'Cairo, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(5, 'Delta Lab', 'delta@gmail.com', 'Cairo, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(6, 'Arabs International Lab', 'Arabs@gmail.com', 'Fouad Mohy El Din St., Benha, Qalubia', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi'),
(7, 'Almostaqbal Lab', 'almostaqbal-lab@gmail.com', 'Cairo, Egypt', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi');

-- --------------------------------------------------------

--
-- Table structure for table `lab_appointment`
--

CREATE TABLE `lab_appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `invoice_id` int(15) DEFAULT NULL,
  `payment_link` varchar(255) DEFAULT NULL,
  `payment_status` varchar(8) NOT NULL DEFAULT 'Not Paid',
  `due_date` date DEFAULT NULL,
  `MRN` int(11) NOT NULL,
  `payment_way` varchar(20) DEFAULT NULL,
  `status` varchar(7) NOT NULL DEFAULT 'request',
  `medicine` varchar(255) NOT NULL DEFAULT '----',
  `live_location` varchar(255) DEFAULT NULL,
  `latiude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `lab_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_appointment`
--

INSERT INTO `lab_appointment` (`appointment_id`, `appointment_date`, `end_date`, `recipient_id`, `payment`, `invoice_id`, `payment_link`, `payment_status`, `due_date`, `MRN`, `payment_way`, `status`, `medicine`, `live_location`, `latiude`, `longitude`, `lab_id`) VALUES
(4, '2023-05-04 00:00:00', '2023-05-05 00:00:00', 4, 60, 2263680, 'https://demo.MyFatoorah.com/KWT/ie/01072226368041-8c1ec2fa', 'Paid', '2023-05-05', 1, 'Online Payment', 'done', '----', 'Updated using GPS', 30.47299, 31.1805, 1),
(9, '2023-05-26 00:00:00', '2023-05-27 00:00:00', 2, 120, NULL, NULL, 'Paid', '2023-06-15', 5, 'Online Payment', 'upload', '----', 'Updated using GPS', 30.0136, 31.2081, 1),
(11, '2023-05-27 00:00:00', '2023-05-28 00:00:00', 3, 100, 2315976, 'https://demo.MyFatoorah.com/KWT/ie/01072231597641-09bde03a', 'Paid', '2023-05-27', 5, 'Online Payment', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(13, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 250, 2317572, 'https://demo.MyFatoorah.com/KWT/ie/01072231757241-f4820f56', 'Paid', '2023-05-28', 5, 'Online Payment', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(14, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 200, 2318063, 'https://demo.MyFatoorah.com/KWT/ie/01072231806340-b7739698', 'Paid', '2023-05-28', 5, 'Online Payment', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(15, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 200, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(16, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(17, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 100, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(18, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 200, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(19, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 200, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(20, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 150, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(21, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 100, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(22, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 150, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(23, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(24, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(25, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 120, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(26, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(27, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 2, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(28, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 4, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(29, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(30, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(31, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(32, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(33, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(34, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(35, '2023-05-28 00:00:00', '2023-05-29 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-28', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(38, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(39, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(40, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(41, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 140, 2320455, 'https://demo.MyFatoorah.com/KWT/ie/01072232045540-b01ce809', 'Paid', '2023-05-29', 5, 'Online Payment', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(42, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 200, NULL, NULL, 'Paid', '2023-05-29', 4, 'Cache', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(43, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 100, 2322593, 'https://demo.MyFatoorah.com/KWT/ie/01072232259341-6fd56e20', 'Paid', '2023-05-29', 4, 'Online Payment', 'done', '----', 'Updated using GPS', 30.0136, 31.2081, 1),
(44, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 2, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(45, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(46, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(48, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(49, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(50, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(51, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(52, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(53, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 120, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(56, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 1, 260, NULL, NULL, 'Paid', '2023-05-29', 5, 'Cache', 'done', '----', NULL, NULL, NULL, 1),
(58, '2023-05-29 00:00:00', '2023-05-30 00:00:00', 2, 440, NULL, NULL, 'Paid', '2023-05-29', 4, 'Cache', 'upload', '----', NULL, NULL, NULL, 1),
(59, '2023-06-17 00:00:00', '2023-06-18 00:00:00', NULL, 120, NULL, NULL, 'Not Paid', NULL, 3, 'Cache', 'booked', '----', 'banha', 0, 0, 1),
(60, '2023-06-17 00:00:00', '2023-06-18 00:00:00', NULL, 120, NULL, NULL, 'Not Paid', NULL, 2, 'Cache', 'booked', '----', 'banha', 0, 0, 1),
(61, '2023-05-31 00:00:00', '2023-06-01 00:00:00', 1, 170, NULL, NULL, 'Paid', '2023-05-31', 2, 'Cache', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(62, '2023-05-31 00:00:00', '2023-06-01 00:00:00', 1, 510, 2327299, 'https://demo.MyFatoorah.com/KWT/ie/01072232729942-caa9e0f7', 'Paid', '2023-05-31', 1, 'Online Payment', 'done', '----', 'Benha , Egypt', 0, 0, 1),
(64, '2023-06-16 00:00:00', '2023-06-17 00:00:00', 1, 510, NULL, NULL, 'Paid', '2023-06-17', 1, 'Cache', 'upload', '----', NULL, NULL, NULL, 1),
(66, '2023-06-17 00:00:00', '2023-06-18 00:00:00', NULL, 350, 2392880, 'https://demo.MyFatoorah.com/KWT/ie/01072239288041-2fd49d54', 'Paid', NULL, 1, 'Online Payment', 'booked', '----', 'Benha , Egypt', 0, 0, 1),
(67, '2023-06-20 00:00:00', '2023-06-21 00:00:00', NULL, 490, NULL, NULL, 'Not Paid', NULL, 5, 'Cache', 'booked', '----', 'Tahrir Street - Cairo', 0, 0, 1),
(68, '2023-07-08 00:00:00', NULL, NULL, 450, NULL, NULL, 'Not Paid', NULL, 5, 'Cache', 'request', '----', 'Tahrir Street - Cairo', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_result`
--

CREATE TABLE `lab_result` (
  `appointment_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `result_file` varchar(255) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `physician_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_result`
--

INSERT INTO `lab_result` (`appointment_id`, `test_id`, `image_name`, `result_file`, `upload_date`, `physician_id`) VALUES
(43, 3, '1687226667.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226667.jpg', '2023-06-20 04:04:27', 5),
(44, 1, '1687226692.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226692.jpg', '2023-06-20 04:04:52', 2),
(45, 1, '1687226715.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226715.jpg', '2023-06-20 04:05:15', 2),
(46, 1, '1687226749.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226749.jpg', '2023-06-20 04:05:49', 10),
(47, 1, 'test.jpeg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/test.jpg', '2023-05-29 17:17:29', 1),
(47, 3, 'test.jpeg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/test.jpg', '2023-05-29 17:19:14', 1),
(48, 1, '1687226773.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226773.jpg', '2023-06-20 04:06:13', 20),
(49, 1, '1687226801.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226801.jpg', '2023-06-20 04:06:41', 2),
(50, 1, '1687226835.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226835.jpg', '2023-06-20 04:07:15', 4),
(51, 1, '1687226435.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226435.jpg', '2023-06-20 04:00:35', 2),
(52, 1, '1687226523.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226523.jpg', '2023-06-20 04:02:03', 2),
(53, 1, '1687226501.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226501.jpg', '2023-06-20 04:01:41', 2),
(54, 1, 'test.jpeg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1685375349.jpg', '2023-05-29 17:49:09', 1),
(54, 2, 'test.jpeg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1685375381.jpg', '2023-05-29 17:49:41', 2),
(56, 1, '1687226482.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226482.jpg', '2023-06-20 04:01:22', 2),
(56, 2, '1687226457.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226457.jpg', '2023-06-20 04:00:57', 2),
(61, 15, '1687226417.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226417.jpg', '2023-06-20 04:00:17', 4),
(62, 1, '1687226393.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226393.jpg', '2023-06-20 03:59:53', 4),
(62, 2, '1687226370.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226370.jpg', '2023-06-20 03:59:30', 2),
(62, 3, '1687226240.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226240.jpg', '2023-06-20 03:57:20', 1),
(62, 4, '1687226353.jpg', 'E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/1687226353.jpg', '2023-06-20 03:59:13', 1),
(64, 1, NULL, NULL, NULL, NULL),
(64, 2, NULL, NULL, NULL, NULL),
(64, 3, NULL, NULL, NULL, NULL),
(64, 4, NULL, NULL, NULL, NULL),
(66, 6, NULL, NULL, NULL, NULL),
(66, 7, NULL, NULL, NULL, NULL),
(67, 2, NULL, NULL, NULL, NULL),
(67, 6, NULL, NULL, NULL, NULL),
(67, 7, NULL, NULL, NULL, NULL),
(68, 7, NULL, NULL, NULL, NULL),
(68, 9, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_24_999999_add_active_status_to_users', 2),
(6, '2023_04_24_999999_add_avatar_to_users', 2),
(7, '2023_04_24_999999_add_dark_mode_to_users', 2),
(8, '2023_04_24_999999_add_messenger_color_to_users', 2),
(9, '2023_04_24_999999_create_chatify_favorites_table', 2),
(10, '2023_04_24_999999_create_chatify_messages_table', 2),
(11, '2023_04_25_020132_create_students_table', 3),
(12, '2023_05_21_083837_create_sensordata_table', 4),
(13, '2023_05_24_121548_create_online_classes_table', 5),
(14, '2023_05_25_174613_create_sales_table', 6),
(15, '2023_05_25_180824_create_blood_pressures_table', 7),
(16, '2023_05_26_093554_create_casepatients_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(20) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recipient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `data`, `read_at`, `created_at`, `updated_at`, `recipient_id`) VALUES
(131, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-24\n02:25 PM', NULL, '02:25 PM', NULL, 0),
(132, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-24\n02:26 PM', NULL, '02:26 PM', NULL, 0),
(133, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-24\n02:26 PM', NULL, '02:26 PM', NULL, 0),
(134, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-24\n02:26 PM', NULL, '02:26 PM', NULL, 0),
(135, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:09 PM', NULL, '01:09 PM', NULL, 0),
(136, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:09 PM', NULL, '01:09 PM', NULL, 0),
(137, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:09 PM', NULL, '01:09 PM', NULL, 0),
(138, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:09 PM', NULL, '01:09 PM', NULL, 0),
(139, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:14 PM', NULL, '01:14 PM', NULL, 0),
(140, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n01:15 PM', NULL, '01:15 PM', NULL, 0),
(141, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-25\n02:36 PM', NULL, '02:36 PM', NULL, 0),
(142, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n06:35 PM', NULL, '06:35 PM', NULL, 0),
(143, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n06:35 PM', NULL, '06:35 PM', NULL, 0),
(144, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n07:00 PM', NULL, '07:00 PM', NULL, 0),
(145, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n08:01 PM', NULL, '08:01 PM', NULL, 0),
(146, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n08:08 PM', NULL, '08:08 PM', NULL, 0),
(147, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n08:42 PM', NULL, '08:42 PM', NULL, 0),
(148, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n08:43 PM', NULL, '08:43 PM', NULL, 0),
(149, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n09:20 PM', NULL, '09:20 PM', NULL, 0),
(150, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n09:24 PM', NULL, '09:24 PM', NULL, 0),
(151, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n09:44 PM', NULL, '09:44 PM', NULL, 0),
(152, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n09:46 PM', NULL, '09:46 PM', NULL, 0),
(153, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n09:46 PM', NULL, '09:46 PM', NULL, 0),
(154, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n09:47 PM', NULL, '09:47 PM', NULL, 0),
(155, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:06 PM', NULL, '10:06 PM', NULL, 0),
(156, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:07 PM', NULL, '10:07 PM', NULL, 0),
(157, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:10 PM', NULL, '10:10 PM', NULL, 0),
(158, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:11 PM', NULL, '10:11 PM', NULL, 0),
(159, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:15 PM', NULL, '10:15 PM', NULL, 0),
(160, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:20 PM', NULL, '10:20 PM', NULL, 0),
(161, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:20 PM', NULL, '10:20 PM', NULL, 0),
(162, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:25 PM', NULL, '10:25 PM', NULL, 0),
(163, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-26\n10:26 PM', NULL, '10:26 PM', NULL, 0),
(164, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:30 PM', NULL, '10:30 PM', NULL, 0),
(165, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:30 PM', NULL, '10:30 PM', NULL, 0),
(166, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:35 PM', NULL, '10:35 PM', NULL, 0),
(167, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:43 PM', NULL, '10:43 PM', NULL, 0),
(168, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:43 PM', NULL, '10:43 PM', NULL, 0),
(169, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:51 PM', NULL, '10:51 PM', NULL, 0),
(170, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:53 PM', NULL, '10:53 PM', NULL, 0),
(171, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n10:53 PM', NULL, '10:53 PM', NULL, 0),
(172, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:55 PM', NULL, '10:55 PM', NULL, 0),
(173, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n10:59 PM', NULL, '10:59 PM', NULL, 0),
(174, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:01 PM', NULL, '11:01 PM', NULL, 0),
(175, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:01 PM', NULL, '11:01 PM', NULL, 0),
(176, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:02 PM', NULL, '11:02 PM', NULL, 0),
(177, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:02 PM', NULL, '11:02 PM', NULL, 0),
(178, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:04 PM', NULL, '11:04 PM', NULL, 0),
(179, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:04 PM', NULL, '11:04 PM', NULL, 0),
(180, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:05 PM', NULL, '11:05 PM', NULL, 0),
(181, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:05 PM', NULL, '11:05 PM', NULL, 0),
(182, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:05 PM', NULL, '11:05 PM', NULL, 0),
(183, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:06 PM', NULL, '11:06 PM', NULL, 0),
(184, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:06 PM', NULL, '11:06 PM', NULL, 0),
(185, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:06 PM', NULL, '11:06 PM', NULL, 0),
(186, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:08 PM', NULL, '11:08 PM', NULL, 0),
(187, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:08 PM', NULL, '11:08 PM', NULL, 0),
(188, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:08 PM', NULL, '11:08 PM', NULL, 0),
(189, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:09 PM', NULL, '11:09 PM', NULL, 0),
(190, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:09 PM', NULL, '11:09 PM', NULL, 0),
(191, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:09 PM', NULL, '11:09 PM', NULL, 0),
(192, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:10 PM', NULL, '11:10 PM', NULL, 0),
(193, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:10 PM', NULL, '11:10 PM', NULL, 0),
(194, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:11 PM', NULL, '11:11 PM', NULL, 0),
(195, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:12 PM', NULL, '11:12 PM', NULL, 0),
(196, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:12 PM', NULL, '11:12 PM', NULL, 0),
(197, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:12 PM', NULL, '11:12 PM', NULL, 0),
(198, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:12 PM', NULL, '11:12 PM', NULL, 0),
(199, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:14 PM', NULL, '11:14 PM', NULL, 0),
(200, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:14 PM', NULL, '11:14 PM', NULL, 0),
(201, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:14 PM', NULL, '11:14 PM', NULL, 0),
(202, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:16 PM', NULL, '11:16 PM', NULL, 0),
(203, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:16 PM', NULL, '11:16 PM', NULL, 0),
(204, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:16 PM', NULL, '11:16 PM', NULL, 0),
(205, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:17 PM', NULL, '11:17 PM', NULL, 0),
(206, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:18 PM', NULL, '11:18 PM', NULL, 0),
(207, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:18 PM', NULL, '11:18 PM', NULL, 0),
(208, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:28 PM', NULL, '11:28 PM', NULL, 0),
(209, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:28 PM', NULL, '11:28 PM', NULL, 0),
(210, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:28 PM', NULL, '11:28 PM', NULL, 0),
(211, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:29 PM', NULL, '11:29 PM', NULL, 0),
(212, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:29 PM', NULL, '11:29 PM', NULL, 0),
(213, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:29 PM', NULL, '11:29 PM', NULL, 0),
(214, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:30 PM', NULL, '11:30 PM', NULL, 0),
(215, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:41 PM', NULL, '11:41 PM', NULL, 0),
(216, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:44 PM', NULL, '11:44 PM', NULL, 0),
(217, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:44 PM', NULL, '11:44 PM', NULL, 0),
(218, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:44 PM', NULL, '11:44 PM', NULL, 0),
(219, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:44 PM', NULL, '11:44 PM', NULL, 0),
(220, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:44 PM', NULL, '11:44 PM', NULL, 0),
(221, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n11:49 PM', NULL, '11:49 PM', NULL, 0),
(222, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-26\n11:50 PM', NULL, '11:50 PM', NULL, 0),
(223, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:51 PM', NULL, '11:51 PM', NULL, 0),
(224, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:53 PM', NULL, '11:53 PM', NULL, 0),
(225, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:53 PM', NULL, '11:53 PM', NULL, 0),
(226, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:53 PM', NULL, '11:53 PM', NULL, 0),
(227, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:54 PM', NULL, '11:54 PM', NULL, 0),
(228, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-26\n11:54 PM', NULL, '11:54 PM', NULL, 0),
(229, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:56 PM', NULL, '11:56 PM', NULL, 0),
(230, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:56 PM', NULL, '11:56 PM', NULL, 0),
(231, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:56 PM', NULL, '11:56 PM', NULL, 0),
(232, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:56 PM', NULL, '11:56 PM', NULL, 0),
(233, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n11:57 PM', NULL, '11:57 PM', NULL, 0),
(234, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:57 PM', NULL, '11:57 PM', NULL, 0),
(235, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-26\n11:58 PM', NULL, '11:58 PM', NULL, 0),
(236, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:59 PM', NULL, '11:59 PM', NULL, 0),
(237, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-26\n11:59 PM', NULL, '11:59 PM', NULL, 0),
(238, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-26\n11:59 PM', NULL, '11:59 PM', NULL, 0),
(248, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n12:39 AM', NULL, '12:39 AM', NULL, 13),
(249, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n12:39 AM', NULL, '12:39 AM', NULL, 13),
(250, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n12:42 AM', NULL, '12:42 AM', NULL, 13),
(307, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:26 AM', NULL, '02:26 AM', NULL, 21),
(310, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:27 AM', NULL, '02:27 AM', NULL, 21),
(313, '[{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:30 AM', NULL, '02:30 AM', NULL, 7),
(314, '[{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:30 AM', NULL, '02:30 AM', NULL, 7),
(316, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n01:52 PM', NULL, '01:52 PM', NULL, 21),
(317, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:30 PM', NULL, '02:30 PM', NULL, 21),
(318, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:30 PM', NULL, '02:30 PM', NULL, 21),
(319, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:33 PM', NULL, '02:33 PM', NULL, 21),
(321, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:41 PM', NULL, '02:41 PM', NULL, 21),
(322, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:45 PM', NULL, '02:45 PM', NULL, 21),
(323, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:48 PM', NULL, '02:48 PM', NULL, 21),
(324, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:48 PM', NULL, '02:48 PM', NULL, 21),
(325, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-27\n02:49 PM', NULL, '02:49 PM', NULL, 21),
(327, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n02:54 PM', NULL, '02:54 PM', NULL, 21),
(328, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n10:21 PM', NULL, '10:21 PM', NULL, 21),
(329, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n10:34 PM', NULL, '10:34 PM', NULL, 21),
(331, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n10:37 PM', NULL, '10:37 PM', NULL, 21),
(332, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n10:38 PM', NULL, '10:38 PM', NULL, 21),
(334, '[{\"MRN\":4}]\nYour request has been successfully booked! Wait for your results.\n2023-05-27\n10:47 PM', NULL, '10:47 PM', NULL, 21),
(335, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-27\n10:47 PM', NULL, '10:47 PM', NULL, 21),
(336, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n12:41 PM', NULL, '12:41 PM', NULL, 21),
(338, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n12:43 PM', NULL, '12:43 PM', NULL, 21),
(339, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n12:51 PM', NULL, '12:51 PM', NULL, 21),
(343, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n2023-05-28\n02:41 PM', NULL, '02:41 PM', NULL, 21),
(344, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n2023-05-28\n03:14 PM', NULL, '03:14 PM', NULL, 21),
(345, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n2023-05-28\n03:16 PM', NULL, '03:16 PM', NULL, 21),
(346, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685291731.png\n2023-05-28\n04:35 PM', NULL, '04:35 PM', NULL, 21),
(347, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685293081.jpg\n2023-05-28\n04:58 PM', NULL, '04:58 PM', NULL, 21),
(348, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685293154.jpg\n2023-05-28\n04:59 PM', NULL, '04:59 PM', NULL, 21),
(349, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685296699.png\n2023-05-28\n05:58 PM', NULL, '05:58 PM', NULL, 21),
(350, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685296770.png\n2023-05-28\n05:59 PM', NULL, '05:59 PM', NULL, 21),
(351, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685296904.png\n2023-05-28\n06:01 PM', NULL, '06:01 PM', NULL, 21),
(352, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685297389.jpg\n2023-05-28\n06:09 PM', NULL, '06:09 PM', NULL, 21),
(353, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685297494.jpg\n2023-05-28\n06:11 PM', NULL, '06:11 PM', NULL, 21),
(354, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685298733.png\n2023-05-28\n06:32 PM', NULL, '06:32 PM', NULL, 21),
(356, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685299154.png\n2023-05-28\n06:39 PM', NULL, '06:39 PM', NULL, 21),
(357, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n06:43 PM', NULL, '06:43 PM', NULL, 21),
(358, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685299993.png\n2023-05-28\n06:53 PM', NULL, '06:53 PM', NULL, 21),
(359, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-28\n06:54 PM', NULL, '06:54 PM', NULL, 21),
(360, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with \n[{\"MRN\":4}]\n1685300175.jpg\n2023-05-28\n06:56 PM', NULL, '06:56 PM', NULL, 21),
(361, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685300572.jpg\n2023-05-28\n07:02 PM', NULL, '07:02 PM', NULL, 21),
(362, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685300714.jpg\n2023-05-28\n07:05 PM', NULL, '07:05 PM', NULL, 21),
(363, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685302014.jpg\n2023-05-28\n07:26 PM', NULL, '07:26 PM', NULL, 21),
(364, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-28\n07:33 PM', NULL, '2023-05-28 19:33:25', NULL, 21),
(365, '[{\"name\":\"Samira Zidan\"},{\"name\":\"Samira Zidan\"},{\"name\":\"Samira Zidan\"},{\"name\":\"Omar Mohamed\"}]\n[{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n09:59 PM', NULL, '2023-05-28 21:59:22', NULL, 21),
(366, '[]\n[{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:02 PM', NULL, '2023-05-28 22:02:01', NULL, 21),
(367, '[]\n[{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:02 PM', NULL, '2023-05-28 22:02:18', NULL, 21),
(368, '[]\n[{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:13 PM', NULL, '2023-05-28 22:13:43', NULL, 21),
(369, '[]\n[{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:13 PM', NULL, '2023-05-28 22:13:49', NULL, 21),
(370, '[]\n[{\"MRN\":2},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":3},{\"MRN\":4},{\"MRN\":2},{\"MRN\":2},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":2},{\"MRN\":3},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":4},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:14 PM', NULL, '2023-05-28 22:14:27', NULL, 21),
(371, '[]\n[{\"MRN\":2},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":3},{\"MRN\":4},{\"MRN\":2},{\"MRN\":2},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":2},{\"MRN\":3},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":4},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:31 PM', NULL, '2023-05-28 22:31:42', NULL, 21),
(372, '[]\n[{\"MRN\":2},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":3},{\"MRN\":4},{\"MRN\":2},{\"MRN\":2},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":2},{\"MRN\":3},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":4},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:31 PM', NULL, '2023-05-28 22:31:54', NULL, 21),
(373, '[]\n[{\"MRN\":2},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":3},{\"MRN\":4},{\"MRN\":2},{\"MRN\":2},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":2},{\"MRN\":3},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":4},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:34 PM', NULL, '2023-05-28 22:34:05', NULL, 21),
(374, '[]\n[{\"MRN\":2},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":3},{\"MRN\":4},{\"MRN\":2},{\"MRN\":2},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":2},{\"MRN\":3},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":5},{\"MRN\":5},{\"MRN\":5},{\"MRN\":4},{\"MRN\":4},{\"MRN\":4}]\nNeed to go Hospital Now!\n2023-05-28\n10:35 PM', NULL, '2023-05-28 22:35:33', NULL, 21),
(375, '[]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:45 PM', NULL, '2023-05-28 22:45:42', NULL, 21),
(376, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:47 PM', NULL, '2023-05-28 22:47:06', NULL, 21),
(377, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:47 PM', NULL, '2023-05-28 22:47:17', NULL, 21),
(378, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:51 PM', NULL, '2023-05-28 22:51:12', NULL, 21),
(379, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:54 PM', NULL, '2023-05-28 22:54:41', NULL, 21),
(380, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:57 PM', NULL, '2023-05-28 22:57:54', NULL, 21),
(381, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:58 PM', NULL, '2023-05-28 22:58:30', NULL, 21),
(382, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:59 PM', NULL, '2023-05-28 22:59:11', NULL, 21),
(383, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n10:59 PM', NULL, '2023-05-28 22:59:30', NULL, 21),
(384, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:01 PM', NULL, '2023-05-28 23:01:46', NULL, 21),
(385, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:02 PM', NULL, '2023-05-28 23:02:30', NULL, 21),
(386, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685315371.jpg\n2023-05-28\n11:09 PM', NULL, '2023-05-28 23:09:31', NULL, 21),
(387, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:11 PM', NULL, '2023-05-28 23:11:01', NULL, 21),
(388, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685315504.jpg\n2023-05-28\n11:11 PM', NULL, '2023-05-28 23:11:44', NULL, 21),
(389, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:01', NULL, 21),
(390, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:13', NULL, 21),
(391, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:19', NULL, 21),
(392, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:28', NULL, 21),
(393, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:33', NULL, 21),
(394, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:15 PM', NULL, '2023-05-28 23:15:37', NULL, 21),
(396, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685316066.jpg\n2023-05-28\n11:21 PM', NULL, '2023-05-28 23:21:06', NULL, 21),
(397, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:23 PM', NULL, '2023-05-28 23:23:12', NULL, 21),
(398, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:23 PM', NULL, '2023-05-28 23:23:15', NULL, 21),
(399, '[{\"MRN\":5}]\nYour request has been successfully booked! Wait for your results.\n2023-05-28\n11:23 PM', NULL, '2023-05-28 23:23:47', NULL, 21),
(400, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:24 PM', NULL, '2023-05-28 23:24:34', NULL, 21),
(401, '[{\"MRN\":5}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-28\n11:24 PM', NULL, '2023-05-28 23:24:44', NULL, 21),
(402, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:26 PM', NULL, '2023-05-28 23:26:23', NULL, 21),
(403, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5},{\"MRN\":4}]\n1685316427.jpg\n2023-05-28\n11:27 PM', NULL, '2023-05-28 23:27:07', NULL, 21),
(404, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:29 PM', NULL, '2023-05-28 23:29:41', NULL, 21),
(405, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:29 PM', NULL, '2023-05-28 23:29:54', NULL, 21),
(406, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:32 PM', NULL, '2023-05-28 23:32:25', NULL, 21),
(407, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:34 PM', NULL, '2023-05-28 23:34:11', NULL, 21),
(408, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:34 PM', NULL, '2023-05-28 23:34:20', NULL, 21),
(409, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:34 PM', NULL, '2023-05-28 23:34:45', NULL, 21),
(410, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:34 PM', NULL, '2023-05-28 23:34:55', NULL, 21),
(411, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:36 PM', NULL, '2023-05-28 23:36:15', NULL, 21),
(412, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:36 PM', NULL, '2023-05-28 23:36:31', NULL, 21),
(413, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:37 PM', NULL, '2023-05-28 23:37:34', NULL, 21),
(414, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:38 PM', NULL, '2023-05-28 23:38:44', NULL, 21),
(415, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:39 PM', NULL, '2023-05-28 23:39:37', NULL, 21),
(416, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:39 PM', NULL, '2023-05-28 23:39:45', NULL, 21),
(417, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:39 PM', NULL, '2023-05-28 23:39:51', NULL, 21),
(418, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:40 PM', NULL, '2023-05-28 23:40:34', NULL, 21),
(419, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:40 PM', NULL, '2023-05-28 23:40:40', NULL, 21),
(420, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:40 PM', NULL, '2023-05-28 23:40:50', NULL, 21),
(421, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:44 PM', NULL, '2023-05-28 23:44:30', NULL, 21),
(422, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:44 PM', NULL, '2023-05-28 23:44:43', NULL, 21),
(423, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:50 PM', NULL, '2023-05-28 23:50:46', NULL, 21),
(424, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-28\n11:51 PM', NULL, '2023-05-28 23:51:23', NULL, 21),
(425, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:50 AM', NULL, '2023-05-29 00:50:42', NULL, 21),
(426, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:51 AM', NULL, '2023-05-29 00:51:00', NULL, 21),
(427, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:51 AM', NULL, '2023-05-29 00:51:08', NULL, 21),
(428, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:51 AM', NULL, '2023-05-29 00:51:16', NULL, 21),
(429, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:51 AM', NULL, '2023-05-29 00:51:19', NULL, 21),
(430, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:51 AM', NULL, '2023-05-29 00:51:59', NULL, 21),
(431, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:52 AM', NULL, '2023-05-29 00:52:04', NULL, 21),
(432, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:52 AM', NULL, '2023-05-29 00:52:21', NULL, 21),
(433, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:52 AM', NULL, '2023-05-29 00:52:25', NULL, 21),
(434, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:52 AM', NULL, '2023-05-29 00:52:31', NULL, 21),
(435, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:54 AM', NULL, '2023-05-29 00:54:30', NULL, 21),
(436, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n12:54 AM', NULL, '2023-05-29 00:54:34', NULL, 21),
(437, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:12 AM', NULL, '2023-05-29 01:12:05', NULL, 21),
(438, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:18 AM', NULL, '2023-05-29 01:18:01', NULL, 21),
(449, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:34 AM', NULL, '2023-05-29 01:34:32', NULL, 21),
(450, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:34 AM', NULL, '2023-05-29 01:34:37', NULL, 21),
(451, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:34 AM', NULL, '2023-05-29 01:34:50', NULL, 21),
(452, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:35 AM', NULL, '2023-05-29 01:35:40', NULL, 21),
(453, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:35 AM', NULL, '2023-05-29 01:35:46', NULL, 21),
(454, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:35 AM', NULL, '2023-05-29 01:35:56', NULL, 21),
(455, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:35 AM', NULL, '2023-05-29 01:35:59', NULL, 21),
(456, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:36 AM', NULL, '2023-05-29 01:36:52', NULL, 21),
(457, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:36 AM', NULL, '2023-05-29 01:36:56', NULL, 21),
(458, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:37 AM', NULL, '2023-05-29 01:37:02', NULL, 21),
(459, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:37 AM', NULL, '2023-05-29 01:37:59', NULL, 21),
(460, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:38 AM', NULL, '2023-05-29 01:38:36', NULL, 21),
(461, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:46 AM', NULL, '2023-05-29 01:46:43', NULL, 21),
(462, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:46 AM', NULL, '2023-05-29 01:46:58', NULL, 21),
(463, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:47 AM', NULL, '2023-05-29 01:47:03', NULL, 21),
(464, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:47 AM', NULL, '2023-05-29 01:47:16', NULL, 21),
(465, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:49 AM', NULL, '2023-05-29 01:49:33', NULL, 21),
(466, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:49 AM', NULL, '2023-05-29 01:49:39', NULL, 21),
(467, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:57 AM', NULL, '2023-05-29 01:57:22', NULL, 21),
(468, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n01:21 PM', NULL, '2023-05-29 13:21:36', NULL, 21),
(469, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685368974.jpg\n2023-05-29\n02:02 PM', NULL, '2023-05-29 14:02:55', NULL, 21),
(470, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n02:03 PM', NULL, '2023-05-29 14:03:10', NULL, 21),
(471, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n02:03 PM', NULL, '2023-05-29 14:03:12', NULL, 21),
(472, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n02:09 PM', NULL, '2023-05-29 14:09:04', NULL, 21),
(473, '[{\"MRN\":4}]\nYour request has been successfully booked! Wait for your results.\n2023-05-29\n02:15 PM', NULL, '2023-05-29 14:15:21', NULL, 21),
(474, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685369776.jpg\n2023-05-29\n02:16 PM', NULL, '2023-05-29 14:16:16', NULL, 21),
(475, '[{\"MRN\":4}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-29\n02:22 PM', NULL, '2023-05-29 14:22:42', NULL, 21),
(476, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685370214.jpg\n2023-05-29\n02:23 PM', NULL, '2023-05-29 14:23:34', NULL, 21),
(477, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685370216.jpg\n2023-05-29\n02:23 PM', NULL, '2023-05-29 14:23:36', NULL, 21),
(478, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685370217.jpg\n2023-05-29\n02:23 PM', NULL, '2023-05-29 14:23:38', NULL, 21),
(479, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with []\n1685370766.jpg\n2023-05-29\n02:32 PM', NULL, '2023-05-29 14:32:46', NULL, 21),
(480, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685370976.jpg\n2023-05-29\n02:36 PM', NULL, '2023-05-29 14:36:16', NULL, 21),
(481, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:15 PM', NULL, '2023-05-29 15:15:59', NULL, 21),
(482, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685373365.jpg\n2023-05-29\n03:16 PM', NULL, '2023-05-29 15:16:05', NULL, 21),
(483, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:16 PM', NULL, '2023-05-29 15:16:27', NULL, 21),
(484, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with []\n1685373449.png\n2023-05-29\n03:17 PM', NULL, '2023-05-29 15:17:29', NULL, 21),
(485, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685373554.jpg\n2023-05-29\n03:19 PM', NULL, '2023-05-29 15:19:14', NULL, 21),
(486, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:19 PM', NULL, '2023-05-29 15:19:50', NULL, 21),
(487, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685373612.jpg\n2023-05-29\n03:20 PM', NULL, '2023-05-29 15:20:12', NULL, 21),
(488, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:29 PM', NULL, '2023-05-29 15:29:46', NULL, 21),
(489, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685374225.jpg\n2023-05-29\n03:30 PM', NULL, '2023-05-29 15:30:25', NULL, 21),
(490, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:34 PM', NULL, '2023-05-29 15:34:01', NULL, 21),
(491, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685374457.jpg\n2023-05-29\n03:34 PM', NULL, '2023-05-29 15:34:17', NULL, 21),
(492, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:35 PM', NULL, '2023-05-29 15:35:05', NULL, 21),
(493, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685374553.jpg\n2023-05-29\n03:35 PM', NULL, '2023-05-29 15:35:53', NULL, 21),
(494, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:37 PM', NULL, '2023-05-29 15:37:13', NULL, 21),
(495, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685374664.jpg\n2023-05-29\n03:37 PM', NULL, '2023-05-29 15:37:44', NULL, 21),
(496, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:37 PM', NULL, '2023-05-29 15:37:51', NULL, 21),
(497, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:38 PM', NULL, '2023-05-29 15:38:55', NULL, 21),
(498, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685374779.jpg\n2023-05-29\n03:39 PM', NULL, '2023-05-29 15:39:40', NULL, 21),
(499, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:41 PM', NULL, '2023-05-29 15:41:14', NULL, 21),
(500, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:47 PM', NULL, '2023-05-29 15:47:30', NULL, 21),
(501, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:47 PM', NULL, '2023-05-29 15:47:46', NULL, 21),
(502, '[{\"MRN\":4}]\nYour request has been successfully booked! Wait for your results.\n2023-05-29\n03:48 PM', NULL, '2023-05-29 15:48:35', NULL, 21),
(503, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685375349.jpg\n2023-05-29\n03:49 PM', NULL, '2023-05-29 15:49:09', NULL, 21),
(504, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n03:49 PM', NULL, '2023-05-29 15:49:27', NULL, 21),
(505, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":4}]\n1685375381.jpg\n2023-05-29\n03:49 PM', NULL, '2023-05-29 15:49:41', NULL, 21),
(506, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n04:00 PM', NULL, '2023-05-29 16:00:59', NULL, 21),
(507, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n04:01 PM', NULL, '2023-05-29 16:01:42', NULL, 21),
(508, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n04:06 PM', NULL, '2023-05-29 16:06:20', NULL, 21),
(509, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n04:06 PM', NULL, '2023-05-29 16:06:30', NULL, 21),
(510, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685377641.png\n2023-05-29\n04:27 PM', NULL, '2023-05-29 16:27:21', NULL, 21),
(511, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":5}]\n1685377667.jpg\n2023-05-29\n04:27 PM', NULL, '2023-05-29 16:27:47', NULL, 21),
(512, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n08:58 PM', NULL, '2023-05-29 20:58:11', NULL, 21),
(513, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n08:58 PM', NULL, '2023-05-29 20:58:23', NULL, 21),
(514, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:35 PM', NULL, '2023-05-29 22:35:56', NULL, 21),
(515, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:36 PM', NULL, '2023-05-29 22:36:57', NULL, 21),
(516, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:37 PM', NULL, '2023-05-29 22:37:05', NULL, 21),
(517, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:37 PM', NULL, '2023-05-29 22:37:24', NULL, 21),
(518, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:37 PM', NULL, '2023-05-29 22:37:28', NULL, 21),
(519, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:37 PM', NULL, '2023-05-29 22:37:54', NULL, 21),
(520, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:38 PM', NULL, '2023-05-29 22:38:40', NULL, 21),
(521, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:38 PM', NULL, '2023-05-29 22:38:43', NULL, 21),
(522, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-29\n10:39 PM', NULL, '2023-05-29 22:39:21', NULL, 21),
(523, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:49 AM', NULL, '2023-05-30 02:49:50', NULL, 21),
(524, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:51 AM', NULL, '2023-05-30 02:51:19', NULL, 21),
(525, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:51 AM', NULL, '2023-05-30 02:51:56', NULL, 21),
(526, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:12 AM', NULL, '2023-05-30 03:12:19', NULL, 21),
(527, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:13 AM', NULL, '2023-05-30 03:13:11', NULL, 21),
(528, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:13 AM', NULL, '2023-05-30 03:13:58', NULL, 21),
(529, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:16 AM', NULL, '2023-05-30 03:16:05', NULL, 21),
(530, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:17 AM', NULL, '2023-05-30 03:17:35', NULL, 21),
(531, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:17 AM', NULL, '2023-05-30 03:17:40', NULL, 21),
(532, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:18 AM', NULL, '2023-05-30 03:18:56', NULL, 21),
(533, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:19 AM', NULL, '2023-05-30 03:19:04', NULL, 21),
(534, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:19 AM', NULL, '2023-05-30 03:19:11', NULL, 21),
(535, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:29 AM', NULL, '2023-05-30 03:29:31', NULL, 21),
(536, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:35 AM', NULL, '2023-05-30 03:35:30', NULL, 21),
(537, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:40 AM', NULL, '2023-05-30 03:40:52', NULL, 21),
(538, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:41 AM', NULL, '2023-05-30 03:41:27', NULL, 21),
(539, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:42 AM', NULL, '2023-05-30 03:42:02', NULL, 21),
(540, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:42 AM', NULL, '2023-05-30 03:42:21', NULL, 21),
(541, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:42 AM', NULL, '2023-05-30 03:42:47', NULL, 21),
(542, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:44 AM', NULL, '2023-05-30 03:44:26', NULL, 21),
(543, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:44 AM', NULL, '2023-05-30 03:44:44', NULL, 21),
(544, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:45 AM', NULL, '2023-05-30 03:45:20', NULL, 21),
(545, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:45 AM', NULL, '2023-05-30 03:45:36', NULL, 21),
(546, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:45 AM', NULL, '2023-05-30 03:45:53', NULL, 21),
(547, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:46 AM', NULL, '2023-05-30 03:46:17', NULL, 21),
(548, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:47 AM', NULL, '2023-05-30 03:47:32', NULL, 21);
INSERT INTO `notifications` (`notification_id`, `data`, `read_at`, `created_at`, `updated_at`, `recipient_id`) VALUES
(549, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:47 AM', NULL, '2023-05-30 03:47:47', NULL, 21),
(550, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:47 AM', NULL, '2023-05-30 03:47:58', NULL, 21),
(551, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:48 AM', NULL, '2023-05-30 03:48:11', NULL, 21),
(552, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:48 AM', NULL, '2023-05-30 03:48:27', NULL, 21),
(553, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:48 AM', NULL, '2023-05-30 03:48:41', NULL, 21),
(554, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:49 AM', NULL, '2023-05-30 03:49:12', NULL, 21),
(555, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:49 AM', NULL, '2023-05-30 03:49:35', NULL, 21),
(556, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:49 AM', NULL, '2023-05-30 03:49:50', NULL, 21),
(557, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:50 AM', NULL, '2023-05-30 03:50:15', NULL, 21),
(558, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:50 AM', NULL, '2023-05-30 03:50:46', NULL, 21),
(559, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:51 AM', NULL, '2023-05-30 03:51:32', NULL, 21),
(560, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:51 AM', NULL, '2023-05-30 03:51:55', NULL, 21),
(561, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:52 AM', NULL, '2023-05-30 03:52:25', NULL, 21),
(562, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:52 AM', NULL, '2023-05-30 03:52:37', NULL, 21),
(563, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:00', NULL, 21),
(564, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:10', NULL, 21),
(565, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:12', NULL, 21),
(566, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:21', NULL, 21),
(567, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:39', NULL, 21),
(568, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:53 AM', NULL, '2023-05-30 03:53:49', NULL, 21),
(569, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:54 AM', NULL, '2023-05-30 03:54:16', NULL, 21),
(570, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:54 AM', NULL, '2023-05-30 03:54:45', NULL, 21),
(571, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:54 AM', NULL, '2023-05-30 03:54:56', NULL, 21),
(572, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:55 AM', NULL, '2023-05-30 03:55:06', NULL, 21),
(573, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:55 AM', NULL, '2023-05-30 03:55:17', NULL, 21),
(574, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:55 AM', NULL, '2023-05-30 03:55:41', NULL, 21),
(575, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:56 AM', NULL, '2023-05-30 03:56:07', NULL, 21),
(576, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:56 AM', NULL, '2023-05-30 03:56:29', NULL, 21),
(577, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:56 AM', NULL, '2023-05-30 03:56:53', NULL, 21),
(578, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:57 AM', NULL, '2023-05-30 03:57:33', NULL, 21),
(579, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:57 AM', NULL, '2023-05-30 03:57:47', NULL, 21),
(580, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:58 AM', NULL, '2023-05-30 03:58:35', NULL, 21),
(581, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:58 AM', NULL, '2023-05-30 03:58:57', NULL, 21),
(582, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:00 AM', NULL, '2023-05-30 04:00:16', NULL, 21),
(583, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:01 AM', NULL, '2023-05-30 04:01:24', NULL, 21),
(584, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:02 AM', NULL, '2023-05-30 04:02:14', NULL, 21),
(585, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:02 AM', NULL, '2023-05-30 04:02:27', NULL, 21),
(586, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:02 AM', NULL, '2023-05-30 04:02:42', NULL, 21),
(587, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:04 AM', NULL, '2023-05-30 04:04:37', NULL, 21),
(588, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:05 AM', NULL, '2023-05-30 04:05:06', NULL, 21),
(589, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:11 AM', NULL, '2023-05-30 04:11:03', NULL, 21),
(590, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:11 AM', NULL, '2023-05-30 04:11:32', NULL, 21),
(591, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:12 AM', NULL, '2023-05-30 04:12:42', NULL, 21),
(592, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:13 AM', NULL, '2023-05-30 04:13:04', NULL, 21),
(593, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:13 AM', NULL, '2023-05-30 04:13:33', NULL, 21),
(594, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:15 AM', NULL, '2023-05-30 04:15:07', NULL, 21),
(595, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:16 AM', NULL, '2023-05-30 04:16:14', NULL, 21),
(596, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:16 AM', NULL, '2023-05-30 04:16:27', NULL, 21),
(597, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:18 AM', NULL, '2023-05-30 04:18:58', NULL, 21),
(598, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:19 AM', NULL, '2023-05-30 04:19:24', NULL, 21),
(599, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:20 AM', NULL, '2023-05-30 04:20:08', NULL, 21),
(600, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:21 AM', NULL, '2023-05-30 04:21:03', NULL, 21),
(601, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:21 AM', NULL, '2023-05-30 04:21:19', NULL, 21),
(602, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:21 AM', NULL, '2023-05-30 04:21:53', NULL, 21),
(603, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:22 AM', NULL, '2023-05-30 04:22:30', NULL, 21),
(604, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:22 AM', NULL, '2023-05-30 04:22:43', NULL, 21),
(605, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:23 AM', NULL, '2023-05-30 04:23:12', NULL, 21),
(606, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:24 AM', NULL, '2023-05-30 04:24:02', NULL, 21),
(607, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:24 AM', NULL, '2023-05-30 04:24:15', NULL, 21),
(608, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:25 AM', NULL, '2023-05-30 04:25:48', NULL, 21),
(609, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:25 AM', NULL, '2023-05-30 04:25:55', NULL, 21),
(610, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:27 AM', NULL, '2023-05-30 04:27:42', NULL, 21),
(611, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:29 AM', NULL, '2023-05-30 04:29:22', NULL, 21),
(612, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:29 AM', NULL, '2023-05-30 04:29:51', NULL, 21),
(613, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:30 AM', NULL, '2023-05-30 04:30:08', NULL, 21),
(614, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:30 AM', NULL, '2023-05-30 04:30:32', NULL, 21),
(615, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:30 AM', NULL, '2023-05-30 04:30:48', NULL, 21),
(616, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:31 AM', NULL, '2023-05-30 04:31:08', NULL, 21),
(617, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:31 AM', NULL, '2023-05-30 04:31:48', NULL, 21),
(618, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:32 AM', NULL, '2023-05-30 04:32:00', NULL, 21),
(619, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:32 AM', NULL, '2023-05-30 04:32:32', NULL, 21),
(620, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:33 AM', NULL, '2023-05-30 04:33:18', NULL, 21),
(621, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:33 AM', NULL, '2023-05-30 04:33:46', NULL, 21),
(622, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:34 AM', NULL, '2023-05-30 04:34:34', NULL, 21),
(623, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:34 AM', NULL, '2023-05-30 04:34:51', NULL, 21),
(624, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:43 AM', NULL, '2023-05-30 04:43:30', NULL, 21),
(625, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:43 AM', NULL, '2023-05-30 04:43:49', NULL, 21),
(626, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:44 AM', NULL, '2023-05-30 04:44:02', NULL, 21),
(627, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:45 AM', NULL, '2023-05-30 04:45:14', NULL, 21),
(628, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:46 AM', NULL, '2023-05-30 04:46:45', NULL, 21),
(629, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:49 AM', NULL, '2023-05-30 04:49:15', NULL, 21),
(630, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:50 AM', NULL, '2023-05-30 04:50:45', NULL, 21),
(631, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:51 AM', NULL, '2023-05-30 04:51:45', NULL, 21),
(632, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:52 AM', NULL, '2023-05-30 04:52:27', NULL, 21),
(633, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:52 AM', NULL, '2023-05-30 04:52:39', NULL, 21),
(634, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:55 AM', NULL, '2023-05-30 04:55:45', NULL, 21),
(635, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:56 AM', NULL, '2023-05-30 04:56:11', NULL, 21),
(636, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:56 AM', NULL, '2023-05-30 04:56:52', NULL, 21),
(637, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:57 AM', NULL, '2023-05-30 04:57:11', NULL, 21),
(638, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:57 AM', NULL, '2023-05-30 04:57:33', NULL, 21),
(639, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:58 AM', NULL, '2023-05-30 04:58:51', NULL, 21),
(640, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:59 AM', NULL, '2023-05-30 04:59:08', NULL, 21),
(641, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:59 AM', NULL, '2023-05-30 04:59:29', NULL, 21),
(642, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n04:59 AM', NULL, '2023-05-30 04:59:32', NULL, 21),
(643, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:00 AM', NULL, '2023-05-30 05:00:04', NULL, 21),
(644, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:00 AM', NULL, '2023-05-30 05:00:36', NULL, 21),
(645, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:01 AM', NULL, '2023-05-30 05:01:14', NULL, 21),
(646, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:02 AM', NULL, '2023-05-30 05:02:13', NULL, 21),
(647, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:03 AM', NULL, '2023-05-30 05:03:04', NULL, 21),
(648, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:04 AM', NULL, '2023-05-30 05:04:04', NULL, 21),
(649, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:04 AM', NULL, '2023-05-30 05:04:20', NULL, 21),
(650, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:05 AM', NULL, '2023-05-30 05:05:08', NULL, 21),
(651, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:05 AM', NULL, '2023-05-30 05:05:47', NULL, 21),
(652, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:06 AM', NULL, '2023-05-30 05:06:48', NULL, 21),
(653, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:07 AM', NULL, '2023-05-30 05:07:02', NULL, 21),
(654, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:08 AM', NULL, '2023-05-30 05:08:44', NULL, 21),
(655, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:10 AM', NULL, '2023-05-30 05:10:19', NULL, 21),
(657, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n05:10 AM', NULL, '2023-05-30 05:10:59', NULL, 21),
(658, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:47 PM', NULL, '2023-05-30 14:47:46', NULL, 21),
(659, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:50 PM', NULL, '2023-05-30 14:50:59', NULL, 21),
(660, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:51 PM', NULL, '2023-05-30 14:51:12', NULL, 21),
(661, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n02:54 PM', NULL, '2023-05-30 14:54:43', NULL, 21),
(662, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:26 PM', NULL, '2023-05-30 15:26:41', NULL, 21),
(663, '[{\"name\":\"Samira Zidan\"}]\n[{\"MRN\":5}]\nNeed to go Hospital Now!\n2023-05-30\n03:26 PM', NULL, '2023-05-30 15:26:46', NULL, 21),
(664, '[{\"MRN\":1}]\nYour request has been successfully booked! Wait for your results.\n2023-05-31\n10:14 AM', NULL, '2023-05-31 10:14:36', NULL, 21),
(665, '[{\"MRN\":1}]\nYour request has been successfully send! Please check your gmail for processing the online payment.\n2023-05-31\n10:50 AM', NULL, '2023-05-31 10:50:15', NULL, 21),
(666, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":1}]\n1685530420.jpg\n2023-05-31\n10:53 AM', NULL, '2023-05-31 10:53:40', NULL, 21),
(667, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with []\n1685534711.png\n2023-05-31\n12:05 PM', NULL, '2023-05-31 12:05:11', NULL, 1),
(668, 'Your patient results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":1}]\n1685535218.jpg\n2023-05-31\n12:13 PM', NULL, '2023-05-31 12:13:38', NULL, 1),
(669, '[{\"name\":\"osama ahmed\"}]\n[{\"MRN\":1}]\nNeed to go Hospital Now!\n2023-05-31\n12:55 PM', NULL, '2023-05-31 12:55:42', NULL, 21),
(670, '[{\"name\":\"osama ahmed\"}]\n[{\"MRN\":1}]\nNeed to go Hospital Now!\n2023-05-31\n01:08 PM', NULL, '2023-05-31 13:08:46', NULL, 21),
(671, 'Test results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":1}]\n1685542465.png\n2023-05-31\n02:14 PM', NULL, '2023-05-31 14:14:25', NULL, 1),
(672, 'Test results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":1}]\n1685542499.png\n2023-05-31\n02:14 PM', NULL, '2023-05-31 14:14:59', NULL, 1),
(675, 'Test results has been uploded click on this message to see it!\nThis request was for patient with [{\"MRN\":1}]\n1685551478.png\n2023-05-31\n04:44 PM', NULL, '2023-05-31 16:44:39', NULL, 1),
(677, '[{\"name\":\"Osama Ahmed\"}]\n[{\"MRN\":1}]\nNeed to go Hospital Now!\n2023-06-17\n05:11 PM', NULL, '2023-06-17 17:11:35', NULL, 21),
(678, '[{\"MRN\":1}]\nYour lab appointment request has been successfully send! Please check your gmail for processing the online payment.\n2023-06-17\n05:33 PM', NULL, '2023-06-17 17:33:17', NULL, 1),
(679, '[{\"MRN\":1}]\nYour lab appointment request has been successfully send! Please check your gmail for processing the online payment.\n2023-06-17\n05:38 PM', NULL, '2023-06-17 17:38:11', NULL, 21),
(681, '[{\"MRN\":5}]\nYour appointment has been successfully booked! Wait for your results.\n2023-06-18\n10:38 PM', NULL, '2023-06-18 22:38:32', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `online_classes`
--

CREATE TABLE `online_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `start_at` datetime NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'minutes',
  `password` varchar(255) NOT NULL COMMENT 'meeting password',
  `start_url` text NOT NULL,
  `join_url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `MRN` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_of_date` date NOT NULL,
  `sex` varchar(6) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `patient_image` varchar(255) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(10) NOT NULL,
  `ambulance-id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`MRN`, `name`, `birth_of_date`, `sex`, `phone`, `email`, `password`, `patient_image`, `street`, `city`, `country`, `ambulance-id`, `created_at`, `blood_type`) VALUES
(1, 'Osama Ahmed', '2000-02-09', 'Male', '01091643693', 'osamaahmed123@gmail.com', '123456789', 'patient1.jpg', 'EL-Ahram', 'Benha', 'Egypt', NULL, '2023-05-14 21:37:37', 'A'),
(2, 'Ahmed Mostafa', '2003-04-02', 'Male', '01065741967', 'ahmedmostafa@gmail.com', '12345678', 'patient2.jfif', 'FaridNada Street', 'Benha', 'Egypt', NULL, '2023-05-21 21:37:44', 'B'),
(3, 'Ahmed khaled', '1992-07-08', 'Male', '01061843815', 'ahmedkhaled5@gmail.com', '1234567897', 'patient3.png', 'Tahrir Street', 'Cairo', 'Egypt', NULL, '2023-05-13 21:37:52', 'O'),
(4, 'Farida Omar', '2003-10-23', 'Female', '01122743642', 'faridaomar@gmail.com', '1234567891', 'patient4.png', 'Saad Zaghlool', 'Benha', 'Egypt', NULL, '2023-05-27 21:38:03', 'A'),
(5, 'Yousef Samy', '2000-02-09', 'Male', '01265197536', 'yousefsamy0@gmail.com', '123456789', 'patient5.png', 'Tahrir Street', 'Cairo', 'Egypt', NULL, '2023-05-05 21:38:11', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `patient-ambulance`
--

CREATE TABLE `patient-ambulance` (
  `id` int(11) NOT NULL,
  `MRN` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient-disease`
--

CREATE TABLE `patient-disease` (
  `MRN` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient-disease`
--

INSERT INTO `patient-disease` (`MRN`, `disease_id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(2, 2),
(2, 4),
(3, 1),
(3, 5),
(4, 2),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `patient-sensor`
--

CREATE TABLE `patient-sensor` (
  `MRN` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient-vital-sign`
--

CREATE TABLE `patient-vital-sign` (
  `ID` int(11) NOT NULL,
  `MRN` int(11) NOT NULL,
  `diastolic` int(11) NOT NULL,
  `systolic` int(11) NOT NULL,
  `report` varchar(255) NOT NULL,
  `glucose` int(11) DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `effects` text DEFAULT NULL,
  `measureTextArea` text DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `glucose_result` varchar(255) DEFAULT NULL,
  `pressure_result` varchar(255) DEFAULT NULL,
  `heart_result` varchar(255) DEFAULT NULL,
  `oxygen_result` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient-vital-sign`
--

INSERT INTO `patient-vital-sign` (`ID`, `MRN`, `diastolic`, `systolic`, `report`, `glucose`, `symptoms`, `effects`, `measureTextArea`, `recorded_at`, `glucose_result`, `pressure_result`, `heart_result`, `oxygen_result`, `created_at`) VALUES
(2, 1, 70, 100, 'emergency', 60, NULL, NULL, NULL, '2023-05-31 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(5, 1, 90, 80, 'stable', 100, NULL, NULL, NULL, '2023-05-26 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(6, 1, 120, 95, 'stable', 130, NULL, NULL, NULL, '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(7, 1, 62, 50, 'stable', 120, NULL, NULL, NULL, '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(9, 1, 100, 100, 'stable', 100, 'like I have the flu,short of breath', 'new heart palpitations,skin rash that may include itchy, red, swollen, blistered or peeling skin,Soft stools, short-term diarrhea,Headache', 'good', '2023-05-26 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(10, 1, 143, 198, 'emergency', 262, 'like I have the flu,sleepy,short of breath,blurred vision,very hungry, even after eating,dizzy/with the room spinning around me,my mouth is dry', 'tendon, muscle or joint pain,skin rash that may include itchy, red, swollen, blistered or peeling skin,oedema,Upset stomach, nausea,Headache,photosensitivity', 'Pariatur Libero mod', '2023-05-26 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(11, 1, 122, 173, 'emergency', 165, 'like I have the flu,fever,short of breath,dizzy/about to black out,my mouth is dry,paresthesia (numbness, electric tweaks)', 'oedema,photosensitivity', 'Id sint explicabo U', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(12, 1, 122, 173, 'emergency', 165, 'like I have the flu,fever,short of breath,dizzy/about to black out,my mouth is dry,paresthesia (numbness, electric tweaks)', 'oedema,photosensitivity', 'Id sint explicabo U', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(13, 1, 122, 173, 'emergency', 165, 'like I have the flu,fever,short of breath,dizzy/about to black out,my mouth is dry,paresthesia (numbness, electric tweaks)', 'oedema,photosensitivity', 'Id sint explicabo U', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(14, 1, 122, 173, 'emergency', 165, 'like I have the flu,fever,short of breath,dizzy/about to black out,my mouth is dry,paresthesia (numbness, electric tweaks)', 'oedema,photosensitivity', 'Id sint explicabo U', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(15, 1, 122, 173, 'emergency', 165, 'like I have the flu,fever,short of breath,dizzy/about to black out,my mouth is dry,paresthesia (numbness, electric tweaks)', 'oedema,photosensitivity', 'Id sint explicabo U', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(16, 1, 103, 212, 'emergency', 138, 'like I have to vomit,sleepy,blurred vision,sores that do not heal', 'new heart palpitations,photosensitivity,your mouth, face or lips start swelling', 'Eligendi aut animi', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(17, 1, 119, 134, 'emergency', 301, 'like I have the flu,like I have to vomit,fever,blurred vision,unexplained weight loss,feeling tired all the time,very hungry, even after eating,sores that do not heal,dizzy/about to black out', 'new heart palpitations,tendon, muscle or joint pain,oedema,Upset stomach, nausea,Headache,photosensitivity,your mouth, face or lips start swelling', 'Tenetur occaecat ut', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(18, 1, 94, 162, 'emergency', 329, 'like I have the flu,fever,blurred vision,feeling tired all the time,very hungry, even after eating,sores that do not heal,dizzy/with the room spinning around me', 'new heart palpitations,tendon, muscle or joint pain,Soft stools, short-term diarrhea,oedema,Upset stomach, nausea,your mouth, face or lips start swelling', 'Assumenda suscipit s', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(19, 1, 66, 120, 'emergency', 280, 'sleepy,fever,blurred vision,unexplained weight loss,very hungry, even after eating,sores that do not heal,dizzy/about to black out,my mouth is dry', 'new heart palpitations,skin rash that may include itchy, red, swollen, blistered or peeling skin,Soft stools, short-term diarrhea,Upset stomach, nausea,Headache,photosensitivity,your mouth, face or lips start swelling', 'Quaerat aut nostrum', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(20, 1, 70, 90, 'emergency', 100, 'like I have the flu,fever,short of breath,blurred vision,unexplained weight loss,dizzy/with the room spinning around me,my mouth is dry', 'new heart palpitations,skin rash that may include itchy, red, swollen, blistered or peeling skin,Soft stools, short-term diarrhea,oedema,Headache', 'Et minim est minus n', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(21, 1, 57, 213, 'unstable', 121, 'like I have the flu,short of breath,unexplained weight loss,feeling tired all the time,very hungry, even after eating,sores that do not heal', 'new heart palpitations,tendon, muscle or joint pain,skin rash that may include itchy, red, swollen, blistered or peeling skin,Soft stools, short-term diarrhea,Upset stomach, nausea,Headache,photosensitivity', 'Quibusdam itaque qui', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(22, 1, 58, 143, 'emergency', 156, 'like I have to vomit,short of breath,blurred vision,unexplained weight loss,very hungry, even after eating,sores that do not heal,dizzy/with the room spinning around me,paresthesia (numbness, electric tweaks)', 'new heart palpitations,tendon, muscle or joint pain,skin rash that may include itchy, red, swollen, blistered or peeling skin,Soft stools, short-term diarrhea,oedema,Headache,photosensitivity', 'Aspernatur dolore ma', '2023-05-27 16:31:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(23, 1, 123, 156, 'emergency', 337, 'blurred vision,feeling tired all the time,dizzy/about to black out,dizzy/with the room spinning around me,my mouth is dry', 'new heart palpitations,tendon, muscle or joint pain,Soft stools, short-term diarrhea,oedema,Upset stomach, nausea,Headache,your mouth, face or lips start swelling', NULL, '2023-06-17 21:04:15', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(24, 1, 128, 233, 'emergent', 355, 'like I have the flu,fever,blurred vision,feeling tired all the time,very hungry, even after eating,sores that do not heal,dizzy/about to black out,my mouth is dry', 'new heart palpitations,tendon, muscle or joint pain,photosensitivity,your mouth, face or lips start swelling', NULL, '2023-06-17 21:04:11', 'emergency', 'emergency', 'emergency', 'emergency', NULL),
(25, 1, 135, 231, 'emergency', 232, 'fever,short of breath,blurred vision,very hungry, even after eating,sores that do not heal', 'Soft stools, short-term diarrhea,Headache', NULL, '2023-06-17 21:04:59', 'emergency', 'emergency', 'stable', 'stable', NULL),
(26, 1, 88, 154, 'emergency', 235, 'like I have the flu,like I have to vomit,short of breath,blurred vision,unexplained weight loss,very hungry, even after eating,sores that do not heal,dizzy/about to black out', 'new heart palpitations,skin rash that may include itchy, red, swollen, blistered or peeling skin,Upset stomach, nausea,Headache,photosensitivity', NULL, '2023-06-17 21:05:11', 'emergency', 'stage1', 'stable', 'stable', NULL),
(27, 1, 83, 96, 'emergency', 50, 'like I have the flu,like I have to vomit,sleepy,fever,blurred vision,dizzy/about to black out,my mouth is dry', 'new heart palpitations,Soft stools, short-term diarrhea,oedema,Upset stomach, nausea,your mouth, face or lips start swelling', NULL, '2023-06-17 21:05:31', 'emergency', 'stage1', 'stable', 'stable', NULL),
(28, 1, 90, 140, 'emergency', 40, NULL, NULL, NULL, '2023-05-31 12:50:34', 'emergency', 'emergency', 'stable', 'stable', NULL),
(29, 1, 90, 140, 'emergency', 40, NULL, NULL, NULL, '2023-06-19 12:55:44', 'emergency', 'emergency', 'stable', 'stable', NULL),
(30, 1, 90, 140, 'emergency', 40, 'like I have the flu,like I have to vomit,sleepy,fever,blurred vision,dizzy/about to black out,my mouth is dry', NULL, NULL, '2023-06-15 19:00:00', 'emergency', 'emergency', 'stable', 'stable', NULL),
(31, 1, 80, 120, 'stable', 120, NULL, NULL, NULL, '2023-06-15 23:22:54', 'stable', 'stable', 'stable', 'stable', NULL),
(32, 1, 90, 130, 'emergency', 250, 'blurred vision', 'oedema', NULL, '2023-06-17 17:11:41', 'emergency', 'emergency', 'stable', 'emergency', NULL),
(33, 1, 90, 140, 'emergency', 250, 'like I have to vomit', 'Headache', NULL, '2023-06-20 01:00:47', 'emergency', 'emergency', 'stable', 'emergency', '2023-06-20 04:00:43'),
(34, 1, 90, 140, 'emergency', 250, 'like I have the flu', 'new heart palpitations,Headache', NULL, '2023-06-20 01:24:40', 'emergency', 'emergency', 'stable', 'emergency', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_complaint`
--

CREATE TABLE `patient_complaint` (
  `id` int(11) NOT NULL,
  `MRN` int(11) NOT NULL,
  `chief_complaint` varchar(255) DEFAULT NULL,
  `medication_allergies` varchar(255) DEFAULT NULL,
  `previous_surgeries` varchar(255) DEFAULT NULL,
  `current_medications` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_complaint`
--

INSERT INTO `patient_complaint` (`id`, `MRN`, `chief_complaint`, `medication_allergies`, `previous_surgeries`, `current_medications`, `notes`, `created_at`) VALUES
(1, 1, 'Osama is a 23-year-old male, has Diabetes which started last week', 'Penicillin and related antibiotics.', 'Coronary artery bypass grafting', 'Acebutolol, Aspocid', NULL, '2023-05-24 18:00:18'),
(2, 2, 'The patient suffers from weight gain with diabetes, as well as a chronic heart patient and also suffers from high cholesterol and pressure.', 'Pain relievers, such as aspirin, ibuprofen and naproxen sodium', 'Thrombolysis, Coronary angioplasty ', 'Invokana, Victoza', NULL, '2023-06-19 12:26:29'),
(3, 3, 'The patient suffered from diabetes, which led to kidney failure as a result of the kidney being affected by atherosclerosis. The patient performs dialysis.', 'Medicines for autoimmune diseases', '--', 'Glucotrol', NULL, '2023-06-19 12:38:20'),
(4, 4, 'The patient now suffers from Gestational diabetes, as she is in her 25th week of pregnancy.', 'Antibiotics, such as penicillin', '--', '--', NULL, '2023-06-19 12:44:21'),
(5, 5, 'The patient has had a history of heart attacks and has high blood pressure with a weakened heart muscle.', 'Medicines for autoimmune diseases', 'Heart Valve Surgery\r\n', 'Concor, Caboten, Nevilob', NULL, '2023-06-19 12:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient_relatives`
--

CREATE TABLE `patient_relatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MRN` int(10) NOT NULL,
  `relative_id` int(11) NOT NULL,
  `relatively_degree` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Approved` text DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_relatives`
--

INSERT INTO `patient_relatives` (`id`, `MRN`, `relative_id`, `relatively_degree`, `created_at`, `updated_at`, `Approved`) VALUES
(9, 2, 3, 'first', NULL, NULL, 'No'),
(21, 1, 5, 'first', NULL, NULL, 'No'),
(58, 1, 9, 'first', NULL, NULL, 'Yes'),
(60, 3, 7, 'other', NULL, NULL, 'Yes'),
(64, 2, 9, 'first', NULL, NULL, 'Yes'),
(122, 4, 9, 'first', NULL, NULL, 'Yes'),
(124, 4, 13, 'first', NULL, NULL, 'Yes'),
(125, 2, 13, 'second', NULL, NULL, 'Yes'),
(126, 3, 13, 'second', NULL, NULL, 'Yes'),
(127, 1, 13, 'second', NULL, NULL, 'Yes'),
(138, 5, 13, 'first', NULL, NULL, 'Yes'),
(140, 5, 9, 'first', NULL, NULL, 'Yes'),
(168, 4, 12, 'first', NULL, NULL, 'Yes'),
(169, 5, 12, 'first', NULL, NULL, 'Yes'),
(184, 5, 19, 'first', NULL, NULL, 'Yes'),
(185, 4, 19, 'second', NULL, NULL, 'Yes'),
(186, 4, 18, 'first', NULL, NULL, 'Yes'),
(187, 5, 18, 'first', NULL, NULL, 'Yes'),
(194, 5, 4, 'first', NULL, NULL, 'Yes'),
(195, 4, 4, 'first', NULL, NULL, 'Yes'),
(216, 2, 8, 'first', NULL, NULL, 'Yes'),
(219, 4, 7, 'second', NULL, NULL, 'Yes'),
(391, 4, 22, 'other', NULL, NULL, 'Yes'),
(392, 4, 23, 'first', NULL, NULL, 'Yes'),
(396, 1, 21, 'first', NULL, NULL, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE `relatives` (
  `relative_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `relative_img` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `selected_patient` varchar(20) DEFAULT NULL,
  `Recepient_MRN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`relative_id`, `name`, `city`, `country`, `email`, `password`, `phone`, `relative_img`, `created_at`, `updated_at`, `selected_patient`, `Recepient_MRN`) VALUES
(1, 'Mona Ahmed', 'Banha', 'Egypt', 'Mona@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1156998567, 'relative6.png', NULL, NULL, NULL, NULL),
(2, 'Osama Kareem', 'cairo', 'Egypt', 'Osama@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1256887412, 'relative1.png', NULL, NULL, NULL, NULL),
(3, 'Salma Abdulrahman', 'Banha', 'Egypt', 'Salma@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1098223934, 'relative7.png', NULL, NULL, '2', NULL),
(4, 'Ebtsam Mohamed', 'Banha', 'Egypt', 'Ebtsam@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1123556987, 'relative5.jpg', NULL, NULL, '5', 4),
(5, 'Amr Ahmed', 'Banha', 'Egypt', 'Amr@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1345778956, 'relative2.png', NULL, NULL, NULL, NULL),
(7, 'Mohamed Qasim', 'Banha', 'Egypt', 'ebtsamomr72@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1056998234, 'relative3.png', NULL, NULL, '3', 5),
(8, 'Youssef Gamal', 'Banha', 'Egypt', 'Youssef@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1082456321, 'relative4.jpg', NULL, NULL, '2', NULL),
(9, 'Magda Fahmi', 'Banha', 'Egypt', 'Magda@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1296558741, 'relative6.png', NULL, NULL, '1', NULL),
(12, 'Farah Kamal', 'Banha', 'Egypt', 'Farah@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1235874156, 'relative7.png', NULL, NULL, '4', NULL),
(13, 'Laila Ahmed', 'cairo', 'Egypt', 'Laila@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1245785412, 'relative5.jpg', NULL, NULL, '5', NULL),
(18, 'Yosra Nabil', 'cairo', 'Egypt', 'yosra@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1258741234, 'relative7.png', NULL, NULL, '5', 5),
(19, 'Basma Mohamed', 'Banha', 'Egypt', 'Basma@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1058741234, 'relative6.png', NULL, NULL, '4', 4),
(21, 'Yassin Mostafa', 'Banha', 'Egypt', 'Yassin@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1023556882, 'relative1.png', NULL, NULL, '1', 4),
(22, 'Asser Ibrahim', 'cairo', 'Egypt', 'Asser@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1154886987, 'relative2.png', NULL, NULL, '4', 4),
(23, 'Sohila Mostafa', 'Banha', 'Egypt', 'Sohila@gmail.com', '$2y$10$GJPgO5QsuPQDLBNP.aP3cuswiKjjXWbF5LcGZLTU0vWp/Pi1PVyPi', 1023445145, 'relative5.jpg', NULL, NULL, '4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `code` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mechanism` varchar(100) NOT NULL,
  `amount` int(3) NOT NULL,
  `supplier-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensor-supplier`
--

CREATE TABLE `sensor-supplier` (
  `supplier-id` int(11) NOT NULL,
  `company-name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensordata`
--

CREATE TABLE `sensordata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heart` varchar(255) NOT NULL,
  `oxygen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensordata`
--

INSERT INTO `sensordata` (`id`, `heart`, `oxygen`, `created_at`, `updated_at`, `patient_id`) VALUES
(1, '112', '81', '2023-04-22 18:30:23', NULL, 1),
(2, '122', '96', '2023-04-22 18:30:53', NULL, 1),
(3, '144', '85', '2023-04-22 18:31:06', NULL, 1),
(4, '86', '86', '2023-04-22 18:31:39', NULL, 1),
(5, '122', '95', '2023-04-22 18:32:10', NULL, 1),
(6, '98', '95', '2023-05-01 17:32:23', NULL, 1),
(7, '122', '84', '2023-05-01 17:32:41', NULL, 1),
(8, '91', '90', '2023-05-01 17:32:52', NULL, 1),
(9, '116', '90', '2023-05-01 17:33:08', NULL, 1),
(10, '113', '90', '2023-05-01 17:33:22', NULL, 1),
(29, '83', '31', '2023-05-01 17:33:24', NULL, 1),
(33, '115', '73', '2023-05-01 17:33:26', NULL, 1),
(34, '88', '45', '2023-05-01 17:33:30', NULL, 1),
(39, '68', '53', '2023-05-01 17:33:32', NULL, 1),
(40, '93', '33', '2023-05-25 09:38:53', NULL, 1),
(45, '136', '89', '2023-05-25 09:40:28', NULL, 1),
(47, '115', '88', '2023-05-25 09:41:06', NULL, 1),
(50, '166', '97', '2023-05-25 09:42:00', NULL, 1),
(52, '107', '92', '2023-05-25 09:42:39', NULL, 1),
(54, '68', '72', '2023-05-25 09:43:16', NULL, 1),
(61, '100', '85', '2023-05-25 09:45:56', NULL, 1),
(63, '166', '92', '2023-05-25 09:46:32', NULL, 1),
(64, '68', '65', '2023-05-25 09:46:50', NULL, 1),
(65, '115', '77', '2023-05-25 09:47:08', NULL, 1),
(67, '16', '83', '2023-05-25 09:47:44', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`, `type`) VALUES
(1, 'Osama Ahmed', 'osamaahmed123@gmail.com', NULL, '$2y$10$folUQ4jETGHHnMUjYkx2heu1ttmr2n4rNeDk7HtVl/4NfnzqxtP4W', 'IPpY6TGFue2VZJAMVkVtTWXcEXGxXO4qUvuQcQ3Z2Mw7drlLtXIDREvtvcaZ', '2023-04-28 13:56:31', '2023-06-17 14:53:36', 1, 'avatar.png', 0, '#ff2522', 'patient'),
(2, 'Ahmed Elsadany', 'ahmedelsadney1@gmail.com', NULL, '$2y$10$4Dzgzkrys6A0jwN.omEw.u5iPWBZQDZaItwSdqEjW1Va3DyYuMoga', 'nDZtNCc6yWvspIhCKolUIn2Y5yunZoKJk5pGaQlSjikPkCCki13Yb5nYZfyi', '2023-04-28 14:00:24', '2023-06-17 16:19:44', 0, 'avatar.png', 0, '#ff2522', 'doctor'),
(3, 'Ali Mohamed', 'alimohamed@gmail.com', NULL, '$2y$10$6JZrtcwwlKN3Mk0s10T06e0h0H.Od3MkajdU4moskylqFTjLsOqOe', NULL, '2023-05-31 18:40:24', '2023-05-31 18:40:24', 0, 'avatar.png', 0, NULL, 'doctor'),
(13, 'Doaa Abdullah', 'doaaabdullah@gmail.com', NULL, '$2y$10$DEst/zBMYwD3c.u3E8nS5.tPSls7bTQx/Fq3zCdJ5mnvSQ.dSTcmC', NULL, '2023-06-18 17:16:49', '2023-06-18 17:16:49', 0, 'avatar.png', 0, NULL, 'doctor'),
(14, 'Nabil Samir', 'nabilsamir@gmail.com', NULL, '$2y$10$aPkVORcMMb7OqE5Bwd4mVu0nu0zmDEnTE0ZDjan6/oHr19bP3z5Jq', NULL, '2023-06-18 17:18:09', '2023-06-18 17:18:09', 0, 'avatar.png', 0, NULL, 'doctor'),
(15, 'Amr Samy', 'amrsamy@gmail.com', NULL, '$2y$10$3OPgNR85NIP8R.xErItwteOTrKzygMA2RT.j7aj3UqAw7t8d6SR56', NULL, '2023-06-18 17:18:46', '2023-06-18 17:18:46', 0, 'avatar.png', 0, NULL, 'doctor'),
(16, 'Mahmoud Zohny', 'mahmoudzohny@gmail.com', NULL, '$2y$10$WpmtOawlHhUrhuj0YfrlL.3/j0Tnrfa4Mqv5MNQX5chA59f/nDiPa', NULL, '2023-06-18 17:20:14', '2023-06-18 17:20:14', 0, 'avatar.png', 0, NULL, 'doctor'),
(17, 'Ahmed Mostafa', 'ahmedmostafa@gmail.com', NULL, '$2y$10$3Kwh7rWE.a9XlsWEZd4HfOrEtsRHXlKgLpcJl2Jwe7ApQRjWEIiea', NULL, '2023-06-18 17:26:12', '2023-06-18 17:26:12', 0, 'avatar.png', 0, NULL, 'patient'),
(18, 'Ahmed Khaled', 'ahmedkhaled5@gmail.com', NULL, '$2y$10$NkIyDxFS5XMSkfW8/SEA0.Ejf/cv4115t/SHVG7RHrgP1umxQKvba', NULL, '2023-06-18 17:27:01', '2023-06-18 17:27:01', 0, 'avatar.png', 0, NULL, 'patient'),
(19, 'Farida Omar', 'faridaomar@gmail.com', NULL, '$2y$10$7mE1454vCAGX/.RSI.nSvOusoofzhyz4DXSq813CMdIhWjYrlSEia', NULL, '2023-06-18 17:27:35', '2023-06-18 17:27:35', 0, 'avatar.png', 0, NULL, 'patient'),
(20, 'Yousef Samy', 'yousefsamy0@gmail.com', NULL, '$2y$10$hW7RaX8/DJOG4AJltuHGUurKEA4zZW/h0Z6BXyNtc6TFd0I0F.bvG', NULL, '2023-06-18 17:28:34', '2023-06-18 17:28:34', 0, 'avatar.png', 0, NULL, 'patient'),
(21, 'Al-Mokhtaber', 'alaaibrahimmahfoz@gmail.com', NULL, '$2y$10$1ahKsH.gYhXqf/hUaHPHve7kcvDP9NswS2T1j4HBwGLg5RE6r5Ery', NULL, '2023-06-19 10:38:26', '2023-06-19 10:38:26', 0, 'avatar.png', 0, NULL, 'lab'),
(22, 'Al Borg', 'AlBorg@gmail.com', NULL, '$2y$10$UYIOEZZWqC.zuJhiX0o1EOdbx1zj7l6LT.tsCsEv7B7lKH4C2Ks4y', NULL, '2023-06-19 10:39:41', '2023-06-19 10:39:41', 0, 'avatar.png', 0, NULL, 'lab'),
(23, 'Alfa Laboratory', 'Alfa@gmail.com', NULL, '$2y$10$L98GVYz6dp8Hfh7R2jhRpeofPcf7OnvYa3XlpWfgG3oVd2Mf1fjqm', NULL, '2023-06-19 10:40:34', '2023-06-19 10:40:34', 0, 'avatar.png', 0, NULL, 'lab'),
(24, 'Faraby Laboratory', 'faraby@gmail.com', NULL, '$2y$10$n91Mu.MpYP0jRPVGQmxVfOJpZlh0j4RkdZ2vtI6wrJxgQv2peEQsa', NULL, '2023-06-19 10:41:25', '2023-06-19 10:41:25', 0, 'avatar.png', 0, NULL, 'lab'),
(25, 'Delta Lab', 'delta@gmail.com', NULL, '$2y$10$T6ef1ppHmAygFHgcXjL/FO6DxbSQP7HS8sdVXPf9LaprgYcv90jbW', NULL, '2023-06-19 10:42:16', '2023-06-19 10:42:16', 0, 'avatar.png', 0, NULL, 'lab'),
(26, 'Arabs International Lab', 'Arabs@gmail.com', NULL, '$2y$10$vWCsZQOHz6vrZc7tary4D.5h/FYOCVPfQ2qvT9UYBagHVuR1.a/Ni', NULL, '2023-06-19 10:43:26', '2023-06-19 10:43:26', 0, 'avatar.png', 0, NULL, 'lab'),
(27, 'Almostaqbal Lab', 'almostaqbal-lab@gmail.com', NULL, '$2y$10$H/o8SSYnUxxYSszsII4yaOW6g2HQNAneIHPJzMDovTMNaEbhQt4tq', NULL, '2023-06-19 10:44:00', '2023-06-19 10:44:00', 0, 'avatar.png', 0, NULL, 'lab'),
(28, 'Mona Ahmed', 'Mona@gmail.com', NULL, '$2y$10$1TLHgWhCo5bnr0wud0wVt.fKOQ3ZJ64c6RI/yJC/kAmP001YLlA0K', NULL, '2023-06-19 15:07:52', '2023-06-19 15:07:52', 0, 'avatar.png', 0, NULL, 'relative'),
(29, 'Osama Kareem', 'Osama@gmail.com', NULL, '$2y$10$PRpT79AQMJUs9vLm8lIFSOpoG0DlqXb7Hei8Rlg.z2L4EsE2H73/y', NULL, '2023-06-19 15:08:33', '2023-06-19 15:08:33', 0, 'avatar.png', 0, NULL, 'relative'),
(30, 'Salma Abdulrahman', 'Salma@gmail.com', NULL, '$2y$10$a662p0KA.b2K8aDf72JvRehmJ/48oXUQHCsQdPVNOY/UOglENYJcS', NULL, '2023-06-19 15:09:07', '2023-06-19 15:09:07', 0, 'avatar.png', 0, NULL, 'relative'),
(31, 'Ebtsam Mohamed', 'Ebtsam@gmail.com', NULL, '$2y$10$19/IlvO.8ysGg5/sRDdvvO/YXpxmAcoBleD1K8xUNtvgfeZq7KFcm', NULL, '2023-06-19 15:09:50', '2023-06-19 15:09:50', 0, 'avatar.png', 0, NULL, 'relative'),
(32, 'Amr Ahmed', 'Amr@gmail.com', NULL, '$2y$10$PQ45yKKxowogclyQlVmafeqZn.E4mHWBquxp4HE3q/58xyMkHHU/W', NULL, '2023-06-19 15:11:10', '2023-06-19 15:11:10', 0, 'avatar.png', 0, NULL, 'relative'),
(33, 'Mohamed Qasim', 'ebtsamomr72@gmail.com', NULL, '$2y$10$xBQ8ix6ba2ywz/KCeSYH6eHptWD7PK6/6LQ57XpP5SKu7tOzeM4VK', NULL, '2023-06-19 15:11:40', '2023-06-19 15:11:40', 0, 'avatar.png', 0, NULL, 'relative'),
(34, 'Youssef Gamal', 'Youssef@gmail.com', NULL, '$2y$10$MM0xBRePJ81qLHy2h9vleeU0mQp5edRtxzBelokHENTlS/dzvVe82', NULL, '2023-06-19 15:12:10', '2023-06-19 15:12:10', 0, 'avatar.png', 0, NULL, 'relative'),
(35, 'Magda Fahmi', 'Magda@gmail.com', NULL, '$2y$10$hNzE0tgSlZbvwfv4.F5r.uRFPF1sJD79rhjAgpgomVM9Cw0hZPHJi', NULL, '2023-06-19 15:13:00', '2023-06-19 15:13:00', 0, 'avatar.png', 0, NULL, 'relative'),
(36, 'Farah Kamal', 'Farah@gmail.com', NULL, '$2y$10$A54IccT64MpiZVNLuLAI/utBJfUj7y.6.lvO11AFHF5H.V89yYp5u', NULL, '2023-06-19 15:15:41', '2023-06-19 15:15:41', 0, 'avatar.png', 0, NULL, 'relative'),
(37, 'Laila Ahmed', 'Laila@gmail.com', NULL, '$2y$10$LJMEcDk3zJdNWKBCYnpu8eThgk0aU25p6y7Qy47hhwltqchQCBiJm', NULL, '2023-06-19 15:16:35', '2023-06-19 15:16:35', 0, 'avatar.png', 0, NULL, 'relative'),
(38, 'Basma Mohamed', 'Basma@gmail.com', NULL, '$2y$10$5qgJvMjOWWreZJYaDV8LRuHjvzC8sceeQqUbnnJj9b5fr8Ha.cL5i', NULL, '2023-06-19 15:17:12', '2023-06-19 15:17:12', 0, 'avatar.png', 0, NULL, 'relative'),
(39, 'Yosra Nabil', 'yosra@gmail.com', NULL, '$2y$10$FGcTW.u9TsSLcDmQFgg8VecUmGNFzmRJsH0SWPZf1XOH6m2Evq4Oa', NULL, '2023-06-19 15:18:32', '2023-06-19 15:18:32', 0, 'avatar.png', 0, NULL, 'relative'),
(40, 'Yassin Mostafa', 'Yassin@gmail.com', NULL, '$2y$10$gl.Cn27GXpH.CrdNjktzxe2yqLLBzB/LLXughOG5o2z4eeAE0pMdy', NULL, '2023-06-19 15:19:47', '2023-06-19 15:19:47', 0, 'avatar.png', 0, NULL, 'relative'),
(41, 'Asser Ibrahim', 'Asser@gmail.com', NULL, '$2y$10$8w8w9v3eD0YESzafza/q1uzycag68.uNF2ceDUCAIP6h5OfxIemCy', NULL, '2023-06-19 15:20:17', '2023-06-19 15:20:17', 0, 'avatar.png', 0, NULL, 'relative'),
(42, 'Sohila Mostafa', 'Sohila@gmail.com', NULL, '$2y$10$Slae1gQo0lsJBYclAh1Wlut.IDYGqLzmO0EY3.QQdDoQmkhMm6fbe', NULL, '2023-06-19 15:20:45', '2023-06-19 15:20:45', 0, 'avatar.png', 0, NULL, 'relative');

-- --------------------------------------------------------

--
-- Table structure for table `zoom`
--

CREATE TABLE `zoom` (
  `primary_id` int(11) NOT NULL,
  `uuid` text DEFAULT NULL,
  `id` text DEFAULT NULL,
  `host_id` text DEFAULT NULL,
  `host_email` text DEFAULT NULL,
  `topic` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `start_time` text DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `duration` int(6) DEFAULT NULL,
  `timezone` text DEFAULT NULL,
  `agenda` text DEFAULT NULL,
  `created_at` text DEFAULT NULL,
  `start_url` text DEFAULT NULL,
  `join_url` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `h323_password` text NOT NULL,
  `pstn_password` text NOT NULL,
  `encrypted_password` text DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zoom`
--

INSERT INTO `zoom` (`primary_id`, `uuid`, `id`, `host_id`, `host_email`, `topic`, `type`, `status`, `start_time`, `start_at`, `duration`, `timezone`, `agenda`, `created_at`, `start_url`, `join_url`, `password`, `h323_password`, `pstn_password`, `encrypted_password`, `settings`, `doctor_id`) VALUES
(7, 'HLGXhKSjRf2i4cFEt1HGCg==', '89269455379', 'dsH01D4lSCaklzTMdcfYeQ', 'competitivep00@gmail.com', 'Consult', '2', 'waiting', '2023-05-31T18:31:15Z', '2023-06-01 18:30:00', 20, 'America/Los_Angeles', 'Check-Up', '2023-05-31T18:31:15Z', 'https://us05web.zoom.us/s/89269455379?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJhdWQiOiJjbGllbnRzbSIsInVpZCI6ImRzSDAxRDRsU0Nha2x6VE1kY2ZZZVEiLCJpc3MiOiJ3ZWIiLCJzayI6IjAiLCJzdHkiOjEsIndjZCI6InVzMDUiLCJjbHQiOjAsIm1udW0iOiI4OTI2OTQ1NTM3OSIsImV4cCI6MTY4NTU2NTA3NSwiaWF0IjoxNjg1NTU3ODc1LCJhaWQiOiJpY19BSGtqaVFYaVlTS2dfaG4yODBBIiwiY2lkIjoiIn0.4hvhmO8C7BMc8qp0Qy19bfHXavLywvclw5S_dSRY1kA', 'https://us05web.zoom.us/j/89269455379?pwd=SU5kN3BLWFB3NGJKaC8wVzlkcXFiZz09', 'UmX8dg', '885063', '885063', 'SU5kN3BLWFB3NGJKaC8wVzlkcXFiZz09', NULL, 1),
(8, 'kOCRQJuwTtWOAh6cWcXJdg==', '84515142805', 'dsH01D4lSCaklzTMdcfYeQ', 'competitivep00@gmail.com', 'Consult', '2', 'waiting', '2023-06-14T20:51:37Z', '2023-06-16 14:30:00', 45, 'Pacific/Midway', 'Check patient status', '2023-06-15T20:41:38Z', 'https://us05web.zoom.us/s/84515142805?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJhdWQiOiJjbGllbnRzbSIsInVpZCI6ImRzSDAxRDRsU0Nha2x6VE1kY2ZZZVEiLCJpc3MiOiJ3ZWIiLCJzayI6IjAiLCJzdHkiOjEsIndjZCI6InVzMDUiLCJjbHQiOjAsIm1udW0iOiI4NDUxNTE0MjgwNSIsImV4cCI6MTY4Njc4MjQ5OCwiaWF0IjoxNjg2Nzc1Mjk4LCJhaWQiOiJpY19BSGtqaVFYaVlTS2dfaG4yODBBIiwiY2lkIjoiIn0.DHwzbNiFD83kftfNeD18aY7hp9i5_BIe1zALx0qscf8', 'https://us05web.zoom.us/j/84515142805?pwd=cWVkcWN4VWxIYUJZS3I0Wm0xZFUzdz09', '09M8w8', '060033', '060033', 'cWVkcWN4VWxIYUJZS3I0Wm0xZFUzdz09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zoompatient`
--

CREATE TABLE `zoompatient` (
  `id` int(11) NOT NULL,
  `zoom_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zoompatient`
--

INSERT INTO `zoompatient` (`id`, `zoom_id`, `doctor_id`, `patient_id`) VALUES
(8, 7, 1, 1),
(9, 8, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulane-unit`
--
ALTER TABLE `ambulane-unit`
  ADD PRIMARY KEY (`ambulane-id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `disease_test`
--
ALTER TABLE `disease_test`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `disease-id` (`disease_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `doctor-patient`
--
ALTER TABLE `doctor-patient`
  ADD PRIMARY KEY (`MRN`,`doctor_id`),
  ADD KEY `doctor-id` (`doctor_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `labunit`
--
ALTER TABLE `labunit`
  ADD PRIMARY KEY (`lab_id`),
  ADD UNIQUE KEY `lab_name` (`lab_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `lab_appointment`
--
ALTER TABLE `lab_appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `credit-card` (`invoice_id`),
  ADD KEY `MRN` (`MRN`),
  ADD KEY `lab_id` (`lab_id`);

--
-- Indexes for table `lab_result`
--
ALTER TABLE `lab_result`
  ADD PRIMARY KEY (`appointment_id`,`test_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `online_classes_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`MRN`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ambulance-id` (`ambulance-id`);

--
-- Indexes for table `patient-ambulance`
--
ALTER TABLE `patient-ambulance`
  ADD PRIMARY KEY (`id`,`MRN`),
  ADD KEY `MRN` (`MRN`);

--
-- Indexes for table `patient-disease`
--
ALTER TABLE `patient-disease`
  ADD PRIMARY KEY (`MRN`,`disease_id`),
  ADD KEY `disease-id` (`disease_id`);

--
-- Indexes for table `patient-sensor`
--
ALTER TABLE `patient-sensor`
  ADD PRIMARY KEY (`MRN`,`code`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `patient-vital-sign`
--
ALTER TABLE `patient-vital-sign`
  ADD PRIMARY KEY (`ID`,`MRN`),
  ADD KEY `MRN` (`MRN`);

--
-- Indexes for table `patient_complaint`
--
ALTER TABLE `patient_complaint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_re` (`MRN`);

--
-- Indexes for table `patient_relatives`
--
ALTER TABLE `patient_relatives`
  ADD PRIMARY KEY (`id`,`MRN`,`relative_id`),
  ADD KEY `relative-patient_ibfk_2` (`relative_id`),
  ADD KEY `relative-patient_ibfk_1` (`MRN`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `relatives`
--
ALTER TABLE `relatives`
  ADD PRIMARY KEY (`relative_id`),
  ADD UNIQUE KEY `relatives_email_unique` (`email`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`code`),
  ADD KEY `supplier-id` (`supplier-id`);

--
-- Indexes for table `sensor-supplier`
--
ALTER TABLE `sensor-supplier`
  ADD PRIMARY KEY (`supplier-id`);

--
-- Indexes for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensor_patient` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zoom`
--
ALTER TABLE `zoom`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `doctor` (`doctor_id`);

--
-- Indexes for table `zoompatient`
--
ALTER TABLE `zoompatient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_id` (`zoom_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disease_test`
--
ALTER TABLE `disease_test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labunit`
--
ALTER TABLE `labunit`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lab_appointment`
--
ALTER TABLE `lab_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=682;

--
-- AUTO_INCREMENT for table `online_classes`
--
ALTER TABLE `online_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient-ambulance`
--
ALTER TABLE `patient-ambulance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient-vital-sign`
--
ALTER TABLE `patient-vital-sign`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `patient_complaint`
--
ALTER TABLE `patient_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_relatives`
--
ALTER TABLE `patient_relatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relatives`
--
ALTER TABLE `relatives`
  MODIFY `relative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sensor-supplier`
--
ALTER TABLE `sensor-supplier`
  MODIFY `supplier-id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `zoom`
--
ALTER TABLE `zoom`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zoompatient`
--
ALTER TABLE `zoompatient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disease_test`
--
ALTER TABLE `disease_test`
  ADD CONSTRAINT `disease_test_ibfk_1` FOREIGN KEY (`disease_id`) REFERENCES `disease` (`disease_id`);

--
-- Constraints for table `doctor-patient`
--
ALTER TABLE `doctor-patient`
  ADD CONSTRAINT `doctor-patient_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `doctor-patient_ibfk_2` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `online_classes`
--
ALTER TABLE `online_classes`
  ADD CONSTRAINT `online_classes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`ambulance-id`) REFERENCES `ambulane-unit` (`ambulane-id`);

--
-- Constraints for table `patient-ambulance`
--
ALTER TABLE `patient-ambulance`
  ADD CONSTRAINT `patient-ambulance_ibfk_1` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `patient-disease`
--
ALTER TABLE `patient-disease`
  ADD CONSTRAINT `patient-disease_ibfk_1` FOREIGN KEY (`disease_id`) REFERENCES `disease` (`disease_id`),
  ADD CONSTRAINT `patient-disease_ibfk_2` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `patient-sensor`
--
ALTER TABLE `patient-sensor`
  ADD CONSTRAINT `patient-sensor_ibfk_1` FOREIGN KEY (`code`) REFERENCES `sensor` (`code`),
  ADD CONSTRAINT `patient-sensor_ibfk_2` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `patient-vital-sign`
--
ALTER TABLE `patient-vital-sign`
  ADD CONSTRAINT `patient-vital-sign_ibfk_1` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `patient_complaint`
--
ALTER TABLE `patient_complaint`
  ADD CONSTRAINT `patient_re` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `patient_relatives`
--
ALTER TABLE `patient_relatives`
  ADD CONSTRAINT `patient_relatives_ibfk_1` FOREIGN KEY (`MRN`) REFERENCES `patient` (`MRN`),
  ADD CONSTRAINT `patient_relatives_ibfk_2` FOREIGN KEY (`relative_id`) REFERENCES `relatives` (`relative_id`);

--
-- Constraints for table `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `sensor_ibfk_1` FOREIGN KEY (`supplier-id`) REFERENCES `sensor-supplier` (`supplier-id`);

--
-- Constraints for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD CONSTRAINT `sensor_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`MRN`);

--
-- Constraints for table `zoom`
--
ALTER TABLE `zoom`
  ADD CONSTRAINT `doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `zoompatient`
--
ALTER TABLE `zoompatient`
  ADD CONSTRAINT `doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`MRN`),
  ADD CONSTRAINT `zoom_id` FOREIGN KEY (`zoom_id`) REFERENCES `zoom` (`primary_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
