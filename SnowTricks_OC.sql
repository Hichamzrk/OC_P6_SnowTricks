-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2020 at 08:45 AM
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
(7, 'Les dragons'),
(8, 'Les dragons'),
(10, 'Grabs'),
(12, 'Rotations'),
(14, 'Flips'),
(16, 'Rotations désaxées');

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

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `trick_id_id`, `user_id_id`, `content`, `created_at`) VALUES
(14, 98, 21, 'Super trick', '2020-09-21 07:40:59'),
(15, 99, 23, 'Super tricks', '2020-09-21 08:39:01');

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
('DoctrineMigrations\\Version20200920151424', '2020-09-20 15:14:31', 646);

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
(177, 98, 'f70b8d7d05d6f718f5df5a1f5646d4e1.jpeg'),
(178, 99, '332c67ea1e1a65ba9989a0b9904f38bf.jpeg'),
(179, 99, 'c3a90ec9f1551b8db5bae9efef55bb02.jpeg'),
(180, 99, '50b1d3a5eff580df49d3244ac04f3dae.jpeg');

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
(98, 21, 'Le tricks', 'Une astuce fondamentale réalisée en saisissant le bord de pincement entre les liaisons avec la main arrière. Cette astuce est appelée une ponction frontside sur un air droit, ou tout en effectuant une rotation frontside. Lors d\'une rotation d\' antenne arrière ou face arrière, cette ponction est désigné comme un Indy. L\'frontside air a été popularisé par skateur Tony Alva .', 'default-trick.jpg', '2020-09-21 07:39:38', '2020-09-21 07:39:38', 8),
(99, 23, 'Lien air', 'Lors de l\'exécution d\'un air frontal lors de la transition, le surfeur saisit heelside devant ou derrière le premier plan de liaison avec leur meilleur main. Pour que ce soit un air Lien, le conseil ne peut pas être modifié et doit être maintenu à plat. L\'origine du nom de l\'affaire est l\'orthographe inverse du prénom de skateboarder Neil Blender.', 'private-var-folders-ll-q2ltd0n94t955j6p1g2207v00000gn-T-phpjz499e-5f68668454e05.jpeg', '2020-09-21 08:37:53', '2020-09-21 08:38:28', 12);

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
(120, 98, 'https://www.youtube.com/embed/vf9Z05XY79A'),
(121, 99, 'https://www.youtube.com/embed/f9FjhCt_w2U');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tricks`
--
ALTER TABLE `tricks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

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
