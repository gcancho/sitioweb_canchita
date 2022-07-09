-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2022 a las 02:14:24
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `distrito` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `horario` varchar(255) NOT NULL,
  `tarifa_dia` varchar(255) NOT NULL,
  `tarifa_noche` varchar(255) NOT NULL,
  `medio_pago` varchar(255) NOT NULL,
  `imagen2` varchar(1000) NOT NULL,
  `imagen3` varchar(1000) NOT NULL,
  `imagen_qr` varchar(1000) NOT NULL,
  `imagen_tienda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `imagen`, `distrito`, `direccion`, `telefono`, `horario`, `tarifa_dia`, `tarifa_noche`, `medio_pago`, `imagen2`, `imagen3`, `imagen_qr`, `imagen_tienda`) VALUES
(20, 'La 30', '1657324480_cancha-28.png', 'Breña', 'Jr. Iquique 600', '952400108', 'L-V 9:00-18:00', '100', '150', 'Efectivo y Yape', '1657324367_imagen-24.png', '1657324367_imagen-25.png', '1657258744_qr_gio.jpg', '1657258881_tienda-futbol.png'),
(25, 'Fanatic Soccer', '1656990671_cancha-5.jpg', 'San Miguel', 'Av. La Marina 956', '983111234', 'L-V 9:00-20:00', '80', '130', 'Plin', '1657324380_cancha-11.jpg', '1657324380_cancha-13.jpg', '1657258752_qr_gio.jpg', ''),
(36, 'Centenario', '1656994904_cancha-9.jpg', 'San Borja', 'Av. San Borja Sur 540', '984524180', 'L-V 9:00-20:00', '120', '100', 'Yape', '1657321880_imagen-23.png', '1657325167_cancha-31.png', '1657258761_qr_gio.jpg', '1657259839_tienda-futbol.png'),
(37, 'Botas de oro', '1657319785_cancha-13.jpg', 'San Borja', 'Av. San Borja Sur 720', '955427033', 'L-V 9:00-22:00', '100', '130', 'Efectivo, Plin y Yape', '1657324395_cancha-10.jpg', '1657325182_cancha-29.png', '1657162494_qr_gio.jpeg', ''),
(72, 'La Calle', '1657323907_imagen-27.png', 'Los Olivos', 'Av. Naranjal 857', '945815850', 'L-V 9:00-18:00', '100', '150', 'Efectivo y Yape', '1657323932_imagen-22.png', '1657323019_imagen-23.png', '1657323019_qr_gio.jpg', '1657322997_tienda-futbol.png'),
(73, 'El Bernabeu', '1657319900_cancha-11.jpg', 'Cercado de Lima', 'Av. Alfonso Ugarte 1285', '975200318', 'L-V 9:00-18:00', '110', '150', 'Efectivo y Yape', '1657324004_imagen-24.png', '1657324004_imagen-25.png', 'imagenQR.jpg', '1657324004_tienda-futbol.png'),
(75, 'Peloteros FC', '1657325203_cancha-29.png', 'SJL', 'Av. Flores 865', '970254684', 'L-V 9:00-18:00', '100', '130', 'Yape', '1657324594_cancha-1.jpg', '1657324594_cancha-2.jpg', '1657324594_qr_gio.jpg', '1657324603_tienda-futbol.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `contrasenia`) VALUES
(1, 'admin', '123'),
(2, 'giovanni', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
