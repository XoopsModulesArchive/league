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

if (!isset($libelle)) {
    principale();
} else {
    $result = $GLOBALS['xoopsDB']->queryF('SELECT max(id_groupe) FROM groupe_championnat');

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $max = $row[0] + 1;
    }

    reset($championnat);

    while (list($val, $value) = each($championnat)) {
        $GLOBALS['xoopsDB']->queryF("INSERT INTO groupe_championnat (id_groupe, libelle, id_champ) values ('$max','$libelle','$value')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    principale();
}

function principale()
{
    echo '<h1 align=center> Edition des groupes de championnats</h1>';

    // SUPPRESSION

    echo "<HR><b>SUPPRESSION</b> d'un groupe de championnats
<form action=\"supgroup_champ.php\" method=\"GET\">
<select name=\"data\">";

    echo '<option value="0"> </option>';

    $result = $GLOBALS['xoopsDB']->queryF('SELECT groupe_championnat.id, groupe_championnat.libelle, groupe_championnat.id_groupe FROM groupe_championnat GROUP BY groupe_championnat.id_groupe ');

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo("\n<option value=\"$row[2]\">$row[1]");

        $result2 = $GLOBALS['xoopsDB']->queryF(
            'select '
            . $xoopsDB->prefix('divisions')
            . '.nom, '
            . $xoopsDB->prefix('saisons')
            . '.annee , groupe_championnat.id, groupe_championnat.id_groupe from '
            . $xoopsDB->prefix('championnats')
            . ', groupe_championnat, '
            . $xoopsDB->prefix('divisions')
            . ', '
            . $xoopsDB->prefix('saisons')
            . " WHERE groupe_championnat.id_groupe=$row[2] and groupe_championnat.id_champ="
            . $xoopsDB->prefix('championnats')
            . '.id AND '
            . $xoopsDB->prefix('saisons')
            . '.id='
            . $xoopsDB->prefix('championnats')
            . '.id_saison AND '
            . $xoopsDB->prefix('divisions')
            . '.id='
            . $xoopsDB->prefix('championnats')
            . '.id_division ORDER BY groupe_championnat.id_groupe '
        );

        $x = 0;

        while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
            $x++;

            $annee = $row2[1] + 1;

            echo(" - $row2[0] $row2[1]/$annee");
        }

        echo("</option>\n>");
    }

    echo '</select>';

    echo '<br><input type="submit" value="suppression groupe de championnats"></form>';

    // CREATION

    echo "<HR><form action=\"$PHP_SELF\" method=\"GET\"><h3>Création d'un groupe de championnats</h3>";

    echo '<br><b>Libellé : </b>';

    echo '<input type="text" name="libelle">';

    echo '<br><b>Choix du championnat ? </b>(Choix multiple possible avec la touche SHIFT ou CTRL)<br>';

    echo '<select name="championnat[]" multiple>';

    // echo "<option value=\"0\"> </option>";

    $result = $GLOBALS['xoopsDB']->queryF(
        'select ' . $xoopsDB->prefix('championnats') . '.id, ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee from ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('divisions') . ' WHERE ' . $xoopsDB->prefix(
            'divisions'
        ) . '.id=' . $xoopsDB->prefix('championnats') . '.id_division AND ' . $xoopsDB->prefix('saisons') . '.id=' . $xoopsDB->prefix('championnats') . '.id_saison ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id '
    );

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $x = $row[2] + 1;

        echo("<option value=\"$row[0]\">$row[1] Saison $row[2]/$x\n");

        echo("</option>\n>");
    }

    echo '</select>';

    echo '<br>';

    echo '<input type="submit" value="Création de groupe de championnats"></form><br>';

    echo 'Pour <b>modifier</b> un groupe de championnats, utilisez PHPMyAdmin';

    echo '<br><br>';

    xoops_cp_footer();
}

?>

