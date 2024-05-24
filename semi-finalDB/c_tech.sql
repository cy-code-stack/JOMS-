-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 05:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_lists`
--

CREATE TABLE `admin_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_lists`
--

INSERT INTO `admin_lists` (`id`, `first_name`, `last_name`, `email`, `password`, `profileImage`) VALUES
(1, 'Ricah', 'Blanca', 'blancaadmin@email.com', 'password1', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `customers_lists`
--

CREATE TABLE `customers_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `verification` varchar(255) DEFAULT NULL,
  `fullAdress` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers_lists`
--

INSERT INTO `customers_lists` (`id`, `first_name`, `last_name`, `account_id`, `email`, `password`, `mobile_number`, `created_at`, `profileImage`, `verification`, `fullAdress`, `country`, `region`, `lat`, `lng`) VALUES
(3, 'techys', 'techhyyyyy', '000-001', 'test1234@gmail.com', 'customer123', '09123456789', '2023-07-17 21:55:33', NULL, 'Verified', 'Milagros, Southern Davao, Panabo, Davao del Norte, Davao Region, 8105, Philippines', 'Philippines', 'Davao Region', '7.329416614707478', '125.66347834755177'),
(4, 'test', 'test1', '000-004', 'test123@gmail.com', 's2JVuA3o', '0912134589797', '2023-07-17 22:02:41', NULL, 'Verified', 'Masarayao, Kananga, Leyte 4th District, Leyte, Eastern Visayas, 6531, Philippines', 'Philippines', 'Eastern Visayas', '11.113727282172755', '124.60458644162573'),
(5, 'john', 'michael', '000-005', 'jmichaelemail69@gmail.com', 'asdasd', '123123123', '2023-07-29 21:46:48', NULL, 'Verified', '', '', '', '0', '0'),
(13, 'Philip', 'Gonzales', '000-006', 'cymonbuladaco971@gmail.com', '123aa', '09912258947', '2023-11-26 04:55:21', NULL, 'Verified', 'Samar, Eastern Visayas, Philippines', 'Philippines', 'Eastern Visayas', '12.232654837013484', '125.07266286616851');

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
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_type` varchar(255) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `job_status` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `customer_remarks` varchar(255) DEFAULT NULL,
  `aborted_at` varchar(255) DEFAULT NULL,
  `completed_at` varchar(255) DEFAULT NULL,
  `partsReplace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `partsInplace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `remarksAndAccomplishment` text DEFAULT NULL,
  `generated` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `customer_id`, `technician_id`, `job_type`, `job_description`, `address`, `job_status`, `remarks`, `created_at`, `assigned_at`, `rating`, `customer_remarks`, `aborted_at`, `completed_at`, `partsReplace`, `partsInplace`, `remarksAndAccomplishment`, `generated`) VALUES
