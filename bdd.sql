-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2023 at 09:03 AM
-- Server version: 10.6.14-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xfyo9363_sellmeout`
--

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `command_details`
--

CREATE TABLE `command_details` (
  `id` int(11) NOT NULL,
  `command_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `img_path` varchar(255) NOT NULL DEFAULT '/Images/RandomImage/1.png',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `public` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `img_path`, `user_id`, `public`) VALUES
(1, 'MacBook Pro 16â€³', 'BoostÃ© par la puce M2 Pro ou M2 Max, le MacBook Pro offre une puissance et une efficacitÃ© Ã©nergÃ©tique inÃ©dites. Ses performances sont exceptionnelles, quâ€™il soit branchÃ© ou non. Et il offre dÃ©sormais une autonomie encore plus longue. Ajoutez Ã  cela un sublime Ã©cran Liquid Retina XDR et tous les ports dont vous avez besoin, et vous obtenez un ordinateur portable pro dÃ©finitivement sans Ã©gal.', 2999.00, '/Images/RandomImage/1.png', 1, 1),
(2, 'Surface pro 9', 'Surface Pro 9 vous offre la flexibilitÃ© dâ€™une tablette, les performances dâ€™un ordinateur portable, une connectivitÃ© 5G en option et une batterie longue durÃ©e. CrÃ©ez une configuration de bureau Windows 11 Ã  plusieurs Ã©crans sur son Ã©cran tactile PixelSenseâ„¢ de 13 pouces aux bordures ultrafines conÃ§u pour le stylet.', 1299.00, '/Images/RandomImage/2.png', 1, 1),
(3, 'Zenbook pro Duo 15', 'Avec le ZenBook Pro Duo 15 OLED, gardez votre style intact tout en accomplissant vos tÃ¢ches quotidiennes efficacement en toute sÃ©rÃ©nitÃ©. Puissant alliÃ© d\'une productivitÃ© et d\'une crÃ©ativitÃ© qui se veulent nomades, il intÃ¨gre une dalle tactile 4K OLED HDR. Il est par ailleurs dotÃ© du ScreenPadâ„¢ Plus, un second Ã©cran 4K dont l\'angle d\'inclinaison innovant confÃ¨re ergonomie et fluiditÃ© Ã  votre travail. Ã‰quipÃ© du nouveau processeur IntelÂ® Coreâ„¢ i9 Ã  huit cÅ“urs et d\'une carte graphique NVIDIAÂ® GeForce RTXâ„¢ 3060, le ZenBook Duo 15 OLED vous offre dÃ¨s maintenant tous les avantages des meilleures technologies du futur.', 3999.00, '/Images/RandomImage/3.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates_product`
--

CREATE TABLE `rates_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates_seller`
--

CREATE TABLE `rates_seller` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'seller'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `mail`, `password`, `pseudo`, `role`) VALUES
(1, 'admin@sellmeout.fr', '$2y$10$bgv7jVh3KENjxHN0R9DKBeOsF3fEHP7/Owhk8wsDyx1NtmDC9vaDO', 'SellMeOut', 'sell_me_out');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `command_details`
--
ALTER TABLE `command_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `command_fk` (`command_id`),
  ADD KEY `product_fk` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_product` (`user_id`);

--
-- Indexes for table `rates_product`
--
ALTER TABLE `rates_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_fk_rates_product` (`product_id`),
  ADD KEY `user_fk_rates_product` (`user_id`);

--
-- Indexes for table `rates_seller`
--
ALTER TABLE `rates_seller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_fk_rates_seller` (`seller_id`),
  ADD KEY `user_fk_rates_seller` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `command_details`
--
ALTER TABLE `command_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rates_product`
--
ALTER TABLE `rates_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates_seller`
--
ALTER TABLE `rates_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `command_details`
--
ALTER TABLE `command_details`
  ADD CONSTRAINT `command_fk` FOREIGN KEY (`command_id`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `user_fk_product` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `rates_product`
--
ALTER TABLE `rates_product`
  ADD CONSTRAINT `product_fk_rates_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `user_fk_rates_product` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `rates_seller`
--
ALTER TABLE `rates_seller`
  ADD CONSTRAINT `seller_fk_rates_seller` FOREIGN KEY (`seller_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_fk_rates_seller` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
