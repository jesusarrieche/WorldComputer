SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema world_computer
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema world_computer
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `world_computer` DEFAULT CHARACTER SET utf8 ;
USE `world_computer` ;

-- -----------------------------------------------------
-- Table `world_computer`.`proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`proveedores` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`clientes` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`categorias` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(255) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`marcas` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`modelos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`modelos` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `description` VARCHAR(45) NULL,
  `marca_id` INT NOT NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_modelos_marcas1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `world_computer`.`marcas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`unidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`unidades` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `abreviatura` VARCHAR(5) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'activo',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`productos` (
  `id` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `precio_venta` DOUBLE NULL,
  `precio_procentaje` DOUBLE NULL,
  `stock` INT(11) NULL DEFAULT 0,
  `stock_min` INT(11) NULL DEFAULT 0,
  `stock_max` INT(11) NULL DEFAULT 0,
  `descuento` DOUBLE NULL,
  `impuesto` DOUBLE NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `categoria_id` INT NOT NULL,
  `modelo_id` INT NOT NULL,
  `unidad_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `world_computer`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_modelos1`
    FOREIGN KEY (`modelo_id`)
    REFERENCES `world_computer`.`modelos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_unidades1`
    FOREIGN KEY (`unidad_id`)
    REFERENCES `world_computer`.`unidades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`ventas` (
  `id` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `fecha` DATETIME NULL,
  `impuesto` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `cliente_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ventas_clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `world_computer`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`detalle_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`detalle_venta` (
  `id` INT NOT NULL,
  `cantidad` VARCHAR(45) NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `producto_id` INT NOT NULL,
  `venta_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_venta_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `world_computer`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_ventas1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `world_computer`.`ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`compras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`compras` (
  `id` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL UNIQUE,
  `cod_ref` VARCHAR(45) NULL,
  `fecha` DATETIME NOT NULL,
  `impuesto` DECIMAL NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',
  `proveedores_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_compras_proveedores1`
    FOREIGN KEY (`proveedores_id`)
    REFERENCES `world_computer`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`detalle_compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`detalle_compra` (
  `id` INT NOT NULL,
  `costo` DOUBLE NOT NULL,
  `cantidad` VARCHAR(45) NOT NULL,
  `producto_id` INT NOT NULL,
  `compra_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_compra_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `world_computer`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_compra_compras1`
    FOREIGN KEY (`compra_id`)
    REFERENCES `world_computer`.`compras` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`roles` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`usuarios` (
  `id` INT NOT NULL,
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
    REFERENCES `world_computer`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`permisos` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL UNIQUE,
  `descripcion` VARCHAR(45) NULL,
  `estatus` VARCHAR(15) NULL DEFAULT 'ACTIVO',

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`rol_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`rol_permiso` (
  `rol_id` INT NOT NULL,
  `permiso_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rol_id`, `permiso_id`),
  CONSTRAINT `fk_roles_has_permisos_roles1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `world_computer`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permisos_permisos1`
    FOREIGN KEY (`permiso_id`)
    REFERENCES `world_computer`.`permisos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`entradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`entradas` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`salidas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`salidas` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`detalle_salida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`detalle_salida` (
  `id` INT NOT NULL,
  `cantidad` DOUBLE NOT NULL,
  `precio` VARCHAR(45) NOT NULL,
  `producto_id` INT NOT NULL,
  `salida_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_descargo_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `world_computer`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_descargo_descargos1`
    FOREIGN KEY (`salida_id`)
    REFERENCES `world_computer`.`salidas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`detalle_entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`detalle_entrada` (
  `id` INT NOT NULL,
  `cantidad` DOUBLE NULL,
  `costo` DOUBLE NULL,
  `producto_id` INT NOT NULL,
  `entrada_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_cargo_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `world_computer`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_cargo_cargos1`
    FOREIGN KEY (`entrada_id`)
    REFERENCES `world_computer`.`entradas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`servicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`servicios` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`empleados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`empleados` (
  `id` INT NOT NULL,
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
-- Table `world_computer`.`servicio_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`servicio_venta` (
  `id` INT NOT NULL,
  `cantidad` DOUBLE NOT NULL,
  `precio` DOUBLE NOT NULL,
  `empleado_id` INT NOT NULL,
  `venta_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_servicios_has_ventas_servicios1`
    FOREIGN KEY (`id`)
    REFERENCES `world_computer`.`servicios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicios_has_ventas_ventas1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `world_computer`.`ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicio_venta_empleados1`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `world_computer`.`empleados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `world_computer`.`bitacora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `world_computer`.`bitacora` (
  `id` INT NOT NULL,
  `fecha` DATETIME NULL,
  `modulo` VARCHAR(45) NULL,
  `accion` VARCHAR(45) NULL,
  `usuario_id` INT NOT NULL,

  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_bitacora_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `world_computer`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- USUARIO
INSERT INTO usuarios(documento, nombre, apellido, direccion, telefono, email, usuario, password, estatus)
VALUES ('V-00000000', 'ADMINISTRADOR', 'ADMINISTRADOR', 'HIDROPARTS','000-0000000', 'administrador@email.com', 'administrador', 'bWxzUFhsenNNTERQQUdXY21odG0rdz09', 'ACTIVO');

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
INSERT INTO modelos(id_marcas, nombre, estatus) VALUES
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

INSERT INTO productos(categoria_id, unidad_id, codigo, nombre, precio_porcentaje) VALUES 
('3', '1', 'P456125', 'ROUTER 3400', '30'),
('3', '1', 'P456123', 'MODEM-ROUTER AJ300', '30'),
('3', '1', 'P456154', 'ANTENA KE444', '30'),
('2', '1', 'P456165', 'CAMARA AL300', '30'),
('2', '1', 'P456187', 'ADAPTADOR 30K', '30');

/* Roles */
INSERT INTO roles(nombre, descripcion) VALUES ('super admin', 'todos los permisos del sistema');

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
('1','23');
