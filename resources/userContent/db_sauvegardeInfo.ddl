-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Jun 15 11:19:20 2022 
-- * LUN file: E:\01-Projets\DemoMotEte2022\db_sauvegarde.lun 
-- * Schema: db_sauvegarde/mldinfo 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database if exists db_sauvegarde;
create database db_sauvegarde;
use db_sauvegarde;

-- Tables Section
-- _____________ 

create table t_contact (
     idContact int not null auto_increment,
     conName varchar(40) not null,
     conEmail varchar(255) not null,
     conPhoneNumber varchar(20),
     conMessage varchar(32767) not null,
     constraint ID_t_contact_ID primary key (idContact));

create table t_info (
     idInfo int not null auto_increment,
     infName varchar(50) not null,
     infDescription varchar(150) not null,
     infContent varchar(32767) not null,
     constraint ID_t_info_ID primary key (idInfo));

-- Index Section	
-- _____________ 

create unique index ID_t_contact_IND
     on t_contact (idContact);

create unique index ID_t_info_IND
     on t_info (idInfo);

DROP USER IF EXISTS `dbUser_sauvegarde`@`localhost`;
CREATE USER `dbUser_sauvegarde`@`localhost` identified by '.Etml-';
GRANT INSERT, SELECT, DELETE, UPDATE ON `db_sauvegarde`.* TO `dbUser_sauvegarde`@`localhost`;
FLUSH PRIVILEGES;


