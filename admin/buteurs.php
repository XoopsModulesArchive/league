<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();

require 'fonctions.php';
require '../config.php';

// ;

if (1 == !$journee_suivante) {
}

echo '<h1 align=center>';
echo ADMIN_BUTEURS_TITRE;
echo '</h1>';
if (!isset($champ)) {
    // choix du champ couple championnat-saison

    // choix de la journée à saisir

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>' . ADMIN_BUTEURS_MSG1 . '</h3>';

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
              . '.id order by annee desc';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0] " . ADMIN_JOURNEES_MSG3 . " $row[1]/" . ($row[1] + 1) . '');

        echo("</option>\n>");
    }

    echo '</select>';

    echo '<input type="submit" value=' . ENVOI . '></form><br>';
} elseif (!isset($numero)) /*Choix du numéro de journée*/ {
    $query = 'SELECT numero FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$champ' ORDER BY numero";
    $result = $xoopsDB->queryF($query);
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo '<br><h3>' . ADMIN_BUTEURS_MSG2 . '</h3>';
    echo '<select name="numero">';
    echo '<option value="0"></option>';
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        echo "<option value=\"$row[0]\">$row[0]";

        echo('</option>');
    }
    echo '</select>';
    echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";
    echo '<input type="submit" value=' . ENVOI . '></form><br>';
} else {
    if ('supp' == $act) {
        $GLOBALS['xoopsDB']->queryF('delete from  ' . $xoopsDB->prefix('buteurs') . " where id='$id' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    if ($numero > 1) {
        echo "<a href='buteurs.php?numero=" . ($numero - 1) . '&champ=' . $champ . "'>" . ADMIN_BUTEURS_LAST . '</a>&nbsp;';
    }

    echo '<b>' . ADMIN_JOURNEES_MSG9 . ' ' . $numero . '</b>';

    if ($numero < nb_journees($champ)) {
        echo "&nbsp;<a href='buteurs.php?numero=" . ($numero + 1) . '&champ=' . $champ . "'>" . ADMIN_BUTEURS_NEXT . '</a>';
    }

    echo '<br>' . ADMIN_JOUEURS_1;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<table class=phpl2 border="0" cellpadding="0" cellspacing="0" valign="bottom" align="center"><tr><td>';

    echo '<table class=phpl3 cellspacing="0" cellpadding="3" >'; //valign=\"top\" align=\"center\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\" font size=\"8pt\

    echo '<tr class=phpl4 align ="left"><td align="right">' . DOMICILE . '<td><td>' . BUTEUR . '<td><td><td><td>' . BUTEUR . '<td>' . EXTERIEUR . '</tr>';

    $query = 'SELECT ' . $xoopsDB->prefix('clubs') . '.nom, CLEXT.nom, ' . $xoopsDB->prefix('matchs') . '.buts_dom, ' . $xoopsDB->prefix('matchs') . '.buts_ext, ' . $xoopsDB->prefix('matchs') . '.id , ' . $xoopsDB->prefix('clubs') . '.id, CLEXT.id
         FROM ' . $xoopsDB->prefix('clubs') . ',' . $xoopsDB->prefix('clubs') . ' as CLEXT, ' . $xoopsDB->prefix('matchs') . ',' . $xoopsDB->prefix('journees') . ',' . $xoopsDB->prefix('equipes') . ',' . $xoopsDB->prefix('equipes') . ' as EXT
         WHERE ' . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix('equipes') . '.id_club
         AND CLEXT.id=EXT.id_club
         AND ' . $xoopsDB->prefix('equipes') . '.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_dom
         AND EXT.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_ext
         AND ' . $xoopsDB->prefix('matchs') . '.id_journee=' . $xoopsDB->prefix('journees') . '.id
         AND ' . $xoopsDB->prefix('journees') . ".numero='$numero'
         AND " . $xoopsDB->prefix('journees') . ".id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    $e = 0;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if (0 == ($e % 2)) {
            echo '<tr bgcolor="#e5e5e5">';
        } else {
            echo '<tr bgcolor="#FFFFFF">';
        }

        print "<td align=\"right\">$row[0]<td>";

        echo "<input type=\"hidden\" name=\"nbdom[]\" value=\"$row[2]\">";

        echo "<input type=\"hidden\" name=\"matchs_id[]\" value=\"$row[4]\">";

        echo '<input type="hidden" name="butd[]" value="1">';

        echo '<input type="hidden" name="butv[]" value="1">';

        echo "<input type=\"hidden\" name=\"nbext[]\" value=\"$row[3]\">";

        $x = 0;

        while ($x < $row[2]) {
            $queryJ = 'SELECT ' . $xoopsDB->prefix('joueurs') . '.id, ' . $xoopsDB->prefix('joueurs') . '.id_club, ' . $xoopsDB->prefix('joueurs') . '.nom, ' . $xoopsDB->prefix('joueurs') . '.prenom
                         FROM ' . $xoopsDB->prefix('joueurs') . ', ' . $xoopsDB->prefix('clubs') . '
                         WHERE ' . $xoopsDB->prefix('joueurs') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id
                         AND ' . $xoopsDB->prefix('joueurs') . ".id_club=$row[5]
                         ORDER BY " . $xoopsDB->prefix('joueurs') . '.prenom, ' . $xoopsDB->prefix('joueurs') . '.nom';

            $resultJ = $GLOBALS['xoopsDB']->queryF($queryJ);

            if (!$resultJ) {
                die ($GLOBALS['xoopsDB']->error());
            }

            echo '<select name="joueursDom[]">';

            echo '<option value="0"></option>';

            while (false !== ($rowJ = $GLOBALS['xoopsDB']->fetchBoth($resultJ))) {
                echo "<option  value=\"$rowJ[0]\">$rowJ[3] $rowJ[2]";

                echo('</option>');
            }

            echo '</select><br>';

            $x++;
        }

        echo '<td>';

        $query3 = 'SELECT ' . $xoopsDB->prefix('joueurs') . '.nom, ' . $xoopsDB->prefix('joueurs') . '.prenom,  ' . $xoopsDB->prefix('buteurs') . '.id
          FROM  ' . $xoopsDB->prefix('buteurs') . ', ' . $xoopsDB->prefix('joueurs') . '
          WHERE id_joueur=' . $xoopsDB->prefix('joueurs') . '.id and ' . $xoopsDB->prefix('joueurs') . ".id_club=$row[5] and  " . $xoopsDB->prefix('buteurs') . ".id_match=$row[4]";

        $result3 = $GLOBALS['xoopsDB']->queryF($query3);

        if (!$result3) {
            die ($GLOBALS['xoopsDB']->error());
        }

        while (false !== ($row3 = $GLOBALS['xoopsDB']->fetchBoth($result3))) {
            echo "<a href=?act=supp&numero=$numero&champ=$champ&id=$row3[2]>$row3[0] $row3[1]</a><br>";
        }

        echo '<td width="20" align="center" bgcolor="#E5E5E5">';

        echo " <b>$row[2] </b>";

        echo '<td width="20" align="center" bgcolor="#E5E5E5">';

        echo "<b> $row[3]</b> ";

        echo '<td>';

        $y = 0;

        while ($y < $row[3]) {
            $queryJ = 'SELECT ' . $xoopsDB->prefix('joueurs') . '.id, ' . $xoopsDB->prefix('joueurs') . '.id_club, ' . $xoopsDB->prefix('joueurs') . '.nom, ' . $xoopsDB->prefix('joueurs') . '.prenom 
                  FROM ' . $xoopsDB->prefix('joueurs') . ', ' . $xoopsDB->prefix('clubs') . '
                  WHERE ' . $xoopsDB->prefix('joueurs') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id AND ' . $xoopsDB->prefix('joueurs') . ".id_club=$row[6] ORDER BY " . $xoopsDB->prefix('joueurs') . '.prenom, ' . $xoopsDB->prefix('joueurs') . '.nom';

            $resultJ = $GLOBALS['xoopsDB']->queryF($queryJ);

            //if (!$resultJ) die ($GLOBALS['xoopsDB']->error());

            echo '<select name="joueursExt[]">';

            echo '<option value="0"></option>';

            while (false !== ($rowJ = $GLOBALS['xoopsDB']->fetchBoth($resultJ))) {
                echo "<option value=\"$rowJ[0]\">$rowJ[3] $rowJ[2]";

                echo('</option>');
            }

            echo '</select><br>';

            $y++;
        }

        echo '<td>';

        $query3 = 'SELECT ' . $xoopsDB->prefix('joueurs') . '.nom, ' . $xoopsDB->prefix('joueurs') . '.prenom,  ' . $xoopsDB->prefix('buteurs') . '.id
          FROM  ' . $xoopsDB->prefix('buteurs') . ', ' . $xoopsDB->prefix('joueurs') . '
          WHERE id_joueur=' . $xoopsDB->prefix('joueurs') . '.id and ' . $xoopsDB->prefix('joueurs') . ".id_club=$row[6] and  " . $xoopsDB->prefix('buteurs') . ".id_match=$row[4]";

        $result3 = $GLOBALS['xoopsDB']->queryF($query3);

        if (!$result3) {
            die ($GLOBALS['xoopsDB']->error());
        }

        while (false !== ($row3 = $GLOBALS['xoopsDB']->fetchBoth($result3))) {
            echo "<a href=?act=supp&numero=$numero&champ=$champ&id=$row3[2]>$row3[0]$row3[1]</a><br>";
        }

        $e++;

        echo "<td>$row[1]";
    }

    echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";

    echo '<input type="hidden" name="act" value="2">';

    $query2 = 'select ' . $xoopsDB->prefix('matchs') . '.id from ' . $xoopsDB->prefix('matchs') . ' where ' . $xoopsDB->prefix('matchs') . ".id_journee=$numero";

    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

    $nb_matchs = nb_matchs($numero, $champ);

    if (2 == $act) {
        $a = 0;

        $x = 0;

        $b = 0;

        while ($x < $nb_matchs) {
            $y = 0;

            $r = 0;

            while ($nbdom[$x] > $y) {
                if (!('' == $nbdom[$x]) and !('0' == $nbdom[$x]) and !('0' == $joueursDom[$a])) {
                    $query5 = 'INSERT INTO  ' . $xoopsDB->prefix('buteurs') . " (id_match, buts, id_joueur) VALUES ('$matchs_id[$x]','1','$joueursDom[$a]') ";

                    $GLOBALS['xoopsDB']->queryF($query5);
                }

                $y++;

                $a++;
            }

            while ($nbext[$x] > $r) {
                if (!('' == $nbext[$x]) and !('0' == $nbext[$x]) and !('0' == $joueursExt[$b])) {
                    $query5 = 'INSERT INTO  ' . $xoopsDB->prefix('buteurs') . " (id_match, buts, id_joueur) VALUES ('$matchs_id[$x]','1','$joueursExt[$b]') ";

                    $GLOBALS['xoopsDB']->queryF($query5);
                }

                $r++;

                $b++;
            }

            $x++;
        }
    }

    $numero = $numero + 1;

    echo "</td></tr><tr><td colspan=\"8\"><input type=\"hidden\" name=\"numero\" value=\"$numero\">";

    echo '<input type="hidden" name="journee_suivante" value=1>';

    $button = ENVOI;

    echo "<br><center><input type=\"submit\" value=$button></center>";

    echo '</td></tr></table></td></tr></table>';

    echo '</form>';
}
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
xoops_cp_footer();
?>
