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
print ("<SCRIPT type=\"text/javascript\">\n");
print ("<!--\n");
print ("function demander_confirmation()\n");
print ("{\n");
print ("var champ_select = document.getElementById('data');\n");
$message = ADMIN_SECURITE_CHAMP;
print ("var message = \"$message \";\n");
print ("message = message + champ_select.options[champ_select.options.selectedIndex].text + \" ?\"; \n");

// confirm() fait apparaitre la boite de dialogue
print ("if (confirm(message))\n");
print ("{\n");
// action à faire si OK (soumettre le formulaire)
print ("return true;\n");
print ("}\n");
print ("else\n");
print ("{\n");
// action à faire si 'Annuler' (ici, rien)
print ("return false;\n");
print ("}\n");
print ("}\n");

print ("//-->\n");
print ("</SCRIPT>\n");

if ('suppchamp' == $go) {
    $query = 'select ' . $xoopsDB->prefix('equipes') . '.id from ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('championnats') . " where id_champ='$data'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('matchs') . " where id_equipe_dom='$row[0]' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

        $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('matchs') . " where id_equipe_ext='$row[0]' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('tapis_vert') . " WHERE id_equipe ='$row[0]' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('championnats') . " where id='$data' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('journees') . " WHERE  id_champ = '$data'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('equipes') . " WHERE id_champ ='$data' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('parametres') . " WHERE id_champ ='$data' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    echo '<font color=green>' . ADMIN_SUPPSAISON_MSG1 . '</font> - ';

    echo '<a href="javascript:history.back()">' . RETOUR . '</a>';
} elseif ('crechamp' == $go) {
    $xoopsDB->queryF('insert into ' . $xoopsDB->prefix('championnats') . " (id_division, id_saison) values ('$division', '$saison')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    echo '<font color=green>' . ADMIN_CLUB_CREA2 . '</font>';
} else {
    echo '<h1 align=center>';

    echo ADMIN_CHAMPIONNATS_TITRE;

    echo '</h1>';

    //liste des ".$xoopsDB->prefix("championnats")."

    //listechamp();

    // SUPPRESSION

    echo '<HR>';

    echo ADMIN_CHAMPIONNATS_SUPP;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">
<select name=\"data\">";

    echo '<option value="0"> </option>';

    $result = $xoopsDB->queryF(
        'select ' . $xoopsDB->prefix('championnats') . '.id, ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee from ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('divisions') . ' WHERE ' . $xoopsDB->prefix(
            'divisions'
        ) . '.id=' . $xoopsDB->prefix('championnats') . '.id_division AND ' . $xoopsDB->prefix('saisons') . '.id=' . $xoopsDB->prefix('championnats') . '.id_saison ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id '
    );

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = $row[2] + 1;

        echo("<option value=\"$row[0]\">$row[1] " . ADMIN_SAISON_MSG3 . " $row[2]/$x\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ADMIN_CHAMPIONNATS_BUTTON_SUPP;

    echo '<input type="hidden" name="go" value="suppchamp">';

    echo "<input type=\"submit\" value=$button onClick=\"return demander_confirmation()\"></form>";

    // CREATION

    echo "<HR><form action=\"$PHP_SELF\" method=\"GET\"><h3>";

    echo ADMIN_CHAMPIONNATS_CREA;

    echo '</h3>';

    echo '<br><b>';

    echo ADMIN_CHAMPIONNATS_MSG1;

    echo '</b>';

    echo '<select name="division">';

    echo '<option value="0"> </option>';

    $result = $xoopsDB->queryF('select  ' . $xoopsDB->prefix('divisions') . '.id, ' . $xoopsDB->prefix('divisions') . '.nom from  ' . $xoopsDB->prefix('divisions') . '');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[0]\">$row[1]\n");

        echo("</option>\n>");
    }

    echo '</select>';

    echo '<br><b>';

    echo ADMIN_CHAMPIONNATS_MSG2;

    echo '</b>';

    echo '<select name="saison">';

    echo '<option value="0"> </option>';

    $result = $xoopsDB->queryF('select  * from ' . $xoopsDB->prefix('saisons') . '');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $row[2] = $row[1] + 1;

        echo("<option value=\"$row[0]\">Saison $row[1]/$row[2]\n");

        echo("</option>\n>");
    }

    echo '</select><br>';

    $button = ADMIN_CHAMPIONNATS_BUTTON_CREA;

    echo '<input type="hidden" name="go" value="crechamp">';

    echo "<input type=\"submit\" value=$button></form><br>";

    echo ADMIN_CHAMPIONNATS_BUTTON_MSG3;

    echo '<br><br>';

    //ENTETE();
}

xoops_cp_footer();
?>
