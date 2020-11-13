CREATE DATABASE desafio;

use desafio;

CREATE TABLE customer (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  client_name varchar(255),
  cpf varchar(14),
  created_at datetime NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  code_product varchar(150),
  product_name varchar(255),
  size varchar(2),
  price float,
  brand_id int(11) NOT NULL,
  created_at datetime NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE brand (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  brand_name varchar(255),
  created_at datetime NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ped (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  code varchar(150),
  customer_id int(11) NOT NULL,
  product_id int(11) NOT NULL,
  amount float,
  date_purchase date,
  created_at datetime NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
/*
CREATE TABLE history (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  ped_id int(11) NOT NULL,
  date_purchase date,
  created_at datetime NOT NULL,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);*/