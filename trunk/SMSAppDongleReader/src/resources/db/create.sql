CREATE TABLE version (
    code VARCHAR(10) NOT NULL,
    fecha_instalacion DATE NOT NULL
);

CREATE TABLE licencia(
    id INTEGER NOT NULL,
    server_code varchar(100) NOT NULL,
    license_code varchar(100),
    PRIMARY KEY (server_code)
);

CREATE TABLE mensajes (
    id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY (START WITH 1, INCREMENT BY 1),
    fecha_recibido date NOT NULL,
    number_from VARCHAR(50) NOT NULL,
    message_value VARCHAR(250) NOT NULL,
    serial VARCHAR(250) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE errores (
    id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY (START WITH 1, INCREMENT BY 1),
    fecha date NOT NULL,
    error VARCHAR(250) NOT NULL,
    PRIMARY KEY (id)
);