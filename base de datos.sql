-- =====================
-- TABLAS DE ADMINISTRACIÓN
-- =====================

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    hash_pass VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE sucursales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    correo VARCHAR(150),
    url_foto VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE admin_sucursal (
    id_admin INT,
    id_sucursal INT,
    PRIMARY KEY (id_admin, id_sucursal),
    FOREIGN KEY (id_admin) REFERENCES administradores(id),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

CREATE TABLE recepcionistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    hash_pass VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    id_sucursal INT NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

-- =====================
-- TABLAS DE CLIENTES Y VETERINARIOS
-- =====================

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    DNI VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    hash_pass VARCHAR(255) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    url_foto VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE veterinarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    DNI VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(150) UNIQUE NOT NULL,
    hash_pass VARCHAR(255) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    url_foto VARCHAR(255),
    id_sucursal INT NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

CREATE TABLE horarios_veterinarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_veterinario INT,
    dia_semana VARCHAR(20),
    hora_inicio TIME,
    hora_fin TIME,
    created_at DATETIME,
    FOREIGN KEY (id_veterinario) REFERENCES veterinarios(id)
);

-- =====================
-- TABLAS DE MASCOTAS Y SERVICIOS
-- =====================

CREATE TABLE mascotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raza VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    sexo ENUM('macho','hembra') NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    id_cliente INT NOT NULL,
    url_foto VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    duracion_min INT NOT NULL DEFAULT 10,
    precio DECIMAL(10,2) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================
-- RELACIÓN VETERINARIO - SERVICIOS
-- =====================

CREATE TABLE veterinario_servicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_veterinario INT NOT NULL,
    id_servicio INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_veterinario) REFERENCES veterinarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES servicios(id) ON DELETE CASCADE,
    -- Un veterinario no puede estar duplicado para el mismo servicio
    UNIQUE KEY unique_veterinario_servicio (id_veterinario, id_servicio)
);

-- =====================
-- TABLAS DE TURNOS
-- =====================

CREATE TABLE turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT NOT NULL,
    id_veterinario INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    estado ENUM('pendiente','cancelado','atendido') NOT NULL,
    creado_por ENUM('cliente','recepcionista') NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    tipo_de_pago ENUM('efectivo','tarjeta','transferencia') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id),
    FOREIGN KEY (id_veterinario) REFERENCES veterinarios(id),
    UNIQUE KEY unique_turno (id_veterinario, fecha_hora)
);

-- =====================
-- TABLAS DE HISTORIALES Y NOTAS
-- =====================

CREATE TABLE historial_clinico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT NOT NULL,
    fecha DATE NOT NULL,
    observaciones TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id)
);

CREATE TABLE historial_vacunacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT NOT NULL,
    id_vacuna INT NOT NULL,
    fecha_aplicada DATE NOT NULL,
    proxima_dosis DATE,
    lote_aplicado VARCHAR(50),
    observaciones TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id),
    FOREIGN KEY (id_vacuna) REFERENCES vacunas(id)
);

CREATE TABLE emergencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Mascota registrada (opcional - si es NULL, usar datos de mascota no registrada)
    id_mascota INT NULL,
    
    -- Datos de mascota NO registrada (solo se usan si id_mascota es NULL)
    nombre_mascota VARCHAR(100),
    especie VARCHAR(50),
    raza VARCHAR(100),
    edad_aproximada VARCHAR(50), -- ej: "2 años", "6 meses", "cachorro"
    sexo ENUM('macho','hembra'),
    peso_aproximado DECIMAL(5,2),
    color VARCHAR(100),
    
    -- Veterinario que atiende (OBLIGATORIO)
    id_veterinario INT NOT NULL,
    
    -- Datos de la emergencia
    fecha_hora_llegada DATETIME NOT NULL,
    motivo_consulta TEXT NOT NULL,
    sintomas_observados TEXT,
    diagnostico TEXT,
    tratamiento_realizado TEXT,
    medicamentos_aplicados TEXT,
    
    -- Estado y seguimiento
    gravedad ENUM('leve','moderada','grave','critica') NOT NULL,
    estado_actual ENUM('en_atencion','estable','critico','recuperado','fallecido') DEFAULT 'en_atencion',
    requiere_internacion BOOLEAN DEFAULT FALSE,
    alta_medica BOOLEAN DEFAULT FALSE,
    fecha_alta DATETIME NULL,
    
    -- Observaciones y notas
    observaciones_veterinario TEXT,
    recomendaciones TEXT,
    
    -- Información de costos
    costo_atencion DECIMAL(10,2) DEFAULT 0,
    
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id) ON DELETE SET NULL,
    FOREIGN KEY (id_veterinario) REFERENCES veterinarios(id),
);

