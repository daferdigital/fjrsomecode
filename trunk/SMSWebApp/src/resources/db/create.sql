CREATE TABLE PERFIL(
    id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY (START WITH 1, INCREMENT BY 1),
    nombre varchar(50) NOT NULL,
    descripcion varchar(250) NOT NULL,
    CONSTRAINT primary_key PRIMARY KEY (id)
);

CREATE TABLE mensajes (
    id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY (START WITH 1, INCREMENT BY 1),
    fecha_recibido date NOT NULL,
    number_from VARCHAR(50) NOT NULL,
    message_value VARCHAR(1024) NOT NULL,
    CONSTRAINT primary_key PRIMARY KEY (id)
);

CREATE TABLE version (
    code VARCHAR(10) NOT NULL,
    fecha_instalacion DATE NOT NULL
);