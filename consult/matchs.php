<?

include "avant.php";
if (!$marqueur == '1') {
    require "../config.php";
    //require ("../consult/fonctions.php");
}
//ENTETE2 ();
$marqueur = "1";

if ($champ == "") {
    require_once XOOPS_ROOT_PATH . '/header.php';
    echo "<h4 align=\"center\">" . CONSULT_MATCHS . "</h4>";
    echo "<form action=\"matchs.php\" method=\"GET\" align=\"center\">";
    echo "<br><p align=\"center\"><h5 align=\"center\">";
    echo CONSULT_MATCHS_MSG1 . "</h5>";
    echo "<select name=\"champ\" align=\"center\">";
    echo "<option value=\"0\"> </option>";
    $query  = "SELECT DISTINCT " . $xoopsDB->prefix("divisions") . " .nom, " . $xoopsDB->prefix("saisons") . " .annee, " . $xoopsDB->prefix("championnats") . " .id
        FROM " . $xoopsDB->prefix("championnats") . " , " . $xoopsDB->prefix("divisions") . " , " . $xoopsDB->prefix("saisons") . " , " . $xoopsDB->prefix("journees") . "  
        WHERE " . $xoopsDB->prefix("journees") . " .id_champ=" . $xoopsDB->prefix("championnats") . " .id 
        AND " . $xoopsDB->prefix("championnats") . " .id_division=" . $xoopsDB->prefix("divisions") . " .id 
        AND " . $xoopsDB->prefix("championnats") . " .id_saison=" . $xoopsDB->prefix("saisons") . " .id 
        ORDER BY " . $xoopsDB->prefix("saisons") . " .annee DESC, " . $xoopsDB->prefix("championnats") . " .id";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</select>";
    echo "<input type=\"submit\" value=" . ENVOI . ">";
    echo "</form></p>";
    require_once XOOPS_ROOT_PATH . '/footer.php';
} else {
    $color  = 0;
    $query  = "SELECT " . $xoopsDB->prefix("divisions") . " .nom, " . $xoopsDB->prefix("saisons") . " .annee, (" . $xoopsDB->prefix("saisons") . " .annee)+1 
FROM " . $xoopsDB->prefix("championnats") . " , " . $xoopsDB->prefix("divisions") . " , " . $xoopsDB->prefix("saisons") . " 
WHERE " . $xoopsDB->prefix("championnats") . " .id='$champ' 
AND " . $xoopsDB->prefix("divisions") . " .id=" . $xoopsDB->prefix("championnats") . " .id_division 
AND " . $xoopsDB->prefix("saisons") . " .id=" . $xoopsDB->prefix("championnats") . " .id_saison";
    $result = $xoopsDB->queryF($query);
    require_once XOOPS_ROOT_PATH . '/header.php';
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo "<div align=\"center\"><strong><font color='#666600'>" . $row[0] . "  " . $row[1] . "/" . $row[2] . "</font></strong></div><br><br>";
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);

    echo "<TABLE class='itemHead' align=\"center\" cellspacing=\"0\">";
    $query1 = "SELECT " . $xoopsDB->prefix("journees") . " .numero, cldom.nom, clext.nom, " . $xoopsDB->prefix("matchs") . " .buts_dom, " . $xoopsDB->prefix("matchs") . " .buts_ext, " . $xoopsDB->prefix("journees") . " .date_prevue
        FROM " . $xoopsDB->prefix("equipes") . "  as dom, " . $xoopsDB->prefix("equipes") . "  as ext, " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix("clubs") . "  as cldom, " . $xoopsDB->prefix("clubs") . "  as clext
        WHERE " . $xoopsDB->prefix("matchs") . " .id_equipe_dom=dom.id
                AND " . $xoopsDB->prefix("matchs") . " .id_equipe_ext=ext.id
                AND " . $xoopsDB->prefix("journees") . " .id_champ='$champ'
                AND dom.id_club=cldom.id
                AND ext.id_club=clext.id
                AND " . $xoopsDB->prefix("matchs") . " .id_journee=" . $xoopsDB->prefix("journees") . " .id
                ORDER BY " . $xoopsDB->prefix("journees") . " .numero";

    $result = $GLOBALS['xoopsDB']->queryF($query1);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        if ($row[0] - $x == 1) {
            $date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$', '\\3/\\2/\\1', $row[5]);
            echo "<TR  ><TR  ><TD><div align='center'></td></tr><TH colspan=4><div align='center'><font size='2'><b>" . ADMIN_COHERENCE_MSG2 . " " . $row[0] . CONSULT_MATCHS_MSG2 . $date . "</b></font></div>";
        }
        $x       = $row[0];
        $bgcolor = "#FFFFFF";
        if (($color % 2) == 0) {
            $bgcolor = "#E5E5E5";
        }
        echo "<TR bgcolor=$bgcolor><TD align=\"right\"><p align=\"right\">" . $row[1] . "</p><TD  >" . $row[3] . " - <TD  >" . $row[4] . "<TD   align=\"left\">" . $row[2];
        $color += 1;
    }
    //$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</table>";
    require_once XOOPS_ROOT_PATH . '/footer.php';
}

?>

