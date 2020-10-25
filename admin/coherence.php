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

echo '<h1 align=center>';
echo ADMIN_COHERENCE_TITRE;
echo '</h1>';
echo '<table valign="top">';
if (!isset($champ)) {
    // choix du champ couple championnat-saison

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>';

    echo ADMIN_COHERENCE_MSG1;

    echo '</h3>';

    echo '<select name="champ">';

    echo '<option value="0"> </option>';

    $query = 'SELECT ' . $xoopsDB->prefix('championnats') . '.id, ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee 
              FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('divisions') . ' 
              WHERE ' . $xoopsDB->prefix('divisions') . '.id=' . $xoopsDB->prefix('championnats') . '.id_division 
              AND ' . $xoopsDB->prefix('saisons') . '.id=' . $xoopsDB->prefix('championnats') . '.id_saison 
              ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id ';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = $row[2] + 1;

        echo("<option value=\"$row[0]\">$row[1] " . SEASON . " $row[2]/$x\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button></form><br>";
} else {
    // CHECK SUM DU CHAMPIONNAT

    $query = ' SELECT sum(id) FROM ' . $xoopsDB->prefix('equipes') . " WHERE id_champ='$champ' ";

    $check_sum = $GLOBALS['xoopsDB']->fetchRow($result = $GLOBALS['xoopsDB']->queryF($query));

    $sumsum = $check_sum[0];

    echo 'CHEKSUM= ' . $sumsum . '<br>';

    $nb_journees = (nb_equipes($champ) * 2) - 2;

    $x = 1;

    while ($x <= $nb_journees) {
        $query = ' SELECT sum('
                   . $xoopsDB->prefix('matchs')
                   . '.id_equipe_dom), sum('
                   . $xoopsDB->prefix('matchs')
                   . '.id_equipe_ext) FROM '
                   . $xoopsDB->prefix('matchs')
                   . ', '
                   . $xoopsDB->prefix('journees')
                   . ' WHERE '
                   . $xoopsDB->prefix('matchs')
                   . '.id_journee='
                   . $xoopsDB->prefix('journees')
                   . '.id AND '
                   . $xoopsDB->prefix('journees')
                   . ".id_champ='$champ'   AND "
                   . $xoopsDB->prefix('journees')
                   . ".numero='$x' ";

        $result = $xoopsDB->queryF($query);

        $sum = $GLOBALS['xoopsDB']->fetchRow($result);

        $sum_day = $sum[0] + $sum[1];

        echo '<small>MATCH_SUM = ' . $sum_day . '  </small>';

        $query = 'SELECT count(DISTINCT '
                  . $xoopsDB->prefix('matchs')
                  . '.id_equipe_dom), count(DISTINCT '
                  . $xoopsDB->prefix('matchs')
                  . '.id_equipe_ext) FROM '
                  . $xoopsDB->prefix('matchs')
                  . ', '
                  . $xoopsDB->prefix('journees')
                  . '   WHERE '
                  . $xoopsDB->prefix('matchs')
                  . '.id_journee='
                  . $xoopsDB->prefix('journees')
                  . '.id    AND '
                  . $xoopsDB->prefix('journees')
                  . ".id_champ='$champ'    AND "
                  . $xoopsDB->prefix('journees')
                  . ".numero='$x' ";

        $result = $xoopsDB->queryF($query);

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            if ($row[0] == $row[1] and $row[0] == nb_equipes($champ) / 2 and ($sum[0] + $sum[1] == $sumsum)) {
                echo ADMIN_COHERENCE_MSG2;

                echo "$x";

                echo ADMIN_COHERENCE_MSG3;

                echo '<br>';
            } else {
                echo ADMIN_COHERENCE_MSG2;

                echo "$x ";

                echo ADMIN_COHERENCE_MSG4;

                echo '<br>';
            }
        }

        $x++;
    }

    $query = ' SELECT sum('
              . $xoopsDB->prefix('matchs')
              . '.id_equipe_dom), sum('
              . $xoopsDB->prefix('matchs')
              . '.id_equipe_ext) FROM '
              . $xoopsDB->prefix('matchs')
              . ', '
              . $xoopsDB->prefix('journees')
              . ' WHERE '
              . $xoopsDB->prefix('matchs')
              . '.id_journee='
              . $xoopsDB->prefix('journees')
              . '.id AND '
              . $xoopsDB->prefix('journees')
              . ".id_champ='$champ'  ";

    $result = $xoopsDB->queryF($query);

    $sum = $xoopsDB->fetchRow($result);

    $sumsum = $sum[0];

    $query = 'SELECT sum(' . $xoopsDB->prefix('matchs') . '.id_equipe_dom), sum(' . $xoopsDB->prefix('matchs') . '.id_equipe_ext) FROM ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ' WHERE  ' . $xoopsDB->prefix('journees') . ".id_champ='$champ' AND " . $xoopsDB->prefix(
            'matchs'
        ) . '.id_journee=' . $xoopsDB->prefix('journees') . '.id  ';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        if ($row[0] == $row[1] and $row[0] + $row[1] == $sumsum * 2) {
            echo ADMIN_COHERENCE_MSG5;

            echo '<br>';
        } else {
            echo "<small>CHECKSUM = $sumsum - ALLER $row[0] RETOUR $row[1]  </small>";

            echo '<big>' . ADMIN_COHERENCE_MSG6 . '</big>';
        }
    }

    $query = 'SELECT id_equipe_dom as DOM, count(*) as ct FROM '
              . $xoopsDB->prefix('matchs')
              . ', '
              . $xoopsDB->prefix('journees')
              . ' WHERE  '
              . $xoopsDB->prefix('journees')
              . ".id_champ='$champ' AND "
              . $xoopsDB->prefix('matchs')
              . '.id_journee='
              . $xoopsDB->prefix('journees')
              . '.id GROUP BY DOM';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        if ($row[1] != $nb_journees / 2) {
            $nom_club = nom_club($row[0]);

            echo "<br> $nom_club  joue $row[1] fois à domicile ?";
        }
    }

    $query = 'SELECT id_equipe_ext as DOM,  count(*) as ct FROM '
              . $xoopsDB->prefix('matchs')
              . ', '
              . $xoopsDB->prefix('journees')
              . ' WHERE  '
              . $xoopsDB->prefix('journees')
              . ".id_champ='$champ' AND "
              . $xoopsDB->prefix('matchs')
              . '.id_journee='
              . $xoopsDB->prefix('journees')
              . '.id GROUP BY DOM';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        if ($row[1] != $nb_journees / 2) {
            $nom_club = nom_club($row[0]);

            echo "<br> $nom_club  joue $row[1] fois à l'extérieur ?";
        }
    }
}

$xoopsDB->prefix('saisons') . annee;
xoops_cp_footer();
?>

