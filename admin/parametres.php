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

    echo ADMIN_PARAM_TITRE;

    echo '</h1>';

    // choix du calendrier couple championnat-saison

    // choix de la journée à saisir

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>';

    echo ADMIN_PARAM_MSG1;

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

    $data = ADMIN_JOURNEES_MSG3;

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0] $data $row[1]/" . ($row[1] + 1) . '');

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button></form><br>";
} elseif ('1' != $go) {
    // extraction de l'existant

    $query = 'SELECT * FROM ' . $xoopsDB->prefix('parametres') . " WHERE id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    $existant = $GLOBALS['xoopsDB']->fetchBoth($result);

    //echo $existant[1];

    // début du formulaire

    echo '<h3 align="center">Réglage des paramètres du championnat :<br>';

    $query = 'SELECT '
              . $xoopsDB->prefix('divisions')
              . '.nom, '
              . $xoopsDB->prefix('saisons')
              . '.annee, ('
              . $xoopsDB->prefix('saisons')
              . '.annee)+1 FROM '
              . $xoopsDB->prefix('championnats')
              . ', '
              . $xoopsDB->prefix('divisions')
              . ', '
              . $xoopsDB->prefix('saisons')
              . ' WHERE '
              . $xoopsDB->prefix('championnats')
              . ".id='$champ' AND "
              . $xoopsDB->prefix('divisions')
              . '.id='
              . $xoopsDB->prefix('championnats')
              . '.id_division AND '
              . $xoopsDB->prefix('saisons')
              . '.id='
              . $xoopsDB->prefix('championnats')
              . '.id_saison';

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo $row[0] . '  ' . $row[1] . '/' . $row[2] . '</h3>';
    }

    echo "<table valign=\"bottom\"><tr valign=\"bottom\"><td><form action=\"$PHP_SELF\" method=\"get\">";

    echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";

    //points pour la victoire

    echo ADMIN_PARAM_MSG2;

    echo '<td>';

    echo "<input type=\"text\" name=\"pts_victoire\" value=\"$existant[pts_victoire]\" size=3 maxlength=3>";

    // points pour un nul

    echo '<tr valign="bottom"><td valign="bottom">';

    echo ADMIN_PARAM_MSG3;

    echo '<td>';

    echo "<input type=\"text\" name=\"pts_nul\"  value=\"$existant[pts_nul]\" size=3 maxlength=3>";

    // points pour une défaite

    echo '<tr valign="bottom"><td valign="bottom">';

    echo ADMIN_PARAM_MSG4;

    echo ' <td>';

    echo "<input type=\"text\" name=\"pts_defaite\"  value=\"$existant[pts_defaite]\" size=3 maxlength=3>";

    // Nombre d'équipe pour l'accession directe

    echo '<tr valign="bottom"><td valign="bottom">';

    echo ADMIN_PARAM_MSG5;

    echo ' <td>';

    echo "<input type=\"text\" name=\"accession\"  value=\"$existant[accession]\" size=3 maxlength=3>";

    // Nombre d'équipe pour des l'accession en barrages

    echo '<tr valign="bottom"><td valign="bottom">';

    echo ADMIN_PARAM_MSG6;

    echo ' <td>';

    echo "<input type=\"text\" name=\"barrage\"  value=\"$existant[barrage]\" size=3 maxlength=3>";

    // Nombre d'équipe pour la descente

    echo '<tr valign="bottom"><td valign="bottom">';

    echo ADMIN_PARAM_MSG7;

    echo ' <td>';

    echo "<input type=\"text\" name=\"relegation\"  value=\"$existant[relegation]\" size=3 maxlength=3>";

    // Equipe à suivre plus particulièrement

    $query = 'SELECT ' . $xoopsDB->prefix('clubs') . '.nom, ' . $xoopsDB->prefix('equipes') . '.id FROM ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('clubs') . ' WHERE ' . $xoopsDB->prefix('equipes') . ".id_champ='$champ' AND " . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix(
            'equipes'
        ) . '.id_club';

    $result = $xoopsDB->queryF($query);

    if (!$result) {
        die ($GLOBALS['xoopsDB']->error());
    }

    echo '<tr><td>';

    echo ADMIN_PARAM_MSG8;

    echo ' <td>';

    echo '<select name="id_equipe_fetiche">';

    echo '<option value="0"></option>';

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        if ($row[1] == $existant[id_equipe_fetiche]) {
            echo "<option value=\"$row[1]\" selected >$row[0]</option>";
        } else {
            echo "<option value=\"$row[1]\">$row[0]</option>";
        }
    }

    echo '</select>';

    echo '<tr><tr><input type="hidden" name="go" value="1"> <td colspan=2><input type="submit" value=' . ENVOI . '>';

    echo '</table>';

    echo '</form>';
} else {
    echo '<font color=green><b>' . ADMIN_PARAM_MSG9 . '</b></font>';

    $query = 'SELECT count(id_champ) FROM ' . $xoopsDB->prefix('parametres') . " WHERE id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    if (!$result) {
        die ($GLOBALS['xoopsDB']->error());
    }

    $row = $GLOBALS['xoopsDB']->fetchBoth($result);

    if ($row > 0) {
        //effacement de l'enregistrement existant

        $GLOBALS['xoopsDB']->queryF('DELETE FROM ' . $xoopsDB->prefix('parametres') . " WHERE id_champ='$champ'");
    }

    // insertion des paramètres dans la bdd

    $query = 'INSERT INTO ' . $xoopsDB->prefix('parametres') . " (id_champ, pts_victoire, pts_nul, pts_defaite, accession, barrage, relegation, id_equipe_fetiche) VALUES ('$champ', '$pts_victoire', '$pts_nul', '$pts_defaite', '$accession', '$barrage', '$relegation', '$id_equipe_fetiche')";

    $result = $xoopsDB->queryF($query);

    if (!$result) {
        die ($GLOBALS['xoopsDB']->error());
    }
}
xoops_cp_footer();
?>

