
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table bdhermespeeddp.administradores: ~4 rows (approximately)
DELETE FROM `administradores`;
INSERT INTO `administradores` (`id_admin`, `nombre_admin`, `apellido_admin`, `correo_admin`, `alias_admin`, `clave_admin`, `fecha_registroA`) VALUES
	(1, 'Juan', 'Pérez', 'juanito', 'juanito@example.com', 'clave123', '2024-03-06'),
	(2, 'María', 'González', 'mary', 'mary@example.com', 'contraseña456', '2024-03-06'),
	(3, 'Pedro', 'Sánchez', 'pedrito', 'pedrito@example.com', 'clave789', '2024-03-06'),
	(4, 'Ana', 'López', 'anita', 'anita@example.com', 'password123', '2024-03-06');

-- Dumping data for table bdhermespeeddp.categorias: ~3 rows (approximately)
DELETE FROM `categorias`;
INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
	(1, 'Mujer', 'Zapatos de deporte para mujeres.'),
	(2, 'Hombre', 'Zapatos de deporte para hombres.'),
	(3, 'Niños', 'Zapatos de deporte para niños.');

-- Dumping data for table bdhermespeeddp.clientes: ~10 rows (approximately)
DELETE FROM `clientes`;
INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `dui_cliente`, `estado_cliente`, `direccion_cliente`, `telefono_cliente`, `correo_cliente`, `clave_cliente`, `edad_cliente`, `fecha_registroC`) VALUES
	(1, 'Juan', 'Pérez', '001234567-8', 1, 'Avenida Principal #123', '123456789', 'juan@example.com', 'clave123', 30, '2024-03-06'),
	(2, 'María', 'González', '112233445-5', 1, 'Calle Secundaria #456', '987654321', 'maria@example.com', 'contraseña456', 25, '2024-03-06'),
	(3, 'Pedro', 'Sánchez', '987654321-0', 0, 'Barrio Residencial #789', '741852963', 'pedro@example.com', 'clave789', 35, '2024-03-06'),
	(4, 'Ana', 'López', '555666777-2', 1, 'Avenida Central #101', '369258147', 'ana@example.com', 'password123', 28, '2024-03-06'),
	(5, 'Luis', 'Martínez', '333444555-3', 0, 'Calle Principal #789', '258147369', 'luis@example.com', 'contraseña456', 40, '2024-03-06'),
	(6, 'Elena', 'Rodríguez', '666777888-4', 1, 'Barrio Nuevo #321', '147258369', 'elena@example.com', 'clave987', 22, '2024-03-06'),
	(7, 'Carlos', 'Hernández', '777888999-6', 0, 'Avenida Sur #456', '369258147', 'carlos@example.com', 'password123', 33, '2024-03-06'),
	(8, 'Sofía', 'Díaz', '888999000-8', 1, 'Calle Norte #654', '852963741', 'sofia@example.com', 'contraseña789', 29, '2024-03-06'),
	(9, 'Javier', 'Lara', '999000111-1', 1, 'Avenida Este #987', '963852741', 'javier@example.com', 'clave456', 31, '2024-03-06'),
	(10, 'Lucía', 'Fernández', '000111222-3', 0, 'Barrio Industrial #321', '741852963', 'lucia@example.com', 'password789', 27, '2024-03-06'),
	(11, 'kenneth', 'ramos', '12345679-8', 1, 'San salvador', '7898-8987', 'kenneth@gmail.com', '$2y$10$CvJDLlF8Q/aj.6F1xy4dleFSyhv3X0GH.FKoYd.HnHylNoBfJSk2i', 18, '2014-07-16');

-- Dumping data for table bdhermespeeddp.colores: ~6 rows (approximately)
DELETE FROM `colores`;
INSERT INTO `colores` (`id_color`, `color_zapato`) VALUES
	(1, 'Negro'),
	(2, 'Blanco'),
	(3, 'Azul'),
	(4, 'Rojo'),
	(5, 'Gris'),
	(6, 'Verde');

