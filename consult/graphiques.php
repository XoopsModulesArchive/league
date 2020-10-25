<?

require "../config.php";

if (!$champ) {
    // pour quel championnat ?
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h4 align=\"center\">";
    echo ADMIN_TAPVERT_MSG2;
    echo "</h4>";
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

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }

    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
} else {
    $query  = "SELECT id FROM " . $xoopsDB->prefix("equipes") . " where id_champ=$champ";
    $result = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $equipe = $row[0];
        echo "<center><img src=\"graph.php?equipe=$equipe\"></img></center>";
    }
}
?>
