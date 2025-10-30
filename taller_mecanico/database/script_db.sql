CREATE DATABASE IF NOT EXISTS gestion_de_talleres CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_de_talleres;

CREATE TABLE clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(50),
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(50),
    direccion VARCHAR(255),
    correo VARCHAR(255) UNIQUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE empleados (
    empleado_id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(50),
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(50),
    rol VARCHAR(100),
    taller_id INT,
    correo VARCHAR(255),
    fecha_ingreso DATE,
    activo TINYINT(1) DEFAULT 1
);

CREATE TABLE talleres (
    taller_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    ubicacion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(255),
    horario VARCHAR(100)
);

ALTER TABLE empleados
ADD CONSTRAINT fk_empleado_taller FOREIGN KEY (taller_id) REFERENCES talleres(taller_id) ON DELETE SET NULL;

CREATE TABLE vehiculos (
    vehiculo_id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(50) NOT NULL,
    modelo VARCHAR(100),
    ano SMALLINT,
    color VARCHAR(50),
    cliente_id INT NOT NULL,
    vin VARCHAR(50),
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id) ON DELETE CASCADE
);

CREATE TABLE repuestos (
    repuesto_id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion_repuesto VARCHAR(255) NOT NULL,
    categoria VARCHAR(100),
    precio DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    cantidad INT NOT NULL DEFAULT 0,
    reorder_threshold INT DEFAULT 5
);

CREATE TABLE ordenes (
    orden_id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion_orden TEXT,
    taller_id INT,
    cliente_id INT NOT NULL,
    vehiculo_id INT,
    fecha DATE,
    estado ENUM('activa','espera','finalizada') DEFAULT 'espera',
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(vehiculo_id) ON DELETE SET NULL,
    FOREIGN KEY (taller_id) REFERENCES talleres(taller_id) ON DELETE SET NULL
);

CREATE TABLE reportes_ventas (
    reporte_id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE DEFAULT (CURRENT_DATE()),
    total DECIMAL(12,2),
    clientes_nuevos INT,
    repuestos_ordenados INT,
    taller_id INT,
    FOREIGN KEY (taller_id) REFERENCES talleres(taller_id) ON DELETE SET NULL
);

CREATE TABLE citas (
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    vehiculo_id INT,
    taller_id INT,
    fecha_hora DATETIME,
    estado ENUM('programada','confirmada','finalizada','cancelada') DEFAULT 'programada',
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(vehiculo_id) ON DELETE SET NULL,
    FOREIGN KEY (taller_id) REFERENCES talleres(taller_id) ON DELETE SET NULL
);

CREATE TABLE configuracion (
    config_id INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(100) UNIQUE,
    valor TEXT,
    descripcion VARCHAR(255),
    actualizado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin','empleado','cliente') DEFAULT 'cliente',
    cliente_id INT NULL,
    empleado_id INT NULL,
    activo TINYINT(1) DEFAULT 1,
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id) ON DELETE SET NULL,
    FOREIGN KEY (empleado_id) REFERENCES empleados(empleado_id) ON DELETE SET NULL
);

-- Clientes atendidos este mes
CREATE OR REPLACE VIEW vw_clientes_mes AS
SELECT COUNT(DISTINCT cliente_id) AS clientes_atendidos
FROM ordenes
WHERE estado='finalizada'
AND MONTH(fecha)=MONTH(CURRENT_DATE())
AND YEAR(fecha)=YEAR(CURRENT_DATE());

-- Estado de órdenes
CREATE OR REPLACE VIEW vw_estado_ordenes AS
SELECT estado, COUNT(*) AS total
FROM ordenes
GROUP BY estado;

-- Ingresos mensuales
CREATE OR REPLACE VIEW vw_ingresos_mensuales AS
SELECT SUM(total) AS total_ingresos
FROM reportes_ventas
WHERE MONTH(fecha)=MONTH(CURRENT_DATE())
AND YEAR(fecha)=YEAR(CURRENT_DATE());

-- Repuestos con bajo stock
CREATE OR REPLACE VIEW vw_repuestos_bajo_stock AS
SELECT * FROM repuestos WHERE cantidad <= reorder_threshold;

-- Próximas citas
CREATE OR REPLACE VIEW vw_proximas_citas AS
SELECT c.cita_id, cl.nombre, cl.apellido, v.matricula, c.fecha_hora, c.estado
FROM citas c
JOIN clientes cl ON c.cliente_id = cl.cliente_id
LEFT JOIN vehiculos v ON c.vehiculo_id = v.vehiculo_id
WHERE c.fecha_hora >= NOW()
ORDER BY c.fecha_hora ASC;

