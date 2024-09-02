
use db_shinestock;

-- // BasEtp // --
insert into BasEtp values(1, now(), 'ABERTO', 'N', 'APROVAÇÃO DE COMPRAS')
;
insert into BasEtp values(2, now(), 'FECHADO', 'N', 'APROVAÇÃO DE COMPRAS')
;
insert into BasEtp values(3, now(), 'ANÁLISE', 'N', 'APROVAÇÃO DE COMPRAS')
;
insert into BasEtp values(4, now(), 'APROVADO', 'N', 'APROVAÇÃO DE COMPRAS')
;
insert into BasEtp values(5, now(), 'REPROVADO', 'N', 'APROVAÇÃO DE COMPRAS')
;
insert into BasEtp values(6, now(), 'CANCELADO', 'N', 'APROVAÇÃO DE COMPRAS')
;

-- // BasEtpItm // --
insert into BasEtpItm values(1, 2, now(), 'N')
;
insert into BasEtpItm values(1, 6, now(), 'N')
;
insert into BasEtpItm values(2, 3, now(), 'N')
;
insert into BasEtpItm values(3, 4, now(), 'N')
;
insert into BasEtpItm values(3, 5, now(), 'N')
;