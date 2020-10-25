<?
//AVERTISSEMENT EN PAGE D'ADMINISTRATION
define(AVERTISSEMENT,&quot;NOTE : PhpLeague 0.71 is still a beta version&lt;br&gt;
no much controls so be carefull when you delete some datas&quot;);


// ENTREES DU MENU ADMINISTRATION
define(SOUS_TITRE,&quot;Tabellen Management (MySQL)&quot;);
define(SEASON,&quot;Saison&quot;);
define(CLUB,&quot;Club&quot;);
define(DIVISION,&quot;Liga&quot;);
define(LEAGUE,&quot;Meisterschaft&quot;);
define(TEAM,&quot;Mannschaft&quot;);
define(CALENDAR,&quot;Spielplan&quot;);
define(DATE,&quot;Datum&quot;);
define(MATCH,&quot;Spiele&quot;);
define(COHERENCE,&quot;Konsistenz&quot;);
define(RESULT,&quot;Resultate&quot;);
define(JOUEUR,&quot;Spieler&quot;);
define(BUTEUR,&quot;Torsch&amp;uuml;tzen&quot;);
define(TAP_VERT,&quot;Sanktionen&quot;);
define(PARAMETRE,&quot;Einstellungen&quot;);
define(CONSULT,&quot;&amp;Ouml;ffentlicher Bereich&quot;);

// FICHIER admin/saisons.php
define(ADMIN_SAISON_TITRE,&quot;Saison Management&quot;);
define(ADMIN_SAISON_SUPP1,&quot;Saison &lt;b&gt;L&amp;Ouml;SCHEN&lt;/b&gt;&quot;);
define(ADMIN_SAISON_SUPP2,&quot;Saison &lt;b&gt;l&amp;ouml;schen&lt;/b&gt;&quot;);
define(ADMIN_SAISON_BUTTON_SUPP,&quot;L&amp;ouml;sche_Saison&quot;);
define(ADMIN_SAISON_MSG1,&quot;Durch das L&amp;ouml;schen einer Saison werden alle zu dieser
Saison gehörigen Daten gel&amp;ouml;scht!!!&quot;);
define(ADMIN_SAISON_CREA,&quot;Saison &lt;b&gt;ANLEGEN&lt;/b&gt;&quot;);
define(ADMIN_SAISON_MSG2,&quot;Erstes Jahr der Saison : &quot;);
define(ADMIN_SAISON_BUTTON_CREA,&quot;Anlegen&quot;); 
define(ADMIN_SAISON_BUTTON_MSG3,&quot;&lt;b&gt;Ändern&lt;/b&gt; einer Saison mit PHPMyAdmin&quot;);
define(ADMIN_CRESAISON_MSG1,&quot;&lt;b&gt;Saison angelegt&lt;/b&gt;&quot;);
define(ADMIN_SUPPSAISON_MSG1,&quot;&lt;b&gt;Saison gel&amp;ouml;scht&lt;/b&gt;&quot;);

// FICHIER admin/clubs.php
define(ADMIN_CLUB_TITRE,&quot;Club Management&quot;);
define(ADMIN_CLUB_SUPP1,&quot;Club &lt;b&gt;L&amp;ouml;schen&lt;/b&gt;&quot;);
define(ADMIN_CLUB_BUTTON_SUPP,&quot;L&amp;ouml;sche_Club&quot;);
define(ADMIN_CLUB_CREA,&quot;Club &lt;b&gt;hinzuf&amp;uuml;gen&lt;/b&gt;&quot;);
define(ADMIN_CLUB_NOM,&quot;Clubname: &quot;);
define(ADMIN_CLUB_BUTTON_CREA,&quot;Anlegen&quot;); 
define(ADMIN_CLUB_BUTTON_MSG3,&quot;&lt;b&gt;Ändern&lt;/b&gt; eines Clubs mit PHPMyAdmin&quot;);

// Admin/divisions.php
define(ADMIN_DIVISION_TITRE,&quot;Liga Management&quot;);
define(ADMIN_DIVISION_BUTTON_CREA,&quot;Anlegen&quot;);
define(ADMIN_DIVISION_MSG1,&quot;Vorhandene Ligen : &quot;);

