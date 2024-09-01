use db_shinestock;

create table CmpFnc (
	CmpFncCod int not null,
	CmpFncDca datetime default now() not null,
	CmpFncDsc character(60) not null,
	CmpFncObs varchar(300) null,
	CmpFncBlq char(1) default 'N' not null,
	constraint PKCmpFnc primary key (CmpFncCod),
	index ICmpFnc01 (CmpFncCod desc),
	index ICmpFnc02 (CmpFncBlq asc, CmpFncDsc asc)
)
;

create table CmpMpr (
	CmpMprCod int not null,
	CmpMprDca datetime default now() not null,
	CmpMprDsc character(60) not null,
	CmpMprObs varchar(300) null,
	CmpMprBlq char(1) default 'N' not null,
	constraint PKCmpMpr primary key (CmpMprCod),
	index ICmpMpr01 (CmpMprCod desc),
	index ICmpMpr02 (CmpMprBlq asc, CmpMprDsc asc)
)
;

