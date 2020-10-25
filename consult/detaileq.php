<?

include "avant.php";
if (!$marqueur == '1') {
    require "../config.php";
    require "../consult/fonctions.php";
}
require_once XOOPS_ROOT_PATH . '/header.php';
$marqueur = "1";

if (!$champ) {
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
    @$GLOBALS['xoopsDB']->freeRecordSet($query);
    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
} // Choix du club
elseif (!isset($id_equipe)) {
    $query  = "SELECT  " . $xoopsDB->prefix("clubs") . " .nom, id_champ, " . $xoopsDB->prefix("equipes") . " .id
FROM " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " 
WHERE " . $xoopsDB->prefix("equipes") . " .id_champ='$champ' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . " .id_club
ORDER BY nom";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    echo "<font color=\"#006a36\" size=\"3\"><center><u>" . ADMIN_EQUIPE_TITRE . "</font></u>";
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "&nbsp;";
    echo "&nbsp;";
    echo ADMIN_EQUIPE_2;
    echo "<select name=\"id_equipe\">";
    echo "<option value=\"0\"> </option>";

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $a = $row[1] + 1;
        echo(" <option value=\"$row[2]\">$row[0]");
        echo("</option>\n>");
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($query);
    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button>";
    echo "<input type=\"hidden\" name=\"champ\" value='$champ'>";
    echo "</form>";
} else {
    $query  = "select id from " . $xoopsDB->prefix("equipes") . "  where id_champ=$champ and id=$id_equipe";
    $result = $xoopsDB->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe = $row[0];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($query);
    $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . "  WHERE " . $xoopsDB->prefix("equipes") . " .id='$id_equipe' AND " . $xoopsDB->prefix("equipes") . " .id_club=" . $xoopsDB->prefix("clubs") . " .id";
    $result = $xoopsDB->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $club = $row[0];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($query);
    $color  = 0;
    $query  = "SELECT "
              . $xoopsDB->prefix("divisions")
              . " .nom, "
              . $xoopsDB->prefix("saisons")
              . " .annee, ("
              . $xoopsDB->prefix("saisons")
              . " .annee)+1 FROM "
              . $xoopsDB->prefix("championnats")
              . " , "
              . $xoopsDB->prefix("divisions")
              . " , "
              . $xoopsDB->prefix("saisons")
              . "  WHERE "
              . $xoopsDB->prefix("championnats")
              . " .id='$champ' AND "
              . $xoopsDB->prefix("divisions")
              . " .id="
              . $xoopsDB->prefix("championnats")
              . " .id_division AND "
              . $xoopsDB->prefix("saisons")
              . " .id="
              . $xoopsDB->prefix("championnats")
              . " .id_saison";
    $result = $xoopsDB->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo "<align=\"center\">";
        echo $row[0];
        echo "  ";
        echo $row[1];
        echo "/";
        echo $row[2];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($query);
    echo "<p align=center><b><font color=green>" . VICTOIRE . "</font><font color=orange>" . NUL . "</font><font color=red>" . DEFAITE . "</font></b></p>";
    echo "<TABLE  2 align=\"center\" cellspacing=\"0\"  >";
    $query1 = "SELECT " . $xoopsDB->prefix("journees") . " .numero, cldom.nom, clext.nom, " . $xoopsDB->prefix("matchs") . " .buts_dom, " . $xoopsDB->prefix("matchs") . " .buts_ext, " . $xoopsDB->prefix("journees") . " .date_prevue
        FROM " . $xoopsDB->prefix("equipes") . "  as dom, " . $xoopsDB->prefix("equipes") . "  as ext, " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix("clubs") . "  as cldom  , " . $xoopsDB->prefix("clubs") . "  as clext
        WHERE " . $xoopsDB->prefix("matchs") . " .id_equipe_dom=dom.id
        AND " . $xoopsDB->prefix("matchs") . " .id_equipe_ext=ext.id
        AND (" . $xoopsDB->prefix("matchs") . " .id_equipe_ext='$id_equipe'
        OR " . $xoopsDB->prefix("matchs") . " .id_equipe_dom='$id_equipe' )
        AND " . $xoopsDB->prefix("journees") . " .id_champ='$champ'
        AND dom.id_club=cldom.id
        AND ext.id_club=clext.id
        AND " . $xoopsDB->prefix("matchs") . " .id_journee=" . $xoopsDB->prefix("journees") . " .id
        ORDER BY " . $xoopsDB->prefix("journees") . " .numero  ";
    $result = $GLOBALS['xoopsDB']->queryF($query1);

    echo "<tr  3><td colspan=4><b><center>" . JOURNEE . "</td><td><b><center>Date</b><td><td><td><td><td><td>";
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        if ($row[0] - $x == 1) {
            $date    = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$', '\\3/\\2/\\1', $row[5]);
            $bgcolor = "#FFFFFF";
            if (($color % 2) == 0) {
                $bgcolor = "#E5E5E5";
            }
            $color += 1;
            echo "<TR bgcolor=$bgcolor><TD colspan=4><center><b>$row[0]</b><td><center>$date</td>";
        }
        $x = $row[0];

        echo "<TD   align=\"right\">";
        if ($row[3] <> '' and $row[1] == $club) {
            if ($row[3] > $row[4]) {
                echo "<font color=green>";
            }
            if ($row[3] < $row[4]) {
                echo "<font color=red >";
            }
            if ($row[3] == $row[4]) {
                echo "<font color=orange>";
            }
            echo "<b>";
        }
        echo $row[1];
        echo "<TD  ><center>";
        echo $row[3];
        echo "<td><center> - <td><TD  ><center>";
        echo $row[4];
        echo "<TD   align=\"left\">";
        if ($row[4] <> '' and $row[2] == $club) {
            if ($row[3] < $row[4]) {
                echo "<font color=green>";
            }
            if ($row[3] > $row[4]) {
                echo "<font color=red>";
            }
            if ($row[3] == $row[4]) {
                echo "<font color=orange>";
            }
            echo "<b>";
        }
        echo $row[2];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($query1);
    echo "</table><br>";
    if ($HTTP_REFERER == '') {
        $HTTP_REFERER = "classement.php?champ=2&type=Général";
    }
    echo "<center><a href=\"$HTTP_REFERER\"><b>" . RETOUR . "</b></a><br>";
}
require_once XOOPS_ROOT_PATH . '/footer.php';
?>