// admin/championnats.php
define(ADMIN_CHAMPIONNATS_TITRE,&quot;Meisterschaften Management&quot;);
define(ADMIN_CHAMPIONNATS_SUPP,&quot;Meisterschaft &lt;b&gt;L&amp;Ouml;SCHEN&lt;/b&gt;&quot;);
define(ADMIN_CHAMPIONNATS_BUTTON_SUPP,&quot;L&amp;ouml;schen&quot;);
define(ADMIN_CHAMPIONNATS_CREA,&quot;Meisterschaft anlegen&quot;);
define(ADMIN_CHAMPIONNATS_MSG1,&quot;Welche Liga ? &quot;);
define(ADMIN_CHAMPIONNATS_MSG2,&quot;Welche Saison ? &quot;);
define(ADMIN_CHAMPIONNATS_BUTTON_CREA, &quot;Anlegen&quot;);
define(ADMIN_CHAMPIONNATS_BUTTON_MSG3,&quot;&lt;b&gt;Ändern&lt;/b&gt; einer Meisterschaft mit
PHPMyAdmin&quot;);

// admin/equipes.php
define(ADMIN_EQUIPE_TITRE,&quot;Mannschaften Management&quot;);
define(ADMIN_EQUIPE_MSG1,&quot;&lt;b&gt;L&amp;ouml;schen&lt;/b&gt; einer oder mehrerer Mannschaft(en) -
(Mehrfachauswahl &amp;uuml;ber SHIFT und CTRL Tasten)&quot;);
define(ADMIN_EQUIPE_MSG2,&quot;Mannschaft(en) l&amp;ouml;schen: &quot;);
define(ADMIN_EQUIPE_MSG3,&quot;&lt;b&gt;Tipp: &lt;/b&gt;(Mehrfachauswahl &amp;uuml;ber SHIFT und CTRL
Tasten) &quot;);
define(ADMIN_EQUIPE_MSG4,&quot; in &quot;);
define(ADMIN_EQUIPE_MSG5,&quot;&lt;b&gt;Ändern&lt;/b&gt; einer Mannschaft mit PHPMyAdmin&lt;br&gt;&lt;br&gt;&quot;);

// admin/journees.php
define(ADMIN_JOURNEES_TITRE,&quot;Spielplan Management&quot;);
define(ADMIN_JOURNEES_MSG1,&quot;Geben Sie die Nr. der Meisterschaft ein, f&amp;uuml;r die
Sie den Spielplan (Kalender) erstellen m&amp;ouml;chten&lt;/b&gt;&lt;br&gt;Achtung : kein
Konsistenzcheck!&lt;br&gt;&quot;);
define(ADMIN_JOURNEES_MSG2,&quot;&lt;b&gt;Meisterschaftsspielplan wirklich anlegen ?&lt;/b&gt;&quot;);
define(ADMIN_JOURNEES_MSG3,&quot;Saison&quot;);
define(ADMIN_JOURNEES_MSG4,&quot; Mannschaften, sind &quot;);
define(ADMIN_JOURNEES_MSG5,&quot; Spieltage&quot;);
define(ADMIN_JOURNEES_MSG6,&quot;JA&quot;);
define(ADMIN_JOURNEES_MSG7,&quot;NEIN&quot;);
define(ADMIN_JOURNEES_MSG8,&quot;Datum f&amp;uuml;r jeden Spieltag :&quot;);
define(ADMIN_JOURNEES_MSG9,&quot;Spieltag Nr. &quot;);
define(ADMIN_JOURNEES_MSG10,&quot; Datumsformat : &lt;b&gt;DDMMYYYY&lt;b&gt;&quot;);
define(ADMIN_JOURNEES_MSG11,&quot; Spieltage angelegt&quot;); 

// admin/dates.php
define(ADMIN_DATES_TITRE,&quot;Spieltag - Datum zuordnen &quot;);
define(ADMIN_DATES_MSG1,&quot; Meisterschaft f&amp;uuml;r Spieltag - Datum Zuordnung? &quot;);
define(ENVOI,&quot;Senden&quot;);

// admin/matchs
define(ADMIN_MATCHS_TITRE,&quot;Spiele Administration &quot;);
define(ADMIN_MATCHS_MSG1,&quot;F&amp;uuml;r welche Meisterschaft m&amp;ouml;chten Sie die
Spieltage/Paarungen erfassen?  &quot;);
define(ADMIN_MATCHS_MSG2,&quot;Spieltag? &quot;);
define(ADMIN_MATCHS_MSG3,&quot;&lt;b&gt;Achtung, kein Konsistenzchek... &lt;/b&gt;&lt;br&gt;&quot;);
define(ADMIN_DOMICILE,&quot;Heim&quot;);
define(ADMIN_EXTERIEUR,&quot;Ausw&amp;auml;rts&quot;);
define(ADMIN_MATCHS_MSG4,&quot;N&amp;auml;chster Spieltag : &quot;);

