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

-- Дамп данных таблицы testbase.cities: ~5 rows (приблизительно)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `name`) VALUES
	(1, 'Minsk'),
	(2, 'Gomel'),
	(3, 'Hrodna'),
	(4, 'Baranovichi'),
	(5, 'Brest'),
	(6, 'Zhlobin'),
	(7, 'Vitebsk'),
	(8, 'Krugloe');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Дамп данных таблицы testbase.persons: ~4 rows (приблизительно)
DELETE FROM `persons`;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` (`id`, `city_id`, `fullname`) VALUES
	(1, 5, 'Ivan Petrov'),
	(2, 3, 'Sebastian Haponenka'),
	(3, 3, 'Vasil Lutsevich'),
	(4, 2, 'Leo Klimovich'),
	(5, 7, 'Matea Kezhman'),
	(6, 8, 'Alex Marshall'),
	(7, 3, 'Bilbo Beggins');
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;

-- Дамп данных таблицы testbase.transactions: ~1 rows (приблизительно)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`transaction_id`, `from_person_id`, `to_person_id`, `amount`) VALUES
	(1, 4, 2, 10.0000),
	(2, 2, 3, 7.0000),
	(3, 5, 2, 12.5400),
	(4, 4, 7, 13.0000),
	(5, 3, 1, 8.2300),
	(6, 1, 3, 12.3000),
	(7, 2, 5, 3.1200);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
