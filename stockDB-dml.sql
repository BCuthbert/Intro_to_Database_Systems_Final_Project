delete from price_history;
delete from lots;
--delete from account;
--delete from stocks;

--insert into account values (1,'demoAccount','password000', '2023-11-09',100000);

--insert into stocks values ('AAPL','Apple');
--insert into stocks values ('AMZN','Amazon');
--insert into stocks values ('NVDA','Nvidia');
--insert into stocks values ('AMD','Advanced Micro Devices');

insert into price_history values ('2023-11-10','AAPL', 186.70);
insert into price_history values ('2023-11-11','AAPL', 182.10);
insert into price_history values ('2023-11-12','AAPL', 183.50);
insert into price_history values ('2023-11-13','AAPL', 184.80);
insert into price_history values ('2023-11-14','AAPL', 187.44);
insert into price_history values ('2023-11-15','AAPL', 188.01);
insert into price_history values ('2023-11-16','AAPL', 189.71);
insert into price_history values ('2023-11-17','AAPL', 189.69);


insert into price_history values ('2023-11-10','AMZN', 146.13);
insert into price_history values ('2023-11-11','AMZN', 144.66);
insert into price_history values ('2023-11-12','AMZN', 143.35);
insert into price_history values ('2023-11-13','AMZN', 142.59);
insert into price_history values ('2023-11-14','AMZN', 145.80);
insert into price_history values ('2023-11-15','AMZN', 143.20);
insert into price_history values ('2023-11-16','AMZN', 142.83);
insert into price_history values ('2023-11-17','AMZN', 145.18);



insert into price_history values ('2023-11-10','NVDA', 485.89);
insert into price_history values ('2023-11-11','NVDA', 481.77);
insert into price_history values ('2023-11-12','NVDA', 483.56);
insert into price_history values ('2023-11-13','NVDA', 486.20);
insert into price_history values ('2023-11-14','NVDA', 496.56);
insert into price_history values ('2023-11-15','NVDA', 488.88);
insert into price_history values ('2023-11-16','NVDA', 494.80);
insert into price_history values ('2023-11-17','NVDA', 492.98);


insert into price_history values ('2023-11-10','AMD', 125.53);
insert into price_history values ('2023-11-11','AMD', 123.78);
insert into price_history values ('2023-11-12','AMD', 117.46);
insert into price_history values ('2023-11-13','AMD', 116.79);
insert into price_history values ('2023-11-14','AMD', 119.88);
insert into price_history values ('2023-11-15','AMD', 118.00);
insert into price_history values ('2023-11-16','AMD', 119.83);
insert into price_history values ('2023-11-17','AMD', 120.62);


insert into lots values (NULL,1,'AAPL',10,186.70,'2023-11-10');
insert into lots values (NULL,1,'AAPL',10,182.10,'2023-11-11');
insert into lots values (NULL,1,'AMZN',10,143.35,'2023-11-12');
insert into lots values (NULL,1,'NVDA',10,486.20,'2023-11-13');