// cohérence
define(ADMIN_COHERENCE_TITRE,&quot; Spielplan Konsistenzpr&amp;uuml;fung &quot;);
define(ADMIN_COHERENCE_MSG1,&quot;Konsitenzcheck f&amp;uuml;r welchen Spielplan?   &quot;);
define(ADMIN_COHERENCE_MSG2,&quot;Spieltag  &quot;);
define(ADMIN_COHERENCE_MSG3,&quot; ist konsistent&quot;);
define(ADMIN_COHERENCE_MSG4,&quot;&lt;b&gt;inkonsisten oder unvollst&amp;auml;ndig &lt;/b&gt;&quot;);
define(ADMIN_COHERENCE_MSG5,&quot;Der Spielplan dieser Meisterschaft scheint konsistent
zu sein &quot;);
define(ADMIN_COHERENCE_MSG6,&quot;Der Spielplan dieser Meisterschaft scheint inkonsistent
zu sein &quot;);

// Joueurs et buteurs
define(ADMIN_BUTEURS_TITRE,&quot;Torsch&amp;uuml;tzen Administration&quot;);
define(ADMIN_BUTEURS_MSG1,&quot;Torsch&amp;uuml;tzen erfassen f&amp;uuml;r Meisterschaft?&quot;);
define(ADMIN_BUTEURS_MSG2,&quot;Torsch&amp;uuml;tzen erfassen f&amp;uuml;r Spieltag?&quot;); 
define(ADMIN_BUTEURS_LAST,&quot;zur&amp;uuml;ck&quot;);
define(ADMIN_BUTEURS_NEXT,&quot;vor&quot;);
define(ADMIN_BUTEURS_MSG3,&quot;Anlegen_und_n&amp;auml;chster_Torsch&amp;uuml;tze &quot;); // laisser
des _ à la place des espaces
define(ADMIN_JOUEURS_TITRE,&quot;Spieler Administration&quot;);
define(ADMIN_JOUEURS_MSG1,&quot;Spieler &lt;b&gt;l&amp;ouml;schen&lt;/b&gt; &quot;);
define(ADMIN_JOUEURS_MSG2,&quot;Spieler_l&amp;ouml;schen&quot;);
define(ADMIN_JOUEURS_MSG3,&quot;Spieler &lt;b&gt;hinzuf&amp;uuml;gen&lt;/b&gt;&quot;);
define(ADMIN_JOUEURS_MSG4,&quot;Vorname:   &quot;);
define(ADMIN_JOUEURS_MSG5,&quot;Nachname:  &quot;);
define(ADMIN_JOUEURS_MSG6,&quot;Club :  &quot;);
define(ADMIN_JOUEURS_MSG7,&quot;URL Foto : &quot;);
define(ADMIN_JOUEURS_MSG8,&quot;Geburtsdatum: (DDMMYYYY)  &quot;);
define(ADMIN_JOUEURS_MSG9,&quot;Position:   &quot;);
define(ADMIN_JOUEURS_MSG10,&quot;&lt;b&gt;Ändern&lt;/b&gt; eines Spielers/Torsch&amp;uuml;tzen mit
PHPMyAdmin&quot;);
  





// résultats
define(ADMIN_RESULTATS_TITRE,&quot;Resultate Administration&quot;);
define(ADMIN_RESULTATS_MSG1,&quot;Resultate erfassen f&amp;uuml;r Meisterschaft?&quot;);
define(ADMIN_RESULTATS_MSG2,&quot;Resultate erfassen f&amp;uuml;r Spieltag?&quot;);

// Tapis vert
define(ADMIN_TAPVERT_TITRE,&quot;Strafpunkte&quot;);
define(ADMIN_TAPVERT_MSG1,&quot;Hier k&amp;ouml;nnen Sie Mannschaften mit Strafpunkten
belasten!&quot;);
define(ADMIN_TAPVERT_MSG2,&quot;Meisterschaft? &quot;);
define(ADMIN_TAPVERT_MSG3,&quot;Geben Sie die Strafpunkte ein (Bsp.: -1, -2 ...) &quot;);

// Paramètres
define(ADMIN_PARAM_TITRE,&quot;Einstellungen &quot;);
define(ADMIN_PARAM_MSG1,&quot;Einstellungen f&amp;uuml;r welche Meisterschaft? &quot;);
define(ADMIN_PARAM_MSG2,&quot;Punkte f&amp;uuml;r einen Sieg ?:  &quot;);
define(ADMIN_PARAM_MSG3,&quot;Punkte f&amp;uuml;r ein Unentschieden ? :&quot;);
define(ADMIN_PARAM_MSG4,&quot;Punkte f&amp;uuml;r eine Niederlage ? :&quot;);
define(ADMIN_PARAM_MSG5,&quot;Anzahl der direkten Aufsteiger  ?:  &quot;);
define(ADMIN_PARAM_MSG6,&quot;Anzahl der Relegationspl&amp;auml;tze (Aufsteiger) ?: &quot;);
define(ADMIN_PARAM_MSG7,&quot;Anzahl der Absteiger  ?:  &quot;);
define(ADMIN_PARAM_MSG8,&quot;Bevorzugte Mannschaft ? &quot;); 
define(ADMIN_PARAM_MSG9,&quot;Einstellungen gespeichert &quot;);

