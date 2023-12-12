CREATE DATABASE proyecto_ventas;
USE proyecto_ventas;
	
	
	CREATE TABLE user(
			id INT NOT null AUTO_INCREMENT PRIMARY KEY,
			nombre varchar (50),
			username varchar(90),
			PASSWORD  VARCHAR(220),
			status int default 1
	);


	insert into user (nombre,username,password) values (
			"Adminstrador",
			"admin",
			sha1(md5("admin"))
	);
	
	

	CREATE TABLE direccion(
		id_direccion int NOT NULL AUTO_INCREMENT,
		calle varchar(100),
		numero INT,
		colonia VARCHAR(100),
		ciudad varchar(100),
		
		PRIMARY KEY (id_direccion)

	);

	CREATE TABLE proveedor(
		id_proveedor int NOT NULL AUTO_INCREMENT,
		nombre varchar(50),
		telefono varchar(12),
		sitio_web varchar(50),
		id_direccion int,
		status int default 1, /*1 visible, 0 no visible.*/
			
		PRIMARY KEY (id_proveedor),
		FOREIGN KEY (id_direccion) REFERENCES direccion(id_direccion)
	);

	CREATE TABLE cliente(
		id_cliente INT NOT NULL AUTO_INCREMENT,
		nombre VARCHAR(100),
		id_direccion INT,
		status int DEFAULT 1,
		
		PRIMARY KEY(id_cliente),
		FOREIGN KEY(id_direccion) REFERENCES direccion(id_direccion)
	);
	
	CREATE TABLE numero_telefonico(
		id_numero INT NOT NULL AUTO_INCREMENT,
		id_cliente INT,
		numero VARCHAR(12),
		
		PRIMARY KEY (id_numero),
		FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente) 
	
	);
	
	CREATE TABLE categoria(
		id_categoria INT NOT NULL AUTO_INCREMENT,
		nombre VARCHAR(100),
		descripcion VARCHAR(200),
		
		PRIMARY KEY (id_categoria)
	);

	CREATE TABLE producto(
		id_producto INT NOT NULL AUTO_INCREMENT,
		nombre VARCHAR(50),
		precio INT,
		stock INT,
		id_proveedor INT,
		id_categoria INT,
		
		PRIMARY KEY (id_producto),
		FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor),
		FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
	);
	
	CREATE TABLE venta(
		id_venta INT NOT NULL AUTO_INCREMENT,
		fecha DATE,
		descuento INT,
		id_cliente INT,
		monto INT,
		
		PRIMARY KEY (id_venta),
		FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
	);
	
	CREATE TABLE detalles_venta(
		id_venta INT,
		id_producto INT,
		cantidad INT,
		monto INT,
		
		FOREIGN KEY (id_venta) REFERENCES venta(id_venta),
		FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
	);

information_schemauser