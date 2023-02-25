create database FogFire;
use FogFire;

create table produtos(
id int primary key auto_increment not null,
nomeProduto varchar(100) not null,
estoque bigint not null,
preco decimal(10,2) not null
)engine=InnoDB;

create table vendas(
codigo int primary key auto_increment not null,
datahora datetime not null,
total decimal(10,2) not null
)engine=InnoDB;

create table vendasitens(
codigo int primary key auto_increment not null,
id bigint not null,
produto varchar(200) not null,
qtd bigint not null,
valor decimal(10,2) not null,
pedido bigint not null
)engine=InnoDB;

drop table vendas;
select * from vendasitens;
select max(codigo) as maiorcodigo from vendasitens;
insert into vendas (datahora, total) values (current_timestamp, 0);
select id, nomeProduto, preco from  produtos where id = 20;
insert into vendasitens (id,produto, qtd, valor, pedido) values (0, '', 0, 0, 0);


 


