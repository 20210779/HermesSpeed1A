DROP DATABASE IF EXISTS bdHERMESPEEDdp;
CREATE DATABASE bdHERMESPEEDdp;

USE bdHERMESPEEDdp;


-- tabla de los clientes

CREATE TABLE clientes(
id_cliente INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_cliente VARCHAR(50),
apellido_cliente VARCHAR(50),
dui_cliente VARCHAR(12),
estado_cliente BOOL NOT NULL,
direccion_cliente VARCHAR(250),
telefono_cliente VARCHAR(9),
correo_cliente VARCHAR(150),
clave_cliente VARCHAR(100),
edad_cliente INT,
fecha_registroC DATE
);

-- INSERCCION DE TABLA clientes
INSERT INTO clientes (nombre_cliente, apellido_cliente, dui_cliente, estado_cliente, direccion_cliente, telefono_cliente, correo_cliente, clave_cliente, edad_cliente, fecha_registroC) 
VALUES ('Juan', 'Pérez', '001234567-8', 1, 'Avenida Principal #123', '123456789', 'juan@example.com', 'clave123', 30, '2024-03-06'),
('María', 'González', '112233445-5', 1, 'Calle Secundaria #456', '987654321', 'maria@example.com', 'contraseña456', 25, '2024-03-06'),
('Pedro', 'Sánchez', '987654321-0', 0, 'Barrio Residencial #789', '741852963', 'pedro@example.com', 'clave789', 35, '2024-03-06'),
('Ana', 'López', '555666777-2', 1, 'Avenida Central #101', '369258147', 'ana@example.com', 'password123', 28, '2024-03-06'),
('Luis', 'Martínez', '333444555-3', 0, 'Calle Principal #789', '258147369', 'luis@example.com', 'contraseña456', 40, '2024-03-06'),
('Elena', 'Rodríguez', '666777888-4', 1, 'Barrio Nuevo #321', '147258369', 'elena@example.com', 'clave987', 22, '2024-03-06'),
('Carlos', 'Hernández', '777888999-6', 0, 'Avenida Sur #456', '369258147', 'carlos@example.com', 'password123', 33, '2024-03-06'),
('Sofía', 'Díaz', '888999000-8', 1, 'Calle Norte #654', '852963741', 'sofia@example.com', 'contraseña789', 29, '2024-03-06'),
('Javier', 'Lara', '999000111-1', 1, 'Avenida Este #987', '963852741', 'javier@example.com', 'clave456', 31, '2024-03-06'),
('Lucía', 'Fernández', '000111222-3', 0, 'Barrio Industrial #321', '741852963', 'lucia@example.com', 'password789', 27, '2024-03-06');


-- tabla de los pedidos

CREATE TABLE pedidos(
id_pedido INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
estado_pedido ENUM('atrasado','en_reparto','ausente','reembolso') NOT NULL,
fecha_pedido DATE,
direccion_pedido VARCHAR(250),
id_cliente INT NOT NULL,
CONSTRAINT fk_cliente
FOREIGN KEY (id_cliente)
REFERENCES clientes (id_cliente)
);


INSERT INTO pedidos (estado_pedido, fecha_pedido, direccion_pedido, id_cliente) VALUES 
('en_reparto', '2024-03-06', 'Calle Principal #123', 1),
('ausente', '2024-03-06', 'Avenida Central #456', 2),
('atrasado', '2024-03-06', 'Barrio Residencial #789', 3),
('reembolso', '2024-03-06', 'Avenida Norte #101', 4),
('en_reparto', '2024-03-06', 'Calle Sur #789', 5),
('ausente', '2024-03-06', 'Avenida Oeste #321', 6),
('atrasado', '2024-03-06', 'Barrio Nuevo #654', 7),
('reembolso', '2024-03-06', 'Calle Este #987', 8),
('en_reparto', '2024-03-06', 'Avenida Industrial #321', 9),
('ausente', '2024-03-06', 'Barrio Comercial #123', 10);

