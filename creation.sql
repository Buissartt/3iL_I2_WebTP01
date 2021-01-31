DROP DATABASE IF EXISTS I2_TPWEB_01;

CREATE DATABASE I2_TPWEB_01;

USE I2_TPWEB_01;

DROP TABLE IF EXISTS Ordinateur;
DROP TABLE IF EXISTS Famille;
DROP TABLE IF EXISTS Emprunt;
DROP TABLE IF EXISTS Utilisateur;

CREATE TABLE Ordinateur (
	numero_serie VARCHAR(255) PRIMARY KEY NOT NULL,
    marque       VARCHAR(255) NOT NULL,
    processeur   VARCHAR(255) NOT NULL,
    memoire      VARCHAR(255) NOT NULL,
    os           VARCHAR(255) NOT NULL
);

CREATE TABLE Famille (
	id        INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom       VARCHAR(255) NOT NULL,
    telephone VARCHAR(10)  NOT NULL,
    adresse   VARCHAR(255) NOT NULL,
    enfants   VARCHAR(255) NOT NULL
);

CREATE TABLE Emprunt (
	id                      INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_famille              INT,
    id_ordinateur           VARCHAR(255),
    date_emprunt            DATETIME     NOT NULL,
    date_restitution        DATETIME     NULL,
    commentaire_emprunt     VARCHAR(255) NULL,
    commentaire_restitution VARCHAR(255) NULL,
    FOREIGN KEY emprunt_famille_fk   (id_famille)    REFERENCES Famille(id),
    FOREIGN KEY emrunt_ordinateur_fk (id_ordinateur) REFERENCES Ordinateur(numero_serie)
);

CREATE TABLE Utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO Ordinateur(numero_serie, marque, processeur, memoire, os) VALUES
('00000001','Acer'       ,'Intel Core I3'     , '4Gb' , 'Manjaro'      ),
('00000002','Dell'       ,'Intel Core I5'     , '8Gb' , 'Windows XP'   ),
('00000003','HP'         ,'Intel Core I7'     , '16Gb', 'Windows 8'    ),
('00000004','AlienWare'  ,'Intel Core I9'     , '32Gb', 'Windows 10'   ),
('00000005','Fujitsu'    ,'Ryzen 3'           , '4Gb' , 'Mint'         ),
('00000006','Asus'       ,'Ryzen 5'           , '8Gb' , 'ArchLinux'    ),
('00000007','MSI'        ,'Ryzen 7'           , '16Gb', 'Ubuntu'       ),
('00000008','Lenovo'     ,'Ryzen 9'           , '32Gb', 'Debian 10'    ),
('00000009','PackardBell','Intel Celeron'     , '2Gb' , 'Windows Vista'),
('00000010','Samsung'    ,'Intel Pentium'     , '4Gb' , 'Windows 7'    ),
('00000011','Terra'      ,'Ryzen Threadripper', '64Gb', 'Debian 10'    );

INSERT INTO Famille(nom, telephone, adresse, enfants) VALUES
('PLOUC'   ,'0555102030','LIMOGES'  ,'Remi - Jean'          ),
('RADIN'   ,'0555102030','NIEUL'    ,'Arthur'               ),
('RAT'     ,'0555102030','VEYRAC'   ,'Lea'                  ),
('FEIGNANT','0555102030','PANAZOL'  ,'Romeo - Juliette '    ),
('IDIOT'   ,'0555102030','FEYTIAT'  ,'Joe - Donald - Barack'),
('LENT'    ,'0555102030','ST JUNIEN','Manu'                 ),
('MOU'     ,'0555102030','ORADOUR'  ,'Robertine'            ),
('BETE'    ,'0555102030','BRIVE'    ,'Manuella - Johnny'    ),
('LOURD'   ,'0555102030','BOSMIE'   ,'Antoine'              ),
('PUANT'   ,'0555102030','ISLE'     ,'Thomas - Robin'       ),
('VIEUX'   ,'0555102030','CONDAT'   ,'Martin'               );

INSERT INTO Utilisateur(username, password, is_admin) VALUES
('user' ,'$2y$10$Tzell/Ma0oigw2EKNfk9q.YLe.Wx17q0O6EbsyYqB8shOUaQWGRA2',FALSE),
('admin','$2y$10$ItX0bEIMIJe4vbWbRx2rrOp76oD60mrkDUAxj9tzpVuWMk3ZQeK2u',TRUE );