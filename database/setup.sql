create database etec_tectok_teclados
default character set utf8
default collate utf8_general_ci;

use etec_tectok_teclados;

create table category (
    id int primary key auto_increment,
    name varchar(50) not null
) default charset utf8;

create table product (
    id int primary key auto_increment,
    name varchar(200) not null,
    price double not null,
    description varchar(2000),
    quantity_available int not null default 0,
    image_url varchar(500),
    category_id int not null,
    is_new boolean not null default false,
    constraint fk_category_id foreign key(category_id) references category(id)
) default charset utf8;

create table user (
    id int primary key auto_increment,
    name varchar(200) not null,
    email varchar(200) not null,
    password varchar(200) not null,
    type enum('admin', 'regular') not null default 'regular',
    cep char(8) not null,
    address_number int not null
) default charset utf8;

create table sale (
    id int primary key auto_increment,
    ticket char(21) not null,
    user_id int not null,
    product_id int not null,
    quantity_ordered int not null,
    creation_date datetime default current_timestamp,
    constraint fk_user_id foreign key (user_id) references user(id),
    constraint fk_product_id foreign key (product_id) references product(id)
) default charset utf8;
