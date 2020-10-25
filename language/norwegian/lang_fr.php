<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?

//AVERTISSEMENT EN PAGE D'ADMINISTRATION
define(
    AVERTISSEMENT,
    "NOTE : PhpLeague 0.7 is still a beta version<br>
no much controls so be carefull when you delete some datas"
);

// ENTREES DU MENU ADMINISTRATION
define(SOUS_TITRE, "Tables management (MySQL)");
define(SEASON, "Seasons");
define(CLUB, "Clubs");
define(DIVISION, "Leagues");
define(LEAGUE, "Championships");
define(TEAM, "Teams");
define(CALENDAR, "Calendar");
define(DATE, "Dates");
define(MATCH, "Matchs");
define(COHERENCE, "Coherence");
define(RESULT, "Results");
define(JOUEUR, "Players");
define(BUTEUR, "Strikers");
define(TAP_VERT, "Tapis Vert");
define(PARAMETRE, "Parameters");
define(RENS, "Clubs information");
define(EQUIPE, "Clubs management");
define(CLASSE, "Classes");
define(CONSULT, "PUBLIC ZONE");
define(VERIF, "Checking team");           //
define(MINI, "Small clasification");      //

// FICHIER admin/saisons.php
define(ADMIN_SAISON_TITRE, "Seasons management");
define(ADMIN_SAISON_SUPP1, "<b>DELETE</b> a season");
define(ADMIN_SAISON_SUPP2, "<b>Delete</b> a season");
define(ADMIN_SAISON_BUTTON_SUPP, "Delete_season");
define(ADMIN_SAISON_MSG1, "Deleting a season, it's also deleting everythings in this season !!!");
define(ADMIN_SAISON_CREA, "<b>CREATE</b> a season");
define(ADMIN_SAISON_MSG2, "First year of the season : ");
define(ADMIN_SAISON_BUTTON_CREA, "Create");
define(ADMIN_SAISON_BUTTON_MSG3, "To <b>modify</b>, use PHPMyAdmin");
define(ADMIN_CRESAISON_MSG1, "<b>Creation done </b>");
define(ADMIN_SUPPSAISON_MSG1, "<b>Deletion done</b>");

// FICHIER admin/clubs.php
define(ADMIN_CLUB_TITRE, "Clubs management");
define(ADMIN_CLUB_SUPP1, "<b>Delete</b> a club ");
define(ADMIN_CLUB_BUTTON_SUPP, "Delete_club");
define(ADMIN_CLUB_CREA, "<b>Add</b> a club");
define(ADMIN_CLUB_NOM, "Name of the club: ");
define(ADMIN_CLUB_BUTTON_CREA, "Create");
define(ADMIN_CLUB_BUTTON_MSG3, "To <b>modify</b>, use PHPMyAdmin");
define(ADMIN_CLUB_CREA2, "<b>Creating done</b>");
define(ADMIN_CLUB_SUPP2, "<b>Deleting done</b>");

// Admin/divisions.php
define(ADMIN_DIVISION_TITRE, "Divisions management");
define(ADMIN_DIVISION_BUTTON_CREA, "Create");
define(ADMIN_DIVISION_MSG1, "Existing divisions : ");

// admin/championnats.php
define(ADMIN_CHAMPIONNATS_TITRE, "Championships management");
define(ADMIN_CHAMPIONNATS_SUPP, "<b>DELETE</b> a championship");
define(ADMIN_CHAMPIONNATS_BUTTON_SUPP, "Delete");
define(ADMIN_CHAMPIONNATS_CREA, "Create a championship");
define(ADMIN_CHAMPIONNATS_MSG1, "Which division ? ");
define(ADMIN_CHAMPIONNATS_MSG2, "Which season ? ");
define(ADMIN_CHAMPIONNATS_BUTTON_CREA, "Create");
define(ADMIN_CHAMPIONNATS_BUTTON_MSG3, "To <b>modify</b>, use PHPMyAdmin");

