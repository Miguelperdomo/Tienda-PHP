-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2022 a las 22:08:30
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `supertienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(12) NOT NULL,
  `nombre_cliente` varchar(40) DEFAULT NULL,
  `apellido_cliente` varchar(50) DEFAULT NULL,
  `telefono` bigint(12) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `telefono`, `direccion`) VALUES
(11, 'Pepito', 'Perez', 3102356784, 'Calle 20'),
(22, 'Yeison', 'Capera', 3115678329, 'Manzana C'),
(112, 'Miguel', 'picalo', 319229, 'calle 90'),
(882, 'Miguel', 'Gonzales', 677352, 'Calle 90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `detalle` int(12) NOT NULL,
  `id_factura` int(12) DEFAULT NULL,
  `id_usuario` int(12) NOT NULL,
  `codigo_producto` int(12) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_comple` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`detalle`, `id_factura`, `id_usuario`, `codigo_producto`, `cantidad`, `precio_comple`) VALUES
(391, 84, 33, 1, 10, 15000),
(392, 85, 33, 2, 3, 55500),
(393, 85, 55, 1, 10, 15000),
(394, 85, 33, 2, 3, 55500),
(395, 86, 33, 2, 3, 55500),
(396, 86, 33, 2, 3, 55500),
(398, 87, 33, 1, 12, 18000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(3) NOT NULL,
  `nombre_estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'pagado'),
(2, 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(12) NOT NULL,
  `id_cliente` int(12) DEFAULT NULL,
  `codigo_producto` int(12) DEFAULT NULL,
  `fecha` date DEFAULT current_timestamp(),
  `nombre_cliente` varchar(40) DEFAULT NULL,
  `apellido_cliente` varchar(50) DEFAULT 'Ninguno',
  `telefono` bigint(12) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `id_estado` int(3) NOT NULL,
  `id_usuario` int(12) DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_cliente`, `codigo_producto`, `fecha`, `nombre_cliente`, `apellido_cliente`, `telefono`, `direccion`, `id_estado`, `id_usuario`, `total`) VALUES
(84, 22, 1, '2022-07-25', 'Yeison', 'Capera ', 3115678329, 'Manzana C ', 2, 33, 15000),
(85, 11, 1, '2022-07-25', 'Pepito', 'Perez ', 3102356784, 'Calle 20 ', 1, 55, 15000),
(86, 22, 2, '2022-07-25', 'Yeison', 'Capera ', 3115678329, 'Manzana C ', 1, 33, 111000),
(87, 11, 1, '2022-07-25', 'Pepito', 'Perez ', 3102356784, 'Calle 20 ', 1, 33, 18000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre_producto` varchar(20) NOT NULL,
  `precio` int(12) NOT NULL,
  `existencia` int(11) NOT NULL,
  `fecha` date DEFAULT current_timestamp(),
  `nit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `nombre_producto`, `precio`, `existencia`, `fecha`, `nit`) VALUES
(1, 1, 'Arroz', 1500, 242, '2022-06-20', 2424),
(2, 2, 'Carne', 18500, 17, '2022-06-30', 2323),
(3, 3, 'Pollo', 12000, 80, '2022-06-30', 2333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `nit` int(20) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `telefono` bigint(12) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`nit`, `nombre`, `telefono`, `direccion`) VALUES
(2323, 'Juan Quintero', 3102222222, 'Manzana C'),
(2424, 'Pepito Perez', 321454545, 'casa 12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(12) NOT NULL,
  `nombre_rol` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Auditor'),
(4, 'Bodega'),
(5, 'Contador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `detalle` int(12) NOT NULL,
  `id_factura` int(12) DEFAULT NULL,
  `id_usuario` int(12) NOT NULL,
  `codigo_producto` int(12) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_comple` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(12) NOT NULL,
  `nombre_usua` varchar(40) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `id_rol` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usua`, `correo`, `usuario`, `clave`, `id_rol`) VALUES
(11, 'Miguel Perdomo', 'mig@per', 'mig', '$2y$12$7kfSQeXfUOslAUcnkOHYs.OUZEWHi6Il5gyklmEXg5dxOIzT2qwoW', 2),
(22, 'Juan Figueroa', 'jua@jua', 'juan', '$2y$12$cJxlNVtTVK/poDsqCm9TlOxaR2W82UUmF7umEe/rbCUEwgSQnzGWi', 1),
(33, 'Yeison Capera', 'cape@yei', 'yeiso', '$2y$12$VTHpb.qo3tpwiO7wxLC6CePG4vyDRz0adlD2ZqF3wedNYqK9ScoPy', 2),
(44, 'Wendy', 'wendy@dj', 'nati', '$2y$12$I50ewwPvX7kfOax5dkktfOXT147Uh9cJXHO33dZDK0V038u1T.BC2', 1),
(55, 'Miguel Crack', 'migue@hs', 'migue', '$2y$12$xN85Fd8hOA1nAnuk7RtUIO6WzqTxWTY51pGA/vTiPnRM6H3Pw8a56', 2),
(232, 'Hawer', 'hawer@hsns', 'hawe', '12345', 3),
(332, 'Abraham Giraldo', 'ssha@s', 'sss', '$2y$12$FiNpwkLWc0pAJsTI7eH6Te46yc.OSipX3Znw6wCbAsFUx4EAjhxaG', 3),
(334, 'Nicolas Gomez', 'as@ghhs', 'sjsj', '$2y$12$cbWBanVOF9xtGVIFLf5AL.II/y1.pB7typbz7WIBo5Y.lTGkd1YbG', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`detalle`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_p` (`nit`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD PRIMARY KEY (`detalle`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `detalle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=399;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `temporal`
--
ALTER TABLE `temporal`
  MODIFY `detalle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=524;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
