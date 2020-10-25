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

echo '<h1><div align="center">';
echo ADMIN_JOURNEES_TITRE;
echo '</div></h1>';
if (!isset($date[0])) {
    if (!isset($yes)) {
        if (!isset($id_champ)) {
            // Liste des xoops_championnats

            listechamp();

            // liste des calendriers existants

            // demande de création d'un calendrier

            echo '<HR><b>';

            echo ADMIN_JOURNEES_MSG1;

            echo "<form action=\"$PHP_SELF\" method=get target=\"_self\">";

            echo '<input type="text" name="id_champ" size=4 maxlength=4>';

            $button = ADMIN_CHAMPIONNATS_BUTTON_CREA;

            echo "<input type=\"submit\" value=$button>";

            echo '</form>';
        } else {
            echo '<table>';

            echo ADMIN_JOURNEES_MSG2;

            $query = 'SELECT ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee, ' . $xoopsDB->prefix('clubs') . '.nom FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix(
                    'divisions'
                ) . ', ' . $xoopsDB->prefix('clubs') . ' WHERE ' . $xoopsDB->prefix('championnats') . ".id='$id_champ' AND " . $xoopsDB->prefix('divisions') . '.id=' . $xoopsDB->prefix('championnats') . '.id_division AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix(
                    'saisons'
                ) . '.id AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('equipes') . '.id_champ AND ' . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id GROUP 		BY ' . $xoopsDB->prefix('clubs') . '.nom ';

            $result = $xoopsDB->queryF($query);

            $nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result);

            $row = $xoopsDB->fetchRow($result);

            $x = $row[1] + 1;

            echo "<tr><td><b>$row[0]</td><td><b>";

            echo ADMIN_JOURNEES_MSG3;

            echo "$row[1]/$x</b></td></tr>";

            echo "<tr><td><td><td>$row[2]</td></tr>";

            while (false !== ($row = $xoopsDB->fetchRow($result))) {
                echo "<tr><td><td><td>$row[2]</td></tr>";
            }

            $nb_journees = $nb_equipes * 2 - 2;

            // OUI --> création

            echo "<tr><td colspan=2><br><b> $nb_equipes";

            echo ADMIN_JOURNEES_MSG4;

            echo "$nb_journees";

            echo ADMIN_JOURNEES_MSG5;

            echo '</b></td></tr>';

            echo "<tr><td><form action=\"$PHP_SELF\" method=get>";

            echo '<input type="hidden" name="yes" value="OUI">';

            echo "<input type=\"hidden\" name=\"nb_equipes\" value=\"$nb_equipes\">";

            echo "<input type=\"hidden\" name=\"id_champ\" value=\"$id_champ\">";

            $button = ADMIN_JOURNEES_MSG6;

            echo "<input type=\"submit\" value=$button>";

            echo '</form></td>';

            // NON --> retour

            echo "<td><form action=\"$PHP_SELF\" method=get>";

            $button = ADMIN_JOURNEES_MSG7;

            echo "<input type=\"submit\" value=$button>";

            echo '</form></td></tr></table>';
        }
    } else {
        // Effacement du calendrier, si existe déjà

        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$id_champ'");

        $x = 1;

        while ($x <= ($nb_equipes * 2) - 2) {
            $query = 'INSERT INTO ' . $xoopsDB->prefix('journees') . "(numero, id_champ) VALUES ('$x','$id_champ')";

            $result = $xoopsDB->queryF($query);

            $x++;
        }

        echo '<h3>';

        echo ADMIN_JOURNEES_MSG8;

        echo '</h3>';

        echo "<form action=\"$PHP_SELF\" method=get>";

        $result = $xoopsDB->queryF('SELECT numero, date_prevue FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$id_champ' ORDER BY numero");

        echo '<table>';

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo '<tr><td><br>';

            echo ADMIN_JOURNEES_MSG9;

            echo "$row[0]<br>";

            echo ADMIN_JOURNEES_MSG10;

            echo '</td><td>';

            print $row[1];

            print $row[1] = date_us_vers_fr($row[1]);

            echo "<input type=\"text\" name=\"date[]\" size=10 maxlength=10 value=\"$row[1]\"></td>";
        }

        echo '</table>';

        echo "<input type=\"hidden\" name=\"id_champ\" value=\"$id_champ\">";

        echo "<input type=\"hidden\" name=\"nb_equipes\" value=\"$nb_equipes\">";

        echo '<input type="submit" value="Envoi">';

        echo '</form>';
    }
} else {
    $x = 0;

    while ($x <= ($nb_equipes * 2) - 2) {
        $y = $x + 1;

        //echo $y."-".$date[$y-1]."-";

        //print $dateUS=date_fr_vers_us($date[$y-1]);

        echo '<font color=green>' . ADMIN_CRESAISON_MSG1 . '</font>';

        echo '<br>';

        $dateUS = date_fr_vers_us($date[$x]);

        $query = 'UPDATE ' . $xoopsDB->prefix('journees') . " SET date_prevue='$dateUS' WHERE numero='$y' AND id_champ='$id_champ'";

        $result = $xoopsDB->queryF($query);

        $x++;
    }
}
xoops_cp_footer();
?>