-- Dumping data for table bdhermespeeddp.detalle_pedidos: ~4 rows (approximately)
DELETE FROM `detalle_pedidos`;
INSERT INTO `detalle_pedidos` (`id_detalle`, `cantidad_producto`, `precio_producto`, `id_pedido`, `id_zapato`) VALUES
	(1, 2, 100.00, 1, 1),
	(2, 1, 130.00, 2, 2),
	(3, 3, 120.00, 3, 3),
	(4, 2, 90.00, 4, 4),
	(5, 12, 15.00, 11, 2);

-- Dumping data for table bdhermespeeddp.detalle_zapatos: ~4 rows (approximately)
DELETE FROM `detalle_zapatos`;
INSERT INTO `detalle_zapatos` (`id_zapato`, `cantidad_talla`, `id_imagen`, `id_producto`, `id_color`, `id_talla`) VALUES
	(1, 10, 1, 1, 1, 1),
	(2, 15, 2, 2, 2, 2),
	(3, 20, 3, 3, 3, 3),
	(4, 12, 4, 4, 4, 4);

-- Dumping data for table bdhermespeeddp.generos: ~2 rows (approximately)
DELETE FROM `generos`;
INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
	(1, 'Hombre'),
	(2, 'Mujer');

-- Dumping data for table bdhermespeeddp.imagenes: ~5 rows (approximately)
DELETE FROM `imagenes`;
INSERT INTO `imagenes` (`id_imagen`, `nombre_archivo`) VALUES
	(1, 'imagen1.jpg'),
	(2, 'imagen2.jpg'),
	(3, 'imagen3.jpg'),
	(4, 'imagen4.jpg'),
	(5, 'imagen5.jpg');

-- Dumping data for table bdhermespeeddp.marcas: ~5 rows (approximately)
DELETE FROM `marcas`;
INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `imagen_marca`) VALUES
	(1, 'Nike', 'nike_logo.jpg'),
	(2, 'Adidas', 'adidas_logo.jpg'),
	(3, 'Puma', 'puma_logo.jpg'),
	(4, 'Reebok', 'reebok_logo.jpg'),
	(5, 'New Balance', 'newbalance_logo.jpg');

-- Dumping data for table bdhermespeeddp.pedidos: ~10 rows (approximately)
DELETE FROM `pedidos`;
INSERT INTO `pedidos` (`id_pedido`, `estado_pedido`, `fecha_pedido`, `direccion_pedido`, `id_cliente`) VALUES
	(1, 'en_reparto', '2024-03-06', 'Calle Principal #123', 1),
	(2, 'ausente', '2024-03-06', 'Avenida Central #456', 2),
	(3, 'atrasado', '2024-03-06', 'Barrio Residencial #789', 3),
	(4, 'reembolso', '2024-03-06', 'Avenida Norte #101', 4),
	(5, 'en_reparto', '2024-03-06', 'Calle Sur #789', 5),
	(6, 'ausente', '2024-03-06', 'Avenida Oeste #321', 6),
	(7, 'atrasado', '2024-03-06', 'Barrio Nuevo #654', 7),
	(8, 'reembolso', '2024-03-06', 'Calle Este #987', 8),
	(9, 'en_reparto', '2024-03-06', 'Avenida Industrial #321', 9),
	(10, 'ausente', '2024-03-06', 'Barrio Comercial #123', 10),
	(11, 'atrasado', '2006-02-22', 'San salvador', 11);