SELECT * FROM pedidos;

-- tabla de los administradores

CREATE TABLE administradores(
id_admin INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_admin VARCHAR(50),
apellido_admin VARCHAR(50),
correo_admin VARCHAR(150)NOT NULL,
alias_admin VARCHAR(25) NOT NULL,
clave_admin VARCHAR(100)NOT NULL,
fecha_registroA DATE
);

-- Insercciones de la tabla administradores

INSERT INTO administradores (nombre_admin, apellido_admin, alias_admin, correo_admin, clave_admin, fecha_registroA) VALUES 
('Juan', 'Pérez',  'juanito@example.com','juanito', 'clave123', '2024-03-06'),
('María', 'González', 'mary@example.com', 'mary','contraseña456', '2024-03-06'),
('Pedro', 'Sánchez', 'pedrito@example.com','pedrito', 'clave789', '2024-03-06'),
('Ana', 'López', 'anita@example.com', 'anita', 'password123', '2024-03-06');


-- tabla de las categorias

CREATE TABLE categorias(
id_categoria INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_categoria VARCHAR(50)NOT NULL,
descripcion_categoria VARCHAR(350)
);

-- insercciones de la tabla categorias

INSERT INTO categorias (nombre_categoria, descripcion_categoria) VALUES 
('Mujer', 'Zapatos de deporte para mujeres.'),
('Hombre', 'Zapatos de deporte para hombres.'),
('Niños', 'Zapatos de deporte para niños.');

CREATE TABLE imagenes(
id_imagen INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_archivo VARCHAR(50)NOT NULL
);

-- inserciones de la tabla imagenes
-- al conectarla con la pagina se cambiara las imagenes
INSERT INTO imagenes (nombre_archivo) VALUES 
('imagen1.jpg'),
('imagen2.jpg'),
('imagen3.jpg'),
('imagen4.jpg'),
('imagen5.jpg');

CREATE TABLE marcas(
id_marca INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_marca VARCHAR(50)NOT NULL,
imagen_marca VARCHAR(25) NOT NULL 
);

INSERT INTO marcas (nombre_marca, imagen_marca) VALUES 
('Nike', 'nike_logo.jpg'),
('Adidas', 'adidas_logo.jpg'),
('Puma', 'puma_logo.jpg'),
('Reebok', 'reebok_logo.jpg'),
('New Balance', 'newbalance_logo.jpg');

CREATE TABLE generos(
id_genero INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_genero VARCHAR(50) NOT NULL
);

-- inserccion de la tabla generos
INSERT INTO generos (nombre_genero) VALUES ('Hombre'),('Mujer');



-- tabla de las productos

CREATE TABLE productos(
id_producto INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_producto VARCHAR(50),
descripcion_producto VARCHAR(350),
precio_producto NUMERIC(5,2),
imagen_categoria VARCHAR(25) NOT NULL,
estado_producto BOOLEAN,
existencias_producto INT,
fecha_registroP DATE,
id_categoria INT NOT NULL,
CONSTRAINT fk_categoria
FOREIGN KEY (id_categoria)
REFERENCES categorias (id_categoria),
id_admin INT NOT NULL,
CONSTRAINT fk_admin
FOREIGN KEY (id_admin)
REFERENCES administradores (id_admin),
id_marca INT NOT NULL,
CONSTRAINT fk_marca
FOREIGN KEY (id_marca)
REFERENCES marcas (id_marca),
id_genero INT NOT NULL,
CONSTRAINT fk_genero
FOREIGN KEY (id_genero)
REFERENCES generos (id_genero)
);

create table colores(
id_color int primary key Not null,
color_zapato varchar(40)
);