CREATE TABLE internaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT NOT NULL,
    id_veterinario INT NOT NULL, -- Veterinario responsable
    fecha_ingreso DATETIME NOT NULL,
    fecha_alta DATETIME NULL, -- NULL = aún internado
    motivo TEXT NOT NULL, -- Razón de la internación
    estado ENUM('internado','alta') DEFAULT 'internado',
    observaciones TEXT,
    costo_total DECIMAL(10,2) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id),
    FOREIGN KEY (id_veterinario) REFERENCES veterinarios(id)
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_turno INT,
    id_cliente INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comentario TEXT,
    fecha DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_turno) REFERENCES turnos(id),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    comentario TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE
);

-- =====================
-- TABLAS DE INVENTARIO Y PROVEEDORES
-- =====================

CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    contacto VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_barras VARCHAR(50) UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    rubro ENUM('comida','juguetes','muebles','remedios','accesorios','higiene') NOT NULL,
    stock_actual INT DEFAULT 0,
    stock_minimo INT DEFAULT 0,
    precio_costo DECIMAL(10,2) DEFAULT 0,
    precio_venta DECIMAL(10,2) NOT NULL,
    id_proveedor_principal INT,
    id_sucursal INT NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_proveedor_principal) REFERENCES proveedores(id),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

-- =====================
-- TABLA DE VACUNAS 
-- =====================

CREATE TABLE vacunas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    laboratorio VARCHAR(100) NOT NULL,
    especies VARCHAR(200) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock_actual INT DEFAULT 0,
    stock_minimo INT DEFAULT 5,
    fecha_vencimiento DATE,
    lote VARCHAR(50),
    id_sucursal INT NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

-- =====================
-- SISTEMA DE COMPRAS (Administrador al Proveedor)
-- =====================

CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_compra VARCHAR(50) UNIQUE NOT NULL,
    id_proveedor INT NOT NULL,
    id_sucursal INT NOT NULL,
    id_administrador INT NOT NULL,
    fecha_compra DATE NOT NULL,
    total DECIMAL(12,2) DEFAULT 0,
    estado ENUM('pendiente','recibida','cancelada') DEFAULT 'pendiente',
    observaciones TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id),
    FOREIGN KEY (id_administrador) REFERENCES administradores(id)
);

CREATE TABLE detalle_compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_compra INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (id_compra) REFERENCES compras(id) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- =====================
-- SISTEMA DE VENTAS (Recepcionista al Cliente)
-- =====================

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_factura VARCHAR(50) UNIQUE,
    id_cliente INT,
    id_recepcionista INT NOT NULL,
    total DECIMAL(12,2) NOT NULL,
    estado ENUM('preparando','listo','entregado','anulada') DEFAULT 'preparando',
    fecha_venta DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_recepcionista) REFERENCES recepcionistas(id)
);

CREATE TABLE detalle_venta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- =====================
-- SISTEMA DE CAJA (Solo Administradores)
-- =====================

CREATE TABLE cajas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_sucursal INT NOT NULL,
    saldo_actual DECIMAL(12,2) DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id)
);

CREATE TABLE movimientos_caja (
    id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_caja INT NOT NULL,
    id_sucursal INT NOT NULL,
    id_administrador INT NOT NULL,
    tipo_movimiento ENUM('ingreso_venta','egreso_compra','deposito','retiro','ajuste') NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    saldo_anterior DECIMAL(10,2) NOT NULL,
    saldo_nuevo DECIMAL(10,2) NOT NULL,
    descripcion VARCHAR(255) DEFAULT NULL,
    referencia_tabla VARCHAR(50) DEFAULT NULL COMMENT 'ventas, compras, etc.',
    referencia_id INT DEFAULT NULL COMMENT 'ID de la tabla referenciada',
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_caja) REFERENCES cajas(id),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id),
    FOREIGN KEY (id_administrador) REFERENCES administradores(id)
);

-- =====================
-- SISTEMA DE INTERNACIÓN SIMPLE
-- =====================

-- Agregar campo a mascotas para saber si está internada
ALTER TABLE mascotas ADD COLUMN internado BOOLEAN DEFAULT FALSE;
ALTER TABLE mascotas ADD COLUMN fecha_internacion DATETIME NULL;
ALTER TABLE mascotas ADD COLUMN motivo_internacion TEXT NULL;

