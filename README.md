CREATE DATABASE bdHERMESPEEDdp;

USE bdHERMESPEEDdp;

--tabla de los clientes

CREATE TABLE clientes(
id_cliente INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_cliente VARCHAR(50),
apellido_cliente VARCHAR(50),
dui_cliente VARCHAR(10),
estado_cliente BOOL NOT NULL,
direccion_cliente VARCHAR(250),
telefono_cliente VARCHAR(9),
correo_cliente VARCHAR(150),
clave_cliente VARCHAR(100),
edad_cliente INT,
fecha_registroC DATE
);

--tabla de los pedidos

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

SELECT * FROM pedidos;
--tabla de los administradores

CREATE TABLE administradores(
id_admin INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_admin VARCHAR(50),
apellido_admin VARCHAR(50),
alias_admin VARCHAR(25) NOT NULL,
correo_admin VARCHAR(150)NOT NULL,
clave_admin VARCHAR(100)NOT NULL,
fecha_registroA DATE
);

--tabla de las categorias

CREATE TABLE categorias(
id_categoria INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_categoria VARCHAR(50)NOT NULL,
descripcion_categoria VARCHAR(350)
);

CREATE TABLE imagenes(
id_imagen INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_archivo VARCHAR(50)NOT NULL
);

CREATE TABLE marcas(
id_marca INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_marca VARCHAR(50)NOT NULL,
imagen_marca VARCHAR(25) NOT NULL 
);

CREATE TABLE generos(
id_genero INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
nombre_genero DOUBLE NOT NULL
);


--tabla de las productos

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


CREATE TABLE detalle_zapatos(
id_zapato INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
color_zapato VARCHAR(50),
size_talla DOUBLE NOT NULL,
cantidad_talla ENUM('en_reserva','agotados') NOT NULL, 
id_imagen INT NOT NULL,
CONSTRAINT fk_imagen
FOREIGN KEY (id_imagen)
REFERENCES imagenes (id_imagen),
id_producto INT NOT NULL,
CONSTRAINT fk_producto
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto)
);

CREATE TABLE detalle_pedidos(
id_detalle INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
catidad_producto INT NOT NULL,
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

CREATE TABLE tallas(
id_talla INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
tamaño_talla INT NOT NULL,
id_producto INT NOT NULL,
CONSTRAINT fk_talla
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto)
);

