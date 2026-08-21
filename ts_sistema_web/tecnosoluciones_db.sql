CREATE DATABASE IF NOT EXISTS `tecnosoluciones_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tecnosoluciones_db`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rol` ENUM('administrador', 'empleado') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `rol`) VALUES
(1, 'admin', '$2y$10$mC7p9A2pG7g6eE9J8fK6uO3v9X2y1z5w4q8r7t6y5u4i3o2p1a1s2', 'administrador');

CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `estado` VARCHAR(50) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`),
  KEY `fk_proyectos_usuarios` (`id_usuario`),
  CONSTRAINT `fk_proyectos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `proyectos` (`id`, `id_usuario`, `nombre`, `descripcion`, `fecha_inicio`, `estado`) VALUES
(1, 1, 'Desarrollo Web E-commerce', 'Creación de tienda virtual para venta de productos.', '2026-05-01', 'Pendiente'),
(2, 1, 'Implementación ERP', 'Migración de sistema de inventarios e infraestructura.', '2026-05-15', 'Activo');