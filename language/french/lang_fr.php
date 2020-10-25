<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?

//AVERTISSEMENT EN PAGE D'ADMINISTRATION
define(
    AVERTISSEMENT,
    "RAPPEL : PhpLeague 0.7 est un script en développement<br>
Certaines des opérations de suppressions n'effectuent aucun contrôle<br>
sur le reste des données enregistrées.<br>Faites donc très attention si vous supprimez des données..."
);

// ENTREES DU MENU ADMINISTRATION
define("SOUS_TITRE", "Administration des tables");
define("SEASON", "Saisons");
define("CLUB", "Clubs");
define("DIVISION", "Divisions");
define("LEAGUE", "Championnats");
define("TEAM", "Equipes");
define("CALENDAR", "Calendrier");
define("DATE", "Dates");
define("MATCH", "Matchs");
define("COHERENCE", "Cohérence");
define("RESULT", "Résultats");
define("JOUEUR", "Joueurs");
define("BUTEUR", "Buteurs");
define("TAP_VERT", "Tapis Vert");
define("PARAMETRE", "Paramètres");
define("RENS", "Renseignements clubs");
define("EQUIPE", "Gestion des clubs");
define("CLASSE", "Classes");
define("CONSULT", "CONSULTATION");
define("VERIF", "Vérification des clubs");
define("MINI", "Mini-classement");

// FICHIER admin/saisons.php
define("ADMIN_SAISON_TITRE", "Edition des saisons");
define("ADMIN_SAISON_SUPP1", "<b>SUPPRESSION</b> d'une saison");
define("ADMIN_SAISON_SUPP2", "<b>Suppression</b> d'une saison");
define("ADMIN_SAISON_BUTTON_SUPP", "Suppression saison");
define("ADMIN_SAISON_MSG1", "Supprimer une saison, c'est aussi effacer l'ensemble des championnats et des rencontres attachés !!!");
define("ADMIN_SAISON_CREA", "<b>CREATION</b> d'une saison");
define("ADMIN_SAISON_MSG2", "Première année de la saison : ");
define("ADMIN_SAISON_BUTTON_CREA", "Création saison");
define("ADMIN_SAISON_BUTTON_MSG3", "Pour <b>modifier</b> une saison, utilisez PHPMyAdmin");
define("ADMIN_CRESAISON_MSG1", "<b>Création effectuée </b>");
define("ADMIN_SUPPSAISON_MSG1", "<b>Suppression effectuée</b>");
define("ADMIN_SAISON_MSG3", "<b>Saison</b>");

// FICHIER admin/clubs.php
define("ADMIN_CLUB_TITRE", "Edition des clubs");
define("ADMIN_CLUB_SUPP1", "<b>Suppression</b> d'un club ");
define("ADMIN_CLUB_BUTTON_SUPP", "Suppression club");
define("ADMIN_CLUB_CREA", "<b>Ajout</b> d'un club");
define("ADMIN_CLUB_NOM", "Nom du club : ");
define("ADMIN_CLUB_BUTTON_CREA", "Création club");
define("ADMIN_CLUB_BUTTON_MSG3", "Pour <b>modifier</b> le nom d'un club, utilisez PHPMyAdmin");
define("ADMIN_CLUB_CREA2", "<b>Création effectuée</b>");
define("ADMIN_CLUB_SUPP2", "<b>Suppression effectuée</b>");

// Admin/divisions.php
define("ADMIN_DIVISION_TITRE", "Edition des divisions");
define("ADMIN_DIVISION_BUTTON_CREA", "Création saison");
define("ADMIN_DIVISION_MSG1", "Divisions existantes : ");

