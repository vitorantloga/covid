-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.13 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for covid
CREATE DATABASE IF NOT EXISTS `covid` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `covid`;

-- Dumping structure for table covid.entrada
CREATE TABLE IF NOT EXISTS `entrada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `produto` int(11) NOT NULL DEFAULT '0',
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table covid.entrada: ~5 rows (approximately)
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` (`id`, `data`, `produto`, `quantidade`) VALUES
	(1, '2021-04-15 21:40:35', 4, 2),
	(2, '2021-04-15 21:40:39', 5, 3),
	(3, '2021-04-15 21:41:15', 13, 2),
	(4, '2021-04-15 21:41:20', 22, 3),
	(5, '2021-04-15 21:41:30', 18, 2);
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;

-- Dumping structure for table covid.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(50) NOT NULL,
  `alert_number` INT(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- Dumping data for table covid.produtos: ~52 rows (approximately)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `produto`) VALUES
	(1, 'Avental'),
	(2, 'Mascara N95'),
	(3, 'Mascara Cirurgica'),
	(4, 'Luva P'),
	(5, 'Luva M'),
	(6, 'Luva G'),
	(7, 'Macacão M'),
	(8, 'Macacão G'),
	(9, 'Macacão XG'),
	(10, 'Touca'),
	(11, 'Propé'),
	(12, 'Protetor Facial'),
	(13, 'Etanol 70%'),
	(14, 'Propanol'),
	(15, 'AMPOLA Soro Fisiológico'),
	(16, 'FRASCO Soro Fisiológico'),
	(17, 'Detergente'),
	(18, 'Agua Sanitaria'),
	(19, 'CELLCO - Kit Extração RNA'),
	(20, 'Kit Antigeno Teste Rapido'),
	(21, 'Microtubo 1.5mL'),
	(22, 'Microtubo 2.0mL'),
	(23, 'Tubo 15mL Falcon'),
	(24, 'EXRAÇÃO Adesivo de Placas'),
	(25, 'Rack/Suporte Tubos Falcon'),
	(26, 'Rack/Suporte Microtubos'),
	(27, 'Caixa Arm. Amostras'),
	(28, 'Garrafa Plastica'),
	(29, 'Pipeta Pasteur'),
	(30, 'Coletor Perfurocortantes 3L'),
	(31, 'Filme PVC'),
	(32, 'Papel Aluminio'),
	(33, 'Fita Crepe'),
	(34, 'Saco Autoclave'),
	(35, 'Gaze'),
	(36, 'Swab Haste'),
	(37, 'Ponteira 1000uL COM CAIXA'),
	(38, 'Ponteira 200uL COM CAIXA'),
	(39, 'Ponteira 10uL COM CAIXA'),
	(40, 'Ponteira 1000uL SACO'),
	(41, 'Ponteira 200uL SACO'),
	(42, 'Ponteira 10uL SACO'),
	(43, 'Saco Lixo Biológico 30L'),
	(44, 'Saco Lixo Biológico 50L'),
	(45, 'Saco Lixo Biológico 100L'),
	(46, 'Papel Absorvente'),
	(47, 'Caneta Comum'),
	(48, 'Caneta de Laboratorio'),
	(49, 'Esponja'),
	(50, 'Sabonete Liquido'),
	(51, 'Placa Óptica 384p 0.1mL'),
	(52, 'Placa Óptica 96p 0.1mL');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Dumping structure for table covid.requisicao
CREATE TABLE IF NOT EXISTS `requisicao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `produto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `requerente` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `status_op` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table covid.requisicao: ~0 rows (approximately)
/*!40000 ALTER TABLE `requisicao` DISABLE KEYS */;
INSERT INTO `requisicao` (`id`, `data`, `produto`, `quantidade`, `requerente`, `status_op`) VALUES
	(1, '2021-04-15 10:12:30', 'Avental', '1', 'extracao', 'atendida');
/*!40000 ALTER TABLE `requisicao` ENABLE KEYS */;

-- Dumping structure for table covid.retirada
CREATE TABLE IF NOT EXISTS `retirada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `produto` int(11) NOT NULL DEFAULT '0',
  `quantidade` int(11) NOT NULL,
  `colaborador` varchar(50) NOT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `observacao` text,
  `lote` varchar(50) DEFAULT NULL,
  `valida_op` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table covid.retirada: ~6 rows (approximately)
/*!40000 ALTER TABLE `retirada` DISABLE KEYS */;
INSERT INTO `retirada` (`id`, `data`, `produto`, `quantidade`, `colaborador`, `setor`, `observacao`, `lote`, `valida_op`) VALUES
	(1, '2021-04-09 12:19:18', 1, 1, 'x', '', '', '', 'invalida'),
	(2, '2021-04-15 10:08:45', 28, 1, 'teste', 'teste', '', '', 'invalida'),
	(3, '2021-04-15 10:10:10', 1, 2, 'teste', '', '', '', 'invalida'),
	(4, '2021-04-15 21:43:21', 4, 4, 'teste', '', '', '', 'valida'),
	(5, '2021-04-15 22:28:01', 4, 1, 'sdasdasdasd', '', '', '', 'valida'),
	(6, '2021-04-15 22:28:10', 3, 1, 'sdasdasdasd', '', '', '', 'valida');
/*!40000 ALTER TABLE `retirada` ENABLE KEYS */;

-- Dumping structure for table covid.setores
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Setor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table covid.setores: ~0 rows (approximately)
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
