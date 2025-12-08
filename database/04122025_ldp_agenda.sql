-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 01:17 PM
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
-- Database: `ldp_agenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `usuario_id`) VALUES
(1, 'Familia', 3),
(2, 'Amigos', 3),
(11, 'Fiesta', 3),
(12, 'Futbol', 3),
(13, 'Cumple', 3),
(14, 'Oficina', 3),
(15, 'Yoga', 3),
(17, 'Tenis', 3),
(23, 'Amigos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacto`
--

CREATE TABLE `contacto` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `razon_social` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sitio_web` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `observaciones` varchar(255) NOT NULL,
  `tipo_id` int(10) NOT NULL,
  `categoria_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `apellido`, `razon_social`, `direccion`, `email`, `sitio_web`, `fecha_nacimiento`, `observaciones`, `tipo_id`, `categoria_id`, `usuario_id`) VALUES
(1, 'Carmelo', 'Antoni', '', 'Sarmiento 444', 'cAntoni@gmail.com', 'www.cAntoni.com.ar', '2015-11-09', 'Nice guy!', 1, 17, 3),
(2, 'Julieta', 'Rivera', '', 'San Martin 333', 'jRivera@yahoo.com', 'web_julieta', '2001-11-29', 'Nice friend!', 1, 2, 3),
(3, 'Simon', 'Gutierrez', '', 'Saavedra 202', 'sGutierrez@gmail.com', 'web_simon', '2000-04-27', 'Smart guy!', 1, 12, 3),
(5, 'Jaime', 'Molina', '', 'Lavalle 444', 'jMolina@gmail.com', 'jMolina.com.ar', '2009-12-23', 'Buen compañero!', 1, 12, 3),
(6, 'Agustin', 'Arevalo', '', 'Mitre 234', 'aArevalo@yahoo.com', 'aArevalo.com.ar', '2008-05-13', 'Compañero de trabajo', 1, 14, 3),
(8, 'lopez', 'Amelio', '', 'Sarmiento 777', 'aLopez@gmail.com', 'aLopez.com', '1997-12-02', 'lalala', 1, 13, 3),
(9, '', '', 'Anonima', 'Mosconi 444', 'Anonima@outlook.com', 'LaAnonima.com.ar', '0000-00-00', 'Nice Place!', 2, 1, 3),
(10, 'Gonzalez', 'Vanessa', '', 'Sarmiento 123', 'vGonzalez@gmail.com', 'vGonzalez.com', '1999-11-28', 'Mi hermana', 1, 1, 3),
(19, 'Eduardo', 'Salazar', '', 'Mariano Moreno 444', 'eSalazar@gmail.com', 'eSalazar.com', '1998-12-21', 'Amigo de la infancia', 1, 23, 1),
(20, 'Marta', 'Necochea', '', 'San Martin 1024', 'mNecochea@gmail.com', 'mNecochea.com', '2000-12-03', 'Amiga de yoga', 1, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `etiqueta`
--

INSERT INTO `etiqueta` (`id`, `nombre`, `usuario_id`) VALUES
(1, 'movil', 3),
(2, 'fijo', 3);

-- --------------------------------------------------------

--
-- Table structure for table `recordatorio`
--

CREATE TABLE `recordatorio` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar` varchar(45) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `recordatorio`
--

INSERT INTO `recordatorio` (`id`, `nombre`, `fecha_hora`, `lugar`, `usuario_id`) VALUES
(1, 'Cumple Oscar', '2025-11-21 22:15:49', 'Mi casa', 3),
(2, 'Ir a la iglesia', '2025-12-25 08:00:00', 'Iglesia', 3),
(3, 'Clase de yoga', '2025-12-10 09:00:00', 'Yoga inc', 3),
(4, 'Sesion de estudio', '2025-10-15 16:38:00', 'Mi casa', 3),
(5, 'Evento cafe', '2025-12-10 09:30:00', 'Cafe Grace', 3),
(9, 'Partida de ajedrez', '2025-12-16 17:30:00', 'Mi casa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recordatorio_contacto`
--

CREATE TABLE `recordatorio_contacto` (
  `recordatorio_id` int(10) NOT NULL,
  `contacto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `recordatorio_contacto`
--

INSERT INTO `recordatorio_contacto` (`recordatorio_id`, `contacto_id`) VALUES
(1, 1),
(2, 3),
(2, 5),
(2, 8),
(3, 2),
(3, 8),
(4, 3),
(4, 10),
(5, 1),
(5, 8),
(9, 19);

-- --------------------------------------------------------

--
-- Table structure for table `telefono`
--

CREATE TABLE `telefono` (
  `id` int(10) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `etiqueta` varchar(45) NOT NULL,
  `contacto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `telefono`
--

INSERT INTO `telefono` (`id`, `numero`, `etiqueta`, `contacto_id`) VALUES
(13, '12345678', 'trabajo', 10),
(14, '66699922', 'movil', 10),
(15, '3454323', 'trabajo', 6),
(17, '324242424', 'Emergencia', 1),
(18, '4456754', 'Personal', 5),
(19, '7316274', 'movil', 8),
(26, '234252324242', 'Fijo', 19),
(27, '2425234234', 'Celular', 19),
(28, '235242424', 'Movistar', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'Persona'),
(2, 'Organizacion');

-- --------------------------------------------------------

--
-- Table structure for table `token_reset`
--

CREATE TABLE `token_reset` (
  `usuario_id` int(10) NOT NULL,
  `proposito` varchar(45) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `utilizado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `token_reset`
--

INSERT INTO `token_reset` (`usuario_id`, `proposito`, `token_hash`, `fecha_expiracion`, `utilizado`) VALUES
(1, 'wqeqeewqe', 'wqedqdqweds1241eqw', '2025-10-24 11:53:17', 1),
(1, 'wqeqeewqe', 'asdqwc3243sewdqsa', '2025-10-13 11:10:20', 1),
(1, 'password_reset', 'cb35a332fa713594187aca3b946608a9547220abac66cc9224e102652b65346d', '2025-10-27 23:55:57', 1),
(1, 'password_reset', '2424b047b541d02c81bdd23a8db624aedab1d69ec522ccccebd261a1c2651ebd', '2025-10-27 23:56:56', 1),
(1, 'password_reset', 'f9c3472bf73b8ddefc3af1f17ee443a7a40b212214d7e413cdce72c6464a7a47', '2025-10-28 00:18:20', 1),
(1, 'password_reset', '016a87ea7df3d24414123cb86bc9fb661ce03724dc17f751fe127025e7c36dc4', '2025-11-11 21:47:37', 1),
(3, 'password_reset', '4509faac0af0f5540facde33f38df781eb2cacf789fd74a8d8599596936fd05d', '2025-11-18 15:18:59', 1),
(3, 'password_reset', '9faf0de8f3e87edd512f420173c902b0bd8b799448b99f526e3521a389e9e6e1', '2025-11-18 21:34:13', 1),
(3, 'password_reset', '967829fb82d0af46f4d2ac5f9ce3bc929c8ace04ec7ac1c9512a087ffbf37218', '2025-11-19 16:57:42', 1),
(3, 'password_reset', 'aa8e3f363fa1f4477f8f5d01fcf70a6979b03b05f47aeb445460fd5e7bebfbe8', '2025-11-19 17:11:44', 1),
(3, 'password_reset', 'b51b82270d44755860f85b56c6a9f58e7b421053e3ba59b920a0b95d85ed7ed6', '2025-12-02 20:13:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `tiempo_notificacion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `nombre_usuario`, `email`, `clave`, `tiempo_notificacion`) VALUES
(1, 'Jorge', 'Rivera', 'jRivera', 'mauriciohuenchur_uaco@outlook.com.ar', '$2y$10$lG86/7XfYj7TLsYM1PLSzu2wPOTb2z6Hbr/5/2F.JGE.UN5w4FclS', 13),
(3, 'Mauricio', 'Huenchur', 'mHuenchur', 'mauricio_huenchur@hotmail.com', '$2y$10$IPMRQBJPa/.oWYOpps9rTu156f4JwOMfxncYXS2At9mdTrKsd4xJK', 30),
(4, 'Maximiliano', 'Martinez', 'mMartinez', 'mMartinez@gmail.com', '$2y$10$0FvFxTz9Q3gAvuCgoikdn.4cIPkZwSBdDfMw5URDf2LPezF1kiImu', 30),
(5, 'Jesica', 'Manzano', 'jManzano', 'jManzano@gmail.com', '$2y$10$pcH2u18jXvP5c0QU/mC7WOJYk4Stqep9NsaydMh6jDTkCBsQM5P6G', 30),
(6, 'Agustina', 'Vera', 'aVera', 'aVera@gmail.com', '$2y$10$XYgVGHrUIjm14tDFysQZs.xOut/cEEF4nt/msWXmY3j4NuMBoOrii', 30),
(7, 'Gaspar', 'Nuñez', 'gNuñez', 'gNuñez@gmail.com', '$2y$10$X3nZcwDrpbQ0LiAM.SCbhuAE/vW/Hsv0TD/l/p/C7c3iCdAwDnOrW', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_usuario_fk` (`usuario_id`);

--
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacto_categoria_fk` (`categoria_id`),
  ADD KEY `contacto_tipo_fk` (`tipo_id`),
  ADD KEY `contacto_usuario_fk` (`usuario_id`);

--
-- Indexes for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etiqueta_usuario_fk` (`usuario_id`);

--
-- Indexes for table `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recordatorio_usuario_fk` (`usuario_id`);

--
-- Indexes for table `recordatorio_contacto`
--
ALTER TABLE `recordatorio_contacto`
  ADD PRIMARY KEY (`recordatorio_id`,`contacto_id`),
  ADD KEY `contacto_pk_fk` (`contacto_id`);

--
-- Indexes for table `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefono_contacto_fk` (`contacto_id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_reset`
--
ALTER TABLE `token_reset`
  ADD KEY `token_usuario_fk` (`usuario_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recordatorio`
--
ALTER TABLE `recordatorio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `telefono`
--
ALTER TABLE `telefono`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_categoria_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_tipo_fk` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD CONSTRAINT `etiqueta_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD CONSTRAINT `recordatorio_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recordatorio_contacto`
--
ALTER TABLE `recordatorio_contacto`
  ADD CONSTRAINT `contacto_pk_fk` FOREIGN KEY (`contacto_id`) REFERENCES `contacto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `recordatorio_pk_fk` FOREIGN KEY (`recordatorio_id`) REFERENCES `recordatorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_contacto_fk` FOREIGN KEY (`contacto_id`) REFERENCES `contacto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `token_reset`
--
ALTER TABLE `token_reset`
  ADD CONSTRAINT `token_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
