create database db_shinestock;

use db_shinestock;

create table BasEtp (
	BasEtpCod int not null,
	BasEtpDca datetime default now() not null,
	BasEtpDsc character(60) not null,
	BasEtpBlq char(1) default 'N' not null,
	BasEtpGrp character(60) not null,
	constraint PKBasEtp primary key (BasEtpCod),
	index IBasEtp01 (BasEtpCod desc),
	index IBasEtp02 (BasEtpGrp asc, BasEtpBlq asc, BasEtpDsc asc)
);

create table BasEtpItm (
	BasEtpCod int not null,
	BasEtpItmCod int not null,
	BasEtpItmDca datetime default now() not null,
	BasEtpItmBlq char(1) default 'N' not null,
	constraint PKBasEtpItm primary key (BasEtpCod, BasEtpItmCod),
	constraint FKBasEtpItm01 foreign key (BasEtpItmCod) references BasEtp(BasEtpCod),
	index IBasEtpItm01 (BasEtpItmCod asc)
);
