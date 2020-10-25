<?

include "avant.php";
if (!$marqueur == '1') {
    require "../config.php";
    require "../consult/fonctions.php";
}
ENTETE2();
$marqueur = "1";

function choix_championnat()
{
    global $xoopsDB;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h5 align=\"center\">" . ADMIN_TAPVERT_MSG2 . "</h5>";
    echo "<select name=\"champ\" align=\"center\">";
    echo "<option value=\"0\" align=\"center\"> </option>";
    $query  = "SELECT DISTINCT "
              . $xoopsDB->prefix("divisions")
              . ".nom, "
              . $xoopsDB->prefix("saisons")
              . ".annee, "
              . $xoopsDB->prefix("championnats")
              . ".id
                FROM "
              . $xoopsDB->prefix("championnats")
              . ", "
              . $xoopsDB->prefix("divisions")
              . ", "
              . $xoopsDB->prefix("saisons")
              . ", "
              . $xoopsDB->prefix("journees")
              . "
                WHERE "
              . $xoopsDB->prefix("journees")
              . ".id_champ="
              . $xoopsDB->prefix("championnats")
              . ".id AND "
              . $xoopsDB->prefix("championnats")
              . ".id_division="
              . $xoopsDB->prefix("divisions")
              . ".id AND "
              . $xoopsDB->prefix("championnats")
              . ".id_saison="
              . $xoopsDB->prefix("saisons")
              . ".id ORDER BY "
              . $xoopsDB->prefix("saisons")
              . ".annee DESC, "
              . $xoopsDB->prefix("championnats")
              . ".id";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }
    echo "</select>";
    echo "<input type=\"submit\" value=" . ENVOI . " align=\"left\"> </form>";
}

function choix_equipes($champ)
{
    global $xoopsDB;
    echo "<h1 align=center>" . CONSULT_DUEL . "</h1>";
    echo "<h5 align=center>" . DUEL_MSG1 . "</h5> ";
    echo "<form action=\"$PHP_SELF\" metdod=\"GET\">";
    echo "<table   align=left><tr  ><th  >" . DOMICILE . "<th   align=left>" . EXTERIEUR . "<tr  ><td   align=left>";
    $result = $GLOBALS['xoopsDB']->queryF(
        "select " . $xoopsDB->prefix("clubs") . ".nom from " . $xoopsDB->prefix("clubs") . ", " . $xoopsDB->prefix("equipes") . " WHERE " . $xoopsDB->prefix("equipes") . ".id_champ='$champ' AND " . $xoopsDB->prefix("clubs") . ".id=" . $xoopsDB->prefix("equipes") . ".id_club ORDER BY nom"
    );
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo "<input type=\"radio\" value=\"$row[0]\" name=\"IdEqDom\">$row[0]<br>";
    }
    echo "<td   align=left>";
    $result = $GLOBALS['xoopsDB']->queryF(
        "select " . $xoopsDB->prefix("clubs") . ".nom from " . $xoopsDB->prefix("clubs") . ", " . $xoopsDB->prefix("equipes") . " WHERE " . $xoopsDB->prefix("equipes") . ".id_champ='$champ' AND " . $xoopsDB->prefix("clubs") . ".id=" . $xoopsDB->prefix("equipes") . ".id_club ORDER BY nom"
    );
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo "$row[0]<input type=\"radio\" value=\"$row[0]\" name=\"IdEqExt\"><br>";
    }
    echo "</td></tr><tr  ><td   colspan=2 align=left><input type=\"hidden\" name=champ value=\"$champ\"><input type=\"submit\" value=" . ENVOI . "></form></table>";
}

function calcul_pts_dom($IdEqDom, $champ)
{
}

// CORPS DU SCRIPT

