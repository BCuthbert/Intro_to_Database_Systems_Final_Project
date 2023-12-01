
create table account
	(id                    int AUTO_INCREMENT,
     user           	   varchar(20),
     password       	   varchar(255),
     creation_date  	   date,
     cash           	   numeric(10,2),
     primary key (id)
	);

create table stocks(
     ticker             varchar(5),
     company_name       varchar(30),
     primary key (ticker)
    );


create table lots(
     lot_num            int AUTO_INCREMENT,
     id                 int,
     ticker             varchar(4),
     num_shares         numeric(6,0),
     purchase_price     numeric(6,2),
     purchase_date      date,
     primary key (lot_num,id),
     foreign key (id) references account (id),
     foreign key (ticker) references stocks (ticker)
    );

create table price_history(
     price_date     date,
     ticker         varchar(4),
     price          numeric(6,2),
     primary key (price_date,ticker),
     foreign key (ticker) references stocks (ticker)
    ); 

create view   stock_prices(ticker, CurrentPrice) as 
     SELECT ticker, price 
     from price_history 
     where price_date = '2023-11-17';

create view  lot_value(TotalValue,ticker,Price,Shares,Lot,LotOwner) as 
     SELECT (num_shares*CurrentPrice),ticker,CurrentPrice,num_shares,lot_num,id 
     from lots NATURAL JOIN stock_prices;

create view account_value(accVal,id) as
     SELECT sum(TotalValue) + cash, id 
     from lot_value join account on lot_value.LotOwner=account.id;
 