// admin/championnats.php
define("ADMIN_CHAMPIONNATS_TITRE", "Edition des championnats");
define("ADMIN_CHAMPIONNATS_SUPP", "<b>SUPPRESSION</b> d'un championnat");
define("ADMIN_CHAMPIONNATS_BUTTON_SUPP", "Suppression");
define("ADMIN_CHAMPIONNATS_CREA", "Création d'un championnat");
define("ADMIN_CHAMPIONNATS_MSG1", "Choix de la division ? ");
define("ADMIN_CHAMPIONNATS_MSG2", "Choix de la saison ? ");
define("ADMIN_CHAMPIONNATS_BUTTON_CREA", "Création");
define("ADMIN_CHAMPIONNATS_BUTTON_MSG3", "Pour <b>modifier</b> un championnat, utilisez PHPMyAdmin");

// admin/equipes.php
define("ADMIN_EQUIPE_TITRE", "Edition des équipes");
define("ADMIN_EQUIPE_BUTTON_SUPP", "Suppresion");
define("ADMIN_EQUIPE_MSG1", "<b>Suppression</b> d'une ou plusieurs équipe(s) (Choix multiple possible avec la touche SHIFT et CTRL). <b>Attention pas de demande de confirmation !</b>");
define("ADMIN_EQUIPE_MSG2", "Equipe à supprimer : ");
define("ADMIN_EQUIPE_MSG3", "<b>Inscrire </b>(Choix multiple possible avec la touche SHIFT ou CTRL) ");
define("ADMIN_EQUIPE_MSG4", " en ");
define("ADMIN_EQUIPE_MSG5", "Pour <b>modifier</b> un équipe, utilisez PHPMyAdmin<br><br>");

// admin/journees.php
define("ADMIN_JOURNEES_TITRE", "Création des journées (calendrier)");
define("ADMIN_JOURNEES_MSG1", "Donnez le N° de championnat pour lequel vous voulez créer un calendrier</b><br>attention, pas de contrôle de cohérence !!!<br>");
define("ADMIN_JOURNEES_MSG2", "<b>Etes vous sur de vouloir créer ce championnat ?</b>");
define("ADMIN_JOURNEES_MSG3", "Saison");
define("ADMIN_JOURNEES_MSG4", " équipes soit ");
define("ADMIN_JOURNEES_MSG5", " journées");
define("ADMIN_JOURNEES_MSG6", "OUI");
define("ADMIN_JOURNEES_MSG7", "NON");
define("ADMIN_JOURNEES_MSG8", "dates prévues de chaque journée :");
define("ADMIN_JOURNEES_MSG9", "Journée N° ");
define("ADMIN_JOURNEES_MSG10", " sous la forme <b>JJMMAAAA<b>");
define("ADMIN_JOURNEES_MSG11", " équipes engagées");

// admin/dates.php
define("ADMIN_DATES_TITRE", "Saisie des dates de chaque journée");
define("ADMIN_DATES_MSG1", "Quel championnat voulez vous saisir ?");
define("ENVOI", "Envoi");

// admin/matchs
define("ADMIN_MATCHS_TITRE", "Edition des matchs");
define("ADMIN_MATCHS_MSG1", "Quel championnat voulez vous saisir ? ");
define("ADMIN_MATCHS_MSG2", "Quelle journée voulez vous saisir ?");
define("ADMIN_MATCHS_MSG3", "Attention, pas de contrôle de cohérence effectué ...</b>");
define("DOMICILE", "Domicile");
define("EXTERIEUR", "Extérieur");
define("ADMIN_MATCHS_MSG4", "Journée suivante : ");
define("ADMIN_MATCHS_MSG9", "Journée n° ");

// cohérence
define("ADMIN_COHERENCE_TITRE", " Contrôle de cohérence du calendrier");
define("ADMIN_COHERENCE_MSG1", "Quel calendrier voulez vous vérifier ?  ");
define("ADMIN_COHERENCE_MSG2", "Journée ");
define("ADMIN_COHERENCE_MSG3", " cohérente");
define("ADMIN_COHERENCE_MSG4", "<b>incohérente ou incomplète</b>");
define("ADMIN_COHERENCE_MSG5", "Ce championnat semble cohérent");
define("ADMIN_COHERENCE_MSG6", "Ce championnat semble incohérent");

