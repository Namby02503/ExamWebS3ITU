CREATE TABLE regenerationConfig(
   id INT AUTO_INCREMENT,
   mois INT NOT NULL,
   dt DATE,
   PRIMARY KEY(id)
);

CREATE TABLE proprietePaiement(
   id INT AUTO_INCREMENT,
   poidsMin DECIMAL(15,2)   NOT NULL,
   poucentageBonus DECIMAL(15,2)   NOT NULL,
   pourcentageMalus DECIMAL(15,2)   NOT NULL,
   dt DATE,
   PRIMARY KEY(id)
);
CREATE or replace view v_poidstotalparparcelle as select *,sum( (surface*10000)/occupation) nbPieds,sum( (surface*10000)/occupation)*rendement totalFeuille  from   parcelle join varieteThe on parcelle.idVarieteThe = varieteThe.id group by numParcelle;

CREATE TABLE prixVenteParVarieteThe(
   id INT AUTO_INCREMENT,
   prixVente DECIMAL(15,2)   NOT NULL,
   idVarieteThe INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idVarieteThe) REFERENCES varieteThe(id)
);

CREATE TABLE salaire(
   id INT AUTO_INCREMENT,
   montant DECIMAL(15,2)   NOT NULL,
   dt DATE,
   PRIMARY KEY(id)
);

SELECT sum(poidsCueilli) from cueillette WHERE dt>=dmin and dt<=dmax group by idCueilleur;


-- Créer une vue pour afficher les salaires modifiés en fonction des seuils, pourcentages, et de la quantité de travail spécifique
CREATE VIEW VueSalairesModifies AS
SELECT
    sc.idCueilleur,
    sc.nomCueilleur,
    salaire
    CASE
        WHEN tr.quantiteTravail > s.valeurSeuil THEN
            salaire + (salaire * p.valeurPourcentage / 100)
        WHEN tr.quantiteTravail < s.valeurSeuil THEN
            salaire - (salaire * p.valeurPourcentage / 100)
        ELSE
            salaire
    END AS salaireModifie
FROM
    cueilleur sc
JOIN
    (
        SELECT
            idCueilleur,
            SUM(poidsCueilli) AS quantiteTravail
        FROM
            cueillette
        WHERE
            dt >= :dmin
            AND dt <= :dmax
        GROUP BY
            idCueilleur
    ) tr ON sc.idCueilleur = tr.idCueilleur
JOIN
    proprietePaiement s ON tr.quantiteTravail > s.poidsMin
JOIN
    proprietePaiement p ON tr.quantiteTravail < s.poidsMin;
JOIN
   (
      SELECT montant FROM salaire;
   )salaire