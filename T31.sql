/* Ejercicio de la unidad T31 */
CREATE DATABASE Articulos_rubros;
USE Articulos_rubros;	

CREATE table Rubros(
	Codigo int not null auto_increment,
	Descripcion nvarchar(100),
    PRIMARY KEY(Codigo)
);

CREATE table Articulos (
	Codigo int not null auto_increment,
    Descripcion nvarchar(100),
    Precio float,
    CodigoRubros int,
    PRIMARY KEY(Codigo),
    constraint CodigoRubros foreign key(CodigoRubros) references Rubros(Codigo) ON UPDATE RESTRICT ON DELETE CASCADE
);