// Joueurs et buteurs
define("ADMIN_BUTEURS_TITRE", "Edition des Buteurs");
define("ADMIN_BUTEURS_MSG1", "Quel championnat voulez vous saisir ?");
define("ADMIN_BUTEURS_MSG2", "Quelle journée voulez vous saisir ?");
define("ADMIN_BUTEURS_LAST", "Préc.");
define("ADMIN_BUTEURS_NEXT", "Suiv.");
define("ADMIN_BUTEURS_MSG3", "validation_et_buteur_suivant"); // laisser des _ à la place des espaces
define("ADMIN_JOUEURS_TITRE", "Edition des Joueurs");
define("ADMIN_JOUEURS_MSG1", "<b>Suppression</b> d'un joueur  ");
define("ADMIN_JOUEURS_MSG2", "Suppression");
define("ADMIN_JOUEURS_MSG3", "<b>Ajout</b> d'un joueur");
define("ADMIN_JOUEURS_MSG4", "Prénom :  ");
define("ADMIN_JOUEURS_MSG5", "Nom :  ");
define("ADMIN_JOUEURS_MSG6", "Son club :  ");
define("ADMIN_JOUEURS_MSG7", "URL Photo : ");
define("ADMIN_JOUEURS_MSG8", "Date de Naissance : (JJMMAAAA) ");
define("ADMIN_JOUEURS_MSG9", "Position Terrain :  ");
define("ADMIN_JOUEURS_MSG10", "Pour <b>modifier</b> le nom d'un joueur, utilisez PHPMyAdmin");
define("ADMIN_JOUEURS_1", "<b>Entrez</b> les buteurs match par match. Pour <b>supprimer</b> un buteur, cliquez sur celui-ci.");
define("ADMIN_JOUEURS_2", "Buts");
define("ADMIN_JOUEURS_3", "équipe de");

// résultats
define("ADMIN_RESULTATS_TITRE", "Edition des résultats");
define("ADMIN_RESULTATS_MSG1", "Quel championnat voulez vous saisir ?");
define("ADMIN_RESULTATS_MSG2", "Quelle journée voulez vous saisir ?");

// Tapis vert
define("ADMIN_TAPVERT_TITRE", "Tapis Vert");
define("ADMIN_TAPVERT_MSG1", "Ici, vous pouvez gérer les points de pénalité (sanctions administratives, forfaits, etc ...)");
define("ADMIN_TAPVERT_MSG2", "Quel championnat ?");
define("ADMIN_TAPVERT_MSG3", "Entrez les points de pénalité (Ex: -1, -2, ...)");

// Paramètres
define("ADMIN_PARAM_TITRE", "Paramètres de championnat");
define("ADMIN_PARAM_MSG1", "Réglage des paramètres pour quel championnat  ?");
define("ADMIN_PARAM_MSG2", "Points pour une victoire ? : ");
define("ADMIN_PARAM_MSG3", "Points pour un nul ? :");
define("ADMIN_PARAM_MSG4", "Points pour une défaite ? :");
define("ADMIN_PARAM_MSG5", "Nombre d'équipe pour l'accession directe	 ? : ");
define("ADMIN_PARAM_MSG6", "Nombre d'équipe pour l'accession en barrages	 ? :");
define("ADMIN_PARAM_MSG7", "Nombre d'équipe pour la rélégation	 ? : ");
define("ADMIN_PARAM_MSG8", "Votre équipe préféree ?");
define("ADMIN_PARAM_MSG9", "Paramètres enregistrés");

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des clubs (fiches clubs), mini-classement,                     //
//               statistiques, amélioration de la gestion des buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/classement/consult/classement.php?champ=2 //
// Description : Edition, gestion, fiches clubs, statistiques, mini-classement...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

