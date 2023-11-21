delete from accounts;
delete from lots;
delete from stocks;
delete from price_history;

insert into account values ('00001','jbonham','password111','2023-11-09',10000);
insert into account values ('00002','rplant','password222', '2023-11-09',10000);
insert into account values ('00003','jpage','password333','2023-11-09',10000);
insert into account values ('00004','jpjones','password444', '2023-11-09',10000);

insert into stocks values ('AAPL','Apple');
insert into stocks values ('AMZN','Amazon');
insert into stocks values ('NVDA','Nvidia');
insert into stocks values ('AMD','Advanced Micro Devices');

--AAPL
insert into price_history values ('2023-11-09','AAPL', ...);
insert into price_history values ('2023-11-10','AAPL', ...);
insert into price_history values ('2023-11-13','AAPL', ...);
insert into price_history values ('2023-11-14','AAPL', ...);
insert into price_history values ('2023-11-15','AAPL', ...);

--AMZN
insert into price_history values ('2023-11-09','AMZN', ...);
insert into price_history values ('2023-11-10','AMZN', ...);
insert into price_history values ('2023-11-13','AMZN', ...);
insert into price_history values ('2023-11-14','AMZN', ...);
insert into price_history values ('2023-11-15','AMZN', ...);

--NVDA
insert into price_history values ('2023-11-09','NVDA', ...);
insert into price_history values ('2023-11-10','NVDA', ...);
insert into price_history values ('2023-11-13','NVDA', ...);
insert into price_history values ('2023-11-14','NVDA', ...);
insert into price_history values ('2023-11-15','NVDA', ...);

--AMD
insert into price_history values ('2023-11-09','AMD', ...);
insert into price_history values ('2023-11-10','AMD', ...);
insert into price_history values ('2023-11-13','AMD', ...);
insert into price_history values ('2023-11-14','AMD', ...);
insert into price_history values ('2023-11-15','AMD', ...);

--jbohnam
insert into lots values ();

--rplant
insert into lots values ();

--jpage
insert into lots values ();

--jpjones
insert into lots values ();