// admin/equipes.php
define(ADMIN_EQUIPE_TITRE, "Teams management");
define(ADMIN_EQUIPE_MSG1, "<b>Delete</b> one or several team(s) (Multiple choice possible whith SHIFT and CTRL keys). <b>Be careful there is no demand of confirmation !</b>");
define(ADMIN_EQUIPE_MSG2, "Team to delete: ");
define(ADMIN_EQUIPE_MSG3, "<b>Register </b>(Multiple choice possible whith SHIFT and CTRL keys) ");
define(ADMIN_EQUIPE_MSG4, " in ");
define(ADMIN_EQUIPE_MSG5, "Use PHPMyAdmin to <b>modify</b><br><br>");

// admin/journees.php
define(ADMIN_JOURNEES_TITRE, "Days management (calendar)");
define(ADMIN_JOURNEES_MSG1, "Type the N° of championship for which you want to create a calendar</b><br>be careful : no coherence control !<br>");
define(ADMIN_JOURNEES_MSG2, "<b>Are you sure you want to create this championship ?</b>");
define(ADMIN_JOURNEES_MSG3, "season");
define(ADMIN_JOURNEES_MSG4, " teams, so");
define(ADMIN_JOURNEES_MSG5, " days");
define(ADMIN_JOURNEES_MSG6, "YES");
define(ADMIN_JOURNEES_MSG7, "NO");
define(ADMIN_JOURNEES_MSG8, "Foreseen dates of each day :");
define(ADMIN_JOURNEES_MSG9, "Day No ");
define(ADMIN_JOURNEES_MSG10, " with this form : <b>DDMMYYYY<b>");
define(ADMIN_JOURNEES_MSG11, " teams registered");

// admin/dates.php
define(ADMIN_DATES_TITRE, "Seizure of the dates of every day ");
define(ADMIN_DATES_MSG1, " Which championship do you want to seize ?");
define(ENVOI, "Go");

// admin/matchs
define(ADMIN_MATCHS_TITRE, "Edition of the matches ");
define(ADMIN_MATCHS_MSG1, "Which championship do you want to seize ?");
define(ADMIN_MATCHS_MSG2, "Which day do you want to seize?");
define(ADMIN_MATCHS_MSG3, "Attention, no made control of coherence... </b>");
define(DOMICILE, "Home");
define(EXTERIEUR, "Outside");
define(ADMIN_MATCHS_MSG4, "Next day : ");

// cohérence
define(ADMIN_COHERENCE_TITRE, " Control of coherence of the calendar ");
define(ADMIN_COHERENCE_MSG1, "What calendar want to come true?   ");
define(ADMIN_COHERENCE_MSG2, "Day  ");
define(ADMIN_COHERENCE_MSG3, " is coherent");
define(ADMIN_COHERENCE_MSG4, "<b>Inconsistent or incomplete </b>");
define(ADMIN_COHERENCE_MSG5, "This championship seems coherent ");
define(ADMIN_COHERENCE_MSG6, "This championship seems inconsistent ");

// Joueurs et buteurs
define(ADMIN_BUTEURS_TITRE, "Edition of the strikers");
define(ADMIN_BUTEURS_MSG1, "which championship do you want to seize?");
define(ADMIN_BUTEURS_MSG2, "What day do you want to seize?");
define(ADMIN_BUTEURS_LAST, "Previous");
define(ADMIN_BUTEURS_NEXT, "Next");
define(ADMIN_BUTEURS_MSG3, "Validation_and_following_striker "); // laisser des _ à la place des espaces
define(ADMIN_JOUEURS_TITRE, "Edition of the players");
define(ADMIN_JOUEURS_MSG1, "<b>Deletion</b> of a player  ");
define(ADMIN_JOUEURS_MSG2, "delete_player");
define(ADMIN_JOUEURS_MSG3, "<b>Add</b> a player");
define(ADMIN_JOUEURS_MSG4, "First name:   ");
define(ADMIN_JOUEURS_MSG5, "Last name:  ");
define(ADMIN_JOUEURS_MSG6, "Club :  ");
define(ADMIN_JOUEURS_MSG7, "URL Photo : ");
define(ADMIN_JOUEURS_MSG8, "Date of birth: (DDMMYYYY)  ");
define(ADMIN_JOUEURS_MSG9, "Position Ground:   ");
define(ADMIN_JOUEURS_MSG10, "To <b>modify</b>, use PHPMyAdmin");
define(ADMIN_JOUEURS_1, "<b>Enter</b> the stickers. Click to <b>delete</b> him");
define(ADMIN_JOUEURS_2, "Sticks");
define(ADMIN_JOUEURS_3, "team : ");