// FICHIER admin/classe.php
define("ADMIN_CLASSE_TITRE", "Edition des classes");
define("ADMIN_CLASSE_SUPP1", "<b>Suppression</b> d'une classe ");
define("ADMIN_CLASSE_BUTTON_SUPP", "Suppression classe");
define("ADMIN_CLASSE_CREA", "<b>Ajout</b> d'une classe");
define("ADMIN_CLASSE_NOM", "Nom de la classe : ");
define("ADMIN_CLASSE_BUTTON_CREA", "Création classe");
define("ADMIN_CLASSE_BUTTON_MSG3", "Pour <b>modifier</b> le nom d'une classe, utilisez PHPMyAdmin");
define("ADMIN_CLASSE_1", "Classement des classes : 1 : 1er, 2 : 2e...");
define("ADMIN_CLASSE_2", "<b>Paramètres enregistrés !</b>");
define("ADMIN_CLASSE_3", "Vous n'avez pas le droit de supprimer cette classe car elle utilisée par ");
define("ADMIN_CLASSE_4", " renseignement(s). Supprimez le(s) renseignement(s) contenu(s) dans cette classe avant de la supprimer !");
define("ADMIN_CLASSE_UNIVERT", "http://www.univert.org");

// FICHIER admin/gestequipes.php
define("ADMIN_EQUIPE_TITRE", "Consultation des clubs");
define("ADMIN_EQUIPE_2", "Choisissez un club : ");
define("ADMIN_EQUIPE_17", "Edition des renseignements de l'équipe");
define("ADMIN_EQUIPE_1", "Réglage des paramètres de : ");
define("ADMIN_EQUIPE_3", "Nom du renseignement");
define("ADMIN_EQUIPE_4", "Valeur du renseignement");
define("ADMIN_EQUIPE_5", "Url");
define("ADMIN_EQUIPE_6", "Afficher (=1)<br>ou non (=0)");
define("ADMIN_EQUIPE_7", "Url logo : ");
define("ADMIN_EQUIPE_8", "Non renseigné");

// FICHIER admin/rens.php
define("ADMIN_RENS_TITRE", "Edition des renseignements");
define("ADMIN_RENS_SUPP1", "<b>Suppression</b> d'un renseignement ");
define("ADMIN_RENS_BUTTON_SUPP", "Suppression renseignement");
define("ADMIN_RENS_CREA", "<b>Ajout</b> d'un renseignement");
define("ADMIN_RENS_NOM", "Nom du renseignement : ");
define("ADMIN_RENS_BUTTON_CREA", "Création renseignements");
define("ADMIN_RENS_CREA2", "<b>Création effectuée</b>");
define("ADMIN_RENS_SUPP2", "<b>Suppression effectuée</b>");
define("ADMIN_RENS_1", " dans la classe : ");
define("ADMIN_RENS_2", "Vous n'avez pas le droit de supprimer ce renseignement car il est utilisé ");
define("ADMIN_RENS_3", " fois dans les renseignements.");
define("ADMIN_RENS_4", "<b>Insérez</b> les renseignements dans les classes :");
define("ADMIN_RENS_5", "<b>Supprimez</b> les paramètres des renseignements (Choix multiple possible avec la touche SHIFT et CTRL) : ");
define("ADMIN_RENS_6", " dans ");
define("ADMIN_RENS_7", "Ajouter");
define("ADMIN_RENS_8", "Supprimer");
define("ADMIN_RENS_9", "Ordonner les renseignements : 1 pour le 1er, 2 pour le 2e...");
define("ADMIN_RENS_10", "<b>Editer</b> les renseignements");
define("ADMIN_RENS_11", "Enregistrer");
define("ADMIN_RENS_12", "Nom du renseignement");
define("ADMIN_RENS_13", "Url du renseignement (facultatif)");
define("ADMIN_RENS_14", "Renseignements à classer :");
define("ADMIN_RENS_15", "Tous les renseignements sont classés");
define("ADMIN_RENS_16", "Etes-vous sure de vouloir supprimer le renseignement");
define("ADMIN_RENS_17", "Oui");
define("ADMIN_RENS_18", "Non");

