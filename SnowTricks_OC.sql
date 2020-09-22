-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2020 at 07:52 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SnowTricks_OC`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(12, 'Rotations'),
(14, 'Flips'),
(16, 'Rotations désaxées'),
(17, 'Big air'),
(18, 'Hip'),
(19, 'Step-up'),
(20, 'Half-pipe'),
(21, 'Quarter-pipe');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `trick_id_id` int DEFAULT NULL,
  `user_id_id` int DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200908084355', '2020-09-08 08:44:08', 148),
('DoctrineMigrations\\Version20200908094323', '2020-09-08 09:43:46', 235),
('DoctrineMigrations\\Version20200908140536', '2020-09-08 14:05:49', 218),
('DoctrineMigrations\\Version20200908142327', '2020-09-08 14:23:31', 169),
('DoctrineMigrations\\Version20200909065045', '2020-09-09 06:50:52', 248),
('DoctrineMigrations\\Version20200909065836', '2020-09-09 06:58:41', 285),
('DoctrineMigrations\\Version20200920151424', '2020-09-20 15:14:31', 646),
('DoctrineMigrations\\Version20200921140903', '2020-09-21 14:09:10', 540);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `trick_id_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `trick_id_id`, `name`) VALUES
(191, 132, '9f54b4b748f5d37f032b2a5de36782fa.jpeg'),
(192, 132, 'd5aaa68fad82aacf29882ce77e0231c2.jpeg'),
(193, 133, 'b4b8839c279713c8dc2c7dc9d146a580.jpeg'),
(194, 133, '6605ee391ded4a6f82ed4688b6a396e9.jpeg'),
(195, 133, '07d6132a58710485097a8131c92f0fae.jpeg'),
(196, 134, 'dd0c90b0707373727a7b2b0d36e3595d.jpeg'),
(197, 134, '8cdeffe6f6a899487887b31b21771a8d.jpeg'),
(198, 134, '79496ae8171fb70e81826ba26ad7e78a.jpeg'),
(199, 135, '95102a338f4351ab77898e253e8de92f.jpeg'),
(200, 135, 'bb0063b4907e60333423ec32593d2a56.jpeg'),
(201, 135, '675a0124fc0f8d6af39bbd72e9023d23.jpeg'),
(202, 136, 'd2430ae5644343cd3a5aa7aa5b5f845f.jpeg'),
(203, 136, '4c601a23631fa14568a8128bd3dd8c6b.jpeg'),
(204, 136, 'ac5871deeca5ee94dc6d1579d9942fc1.jpeg'),
(205, 137, '659c3a5f29989c2cc3ef3d647fd7b41f.jpeg'),
(206, 137, 'c86c42d3b357799dbd1810e27bcda7e1.jpeg'),
(207, 137, 'c01b5d0c99bac2c1e7d08545f5783b0f.jpeg'),
(208, 138, '49dcaa15007b877caf058f2226b8cb57.jpeg'),
(209, 138, 'b5b0711e1a966e84194fd491c5a4311c.jpeg'),
(210, 138, '27d68debf8d161822716dbfcc073e78c.jpeg'),
(211, 139, '228af235b820df6b02c70ff6f7a0b029.jpeg'),
(212, 139, '0b55c8130316c0e3ab7c68271e5cebe8.jpeg'),
(213, 139, '1d4fdcd82e747412a9d3322b5c29e1c1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tricks`
--

CREATE TABLE `tricks` (
  `id` int NOT NULL,
  `user_id_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tricks`
--

INSERT INTO `tricks` (`id`, `user_id_id`, `name`, `description`, `image`, `created_at`, `updated_at`, `category_id_id`) VALUES
(132, 21, 'mute', 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant ;', 'default-trick.jpg', '2020-09-22 07:38:02', NULL, 17),
(133, 21, 'style week', 'saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-php5CRTNb-5f69aa32da322.jpeg', '2020-09-22 07:39:30', NULL, 12),
(134, 21, 'indy', 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière ;', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-php4ncYGv-5f69aa61eaf44.jpeg', '2020-09-22 07:40:07', '2020-09-22 07:40:17', 19),
(135, 21, 'tail grab', 'saisie de la partie arrière de la planche, avec la main arrière ;', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-phpqqPD7Q-5f69aa9061e39.jpeg', '2020-09-22 07:41:04', NULL, 16),
(136, 21, 'nose grab', 'saisie de la partie avant de la planche, avec la main avant ;', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-phpiPg73Y-5f69aabda24ba.jpeg', '2020-09-22 07:41:49', NULL, 12),
(137, 21, 'japan', 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.', 'default-trick.jpg', '2020-09-22 07:42:24', NULL, 21),
(138, 21, 'seat belt:', 'saisie du carre frontside à l\'arrière avec la main avant ;', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-phpLrYZG5-5f69ab067ff21.jpeg', '2020-09-22 07:43:02', NULL, 12),
(139, 21, 'truck driver', 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-phpy89Nxk-5f69ab445add5.jpeg', '2020-09-22 07:44:04', NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `avatar`, `is_verified`) VALUES
(21, 'hichamzarroukpaylib@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$mUjXGzkrPq5DqLhf7dm27A$jeaGmGMq/L6c2rvM6RpiOP7mpR6dfJCbNksqT7mdV7g', 'wp1828915-programmer-wallpapers-5f68555d23be9.png', 1),
(23, 'Exemple@test.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$0zDbCWgk4VCftUKZmeUueA$pidhBbBUy6Ewpb5rdbfH1gfumz7kIVuHXwB+tSs3oY8', '332c67ea1e1a65ba9989a0b9904f38bf.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int NOT NULL,
  `trick_id_id` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `trick_id_id`, `url`) VALUES
(152, 132, 'https://www.youtube.com/embed/0Oez89EoE_c'),
(153, 133, 'https://www.youtube.com/embed/vquZvxGMJT0'),
(154, 134, 'https://www.youtube.com/embed/SlhGVnFPTDE'),
(155, 135, 'https://www.youtube.com/embed/c6ry31Wc8sI'),
(156, 136, 'https://www.youtube.com/embed/xhvqu2XBvI0'),
(157, 137, 'https://www.youtube.com/embed/eGJ8keB1-JM'),
(158, 138, 'https://www.youtube.com/embed/FMHiSF0rHF8'),
(159, 139, 'https://www.youtube.com/embed/vf9Z05XY79A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CB46B9EE8` (`trick_id_id`),
  ADD KEY `IDX_9474526C9D86650F` (`user_id_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FB46B9EE8` (`trick_id_id`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indexes for table `tricks`
--
ALTER TABLE `tricks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `IDX_E1D902C19D86650F` (`user_id_id`),
  ADD KEY `UNIQ_E1D902C19777D11E` (`category_id_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2CB46B9EE8` (`trick_id_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tricks`
--
ALTER TABLE `tricks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_9474526CB46B9EE8` FOREIGN KEY (`trick_id_id`) REFERENCES `tricks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FB46B9EE8` FOREIGN KEY (`trick_id_id`) REFERENCES `tricks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C19777D11E` FOREIGN KEY (`category_id_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_E1D902C19D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB46B9EE8` FOREIGN KEY (`trick_id_id`) REFERENCES `tricks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