// résultats
define(ADMIN_RESULTATS_TITRE, "Edition of the results");
define(ADMIN_RESULTATS_MSG1, "Which championship do you want to seize?");
define(ADMIN_RESULTATS_MSG2, "Which day do you want to seize?");

// Tapis vert
define(ADMIN_TAPVERT_TITRE, "Points of fine");
define(ADMIN_TAPVERT_MSG1, "Here, you can manage the points of fine (administrative penalties, fixed prices, etc...)");
define(ADMIN_TAPVERT_MSG2, "Which championship? ");
define(ADMIN_TAPVERT_MSG3, "Enter the points of fine (Ex: -1, -2 ...) ");

// Paramètres
define(ADMIN_PARAM_TITRE, "Parameters of championship ");
define(ADMIN_PARAM_MSG1, "Regulation of the parameters for which championship? ");
define(ADMIN_PARAM_MSG2, "Points for a victory?:  ");
define(ADMIN_PARAM_MSG3, "Points for a draw ? :");
define(ADMIN_PARAM_MSG4, "Points for a defeat ? :");
define(ADMIN_PARAM_MSG5, "Number of team for the direct entry  ?:  ");
define(ADMIN_PARAM_MSG6, "Number of team for the entry in dams ?: ");
define(ADMIN_PARAM_MSG7, "Number of team for the Banishment  ?:  ");
define(ADMIN_PARAM_MSG8, "Your favorite team? ");
define(ADMIN_PARAM_MSG9, "Registered (recorded) parameters ");

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
define(ADMIN_CLASSE_TITRE, "Edition of the classes");
define(ADMIN_CLASSE_SUPP1, "<b>Deletion</b> of one class ");
define(ADMIN_CLASSE_BUTTON_SUPP, "Delete class");
define(ADMIN_CLASSE_CREA, "<b>Add</b> one class");
define(ADMIN_CLASSE_NOM, "Name of the class : ");
define(ADMIN_CLASSE_BUTTON_CREA, "Creation of one class");
define(ADMIN_CLASSE_BUTTON_MSG3, "To <b>modify</b> the name of a class, use PHPMyAdmin");
define(ADMIN_CLASSE_1, "Ordering of classes : 1 : 1st, 2 : 2nd...");
define(ADMIN_CLASSE_2, "<b>Parameters recording !</b>");
define(ADMIN_CLASSE_3, "You aren't allowed to delete this class since it's used by ");
define(ADMIN_CLASSE_4, " information(s). Delete the content information(s) and then delete the class.");

// FICHIER admin/gestequipes.php
define(ADMIN_EQUIPE_TITRE, "Clubs consultation");
define(ADMIN_EQUIPE_2, "Choose a club : ");
define(ADMIN_EQUIPE_17, "Edition of team's informations");
define(ADMIN_EQUIPE_1, "Parameters of : ");
define(ADMIN_EQUIPE_3, "Name of the information");
define(ADMIN_EQUIPE_4, "Value if the information");
define(ADMIN_EQUIPE_5, "Url");
define(ADMIN_EQUIPE_6, "Showing (=1)<br>or not (=0)");
define(ADMIN_EQUIPE_7, "Url picture : ");
define(ADMIN_EQUIPE_8, "uninformed");

