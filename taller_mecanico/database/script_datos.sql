SELECT * FROM gestion_de_talleres.talleres;
INSERT INTO talleres (nombre, ubicacion, telefono, email, horario, latitude, longitude)
VALUES
('Taller Automotriz La Rápida', 'Col. Florencia Norte, Tegucigalpa', '2234-1122', 'contacto@larapida.com', 'Lun-Sab 8:00am - 5:00pm', 14.091280, -87.185210),
('Mecánica y Servicio El Pistón', 'Barrio Abajo, Comayagüela', '2290-3344', 'servicio@elpiston.com', 'Lun-Vie 8:00am - 4:00pm', 14.071950, -87.206400),
('Centro Automotriz TurboTech', 'Col. Trejo, San Pedro Sula', '2550-7788', 'info@turbotech.com', 'Lun-Sab 9:00am - 6:00pm', 15.503900, -88.030750),
('Servicio Automotriz Los Pro', 'Col. Altamira, Choluteca', '2788-1122', 'lospro@servicios.com', 'Lun-Dom 8:00am - 7:00pm', 13.300500, -87.190900),
('Taller MotorFix', 'Col. Las Uvas, Tegucigalpa', '2233-5566', 'contacto@motorfix.com', 'Lun-Vie 8:00am - 5:00pm', 14.062700, -87.236600),
('Autorepair Express', 'Residencial El Pedregal, Tegucigalpa', '2235-8833', 'info@autorepairexpress.com', 'Lun-Sab 8:00am - 6:00pm', 14.074900, -87.200800),
('ElectroCar Solutions', 'Barrio El Centro, La Ceiba', '2444-4455', 'soporte@electrocar.com', 'Lun-Vie 9:00am - 5:00pm', 15.784100, -86.791300),
('FullService Automotriz', 'Col. Rubén Darío, San Pedro Sula', '2566-7788', 'fullservice@auto.com', 'Lun-Sab 7:00am - 4:00pm', 15.489700, -88.032900),
('Pinturas y Carrocería La Fina', 'Col. Prado Alto, Tegucigalpa', '2211-9900', 'contacto@lafina.com', 'Lun-Sab 8:00am - 5:00pm', 14.111200, -87.184800),
('Diagnóstico Automotriz ProCheck', 'Barrio Guadalupe, Tegucigalpa', '2277-5533', 'procheck@diagnostico.com', 'Lun-Vie 8:00am - 4:00pm', 14.074000, -87.188900);


SELECT * FROM gestion_de_talleres.clientes;
INSERT INTO clientes (dni, nombre, apellido, telefono, direccion, correo)
VALUES
('0801199912345', 'Carlos', 'Ramírez', '9876-1234', 'Col. Florencia Norte, Tegucigalpa', 'carlos.ramirez@example.com'),
('0501199822331', 'María', 'López', '9988-2211', 'Barrio Abajo, Comayagüela', 'maria.lopez@example.com'),
('0801199011223', 'José', 'Martínez', '9456-7890', 'Col. 15 de Septiembre, Tegucigalpa', 'jose.martinez@example.com'),
('0701199512344', 'Ana', 'Hernández', '9123-4567', 'Col. Rubén Darío, San Pedro Sula', 'ana.hernandez@example.com'),
('0501198812345', 'Pedro', 'Gómez', '9345-6678', 'Barrio El Centro, La Ceiba', 'pedro.gomez@example.com'),
('0801199909876', 'Laura', 'Castro', '9877-5432', 'Residencial Las Uvas, Tegucigalpa', 'laura.castro@example.com'),
('0601199701234', 'Daniel', 'Ortega', '9765-3322', 'Col. Trejo, San Pedro Sula', 'daniel.ortega@example.com'),
('0801199523456', 'Sofía', 'Mejía', '9888-1122', 'Col. Altamira, Choluteca', 'sofia.mejia@example.com'),
('0901199312345', 'Ricardo', 'Vargas', '9234-5566', 'Barrio Guadalupe, Tegucigalpa', 'ricardo.vargas@example.com'),
('0801199923456', 'Gabriela', 'Torres', '9654-1234', 'Col. El Prado, Tegucigalpa', 'gabriela.torres@example.com');