/* ZONE PUBLIQUE : CONSULTATION */

// Entete et index
define(CONSULT_HOME,&quot;Startseite&quot;);
define(CONSULT_CALENDAR,&quot;Spielplan &quot;);
define(CONSULT_CLASSEMENT,&quot;Tabellen &quot;);
define(CONSULT_BUTEUR,&quot;Torsch&amp;uuml;tzen&quot;);
define(CONSULT_DUEL,&quot;Duell&quot;);
define(MENU_UTILISATEUR,&quot;Hauptmen&amp;uuml;&quot;);


//classement
define(CONSULT_CLMNT_MSG1,&quot;Tabellenstand: &quot;);
define(GENERAL,&quot;Gesamt&quot;);
define(DOMICILE,&quot;Heim&quot;);
define(EXTERIEUR,&quot;Ausw&amp;auml;rts&quot;);
define(ATTAQUE,&quot;Tore geschossen&quot;);
define(DEFENSE,&quot;Tore erhalten&quot;);
define(GOALDIFF,&quot;Tordifferenz&quot;);
define(CONSULT_CLMNT_MSG2,&quot; von Spieltag &quot;);
define(CONSULT_CLMNT_MSG3,&quot; bis Spieltag &quot;);
define(CONSULT_CLMNT_MSG4,&quot;Tabelle, Spieltag: &quot;);
define(CONSULT_CLMNT_MSG5,&quot; - &quot;);
define(CONSULT_CLMNT_MSG6,&quot;Resultate: Spieltag N°&quot;);
define(CONSULT_CLMNT_MSG7,&quot;Tore f&amp;uuml;r den n&amp;auml;chsten Spieltag (Vorhersage): &quot;);
define(CONSULT_CLMNT_MSG8,&quot;Berechnete Wahrscheinlichkeit f&amp;uuml;r&lt;br&gt;den
n&amp;auml;chsten Spieltag: N° &quot;);
define(CONSULT_CLMNT_MSG9,&quot;n&amp;auml;chster Spieltag : N° &quot;);
define(CONSULT_CLMNT_MSG10,&quot;Heimtabelle, Spieltag: &quot;);
define(CONSULT_CLMNT_MSG11,&quot;Tabelle nach Tore geschossen, Spieltag: &quot;);
define(CONSULT_CLMNT_MSG12,&quot;Tabelle nach Tore erhalten, Spieltag: &quot;);
define(CONSULT_CLMNT_MSG13,&quot;Tabelle nach Tordiffernez, Spieltag: &quot;);
define(CONSULT_CLMNT_MSG14,&quot;Ausw&amp;auml;rtstabelle, Spieltag &quot;);
define(CLMNT_POSITION,&quot;Pl&quot;);
define(CLMNT_EQUIPE,&quot; &quot;);
define(CLMNT_POINTS,&quot;Pkt&quot;);
define(CLMNT_JOUES,&quot; Sp &quot;);
define(CLMNT_VICTOIRES,&quot;s &quot;);
define(CLMNT_NULS,&quot;u &quot;);
define(CLMNT_DEFAITES,&quot;n &quot;);
define(CLMNT_BUTSPOUR,&quot;+ &quot;);
define(CLMNT_BUTSCONTRE,&quot;- &quot;);
define(CLMNT_DIFF,&quot;Diff &quot;);
define(EXEMPT,&quot;Spielfrei&quot;);

// Matchs
define(CONSULT_MATCHS,&quot;Spielplan &quot;);
define(CONSULT_MATCHS_MSG1,&quot;F&amp;uuml;r Meisterschaft ? &quot;);
define(CONSULT_MATCHS_MSG2,&quot;  &quot;);

// Detail equipe

define(VICTOIRE,&quot;SIEG &quot;);
define(NUL,&quot; UNENTSCHIEDEN &quot;);
define(DEFAITE,&quot; NIEDERLAGE&quot;);

// divers
define(RETOUR,&quot;ZUR&amp;Uuml;CK&quot;);


// *********************************************
// ***** IF SOME TRANSLATION ARE MISSING, TAKE THE ENGLISH VERSION ****
// *********************************************


include "../lang/lang_en.php";



?>
