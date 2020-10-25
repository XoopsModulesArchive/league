<html>
<head>
    <title>Edition des xoops_clubs</title>
    <link rel="stylesheet" type="text/css" href="../league.css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des xoops_clubs (Fiches clubs), mini-xoops_classement,                     //
//               statistiques, amélioration de la gestion des xoops_buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/xoops_classement/consult/classement.php?champ=2 //
// Description : Edition, gestion, Fiches clubs, statistiques, mini-xoops_classement...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

require "../config.php";
require "fonctions.php";

ENTETE();

print ("<script language=\"javascript\">\n");
print ("function demander_confirmation($data)\n");
print ("{\n");
// confirm() fait apparaitre la boite de dialogue
print ("if (confirm(\"Etes vous sur de vouloir...$data\"))\n");
print ("{\n");
// action à faire si OK (soumettre le formulaire)
print ("return true;\n");
print ("}\n");
print ("else\n");
print ("{\n");
// action à faire si 'Annuler' (ici, rien)
print ("return false;\n");
print ("}\n");
print ("}\n");
print ("</script>\n");

if ($go == 'previous') {
    $result = $GLOBALS['xoopsDB']->queryF("select * from xoops_clubs where id='$data'");
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $a = $row[1] + 1;
        echo ADMIN_CLUB_1 . " '<b>$row[1]</b>' ? ";
        echo "<a href=?data=$data&go=suppclub>" . ADMIN_xoops_rens_17 . "</a> - ";
        echo "<a href=\"javascript:history.back()\">" . ADMIN_xoops_rens_18 . "</a>";
    }
} elseif ($go == 'suppclub') {
    $GLOBALS['xoopsDB']->queryF(" delete from xoops_clubs where id='$data' ") or die ("probleme " . $GLOBALS['xoopsDB']->error());
    $GLOBALS['xoopsDB']->queryF("delete from xoops_donnee where id_clubs='$data'") or die ("probleme " . $GLOBALS['xoopsDB']->error());
    echo "<font color=green>" . ADMIN_CLUB_SUPP2 . "</font>";
} elseif ($go == 'creclub') {
    $GLOBALS['xoopsDB']->queryF("insert into xoops_clubs (nom) values ('$data')") or die ("probleme " . $GLOBALS['xoopsDB']->error());

    $id = id($data);
    $GLOBALS['xoopsDB']->queryF("insert into xoops_logo (id_club) values ('$id')") or die ("probleme " . $GLOBALS['xoopsDB']->error());
    $query  = "select id from xoops_rens";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $GLOBALS['xoopsDB']->queryF("insert into xoops_donnee (id_clubs, id_rens) values ('$id', '$row[0]')") or die ("probleme " . $GLOBALS['xoopsDB']->error());
    }
    echo "<font color=green>" . ADMIN_CLUB_CREA2 . "</font>";
} else {
    echo "<h1>";
    echo ADMIN_CLUB_TITRE;
    echo "</h1>";

    // SUPPRESSION

    echo "<form action=\"$PHP_SELF\" method=\"GET\" name= \"confirm\" >";
    echo "<HR>";
    echo ADMIN_CLUB_SUPP1;
    echo "<select name=\"data\">";
    echo "<option value=\"0\"> </option>";
    $result = $GLOBALS['xoopsDB']->queryF("select * from xoops_clubs ORDER BY nom");
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $nom = $row["nom"];
        $a   = $row[1] + 1;
        echo(" <option value=\"$row[0]\">$row[1]");
        echo("</option>\n>");
    }
    echo "</select>";

    $button = ADMIN_CLUB_BUTTON_SUPP;
    echo "<input type=\"submit\" name=\"envoi\" value=$button onClick=\"return demander_confirmation($data)\">";
    //echo "<input type=\"hidden\" name=\"go\" value=\"suppclub\" >";

    echo "</form>";
    echo "<HR>";
    echo ADMIN_CLUB_CREA;
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo ADMIN_CLUB_NOM;
    echo "<input type=\"text\" size=\"30\" name=\"data\">";
    echo "<input type=\"hidden\" name=\"go\" value=\"creclub\">";

    $button = ADMIN_CLUB_BUTTON_CREA;
    echo "<input type=\"submit\" value=$button></form>";
    echo ADMIN_CLUB_BUTTON_MSG3;
    echo "<br><br>";
    //ENTETE();
}
?>
</body>
</html>
