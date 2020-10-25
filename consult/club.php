<?php
/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des ".$xoopsDB->prefix("clubs")."  (Fiches clubs), mini-".$xoopsDB->prefix("classe")." ment,                     //
//               statistiques, amélioration de la gestion des xoops_buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/".$xoopsDB->prefix("classe")." ment/consult/classement.php?champ=2 //
// Description : Edition, gestion, Fiches clubs, statistiques, mini-".$xoopsDB->prefix("classe")." ment...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

include "avant.php";
if (!$marqueur == '1') {
    require "../config.php";
    require "../consult/fonctions.php";
}
$marqueur = "1";
echo "<br><br>";
//Choix du championnat
if (!$champ) {
    require_once XOOPS_ROOT_PATH . '/header.php';
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h4 align=\"center\">";
    echo ADMIN_TAPVERT_MSG2;
    echo "</h4>";
    echo "<select name=\"champ\" align=\"center\">";
    echo "<option value=\"0\" align=\"center\"> </option>";
    $query  = "SELECT DISTINCT " . $xoopsDB->prefix("divisions") . " .nom, " . $xoopsDB->prefix("saisons") . " .annee, " . $xoopsDB->prefix("championnats") . " .id 
        FROM " . $xoopsDB->prefix("championnats") . " , " . $xoopsDB->prefix("divisions") . " , " . $xoopsDB->prefix("saisons") . " , " . $xoopsDB->prefix("journees") . " 
        WHERE " . $xoopsDB->prefix("journees") . " .id_champ=" . $xoopsDB->prefix("championnats") . " .id AND " . $xoopsDB->prefix("championnats") . " .id_division=" . $xoopsDB->prefix("divisions") . " .id AND " . $xoopsDB->prefix("championnats") . " .id_saison=" . $xoopsDB->prefix("saisons") . " .id 
        ORDER BY " . $xoopsDB->prefix("saisons") . " .annee DESC, " . $xoopsDB->prefix("championnats") . " .id";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
} // Choix du club
elseif (!isset($id_clubs)) {
    $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .id, " . $xoopsDB->prefix("clubs") . " .nom, id_champ, id_club
FROM " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " 
WHERE " . $xoopsDB->prefix("equipes") . " .id_champ='$champ' and " . $xoopsDB->prefix("equipes") . " .id_club=" . $xoopsDB->prefix("clubs") . " .id 
ORDER BY nom";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    require_once XOOPS_ROOT_PATH . '/header.php';
    echo "<font color=\"#006a36\" size=\"3\"><center><u>" . ADMIN_EQUIPE_TITRE . "</font></u>";
    echo "<form action=\"club.php\" method=\"GET\">";
    echo "&nbsp;";
    echo "&nbsp;";
    echo ADMIN_EQUIPE_2;
    echo "<select name=\"id_clubs\">";
    echo "<option value=\"0\"> </option>";

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $a = $row[1] + 1;
        echo(" <option value=\"$row[0]\">$row[1]");
        echo("</option>\n>");
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);

    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button>";
    echo "<input type=\"hidden\" name=\"champ\" value='$champ'>";
    echo "</form>";
    require_once XOOPS_ROOT_PATH . '/footer.php';
} // Le choix du club étant fait on affiche la fiche du club
else {
    require_once XOOPS_ROOT_PATH . '/header.php';
}
{
    $query  = "select " . $xoopsDB->prefix("clubs") . " .id, " . $xoopsDB->prefix("logo") . " .url from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("logo") . "  where " . $xoopsDB->prefix("clubs") . " .id='$id_clubs' and id_club='$id_clubs'";
    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<center><img src=\"$row[1]\"><br><br><br><br>";
    }

    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    $query  = "select " . $xoopsDB->prefix("classe") . " .nom, " . $xoopsDB->prefix("classe") . " .id FROM " . $xoopsDB->prefix("classe") . "  order by rang";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<table  2 cellspacing=\"0\" align=center>";
        echo "<tr  3><td><b><font color=\"#FFFFFF\">$row[0]</font></b></td></tr>";
        $id_classe = $row[1];
        echo "<td><table cellspacing=\"0\"><tr><td><font face=\"arial\">";
        $aff_xoops_rens = aff_xoops_rens($id_classe, $id_clubs);
        echo "$aff_xoops_rens</font>";
        echo "</tr></td>";
        echo "</table></td></table><br><br><br><br>";
    }

    echo "<table  2 cellspacing=\"0\" align=center><tr  3><td><b><font color=\"#FFFFFF\">" . CONSULT_CLUB_4 . "</font></b></td></tr>";

    $query  = "select "
              . $xoopsDB->prefix("equipes")
              . " .id from "
              . $xoopsDB->prefix("equipes")
              . " , "
              . $xoopsDB->prefix("clubs")
              . "  where "
              . $xoopsDB->prefix("clubs")
              . " .id=$id_clubs and id_champ=$champ and "
              . $xoopsDB->prefix("clubs")
              . " .id="
              . $xoopsDB->prefix("equipes")
              . " .id_club";
    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $equipe = $row[0];

        echo "<tr><td><center><img src=\"graph.php?equipe=$equipe\" ></img></center></td></tr>";
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</table><br><br><br>";

    //$GLOBALS['xoopsDB']->freeRecordSet($result);

    echo "<table  2 cellspacing=\"0\" align=center><tr  3><td><b><font color=\"#FFFFFF\">" . CONSULT_CLUB_3 . "</font></b></td></tr>";
    $query  = "select annee, " . $xoopsDB->prefix("divisions") . " .nom, " . $xoopsDB->prefix("championnats") . " .id, " . $xoopsDB->prefix("equipes") . " .id
