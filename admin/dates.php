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

if (!isset($id_champ)) {
    echo '<h1><div align="center">';

    echo ADMIN_DATES_TITRE;

    echo '</h1></div>';

    echo '<form action="dates.php" method="GET">';

    echo '<br><h3>';

    echo ADMIN_DATES_MSG1;

    echo '</h3>';

    echo '<select name="id_champ">';

    echo '<option value="0"> </option>';

    $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee, ' . $xoopsDB->prefix('championnats') . '.id 
          FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('journees') . ' 
          WHERE ' . $xoopsDB->prefix('journees') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id 
          AND ' . $xoopsDB->prefix('championnats') . '.id_division=' . $xoopsDB->prefix('divisions') . '.id 
          AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix('saisons') . '.id 
          ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id';

    $result = $xoopsDB->queryF($query);

    $saison = ADMIN_JOURNEES_MSG3;

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $saison $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button>";

    echo '</form>';
} else {
    $nb_equipes = nb_equipes($id_champ);

    $yes = 'OUI';
}
if (!isset($date[0]) and 'OUI' == $yes) {
    echo '<h3> dates prévues de chaque journée :</h3>';

    echo "<form action=\"$PHP_SELF\" method=get>";

    $result = $xoopsDB->queryF('SELECT numero, date_prevue FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$id_champ' ORDER BY numero");

    echo '<table>';

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $dateFR = date_us_vers_fr($row[1]);

        echo "<tr><td><br>Journée N°$row[0]<br> sous la forme <b>JJMMAAAA<b></td><td>";

        echo "<input type=\"text\" name=\"date[]\" size=8 maxlength=8 value=\"$dateFR\"></td>";
    }

    echo '</table>';

    echo "<input type=\"hidden\" name=\"id_champ\" value=\"$id_champ\">";

    echo '<input type="hidden" name="yes" value="OUI">';

    echo "<input type=\"hidden\" name=\nb_equipes\" value=\"$nb_equipes\">";

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button>";

    echo '</form>';
} elseif ('OUI' == $yes and isset($date[0])) {
    $x = 0;

    while ($x <= ($nb_equipes * 2) - 2) {
        $y = $x + 1;

        $dateUS = date_fr_vers_us($date[$x]);

        $query = 'UPDATE ' . $xoopsDB->prefix('journees') . " SET date_prevue='$dateUS' WHERE numero='$y' AND id_champ='$id_champ'";

        $result = $xoopsDB->queryF($query);

        $x++;
    }
}
$xoopsDB->prefix('saisons') . annee;
xoops_cp_footer();
?>

