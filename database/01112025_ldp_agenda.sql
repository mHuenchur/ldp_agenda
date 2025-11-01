-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 12:28 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `recordatorio_contacto`
--

CREATE TABLE `recordatorio_contacto` (
  `recordatorio_id` int(10) NOT NULL,
  `contacto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telefono`
--

CREATE TABLE `telefono` (
  `id` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `etiqueta_id` int(10) NOT NULL,
  `contacto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 'password_reset', '3f0beafa390d7e9a361045c4988c6a64d90a51f1988cfd78d28d1c31c18f7c1e', '2025-10-28 22:15:48', 0);

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
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `nombre_usuario`, `email`, `clave`) VALUES
(1, 'Jose', 'Maxwell', 'jMaxwell', 'mauricio_huenchur@hotmail.com', 'dddddd'),
(3, 'Mauricio', 'Huenchur', 'mHuenchur', 'mauricio_huenchur@hotmail.com', '$2y$10$LPTjhc.uhZgiatpEPuqqlePPc0ZBb7BV9dB712a2NWt.f3NcuTRbS');

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
  ADD KEY `telefono_contacto_fk` (`contacto_id`),
  ADD KEY `telefono_etiqueta_fk` (`etiqueta_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recordatorio`
--
ALTER TABLE `recordatorio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telefono`
--
ALTER TABLE `telefono`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_categoria_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacto_tipo_fk` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacto_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD CONSTRAINT `etiqueta_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD CONSTRAINT `recordatorio_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recordatorio_contacto`
--
ALTER TABLE `recordatorio_contacto`
  ADD CONSTRAINT `contacto_pk_fk` FOREIGN KEY (`contacto_id`) REFERENCES `contacto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recordatorio_pk_fk` FOREIGN KEY (`recordatorio_id`) REFERENCES `recordatorio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_contacto_fk` FOREIGN KEY (`contacto_id`) REFERENCES `contacto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `telefono_etiqueta_fk` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiqueta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token_reset`
--
ALTER TABLE `token_reset`
  ADD CONSTRAINT `token_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
