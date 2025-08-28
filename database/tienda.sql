-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `detalle` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id`, `nombre`, `telefono`, `correo`, `detalle`, `fecha`) VALUES
(1, 'Banano', '8825-5536', 'nicolascartinreyes@gmail.com', 'efrfgrg', '2025-08-03 01:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` varchar(30) NOT NULL,
  `direccion` text NOT NULL,
  `metodo_envio` varchar(30) NOT NULL,
  `precio_envio` int(11) NOT NULL,
  `total_productos` int(11) NOT NULL,
  `total_final` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes`
--

INSERT INTO `ordenes` (`id`, `nombre`, `correo`, `celular`, `direccion`, `metodo_envio`, `precio_envio`, `total_productos`, `total_final`, `fecha`) VALUES
(1, 'Banano', 'nicolascartinreyes@gmail.com', '60336576', 'l;kefjklejfklefjelkfjle', 'Dentro de la GAM (Envío gratui', 0, 119, 120, '2025-08-03 01:47:49'),
(2, 'Banano', 'nicolascartinreyes@gmail.com', '60336576', 'rwgwrgrg', 'Fuera de la GAM (Correos de Co', 4000, 629, 4630, '2025-08-03 01:52:38'),
(3, 'Coca-Cola Company', 'hablemosdemmacr@gmail.com', '60336576', 'Test 1', 'Fuera de la GAM (Correos de Co', 4000, 1849, 5850, '2025-08-03 01:57:02'),
(4, 'Niko Catrin', 'hablemosdemmacr@gmail.com', '60336576', 'ferghthth', 'Fuera de la GAM (Correos de Co', 4000, 1949, 5950, '2025-08-03 02:53:08'),
(5, 'Test 2', 'hablemosdemmacr@gmail.com', '60336576', 'test 2', 'Fuera de la GAM (Correos de Co', 4000, 1059, 5060, '2025-08-03 02:57:38'),
(6, 'Coca-Cola Company', 'nicolascartinreyes@gmail.com', '60336576', 'fhshgh', 'Fuera de la GAM (Correos de Co', 10, 649, 660, '2025-08-03 03:00:31'),
(7, 'test 3', 'nicolascartinreyes@gmail.com', '60336576', 'test4', 'Fuera de la GAM (Correos de Co', 10, 239, 250, '2025-08-03 03:07:46'),
(8, 'Niko', 'nicolascartinreyes@gmail.com', '60336576', 'test 2', 'Fuera de la GAM (Correos de Co', 10, 1499, 1510, '2025-08-03 03:42:23'),
(9, 'Coca-Cola Company', 'nicolascartinreyes@gmail.com', '60336576', 'test3', 'Fuera de la GAM (Correos de Co', 10, 2599, 2610, '2025-08-03 03:46:25'),
(10, 'Coca-Cola Company', 'nicolascartinreyes@gmail.com', '60336576', 'hdthjtj', 'Fuera de la GAM (Correos de Co', 10, 1639, 1650, '2025-08-03 04:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `orden_detalle`
--

CREATE TABLE `orden_detalle` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `producto_codigo` int(11) NOT NULL,
  `producto_nombre` varchar(100) NOT NULL,
  `producto_detalle` text NOT NULL,
  `producto_precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orden_detalle`
--

INSERT INTO `orden_detalle` (`id`, `orden_id`, `producto_codigo`, `producto_nombre`, `producto_detalle`, `producto_precio`, `cantidad`, `subtotal`) VALUES
(1, 1, 2, 'Mouse Logitech', 'Mouse inalámbrico ergonómico', 29, 1, 29),
(2, 1, 5, 'Auriculares Sony', 'Auriculares bluetooth con cancelación de ruido', 89, 1, 89),
(3, 2, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 1, 599),
(4, 2, 2, 'Mouse Logitech', 'Mouse inalámbrico ergonómico', 29, 1, 29),
(5, 3, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 1, 599),
(6, 3, 8, 'Smartphone Xiaomi', 'Smartphone 128GB, 6GB RAM', 249, 5, 1249),
(7, 4, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 2, 1199),
(8, 4, 8, 'Smartphone Xiaomi', 'Smartphone 128GB, 6GB RAM', 249, 3, 749),
(9, 5, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 1, 599),
(10, 5, 9, 'Cámara Canon', 'Cámara digital 20MP', 299, 1, 299),
(11, 5, 10, 'Disco Duro Seagate', 'Disco duro externo 2TB', 79, 2, 159),
(12, 6, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 1, 599),
(13, 6, 3, 'Teclado Redragon', 'Teclado mecánico retroiluminado', 49, 1, 49),
(14, 7, 6, 'Impresora Epson', 'Impresora multifunción WiFi', 149, 1, 149),
(15, 7, 5, 'Auriculares Sony', 'Auriculares bluetooth con cancelación de ruido', 89, 1, 89),
(16, 8, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 2, 1199),
(17, 8, 3, 'Teclado Redragon', 'Teclado mecánico retroiluminado', 49, 2, 99),
(18, 8, 7, 'Tablet Lenovo', 'Tablet Android 10 pulgadas', 199, 1, 199),
(19, 9, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 4, 2399),
(20, 9, 3, 'Teclado Redragon', 'Teclado mecánico retroiluminado', 49, 4, 199),
(21, 10, 1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 599, 1, 599),
(22, 10, 2, 'Mouse Logitech', 'Mouse inalámbrico ergonómico', 29, 4, 119),
(23, 10, 3, 'Teclado Redragon', 'Teclado mecánico retroiluminado', 49, 4, 199),
(24, 10, 4, 'Monitor Samsung', 'Monitor LED 24 pulgadas Full HD', 129, 4, 519),
(25, 10, 7, 'Tablet Lenovo', 'Tablet Android 10 pulgadas', 199, 1, 199);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `detalle`, `imagen`, `precio`) VALUES
(1, 'Laptop HP', 'Laptop de 15 pulgadas, 8GB RAM, 256GB SSD', 'https://img.pacifiko.com/PROD/resize/1/1000x1000/NDBmNTc0Zm_59.png', 599.99),
(2, 'Mouse Logitech', 'Mouse inalámbrico ergonómico', 'https://extremetechcr.com/tienda/23154-thickbox_default/logitech-lift-vertical-ergonomic-wireless-mouse-negro.jpg', 29.99),
(3, 'Teclado Redragon', 'Teclado mecánico retroiluminado', 'https://extremetechcr.com/tienda/26369-thickbox_default/redragon-draconic-wired24bt-k530rgb-pro.jpg', 49.99),
(4, 'Monitor Samsung', 'Monitor LED 24 pulgadas Full HD', 'https://shop.samsung.com/latin/cac/pub/media/catalog/product/cache/a69170b4a4f0666a52473c2224ba9220/l/f/lf24t350f_001_front_black_1.png', 129.99),
(5, 'Auriculares Sony', 'Auriculares bluetooth con cancelación de ruido', 'https://img.pacifiko.com/PROD/resize/1/1000x1000/WH1000XM4-B_2.jpg', 89.99),
(6, 'Impresora Epson', 'Impresora multifunción WiFi', 'https://mediaserver.goepson.com/ImConvServlet/imconv/4169c9471e1e9ade74acf9c5d49e5a99991eb237/1200Wx1200H?use=banner&hybrisId=B2C&assetDescr=L5590-690x460-1', 149.99),
(7, 'Tablet Lenovo', 'Tablet Android 10 pulgadas', 'https://gabastorecr.com/wp-content/uploads/2024/01/TABLET-LENOVO-TAB-M10-PLUS-3RD-TB128XU-10-1-4GB-128GB-4G-.jpg', 199.99),
(8, 'Smartphone Xiaomi', 'Smartphone 128GB, 6GB RAM', 'https://i5.walmartimages.com/seo/Xiaomi-Redmi-Note-11-Pro-Dual-SIM-128GB-ROM-6GB-RAM-GSM-Only-No-CDMA-Factory-Unlocked-5G-Smartphone-Graphite-Gray-International-Version_cd1930e1-7e2a-425c-a092-2aa721e61fb1.7656d4cabb1ce9b95fd4cede8554ad58.jpeg', 249.99),
(9, 'Cámara Canon', 'Cámara digital 20MP', 'https://m.media-amazon.com/images/I/61TsVWWK8mL._AC_SL1000_.jpg', 299.99),
(10, 'Disco Duro Seagate', 'Disco duro externo 2TB', 'https://tiendasarcadia.com/wp-content/uploads/2023/01/STKM2000400.jpg', 79.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orden_detalle`
--
ALTER TABLE `orden_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_id` (`orden_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orden_detalle`
--
ALTER TABLE `orden_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orden_detalle`
--
ALTER TABLE `orden_detalle`
  ADD CONSTRAINT `orden_detalle_ibfk_1` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
