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

//switch($go)
//{
//  case "suppequipe" :
if ('suppequipe' == $go) {
    reset($data);

    while (list ($key, $val) = each($data)) {
        $xoopsDB->queryF(' delete from ' . $xoopsDB->prefix('equipes') . " where id='$val' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    echo '<font color="green">' . ADMIN_SUPPSAISON_MSG1 . '</font>';

    //	 continue;
}

//  case "creequipe":
if ('creequipe' == $go) {
    reset($num_club);

    while (list($val, $value) = each($num_club)) {
        $xoopsDB->queryF('insert into ' . $xoopsDB->prefix('equipes') . " (id_champ,id_club) values ('$num_champ','$value')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    echo '<font color="green">' . ADMIN_CRESAISON_MSG1 . '</font>';

    // 	 continue;
}
//	 default:
//	 {}
//}

if (!isset($num_club)) {
    echo '<h1 align=center>';

    echo ADMIN_EQUIPE_TITRE;

    echo '</h1><HR>';

    // SUPRESSION EQUIPE

    echo ADMIN_EQUIPE_MSG1;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo ADMIN_EQUIPE_MSG2;

    echo '<br>';

    echo '<select name="data[]" multiple  size=15>';

    $result = $xoopsDB->queryF(
        'SELECT '
        . $xoopsDB->prefix('equipes')
        . '.id, '
        . $xoopsDB->prefix('clubs')
        . '.id, '
        . $xoopsDB->prefix('clubs')
        . '.nom, '
        . $xoopsDB->prefix('championnats')
        . '.id, '
        . $xoopsDB->prefix('divisions')
        . '.nom, '
        . $xoopsDB->prefix('saisons')
        . '.annee FROM '
        . $xoopsDB->prefix('equipes')
        . ', '
        . $xoopsDB->prefix('championnats')
        . ', '
        . $xoopsDB->prefix('clubs')
        . ', '
        . $xoopsDB->prefix('saisons')
        . ', '
        . $xoopsDB->prefix('divisions')
        . ' WHERE '
        . $xoopsDB->prefix('championnats')
        . '.id='
        . $xoopsDB->prefix('equipes')
        . '.id_champ AND '
        . $xoopsDB->prefix('clubs')
        . '.id='
        . $xoopsDB->prefix('equipes')
        . '.id_club AND '
        . $xoopsDB->prefix('championnats')
        . '.id_saison='
        . $xoopsDB->prefix('saisons')
        . '.id AND '
        . $xoopsDB->prefix('championnats')
        . '.id_division='
        . $xoopsDB->prefix('divisions')
        . '.id AND '
        . $xoopsDB->prefix('equipes')
        . '.id>-1  ORDER BY '
        . $xoopsDB->prefix('saisons')
        . '.annee, '
        . $xoopsDB->prefix('divisions')
        . '.nom, '
        . $xoopsDB->prefix('clubs')
        . '.nom'
    );

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = $row[5] + 1;

        echo(" <option value=\"$row[0]\">$row[2] en $row[4] $row[5]/$x");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ADMIN_EQUIPE_BUTTON_SUPP;

    echo '<input type="hidden" name="go" value="suppequipe">';

    echo "<input type=\"submit\" value=$button>";

    echo '<input type="hidden" name="go" value="suppequipe">';

    echo '</form>';

    // CREATION EQUIPE

    echo '<HR>';

    echo ADMIN_EQUIPE_MSG3;

    echo "<form action=\"$PHP_SELF\" metdod=\"GET\">";

    echo '<select name="num_club[]" multiple  size=15>';

    $result = $xoopsDB->queryF('select * from ' . $xoopsDB->prefix('clubs') . ' ORDER BY nom');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo(" <option value=\"$row[0]\">$row[1]");

        echo("</option>\n>");
    }

    echo '</select><b>';

    echo ADMIN_EQUIPE_MSG4;

    echo '</b>';

    echo '<select name="num_champ">';

    echo '<option value="0"> </option>';

    $result = $xoopsDB->queryF(
        'SELECT ' . $xoopsDB->prefix('championnats') . '.id, ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee 
                       FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('saisons') . ' 
                       WHERE ' . $xoopsDB->prefix('championnats') . '.id_division=' . $xoopsDB->prefix('divisions') . '.id 
                       AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix('saisons') . '.id 
                       ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC , ' . $xoopsDB->prefix('divisions') . '.nom'
    );

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = $row[2] + 1;

        echo(" <option value=\"$row[0]\">$row[1]  $row[2]/$x");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ADMIN_CHAMPIONNATS_BUTTON_CREA;

    echo '<input type="hidden" name="go" value="creequipe">';

    echo "<input type=\"submit\" value=$button></form>";

    echo ADMIN_EQUIPE_MSG5;
}
$xoopsDB->prefix('saisons') . annee;
xoops_cp_footer();
?>

