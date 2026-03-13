drop database if exists accred;
create database accred;
use accred;


create or replace table organisation(
    id serial primary key,
    nom varchar(100),
    type_acteur varchar(100),
    siege text
);
create or replace table zone_sante(
    id serial primary key,
    province varchar(100),
    zone varchar(100)
);
create or replace table user(
    id serial primary key,
    titre varchar(100),
    nom varchar(100),
    prenom varchar(100),
    email varchar(100),
    telephone varchar(100),
    pwd varchar(100),
    profile enum('Interne','Externe') default 'Externe',
    role enum('Viewer','Editeur','Evaluateur','Point Focal','Agent','IM') ,
    statut enum('Actif','Inactif') default 'Actif',
    create_at datetime default current_timestamp,
    update_at datetime default current_timestamp on update current_timestamp,
    organisation_id int references organisation(id),
    reset_token text,
    reset_expire text
);

create or replace view v_user as 
select u.*,o.nom org_nom,o.type_acteur org_type,o.siege org_siege 
from user u join organisation o on o.id=u.organisation_id;

create or replace table epidemie(
    id serial primary key,
    lib varchar(100)
);
create or replace table instance(
    id serial primary key,
    lib varchar(100),
    create_at datetime default current_timestamp,
    update_at datetime default current_timestamp on update current_timestamp,
    obs text,
    zones json default '[]',
    epidemie_id int references epidemie(id),
    etat enum('En cours','Terminé') default 'En cours' -- Terminé
);
create or replace view v_instance as 
select i.*,e.lib epidemie_lib from instance i join epidemie e on e.id=i.epidemie_id;

create or replace table signataire_accredit(
    id serial primary key,
    nom varchar(100),
    titre varchar(100)
);
create or replace table demande(
    id serial primary key,
    instance_id int references instance(id),
    user_id int references user(id),
    extension json default '{}',
    domaine_intervention json default '[]',
    zones json default '[]',
    site_intervention json default '[]',
    modalite json,
    rh json default '[]',
    rm json default '[]',
    budget int,
    date_debut_est date,
    date_debut date,
    date_fin_est date,
    date_fin date,
    engagement  json default '[]',
    pf_national varchar(100) default '',
    pf_provincial varchar(100) default '',
    pf_local varchar(100) default '',
    raison_refus text,
    obs text,
    etat enum('En cours','Accepté','Refusé') default 'En cours',
    create_at datetime default current_timestamp,
    update_at datetime default current_timestamp on update current_timestamp
);
CREATE or replace VIEW v_demande AS 
SELECT 
d.*,
CONCAT(u.titre,' ',u.nom,' ',prenom) user_nom,telephone,email,
e.lib epidemie_lib,i.lib instance_lib,o.id org_id,
o.nom org_nom,o.type_acteur org_type,o.siege org_siege
FROM demande d
JOIN user u ON u.id=d.user_id
 JOIN instance i ON i.id=d.instance_id
 join epidemie e on e.id=i.epidemie_id
 join organisation o on o.id=u.organisation_id
 order by create_at desc
;

create or replace table note_accredit(
    id int(5) zerofill auto_increment primary key,
    demande_id int references demande(id),
    signataire_id int references signataire_accredit(id),
    create_at datetime default current_timestamp on update current_timestamp
);

create or replace view v_note_accredit as
select 
d.*,n.signataire_id,s.nom sign_nom,s.titre sign_titre,
n.create_at note_create_at
from v_demande d join note_accredit n on n.demande_id=d.id
join signataire_accredit s on s.id=n.signataire_id;

-- super vues
CREATE OR REPLACE VIEW v_epidemie AS 
SELECT *,
(SELECT COUNT(*) FROM instance i WHERE e.id=i.epidemie_id) n_instance,
(SELECT COUNT(*) FROM instance i JOIN demande d ON i.id=d.instance_id WHERE e.id=i.epidemie_id AND d.etat='Accepté') n_demande,
(SELECT coalesce(sum(budget),0) FROM instance i JOIN demande d ON i.id=d.instance_id WHERE e.id=i.epidemie_id AND d.etat='Accepté')
budget
 FROM epidemie e 
;
CREATE OR REPLACE VIEW v_instance as
SELECT i.*,e.lib epidemie_lib,
(SELECT COUNT(*) FROM demande d where d.instance_id=i.id) n_demande,
COALESCE((SELECT SUM(budget) FROM demande d where d.instance_id=i.id),0) budget
 FROM epidemie e 
JOIN instance i ON e.id=i.epidemie_id;
