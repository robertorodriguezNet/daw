-- Archivo para el ejercicio resuelto 2.2.1 en el que se gestiona la bd mediante mysqladmin.

drop database if exists proyecto;

create database proyecto default charset utf8mb4 collate utf8mb4_unicode_ci;

-- Seleccionamos la tabla
use proyecto;

CREATE TABLE if NOT exists tiendas(
    id int AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tlf VARCHAR(13) NULL
);

create table if not exists familias( 
    cod VARCHAR(6) PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL
);

create table if not exists productos(
    id int AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    nombre_corto VARCHAR(50) unique not null,
    descripcion TEXT null,
    pvp DECIMAL(10,2) not null,
    familia VARCHAR(6) not null,
    constraint fk_pro_fam foreign key(familia) references familias(cod) on update cascade on delete cascade
);

create table if not exists stocks(
    producto int,
    tienda int,
    unidades int  unsigned not null,
    constraint pk_stc primary key(producto, tienda),
    constraint fk_stc_prod foreign key(tienda) references tiendas(id) on update cascade on delete cascade
);

-- Usuario
create user admin@'*' identified by "0000";
grant all on *.* to admin@'*';