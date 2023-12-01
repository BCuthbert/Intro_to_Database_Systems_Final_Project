delete from price_history;
delete from account;
delete from stocks;
delete from lots;

insert into stocks values ('AAPL','Apple');
insert into stocks values ('AMZN','Amazon');
insert into stocks values ('NVDA','Nvidia');
insert into stocks values ('AMD','Advanced Micro Devices');


insert into price_history values ('2023-11-13','AAPL', 184.80);
insert into price_history values ('2023-11-14','AAPL', 187.44);
insert into price_history values ('2023-11-15','AAPL', 188.01);
insert into price_history values ('2023-11-16','AAPL', 189.71);
insert into price_history values ('2023-11-17','AAPL', 189.69);


insert into price_history values ('2023-11-13','AMZN', 142.59);
insert into price_history values ('2023-11-14','AMZN', 145.80);
insert into price_history values ('2023-11-15','AMZN', 143.20);
insert into price_history values ('2023-11-16','AMZN', 142.83);
insert into price_history values ('2023-11-17','AMZN', 145.18);


insert into price_history values ('2023-11-13','NVDA', 486.20);
insert into price_history values ('2023-11-14','NVDA', 496.56);
insert into price_history values ('2023-11-15','NVDA', 488.88);
insert into price_history values ('2023-11-16','NVDA', 494.80);
insert into price_history values ('2023-11-17','NVDA', 492.98);


insert into price_history values ('2023-11-13','AMD', 116.79);
insert into price_history values ('2023-11-14','AMD', 119.88);
insert into price_history values ('2023-11-15','AMD', 118.00);
insert into price_history values ('2023-11-16','AMD', 119.83);
insert into price_history values ('2023-11-17','AMD', 120.62);

insert into account values ('00001','jbonham','password111','2023-11-09',10000);
insert into account values ('00002','rplant','password222', '2023-11-09',10000);
insert into account values ('00003','jpage','password333','2023-11-09',10000);
insert into account values ('00004','jpjones','password444', '2023-11-09',10000);