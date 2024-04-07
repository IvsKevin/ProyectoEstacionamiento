CREATE DATABASE estacionamiento;
USE estacionamiento;

-- Empezamos a crear las tablas
CREATE TABLE User (
    pk_user INT AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(30),
    last_name varchar(30),
    password varchar(30) not null,
    email varchar(30) unique not null,
    nickname varchar(15) unique not null,
    category char(1) not null,
    accessCode varchar(10)
);
-- INSERCCIONES A LA TABLA USUARIOS.
INSERT INTO User (first_name, last_name, password, email, nickname, category, accessCode)
VALUES (null, null, 'kevin12', 'kevin12@gmail.com', 'Kevin12', 'A', '123'); 

CREATE TABLE General_Status (
    pk_status INT AUTO_INCREMENT PRIMARY KEY,
    status_name varchar(10)
); 
-- INSERCCIONES A NUESTRA TABLA GLOBAL DE STATUS.
INSERT INTO General_Status (status_name)
VALUES ('Activo'), ('Inactivo');

CREATE TABLE License (
    pk_license INT AUTO_INCREMENT PRIMARY KEY,
    license_name varchar(30) not null,
    license_description varchar(70),
    fk_status int,
    FOREIGN KEY (fk_status) REFERENCES General_Status (pk_status)
);
-- INSERCCIONES DE NUESTRAS LICENCIAS DE USO
INSERT INTO License(license_name, license_description, fk_status) 
VALUES
('Licencia Basica', 'Esta es una licencia basica que gestiona los espacios', 1),
('Licencia Regular', 'Esta es una licencia regular que gestiona los espacios y tiene soporte 24/7', 1),
('Licencia Pro', 'Esta es una licencia pro gestion de espacios, soporte, seguridad y licencia premium', 1);

CREATE TABLE Duration (
    pk_duration INT AUTO_INCREMENT PRIMARY KEY,
    duration_name varchar(30) not null,
    duration_days int not null,
    duration_cost int not null,
    fk_license int not null,
    FOREIGN KEY (fk_license) REFERENCES License (pk_license)
);
-- INSERCCIONES DE LAS DURACIONES DE CADA LICENCIA
INSERT INTO Duration (duration_name, duration_days, duration_cost, fk_license)
VALUES
('Licencia Basica 30 dias', 30, 200, 1),
('Licencia Basica 90 dias', 90, 550, 1),
('Licencia Basica 180 dias', 180, 1000, 1),
('Licencia Basica 365 dias', 365, 1900, 1),
('Licencia Regular 30 dias', 30, 350, 2),
('Licencia Regular 90 dias', 90, 800, 2),
('Licencia Regular 180 dias', 180, 1500, 2),
('Licencia Regular 365 dias', 365, 2700, 2),
('Licencia Pro 30 dias', 30, 500, 3),
('Licencia Pro 90 dias', 90, 1200, 3),
('Licencia Pro 180 dias', 180, 2100, 3),
('Licencia Pro 365 dias', 365, 3200, 3);


CREATE TABLE Client (
    pk_client INT AUTO_INCREMENT PRIMARY KEY,
    client_name varchar(50) not null,
    client_email varchar(30) not null,
    client_address varchar(50) not null,
    client_country varchar(30) not null,
    client_city varchar(30) not null,
    client_state varchar(30) not null,
    client_zip_code smallint(5) not null,
    client_tel varchar(15) not null,
    fk_user INT,
    fk_status INT,
    FOREIGN KEY (fk_user) REFERENCES User(pk_user),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status)
);
INSERT INTO Client (client_name, client_email, client_address, client_country, client_city, client_state, client_zip_code, client_tel, fk_user, fk_status) 
VALUES ('Kevin', 'kevin@gmail.com', 'A', 'Mexico', 'Baja California', 'Tijuana', 22245, '664 326 263', 1, 1);


