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

if (!isset($id)) {
    $result = $GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('clubs') . ' ORDER BY nom');

    echo '<h1>' . ADMIN_EQUIPE_TITRE . '</h1>';

    echo '<form action="gestequipes.php" method="GET">';

    echo '<h3>' . ADMIN_EQUIPE_2 . '</h3>';

    echo '<select name="id">';

    echo '<option value="0"> </option>';

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $a = $row[1] + 1;

        echo(" <option value=\"$row[0]\">$row[1]");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button>";

    echo '</form>';
} elseif ('1' != $go) {
    // On met a jour la bd

    $query = 'select * from ' . $xoopsDB->prefix('logo') . " where id_club='$id'";

    $result = $xoopsDB->queryF($query);

    $nb = $GLOBALS['xoopsDB']->getRowsNum($result);

    // Si pas d'URL ".$xoopsDB->prefix("logo")." ".$xoopsDB->prefix("rens")."eignée, on l'insère

    if ('0' == $nb) {
        $GLOBALS['xoopsDB']->queryF('insert into ' . $xoopsDB->prefix('logo') . " (id_club) values ('$id')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    $query2 = 'select * from ' . $xoopsDB->prefix('donnee') . " where id_clubs='$id'";

    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

    $nb2 = $GLOBALS['xoopsDB']->getRowsNum($result2);

    $nb_rens = nb_rens2();

    // Si pas de donnée pour les ".$xoopsDB->prefix("rens")."eignements, on les crée

    if (!$nb2 == $nb_rens) {
        $query = 'select id from ' . $xoopsDB->prefix('rens') . '';

        $result = $GLOBALS['xoopsDB']->queryF($query);

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            $GLOBALS['xoopsDB']->queryF('insert into ' . $xoopsDB->prefix('donnee') . " (id_clubs, id_rens) values ('$id', '$row[0]')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        }
    }

    echo '<h3>';

    $query = 'select id, nom from ' . $xoopsDB->prefix('clubs') . " where id='$id'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo '<h3 align="center">';

        echo ADMIN_EQUIPE_1;

        echo $row[1];
    }

    echo '</h3></h3><br><br>';

    echo "<table  2 border=\"0\" cellpadding=\"2\" cellspacing=\"0\" valign=\"bottom\" align=\"center\"><form action=\"$PHP_SELF\" method=\"get\">";

    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";

    $query = 'select ' . $xoopsDB->prefix('clubs') . '.id, url from ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('logo') . ' where ' . $xoopsDB->prefix('clubs') . ".id='$id' and " . $xoopsDB->prefix('logo') . ".id_club='$id'";

    $result = $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo '<tr  3>
                          <td align="left"><b>' . $xoopsDB->prefix('classe') . '</b></td>
                          <td align="left"><b>' . ADMIN_EQUIPE_3 . '</b></td>
                          <td align="left"><b>' . ADMIN_EQUIPE_4 . '</b></td>
                          <td align="left"><b>' . ADMIN_EQUIPE_5 . '</b></td>
                          <td align="left"><b>' . ADMIN_EQUIPE_6 . '</b></td></tr>';

        echo '<tr  2><td></td><td align="left">' . ADMIN_EQUIPE_7 . '</td>';

        echo "<td align=\"left\"><input type=\"text\" name=\"urllogo\" value=\"$row[1]\" size=25 maxlength=200><td></td><td></td></td></tr>";
    }

    $query2 = 'select ' . $xoopsDB->prefix('classe') . '.nom, ' . $xoopsDB->prefix('classe') . '.id FROM ' . $xoopsDB->prefix('classe') . ' order by rang';

    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

    while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchRow($result2))) {
        $query = 'SELECT ' . $xoopsDB->prefix('rens') . '.nom, ' . $xoopsDB->prefix('donnee') . '.nom, ' . $xoopsDB->prefix('donnee') . '.id, ' . $xoopsDB->prefix('donnee') . '.etat, ' . $xoopsDB->prefix('donnee') . '.url, ' . $xoopsDB->prefix('classe') . '.nom
                             FROM ' . $xoopsDB->prefix('rens') . ', ' . $xoopsDB->prefix('classe') . ', ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('donnee') . '
                             WHERE ' . $xoopsDB->prefix('clubs') . ".id='$id'
                                   AND id_clubs='$id'
                                   AND id_classe='$row2[1]'
                                   AND id_classe=" . $xoopsDB->prefix('classe') . '.id
                                   AND ' . $xoopsDB->prefix('rens') . '.id=id_rens
                             ORDER by ' . $xoopsDB->prefix('rens') . '.rang';

        $result = $GLOBALS['xoopsDB']->queryF($query);

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
            echo "<tr><td><b>$row[5]</b></td>";

            echo "<td>$row[0] : </td>";

            echo "<td><input type=\"text\" name=\"nom[]\" value=\"$row[1]\" size=25></td>";

            echo "<td><input type=\"text\" name=\"url[]\" value=\"$row[4]\" size=25></td>";

            echo "<td><center><input type=\"text\" name=\"etat[]\"  value=\"$row[3]\" size=1 maxlength=1></center></td>";

            echo "<input type=\"hidden\" name=\"idd[]\" value=\"$row[2]\" size=40 maxlength=99>";

            echo '</tr>';
        }
    }

    echo '<tr><td colspan="8"><br><input type="hidden" name="go" value="1">
         <center><input type="submit" value=' . ENVOI . '></td></tr></table>';

    echo '<br><br>';

    $query = 'select url from ' . $xoopsDB->prefix('logo') . " where id='$id'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<center><img src=\"$row[0]\"><br><br><br><br>";
    }

    $query = 'select ' . $xoopsDB->prefix('classe') . '.nom, ' . $xoopsDB->prefix('classe') . '.id FROM ' . $xoopsDB->prefix('classe') . ' order by rang';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo '<table  2 cellspacing="0" align=center>';

        echo "<tr  3><td><b><font color=\"#FFFFFF\">$row[0]</font></b></td></tr>";

        $id_classe = $row[1];

        echo '<td><table cellspacing="0"><tr><td><font face="arial" size="2">';

        $aff_rens = aff_rens($id_classe, $id);

        echo "$aff_rens</font>";

        echo '</tr></td>';

        echo '</table></td></table><br><br>';
    }

    echo '<table  2 cellspacing="0" align=center><tr  3><td><b><font color="#FFFFFF">' . CONSULT_CLUB_3 . '</font></b></td></tr>';

    $query = 'select annee, ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('championnats') . '.id, ' . $xoopsDB->prefix('equipes') . '.id
         FROM ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . '
         WHERE ' . $xoopsDB->prefix('equipes') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id
               AND id_division=' . $xoopsDB->prefix('divisions') . '.id
               AND ' . $xoopsDB->prefix('clubs') . '.id=id_club
               AND ' . $xoopsDB->prefix('equipes') . ".id_club='$id'
               AND " . $xoopsDB->prefix('saisons') . '.id=' . $xoopsDB->prefix('championnats') . '.id_saison order by annee desc';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo '<tr><td>';

        echo "<tr  2><td><center>$row[0]/" . ($row[0] + 1) . " ($row[1])</td></tr>";

        echo "<tr><td><a href=\"../consult/classement.php?champ=$row[2]&type=G%E9n%E9ral\">" . CONSULT_CLUB_1 . '</a></td></tr>';

        echo "<tr><td><a href=\"../consult/detaileq.php?champ=$row[2]&equipe=$row[3]\">" . CONSULT_CLUB_2 . '</a><br><br></td></tr>';

        echo '</td></tr>';
    }

    echo '</table><br><br>';
} elseif ('1' == $go) {
    $nb_rens = nb_rens($id);

    $x = 0;

    while ($x <= $nb_rens) {
        $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('logo') . " SET url='$urllogo' WHERE id_club='$id'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

        $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('donnee') . " SET nom='$nom[$x]', etat='$etat[$x]', url='$url[$x]' WHERE id='$idd[$x]'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

        $x++;
    }

    echo '<font color="#008000">' . ADMIN_CLASSE_2 . '</font>';

    echo '</form>';
}
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
$xoopsDB->prefix('saisons') . annee;
xoops_cp_footer();
?>

