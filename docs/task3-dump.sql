-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.23 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных task3
CREATE DATABASE IF NOT EXISTS `task3` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `task3`;

-- Дамп структуры для таблица task3.pack
CREATE TABLE IF NOT EXISTS `pack` (
  `id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task3.pack: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `pack` DISABLE KEYS */;
INSERT INTO `pack` (`id`, `count`, `weight`) VALUES
	(1, 10, 1),
	(2, 100, 12),
	(3, 1, 125),
	(4, 10, NULL),
	(5, NULL, 14);
/*!40000 ALTER TABLE `pack` ENABLE KEYS */;

-- Дамп структуры для таблица task3.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task3.product: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `brand`, `name`) VALUES
	(1, 'ABB', 'лампочка'),
	(3, 'SE', ''),
	(2, 'ABB', 'трансформатор'),
	(4, 'SE', 'светильник');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Дамп структуры для таблица task3.product_pack
CREATE TABLE IF NOT EXISTS `product_pack` (
  `id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task3.product_pack: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `product_pack` DISABLE KEYS */;
INSERT INTO `product_pack` (`id`, `product_id`, `pack_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 3, 3),
	(4, 4, 4),
	(5, 4, 5);
/*!40000 ALTER TABLE `product_pack` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
