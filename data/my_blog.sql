-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 07:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `subtitle`, `content`, `author`, `created_at`, `created_by`) VALUES
(123, 'Freelancer’s Guide to Landing First Clients', 'Breaking into freelancing can be tough—here’s how I got my first three clients.', '<p>Start with a strong portfolio, even if it&rsquo;s just personal projects. Reach out to potential clients on platforms like Upwork, Freelancer, and even LinkedIn.</p>\r\n<p><img src=\"/my-blog/uploads/1744041985_hero_setup.jpg\" alt=\"\" width=\"158\" height=\"158\"></p>\r\n<p>&nbsp;Always communicate professionally and be clear about timelines and deliverables. Your first few clients may not pay much, but they&rsquo;re your stepping stones to building a reputation.</p>', 'Areesha Hanif', '2025-04-07 16:06:39', 'Areesha'),
(124, 'Top 3 JavaScript Frameworks in 2025', 'Choosing the right JavaScript framework can make or break your project.', '<p>React remains a solid choice with its component-based architecture, but in 2025, Svelte and Qwik have gained serious traction for their performance and simplicity. Each framework has its strengths:</p>\r\n<ul>\r\n<li class=\"\" data-start=\"2309\" data-end=\"2358\">\r\n<p class=\"\" data-start=\"2311\" data-end=\"2358\"><strong data-start=\"2311\" data-end=\"2321\">React:</strong> Huge ecosystem and community support</p>\r\n</li>\r\n<li class=\"\" data-start=\"2359\" data-end=\"2409\">\r\n<p class=\"\" data-start=\"2361\" data-end=\"2409\"><strong data-start=\"2361\" data-end=\"2372\">Svelte:</strong> No virtual DOM, smaller bundle sizes</p>\r\n</li>\r\n<li><strong data-start=\"2412\" data-end=\"2421\">Qwik:</strong> Optimized for instant loading and SEO&nbsp;</li>\r\n</ul>\r\n<p><img src=\"/my-blog/uploads/1744042195_contact-us-team.jpg\" alt=\"\" width=\"466\" height=\"310\"></p>\r\n<p>Choosing the right one depends on your project goals and developer experience.</p>', 'Alishba', '2025-04-07 16:10:16', 'Alishba Hanif'),
(125, 'Hello guys', 'My name is munna', '<p>Hello guys!!!</p>', 'Zarrar', '2025-04-07 16:14:24', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `identifier`, `password`, `login_time`) VALUES
(107, 'areesha', '$2y$10$/n6Ii75xjxwJHbxVLzuBOepclBV.E2gFhe/tjCo.82ImqYvbdyuWq', '2025-04-07 18:05:21'),
(108, 'alishba hanif', '$2y$10$oIKg9XSH7cgGFF4arnHrju1TuKWCRJncaS20cFjNC9fvnG59bMzBS', '2025-04-07 18:08:12'),
(109, 'Test', '$2y$10$PYVYVk9Jc03AXrAz7gMeu.BopF5Yr0n15QsRdySkUtybJRXe509IW', '2025-04-07 18:13:29'),
(110, 'test', '$2y$10$PYVYVk9Jc03AXrAz7gMeu.BopF5Yr0n15QsRdySkUtybJRXe509IW', '2025-04-07 18:15:19'),
(111, 'areesha', '$2y$10$/n6Ii75xjxwJHbxVLzuBOepclBV.E2gFhe/tjCo.82ImqYvbdyuWq', '2025-04-07 18:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(19, 'areesha123@gmail.com', 'Areesha', '$2y$10$/n6Ii75xjxwJHbxVLzuBOepclBV.E2gFhe/tjCo.82ImqYvbdyuWq'),
(20, 'alishba123@gmail.com', 'Alishba Hanif', '$2y$10$oIKg9XSH7cgGFF4arnHrju1TuKWCRJncaS20cFjNC9fvnG59bMzBS'),
(21, 'Test123@gmail.com', 'Test', '$2y$10$PYVYVk9Jc03AXrAz7gMeu.BopF5Yr0n15QsRdySkUtybJRXe509IW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