-- inserciones de la tabla productos
INSERT INTO productos (nombre_producto, descripcion_producto, precio_producto, imagen_categoria, estado_producto, existencias_producto, fecha_registroP, id_categoria, id_admin, id_marca, id_genero) VALUES 
('Zapatillas Nike Air Max', 'Zapatillas deportivas Nike Air Max con tecnología de amortiguación.', 150.00, 'nike_air_max.jpg', 1, 50, '2024-03-06', 1, 1, 1, 2),
('Tenis Adidas Ultraboost', 'Tenis deportivos Adidas Ultraboost con tecnología de retorno de energía.', 130.00, 'adidas_ultraboost.jpg', 1, 70, '2024-03-06', 1, 2, 2, 2),
('Zapatillas Puma RS-X', 'Zapatillas deportivas Puma RS-X con diseño retro y estilo futurista.', 120.00, 'puma_rs-x.jpg', 1, 40, '2024-03-06', 1, 3, 3, 2),
('Tenis Reebok Classic', 'Tenis deportivos Reebok Classic con diseño clásico y comodidad.', 100.00, 'reebok_classic.jpg', 1, 60, '2024-03-06', 1, 4, 4, 2);



-- inserciones de la tabla colores
INSERT INTO colores (id_color, color_zapato) VALUES (1, 'Negro');
INSERT INTO colores (id_color, color_zapato) VALUES (2, 'Blanco');
INSERT INTO colores (id_color, color_zapato) VALUES (3, 'Azul');
INSERT INTO colores (id_color, color_zapato) VALUES (4, 'Rojo');
INSERT INTO colores (id_color, color_zapato) VALUES (5, 'Gris');
INSERT INTO colores (id_color, color_zapato) VALUES (6, 'Verde');


CREATE TABLE tallas(
id_talla INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
tamaño_talla INT NOT NULL,
id_producto INT NOT NULL,
CONSTRAINT fk_productoss
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto)
);
select*from productos;
-- inserciones de la tabla tallas
INSERT INTO tallas (tamaño_talla, id_producto) VALUES (38, 1);
INSERT INTO tallas (tamaño_talla, id_producto) VALUES (39, 1);
INSERT INTO tallas (tamaño_talla, id_producto) VALUES (40, 1);
INSERT INTO tallas (tamaño_talla, id_producto) VALUES (41, 1);


CREATE TABLE detalle_zapatos(
id_zapato INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
cantidad_talla int, 
id_imagen INT NOT NULL,
CONSTRAINT fk_imagen
FOREIGN KEY (id_imagen)
REFERENCES imagenes (id_imagen),
id_producto INT NOT NULL,
CONSTRAINT fk_producto
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto),
id_color INT NOT NULL,
CONSTRAINT fk_color
FOREIGN KEY (id_color)
REFERENCES colores (id_color),
id_talla  INT NOT NULL,
CONSTRAINT fk_tallas
FOREIGN KEY (id_talla)
REFERENCES tallas (id_talla)
);

-- inserciones de la tabla detalle_zapato 
INSERT INTO detalle_zapatos (cantidad_talla, id_imagen, id_producto, id_color, id_talla) VALUES (10, 1, 1, 1, 1);
INSERT INTO detalle_zapatos (cantidad_talla, id_imagen, id_producto, id_color, id_talla) VALUES (15, 2, 2, 2, 2);
INSERT INTO detalle_zapatos (cantidad_talla, id_imagen, id_producto, id_color, id_talla) VALUES (20, 3, 3, 3, 3);
INSERT INTO detalle_zapatos (cantidad_talla, id_imagen, id_producto, id_color, id_talla) VALUES (12, 4, 4, 4, 4);


CREATE TABLE detalle_pedidos(
id_detalle INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
cantidad_producto INT NOT NULL,
precio_producto NUMERIC(5,2),
id_pedido INT NOT NULL,
CONSTRAINT fk_pedido
FOREIGN KEY (id_pedido)
REFERENCES pedidos (id_pedido),
id_zapato INT NOT NULL,
CONSTRAINT fk_detalle_zapato
FOREIGN KEY (id_zapato)
REFERENCES detalle_zapatos (id_zapato)
);