(25, 3, 1, 'Cctv Installation', 'asdadasdsad', 'asdadda panabo city', 'On-going', '', '2023-07-17 22:03:45', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(26, 3, 3, 'Solar Installation', '', 'asdadda panabo city', 'On-going', '', '2023-07-17 22:04:20', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(27, 3, 2, 'Internet Installation', 'asdsafgsdhfarwsedfg', 'asdadda panabo city', 'Aborted', 'Lisod man UY!', '2023-07-17 22:04:27', '2023-08-02 21:49:55', NULL, NULL, '2023-08-02 14:53:17', NULL, '', '', NULL, NULL),
(28, 3, 2, 'Internet Installation', 'asdsafgsdhfarwsedfg', 'asdadda panabo city', 'Aborted', 'asdadaads', '2023-07-17 22:04:27', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(29, 3, 1, 'Repair and Installation', 'ghfghghfhg', 'asdadda panabo city', 'On-going', '', '2023-07-17 22:04:36', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(30, 3, 3, 'Solar Installation', '', 'asdadda panabo city', 'On-going', '', '2023-07-17 22:04:40', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(31, 3, 1, 'Internet Installation', '', 'asdadda panabo city', 'Complete', '', '2023-07-17 22:05:49', NULL, '4', 'ok lang', NULL, NULL, '[{\"item\":\"item1\"},{\"item\":\"item2\"}]', '[{\"item\":\"air conditioner\",\"price\":\"12\"},{\"item\":\"Item2\",\"price\":\"232\"},{\"item\":\"item3\",\"price\":\"123123\"}]', 'asdsadasdsad', 'Downloaded'),
(32, 3, 2, 'Internet Installation', '', 'asdadda panabo city', 'Aborted', 'asadasasdasd', '2023-07-17 22:05:55', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(33, 3, NULL, 'asdsaddas', 'asdadasdasddasd', 'asdadda panabo city', 'Pending', '', '2023-11-22 21:41:29', '2023-08-02 21:01:52', NULL, NULL, NULL, NULL, '', '', NULL, NULL),
(35, 3, 1, 'Internet Installation', 'asdsad', 'asdadda panabo city', 'Complete', '', '2023-07-17 22:07:00', NULL, '5', 'asdasd', NULL, '2023-11-25 10:35:04', '[{\"item\":\"asdad\"},{\"item\":\"asdsa\"}]', '[{\"item\":\"sadsad\",\"price\":\"23\"}]', 'asdasd', 'True'),
(38, 4, 1, 'Solar Installation', 'ead', 'test, panabo city', 'Complete', '', '2023-11-24 17:38:46', '2023-11-24 17:55:42', '4', 'ok', NULL, '2023-11-25 02:06:00', '[{\"item\":\"items2\"}]', '[{\"item\":\"asd\",\"price\":\"123\"}]', 'SADDDDDDDDDDDDDDDDDDDDDDDDDadasd', 'True');

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_06_10_133140_create_technician_lists_table', 1),
(5, '2023_06_10_134026_create_customers_lists_table', 1),
(6, '2023_06_10_134058_create_job_requests_table', 1),
(7, '2023_06_10_134108_create_admin_lists_table', 1),
(8, '2023_07_11_011434_add_column_to_table', 1),
(9, '2023_07_11_043550_add_column_to_table', 1),
(10, '2023_07_11_043609_add_column_to_table', 1),
(11, '2023_07_29_143418_add_column_to_table', 2),
(12, '2023_07_30_174315_add_column_to_table', 3),
(14, '2023_08_02_140738_add_column_to_table', 4),
(16, '2023_11_23_005125_add_new_column_to_customers_lists', 5),
(18, '2023_11_24_124321_add_new_column_to_job_requests', 6),
(19, '2023_11_24_233655_add_new_column_to_job_requests', 7),
(20, '2023_11_25_062419_add_new_column_to_job_requests', 8);

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
-- Table structure for table `technician_lists`
--

CREATE TABLE `technician_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technician_lists`
--

INSERT INTO `technician_lists` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `profileImage`) VALUES
(1, 'Tech1', 'techyy', 'tech1@gmail.com', 'tech123456', '2023-07-13 17:08:52', NULL),
(2, 'Ricah', 'Tech', 'ricahtech123@gmail.com', 'ricahblanca', '2023-07-13 21:00:30', 'profile.png'),
(3, 'Efrain', 'Lee', 'leeefrain@gmail.com', 'Yq2i5sYS', '2023-07-14 05:35:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_lists`
--
ALTER TABLE `admin_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_lists_email_unique` (`email`);

--
-- Indexes for table `customers_lists`
--
ALTER TABLE `customers_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_lists_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_requests_customer_id_foreign` (`customer_id`),
  ADD KEY `job_requests_technician_id_foreign` (`technician_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `technician_lists`
--
ALTER TABLE `technician_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `technician_lists_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_lists`
--
ALTER TABLE `admin_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers_lists`
--
ALTER TABLE `customers_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technician_lists`
--
ALTER TABLE `technician_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD CONSTRAINT `job_requests_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers_lists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_requests_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technician_lists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