// FICHIER admin/rens.php
define(ADMIN_RENS_TITRE, "Clubs information");
define(ADMIN_RENS_SUPP1, "<b>Deletion</b> of an information ");
define(ADMIN_RENS_BUTTON_SUPP, "Delete");
define(ADMIN_RENS_CREA, "<b>Add</b> one information");
define(ADMIN_RENS_NOM, "Name of the information : ");
define(ADMIN_RENS_BUTTON_CREA, "Create");
define(ADMIN_RENS_CREA2, "<b>Creation done</b>");
define(ADMIN_RENS_SUPP2, "<b>Deletion done</b>");
define(ADMIN_RENS_1, " in the class : ");
define(ADMIN_RENS_2, "You aren't allowed to delete this information since it's used ");
define(ADMIN_RENS_3, " times in the informations.");
define(ADMIN_RENS_4, "<b>Add</b> the information in classes :");
define(ADMIN_RENS_5, "<b>Delete</b> parameters of the informations (Multiple choice possible whith SHIFT and CTRL keys) : ");
define(ADMIN_RENS_6, " in ");
define(ADMIN_RENS_7, "Add");
define(ADMIN_RENS_8, "Delete");
define(ADMIN_RENS_9, "Ordering informations : 1 : 1st, 2 : 2nd...");
define(ADMIN_RENS_10, "<b>Edit</b> informations");
define(ADMIN_RENS_11, "Save");
define(ADMIN_RENS_12, "Name of the information");
define(ADMIN_RENS_13, "URL of the information (optional)");
define(ADMIN_RENS_14, "Information to class :");
define(ADMIN_RENS_15, "All informations are classed");
define(ADMIN_RENS_16, "Are you sure you want to delete");
define(ADMIN_RENS_17, "Yes");
define(ADMIN_RENS_18, "No");

// Mini-classement
define(ADMIN_MINI_1, "Small classification");
define(ADMIN_MINI_2, "Choose a showing");
define(ADMIN_MINI_3, "Choose type of the classification");
define(ADMIN_MINI_4, "Choose a championship");
define(ADMIN_MINI_5, "Number of teams above the favorite team");
define(ADMIN_MINI_6, "Edit code");
define(ADMIN_MINI_7, "Remark");
define(ADMIN_MINI_8, "Championship isn't informed !");
define(ADMIN_MINI_9, "Type of classification isn't informed !");
define(ADMIN_MINI_10, "Showing isn't informed !");
define(ADMIN_MINI_11, "Invalided code !");
define(ADMIN_MINI_12, "Show");
define(ADMIN_MINI_13, "Here is the code you have to insert : ");
define(ADMIN_MINI_14, "Number of teams under the favorite team");
define(ADMIN_MINI_15, "Do you want to let the link on the teams ?");
define(ADMIN_MINI_16, "Path of the scrip (from the page which you're going to use the code)");
define(ADMIN_MINI_17, "Do show the whole classification");
define(ADMIN_MINI_18, "Show the whole classification");
define(ADMIN_MINI_19, "Number of teams above isn't informed !");
define(ADMIN_MINI_20, "Number of teams under isn't informed !");
define(ADMIN_MINI_21, "The code is valid !");
define(ADMIN_MINI_22, "Color");
define(ADMIN_MINI_23, "Lines");

/* ZONE PUBLIQUE : CONSULTATION */

// Entete et index
define(CONSULT_HOME, "Home");
define(CONSULT_CALENDAR, "Calendar");
define(CONSULT_CLASSEMENT, "Classifications ");
define(CONSULT_BUTEUR, "Strikers");
define(CONSULT_DUEL, "Duels");
define(MENU_UTILISATEUR, "User menu ");

