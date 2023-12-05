
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

create view  lot_value(TotalValue,ticker,Price,Previous,Shares,Basis,Lot,LotOwner,l_date) as 
     SELECT (num_shares*currentPrice),ticker,CurrentPrice,Yesterday,num_shares,(num_shares*purchase_price),lot_num,id,price_date
     from lots NATURAL JOIN (select p.ticker, p.price as currentPrice, p.price_date, o.price as Yesterday 
          from price_history as p left outer join price_history as o 
          on o.price_date = DATE_SUB(p.price_date,INTERVAL 1 DAY) AND p.ticker = o.ticker) as stockStats;
     
create view account_value(accVal,id) as
     SELECT IF(TotalValue IS NOT NULL,sum(TotalValue)+cash,cash), id 
     from lot_value right outer join account on lot_value.LotOwner=account.id
     GROUP BY id;

create view  historic_lot_value(date,TotalValue,ticker,Price,Shares,Lot,LotOwner) as 
     SELECT price_date,(num_shares*price),ticker,price,num_shares,lot_num,id 
     from lots NATURAL JOIN price_history;

create view historic_account_value(date,accVal,id) as
     SELECT date, IF(TotalValue IS NOT NULL,sum(TotalValue)+cash,cash), id
     from historic_lot_value right outer join account on historic_lot_value.LotOwner=account.id
     GROUP BY date;