FROM " . $xoopsDB->prefix("saisons") . " , " . $xoopsDB->prefix("championnats") . " , " . $xoopsDB->prefix("divisions") . " , " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " 
WHERE " . $xoopsDB->prefix("equipes") . " .id_champ=" . $xoopsDB->prefix("championnats") . " .id
AND id_division=" . $xoopsDB->prefix("divisions") . " .id
AND " . $xoopsDB->prefix("clubs") . " .id=id_club
AND " . $xoopsDB->prefix("equipes") . " .id_club='$id_clubs'
AND " . $xoopsDB->prefix("saisons") . " .id=" . $xoopsDB->prefix("championnats") . " .id_saison order by annee desc";
    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<tr><td>";
        echo "<tr  2><td><center>$row[0]/" . ($row[0] + 1) . " ($row[1])</td></tr>";
        echo "<tr><td><a href=\"classement.php?champ=$row[2]&type=G%E9n%E9ral\">" . CONSULT_CLUB_1 . "</a></td></tr>";
        echo "<tr><td><a href=\"detaileq.php?champ=$row[2]&equipe=$row[3]\">" . CONSULT_CLUB_2 . "</a></td></tr>";
        echo "<tr><td><a href=\"#\" onClick=\"window.open('graph.php?equipe=$row[3]','Stats','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=560,height=320');\">" . CONSULT_CLUB_4 . "</a><br><br></td></tr>";
        echo "</td></tr>";
    }

    //$GLOBALS['xoopsDB']->freeRecordSet($result);

    echo "</table><br><br>";

    $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .id, " . $xoopsDB->prefix("clubs") . " .nom, id_champ, id_club
FROM " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " 
WHERE " . $xoopsDB->prefix("equipes") . " .id_champ='$champ' and " . $xoopsDB->prefix("equipes") . " .id_club=" . $xoopsDB->prefix("clubs") . " .id 
ORDER BY nom";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    echo "<font color=\"#006a36\" size=\"3\"><center><u></font></u>";
    echo "<form action=\"club.php\" method=\"GET\" onSubmit=\"\">";
    echo "&nbsp;";
    echo "&nbsp;";

    //echo ADMIN_EQUIPE_2;

    echo "<select name=\"id_clubs\">";
    echo "<option value=\"0\"> </option>";

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $a = $row[1] + 1;
        echo(" <option value=\"$row[0]\">$row[1]");
        echo("</option>\n>");
    }

    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</select>";

    $button = ENVOI;
    echo "<input type=\"submit\" value=$button>";
    echo "<input type=\"hidden\" name=\"champ\" value='$champ'>";
    echo "</form>";
    if ($HTTP_REFERER == '') {
        $HTTP_REFERER = "classement.php?champ=2&type=Général";
    }
    echo "<center><a href=\"$HTTP_REFERER\"><b>" . RETOUR . "</b></a>";
}
require_once XOOPS_ROOT_PATH . '/footer.php';
?>