-- inserciones de la tabla detalle_pedido

INSERT INTO detalle_pedidos (cantidad_producto, precio_producto, id_pedido, id_zapato) VALUES (2, 100.00, 1, 1);
INSERT INTO detalle_pedidos (cantidad_producto, precio_producto, id_pedido, id_zapato) VALUES (1, 130.00, 2, 2);
INSERT INTO detalle_pedidos (cantidad_producto, precio_producto, id_pedido, id_zapato) VALUES (3, 120.00, 3, 3);
INSERT INTO detalle_pedidos (cantidad_producto, precio_producto, id_pedido, id_zapato) VALUES (2, 90.00, 4, 4);



CREATE TABLE valoraciones(
id_valoracion INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
calificacion_producto INT NULL,
comentario_producto VARCHAR(350) NULL,
fecha_valoracion DATE,
estado_comentario BOOLEAN,
id_detalle INT NOT NULL,
CONSTRAINT fk_detalle
FOREIGN KEY (id_detalle)
REFERENCES detalle_pedidos (id_detalle)
);

-- inserciones de la tabla valoraciones
INSERT INTO valoraciones (calificacion_producto, comentario_producto, fecha_valoracion, estado_comentario, id_detalle) VALUES 
(4, '¡Excelente producto! Muy cómodos y de buena calidad.', '2024-03-06', 1, 1),
(5, 'Increíbles zapatillas, superó mis expectativas.', '2024-03-07', 1, 2),
(3, 'Buen producto, pero esperaba un poco más.', '2024-03-08', 1, 3),
(4, 'Muy satisfecho con mi compra, recomendado.', '2024-03-09', 1, 4);



DELIMITER //
CREATE FUNCTION verificar_disponibilidad(
    p_id_producto INT,
    p_id_detalle INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE v_stock_actual INT;
    DECLARE v_cantidad_deseada INT;
    
    -- Obtener el stock actual del producto
    SELECT existencias_producto INTO v_stock_actual
    FROM productos
    WHERE id_producto = p_id_producto;
    
    -- Obtener la cantidad deseada
    SELECT cantidad_producto INTO v_cantidad_deseada
    FROM detalle_pedidos
    WHERE id_detalle = p_id_detalle;
    
    -- Verificar la disponibilidad
    IF v_stock_actual >= v_cantidad_deseada THEN
        RETURN TRUE; -- Hay suficiente stock disponible
    ELSE
        RETURN FALSE; -- No hay suficiente stock disponible
    END IF;
END//
DELIMITER ;


SELECT verificar_disponibilidad(1, 1) AS disponibilidad;


-- 50
select * from detalle_pedidos;
-- poner la id del producto y la cantidad a verificar si hay existente
select verificar_disponibilidad(1,40) AS 'VERIFICAR DISPONIBILIDAD',
cantidad_producto 
-- if (disponible>=cantidad_producto,'Stock suficiente','Stock insuficiente') as 'Estado'
from detalle_pedidos;


DELIMITER //
CREATE PROCEDURE agregar_producto_carrito(
    IN p_id_usuario INT,
    IN p_id_producto INT,
    IN p_cantidad INT
)
BEGIN
    DECLARE existe_producto INT;
    
    -- Verificar si el producto ya está en el carrito del usuario
    SELECT COUNT(*) INTO existe_producto
    FROM carrito
    WHERE id_usuario = p_id_usuario AND id_producto = p_id_producto;
    
    IF existe_producto > 0 THEN
        -- Actualizar la cantidad del producto en el carrito
        UPDATE carrito
        SET cantidad = cantidad + p_cantidad
        WHERE id_usuario = p_id_usuario AND id_producto = p_id_producto;
    ELSE
        -- Agregar el producto al carrito
        INSERT INTO carrito (id_usuario, id_producto, cantidad)
        VALUES (p_id_usuario, p_id_producto, p_cantidad);
    END IF;
    
END //

DELIMITER ;


