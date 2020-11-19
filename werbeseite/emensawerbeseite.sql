-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for emensawerbeseite
CREATE DATABASE IF NOT EXISTS `emensawerbeseite` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `emensawerbeseite`;

-- Dumping structure for table emensawerbeseite.allergen
CREATE TABLE IF NOT EXISTS `allergen` (
  `code` char(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Offizieller Abkürzungsbuchstabe für das Allergen.',
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name des Allergens, wie „Glutenhaltiges Getreide“.',
  `typ` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'allergen' COMMENT 'Gibt den Typ an. Standard: „allergen“',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emensawerbeseite.allergen: ~21 rows (approximately)
/*!40000 ALTER TABLE `allergen` DISABLE KEYS */;
INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
	('a', 'Getreideprodukte', 'Getreide (Gluten)'),
	('a1', 'Weizen', 'Allergen'),
	('a2', 'Roggen', 'Allergen'),
	('a3', 'Gerste', 'Allergen'),
	('a4', 'Dinkel', 'Allergen'),
	('a5', 'Hafer', 'Allergen'),
	('a6', 'Dinkel', 'Allergen'),
	('b', 'Fisch', 'Allergen'),
	('c', 'Krebstiere', 'Allergen'),
	('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
	('e', 'Sellerie', 'Allergen'),
	('f', 'Milch und Laktose', 'Allergen'),
	('f1', 'Butter', 'Allergen'),
	('f2', 'Käse', 'Allergen'),
	('f3', 'Margarine', 'Allergen'),
	('g', 'Sesam', 'Allergen'),
	('h', 'Nüsse', 'Allergen'),
	('h1', 'Mandeln', 'Allergen'),
	('h2', 'Haselnüsse', 'Allergen'),
	('h3', 'Walnüsse', 'Allergen'),
	('i', 'Erdnüsse', 'Allergen');
/*!40000 ALTER TABLE `allergen` ENABLE KEYS */;

-- Dumping structure for table emensawerbeseite.gericht
CREATE TABLE IF NOT EXISTS `gericht` (
  `id` int(8) NOT NULL DEFAULT 0 COMMENT 'Primärschluüssel',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name des Gerichts. Ein Name ist eindeutig.',
  `beschreibung` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Beschreibung des Gerichts.',
  `erfasst_am` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Zeitpunkt der ersten Erfassung des Gerichts',
  `vegetarisch` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegetarisch ist. Standard: Nein.',
  `vegan` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegan ist. Standard: Nein.',
  `preis_intern` double(22,0) NOT NULL DEFAULT 0 COMMENT 'Preis für interne Personen (wie Studierende). Es gilt immer preis_intern > 0.',
  `preis_extern` double(22,0) NOT NULL DEFAULT 0 COMMENT 'Preis für externe Personen.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emensawerbeseite.gericht: ~19 rows (approximately)
/*!40000 ALTER TABLE `gericht` DISABLE KEYS */;
INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegetarisch`, `vegan`, `preis_intern`, `preis_extern`) VALUES
	(1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2, 4),
	(3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2, 4),
	(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2, 4),
	(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2, 4),
	(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 1, 0, 2, 4),
	(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2, 4),
	(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2, 4),
	(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3),
	(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 4, 5),
	(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 1, 0, 2, 3),
	(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 4, 5),
	(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 1, 0, 2, 4),
	(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 1, 0, 3, 5),
	(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
	(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 1, 0, 1, 1),
	(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1, 2),
	(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1),
	(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 1, 0, 1, 2),
	(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0, 1);
/*!40000 ALTER TABLE `gericht` ENABLE KEYS */;

-- Dumping structure for table emensawerbeseite.gericht_hat_allergen
CREATE TABLE IF NOT EXISTS `gericht_hat_allergen` (
  `code` char(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Referenz auf Allergen.',
  `gericht_id` int(8) NOT NULL COMMENT 'Referenz auf das Gericht.',
  KEY `FK_allergen_gericht` (`gericht_id`) USING BTREE,
  KEY `FK_code_allergen` (`code`) USING BTREE,
  CONSTRAINT `FK_allergen_gericht` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  CONSTRAINT `FK_code_allergen` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emensawerbeseite.gericht_hat_allergen: ~31 rows (approximately)
/*!40000 ALTER TABLE `gericht_hat_allergen` DISABLE KEYS */;
INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
	('h', 1),
	('a3', 1),
	('a4', 1),
	('f1', 3),
	('a6', 3),
	('i', 3),
	('a3', 4),
	('f1', 4),
	('a4', 4),
	('h3', 4),
	('d', 6),
	('h1', 7),
	('a2', 7),
	('h3', 7),
	('c', 7),
	('a3', 8),
	('h3', 10),
	('d', 10),
	('f', 10),
	('f2', 12),
	('h1', 12),
	('a5', 12),
	('c', 1),
	('a2', 9),
	('i', 14),
	('f1', 1),
	('a1', 15),
	('a4', 15),
	('i', 15),
	('f3', 15),
	('h3', 15),
	('h', 1),
	('a3', 1),
	('a4', 1),
	('f1', 3),
	('a6', 3),
	('i', 3),
	('a3', 4),
	('f1', 4),
	('a4', 4),
	('h3', 4),
	('d', 6),
	('h1', 7),
	('a2', 7),
	('h3', 7),
	('c', 7),
	('a3', 8),
	('h3', 10),
	('d', 10),
	('f', 10),
	('f2', 12),
	('h1', 12),
	('a5', 12),
	('c', 1),
	('a2', 9),
	('i', 14),
	('f1', 1),
	('a1', 15),
	('a4', 15),
	('i', 15),
	('f3', 15),
	('h3', 15);
/*!40000 ALTER TABLE `gericht_hat_allergen` ENABLE KEYS */;

-- Dumping structure for table emensawerbeseite.gericht_hat_kategorie
CREATE TABLE IF NOT EXISTS `gericht_hat_kategorie` (
  `gericht_id` int(8) NOT NULL COMMENT 'Referenz auf Gericht.',
  `kategorie_id` int(8) NOT NULL COMMENT 'Referenz auf Kategorie.',
  KEY `FK_kategorie_gericht` (`gericht_id`),
  KEY `FK_kategorie` (`kategorie_id`),
  CONSTRAINT `FK_kategorie` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`),
  CONSTRAINT `FK_kategorie_gericht` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emensawerbeseite.gericht_hat_kategorie: ~0 rows (approximately)
/*!40000 ALTER TABLE `gericht_hat_kategorie` DISABLE KEYS */;
INSERT INTO `gericht_hat_kategorie` (`gericht_id`, `kategorie_id`) VALUES
	(1, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(9, 3),
	(16, 4),
	(17, 4),
	(18, 4),
	(16, 5),
	(17, 5),
	(18, 5);
/*!40000 ALTER TABLE `gericht_hat_kategorie` ENABLE KEYS */;

-- Dumping structure for table emensawerbeseite.kategorie
CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` int(8) NOT NULL DEFAULT 0 COMMENT 'Primärschlüssel',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name der Kategorie, z.B. „Hauptgericht“, „Vorspeise“, „Salat“, „Sauce“ oder „Käsegericht“.',
  `eltern_id` int(8) DEFAULT 0 COMMENT 'Referenz auf eine Eltern-Kategorie. Zum Beispiel enthält die Kategorie „Hauptgericht“ alle Gerichte, die als Hauptgang vorgesehen sind.',
  `bildname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Name der Bilddatei, die eine Darstellung der Kategorie enthält.',
  PRIMARY KEY (`id`),
  KEY `FK_parent` (`eltern_id`),
  CONSTRAINT `FK_parent` FOREIGN KEY (`eltern_id`) REFERENCES `kategorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table emensawerbeseite.kategorie: ~0 rows (approximately)
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` (`id`, `name`, `eltern_id`, `bildname`) VALUES
	(1, 'Aktionen', NULL, 'kat_aktionen.png'),
	(2, 'Menus', NULL, 'kat_menu.gif'),
	(3, 'Hauptspeisen', 2, 'kat_menu_haupt.bmp'),
	(4, 'Vorspeisen', 2, 'kat_menu_vor.svg'),
	(5, 'Desserts', 2, 'kat_menu_dessert.pic'),
	(6, 'Mensastars', 1, 'kat_stars.tif'),
	(7, 'Erstiewoche', 1, 'kat_erties.jpg');
/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
