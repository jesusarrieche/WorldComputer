-- -----------------------------------------------------
-- Table `proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` INT AUTO_INCREMENT,
  `documento` VARCHAR(15) NOT NULL UNIQUE,
  `razon_social` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL UNIQUE,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` INT AUTO_INCREMENT,
  `documento` VARCHAR(15) NOT NULL UNIQUE,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(100) NOT NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(255) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `description` VARCHAR(45) NULL,
  `marca_id` INT NOT NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_modelos_marcas1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `marcas` (`id`) MATCH FULL
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unidades` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `abreviatura` VARCHAR(5) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'activo',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `productos` (
  `id` INT AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `precio_venta` DOUBLE NULL,
  `precio_porcentaje` DOUBLE NULL,
  `stock` INT(11) NULL DEFAULT 0,
  `stock_min` INT(11) NULL DEFAULT 0,
  `stock_max` INT(11) NULL DEFAULT 0,
  `descuento` DOUBLE NULL,
  `impuesto` VARCHAR(45) NULL DEFAULT '0',
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `categoria_id` INT NOT NULL,
  -- `modelo_id` INT NOT NULL,
  `unidad_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categorias` (`id`) MATCH FULL
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  -- CONSTRAINT `fk_productos_modelos1`
  --   FOREIGN KEY (`modelo_id`)
  --   REFERENCES `modelos` (`id`) MATCH FULL
  --   ON UPDATE CASCADE
  --   ON DELETE CASCADE,
  CONSTRAINT `fk_productos_unidades1`
    FOREIGN KEY (`unidad_id`)
    REFERENCES `unidades` (`id`) MATCH FULL
    ON UPDATE CASCADE
    ON DELETE CASCADE
    )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` INT AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impuesto` VARCHAR(45) NULL DEFAULT '0',
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `cliente_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ventas_clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` INT AUTO_INCREMENT,
  `cantidad` VARCHAR(45) NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `producto_id` INT NOT NULL,
  `venta_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_venta_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_ventas1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `compras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `compras` (
  `id` INT AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `cod_ref` VARCHAR(45) NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impuesto` VARCHAR(45) NULL DEFAULT '0',
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `proveedor_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_compras_proveedores1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id` INT AUTO_INCREMENT,
  `costo` DOUBLE NOT NULL,
  `cantidad` VARCHAR(45) NOT NULL,
  `producto_id` INT NOT NULL,
  `compra_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_compra_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_compra_compras1`
    FOREIGN KEY (`compra_id`)
    REFERENCES `compras` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT,
  `documento` VARCHAR(15) NOT NULL UNIQUE,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `direccion` VARCHAR(200) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `usuario` VARCHAR(45) NOT NULL UNIQUE,
  `password` VARCHAR(200) NULL,
  `estatus` VARCHAR(45) NULL DEFAULT 'ACTIVO',
  `rol_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuarios_roles1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rol_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rol_permiso` (
  `rol_id` INT NOT NULL,
  `permiso_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rol_id`, `permiso_id`),
  CONSTRAINT `fk_roles_has_permisos_roles1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permisos_permisos1`
    FOREIGN KEY (`permiso_id`)
    REFERENCES `permisos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `entradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` INT AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `fecha` DATETIME NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `observacion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `salidas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salidas` (
  `id` INT AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `fecha` DATETIME NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `observacion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_salida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_salida` (
  `id` INT AUTO_INCREMENT,
  `cantidad` DOUBLE NOT NULL,
  `precio` DOUBLE NULL,
  `producto_id` INT NOT NULL,
  `salida_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_descargo_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_descargo_descargos1`
    FOREIGN KEY (`salida_id`)
    REFERENCES `salidas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_entrada` (
  `id` INT AUTO_INCREMENT,
  `cantidad` DOUBLE NULL,
  `costo` DOUBLE NULL,
  `producto_id` INT NOT NULL,
  `entrada_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_cargo_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_cargo_cargos1`
    FOREIGN KEY (`entrada_id`)
    REFERENCES `entradas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` INT AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `precio` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empleados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` INT AUTO_INCREMENT,
  `documento` VARCHAR(15) NOT NULL UNIQUE,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `cargo` VARCHAR(25) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_servicio` (
  `id` INT AUTO_INCREMENT,
  `cantidad` DOUBLE NOT NULL,
  `precio` DOUBLE NOT NULL,
  `empleado_id` INT NOT NULL,
  `venta_id` INT NOT NULL,
  `servicio_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_servicios_has_ventas_servicios1`
    FOREIGN KEY (`servicio_id`)
    REFERENCES `servicios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicios_has_ventas_ventas1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicio_venta_empleados1`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `empleados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bitacora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` INT AUTO_INCREMENT,
  `fecha` DATETIME NULL,
  `modulo` VARCHAR(45) NULL,
  `accion` VARCHAR(45) NULL,
  `usuario_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_bitacora_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE impuestos(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE,
    valor DECIMAL(4,2) NOT NULL,
    estatus VARCHAR(15) DEFAULT 'ACTIVO',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT id_impuestos PRIMARY KEY(id)
);

CREATE TABLE notificaciones(
    id INT AUTO_INCREMENT,
    usuario_id INT NOT NULL,

    titulo VARCHAR(255),
    mensaje VARCHAR(255),
    autor VARCHAR(255) DEFAULT 'SISTEMA',
    repeticion INT(2) DEFAULT 1,
    estatus VARCHAR(15) DEFAULT 'ACTIVO',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT id_impuestos PRIMARY KEY(id),
    CONSTRAINT fk_usuarios_notificaciones 
      FOREIGN KEY(usuario_id) 
      REFERENCES usuarios(id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);


INSERT INTO impuestos(nombre, valor) VALUES ('iva', '12.00'), ('iva2', '16.00');


-- CLIENTES
INSERT INTO clientes(documento, nombre, apellido, direccion, telefono, email, estatus) VALUES
('V-26945214', 'JOSNERY', 'DIAZ', 'LOS CREPUSCULOS', '000-1234567', 'josnery@gmail.com', 'ACTIVO'),
('V-27025411', 'CARLOS', 'RAMIREZ', 'BARQUISIMETO', '000-1234567', 'carlos@gmail.com', 'ACTIVO'),
('V-27022222', 'HECTOR', 'NOGUERA', 'BARQUISIMETO', '000-1234567', 'hector@gmail.com', 'ACTIVO'),
('V-26540950', 'JESUS', 'ARRIECHE', 'DUACA', '000-1234567', 'jesus@gmail.com', 'ACTIVO');

-- EMPLEADOS
INSERT INTO empleados(documento, nombre, apellido, direccion, telefono, email, cargo, estatus) VALUES
('V-26945214', 'JUAN', 'DIAZ', 'LOS CREPUSCULOS', '000-1234567', 'josnery@gmail.com', 'ADMINISTRADOR', 'ACTIVO'),
('V-27025411', 'PEDRO', 'BETANCOURT', 'DON AURELIO', '000-1234567', 'maria@gmail.com', 'TECNICO', 'ACTIVO'),
('V-26540950', 'CARLOS', 'ARRIECHE', 'DUACA', '000-1234567', 'jesus@gmail.com', 'TECNICO', 'ACTIVO');

-- MARCAS
INSERT INTO marcas(nombre, estatus) VALUES
('TP-LINK', 'ACTIVO'),
('CISCO', 'ACTIVO'),
('MERCUSYS', 'ACTIVO');

-- MODELOS
INSERT INTO modelos(marca_id, nombre, estatus) VALUES
('1','WF155', 'ACTIVO'),
('1','MD399', 'ACTIVO'),
('1','JD110', 'ACTIVO'),
('2','A300', 'ACTIVO'),
('2','A400', 'ACTIVO'),
('2','A055', 'ACTIVO'),
('3','MS100', 'ACTIVO'),
('3','MS200', 'ACTIVO'),
('3','MS300', 'ACTIVO');

/* Inventario */

-- INSERT INTO impuestos(nombre, valor) VALUES ('iva', '12.00'), ('iva2', '16.00');

INSERT INTO proveedores(documento, razon_social, direccion, telefono, email) VALUES
('J-26540950', 'MICROTECH', 'BARQUISIMETO', '0424-5294781', 'microtech@gmail.com'),
('J-26543456', 'CARSYS', 'CARACAS', '0424-5294781', 'Carsys@gmail.com'),
('J-26523234', 'SUPER TECH', 'BARINAS', '0424-5294781', 'supertech@gmail.com');


INSERT INTO unidades(nombre, abreviatura) VALUES
('PIEZA', 'pza'),
('METRO', 'm'),
('LITRO', 'l');

INSERT INTO categorias(nombre, descripcion) VALUES
('REDES', 'REDES EN GENERAL'),
('TELEFONIA', 'TELEFONOS EN GENERAL'),
('PC', 'PC GENERAL');

-- INSERT INTO productos(categoria_id, unidad_id, modelo_id, codigo, nombre, precio_porcentaje) VALUES 
-- ('3', '1', '1', 'P456125', 'ROUTER 3400', '30'),
-- ('3', '1', '2','P456123', 'MODEM-ROUTER AJ300', '30'),
-- ('3', '1', '3','P456154', 'ANTENA KE444', '30'),
-- ('2', '1', '4','P456165', 'CAMARA AL300', '30'),
-- ('2', '1', '5','P456187', 'ADAPTADOR 30K', '30');

INSERT INTO productos(categoria_id, unidad_id, codigo, nombre, precio_porcentaje) VALUES 
('3', '1','P456125', 'ROUTER 3400', '30'),
('3', '1','P456123', 'MODEM-ROUTER AJ300', '30'),
('3', '1','P456154', 'ANTENA KE444', '30'),
('2', '1','P456165', 'CAMARA AL300', '30'),
('2', '1','P456187', 'ADAPTADOR 30K', '30');

/* Roles */
INSERT INTO roles(nombre, descripcion) VALUES 
('admin', 'todos los permisos del sistema'),
('user', 'Permisos esenciales para inventario, compra y venta');

/* Cargando Permisos */
INSERT INTO permisos(nombre) VALUES 
('usuarios'),
('registrar usuarios'),
('editar usuarios'),
('eliminar usuarios'),

('clientes'),
('registrar clientes'),
('editar clientes'),
('eliminar clientes'),

('empleados'),
('registrar empleados'),
('editar empleados'),
('eliminar empleados'),

('vehiculos'),
('registrar vehiculos'),
('editar vehiculos'),
('eliminar vehiculos'),

('ordenes'),
('registrar ordenes'),
('editar ordenes'),
('anular ordenes'),

('inventario'),

('categorias'),
('registrar categorias'),
('editar categorias'),
('eliminar categorias'),

('productos'),
('registrar productos'),
('editar productos'),
('eliminar productos'),

('proveedores'),
('registrar proveedores'),
('editar proveedores'),
('eliminar proveedores'),

('compras'),
('registrar compras'),
('anular compras'),

('ventas'),
('registrar ventas'),
('anular ventas'),

('reportes'),

('roles'),
('registrar roles'),
('editar roles'),
('eliminar roles');

/* Roles con permisos*/
INSERT INTO rol_permiso(rol_id, permiso_id) VALUES 
('1','1'),
('1','2'),
('1','3'),
('1','4'),
('1','5'),
('1','6'),
('1','7'),
('1','8'),
('1','9'),
('1','10'),
('1','11'),
('1','12'),
('1','13'),
('1','14'),
('1','15'),
('1','16'),
('1','17'),
('1','18'),
('1','19'),
('1','20'),
('1','21'),
('1','22'),
('1','23'),
('1','24'),
('1','26'),
('1','27'),
('1','28'),
('1','29'),
('1','30'),
('1','31'),
('1','32'),
('1','33'),
('1','34'),
('1','35'),
('1','36'),
('1','37'),
('1','38'),
('1','39'),
('1','40'),
('1','41'),
('1','42'),
('1','43'),
('1','44'),

('2','5'),
('2','6'),
('2','7'),
('2','8'),
('2','9'),
('2','10'),
('2','11'),
('2','12'),
('2','13'),
('2','14'),
('2','15'),
('2','16'),
('2','17'),
('2','18'),
('2','19'),
('2','20'),
('2','21'),
('2','22'),
('2','23'),
('2','24'),
('2','25'),
('2','26'),
('2','27'),
('2','28'),
('2','29'),
('2','30'),
('2','31'),
('2','32'),
('2','33'),
('2','34'),
('2','35'),
('2','36'),
('2','37'),
('2','38'),
('2','39'),
('2','40'),
('2','41'),
('2','42'),
('2','43'),
('2','44');

-- USUARIO
INSERT INTO usuarios(rol_id, documento, nombre, apellido, direccion, telefono, email, usuario, password, estatus) VALUES 
('1', 'V-00000000', 'ADMINISTRADOR', 'ADMINISTRADOR', 'WORLD','000-0000000', 'administrador@email.com', 'administrador', 'ZXRlSml1a1p0akNsbTYwL2hnNEF2UT09', 'ACTIVO'),
('2', 'V-10000000', 'USUARIO', 'USUARIO', 'WORLD','000-0000000', 'usuario@email.com', 'usuario', 'ZXRlSml1a1p0akNsbTYwL2hnNEF2UT09', 'ACTIVO');

-- COMPRAS
INSERT INTO compras(proveedor_id, codigo, cod_ref, fecha, impuesto) VALUES 
('1', '000001', null, now(), '12,00'),
('2', '000002', null, now(), '0'),
('3', '000003', null, now(), '10,00');

INSERT INTO detalle_compra(producto_id, compra_id, costo, cantidad) VALUES 
('1', '1', '2000', '5'),
('2', '1', '1000', '3'),
('3', '1', '5000', '12'),

('1', '2', '2000', '5'),
('2', '2', '1000', '3'),
('3', '2', '5000', '12'),

('1', '3', '2000', '5'),
('2', '3', '1000', '3'),
('3', '3', '5000', '12');

-- VENTAS
INSERT INTO ventas(cliente_id, codigo, fecha) VALUES 
('1', '000001', now()),
('2', '000002', now()),
('3', '000003', now());

INSERT INTO detalle_venta(venta_id, producto_id, cantidad, precio) VALUES 
('1', '1', '12', '2500'),
('1', '2', '6', '500'),
('1', '3', '10', '200'),

('2', '1', '12', '2500'),
('2', '2', '6', '500'),
('2', '3', '10', '200'),

('3', '1', '12', '2500'),
('3', '2', '6', '500'),
('3', '3', '10', '200');

-- SERVICIOS
INSERT INTO servicios(nombre, descripcion, precio) VALUES 
('MANTENIMIENTO CAMARAS', 'Mantenimiento General', '6200'),
('REPARACION UPS', 'Reparacion ', '2000'),
('FORMATEO PC', 'Instalacion SO', '3500');

INSERT INTO detalle_servicio(venta_id, servicio_id, empleado_id, cantidad, precio) VALUES 
('1', '2', '2', '1', '2000'),
('2', '2', '3', '1', '2000'),
('3', '2', '3', '1', '2000');

-- ENTRADAS
INSERT INTO entradas(codigo, fecha, tipo, observacion) VALUES 
('000001', now(), 'APORTE', 'aporte de un socio'),
('000002', now(), 'PRESTAMO', 'prestamo de mercancia'),
('000003', now(), 'APORTE', 'aporte de un socio');

INSERT INTO detalle_entrada(entrada_id, producto_id, cantidad) VALUES 
('1', '1', '20'),
('1', '1', '20'),
('1', '1', '20'),

('2', '2', '20'),
('2', '2', '20'),
('2', '2', '20'),

('3', '3', '20'),
('3', '3', '20'),
('3', '3', '20');

-- SALIDAS
INSERT INTO salidas(codigo, fecha, tipo, observacion) VALUES 
('000001', now(), 'RETIRO', 'retiro de un socio'),
('000002', now(), 'PRESTAMO', 'prestamo de mercancia'),
('000003', now(), 'RETIRO', 'retiro de un socio');

INSERT INTO detalle_salida(salida_id, producto_id, cantidad) VALUES 
('1', '1', '5'),
('1', '1', '5'),
('1', '1', '5'),

('2', '2', '5'),
('2', '2', '5'),
('2', '2', '5'),

('3', '3', '5'),
('3', '3', '5'),
('3', '3', '5');


/* VISTAS */

-- ENTRADAS POR COMPRAS
CREATE VIEW v_entradas_compras AS SELECT p.id, p.codigo, p.nombre, SUM(dc.cantidad) as total FROM
productos p
	LEFT JOIN
detalle_compra dc
  ON p.id = dc.producto_id
  LEFT JOIN
compras c
	ON dc.compra_id = c.id
	WHERE c.estatus = 'ACTIVO'
GROUP BY p.id, p.codigo, p.nombre;

-- ENTRADAS POR RECARGOS
CREATE VIEW v_entradas_recargo AS SELECT p.id, p.codigo, p.nombre, SUM(de.cantidad) as total FROM
productos p
	LEFT JOIN
detalle_entrada de
  ON p.id = de.producto_id
  LEFT JOIN
entradas e
	ON de.entrada_id = e.id
	WHERE e.estatus = 'ACTIVO'
GROUP BY p.id, p.codigo, p.nombre;

-- ENTRADAS TOTALES
CREATE VIEW v_entradas_totales AS SELECT p.id, p.codigo, p.nombre, IFNULL(vec.total, 0) AS compras, IFNULL(ver.total, 0) AS cargos, (IFNULL(vec.total, 0) + IFNULL(ver.total, 0)) AS total FROM
productos p
	LEFT JOIN
v_entradas_compras vec
	ON vec.id = p.id
	LEFT JOIN
v_entradas_recargo ver
  ON ver.id = vec.id
GROUP BY p.id, p.codigo, p.nombre;


-- SALIDAS POR VENTAS
CREATE VIEW v_salidas_ventas AS SELECT p.id, p.codigo, p.nombre, SUM(dv.cantidad) as total FROM
productos p
	LEFT JOIN
detalle_venta dv
  ON p.id = dv.producto_id
  LEFT JOIN
ventas v
	ON dv.venta_id = v.id
	WHERE v.estatus = 'ACTIVO'
GROUP BY p.id, p.codigo, p.nombre;

-- SALIDAS POR DESCARGO
CREATE VIEW v_salidas_descargo AS SELECT p.id, p.codigo, p.nombre, SUM(ds.cantidad) as total FROM
productos p
	LEFT JOIN
detalle_salida ds
  ON p.id = ds.producto_id
  LEFT JOIN
salidas s
	ON ds.salida_id = s.id
	WHERE s.estatus = 'ACTIVO'
GROUP BY p.id, p.codigo, p.nombre;

-- SALIDAS TOTALES
CREATE VIEW v_salidas_totales AS SELECT p.id, p.codigo, p.nombre, IFNULL(vsv.total, 0) AS ventas, IFNULL(vsd.total, 0) AS descargos, (IFNULL(vsv.total, 0) + IFNULL(vsd.total, 0)) AS total FROM
productos p
	LEFT JOIN
v_salidas_ventas vsv
	ON vsv.id = p.id
	LEFT JOIN
v_salidas_descargo vsd
  ON vsd.id = vsv.id
GROUP BY p.id, p.codigo, p.nombre;

-- VISTA INVENTARIO
CREATE VIEW v_inventario AS SELECT p.id, p.codigo, p.nombre, c.nombre AS categoria, p.precio_venta, IFNULL((e.compras + e.cargos) - (s.ventas + s.descargos),0) AS stock, p.stock_min, p.stock_max, p.estatus FROM
productos p
	LEFT JOIN
v_entradas_totales e
	ON p.id = e.id
    LEFT JOIN
v_salidas_totales s 
	ON p.id = s.id
    JOIN
categorias c 
	ON p.categoria_id = c.id
-- WHERE p.estatus = 'ACTIVO'
GROUP BY p.id, p.codigo, p.nombre, p.precio_venta, p.stock_min, p.stock_max  
ORDER BY `p`.`id` ASC;


-- DISPARADORES

CREATE TRIGGER actualizar_precio_producto 
AFTER INSERT ON detalle_compra FOR EACH ROW
	UPDATE productos SET precio_venta = (NEW.costo * (precio_porcentaje / 100)+ NEW.costo) WHERE id = NEW.producto_id;