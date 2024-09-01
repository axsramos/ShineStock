
use db_shinestock;

create table CmpPnc (
	CmpPncCod int not null,
	CmpPncDca datetime default now() not null,
	CmpPncDsc character(60) not null,
	CmpPncEtp int not null,
	CmpPncUsr varchar(60) not null,
	CmpPncObs varchar(300) null,
	constraint PKCmpPnc primary key (CmpPncCod),
	constraint FKCmpPnc01 foreign key (CmpPncEtp) references BasEtp (BasEtpCod),
	index ICmpPnc01 (CmpPncCod desc),
	index ICmpPnc02 (CmpPncEtp asc),
	index ICmpPnc03 (CmpPncDsc asc)
)
;

create table CmpMpf (
	CmpFncCod int not null,
	CmpMprCod int not null,
	CmpMpfDca datetime default now() not null,
	CmpMpfDsc character(60) not null,
	CmpMpfBlq char(1) default 'N' not null,
	CmpMpfObs varchar(300) null,
	constraint PKCmpMpf primary key (CmpFncCod, CmpMprCod),
	constraint FKCmpMpf01 foreign key (CmpFncCod) references CmpFnc (CmpFncCod),
	constraint FKCmpMpf02 foreign key (CmpMprCod) references CmpMpr (CmpMprCod),
	index ICmpMpf01 (CmpFncCod asc),
	index ICmpMpf02 (CmpMprCod asc),
	index ICmpMpf03 (CmpMpfBlq asc, CmpMpfDsc asc)
)
;

create table CmpPncMpr (
	CmpPncCod int not null,
	CmpMprCod int not null,
	CmpPncMprDca datetime default now() not null,
	CmpPncMprQtd numeric(12.3) not null,
	constraint PKCmpPncMpr primary key (CmpPncCod, CmpMprCod),
	constraint FKCmpPncMpr01 foreign key (CmpMprCod) references CmpMpr (CmpMprCod),
	index ICmpPncMpr01 (CmpPncCod asc),
	index ICmpPncMpr02 (CmpMprCod asc)
)
;