-- Dumping data for table bdhermespeeddp.productos: ~4 rows (approximately)
DELETE FROM `productos`;
INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `imagen_categoria`, `estado_producto`, `existencias_producto`, `fecha_registroP`, `id_categoria`, `id_admin`, `id_marca`, `id_genero`) VALUES
	(1, 'Zapatillas Nike Air Max', 'Zapatillas deportivas Nike Air Max con tecnología de amortiguación.', 150.00, 'nike_air_max.jpg', 1, 50, '2024-03-06', 1, 1, 1, 2),
	(2, 'Tenis Adidas Ultraboost', 'Tenis deportivos Adidas Ultraboost con tecnología de retorno de energía.', 130.00, 'adidas_ultraboost.jpg', 1, 70, '2024-03-06', 1, 2, 2, 2),
	(3, 'Zapatillas Puma RS-X', 'Zapatillas deportivas Puma RS-X con diseño retro y estilo futurista.', 120.00, 'puma_rs-x.jpg', 1, 40, '2024-03-06', 1, 3, 3, 2),
	(4, 'Tenis Reebok Classic', 'Tenis deportivos Reebok Classic con diseño clásico y comodidad.', 100.00, 'reebok_classic.jpg', 1, 60, '2024-03-06', 1, 4, 4, 2);

-- Dumping data for table bdhermespeeddp.tallas: ~4 rows (approximately)
DELETE FROM `tallas`;
INSERT INTO `tallas` (`id_talla`, `tamaño_talla`, `id_producto`) VALUES
	(1, 38, 1),
	(2, 39, 1),
	(3, 40, 1),
	(4, 41, 1);

-- Dumping data for table bdhermespeeddp.valoraciones: ~4 rows (approximately)
DELETE FROM `valoraciones`;
INSERT INTO `valoraciones` (`id_valoracion`, `calificacion_producto`, `comentario_producto`, `fecha_valoracion`, `estado_comentario`, `id_detalle`) VALUES
	(1, 4, '¡Excelente producto! Muy cómodos y de buena calidad.', '2024-03-06', 1, 1),
	(2, 5, 'Increíbles zapatillas, superó mis expectativas.', '2024-03-07', 1, 2),
	(3, 3, 'Buen producto, pero esperaba un poco más.', '2024-03-08', 1, 3),
	(4, 4, 'Muy satisfecho con mi compra, recomendado.', '2024-03-09', 1, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
=======
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table bdhermespeeddp.administradores: ~4 rows (approximately)
DELETE FROM `administradores`;
INSERT INTO `administradores` (`id_admin`, `nombre_admin`, `apellido_admin`, `correo_admin`, `alias_admin`, `clave_admin`, `fecha_registroA`) VALUES
	(1, 'Juan', 'Pérez', 'juanito', 'juanito@example.com', 'clave123', '2024-03-06'),
	(2, 'María', 'González', 'mary', 'mary@example.com', 'contraseña456', '2024-03-06'),
	(3, 'Pedro', 'Sánchez', 'pedrito', 'pedrito@example.com', 'clave789', '2024-03-06'),
	(4, 'Ana', 'López', 'anita', 'anita@example.com', 'password123', '2024-03-06');

-- Dumping data for table bdhermespeeddp.categorias: ~3 rows (approximately)
DELETE FROM `categorias`;
INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
	(1, 'Mujer', 'Zapatos de deporte para mujeres.'),
	(2, 'Hombre', 'Zapatos de deporte para hombres.'),
	(3, 'Niños', 'Zapatos de deporte para niños.');

-- Dumping data for table bdhermespeeddp.clientes: ~10 rows (approximately)
DELETE FROM `clientes`;
INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `dui_cliente`, `estado_cliente`, `direccion_cliente`, `telefono_cliente`, `correo_cliente`, `clave_cliente`, `edad_cliente`, `fecha_registroC`) VALUES
	(1, 'Juan', 'Pérez', '001234567-8', 1, 'Avenida Principal #123', '123456789', 'juan@example.com', 'clave123', 30, '2024-03-06'),
	(2, 'María', 'González', '112233445-5', 1, 'Calle Secundaria #456', '987654321', 'maria@example.com', 'contraseña456', 25, '2024-03-06'),
	(3, 'Pedro', 'Sánchez', '987654321-0', 0, 'Barrio Residencial #789', '741852963', 'pedro@example.com', 'clave789', 35, '2024-03-06'),
	(4, 'Ana', 'López', '555666777-2', 1, 'Avenida Central #101', '369258147', 'ana@example.com', 'password123', 28, '2024-03-06'),
	(5, 'Luis', 'Martínez', '333444555-3', 0, 'Calle Principal #789', '258147369', 'luis@example.com', 'contraseña456', 40, '2024-03-06'),
	(6, 'Elena', 'Rodríguez', '666777888-4', 1, 'Barrio Nuevo #321', '147258369', 'elena@example.com', 'clave987', 22, '2024-03-06'),
	(7, 'Carlos', 'Hernández', '777888999-6', 0, 'Avenida Sur #456', '369258147', 'carlos@example.com', 'password123', 33, '2024-03-06'),
	(8, 'Sofía', 'Díaz', '888999000-8', 1, 'Calle Norte #654', '852963741', 'sofia@example.com', 'contraseña789', 29, '2024-03-06'),
	(9, 'Javier', 'Lara', '999000111-1', 1, 'Avenida Este #987', '963852741', 'javier@example.com', 'clave456', 31, '2024-03-06'),
	(10, 'Lucía', 'Fernández', '000111222-3', 0, 'Barrio Industrial #321', '741852963', 'lucia@example.com', 'password789', 27, '2024-03-06'),
	(11, 'kenneth', 'ramos', '12345679-8', 1, 'San salvador', '7898-8987', 'kenneth@gmail.com', '$2y$10$CvJDLlF8Q/aj.6F1xy4dleFSyhv3X0GH.FKoYd.HnHylNoBfJSk2i', 18, '2014-07-16');

