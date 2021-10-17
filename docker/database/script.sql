create schema ccca;

create table ccca.item
(
    id          int(11) unsigned NOT NULL AUTO_INCREMENT,
    category    varchar(200),
    description varchar(250),
    price       float,
    width       int,
    height      int,
    length      int,
    weight      int,
    PRIMARY KEY (id)
);

insert into ccca.item (category, description, price, width, height, length, weight)
values ('Instrumentos Musicais', 'Guitarra', 1000, 100, 50, 15, 3);
insert into ccca.item (category, description, price, width, height, length, weight)
values ('Instrumentos Musicais', 'Amplificador', 5000, 50, 50, 50, 22);
insert into ccca.item (category, description, price, width, height, length, weight)
values ('Acessórios', 'Cabo', 30, 10, 10, 10, 1);

create table ccca.coupon
(
    code        varchar(150),
    percentage  float,
    expire_date timestamp,
    primary key (code)
);

insert into ccca.coupon (code, percentage, expire_date)
values ('VALE20', 20, '2021-10-10T10:00:00');
insert into ccca.coupon (code, percentage, expire_date)
values ('VALE20_EXPIRED', 20, '2020-10-10T10:00:00');

create table ccca.order
(
    id         int(11) unsigned NOT NULL AUTO_INCREMENT,
    coupon     varchar(100),
    code       varchar(100),
    cpf        varchar(100),
    issue_date timestamp,
    freight    float,
    sequence   int(11),
    PRIMARY KEY (id)
);

create table ccca.order_item
(
    id_order int(11) unsigned NOT NULL,
    id_item  int(11) unsigned NOT NULL,
    price    float,
    quantity int,
    primary key (id_order, id_item)
);