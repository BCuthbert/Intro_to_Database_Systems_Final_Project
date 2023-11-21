
create table account
	(id			    varchar(5),
     user           varchar(20),
     password       varchar(20),
     creation_date  date
     cash           numeric(10,2)
     accnt_value as (SELECT sum(lot_value) FROM lots WHERE id = lots.id)
     primary key (id)
	);

create table lots(
     id                 varchar(5)
     lot_num            varchar(5)
     ticker             varchar(4)
     num_shares         numeric(6,0)
     purchase_price     numeric(6,2)
     purchase_date      date
     lot_value as (num_shares * (SELECT price FROM stocks WHERE ticker == stocks.ticker))
     primary key (id,lot_num)
     foreign key (id) references account (id)
     foreign key (ticker) references stocks (ticker)
    );


create table stocks(
     ticker             varchar(5)
     company_name       varchar(30)
     price as (SELECT from price_history WHERE ticker == price_history.ticker AND price_history.price_date == CURDATE())
     primary key (ticker)
    );

create table price_history(
     price_date     date
     ticker         varchar(4)     
     price          numeric(6,2)
     primary key (price_date,ticker)
     foreign key (ticker) references stocks (ticker)
    );   