CREATE DATABASE 'crud';
CREATE TABLE `Eglise`(
    `ideglise` VARCHAR(6) NOT NULL ,
    `design` VARCHAR(100) NOT NULL UNIQUE,
    `solde` INT(50)  NOT NULL DEFAULT(0),
    PRIMARY KEY(ideglise)
);

CREATE TABLE `Entre`(
    `identre` INT(6) NOT NULL AUTO_INCREMENT,
    `ideglise` VARCHAR(6) NOT NULL,
    `motif` VARCHAR(100) NOT NULL,
    `montantEntre` INT(50) NOT NULL,
    `dateEntre` DATE NOT NULL,
    PRIMARY KEY(identre),
    FOREIGN KEY (ideglise) REFERENCES Eglise(ideglise) 
);

CREATE TABLE `Sortie`(
    `idsortie` INT(6) NOT NULL AUTO_INCREMENT,
    `ideglise` VARCHAR(6) NOT NULL,
    `motif` VARCHAR(100) NOT NULL,
    `montantSortie` INT(50) NOT NULL,
    `dateSortie` DATE NOT NULL,
    PRIMARY KEY(idsortie),
    FOREIGN KEY (ideglise) REFERENCES Eglise(ideglise) 
);
