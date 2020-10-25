<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;

if (!$xoopsUser) {
    redirect_header('index.php', 3, _US_NOEDITRIGHT);

    exit();
}

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des ".$xoopsDB->prefix("clubs")."  (Fiches clubs), mini-xoops_classement,                     //
//               statistiques, amélioration de la gestion des xoops_buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/xoops_classement/consult/classement.php?champ=2 //
// Description : Edition, gestion, Fiches clubs, statistiques, mini-xoops_classement...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

require '../config.php';
require 'fonctions.php';

print ("<SCRIPT type=\"text/javascript\">\n");
print ("<!--\n");
print ("function demander_confirmation()\n");
print ("{\n");
print ("var champ_select = document.getElementById('rens');\n");
$message = ADMIN_SECURITE_RENS;
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

switch ($go) {
    case 'supprrens' :
    {
        $GLOBALS['xoopsDB']->queryF(' delete from ' . $xoopsDB->prefix('rens') . "  where id='$" . $xoopsDB->prefix('rens') . " ' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        $GLOBALS['xoopsDB']->queryF(' delete from ' . $xoopsDB->prefix('donnee') . "  where id_rens='$" . $xoopsDB->prefix('rens') . " ' ") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        echo '<font color=green>' . ADMIN_RENS_SUPP2 . '</font>';

        continue;
    }
    case 'crerens':
    {
        $GLOBALS['xoopsDB']->queryF('insert into ' . $xoopsDB->prefix('rens') . "  (nom) values ('$rens')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        $rens2 = rens2($rens);

        $query = 'select id from ' . $xoopsDB->prefix('clubs') . ' ';
        $result = $GLOBALS['xoopsDB']->queryF($query);
        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $GLOBALS['xoopsDB']->queryF('insert into ' . $xoopsDB->prefix('donnee') . "  (id_clubs, id_rens) values ('$row[0]', '$rens2')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        }

        echo '<font color=green>' . ADMIN_CLUB_CREA2 . '</font>';
        continue;
    }
    default:
    {
    }
}

echo '<h1>';
echo ADMIN_RENS_TITRE;
echo '</h1>';

// Suppression d'un xoops_renseignement

echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo '<HR>';
echo ADMIN_RENS_SUPP1;
echo '<select name="rens">';
echo '<option value="0"> </option>';
$result = $GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('rens') . '  ORDER BY nom');

while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    $a = $row[1] + 1;

    echo(" <option value=\"$row[0]\">$row[1]");

    echo("</option>\n>");
}

echo '</select>';
$button = ADMIN_RENS_BUTTON_SUPP;
echo '<input type="hidden" name="go" value="supprrens">';
//echo "<input type=\"submit\" value=$button onClick=\"return demander_confirmation()\">";
echo "<input type=\"submit\" name=\"envoi\" value=$button onClick=\"return demander_confirmation()\">";
echo '</form>';

// Ajout d'un xoops_renseignement
echo '<br>';
echo ADMIN_RENS_CREA;
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo ADMIN_RENS_NOM;
echo '<input type="text" size="30" name="rens">';
echo '<input type="hidden" name="go" value="crerens">';
$button = ADMIN_RENS_BUTTON_CREA;
echo "<input type=\"submit\" value=$button></form>";
echo '<HR>';

// Editer les xoops_renseignements
if ('2' == $action) {
    $nb_rens = nb_rens();

    $x = 0;

    while ($x <= $nb_rens) {
        $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('rens') . "  SET url='$url[$x]', nom='$nom[$x]' WHERE id='$id[$x]'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

        $x++;
    }

    echo '<font color="#008000">' . ADMIN_CLASSE_2 . '</font>';

    echo '</form>';
}

echo '<br>';
echo ADMIN_RENS_10;
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo '<table  2 cellspacing="0" align=center border="0"><center>';
echo '<tr  3><td>' . ADMIN_RENS_12 . '</td><td>' . ADMIN_RENS_13 . '</td></tr>';
$query = 'select id, nom, url FROM ' . $xoopsDB->prefix('rens') . ' ';
$result = $xoopsDB->queryF($query);

while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    echo '<tr>';

    echo "<td><center><input type=\"text\" name=\"nom[]\"  value=\"$row[1]\" size=40 maxlength=99></td>";

    echo "<td><center><input type=\"text\" name=\"url[]\"  value=\"$row[2]\" size=40 maxlength=150></td>";

    echo "<input type=\"hidden\" name=\"id[]\"  value=\"$row[0]\" size=40 maxlength=150>";

    echo '</tr>';
}

echo '<input type="hidden" name="action"  value="2" size=40 maxlength=150>';
echo '<tr><td colspan="2"><br></tr>';
echo '<tr><td colspan="2"><center><input type="submit" value=' . ADMIN_RENS_11 . '></tr>';
echo '</table></center></form><br>';
echo '<HR>';

