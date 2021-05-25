-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 03 mars 2021 à 07:32
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";

--
-- Base de données : `Dendo_jitensha`
--

-- --------------------------------------------------------

--
-- Structure de la table `Addresses`
--

CREATE TABLE `Addresses` (
  `id_user` int(11) DEFAULT NULL,
  `id_address` int(11) NOT NULL,
  `number` varchar(10) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Addresses`
--

INSERT INTO `Addresses` (`id_user`, `id_address`, `number`, `street`, `city`, `postal_code`) VALUES
(1, 1, '8', 'rue de la page blanche', 'Strasbourg', '67100'),
(2, 2, '3', 'rue Pont-Nouveau', 'Strasbourg', '67100'),
(3, 3, '13', 'rue Bastille', 'Paris', '75000'),
(6, 4, '9', 'rue des Moulins', 'Metz', '57100');

-- --------------------------------------------------------

--
-- Structure de la table `Baskets`
--

CREATE TABLE `Baskets` (
  `idBaskets` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `fk_idUsers` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_type_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

CREATE TABLE `Comments` (
  `id_comment` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Comments`
--

INSERT INTO `Comments` (`id_comment`, `id_product`, `username`, `comment`, `date`) VALUES
(1, 1, 'John Doe', 'Quel vélo incroyable ! Je recommande !', '2021-02-19 09:41:14'),
(2, 1, 'Luis Morten', 'Excellent vélo, agréable à utiliser et très léger. Un petit bémol par rapport au prix que je trouve un peu élevé mais la qualité a un prix je suppose ;-).', '2021-02-19 10:43:00'),
(3, 8, 'Luis Morten', 'Gants très confortables !', '2021-03-01 13:23:37'),
(4, 3, 'John Doe', 'Test !', '2021-03-02 18:36:53');

-- --------------------------------------------------------

--
-- Structure de la table `Favorites`
--

CREATE TABLE `Favorites` (
  `fk_id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_favorite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Orders`
--

CREATE TABLE `Orders` (
  `id_user` int(11) DEFAULT NULL,
  `id_order` int(11) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `date_created_order` datetime NOT NULL,
  `date_modified_order` datetime DEFAULT NULL,
  `amount_order` decimal(8,2) DEFAULT NULL,
  `numberadress_order` varchar(5) DEFAULT NULL,
  `streetadress_order` varchar(50) DEFAULT NULL,
  `cityadress_order` varchar(30) DEFAULT NULL,
  `postalcode_order` varchar(10) DEFAULT NULL,
  `firstname_bill` varchar(50) DEFAULT NULL,
  `lastname_bill` varchar(50) DEFAULT NULL,
  `adress_bill` varchar(100) DEFAULT NULL,
  `amount_bill` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Orders`
--

INSERT INTO `Orders` (`id_user`, `id_order`, `order_status`, `date_created_order`, `date_modified_order`, `amount_order`, `numberadress_order`, `streetadress_order`, `cityadress_order`, `postalcode_order`, `firstname_bill`, `lastname_bill`, `adress_bill`, `amount_bill`) VALUES
(1, 1, 'Validated', '2021-03-01 12:01:53', '2021-03-01 12:01:53', '2639.98', '8', 'rue de la page blanche', 'Strasbourg', '67100', 'John', 'Doe', '8 rue de la page blanche Strasbourg 67100', '2639.98'),
(1, 2, 'Validated', '2021-03-02 19:38:52', '2021-03-02 19:38:52', '1679.99', '8', 'rue de la page blanche', 'Strasbourg', '67100', 'John', 'Doe', '8 rue de la page blanche Strasbourg 67100', '1679.99');

-- --------------------------------------------------------

--
-- Structure de la table `Orders_lines`
--

CREATE TABLE `Orders_lines` (
  `id_user` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_order_line` int(11) NOT NULL,
  `date_created_order_line` datetime DEFAULT NULL,
  `date_modified_order_line` datetime DEFAULT NULL,
  `id_type_product` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `unitPrice` decimal(8,2) NOT NULL,
  `totalPrice` decimal(8,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Orders_lines`
--

INSERT INTO `Orders_lines` (`id_user`, `id_order`, `id_order_line`, `date_created_order_line`, `date_modified_order_line`, `id_type_product`, `id_product`, `product_name`, `unitPrice`, `totalPrice`, `quantity`) VALUES
(1, 1, 1, '2021-03-01 12:01:53', '2021-03-01 12:01:53', 1, 1, 'Rocket', '1679.99', '1679.99', 1),
(1, 1, 2, '2021-03-01 12:01:53', '2021-03-01 12:01:53', 1, 2, 'Relaxed', '959.99', '959.99', 1),
(1, 2, 3, '2021-03-02 19:38:52', '2021-03-02 19:38:52', 1, 1, 'Rocket', '1679.99', '1679.99', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Payments`
--

CREATE TABLE `Payments` (
  `id_user` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_payment` int(11) NOT NULL,
  `date_payment` datetime DEFAULT NULL,
  `date_created_payment` datetime NOT NULL,
  `amount_payment` int(11) NOT NULL,
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Products`
--

CREATE TABLE `Products` (
  `id_type_product` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `name_product` varchar(50) NOT NULL,
  `description_product` varchar(255) DEFAULT NULL,
  `autonomy` varchar(20) DEFAULT NULL,
  `motor` varchar(20) DEFAULT NULL,
  `battery` varchar(20) DEFAULT NULL,
  `price_product` decimal(8,2) NOT NULL,
  `picture_product` varchar(255) DEFAULT NULL,
  `date_created_product` datetime DEFAULT NULL,
  `date_modified_product` datetime DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Products`
--

INSERT INTO `Products` (`id_type_product`, `id_product`, `name_product`, `description_product`, `autonomy`, `motor`, `battery`, `price_product`, `picture_product`, `date_created_product`, `date_modified_product`, `brand`, `stock`) VALUES
(1, 1, 'Rocket', 'Sûrement le vélo le plus rapide de la galaxie.', '3h20min', 'Velox_Motor', 'batteryOnFire-3cz', '1399.99', 'Rocket.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'Megatron', 23),
(1, 2, 'Relaxed', 'Un vélo sans prise de tête pour ceux qui ne sont jamais pressé.', '6h00min', 'Velox_Motor', 'batteryCalm-c3po', '799.99', 'Relaxed.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'Jarjar', 46),
(1, 3, 'Splash', 'Votre compagnons idéal lors de vos déplacements ou pendant vos vacances.', '4h12min', 'Velox_Motor', 'batteryTrql-7fold', '1099.99', 'Splash.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'Hiker', 31),
(2, 4, 'batteryOnFire-3cz', 'Batterie pour vélo électrique de facture allemande. Cette batterie est compatible avec le modèle Rocket.', '3h20min', NULL, NULL, '299.99', 'batteryOnFire-3cz.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'A-Scape', 10),
(2, 5, 'batteryCalm-c3po', 'Batterie pour vélo électrique de facture allemande. Cette batterie est compatible avec le modèle Relaxed.', '6h00min', NULL, NULL, '159.99', 'batteryCalm-c3po.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'A-Scape', 10),
(2, 6, 'batteryTrql-7fold', 'Batterie pour vélo électrique de facture allemande. Cette batterie est compatible avec le modèle Splash.', '4h12min', NULL, NULL, '199.99', 'batteryTrql-7fold.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'A-Scape', 10),
(3, 7, 'Throne', 'Une selle qui vous garantie des conditions de confort exceptionnelles lors de l\'utilisation de votre vélo électrique.', NULL, NULL, NULL, '69.99', 'Throne.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'Sofa_Co', 1),
(4, 8, 'Glovost', 'Ces gants vous seront indispensables en hiver. ', NULL, NULL, NULL, '29.99', 'Glovost.png', '2020-12-30 10:54:17', '2020-12-30 10:54:17', 'Muffle_Star', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Type_of_product`
--

CREATE TABLE `Type_of_product` (
  `id_type_product` int(11) NOT NULL,
  `type_product` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Type_of_product`
--

INSERT INTO `Type_of_product` (`id_type_product`, `type_product`) VALUES
(1, 'Bike'),
(2, 'Battery'),
(3, 'Saddle'),
(4, 'Clothing');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id_user` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail_address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created_user` datetime DEFAULT NULL,
  `date_modified_user` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id_user`, `lastname`, `firstname`, `mail_address`, `password`, `date_created_user`, `date_modified_user`) VALUES
(1, 'Doe', 'John', 'john.doe@gmail.com', '$2y$10$FMGd58Hn5ecayONIgVZZzuyNFxkOwGo7H9M2AHXXkhSyx1/VvY6t6', '2021-02-19 10:38:17', '2021-02-19 10:38:17'),
(2, 'Morten', 'Luis', 'luis@gmail.com', '$2y$10$xO3NENbzMvYZSeKpMRhaauWAOnCz.zvd1Fxgfwa2uxiyYrvmLsh6.', '2021-02-19 11:32:10', '2021-03-01 14:45:01'),
(3, 'Rodrigues', 'Fernando', 'fernando.rodrigues@gmail.com', '$2y$10$FBUNn4KvkMqBt7hVXbs4AOtgScbaIAyaXqrTV8unaRFLVu4hJbu0a', '2021-02-24 13:38:35', '2021-02-24 13:38:35'),
(6, 'Test', 'Mister', 'mister.test@gmail.com', '$2y$10$3JtYTllQQQ1zaomY2FG1iOzt7KVwlznCoqPkIM9OKnH4e0WfhhSRa', '2021-03-01 12:13:55', '2021-03-01 12:47:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Addresses`
--
ALTER TABLE `Addresses`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `Baskets`
--
ALTER TABLE `Baskets`
  ADD PRIMARY KEY (`idBaskets`),
  ADD KEY `fk_idUsers` (`fk_idUsers`);

--
-- Index pour la table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `Favorites`
--
ALTER TABLE `Favorites`
  ADD PRIMARY KEY (`id_favorite`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `fk_id_user` (`fk_id_user`);

--
-- Index pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `Orders_lines`
--
ALTER TABLE `Orders_lines`
  ADD PRIMARY KEY (`id_order_line`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_type_product` (`id_type_product`);

--
-- Index pour la table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_order` (`id_order`);

--
-- Index pour la table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_type_product` (`id_type_product`);

--
-- Index pour la table `Type_of_product`
--
ALTER TABLE `Type_of_product`
  ADD PRIMARY KEY (`id_type_product`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail_address` (`mail_address`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Addresses`
--
ALTER TABLE `Addresses`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Baskets`
--
ALTER TABLE `Baskets`
  MODIFY `idBaskets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Favorites`
--
ALTER TABLE `Favorites`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Orders_lines`
--
ALTER TABLE `Orders_lines`
  MODIFY `id_order_line` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Products`
--
ALTER TABLE `Products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Type_of_product`
--
ALTER TABLE `Type_of_product`
  MODIFY `id_type_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Addresses`
--
ALTER TABLE `Addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`);

--
-- Contraintes pour la table `Baskets`
--
ALTER TABLE `Baskets`
  ADD CONSTRAINT `baskets_ibfk_1` FOREIGN KEY (`fk_idUsers`) REFERENCES `Users` (`id_user`);

--
-- Contraintes pour la table `Favorites`
--
ALTER TABLE `Favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `Products` (`id_product`),
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`fk_id_user`) REFERENCES `Users` (`id_user`);

--
-- Contraintes pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`);

--
-- Contraintes pour la table `Orders_lines`
--
ALTER TABLE `Orders_lines`
  ADD CONSTRAINT `orders_lines_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `Orders` (`id_order`),
  ADD CONSTRAINT `orders_lines_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`),
  ADD CONSTRAINT `orders_lines_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `Products` (`id_product`),
  ADD CONSTRAINT `orders_lines_ibfk_4` FOREIGN KEY (`id_type_product`) REFERENCES `Type_of_product` (`id_type_product`);

--
-- Contraintes pour la table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id_user`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `Orders` (`id_order`);

--
-- Contraintes pour la table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_type_product`) REFERENCES `Type_of_product` (`id_type_product`);
