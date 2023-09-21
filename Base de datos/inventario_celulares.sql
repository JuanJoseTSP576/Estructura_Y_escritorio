-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2023 a las 06:32:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estructuradatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_celulares`
--

CREATE TABLE `inventario_celulares` (
  `id_celular` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `almacenamiento` varchar(20) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponibilidad` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_celulares`
--

INSERT INTO `inventario_celulares` (`id_celular`, `marca`, `nombre`, `almacenamiento`, `ram`, `precio`, `disponibilidad`, `estado`) VALUES
(1, 'Honor', 'Honor 12', '8', '2', 2222222.00, 3, 'activado'),
(2, 'Samsung', 'Samsung J7', '32', '8', 899999.00, 8, 'activado'),
(3, 'Apple', 'iPhone 12', '32', '4', 1999999.00, 4, 'activado'),
(4, 'Xiaomi', 'Redmi note 13', '8', '1', 1499999.00, 12, 'activado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario_celulares`
--
ALTER TABLE `inventario_celulares`
  ADD PRIMARY KEY (`id_celular`),
  ADD KEY `idx_nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario_celulares`
--
ALTER TABLE `inventario_celulares`
  MODIFY `id_celular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