CREATE TABLE Client_Phones (
    pk_CP int AUTO_INCREMENT PRIMARY KEY,
    phone_number varchar(15) not null,
    fk_client int not null,
    FOREIGN KEY (fk_client) REFERENCES Client (pk_client)
);

CREATE TABLE Payment_Method (
    pk_method int AUTO_INCREMENT PRIMARY KEY,
    method_name varchar(30) not null,
    method_description varchar(50)
);
-- INSERCCIONES A LOS METODOS DE PAGO
INSERT INTO Payment_Method (method_name, method_description) 
VALUES 
('Tarjeta de debito', null),
('Tarjeta de credito', null),
('Transferencia', null),
('Efectivo', null);

CREATE TABLE Payment_Status (
    pk_paymentStatus int AUTO_INCREMENT PRIMARY KEY,
    paymentStatus_name varchar(30) not null
);
-- INSERCCIONES DEL STATUS DE LOS PAGOS.
INSERT INTO Payment_Status (paymentStatus_name)
VALUES 
('Aprobado'),
('En proceso'),
('Rechazado');

CREATE TABLE Payment (
    pk_payment int AUTO_INCREMENT PRIMARY KEY,
    payment_amount DECIMAL(6,2) not null,
    payment_description varchar(50) not null,
    payment_date DATETIME not null, 
    fk_duration int,
    fk_method int,
    fk_paymentStatus int,
    fk_client int,
    FOREIGN KEY (fk_duration) REFERENCES Duration (pk_duration),
    FOREIGN KEY (fk_method) REFERENCES Payment_Method (pk_method),
    FOREIGN KEY (fk_paymentStatus) REFERENCES Payment_Status (pk_paymentStatus),
    FOREIGN KEY (fk_client) REFERENCES Client (pk_client)
);

CREATE TABLE Earning (
    pk_earning int AUTO_INCREMENT PRIMARY KEY,
    earning_amount DECIMAL(10, 4) not null,
    earning_date DATE not null,
    fk_payment int,
    FOREIGN KEY (fk_payment) REFERENCES Payment (pk_payment)
);

CREATE TABLE Licenses_Duration (
    pk_LD int AUTO_INCREMENT PRIMARY KEY,
    LD_start_date DATETIME not null,
    LD_end_date DATETIME not null,
    accessCode VARCHAR(10) not null,
    fk_duration int,
    fk_payment int, 
    fk_status int,
    FOREIGN KEY (fk_duration) REFERENCES Duration (pk_duration),
    FOREIGN KEY (fk_payment) REFERENCES Payment (pk_payment),
    FOREIGN KEY (fk_status) REFERENCES General_Status (pk_status)
);
INSERT INTO Licenses_Duration (LD_start_date, LD_end_date, accessCode, fk_duration, fk_payment, fk_status) 
VALUES ('','', '123', 1, null, 1);

CREATE TABLE Rol (
    pk_rol INT AUTO_INCREMENT PRIMARY KEY,
    rol_name VARCHAR(20) NOT NULL
);
-- INSERCIONES DE ROLES PARA NUESTRO EMPLEADOS.
INSERT INTO Rol (rol_name)
VALUES 
('Gerente de planta'), 
('Gerente de produccion'), 
('Gerente de recursos humanos'), 
('Secretaria'),
('Supervisor'),
('Empleado'),
('Administrador'),
('Recursos Humanos'),
('Finanzas'),
('Mantenimiento'),
('Seguridad'),
('Maquinado');

CREATE TABLE Employee (
    pk_employee int AUTO_INCREMENT PRIMARY KEY,
    employee_name varchar(30) not null,
    employee_lastNameP varchar(30),
    employee_lastNameM varchar(30),
    fk_client int,
    fk_status int,
    fk_rol int,
    FOREIGN KEY (fk_client) REFERENCES Client(pk_client),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status),
    FOREIGN KEY (fk_rol) REFERENCES Rol(pk_rol)
);

ALTER TABLE employee
ADD tel varchar(10);

