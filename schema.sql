-- Active: 1678613516495@@localhost@8889@encuestas

drop database if exists encuestas;
create database encuestas;

use encuestas;


drop table if exists polls;
create table polls (
  id int not null auto_increment,
  uuid varchar(20) not null unique,
  title varchar(255) not null,
  primary key (id)
);

drop table if exists options;
create table options(
  id int not null auto_increment,
  poll_id int not null,
  title varchar(255) not null,
  votes int not null,
  primary key (id),
  Foreign Key (poll_id) REFERENCES polls(id)
)