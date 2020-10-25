<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;

if (!$xoopsUser) {
    redirect_header('index.php', 3, _US_NOEDITRIGHT);
    exit();
}

include "../consult/avant.php";
require "../config.php";
require "../consult/fonctions.php";

//Choix du championnat
if (!$champ) {
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h4 align=\"center\">";
    echo ADMIN_TAPVERT_MSG2;
    echo "</h4>";
    echo "<select name=\"champ\" align=\"center\">";
    echo "<option value=\"0\" align=\"center\"> </option>";
    $query  = "SELECT DISTINCT " . $xoopsDB->prefix("divisions") . ".nom, " . $xoopsDB->prefix("saisons") . ".annee, " . $xoopsDB->prefix("championnats") . ".id 
        FROM " . $xoopsDB->prefix("championnats") . ", " . $xoopsDB->prefix("divisions") . ", " . $xoopsDB->prefix("saisons") . ", " . $xoopsDB->prefix("journees") . "
        WHERE " . $xoopsDB->prefix("journees") . ".id_champ=" . $xoopsDB->prefix("championnats") . ".id 
        AND " . $xoopsDB->prefix("championnats") . ".id_division=" . $xoopsDB->prefix("divisions") . ".id 
        AND " . $xoopsDB->prefix("championnats") . ".id_saison=" . $xoopsDB->prefix("saisons") . ".id
        ORDER BY " . $xoopsDB->prefix("saisons") . ".annee DESC, " . $xoopsDB->prefix("championnats") . ".id";
    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }

    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
} // On affiche toutes les fiches club du championnat selectionné
else {
    $query1  = "SELECT " . $xoopsDB->prefix("clubs") . ".id, nom
           FROM " . $xoopsDB->prefix("clubs") . ", " . $xoopsDB->prefix("equipes") . "
           WHERE id_champ='$champ'
           AND " . $xoopsDB->prefix("clubs") . ".id=id_club";
    $result1 = $GLOBALS['xoopsDB']->queryF($query1);
    while (false !== ($row1 = $GLOBALS['xoopsDB']->fetchRow($result1))) {
        $id = $row1[0];
        echo "</p>$row1[1]";
        $query  = "select " . $xoopsDB->prefix("clubs") . ".id, url from " . $xoopsDB->prefix("clubs") . ", " . $xoopsDB->prefix("logo") . " where " . $xoopsDB->prefix("clubs") . ".id='$id' and id_club='$id'";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo "<center><img src=\"$row[1]\"></center><br><br><br><br>";
        }

        $query  = "select " . $xoopsDB->prefix("classe") . ".nom, " . $xoopsDB->prefix("classe") . ".id FROM " . $xoopsDB->prefix("classe") . " ORDER by rang";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo "<table  2 cellspacing=\"0\" align=center>";
            echo "<tr  3><td><b><font color=\"#FFFFFF\">$row[0]</font></b></td></tr>";
            $id_classe = $row[1];
            echo "<td><table cellspacing=\"0\"><tr><td><font face=\"arial\">";
            $aff_".$xoopsDB->prefix("rens")." = aff_".$xoopsDB->prefix("rens")." ($id_classe, $id);
      echo "$aff_" . $xoopsDB->prefix("rens") . "</font>";
      echo "</tr></td>";
      echo "</table></td></table><br><br><br><br>";
     }

        echo "<table  2 cellspacing=\"0\" align=center><tr  3><td><b><font color=\"#FFFFFF\">" . CONSULT_CLUB_3 . "</font></b></td></tr>";
        $query  = "SELECT annee, " . $xoopsDB->prefix("divisions") . ".nom, " . $xoopsDB->prefix("championnats") . ".id, " . $xoopsDB->prefix("equipes") . ".id
          FROM " . $xoopsDB->prefix("saisons") . ", " . $xoopsDB->prefix("championnats") . ", " . $xoopsDB->prefix("divisions") . ", " . $xoopsDB->prefix("clubs") . ", " . $xoopsDB->prefix("equipes") . "
          WHERE " . $xoopsDB->prefix("equipes") . ".id_champ=" . $xoopsDB->prefix("championnats") . ".id
          AND id_division=" . $xoopsDB->prefix("divisions") . ".id
          AND " . $xoopsDB->prefix("clubs") . ".id=id_club
          AND " . $xoopsDB->prefix("equipes") . ".id_club='$id'
          AND " . $xoopsDB->prefix("saisons") . ".id=" . $xoopsDB->prefix("championnats") . ".id_saison order by annee desc";
        $result = $xoopsDB->queryF($query);

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo "<tr><td>";
            echo "<tr  2><td><center>$row[0]/" . ($row[0] + 1) . " ($row[1])</td></tr>";
            echo "<tr><td><a href=\"../consult/classement.php?champ=$row[2]&type=G%E9n%E9ral\">" . CONSULT_CLUB_1 . "</a></td></tr>";
            echo "<tr><td><a href=\"../consult/detaileq.php?champ=$row[2]&equipe=$row[3]\">" . CONSULT_CLUB_2 . "</a><br><br></td></tr>";
            echo "</td></tr>";
        }
        echo "</table><br><br>";
        echo "<br><HR><br>";
    }
    echo "<center><a href=\"$HTTP_REFERER\"><b>" . RETOUR . "</b></center></a>";
}
include "../consult/apres.php";
xoops_cp_footer();
?>