CREATE TABLE Brand (
    pk_brand INT AUTO_INCREMENT PRIMARY KEY,
    brand_name varchar(15) not null
);
-- INSERCCIONES A LA TABLA BRAND
INSERT INTO Brand (brand_name) VALUES ('Toyota');
INSERT INTO Brand (brand_name) VALUES ('Ford');
INSERT INTO Brand (brand_name) VALUES ('Chevrolet');
INSERT INTO Brand (brand_name) VALUES ('Honda');
INSERT INTO Brand (brand_name) VALUES ('Nissan');
INSERT INTO Brand (brand_name) VALUES ('Volkswagen');
INSERT INTO Brand (brand_name) VALUES ('BMW');
INSERT INTO Brand (brand_name) VALUES ('Mercedes-Benz');
INSERT INTO Brand (brand_name) VALUES ('Audi');

CREATE TABLE Model_Color (
    pk_color INT AUTO_INCREMENT PRIMARY KEY,
    model_color VARCHAR(15) not null
);
-- INSERCCIONES A LA TABLA MODEL_COLOR
INSERT INTO Model_Color (model_color) VALUES ('Rojo');
INSERT INTO Model_Color (model_color) VALUES ('Azul');
INSERT INTO Model_Color (model_color) VALUES ('Verde');
INSERT INTO Model_Color (model_color) VALUES ('Amarillo');
INSERT INTO Model_Color (model_color) VALUES ('Negro');
INSERT INTO Model_Color (model_color) VALUES ('Blanco');
INSERT INTO Model_Color (model_color) VALUES ('Naranja');
INSERT INTO Model_Color (model_color) VALUES ('Gris');

CREATE TABLE Model (
    pk_model INT AUTO_INCREMENT PRIMARY KEY,
    model_name varchar(20) not null,
    fk_brand INT,
    FOREIGN KEY (fk_brand) REFERENCES Brand(pk_brand)
);
-- INSERCCIONES A LA TABLA MODEL
-- Marca: Toyota.
INSERT INTO Model (model_name, fk_brand) VALUES ('Corolla', 1);
INSERT INTO Model (model_name, fk_brand) VALUES ('Camry', 1);
-- Marca: Ford
INSERT INTO Model (model_name, fk_brand) VALUES ('F-150', 2);
INSERT INTO Model (model_name, fk_brand) VALUES ('Mustang', 2);
-- Marca: Chevrolet
INSERT INTO Model (model_name, fk_brand) VALUES ('Silverado', 3);
INSERT INTO Model (model_name, fk_brand) VALUES ('Malibu', 3);
-- Marca: Honda
INSERT INTO Model (model_name, fk_brand) VALUES ('Civic', (SELECT pk_brand FROM Brand WHERE brand_name = 'Honda'));
INSERT INTO Model (model_name, fk_brand) VALUES ('Accord', (SELECT pk_brand FROM Brand WHERE brand_name = 'Honda'));

-- Marca: Nissan
INSERT INTO Model (model_name, fk_brand) VALUES ('Sentra', (SELECT pk_brand FROM Brand WHERE brand_name = 'Nissan'));
INSERT INTO Model (model_name, fk_brand) VALUES ('Altima', (SELECT pk_brand FROM Brand WHERE brand_name = 'Nissan'));

-- Marca: Volkswagen
INSERT INTO Model (model_name, fk_brand) VALUES ('Golf', (SELECT pk_brand FROM Brand WHERE brand_name = 'Volkswagen'));
INSERT INTO Model (model_name, fk_brand) VALUES ('Passat', (SELECT pk_brand FROM Brand WHERE brand_name = 'Volkswagen'));

-- Marca: BMW
INSERT INTO Model (model_name, fk_brand) VALUES ('Serie 3', (SELECT pk_brand FROM Brand WHERE brand_name = 'BMW'));
INSERT INTO Model (model_name, fk_brand) VALUES ('Serie 5', (SELECT pk_brand FROM Brand WHERE brand_name = 'BMW'));

