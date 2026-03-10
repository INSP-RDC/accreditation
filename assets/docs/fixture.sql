insert into organisation(nom,type_acteur) values('OMS','ONG Internationale');
insert into organisation(nom,type_acteur) values('UG-PDSS','ONG Internationale');
insert into organisation(nom,type_acteur) values('INSP','Instutition Gouvernementale');

INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Bandalungwa');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Barumbu');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Binza-Météo');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Binza-Ozone');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Gombe');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Kalamu 1');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Kasa-Vubu');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Kimbaseke');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Kingasani');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Kintambo');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Lemba');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Limete');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Lingwala');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Masina 1');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Matete');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Ndjili');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Ngaba');
INSERT INTO zone_sante(province, zone) VALUES ('Kinshasa', 'Nsele');

-- Insertion pour le Nord-Kivu
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Goma');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Karisimbi');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Beni');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Butembo');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Oicha');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Rutshuru');
INSERT INTO zone_sante(province, zone) VALUES ('Nord-Kivu', 'Walikale');

-- Insertion pour le Haut-Katanga
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Lubumbashi');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Kampemba');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Kenya');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Katuba');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Ruashi');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Likasi');
INSERT INTO zone_sante(province, zone) VALUES ('Haut-Katanga', 'Kipushi');

insert into epidemie(lib) values('CHOLERA');
insert into instance(lib,obs,epidemie_id,param) values('Vague 1','Première vague de choléra pour l''année 2026 localisé à Kinshasa dans la commune de MAKALA',1,'{"zone_couverture":{"province":"Kinshasa","zones":["MAKALA","LEMBA"]}}');

insert into signataire_accredit(nom,titre) values('Dr. MWAMBA KAZADI Dieudonné','Directeur Général');
insert into signataire_accredit(nom,titre) values('Dr. MUKENYI BADIBANGA','Directeur Général-Adjoint');

-- inserer un utilisateur 
insert into user(titre,nom,prenom, email, telephone,pwd,profile,role,organisation_id) values
('Mr.','MAKANZU','Anaclet','mak@gmail.com','0823566425','1234','Interne','Editeur',3);
insert into user(titre,nom,prenom, email, telephone,pwd,profile,role,organisation_id) values
('Mme','ODIA','Christelle','christa@gmail.com','0837866425','1234','Interne','Viewer',3);
