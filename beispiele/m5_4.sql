CREATE VIEW view_suppengerichte AS 
	SELECT gericht.name FROM gericht WHERE gericht.name LIKE '%suppe%';

SELECT * FROM view_suppengerichte;

CREATE VIEW view_anmeldungen AS 
	SELECT email, anzahlanmeldungen FROM benutzer ORDER BY anzahlanmeldungen DESC;
	
SELECT * FROM view_anmeldungen;

CREATE VIEW view_kategoriegerichte_vegetarisch AS 
	SELECT gericht.name AS 'Gericht', kategorie.name AS 'Kategorie' FROM kategorie
	JOIN gericht_hat_kategorie
	ON kategorie.id = gericht_hat_kategorie.kategorie_id
	RIGHT JOIN gericht
	ON gericht_hat_kategorie.gericht_id = gericht.id
	WHERE gericht.vegetarisch = 1
	ORDER BY kategorie.id ASC;
	
SELECT * FROM view_kategoriegerichte_vegetarisch;