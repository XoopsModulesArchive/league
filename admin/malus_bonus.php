<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;

if (!$xoopsUser) {
    redirect_header('index.php', 3, _US_NOEDITRIGHT);

    exit();
}

require '../config.php';
require 'fonctions.php';

if (!$champ) {
    echo '<h1 align=center>';

    echo ADMIN_TAPVERT_TITRE;

    echo '</h1><br><br><h5>';

    echo ADMIN_TAPVERT_MSG1;

    echo "</h5><form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>';

    echo ADMIN_TAPVERT_MSG2;

    echo '</h3>';

    echo '<select name="champ">';

    echo '<option value="0"> </option>';

    $query = 'SELECT DISTINCT '
             . $xoopsDB->prefix('divisions')
             . '.nom, '
             . $xoopsDB->prefix('saisons')
             . '.annee, '
             . $xoopsDB->prefix('championnats')
             . '.id FROM '
             . $xoopsDB->prefix('championnats')
             . ', '
             . $xoopsDB->prefix('divisions')
             . ', '
             . $xoopsDB->prefix('saisons')
             . ', '
             . $xoopsDB->prefix('journees')
             . ' WHERE '
             . $xoopsDB->prefix('journees')
             . '.id_champ='
             . $xoopsDB->prefix('championnats')
             . '.id AND '
             . $xoopsDB->prefix('championnats')
             . '.id_division='
             . $xoopsDB->prefix('divisions')
             . '.id AND '
             . $xoopsDB->prefix('championnats')
             . '.id_saison='
             . $xoopsDB->prefix('saisons')
             . '.id ORDER BY '
             . $xoopsDB->prefix('saisons')
             . '.annee DESC, '
             . $xoopsDB->prefix('championnats')
             . '.id';

    $result = $GLOBALS['xoopsDB']->queryF($query);

    $data = ADMIN_JOURNEES_MSG3;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n. $data $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button></form><br>";

    echo '';
} else {
    $result = $GLOBALS['xoopsDB']->queryF('SELECT id_equipe from ' . $xoopsDB->prefix('tapis_vert') . ', ' . $xoopsDB->prefix('equipes') . ' where ' . $xoopsDB->prefix('equipes') . '.id=id_equipe and ' . $xoopsDB->prefix('equipes') . ".id_champ='$champ'");

    if (0 == $GLOBALS['xoopsDB']->getRowsNum($result)) {
        $result2 = $GLOBALS['xoopsDB']->queryF('select id from ' . $xoopsDB->prefix('equipes') . " where id_champ='$champ'");

        while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
            $GLOBALS['xoopsDB']->queryF('INSERT INTO ' . $xoopsDB->prefix('tapis_vert') . " SET id_equipe='$row2[0]'");
        }
    }

    if (!isset($malus)) {
        //BONUS MALUS

        echo '<b>';

        echo ADMIN_TAPVERT_MSG3;

        echo '</b><br>';

        echo "<form action=\"$PHP_SELF\" method=\"GET\">";

        $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('clubs') . '.nom, ' . $xoopsDB->prefix('equipes') . '.id, ' . $xoopsDB->prefix('tapis_vert') . '.pts FROM ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('tapis_vert') . ' WHERE ' . $xoopsDB->prefix(
                'equipes'
            ) . ".id_champ='$champ' AND " . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix('equipes') . '.id_club AND ' . $xoopsDB->prefix('tapis_vert') . '.id_equipe=' . $xoopsDB->prefix('equipes') . '.id ORDER BY ' . $xoopsDB->prefix('clubs') . '.nom';

        $result = $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
            echo "<INPUT TYPE=\"TEXT\" name=\"malus[]\" value=\"$row[2]\" size=\"4\">";

            echo "<INPUT TYPE=\"HIDDEN\"  name=\"id_equipe[]\" value=\"$row[1]\">";

            echo "$row[0]<br>";
        }

        echo "<INPUT TYPE=\"HIDDEN\"  name=\"champ\" value=\"$champ\">";

        $button = ENVOI;

        echo "<input type=\"submit\" value=$button></form><br>";
    } else {
        $y = nb_equipes($champ);

        $x = 0;

        while ($x < $y) {
            $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('tapis_vert') . " SET pts='$malus[$x]' where id_equipe='$id_equipe[$x]' ") || die($GLOBALS['xoopsDB']->error());

            //$GLOBALS['xoopsDB']->queryF("update ".$xoopsDB->prefix("tapis_vert")." SET pts=(pts+(2)) where id_equipe='$id_equipe[$x]' ") || die($GLOBALS['xoopsDB']->error());

            $x++;
        }
    }
}
xoops_cp_footer();

?>

