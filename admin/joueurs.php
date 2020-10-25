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

print ("var message = \"Etes vous sur de vouloir supprimer le renseignement suivant : \";\n");
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
    case 'supp' :
    {
        $xoopsDB->queryF(' delete from ' . $xoopsDB->prefix('joueurs') . " where id='$data' ");
        echo '<font color=green>' . ADMIN_SUPPSAISON_MSG1 . '</font>';
        continue;
    }
    case 'cre':
    {
        $dateFR = date_fr_vers_us($date_naissance);
        $xoopsDB->queryF('insert into ' . $xoopsDB->prefix('joueurs') . " (nom,prenom,id_club,photo,date_naissance,position_terrain) values ('$nom','$prenom','$club','$photo','$dateFR','$position')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());
        echo '<font color=green>' . ADMIN_CRESAISON_MSG1 . '</font>';
        continue;
    }
    default:
    {
    }
}

echo '<h1> ' . ADMIN_JOUEURS_TITRE . "</h1><form action=\"$PHP_SELF\" method=\"GET\">";
echo '<HR>' . ADMIN_JOUEURS_MSG1;
echo '<select name="data">';
echo '<option value="0"> </option>';
$result = $xoopsDB->queryF(
    'select '
    . $xoopsDB->prefix('joueurs')
    . '.id, '
    . $xoopsDB->prefix('joueurs')
    . '.id_club, '
    . $xoopsDB->prefix('joueurs')
    . '.nom, '
    . $xoopsDB->prefix('joueurs')
    . '.prenom,'
    . $xoopsDB->prefix('clubs')
    . '.nom from '
    . $xoopsDB->prefix('joueurs')
    . ','
    . $xoopsDB->prefix('clubs')
    . ' where '
    . $xoopsDB->prefix('joueurs')
    . '.id_club='
    . $xoopsDB->prefix('clubs')
    . '.id ORDER BY '
    . $xoopsDB->prefix('clubs')
    . '.nom,'
    . $xoopsDB->prefix('joueurs')
    . '.prenom, '
    . $xoopsDB->prefix('joueurs')
    . '.nom'
);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    $a = $row[1] + 1;

    echo(" <option value=\"$row[0]\">" . $row[3] . ' ' . $row[2] . " ($row[4])");

    echo("</option>\n>");
}
echo '</select>';

echo '<input type="submit" value='
     . ADMIN_JOUEURS_MSG2
     . ' onClick="return demander_confirmation()"> <input type="hidden" name="go" value="supp"> <input type="hidden" name="table1" value="JOUEURS"> </form><HR>'
     . ADMIN_JOUEURS_MSG3
     . "<form action=\"$PHP_SELF\" method=\"GET\">"
     . ADMIN_JOUEURS_MSG4
     . '<input type="text" size="30" name="prenom"><br>'
     . ADMIN_JOUEURS_MSG5
     . '<input type="text" size="30" name="nom"><br>'
     . ADMIN_JOUEURS_MSG6;

echo '<select name="club">';
echo '<option value="0"> </option>';
$result = $xoopsDB->queryF('select * from ' . $xoopsDB->prefix('clubs') . ' ORDER BY nom');
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    echo(" <option value=\"$row[0]\">" . $row[1]);

    echo("</option>\n>");
}
echo '</select><br>'
     . ADMIN_JOUEURS_MSG7
     . '<input type="text" size="30" name="photo"><br>'
     . ADMIN_JOUEURS_MSG8
     . '<input type="text" length="8" name="date_naissance"><br>'
     . ADMIN_JOUEURS_MSG9
     . '<input size="30" name="position"><br> <br><input type="hidden" name="table1" value="JOUEURS"> <input type="hidden" name="go" value="cre"> <input type="submit" value='
     . ENVOI
     . '> </form>'
     . ADMIN_JOUEURS_MSG10
     . '<br><br>';
xoops_cp_footer();
?>