SELECT * FROM gestion_de_talleres.vehiculos;
INSERT INTO vehiculos (matricula, modelo, ano, color, cliente_id, vin)
VALUES
('HAA-1234', 'Toyota Corolla', 2015, 'Blanco', 1, '1HGCM82633A004352'),
('HBB-5678', 'Honda Civic', 2018, 'Negro', 2, '2HGFB2F59DH512345'),
('HCC-9101', 'Hyundai Elantra', 2017, 'Rojo', 3, '3N1AB7AP4HY256789'),
('HDD-2345', 'Mazda 3', 2020, 'Azul', 4, 'JM1BN1V79G1234567'),
('HEE-6789', 'Ford Ranger', 2014, 'Plateado', 5, '1FTYR11U44TA56789'),
('HFF-1122', 'Nissan X-Trail', 2019, 'Gris', 6, 'JN8AS5MT9DW987654'),
('HGG-3344', 'Kia Sportage', 2021, 'Blanco', 7, 'KNDPNCAC5M7012345'),
('HHH-5566', 'Toyota Hilux', 2016, 'Azul', 8, 'MR0FX22G701987654'),
('HII-7788', 'Chevrolet Spark', 2013, 'Verde', 9, 'KL8CB6S96ET123456'),
('HJJ-9900', 'Volkswagen Jetta', 2022, 'Negro', 10, '3VW2B7AJ0HM456789');


SELECT * FROM gestion_de_talleres.empleados;
INSERT INTO empleados (dni, nombre, apellido, telefono, rol, taller_id, correo, fecha_ingreso, activo)
VALUES
('0801199011223', 'Luis', 'García', '9876-1122', 'Mecánico General', 1, 'luis.garcia@taller.com', '2023-01-15', 1),
('0701199522334', 'Elena', 'Suazo', '9844-2211', 'Recepcionista', 1, 'elena.suazo@taller.com', '2022-11-10', 1),
('0501198811456', 'Marco', 'Alvarado', '9765-3344', 'Electricista Automotriz', 2, 'marco.alvarado@taller.com', '2023-03-20', 1),
('0801199909988', 'Claudia', 'Mendoza', '9456-7788', 'Administradora', 1, 'claudia.mendoza@taller.com', '2021-07-01', 1),
('0601199723456', 'Jorge', 'Aguilar', '9344-5566', 'Pintor Automotriz', 3, 'jorge.aguilar@taller.com', '2023-06-11', 1),
('0901199312344', 'Diana', 'Pineda', '9234-8899', 'Asistente de Taller', 2, 'diana.pineda@taller.com', '2022-12-04', 1),
('0801199123456', 'Héctor', 'Valle', '9123-3344', 'Técnico en Diagnóstico', 1, 'hector.valle@taller.com', '2024-02-05', 1),
('0701199422113', 'Karen', 'Fuentes', '9654-7788', 'Contadora', 1, 'karen.fuentes@taller.com', '2020-09-25', 1),
('0501198612348', 'Oscar', 'Rivas', '9988-1122', 'Mecánico Diesel', 3, 'oscar.rivas@taller.com', '2023-08-19', 1),
('0801199823457', 'Patricia', 'Zelaya', '9877-2233', 'Supervisora de Taller', 2, 'patricia.zelaya@taller.com', '2021-05-30', 1);


SELECT * FROM gestion_de_talleres.citas; --
INSERT INTO citas (cliente_id, vehiculo_id, taller_id, fecha_hora, estado)
VALUES
(1, 1, 1, '2025-11-18 09:00:00', 'programada'),
(2, 2, 2, '2025-11-18 10:30:00', 'confirmada'),
(3, 3, 3, '2025-11-18 14:00:00', 'programada'),
(4, 4, 1, '2025-11-19 08:00:00', 'finalizada'),
(5, 5, 3, '2025-11-19 11:15:00', 'cancelada'),
(6, 6, 2, '2025-11-19 15:45:00', 'confirmada'),
(7, 7, 3, '2025-11-20 09:30:00', 'programada'),
(8, 8, 1, '2025-11-20 13:00:00', 'finalizada'),
(9, 9, 2, '2025-11-21 10:00:00', 'confirmada'),
(10, 10, 1, '2025-11-21 16:00:00', 'programada');


SELECT * FROM gestion_de_talleres.ordenes;
INSERT INTO ordenes (descripcion_orden, taller_id, cliente_id, vehiculo_id, fecha, estado)
VALUES
('Cambio de aceite y filtro', 1, 1, 1, '2025-11-10', 'finalizada'),
('Revisión de frenos y pastillas', 2, 2, 2, '2025-11-12', 'activa'),
('Alineación y balanceo de ruedas', 3, 3, 3, '2025-11-14', 'espera'),
('Reparación de sistema eléctrico', 1, 4, 4, '2025-11-15', 'activa'),
('Cambio de batería y limpieza de terminales', 3, 5, 5, '2025-11-16', 'finalizada'),
('Revisión de suspensión y amortiguadores', 2, 6, 6, '2025-11-17', 'espera'),
('Reparación de radiador y sistema de enfriamiento', 3, 7, 7, '2025-11-18', 'activa'),
('Cambio de correa de distribución', 1, 8, 8, '2025-11-19', 'finalizada'),
('Mantenimiento general y lavado completo', 2, 9, 9, '2025-11-20', 'espera'),
('Diagnóstico de motor y chequeo completo', 1, 10, 10, '2025-11-21', 'activa');