// Mini-classement
define("ADMIN_MINI_1", "Mini-Classement");
define("ADMIN_MINI_2", "Choisissez la présentation");
define("ADMIN_MINI_3", "Choisissez le type de classement");
define("ADMIN_MINI_4", "Choisissez le championnat");
define("ADMIN_MINI_5", "Nombre d'équipe au dessus de l'équipe fétiche");
define("ADMIN_MINI_6", "Editer le code");
define("ADMIN_MINI_7", "Remarques");
define("ADMIN_MINI_8", "Championnat non renseigné !");
define("ADMIN_MINI_9", "Type de classement non renseigné !");
define("ADMIN_MINI_10", "Présentation non renseignée !");
define("ADMIN_MINI_11", "Code invalide !");
define("ADMIN_MINI_12", "Aperçu");
define("ADMIN_MINI_13", "Voici le code à ajouter dans vos pages : ");
define("ADMIN_MINI_14", "Nombre d'équipe en dessous de l'équipe fétiche");
define("ADMIN_MINI_15", "Souhaitez-vous laisser le lien sur les équipes ?");
define("ADMIN_MINI_16", "Chemin du script (par rapport à la page dans laquelle vous allez placer le code)");
define("ADMIN_MINI_17", "Ne pas afficher le classement complet");
define("ADMIN_MINI_18", "Afficher le classement complet");
define("ADMIN_MINI_19", "Nombre d'équipe au dessus non renseigné !");
define("ADMIN_MINI_20", "Nombre d'équipe en dessous non renseigné !");
define("ADMIN_MINI_21", "Le code est valide !");
define("ADMIN_MINI_22", "Couleur");
define("ADMIN_MINI_23", "Barres");

/* ZONE PUBLIQUE : CONSULTATION */

// Entete et index
define("CONSULT_HOME", "Accueil");
define("CONSULT_CALENDAR", "Calendriers");
define("CONSULT_CLASSEMENT", "Classements");
define("CONSULT_BUTEUR", "Buteurs");
define("CONSULT_DUEL", "Duels");
define("MENU_UTILISATEUR", "Menu utilisateur");

//classement
define("CONSULT_CLMNT_MSG1", "Type de classement :");
define("GENERAL", "Général");
define("DOMICILE", "Domicile");
define("EXTERIEUR", "Extérieur");
define("ATTAQUE", "Attaque");
define("DEFENSE", "Défense");
define("GOALDIFF", "Diff");
define("CONSULT_CLMNT_MSG2", " de la journée ");
define("CONSULT_CLMNT_MSG3", " à la journée ");
define("CONSULT_CLMNT_MSG4", "Classement général, journées");
define("CONSULT_CLMNT_MSG5", " à ");
define("CONSULT_CLMNT_MSG6", "Derniers résultats : journée N°");
define("CONSULT_CLMNT_MSG61", "Précédente journée N°");
define("CONSULT_CLMNT_MSG62", "Prochaine journée N°");
define("CONSULT_CLMNT_MSG7", "ESTIMATION DES SCORES DE LA PROCHAINE JOURNEE :");
define("CONSULT_CLMNT_MSG8", "PROBABILITES calculées de la<br>Prochaine journée : N° ");
define("CONSULT_CLMNT_MSG9", "Prochaine journée : N° ");
define("CONSULT_CLMNT_MSG10", "Classement à domicile, journées ");
define("CONSULT_CLMNT_MSG11", "Classement des attaques, journées ");
define("CONSULT_CLMNT_MSG12", "Classement des défenses, journées ");
define("CONSULT_CLMNT_MSG13", "Classement au Goal Average, journées ");
define("CONSULT_CLMNT_MSG14", "Classement à l'extérieur, journées ");
define("CLMNT_POSITION", "Pl");
define("CLMNT_EQUIPE", "Equipe");
define("CLMNT_POINTS", "Points");
define("CLMNT_JOUES", " J ");
define("CLMNT_VICTOIRES", "V ");
define("CLMNT_NULS", "N ");
define("CLMNT_DEFAITES", "D ");
define("CLMNT_BUTSPOUR", "BP ");
define("CLMNT_BUTSCONTRE", "BC ");
define("CLMNT_DIFF", "Diff. ");
define("EXEMPT", "Exempt");

