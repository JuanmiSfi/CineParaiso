DROP DATABASE IF EXISTS CineParaiso;
CREATE DATABASE CineParaiso;
use CineParaiso;


Create table rol(
id_rol int PRIMARY KEY,
tipo varchar(50)
);

Create table usuario(
id int PRIMARY KEY auto_increment,
nombre varchar(25) NULL,
apellidos varchar(50) NULL,
usuario varchar(25) NOT NULL,
email varchar(110) ,
contraseña varchar(100) NOT NULL,
bio varchar (200) NULL,
id_rol int DEFAULT 1,
codigo int,
verificado boolean default 0,
fto_perfil varchar(1000) default '/Perfil_usuario/Usuarios.png', 
FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

Create table pelicula(
id int PRIMARY KEY,
titulo varchar(150),
año DATE,
descripcion text,
popularidad int,
poster text
);

Create table genero(
id_genero int PRIMARY KEY,
nombre varchar(250)
);

CREATE TABLE pertenece(
id_pertenece int PRIMARY KEY auto_increment,
id_pelicula int, 
id_genero int,
FOREIGN KEY (id_pelicula) REFERENCES pelicula(id),
FOREIGN KEY (id_genero) REFERENCES genero(id_genero)
);

CREATE TABLE actor(
id_actor int PRIMARY KEY,
genero boolean,
nombre varchar(250) NOT NULL,
fto text,
bio text,
nacimiento DATE,
fallecimiento DATE NULL,
lugar_de_nacimiento text
);

CREATE TABLE redessociales(
id_actor int PRIMARY KEY,
wikidata text,
facebook text,
instagram text,
tiktok text,
twitter text,
youtube text,
FOREIGN KEY (id_actor) REFERENCES actor(id_actor)
);

CREATE TABLE Actuan(
id_cast int PRIMARY KEY auto_increment,
id_pelicula int,
id_actor int,
titulo_pelicula varchar(250),
personaje varchar(250),
FOREIGN KEY (id_pelicula) REFERENCES pelicula(id),
FOREIGN KEY (id_actor) REFERENCES actor(id_actor)
);


CREATE table review(
id int PRIMARY KEY auto_increment,
review text,
vermastarde tinyint(1) NOT NULL DEFAULT 0,
nota tinyint(5),
fecha timestamp,
id_usuario int,
id_pelicula int,
FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
FOREIGN KEY (id_pelicula) REFERENCES pelicula(id)
);

Create table siguen(
id_follow int PRIMARY KEY auto_increment,
id_usuario int,
id_sigue int,
FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
FOREIGN KEY (id_sigue) references usuario(id) ON DELETE CASCADE
);

Create table estadistica(
id_usuario int PRIMARY KEY,
n_pelis_vistas int default 0,
n_seguidores int default 0,
n_siguiendo int default 0,
genero_mas_visto varchar(250),
FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE
);

insert into rol(id_rol,tipo) values (1,"usuario"),(2,"Admin");