SELECT * FROM gestion_de_talleres.repuestos;
INSERT INTO repuestos (descripcion_repuesto, categoria, precio, cantidad, reorder_threshold)
VALUES
('Filtro de aceite Toyota', 'Filtros', 180.00, 100, 5),
('Bujías NGK Iridium', 'Encendido', 350.00, 100, 10),
('Pastillas de freno delanteras Honda Civic', 'Frenos', 820.00, 100, 5),
('Batería 12V 600CCA', 'Eléctrico', 2400.00, 100, 3),
('Aceite sintético 5W-30 1L', 'Lubricantes', 320.00, 100, 20),
('Filtro de aire Hyundai Elantra', 'Filtros', 210.00, 100, 5),
('Amortiguador delantero Toyota Hilux', 'Suspensión', 1850.00, 100, 4),
('Bandas de freno traseras Nissan', 'Frenos', 740.00, 100, 6),
('Radiador Kia Sportage', 'Sistema de enfriamiento', 3100.00, 100, 2),
('Correa de distribución Mazda 3', 'Motor', 1350.00, 100, 5);


SELECT * FROM gestion_de_talleres.reportes_ventas;
INSERT INTO reportes_ventas (fecha, total, clientes_nuevos, repuestos_ordenados, taller_id)
VALUES
('2025-11-01', 12500.00, 5, 20, 1),
('2025-11-02', 9800.00, 3, 15, 2),
('2025-11-03', 14350.50, 6, 25, 3),
('2025-11-04', 11200.00, 4, 18, 1),
('2025-11-05', 15780.75, 7, 30, 2),
('2025-11-06', 13450.00, 5, 22, 3),
('2025-11-07', 12100.25, 4, 17, 1),
('2025-11-08', 16500.00, 8, 32, 2),
('2025-11-09', 13820.50, 6, 24, 3),
('2025-11-10', 14950.00, 5, 20, 1);


SELECT * FROM gestion_de_talleres.configuracion;
INSERT INTO configuracion (clave, valor, descripcion)
VALUES
('nombre_sistema', 'Gestión de Talleres Pro', 'Nombre del sistema mostrado en la interfaz'),
('horario_atencion', 'Lun-Vie 8:00-17:00, Sab 8:00-12:00', 'Horario de atención al cliente'),
('iva', '15', 'Porcentaje de IVA aplicado a repuestos y servicios'),
('moneda', 'Lempira', 'Moneda utilizada en el sistema'),
('max_citas_dia', '20', 'Número máximo de citas por día por taller'),
('correo_admin', 'admin@taller.com', 'Correo electrónico del administrador'),
('recordatorio_citas', '1', 'Enviar recordatorio de cita 1 día antes (1=Sí, 0=No)'),
('reorden_default', '5', 'Cantidad mínima de repuestos antes de generar alerta de reorden'),
('modo_mantenimiento', '0', 'Indica si el sistema está en mantenimiento (1=Sí, 0=No)'),
('notificaciones', '1', 'Activar notificaciones por correo para clientes y empleados (1=Sí, 0=No)');


SELECT * FROM gestion_de_talleres.usuarios;--
INSERT INTO usuarios (email, password_hash, rol, cliente_id, empleado_id, activo)
VALUES
('carlos.ramirez@example.com', '123456', 'cliente', 1, NULL, 1),
('maria.lopez@example.com', '123456', 'cliente', 2, NULL, 1),
('jose.martinez@example.com', '123456', 'cliente', 3, NULL, 1),
('ana.hernandez@example.com', '123456', 'cliente', 4, NULL, 1),
('pedro.gomez@example.com', '123456', 'cliente', 5, NULL, 1),

('luis.garcia@taller.com', '1234567', 'Empleado', NULL, 42, 1),
('elena.suazo@taller.com', '1234567', 'Empleado', NULL, 43, 1),
('marco.alvarado@taller.com', '1234567', 'Empleado', NULL, 44, 1),
('claudia.mendoza@taller.com', 'CLA1234567', 'Empleado', NULL, 45, 1),
('jorge.aguilar@taller.com', '1234567', 'Empleado', NULL, 46, 1),
('diana.pineda@taller.com', '1234567', 'Empleado', NULL, 47, 1),
('hector.valle@taller.com', '1234567', 'Empleado', NULL, 48, 1),
('karen.fuentes@taller.com', '1234567', 'Empleado', NULL, 49, 1),

('admin@taller.com', 'admin123', 'admin', NULL, NULL, 1);