// xoops_classer les xoops_renseignements
switch ($ga) {
    case 'supprrens':
    {
        reset($data);
        while (list($key, $val) = each($data)) {
            $GLOBALS['xoopsDB']->queryF(' update ' . $xoopsDB->prefix('rens') . "  SET id_classe='0' WHERE " . $xoopsDB->prefix('rens') . " .id='$val'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        }
        echo '<font color=green>' . ADMIN_RENS_SUPP2 . '</font>';
        continue;
    }
    default:
    {
    }

    case 'crerens':
    {
        reset($xoops_classe);
        while (list($val, $value) = each($xoops_classe)) {
            $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('rens') . "  SET id_classe='$value' WHERE id='$rens'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        }

        echo '<font color=green>' . ADMIN_CLUB_CREA2 . '</font>';
        continue;
    }
    default:
    {
    }
}

// Entrer un xoops_renseignement dans une xoops_classe
echo '<br>';
echo '</center>';
$nb_rens2 = nb_rens2($id);
$nb_rens2 = $nb_rens2 + 1;
echo ADMIN_RENS_4;
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo '<select name="rens">';
echo '<option value="0"> </option>';
$result = $GLOBALS['xoopsDB']->queryF('select id, nom, id_classe from ' . $xoopsDB->prefix('rens') . '  ORDER BY nom');
while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    $a = $row[1] + 1;

    echo(" <option value=\"$row[0]\">$row[1]");

    echo("</option>\n>");
}

echo '</select>';
echo ADMIN_RENS_1;
echo '<select name="xoops_classe[]">';
$result = $GLOBALS['xoopsDB']->queryF('select id, nom FROM ' . $xoopsDB->prefix('classe') . '  ');
while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    echo(" <option value=\"$row[0]\">$row[1]");

    echo("</option>\n>");
}

echo '</select>';
$button = ADMIN_RENS_7;
echo "<input type=\"submit\" value=$button>";
echo '<input type="hidden" name="ga" value="crerens">';
echo '</form>';

// Enlever un xoops_renseignement d'une xoops_classe
echo '<br>';
echo '</center>';
$nb_rens = nb_rens($id);
$nb_rens = $nb_rens + 1;
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo ADMIN_RENS_5;
echo '<br>';
echo "<select name=\"data[]\"  multiple size=$nb_rens>";
$query = 'SELECT ' . $xoopsDB->prefix('rens') . ' .id, ' . $xoopsDB->prefix('rens') . ' .id_classe, ' . $xoopsDB->prefix('rens') . ' .nom, ' . $xoopsDB->prefix('classe') . ' .id, ' . $xoopsDB->prefix('classe') . ' .nom
       FROM ' . $xoopsDB->prefix('rens') . ' , ' . $xoopsDB->prefix('classe') . ' 
       WHERE ' . $xoopsDB->prefix('rens') . ' .id_classe=' . $xoopsDB->prefix('classe') . ' .id';
$result = $xoopsDB->queryF($query);

while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    echo(" <option value=\"$row[0]\">$row[2]" . ADMIN_RENS_6 . " $row[4]");

    echo("</option>\n>");
}

echo '</select>';
$button = ADMIN_RENS_8;
echo "<input type=\"submit\" value=$button>";
echo '<input type="hidden" name="ga" value="supprrens">';
echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
echo '</form>';

// Quels xoops_renseignements ne sont pas classés ?
echo ADMIN_RENS_14;
$query = 'select ' . $xoopsDB->prefix('rens') . ' .nom from ' . $xoopsDB->prefix('rens') . "  where id_classe='0'";
$result = $xoopsDB->queryF($query);
$nb = $GLOBALS['xoopsDB']->getRowsNum($result);

if ('0' == $nb) {
    echo '<br><center>' . ADMIN_RENS_15 . '</center>';
}

while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    echo "<br><center>$row[0]</center>";
}

echo '<HR>';

// Ordonner les xoops_renseignements
if ('1' == $action) {
    $nb_rens = nb_rens();

    $x = 0;

    while ($x <= $nb_rens) {
        $GLOBALS['xoopsDB']->queryF('update ' . $xoopsDB->prefix('rens') . "  SET rang='$rang[$x]' WHERE id='$id[$x]'") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

        $x++;
    }

    echo '<font color="#008000">' . ADMIN_CLASSE_2 . '</font>';

    echo '</form>';
}

echo '<br>';
echo ADMIN_RENS_9;
$query = 'SELECT id, nom, rang from ' . $xoopsDB->prefix('classe') . '  ORDER by rang';
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
$result = $xoopsDB->queryF($query);

while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    echo "<table  2 border=\"0\" cellpadding=\"2\" cellspacing=\"0\" valign=\"bottom\" align=\"center\"><tr  3><td><b> $row[1] </b></td></tr>";

    $query2 = 'SELECT id, nom, rang, id_classe FROM ' . $xoopsDB->prefix('rens') . "  where id_classe='$row[0]' ORDER by rang";

    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
        echo "<tr>
                <td><input type=\"text\" name=\"rang[]\" value=\"$row[2]\" size=1 maxlength=1> $row[1]</td>
                <input type=\"hidden\" name=\"id[]\" value=\"$row[0]\">
                </tr>";
    }

    echo '<br>';
}
echo '</table><br><input type="hidden" name="action" value="1"> <td colspan=2>
<center><input type="submit" value=' . ENVOI . '></center>';
//echo "<HR>";
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
echo '<br><br>';
xoops_cp_footer();

?>