-- Dumping data for table bdhermespeeddp.colores: ~6 rows (approximately)
DELETE FROM `colores`;
INSERT INTO `colores` (`id_color`, `color_zapato`) VALUES
	(1, 'Negro'),
	(2, 'Blanco'),
	(3, 'Azul'),
	(4, 'Rojo'),
	(5, 'Gris'),
	(6, 'Verde');

-- Dumping data for table bdhermespeeddp.detalle_pedidos: ~4 rows (approximately)
DELETE FROM `detalle_pedidos`;
INSERT INTO `detalle_pedidos` (`id_detalle`, `cantidad_producto`, `precio_producto`, `id_pedido`, `id_zapato`) VALUES
	(1, 2, 100.00, 1, 1),
	(2, 1, 130.00, 2, 2),
	(3, 3, 120.00, 3, 3),
	(4, 2, 90.00, 4, 4),
	(5, 12, 15.00, 11, 2);

-- Dumping data for table bdhermespeeddp.detalle_zapatos: ~4 rows (approximately)
DELETE FROM `detalle_zapatos`;
INSERT INTO `detalle_zapatos` (`id_zapato`, `cantidad_talla`, `id_imagen`, `id_producto`, `id_color`, `id_talla`) VALUES
	(1, 10, 1, 1, 1, 1),
	(2, 15, 2, 2, 2, 2),
	(3, 20, 3, 3, 3, 3),
	(4, 12, 4, 4, 4, 4);

-- Dumping data for table bdhermespeeddp.generos: ~2 rows (approximately)
DELETE FROM `generos`;
INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
	(1, 'Hombre'),
	(2, 'Mujer');

-- Dumping data for table bdhermespeeddp.imagenes: ~5 rows (approximately)
DELETE FROM `imagenes`;
INSERT INTO `imagenes` (`id_imagen`, `nombre_archivo`) VALUES
	(1, 'imagen1.jpg'),
	(2, 'imagen2.jpg'),
	(3, 'imagen3.jpg'),
	(4, 'imagen4.jpg'),
	(5, 'imagen5.jpg');

