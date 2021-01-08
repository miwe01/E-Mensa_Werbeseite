CREATE Table Benutzer_bewertet_Gericht(
  IDBenutzer int(8) unsigned not null,
  IDGericht int(8) not null,
  Sternbewertung int(4),
  Bemerkung varchar(50),
  Bewertungszeitpunkt datetime,
  Hervorgehoben boolean,

 FOREIGN KEY (IDBenutzer) REFERENCES benutzer(id),
 FOREIGN KEY (IDGericht) REFERENCES gericht(id)
);