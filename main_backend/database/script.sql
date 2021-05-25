DROP DATABASE Dendo_jitensha;
CREATE DATABASE Dendo_jitensha;
USE Dendo_jitensha;

CREATE TABLE Users(
   id_user INT NOT NULL AUTO_INCREMENT,
   lastname VARCHAR(50) NOT NULL,
   firstname VARCHAR(50) NOT NULL,
   mail_address VARCHAR(100) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL,
   date_created_user DATETIME,
   date_modified_user DATETIME,
   PRIMARY KEY(id_user)
);

CREATE TABLE Addresses(
   id_user INT,
   id_address INT NOT NULL AUTO_INCREMENT,
   number VARCHAR(10),
   street VARCHAR(100),
   city VARCHAR(50),
   postal_code VARCHAR(10),
   PRIMARY KEY(id_address),
   FOREIGN KEY(id_user) REFERENCES Users(id_user)
);

CREATE TABLE Type_of_product(
   id_type_product INT NOT NULL AUTO_INCREMENT,
   type_product VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_type_product)
);

CREATE TABLE Orders(
   id_user INT,
   id_order INT NOT NULL AUTO_INCREMENT,
   order_status VARCHAR(50) NOT NULL,
   date_created_order DATETIME NOT NULL,
   date_modified_order DATETIME,
   amount_order DECIMAL(8,2),
   numberadress_order VARCHAR(5),
   streetadress_order VARCHAR(50),
   cityadress_order VARCHAR(30),
   postalcode_order VARCHAR(10),
   firstname_bill VARCHAR(50),
   lastname_bill VARCHAR(50),
   adress_bill VARCHAR(100),
   amount_bill DECIMAL(10,2),
   PRIMARY KEY(id_order),
   FOREIGN KEY(id_user) REFERENCES Users(id_user)
);

CREATE TABLE IF NOT EXISTS Baskets(
    idBaskets INT NOT NULL AUTO_INCREMENT,
    productName VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price FLOAT NOT NULL,
    fk_idUsers INT NOT NULL,
    id_product INT,
    id_type_product INT,
    PRIMARY KEY (idBaskets),
    FOREIGN KEY (fk_idUsers) REFERENCES Users(id_user)
);

CREATE TABLE Payments(
   id_user INT,
   id_order INT,
   id_payment INT NOT NULL AUTO_INCREMENT,
   date_payment VARCHAR(50),
   date_created_payment DATETIME NOT NULL,
   amount_payment INT NOT NULL,
   payment_status VARCHAR(50),
   PRIMARY KEY(id_payment),
   FOREIGN KEY(id_user) REFERENCES Users(id_user),
   FOREIGN KEY(id_order) REFERENCES Orders(id_order)
);

CREATE TABLE Products(
   id_type_product INT,
   id_product INT NOT NULL AUTO_INCREMENT,
   name_product VARCHAR(50) NOT NULL,
   description_product VARCHAR(255),
   autonomy VARCHAR(20),
   motor VARCHAR(20),
   battery VARCHAR(20),
   price_product DECIMAL(8,2) NOT NULL,
   picture_product VARCHAR(255),
   date_created_product DATETIME,
   date_modified_product DATETIME,
   brand VARCHAR(50),
   stock INT,
   PRIMARY KEY(id_product),
   FOREIGN KEY(id_type_product) REFERENCES Type_of_product(id_type_product)
);

CREATE TABLE Favorites(
   fk_id_user INT,
   id_product INT,
   id_favorite INT NOT NULL AUTO_INCREMENT,
   PRIMARY KEY(id_favorite),
   FOREIGN KEY(id_product) REFERENCES Products(id_product),
   FOREIGN KEY(fk_id_user) REFERENCES Users(id_user)
);

CREATE TABLE Orders_lines(
   id_user INT,
   id_order INT,
   id_order_line INT NOT NULL AUTO_INCREMENT,
   date_created_order_line DATETIME,
   date_modifed_order_line DATETIME,
   id_type_product INT,
   id_product INT,
   product_name VARCHAR(100),
   unitPrice DECIMAL(8,2) NOT NULL,
   totalPrice DECIMAL(8,2) NOT NULL,
   quantity INT,
   PRIMARY KEY(id_order_line),
   FOREIGN KEY(id_order) REFERENCES Orders(id_order),
   FOREIGN KEY(id_user) REFERENCES Users(id_user),
   FOREIGN KEY(id_product) REFERENCES Products(id_product),
   FOREIGN KEY(id_type_product) REFERENCES Type_of_product(id_type_product)
);

CREATE TABLE Comments(
   id_comment INT NOT NULL AUTO_INCREMENT,
   id_product INT,
   username VARCHAR(255),
   comment TEXT,
   date DATETIME,
   PRIMARY KEY(id_comment)
);