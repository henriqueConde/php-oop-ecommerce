CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE users(
id            int(255) auto_increment not null,
first_name    varchar(100) not null,
last_name     varchar(255),
email         varchar(255) not null,
password      varchar(255) not null,
role          varchar(20),
image         varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', '12345', 'admin', NULL);


CREATE TABLE categories(
id            int(255) auto_increment not null,
name    varchar(100) not null,
CONSTRAINT pk_categories PRIMARY KEY(id),
)ENGINE=InnoDb;

INSERT INTO categories VALUES(NULL, 'short sleeve');
INSERT INTO categories VALUES(NULL, 'suspenders');
INSERT INTO categories VALUES(NULL, 'long sleeve');
INSERT INTO categories VALUES(NULL, 'sweatshirts');

CREATE TABLE products(
id            int(255) auto_increment not null,
category_id  int(255) not null,
name          varchar(255) not null,
description   text,
price         float(100,2) not null,
stock         int(255) not null,
discount      varchar(2),
date          date not null,
image         varchar(255),
CONSTRAINT pk_products PRIMARY KEY(id),
CONSTRAINT fk_product_category FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDb;


CREATE TABLE orders(
id            int(255) auto_increment not null,
user_id       int(255) not null,
state         varchar(100) not null,
city          varchar(100) not null,
address       varchar(255) not null,
total_price   float(200,2) not null,
status        varchar(20) not null,
date          date,
time          time,
CONSTRAINT pk_orders PRIMARY KEY(id),
CONSTRAINT fk_order_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;


CREATE TABLE ordersProducts(
id            int(255) auto_increment not null,
order_id      int(255) not null,
product_id    int(255) not null,
unities       int(255) not null,
CONSTRAINT pk_ordersProducts PRIMARY KEY(id),
CONSTRAINT fk_order FOREIGN KEY(order_id) REFERENCES orders(id),
CONSTRAINT fk_product FOREIGN KEY(product_id) REFERENCES products(id)
)ENGINE=InnoDb;