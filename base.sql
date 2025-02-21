-- Crear la tabla clientes
CREATE TABLE public.clientes (
    dni VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Crear la tabla vehiculos
CREATE TABLE public.vehiculos (
    patente VARCHAR(7) PRIMARY KEY,
    marca VARCHAR(20) NOT NULL,
    modelo VARCHAR(20) NOT NULL,
    dni_cliente VARCHAR(20) NOT NULL,
    CONSTRAINT fk_cliente FOREIGN KEY (dni_cliente)
        REFERENCES public.clientes (dni)
);

-- Crear la tabla turnos
CREATE TABLE public.turnos (
    id SERIAL PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    patente VARCHAR(7),
    CONSTRAINT fk_patente FOREIGN KEY (patente)
        REFERENCES public.vehiculos (patente)
);

-- Crear la tabla servicios
CREATE TABLE public.servicios (
    id SERIAL PRIMARY KEY,
    descripcion TEXT,
    costo INTEGER NOT NULL
);

-- Crear la tabla servicios_realizados
CREATE TABLE public.servicios_realizados (
    id SERIAL PRIMARY KEY,
    servicios_id INTEGER NOT NULL,
    turnos_id INTEGER NOT NULL,
    notas TEXT,
    CONSTRAINT servicios_realizados_servicios_id_fkey FOREIGN KEY (servicios_id)
        REFERENCES public.servicios (id),
    CONSTRAINT servicios_realizados_turnos_id_fkey FOREIGN KEY (turnos_id)
        REFERENCES public.turnos (id)
);