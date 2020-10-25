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
$message = ADMIN_SECURITE_CLASSE;
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

echo '<h1>';
echo ADMIN_CLASSE_TITRE;
echo '</h1>';
echo '<HR>';
// SUPPRESSION
switch ($go) {
    case 'supp_classe' :
    {
        //$id_classe='$data';
        $nb_classe = nb_classe($data);
        if (0 == $nb_classe) {
            $xoopsDB->queryF(' delete from ' . $xoopsDB->prefix('classe') . " where id='$data' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

            echo '<font color=green>' . ADMIN_CLUB_SUPP2 . '</font>';
        } else {
            echo ADMIN_CLASSE_3;

            echo "$nb_classe";

            echo ADMIN_CLASSE_4;
        }
        continue;
    }
    case 'crea_classe':
    {
        $xoopsDB->queryF('insert into ' . $xoopsDB->prefix('classe') . " (nom) values ('$data')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        echo '<font color=green>' . ADMIN_CLUB_CREA2 . '</font>';
        continue;
    }
    default:
    {
    }
}
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo ADMIN_CLASSE_SUPP1;
echo '<select name="data">';
echo '<option value="0"> </option>';
$result = $xoopsDB->queryF('select * from ' . $xoopsDB->prefix('classe') . ' ORDER BY nom');
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    $a = $row[1] + 1;

    echo(" <option value=\"$row[0]\">$row[1]");

    echo("</option>\n>");
}
echo '</select>';
$button = ADMIN_CLASSE_BUTTON_SUPP;
echo "<input type=\"submit\" value=$button onClick=\"return demander_confirmation()\">";

echo '<input type="hidden" name="go" value="supp_classe" ></form>';

echo '<br>';
echo ADMIN_CLASSE_CREA;
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo ADMIN_CLASSE_NOM;
echo '<input type="text" name="data">';

echo '<input type="hidden" name="go" value="crea_classe">';

$button = ADMIN_CLASSE_BUTTON_CREA;
echo "<input type=\"submit\" value=$button></form>";
echo ADMIN_CLASSE_BUTTON_MSG3;
echo '<HR>';
if ('1' == $action) {
    $nb_classe2 = nb_classe2();

    $x = 0;

    while ($x <= $nb_classe2) {
        $xoopsDB->queryF('update ' . $xoopsDB->prefix('classe') . " SET rang='$rang[$x]' WHERE id='$id[$x]'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

        $x++;
    }

    echo '<font color="#008000">' . ADMIN_CLASSE_2 . '</font>';

    echo '</form>';
}
echo '<br>';
echo ADMIN_CLASSE_1;
$query = 'select id, nom, rang from ' . $xoopsDB->prefix('classe') . ' order by rang';
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
$result = $xoopsDB->queryF($query);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    echo '<table  2 border="0" cellpadding="2" cellspacing="0" valign="bottom" align="center"><tr  3>';

    echo "<td><input type=\"text\" name=\"rang[]\" value=\"$row[2]\" size=1 maxlength=1><b> $row[1]</b></td>";

    echo "<input type=\"hidden\" name=\"id[]\" value=\"$row[0]\"></tr>";

    $query2 = 'select id, nom, rang, id_classe from ' . $xoopsDB->prefix('rens') . " where id_classe='$row[0]' order by rang";

    $result2 = $xoopsDB->queryF($query2);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "<tr>
<td align=\"left\"> $row[1]</td>
</tr>";
    }

    echo '<br>';
}
echo '</table><br><input type="hidden" name="action" value="1"> <td colspan=2><center><input type="submit" value=' . ENVOI . '>';
echo '<br><br></center>';
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
$xoopsDB->prefix('classe') . saisons . annee;
xoops_cp_footer();
?>