//classement
define(CONSULT_CLMNT_MSG1, "Type of classification: ");
define(GENERAL, "General");
define(DOMICILE, "Home");
define(EXTERIEUR, "Outside");
define(ATTAQUE, "Attacks");
define(DEFENSE, "Defense");
define(GOALDIFF, "GoalAverage");
define(CONSULT_CLMNT_MSG2, " from day ");
define(CONSULT_CLMNT_MSG3, " to day ");
define(CONSULT_CLMNT_MSG4, "General classification, days ");
define(CONSULT_CLMNT_MSG5, " to ");
define(CONSULT_CLMNT_MSG6, "Last results : day N°");
define(CONSULT_CLMNT_MSG7, "ESTIMATION OF THE SCORES OF THE NEXT DAY: ");
define(CONSULT_CLMNT_MSG8, "PROBABILITY calculated of<br>the Next day: N° ");
define(CONSULT_CLMNT_MSG9, "Next day : N° ");
define(CONSULT_CLMNT_MSG10, "Home classification, days ");
define(CONSULT_CLMNT_MSG11, "Attacks classification, days ");
define(CONSULT_CLMNT_MSG12, "Defenses classification, days ");
define(CONSULT_CLMNT_MSG13, "Goal Average classification, days ");
define(CONSULT_CLMNT_MSG14, "Outside classification, days ");
define(CLMNT_POSITION, "Pos.");
define(CLMNT_EQUIPE, "Team");
define(CLMNT_POINTS, "Pts");
define(CLMNT_JOUES, " Pld ");
define(CLMNT_VICTOIRES, "HW ");
define(CLMNT_NULS, "HD ");
define(CLMNT_DEFAITES, "HL ");
define(CLMNT_BUTSPOUR, "AF ");
define(CLMNT_BUTSCONTRE, "AA ");
define(CLMNT_DIFF, "GD ");
define(EXEMPT, "Exempt");

// Matchs
define(CONSULT_MATCHS, "Consultation of calendars ");
define(CONSULT_MATCHS_MSG1, "Wich championship do you want to consult ?");
define(CONSULT_MATCHS_MSG2, "  ");

// Detail equipe

define(VICTOIRE, "WIN ");
define(NUL, " DRAW ");
define(DEFAITE, " LOST");
define(JOURNEE, "N°");

// divers
define(RETOUR, "BACK");

// division2.php
define(CONSULT_CALENDAR_1, "This day don't exist");
define(CONSULT_CALENDAR_2, "Preview day");
define(CONSULT_CALENDAR_3, "Next day");
define(CONSULT_CALENDAR_4, "Next matches : day n°");
define(CONSULT_CALENDAR_5, "Preview matches : day n°");

// consult/buteurs
define(CONSULT_BUTEUR_MSG1, "Which group of championship ?");
define(CONSULT_BUTEUR_MSG2, "Classification of the strickers");
define(CONSULT_BUTEUR_MSG3, "Group of championship : ");
define(CONSULT_BUTEUR_MSG4, "including : ");
define(CONSULT_BUTEUR_MSG5, "Which team ?");
define(JOURNEE_MIROIR, "Mirror day ? : ");
define(DUEL_MSG1, "Choose your opponent : ");
define(DUEL_MSG2, " Duels");
define(DUEL_MSG3, "Here are the probabilities");
define(DUEL_MSG4, "PROBABILITES : ");
define(DUEL_MSG5, "The probabilities are the result of of simple mathematic calculation");

// consult/club
define(CONSULT_CLUB_1, "Classement");
define(CONSULT_CLUB_2, "Calendrier et résultats");
define(CONSULT_CLUB_3, "Historique");
define(CONSULT_CLUB_4, "Statistiques");

//Graphique
define(ADMIN_GRAPH_TITRE, "Creation of the graphics");
define(ADMIN_GRAPH, "The creation was a success");
define(ADMIN_GRAPH_1, "The creation was a failure, try again !");
define(ADMIN_GRAPH_2, "You have to creat the graphics every time you enter a result. It can take a few time...");
define(ADMIN_GRAPH_3, "Development of the classification of");
define(
    ADMIN_GRAPH_4,
    "Error, try again.<br>
                      If this problem persit modifie the max_execution_time in C:\windows\php.ini"
);

// Security
define(ADMIN_SECURITE_CLUB, "Are you sure you want to delete the following clubs :");
define(ADMIN_SECURITE_RENS, "Are you sure you want to delete the following informations :");
define(ADMIN_SECURITE_SAISONS, "Are you sure you want to delete the following season :");
define(ADMIN_SECURITE_SAISONS_2, "and all the championships and the matches concerned");
define(ADMIN_SECURITE_CLASSE, "Are you sure you want to delete the following classe :");
define(ADMIN_SECURITE_CHAMP, "Are you sure you want to delete the following championship :");

// *********************************************
// ***** IF SOME TRANSLATION ARE MISSING, TAKE THE FRENCH VERSION ****
// *********************************************

include "../lang/lang_fr.php";

?>
