-- ***************************************************************
-- to run this script, ssh to webtech:
--
-- $ mysql -u user13 -p user13db < /home/user13/public_html/IAD/HW4/pa_universities.sql
--
-- ***************************************************************

drop table if exists pa_universities;

create table pa_universities
(  
    institution_name                  varchar(100),
    address                           varchar(100),
    city                              varchar(40),
    state_abbreviation                varchar(40),
    zip                               varchar(40),
    chief_officers_name               varchar(100),
    chief_officers_actual_title       varchar(100),
    phone                             varchar(40),
    fax                               varchar(40),
    general_url                       varchar(200),
    admissions_url                    varchar(200),
    federal_aid_url                   varchar(200),
    applications_url                  varchar(200),
    primary key(institution_name, zip)                 
);








-- ***************************************************************
-- make sure your datafile has the same name as your table when 
-- executing the following mysqlimport command from the OS shell
-- 
-- $ mysqlimport  -u user13  -p   --local   user13db   /home/user13/public_html/IAD/HW4/pa_universities.txt
-- ***************************************************************
