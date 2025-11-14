drop database if exists wallabook;
create database wallabook;
use wallabook;

create table usuarios(
	id int primary key auto_increment,
	email varchar(255) unique not null, -- Unique indica que es clave alternativa
    ps blob not null,
    nombre varchar(255) not null,
    perfil enum('A','U') not null default 'U'
)engine innodb;
insert into usuarios values (default,'rosa@educarex.es',sha2('admin',512),'Administrador','A');

create table libros(
	id int primary key auto_increment,
    fechaC datetime not null,
    isbn varchar(100) not null,
    titulo varchar(100) not null,
    autor varchar(100) not null,
    descripcion varchar(255) not null,
    carpetaS3Fotos varchar(255),
    estado enum ('Disponible', 'Reservado', 'Vendido') not null default 'Disponible',
    precio float not null,
    vendedor int not null,
    comprador int null,
    foreign key (vendedor) references usuarios(id) on update cascade on delete restrict,
    foreign key (comprador) references usuarios(id) on update cascade on delete restrict
)engine innodb;

create table mensajes(
	id int primary key auto_increment,
    fechaC datetime not null,
    texto varchar(255) not null,
    emisor int not null, 
    libro int not null,
    foreign key (emisor) references usuarios(id) on update cascade on delete restrict,
    foreign key (libro) references libros(id) on update cascade on delete restrict
)