// Matchs
define("CONSULT_MATCHS", "Consultation des calendriers");
define("CONSULT_MATCHS_MSG1", "Quel championnat voulez vous consulter ?");
define("CONSULT_MATCHS_MSG2", " Le ");

// FICHIER consult/equipes.php
define("CONSULT_INDEX_1", "Consultation des équipes");
define("CONSULT_INDEX_2", "Fondation");

// Detail equipe
define("VICTOIRE", "VICTOIRE ");
define("NUL", " NUL ");
define("DEFAITE", " DEFAITE");
define("JOURNEE", "N°");

// division2.php
define("CONSULT_CALENDAR_1", "Cette journée n'existe pas");
define("CONSULT_CALENDAR_2", "Journée précédente");
define("CONSULT_CALENDAR_3", "Journée suivante");
define("CONSULT_CALENDAR_4", "Prochains matchs : journée n°");
define("CONSULT_CALENDAR_5", "Matchs précédents : journée n°");

// divers
define("RETOUR", "RETOUR");

// *********************************************
// ***** NEW ITEMS ADDED DECEMBER 22th 2001 ****
// *********************************************

// consult/buteurs
define("CONSULT_BUTEUR_MSG1", "Quel groupe de championnat ?");
define("CONSULT_BUTEUR_MSG2", "Classement Buteurs");
define("CONSULT_BUTEUR_MSG3", "Groupe de Championnats : ");
define("CONSULT_BUTEUR_MSG4", "comprenant : ");
define("CONSULT_BUTEUR_MSG5", "Quelle équipe ?");
define("JOURNEE_MIROIR", "Journée Miroir ? : ");
define("DUEL_MSG1", "Choisissez les adversaires : ");
define("DUEL_MSG2", " Duels");
define("DUEL_MSG3", "Voici les probabilités de l'ordinateur ");
define("DUEL_MSG4", "PROBABILITES : ");
define("DUEL_MSG5", "Les probabilités affichées sont le reflet d'un calcul mathématique simple");

// consult/club
define("CONSULT_CLUB_1", "Classement");
define("CONSULT_CLUB_2", "Calendrier et résultats");
define("CONSULT_CLUB_3", "Historique");
define("CONSULT_CLUB_4", "Statistiques");

//Graphique
define("ADMIN_GRAPH_TITRE", "Créations des graphiques");
define("ADMIN_GRAPH", "La création des graphiques a été réalisée avec succès");
define("ADMIN_GRAPH_1", "La création des graphiques a échoué, veuillez réessayer !");
define("ADMIN_GRAPH_2", "Cette manoeuvre est à effectuer après chaque ajout de résultats. Elle peut prendre un certain temps...");
define("ADMIN_GRAPH_3", "Evolution du classement de");
define(
    "ADMIN_GRAPH_4",
    "Erreur lors de la création de graphique, réessayez !<br>
                      Si le problème persiste modifier le max_execution_time dans C:\windows\php.ini"
);

// Sécurité
define("ADMIN_SECURITE_CLUB", "Etes vous sur de vouloir supprimer le club suivant :");
define("ADMIN_SECURITE_RENS", "Etes vous sur de vouloir supprimer le renseignement suivant :");
define("ADMIN_SECURITE_SAISONS", "Etes vous sur de vouloir supprimer la saison ");
define("ADMIN_SECURITE_SAISONS_2", "ainsi que les championnats et les rencontres attachées");
define("ADMIN_SECURITE_CLASSE", "Etes vous sur de vouloir supprimer la classe suivante :");
define("ADMIN_SECURITE_CHAMP", "Etes vous sur de vouloir supprimer le championnat suivant :");

?>