-- Marca: Mercedes-Benz
INSERT INTO Model (model_name, fk_brand) VALUES ('Clase C', (SELECT pk_brand FROM Brand WHERE brand_name = 'Mercedes-Benz'));
INSERT INTO Model (model_name, fk_brand) VALUES ('Clase E', (SELECT pk_brand FROM Brand WHERE brand_name = 'Mercedes-Benz'));

-- Marca: Audi
INSERT INTO Model (model_name, fk_brand) VALUES ('A4', (SELECT pk_brand FROM Brand WHERE brand_name = 'Audi'));
INSERT INTO Model (model_name, fk_brand) VALUES ('A6', (SELECT pk_brand FROM Brand WHERE brand_name = 'Audi'));

CREATE TABLE Car_Information (
    pk_car INT AUTO_INCREMENT PRIMARY KEY,
    matricula varchar(7) not null,
    model_year int not null,
    fk_employee INT,
    fk_model INT,
    fk_color int,
    fk_status INT,
    fk_client INT,
    FOREIGN KEY (fk_employee) REFERENCES Employee(pk_employee),
    FOREIGN KEY (fk_model) REFERENCES Model(pk_model),
    FOREIGN KEY (fk_color) REFERENCES Model_Color(pk_color),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status),
    FOREIGN KEY (fk_client) REFERENCES Client(pk_client)
);

CREATE TABLE Visit (
    pk_visit INT AUTO_INCREMENT PRIMARY KEY,
    visit_company VARCHAR(50) not null,
    visit_reason VARCHAR(50),
    visit_name VARCHAR(30) not null,
    visit_lastName VARCHAR(30),
    fk_client INT,
    fk_status INT,
    FOREIGN KEY (fk_client) REFERENCES Client(pk_client),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status)
);



CREATE TABLE Access_Card (
    pk_card INT AUTO_INCREMENT PRIMARY KEY,
    QR_code VARCHAR(12),
    card_creation_date DATETIME NOT NULL,
    card_end_date DATETIME NOT NULL,
    card_type VARCHAR(12) NOT NULL,
    fk_employee INT,
    fk_visit INT,
    fk_status INT,
    FOREIGN KEY (fk_employee) REFERENCES Employee(pk_employee),
    FOREIGN KEY (fk_visit) REFERENCES Visit(pk_visit),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status)
);

CREATE TABLE Parking (
    pk_parking INT AUTO_INCREMENT PRIMARY KEY,
    parking_number INT NOT NULL,
    parking_location VARCHAR(50) NOT NULL,
    parking_capacity INT NOT NULL,
    fk_client INT,
    fk_status INT,
    FOREIGN KEY (fk_client) REFERENCES Client(pk_client),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status)
);

CREATE TABLE Parking_Spaces (
    pk_spaces INT AUTO_INCREMENT PRIMARY KEY,
    spaces_number INT NOT NULL,
    fk_status INT,
    fk_employee INT,
    fk_visit INT,
    fk_parking INT,
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status),
    FOREIGN KEY (fk_employee) REFERENCES Employee(pk_employee),
    FOREIGN KEY (fk_parking) REFERENCES Parking(pk_parking)
);
CREATE TABLE Check_In_Out (
    pk_check INT AUTO_INCREMENT PRIMARY KEY,
    date_in DATETIME NOT NULL,
    date_out DATETIME,
    fk_parking INT,
    fk_card INT,
    fk_space INT,
    fk_status INT,
    FOREIGN KEY (fk_parking) REFERENCES Parking(pk_parking),
    FOREIGN KEY (fk_card) REFERENCES Access_Card(pk_card),
    FOREIGN KEY (fk_space) REFERENCES Parking_Spaces(pk_spaces),
    FOREIGN KEY (fk_status) REFERENCES General_Status(pk_status)
);

CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text TEXT not null,
    user varchar(50),
    reply_to INT,
    comment_date DATE not null
);