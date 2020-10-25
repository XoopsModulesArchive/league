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

// ;

print ("<SCRIPT type=\"text/javascript\">\n");
print ("<!--\n");
print ("function demander_confirmation()\n");
print ("{\n");
print ("var champ_select = document.getElementById('data');\n");
$message = ADMIN_SECURITE_SAISONS;
$message2 = ADMIN_SECURITE_SAISONS_2;
print ("var message = \"$message \";\n");
print ("message = message + champ_select.options[champ_select.options.selectedIndex].text + \" $message2 ?\"; \n");

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

if ('suppsaison' == $go) {
    $query = 'select ' . $xoopsDB->prefix('equipes') . '.id from ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('championnats') . ' where id_champ=' . $xoopsDB->prefix('championnats') . '.id and ' . $xoopsDB->prefix('championnats') . ".id_saison='$data'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('matchs') . " where id_equipe_dom='$row[0]' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

        $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('matchs') . " where id_equipe_ext='$row[0]' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('tapis_vert') . " WHERE id_equipe ='$row[0]' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
    }

    $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('saisons') . " where id='$data' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('championnats') . " where id_saison='$data' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('equipes') . " where id_champ='$data' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE from ' . $xoopsDB->prefix('journees') . " where id_champ='$data' ") or die ('probleme' . $GLOBALS['xoopsDB']->error());

    $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('parametres') . " WHERE id_champ ='$data' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    echo '<font color=green>' . ADMIN_SUPPSAISON_MSG1 . '</font> - ';

    echo '<a href="javascript:history.back()">' . RETOUR . '</a>';
} elseif ('cresaison' == $go) {
    $xoopsDB->queryF('insert into ' . $xoopsDB->prefix('saisons') . " (annee) values ($data)") or die ('probleme ' . $GLOBALS['xoopsDB']->error() . __LINE__);

    echo '<font color=green>' . ADMIN_CRESAISON_MSG1 . '</font>';
} else {
    echo '<h1> ' . ADMIN_SAISON_TITRE . '</h1>';

    echo ADMIN_SAISON_SUPP1;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo ADMIN_SAISON_SUPP2;

    echo '<select name="data">';

    echo '<option value="0"> </option>';

    $result = $xoopsDB->queryF('select * from ' . $xoopsDB->prefix('saisons') . ' order by annee desc');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $a = $row[1] + 1;

        echo(" <option value=\"$row[0]\">" . ADMIN_SAISON_MSG3 . " $row[1]/$a");

        echo("</option>\n>");
    }

    $button = ADMIN_SAISON_BUTTON_SUPP;

    echo "<input type=\"hidden\" name=\"champ\" value=\"id\">
    <input type=\"hidden\" name=\"go\" value=\"suppsaison\">
    </select><input type=\"submit\" value=$button onClick=\"return demander_confirmation()\">

    </form>";

    echo ADMIN_SAISON_MSG1;

    echo '<HR>' . ADMIN_SAISON_CREA;

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo ADMIN_SAISON_MSG2;

    echo '<input type="text" size="5" name="data">
    <input type="hidden" name="go" value="cresaison">';

    $button = ADMIN_SAISON_BUTTON_CREA;

    echo "<input type=\"submit\" value=$button ></form>";

    //echo ADMIN_SAISON_BUTTON_MSG3."<br><br>";
    // ;
}
xoops_cp_footer();
?>