if (!$IdEqDom or !$IdEqExt) {
    if (!$champ) {
        require_once XOOPS_ROOT_PATH . '/header.php';
        choix_championnat();
        require_once XOOPS_ROOT_PATH . '/footer.php';
    } else {
        require_once XOOPS_ROOT_PATH . '/header.php';
        choix_equipes($champ);
        require_once XOOPS_ROOT_PATH . '/footer.php';
    }
} elseif ($IdEqDom == $IdEqExt) {
    echo "<h5 align=left>choix impossible</h5><br>";
    echo "<a href=\"$HTTP_REFERER\" align=left><b>Autre duel ...</b></a>";
} else {
    $GLOBALS['xoopsDB']->queryF("LOCK TABLE " . $xoopsDB->prefix("clmnt") . "");
    require_once XOOPS_ROOT_PATH . '/header.php';
    db_xoops_clmnt($legende, $type, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
    $query = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$IdEqDom'";

    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $dom_points = (($row[DOMG] * 2) + ($row[DOMN])) / $row[DOMJOUES] * 3;
        $dom_points += ((($row[EXTG] * 2) + ($row[EXTN])) / $row[EXTJOUES]);
    }
    $query  = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$IdEqExt'";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $ext_points = (($row[EXTG] * 2) + ($row[EXTN])) / $row[EXTJOUES] * 3;
        $ext_points += ((($row[DOMG] * 2) + ($row[DOMN])) / $row[DOMJOUES]);
    }
    $x        = $dom_points + $ext_points;
    $domproba = intval((($dom_points / $x) + 0.005) * 100);
    $extproba = intval((($ext_points / $x) + 0.005) * 100);
    if (!$entete == "non") {
        echo "<table class=blockContent><tr  > <td colspan=5> " . DUEL_MSG3 . "</td></tr><td>" . DUEL_MSG4 . "<td  ><b>$IdEqDom<td><b>$domproba % <td  >-<td><b> $extproba % <td  ><b>$IdEqExt</td></tr>";
    }

    // ***************

    $query2  = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$IdEqDom'";
    $result2 = $GLOBALS['xoopsDB']->queryF($query2);
    while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
        $dom_buts  = ($row2[DOMBUTSPOUR]);
        $dom_joues = ($row2[DOMG] + $row2[DOMN] + $row2[DOMP]);
        $ext_buts  = ($row2[DOMBUTSCONTRE]);
        $ext_joues = ($row2[DOMG] + $row2[DOMN] + $row2[DOMP]);
    }

    $query2  = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$IdEqExt'";
    $result2 = $GLOBALS['xoopsDB']->queryF($query2);
    while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
        $dom_joues += ($row2[EXTG] + $row2[EXTN] + $row2[EXTP]);
        $ext_joues += $row2[EXTG] + $row2[EXTN] + $row2[EXTP];
        $dom_buts  += ($row2[EXTBUTSCONTRE]);
        $ext_buts  += ($row2[EXTBUTSPOUR]);
        $dom_buts  = intval((($dom_buts) / $dom_joues));
        $ext_buts  = intval((($ext_buts) / $ext_joues));
    }
    $domproba = "<i>" . $dom_buts . "</i>";
    $extproba = "<i>" . $ext_buts . "</i>";
    echo "<tr><td>SCORE : <td  ><b>$IdEqDom<td align=left><b>$domproba <td  >-<td   align=center><b> $extproba<td  ><b>$IdEqExt</td></tr></table>";

    if (!$entete == "non") {
        echo "<br><br><i><div align=center>" . DUEL_MSG5 . "</i></div><br>";
    }

    if ($entete == "non") {
        echo "$IdEqDom $domproba %-$extproba % $IdEqExt";
    }
    echo "<br><br><a href=\"$HTTP_REFERER\"><b><div align=center>Autre duel ...</div></b></a>";

    $GLOBALS['xoopsDB']->queryF("UNLOCK TABLE " . $xoopsDB->prefix("clmnt") . "");
}
require_once XOOPS_ROOT_PATH . '/footer.php';
?>
