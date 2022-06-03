-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon May 30 16:32:01 2022 
-- * LUN file: E:\01-Projets\DemoMotEte2022\db_sauvegarde.lun 
-- * Schema: db_sauvegarde/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database if exists db_sauvegarde;
create database db_sauvegarde;

-- Tables Section
-- _____________ 

create table t_contact (
     idContact int not null auto_increment,
     conName varchar(40) not null,
     conEmail varchar(255) not null,
     conPhoneNumber varchar(20),
     conMessage varchar(32767) not null,
     constraint ID_t_contact_ID primary key (idContact));

-- Index Section
-- _____________ 

create unique index ID_t_contact_IND
     on t_contact (idContact);
	 
DROP USER IF EXISTS `dbUser_sauvegarde`@`localhost`;
CREATE USER `dbUser_sauvegarde`@`localhost` identified by '.Etml-';
GRANT INSERT, SELECT, DELETE, UPDATE ON `db_sauvegarde`.* TO `dbUser_sauvegarde`@`localhost`;
FLUSH PRIVILEGES;

