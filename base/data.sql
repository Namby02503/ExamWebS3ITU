-- Insérer des données de test dans la table Personne
INSERT INTO Personne (email, mdp, type) VALUES
('joe@example.com', 'mdp123', 'A'),
('linda@example.com', 'secret456', 'U'),
('lola@example.com', 'motdepasse789', 'A');

-- Insérer des données de test dans la table varieteThe
INSERT INTO varieteThe (nomVariete, occupation, rendement) VALUES
('Thé vert', 500.50, 20.75),
('Thé noir', 300.25, 18.90),
('Thé oolong', 700.75, 25.50);

-- Insérer des données de test dans la table parcelle
INSERT INTO parcelle (numParcelle, surface, idVarieteThe) VALUES
('A2', 10.5, 5),
('B2', 15.25, 6),
('C3', 20.00, 7);

-- Insérer des données de test dans la table cueilleur
INSERT INTO cueilleur (nomCueilleur) VALUES
('Alice'),
('Bob'),
('Charlie');

-- Insérer des données de test dans la table categorieDepense
INSERT INTO categorieDepense (libelle) VALUES
('Fertilisant'),
('Outils'),
('Irrigation');

-- Insérer des données de test dans la table salaireCueilleur
INSERT INTO salaireCueilleur (salaire, idCueilleur) VALUES
(1500.00, 2),
(1200.50, 3),
(1800.75, 4);

-- Insérer des données de test dans la table cueillette
INSERT INTO cueillette (dt, poidsCueilli, idCueilleur, numParcelle) VALUES
('2024-02-01', 5.75, 2, 'A1'),
('2024-02-02', 8.90, 3, 'B2'),
('2024-02-03', 12.25, 4, 'C3');

-- Insérer des données de test dans la table depense
INSERT INTO depense (dt, montant, idCatDepense) VALUES
('2024-02-01', 50.00, 2),
('2024-02-02', 30.50, 3),
('2024-02-03', 40.75, 4);
