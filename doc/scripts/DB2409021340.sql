

use db_shinestock;

insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (1,now(),'Bijoux Brasil Atacado ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (2,now(),'Mil Bijus ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (3,now(),'Erikas ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (4,now(),'Atacado Bijuterias ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (5,now(),'Cherie Bijoux ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (6,now(),'Biju Total ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (7,now(),'Bela Bijuterias ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (8,now(),'Diamante Rosa Shop ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (9,now(),'Up Bijuterias ','N','');
insert into CmpFnc (CmpFncCod,CmpFncDca,CmpFncDsc,CmpFncBlq,CmpFncObs) values (10,now(),'Rei da Bijuteria ','N','');

-- // select * from CmpFnc; // --

insert into CmpMpf (CmpFncCod,CmpMprCod,CmpMpfDca,CmpMpfDsc,CmpMpfBlq,CmpMpfObs)
select CmpFnc.CmpFncCod, CmpMpr.CmpMprCod, now(), CmpMpr.CmpMprDsc, 'N', '' from CmpFnc cross join CmpMpr;



use db_shinestock;

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (1,adddate(now(),-60),'Estoque para produto lançamento verão','2','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (2,adddate(now(),-19),'Reposição de Estoque','3','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (3,adddate(now(),-9),'Reposição de Estoque','3','Arthur','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (4,adddate(now(),-29),'Reposição de Estoque','3','Heitor','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (5,adddate(now(),-8),'Estoque Catalogo Assinante','2','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (6,adddate(now(),-18),'Estoque Catalogo Assinante','2','Davi','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (7,adddate(now(),-7),'Reposição de Estoque','1','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (8,adddate(now(),-17),'Reposição de Estoque','1','Gabriel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (9,adddate(now(),-6),'Estoque Catalogo Fast Party','2','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (10,adddate(now(),-16),'Estoque Catalogo Fast Party','2','Gabriel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (11,adddate(now(),-5),'Reposição de Estoque','3','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (12,adddate(now(),-15),'Reposição de Estoque','3','Helena','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (13,adddate(now(),-14),'Reposição de Estoque','3','Maria Alice','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (14,adddate(now(),-4),'Estoque Catalogo Influencer','4','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (15,adddate(now(),-4),'Estoque Catalogo Influencer','4','Sophia','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (16,adddate(now(),-3),'Reposição de Estoque','5','Miguel','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (17,adddate(now(),-13),'Reposição de Estoque','5','Alice','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (18,adddate(now(),-2),'Reposição de Estoque','5','Beatriz','');

insert into CmpPnc (CmpPncCod,CmpPncDca,CmpPncDsc,CmpPncEtp,CmpPncUsr,CmpPncObs) 
values (19,adddate(now(),-3),'Reposição de Estoque','6','Miguel','');

-- // select * from CmpPnc; // --

