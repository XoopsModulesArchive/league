# phpMyAdmin MySQL-Dump
# version 2.2.6
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Serveur: localhost
# Généré le : Mercredi 02 Avril 2004 à 18:29
# Version du serveur: 3.23.49
# Version de PHP: 4.2.0
# Base de données: `Classement`
# --------------------------------------------------------

#
# Structure de la table `buteurs`
#

CREATE TABLE buteurs (
    id        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_match  INT(10) UNSIGNED DEFAULT NULL,
    id_joueur INT(10) UNSIGNED DEFAULT NULL,
    buts      TINYINT(4)       DEFAULT NULL,
    KEY id (id)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `championnats`
#

CREATE TABLE championnats (
    id          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_division INT(10) UNSIGNED NOT NULL DEFAULT '0',
    id_saison   INT(10) UNSIGNED NOT NULL DEFAULT '0',
    KEY id (id),
    KEY id_saison (id_saison),
    KEY id_division (id_division)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `classe`
#

CREATE TABLE classe (
    id   INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    nom  VARCHAR(25)     NOT NULL DEFAULT '',
    rang INT(5)          NOT NULL DEFAULT '0',
    KEY id (id)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `clmnt`
#

CREATE TABLE clmnt (
    NOM           TEXT,
    POINTS        TINYINT(3) UNSIGNED      DEFAULT NULL,
    JOUES         TINYINT(3) UNSIGNED      DEFAULT NULL,
    G             TINYINT(3) UNSIGNED      DEFAULT NULL,
    N             INT(11)                  DEFAULT NULL,
    P             INT(11)                  DEFAULT NULL,
    BUTSPOUR      INT(11)                  DEFAULT NULL,
    BUTSCONTRE    INT(11)                  DEFAULT NULL,
    DIFF          INT(11)                  DEFAULT NULL,
    PEN           INT(11)                  DEFAULT NULL,
    DOMPOINTS     INT(11)                  DEFAULT NULL,
    DOMJOUES      INT(11)                  DEFAULT NULL,
    DOMG          INT(11)                  DEFAULT NULL,
    DOMN          INT(11)                  DEFAULT NULL,
    DOMP          INT(11)                  DEFAULT NULL,
    DOMBUTSPOUR   INT(11)                  DEFAULT NULL,
    DOMBUTSCONTRE INT(11)                  DEFAULT NULL,
    DOMDIFF       INT(11)                  DEFAULT NULL,
    EXTPOINTS     INT(11)                  DEFAULT NULL,
    EXTJOUES      INT(11)                  DEFAULT NULL,
    EXTG          INT(11)                  DEFAULT NULL,
    EXTN          INT(11)                  DEFAULT NULL,
    EXTP          INT(11)                  DEFAULT NULL,
    EXTBUTSPOUR   INT(11)                  DEFAULT NULL,
    EXTBUTSCONTRE INT(11)                  DEFAULT NULL,
    EXTDIFF       INT(11)                  DEFAULT NULL,
    ID_EQUIPE     INT(4) UNSIGNED NOT NULL DEFAULT '0'
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `clmnt_graph`
#

CREATE TABLE clmnt_graph (
    id_equipe  INT(5) UNSIGNED NOT NULL DEFAULT '0',
    fin        INT(4)          NOT NULL DEFAULT '0',
    classement INT(4)          NOT NULL DEFAULT '0',
    KEY nom (id_equipe)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `clubs`
#

CREATE TABLE clubs (
    id  INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50)     NOT NULL DEFAULT '',
    PRIMARY KEY (id),
    KEY id (id),
    KEY nom (nom)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `divisions`
#

CREATE TABLE divisions (
    id  INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50)     NOT NULL DEFAULT '',
    PRIMARY KEY (nom),
    KEY id (id),
    KEY nom_2 (nom)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `donnee`
#

CREATE TABLE donnee (
    id       INT(5) UNSIGNED  NOT NULL AUTO_INCREMENT,
    nom      TEXT             NOT NULL,
    id_clubs INT(10) UNSIGNED NOT NULL DEFAULT '0',
    id_rens  INT(10) UNSIGNED NOT NULL DEFAULT '0',
    etat     INT(1)           NOT NULL DEFAULT '0',
    url      VARCHAR(200)     NOT NULL DEFAULT '',
    KEY id (id),
    KEY id_rens (id_rens),
    KEY id_clubs (id_clubs),
    KEY etat (etat)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `equipes`
#

CREATE TABLE equipes (
    id       INT(4)          NOT NULL AUTO_INCREMENT,
    id_champ INT(4) UNSIGNED NOT NULL DEFAULT '0',
    id_club  INT(4) UNSIGNED NOT NULL DEFAULT '0',
    penalite TINYINT(4)               DEFAULT NULL,
    PRIMARY KEY (id),
    KEY id (id),
    KEY id_champ (id_champ),
    KEY id_club (id_club)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `joueurs`
#

CREATE TABLE joueurs (
    nom              TEXT    NOT NULL,
    prenom           TEXT    NOT NULL,
    id_club          INT(11) NOT NULL DEFAULT '0',
    date_naissance   DATE    NOT NULL DEFAULT '0000-00-00',
    position_terrain TEXT    NOT NULL,
    photo            TEXT    NOT NULL,
    id               INT(11) NOT NULL AUTO_INCREMENT,
    KEY id (id)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `journees`
#

CREATE TABLE journees (
    numero      INT(11) DEFAULT NULL,
    date_prevue DATE    DEFAULT NULL,
    id          INT(11) NOT NULL AUTO_INCREMENT,
    id_champ    INT(11) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY id (id),
    KEY id_champ (id_champ),
    KEY numero (numero)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `logo`
#

CREATE TABLE logo (
    id      INT(5) UNSIGNED  NOT NULL AUTO_INCREMENT,
    id_club INT(10) UNSIGNED NOT NULL DEFAULT '0',
    url     VARCHAR(255)     NOT NULL DEFAULT '',
    PRIMARY KEY (id),
    KEY id (id),
    KEY id_club (id_club)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `matchs`
#

CREATE TABLE matchs (
    id            INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_equipe_dom INT(10) UNSIGNED DEFAULT NULL,
    id_equipe_ext INT(3) UNSIGNED  DEFAULT NULL,
    date_reelle   DATETIME         DEFAULT NULL,
    id_journee    INT(10) UNSIGNED DEFAULT NULL,
    buts_dom      INT(11)          DEFAULT NULL,
    buts_ext      INT(11)          DEFAULT NULL,
    PRIMARY KEY (id),
    KEY id_equipe_dom (id_equipe_dom),
    KEY id_equipe_ext (id_equipe_ext),
    KEY buts_dom (buts_dom),
    KEY buts_ext (buts_ext),
    KEY id_journee (id_journee)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `parametres`
#

CREATE TABLE parametres (
    id_champ          INT(3) UNSIGNED NOT NULL DEFAULT '0',
    pts_victoire      INT(3) UNSIGNED NOT NULL DEFAULT '0',
    pts_nul           INT(3) UNSIGNED NOT NULL DEFAULT '0',
    pts_defaite       INT(3) UNSIGNED NOT NULL DEFAULT '0',
    accession         INT(3) UNSIGNED NOT NULL DEFAULT '0',
    barrage           INT(3) UNSIGNED NOT NULL DEFAULT '0',
    relegation        INT(3) UNSIGNED NOT NULL DEFAULT '0',
    id_equipe_fetiche SMALLINT(6)              DEFAULT NULL,
    KEY id_champ (id_champ)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `rens`
#

CREATE TABLE rens (
    id        INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT,
    nom       VARCHAR(150)     NOT NULL DEFAULT '',
    id_classe INT(10) UNSIGNED NOT NULL DEFAULT '0',
    rang      INT(5)           NOT NULL DEFAULT '0',
    url       VARCHAR(150)     NOT NULL DEFAULT '',
    KEY id (id)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `saisons`
#

CREATE TABLE saisons (
    id    INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT,
    annee INT(10) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (annee),
    UNIQUE KEY id_2 (id),
    KEY id (id)
)
    ENGINE = ISAM;
# --------------------------------------------------------

#
# Structure de la table `tapis_vert`
#

CREATE TABLE tapis_vert (
    id        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_equipe INT(10) UNSIGNED DEFAULT NULL,
    pts       TINYINT(4)       DEFAULT NULL,
    KEY id (id)
)
    ENGINE = ISAM;

