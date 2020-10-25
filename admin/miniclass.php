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

if (!isset($champmini) and !isset($typemini)) {
    echo '<br><br><table  2 cellspacing="0" align=center>';

    echo '<tr  3><td><b>' . ADMIN_MINI_1 . '</b></td><td> </td></tr><tr><td>';

    echo '<table  4 align="center" width="100%" cellspacing="0" cellpadding="2">';

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<tr><td>' . ADMIN_MINI_2 . '</td>';

    echo '<td><select name="presentationmini">';

    echo '<option value=""></option>';

    echo '<option value="1">' . ADMIN_MINI_22 . '</option>';

    echo '<option value="2">' . ADMIN_MINI_23 . '</option>';

    echo '</select> ';

    $general = GENERAL;

    $domicle = DOMICILE;

    $exterieur = EXTERIEUR;

    $attaque = ATTAQUE;

    $defense = DEFENSE;

    $diff = GOALDIFF;

    $query = 'select id FROM ' . $xoopsDB->prefix('championnats') . '';

    $result = $GLOBALS['xoopsDB']->queryF($query);

    $row = $GLOBALS['xoopsDB']->fetchRow($result);

    $champ = $row[0];

    echo "<a href=\"#\" onClick=\"window.open('../consult/miniseul.php?typemini=$general&champmini=$row[0]&nb_dessusmini=2&nb_dessousmini=2&presentationmini=1&lienmini=oui','Mini','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=450');\">"
         . ADMIN_MINI_12
         . ' ('
         . ADMIN_MINI_22
         . ')</a> ';

    echo "<a href=\"#\" onClick=\"window.open('../consult/miniseul.php?typemini=$general&champmini=$row[0]&nb_dessusmini=2&nb_dessousmini=2&presentationmini=2&lienmini=oui','Mini','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=450');\">"
         . ADMIN_MINI_12
         . ' ('
         . ADMIN_MINI_23
         . ')</a>';

    $champ = $row[0];

    echo '</td></tr>';

    echo '<tr><td width="50%">' . ADMIN_MINI_3 . '</td><td width="50%"><select name="typemini">';

    echo '<option value=""></option>';

    echo "<option value=\"$general\">" . GENERAL . '</option>';

    echo "<option value=\"$domicle\">" . DOMICILE . '</option>';

    echo "<option value=\"$exterieur\">" . EXTERIEUR . '</option>';

    echo "<option value=\"$attaque\">" . ATTAQUE . '</option>';

    echo "<option value=\"$defense\">" . DEFENSE . '</option>';

    echo "<option value=\"$diff\">" . GOALDIFF . '</option>';

    echo '</select></td></tr>';

    echo '<tr><td>' . ADMIN_MINI_4 . '</td><td><select name="champmini">';

    echo '<option value="" align="center"> </option>';

    $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee, ' . $xoopsDB->prefix('championnats') . '.id
FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('journees') . '
WHERE ' . $xoopsDB->prefix('journees') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id 
AND ' . $xoopsDB->prefix('championnats') . '.id_division=' . $xoopsDB->prefix('divisions') . '.id 
AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix('saisons') . '.id 
ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id';

    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select></td></tr>';

    echo '<tr><td>' . ADMIN_MINI_15 . '</td>';

    echo '<td>';

    echo '<input type="radio" value="oui" checked name="lienmini">' . ADMIN_RENS_17 . ' ';

    echo '<input type="radio" value="non" name="lienmini">' . ADMIN_RENS_18 . ' </td></tr>';

    echo '<tr><td>' . ADMIN_MINI_16 . '</td>';

    echo '<td><input type="text" name="cheminmini" size="50"></td></tr>';

    echo '<tr bgcolor="#CCCCCC">';

    echo '<td><input type="radio" value="0" checked name="classmini">' . ADMIN_MINI_17 . '</td><td></td></tr>';

    echo '<tr bgcolor="#CCCCCC"><td>' . ADMIN_MINI_5 . '</td>';

    echo '<td><input type="text" name="nb_dessusmini" size=2 maxlength=2></td></tr>';

    echo '<tr bgcolor="#CCCCCC"><td>' . ADMIN_MINI_14 . '</td>';

    echo '<td><input type="text" name="nb_dessousmini" size=2 maxlength=2></td></tr>';

    echo '<tr bgcolor="#ADADAD">';

    echo '<td><input type="radio" value="1" name="classmini">' . ADMIN_MINI_18 . ' ';

    echo "<a href=\"#\" onClick=\"window.open('../consult/miniseul.php?typemini=$general&champmini=$champ&presentationmini=1&nb_dessousmini=0&nb_dessusmini=0&classmini=1&lienmini=oui','Mini','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=450');\">"
         . ADMIN_MINI_12
         . ' ('
         . ADMIN_MINI_22
         . ')</a> ';

    echo "<a href=\"#\" onClick=\"window.open('../consult/miniseul.php?typemini=$general&champmini=$champ&presentationmini=2&nb_dessousmini=0&nb_dessusmini=0&classmini=1&lienmini=oui','Mini','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=450');\">"
         . ADMIN_MINI_12
         . ' ('
         . ADMIN_MINI_23
         . ')</a> ';

    echo '</td><td></td></tr>';

    $button = ADMIN_MINI_6;

    echo "</table><br><br><center><input type=\"submit\" value=\"$button\" ></center>";

    echo '</form></table>';
} else {
    echo '<br><br><table  2 align="center"><tr><td><table  4 align="center">';

    $champ1 = '$' . 'champmini';

    $type1 = '$' . 'typemini';

    $nb_dessus1 = '$' . 'nb_dessusmini';

    $nb_dessous1 = '$' . 'nb_dessousmini';

    $presentation1 = '$' . 'presentationmini';

    $lien1 = '$' . 'lienmini';

    $chemin1 = '$' . 'cheminmini';

    $class1 = '$' . 'classmini';

    echo '<tr><td>' . ADMIN_MINI_13 . '</td>';

    echo '<td><textarea disabled name="code_ajouter" rows="11" cols="50">';

    echo '&lt;?php';

    echo "\n$champ1=&quot;$champmini&quot;;";

    echo "\n$type1=&quot;$typemini&quot;;";

    if (1 == !$classmini) {
        echo "\n$nb_dessus1=&quot;$nb_dessusmini&quot;;";

        echo "\n$nb_dessous1=&quot;$nb_dessousmini&quot;;";
    }

    echo "\n$presentation1=&quot;$presentationmini&quot;;";

    echo "\n$lien1=&quot;$lienmini&quot;;";

    echo "\n$class1=&quot;$classmini&quot;;";

    echo "\n$chemin1=&quot;$cheminmini&quot;;";

    echo "\ninclude (&quot;" . $cheminmini . '/miniseul.php&quot;);';

    echo "\n?&gt;";

    echo '</textarea></td>';

    echo '<td>';

    echo "<a href=\"#\" onClick=\"window.open('../consult/miniseul.php?typemini=$typemini&champmini=$champmini&nb_dessusmini=$nb_dessusmini&nb_dessousmini=$nb_dessousmini&presentationmini=$presentationmini&lienmini=$lienmini&classmini=$classmini&cheminmini=$cheminmini','Mini','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=500');\">"
         . ADMIN_MINI_12
         . '</a> ';

    echo '</td></tr>';

    echo '<td>' . ADMIN_MINI_7 . '</td><td>';

    if ('' == $champmini) {
        echo ADMIN_MINI_8;
    }

    if ('' == $typemini) {
        echo '<br>' . ADMIN_MINI_9;
    }

    if ('' == $presentationmini) {
        echo '<br>' . ADMIN_MINI_10;
    }

    if ('1' == !$classmini and '' == $nb_dessusmini) {
        echo '<br>' . ADMIN_MINI_19 . '';
    }

    if ('1' == !$classmini and '' == $nb_dessousmini) {
        echo '<br>' . ADMIN_MINI_20 . '';
    }

    if ('' == $champmini or '' == $typemini or '' == $presentationmini) {
        echo '<br>' . ADMIN_MINI_11;
    } else {
        echo ADMIN_MINI_21;
    }

    echo '</td></tr></table>';

    echo '</tr></td></table>';
}
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
xoops_cp_footer();
?>

