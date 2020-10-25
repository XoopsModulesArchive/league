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

if (1 == !$journee_suivante) {
}
echo '<h1 align=center>';
echo ADMIN_RESULTATS_TITRE;
echo '</h1>';
echo '<table valign="top">';
if (!isset($champ)) {
    // choix du champ couple championnat-saison

    // choix de la journée à saisir

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>';

    echo ADMIN_RESULTATS_MSG1;

    echo '</h3>';

    echo '<select name="champ">';

    echo '<option value="0"> </option>';

    $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee, ' . $xoopsDB->prefix('championnats') . '.id 
    FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('journees') . ' 
    WHERE ' . $xoopsDB->prefix('journees') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id 
    AND ' . $xoopsDB->prefix('championnats') . '.id_division=' . $xoopsDB->prefix('divisions') . '.id 
    AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix('saisons') . '.id ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id';

    $data = ADMIN_JOURNEES_MSG3;

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $data $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button></form><br>";
} elseif (!isset($numero)) /*Choix du numéro de journée*/ {
    $query = 'SELECT numero FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$champ' ORDER BY numero";
    $result = $xoopsDB->queryF($query);
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo '<br><h3>';
    echo ADMIN_RESULTATS_MSG2;
    echo '</h3>';
    echo '<select name="numero">';
    echo '<option value="0"></option>';
    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<option value=\"$row[0]\">$row[0]";

        echo('</option>');
    }
    echo '</select>';
    echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button></form><br>";
} else {
    echo '<b>';

    echo ADMIN_JOURNEES_MSG9;

    echo $numero . '</b>';

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    $query = 'SELECT '
              . $xoopsDB->prefix('clubs')
              . '.nom, CLEXT.nom, '
              . $xoopsDB->prefix('matchs')
              . '.buts_dom, '
              . $xoopsDB->prefix('matchs')
              . '.buts_ext, '
              . $xoopsDB->prefix('matchs')
              . '.id FROM '
              . $xoopsDB->prefix('clubs')
              . ', '
              . $xoopsDB->prefix('clubs')
              . ' as CLEXT, '
              . $xoopsDB->prefix('matchs')
              . ', '
              . $xoopsDB->prefix('journees')
              . ', '
              . $xoopsDB->prefix('equipes')
              . ', '
              . $xoopsDB->prefix('equipes')
              . ' as EXT WHERE '
              . $xoopsDB->prefix('clubs')
              . '.id='
              . $xoopsDB->prefix('equipes')
              . '.id_club AND CLEXT.id=EXT.id_club AND '
              . $xoopsDB->prefix('equipes')
              . '.id='
              . $xoopsDB->prefix('matchs')
              . '.id_equipe_dom AND EXT.id='
              . $xoopsDB->prefix('matchs')
              . '.id_equipe_ext AND '
              . $xoopsDB->prefix('matchs')
              . '.id_journee='
              . $xoopsDB->prefix('journees')
              . '.id AND '
              . $xoopsDB->prefix('journees')
              . ".numero='$numero' AND "
              . $xoopsDB->prefix('journees')
              . ".id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    //if (!$result) die ($GLOBALS['xoopsDB']->error());

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        print '<tr><td>' . $row[0] . '<td>';

        echo "<input type=\"text\" size=\"3\" name=\"butd[]\" value=\"$row[2]\">";

        echo '<td>';

        echo "<input type=\"text\" size=\"3\" name=\"butv[]\" value=\"$row[3]\">";

        echo "<input type=\"hidden\" name=\"matchs_id[]\" value=\"$row[4]\">";

        echo '<td>' . $row[1] . '<td>';

        $matchs_id[] = $row[4];
    }

    echo '</td></tr></table>';

    echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";

    $numero = $numero + 1;

    echo "<input type=\"hidden\" name=\"numero\" value=\"$numero\">";

    echo '<input type="hidden" name="journee_suivante" value=1>';

    echo '<input type="hidden" name="action" value=1>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button>";

    echo '</form>';

    if ('1' == $action) {
        $x = 0;

        while ($x <= ((nb_equipes($champ)) / 2) - 1) {
            if (!(('' == $butv[$x]) or ('' == $butd[$x]))) {
                $query = 'UPDATE ' . $xoopsDB->prefix('matchs') . " SET buts_dom='$butd[$x]', buts_ext='$butv[$x]' WHERE id='$matchs_id[$x]' ";
            } elseif (('' == $butv[$x]) or ('' == $butd[$x])) {
                $query = 'UPDATE ' . $xoopsDB->prefix('matchs') . " SET buts_dom=NULL , buts_ext=NULL WHERE id='$matchs_id[$x]' ";
            }

            $xoopsDB->queryF($query);

            $x++;
        }
    }
}
xoops_cp_footer();
?>

