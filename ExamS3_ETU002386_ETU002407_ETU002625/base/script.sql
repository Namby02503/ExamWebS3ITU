create database the;
use the;
CREATE TABLE proprietePaiement(
   id INT AUTO_INCREMENT,
   poidsMin DECIMAL(15,2)   NOT NULL,
   poucentageBonus DECIMAL(15,2)   NOT NULL,
   pourcentageMalus DECIMAL(15,2)   NOT NULL,
   dt DATE,
   PRIMARY KEY(id)
);
CREATE TABLE prixVenteParVarieteThe(
   id INT AUTO_INCREMENT,
   prixVente DECIMAL(15,2)   NOT NULL,
   idVarieteThe INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idVarieteThe) REFERENCES varieteThe(id)
);

CREATE TABLE Personne(
   id INT AUTO_INCREMENT,
   email VARCHAR(100)  NOT NULL,
   mdp VARCHAR(10)  NOT NULL,
   type VARCHAR(1)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(email),
   CONSTRAINT chk_type CHECK (type IN ('A', 'U'))
);
CREATE TABLE Personne(
   id INT AUTO_INCREMENT,
   email VARCHAR(100)  NOT NULL,
   mdp VARCHAR(10)  NOT NULL,
   type VARCHAR(1)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(email)
);

CREATE TABLE varieteThe(
   id INT AUTO_INCREMENT,
   nomVariete VARCHAR(50)  NOT NULL,
   occupation DECIMAL(15,2)   NOT NULL,
   rendement DECIMAL(15,2)   NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(nomVariete)
);

CREATE TABLE parcelle(
   numParcelle VARCHAR(50) ,
   surface DECIMAL(15,2)   NOT NULL,
   idVarieteThe INT NOT NULL,
   PRIMARY KEY(numParcelle),
   FOREIGN KEY(idVarieteThe) REFERENCES varieteThe(id)
);
ALTER TABLE parcelle CHANGE COLUMN id idVarieteThe INT;

ALTER TABLE parcelle MODIFY COLUMN id idVarieteThe;
CREATE TABLE cueilleur(
   id INT AUTO_INCREMENT,
   nomCueilleur VARCHAR(100)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE categorieDepense(
   id INT AUTO_INCREMENT,
   libelle VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE salaireCueilleur(
   id INT AUTO_INCREMENT,
   salaire DECIMAL(15,2)   NOT NULL,
   idCueilleur INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idCueilleur) REFERENCES cueilleur(id)
);

CREATE TABLE cueillette(
   id INT AUTO_INCREMENT,
   dt DATE NOT NULL,
   poidsCueilli DECIMAL(15,2)   NOT NULL,
   idCueilleur INT NOT NULL,
   numParcelle VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idCueilleur) REFERENCES cueilleur(id),
   FOREIGN KEY(numParcelle) REFERENCES parcelle(numParcelle)
);

CREATE TABLE depense(
   id INT AUTO_INCREMENT,
   dt DATE NOT NULL,
   montant DECIMAL(15,2)   NOT NULL,
   idCatDepense INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idCatDepense) REFERENCES categorieDepense(id)
);

-- calcul feuille totales pour l'ensemble des parcelles
select sum( (surface*1000)/occupation)*rendement as totalFeuille from  parcelle join varieteThe on parcelle.idVarieteThe = varieteThe.id;
CREATE or replace view v_feuilletotales as select sum( (surface*1000)/occupation)*rendement totalFeuille from   parcelle join varieteThe on parcelle.idVarieteThe = varieteThe.id;

-- calacul feuilles cueilli pour chaque parselle entre dmin et dmax
select sum(poidsCueilli) from cueillette where dt>='2024-02-01' and dt<='2024-02-03';

-- calcul feuille resatant pour l'ensemble des parcelles entre dmin et dmax
select totalFeuille-(select sum(poidsCueilli) from cueillette where dt>='2024-02-01' and dt<='2024-02-03'; ) from v_feuilletotales;