-- Dumping data for table bdhermespeeddp.marcas: ~5 rows (approximately)
DELETE FROM `marcas`;
INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `imagen_marca`) VALUES
	(1, 'Nike', 'nike_logo.jpg'),
	(2, 'Adidas', 'adidas_logo.jpg'),
	(3, 'Puma', 'puma_logo.jpg'),
	(4, 'Reebok', 'reebok_logo.jpg'),
	(5, 'New Balance', 'newbalance_logo.jpg');

-- Dumping data for table bdhermespeeddp.pedidos: ~10 rows (approximately)
DELETE FROM `pedidos`;
INSERT INTO `pedidos` (`id_pedido`, `estado_pedido`, `fecha_pedido`, `direccion_pedido`, `id_cliente`) VALUES
	(1, 'en_reparto', '2024-03-06', 'Calle Principal #123', 1),
	(2, 'ausente', '2024-03-06', 'Avenida Central #456', 2),
	(3, 'atrasado', '2024-03-06', 'Barrio Residencial #789', 3),
	(4, 'reembolso', '2024-03-06', 'Avenida Norte #101', 4),
	(5, 'en_reparto', '2024-03-06', 'Calle Sur #789', 5),
	(6, 'ausente', '2024-03-06', 'Avenida Oeste #321', 6),
	(7, 'atrasado', '2024-03-06', 'Barrio Nuevo #654', 7),
	(8, 'reembolso', '2024-03-06', 'Calle Este #987', 8),
	(9, 'en_reparto', '2024-03-06', 'Avenida Industrial #321', 9),
	(10, 'ausente', '2024-03-06', 'Barrio Comercial #123', 10),
	(11, 'atrasado', '2006-02-22', 'San salvador', 11);

-- Dumping data for table bdhermespeeddp.productos: ~4 rows (approximately)
DELETE FROM `productos`;
INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `imagen_categoria`, `estado_producto`, `existencias_producto`, `fecha_registroP`, `id_categoria`, `id_admin`, `id_marca`, `id_genero`) VALUES
	(1, 'Zapatillas Nike Air Max', 'Zapatillas deportivas Nike Air Max con tecnología de amortiguación.', 150.00, 'nike_air_max.jpg', 1, 50, '2024-03-06', 1, 1, 1, 2),
	(2, 'Tenis Adidas Ultraboost', 'Tenis deportivos Adidas Ultraboost con tecnología de retorno de energía.', 130.00, 'adidas_ultraboost.jpg', 1, 70, '2024-03-06', 1, 2, 2, 2),
	(3, 'Zapatillas Puma RS-X', 'Zapatillas deportivas Puma RS-X con diseño retro y estilo futurista.', 120.00, 'puma_rs-x.jpg', 1, 40, '2024-03-06', 1, 3, 3, 2),
	(4, 'Tenis Reebok Classic', 'Tenis deportivos Reebok Classic con diseño clásico y comodidad.', 100.00, 'reebok_classic.jpg', 1, 60, '2024-03-06', 1, 4, 4, 2);

-- Dumping data for table bdhermespeeddp.tallas: ~4 rows (approximately)
DELETE FROM `tallas`;
INSERT INTO `tallas` (`id_talla`, `tamaño_talla`, `id_producto`) VALUES
	(1, 38, 1),
	(2, 39, 1),
	(3, 40, 1),
	(4, 41, 1);

-- Dumping data for table bdhermespeeddp.valoraciones: ~4 rows (approximately)
DELETE FROM `valoraciones`;
INSERT INTO `valoraciones` (`id_valoracion`, `calificacion_producto`, `comentario_producto`, `fecha_valoracion`, `estado_comentario`, `id_detalle`) VALUES
	(1, 4, '¡Excelente producto! Muy cómodos y de buena calidad.', '2024-03-06', 1, 1),
	(2, 5, 'Increíbles zapatillas, superó mis expectativas.', '2024-03-07', 1, 2),
	(3, 3, 'Buen producto, pero esperaba un poco más.', '2024-03-08', 1, 3),
	(4, 4, 'Muy satisfecho con mi compra, recomendado.', '2024-03-09', 1, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

