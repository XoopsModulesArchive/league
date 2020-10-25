<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;
require '../config.php';
require 'fonctions.php';

switch ($go) {
    case '2' :
    {
        echo '<h1 align=center>';
        echo ADMIN_MATCHS_TITRE;
        echo '</h1>';

        echo "<form action=\"$PHP_SELF\" method=\"GET\"><br><h3>";
        echo ADMIN_MATCHS_MSG2;
        echo '</h3>';
        echo ' <select name="numero">';
        echo '<option value="0"> </option>';
        $query = 'SELECT numero, id FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$champ' ORDER BY numero";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo(" <option value=\"$row[0]\">$row[0]");

            echo("</option>\n>");

            $id_journee = $row[1];
        }

        echo '</select>';
        echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";
        echo '<input type="hidden" name="go" value="3">';
        echo "<input type=\"hidden\" name=\"id_journee\" value=\"$id_journee\">";
        $button = ENVOI;
        echo "<input type=\"submit\" value=$button >";

        echo '</form>';
        continue;
    }
    case '3':
    {
        if (1 == $boucle) {
            $boucle = 0;

            global $xoopsDB, $boucle;

            // recherche de id_journee de la journee miroir si existe

            if ('none' != $miroir) {
                echo $query = 'SELECT id FROM ' . $xoopsDB->prefix('journees') . " WHERE  id_champ='$champ' AND numero='$miroir'";

                $result = $xoopsDB->queryF($query);

                while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
                    $id_journee_miroir = $row[0];
                }

                $query = 'DELETE FROM ' . $xoopsDB->prefix('matchs') . " WHERE id_journee='$id_journee_miroir'";

                $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());
            }

            // effacer les anciennes données

            $x = $numero - 1;

            $query = 'SELECT id FROM ' . $xoopsDB->prefix('journees') . " WHERE  id_champ='$champ' AND numero='$x'";

            $result = $xoopsDB->queryF($query);

            while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
                $id_journee = $row[0];
            }

            $query = 'DELETE FROM ' . $xoopsDB->prefix('matchs') . " WHERE id_journee=$id_journee";

            $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());

            // insertion des nouvelles données

            for ($counter = 0; $counter < ((nb_equipes($champ)) / 2); $counter++) {
                //insertion

                //echo "<br>ALLER=".$id_journee."N°:".$x;

                $GLOBALS['xoopsDB']->queryF('INSERT INTO ' . $xoopsDB->prefix('matchs') . " (id_journee, id_equipe_dom, id_equipe_ext) VALUES ('$id_journee','$id_domicile[$counter]','$id_exterieur[$counter]') ");

                //insertion journée miroir, si existe

                if ('none' != $miroir) {
                    //echo "<br>MIROIR=".$id_journee_miroir."N°:".$miroir;

                    $query = 'INSERT INTO ' . $xoopsDB->prefix('matchs') . " (id_journee, id_equipe_dom, id_equipe_ext) VALUES ('$id_journee_miroir','$id_exterieur[$counter]','$id_domicile[$counter]') ";

                    $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());
                }
            }
        }
        echo '<h3 align=center>';
        echo ADMIN_MATCHS_TITRE;
        echo '</h3><b align=center>';
        echo ADMIN_MATCHS_MSG3;
        echo '<b> ';
        echo ADMIN_JOURNEES_MSG9;
        echo " $numero</b> ";
        //$id_champ=id_champ ($champ);
        $nb_rencontres = (nb_equipes($champ)) / 2;

        // TEST EXISTENCE DE LA JOURNEE DANS LA TABLE matchs

        $query = 'SELECT id FROM ' . $xoopsDB->prefix('journees') . " WHERE  id_champ='$champ' AND numero='$numero'";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
            $id_journee = $row[0];
        }

        echo '<table>';
        echo "<form action=\"$PHPSELF\" method=\"GET\">";
        echo '<TR valign="top"><TD><b>';
        echo DOMICILE;
        echo '</b><TD><b>';
        echo EXTERIEUR;
        echo '</b>';

        for ($counter = $nb_rencontres; $counter > 0; $counter = $counter - 1) { // Nb de rencontres dans la journée
            // saisie des rencontres DOMICILE

            echo '<TR valign="top"><TD>';

            $counter0 = $counter - 1;

            $query = ' SELECT * FROM ' . $xoopsDB->prefix('matchs') . " WHERE id_journee='$id_journee' LIMIT $counter0,1";

            $res1 = $GLOBALS['xoopsDB']->queryF($query);

            while (false !== ($result_res1 = $GLOBALS['xoopsDB']->fetchBoth($res1))) {
                $existant_dom = $result_res1[id_equipe_dom];

                $existant_ext = $result_res1[id_equipe_ext];
            }

            echo '<select name="id_domicile[]">';

            echo "<option value=\"id[$counter]\"$club[$counter]> </option> ";

            $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('clubs') . '.nom, ' . $xoopsDB->prefix('equipes') . '.id FROM ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix('matchs') . ' WHERE ' . $xoopsDB->prefix(
                    'journees'
                ) . ".numero='$numero' AND " . $xoopsDB->prefix('equipes') . ".id_champ='$champ' AND " . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix('equipes') . '.id_club ORDER BY ' . $xoopsDB->prefix('clubs') . '.nom';

            $result = $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());

            while (false !== ($row = $xoopsDB->fetchRow($result))) {
                if ($existant_dom == $row[1]) {
                    echo(" <option value=\"$row[1]\" selected>$row[0]");
                } else {
                    echo(" <option value=\"$row[1]\">$row[0]");
                }

                echo("</option>\n>");
            }

            echo '</select>';

            // saisie des rencontres EXTERIEUR

            echo '<TD>';

            echo '<select name="id_exterieur[]">';

            echo '<option value="0"> </option> ';

            $query = 'SELECT DISTINCT '
                     . $xoopsDB->prefix('clubs')
                     . '.nom, '
                     . $xoopsDB->prefix('equipes')
                     . '.id FROM '
                     . $xoopsDB->prefix('clubs')
                     . ', '
                     . $xoopsDB->prefix('equipes')
                     . ' WHERE '
                     . $xoopsDB->prefix('equipes')
                     . ".id_champ='$champ' AND "
                     . $xoopsDB->prefix('clubs')
                     . '.id='
                     . $xoopsDB->prefix('equipes')
                     . '.id_club ORDER BY '
                     . $xoopsDB->prefix('clubs')
                     . '.nom';

            $result = $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());

            while (false !== ($row = $xoopsDB->fetchRow($result))) {
                if ($existant_ext == $row[1]) {
                    echo(" <option value=\"$row[1]\" selected>$row[0]");
                } else {
                    echo(" <option value=\"$row[1]\">$row[0]");
                }

                echo("</option>\n>");
            }
        }
        echo '</select><TR><TD colspan"=2">';
        echo '</table>';
        //JOURNEE MIROIR ?

        echo '<b>' . JOURNEE_MIROIR . '</b>';
        $miroir = 'none';
        echo ' <select name="miroir">';
        echo "<option value=\"none\" selected>none</option>\n";
        $query = 'SELECT numero, id FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$champ'  ORDER BY numero";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            echo(" <option value=\"$row[0]\">$row[0]");

            echo("</option>\n>");

            $id_journee = $row[1];
        }

        echo '</select>';

        // JOURNEE SUIVANTE

        echo '<HR><h3>';
        echo ADMIN_MATCHS_MSG4;
        echo ' </h3>';
        echo '<select name="numero">';
        $data = ($numero + 1); //designe la journee suivante
        // echo "<option></option>";
        $query = 'SELECT id, date_prevue, numero FROM ' . $xoopsDB->prefix('journees') . " WHERE id_champ='$champ' ";
        $result = $xoopsDB->queryF($query);
        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            // passer à la journee suivante par defaut

            if ($row[2] == $data) {
                echo(" <option selected>$row[2]");
            } else {
                echo(" <option value=\"$row[2]\">$row[2]");
            }

            echo("</option>\n>");
        }

        echo '</select>';

        // VALIDATION DU FORMULAIRE
        echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\">";
        echo "<input type=\"hidden\" name=\"id_champ\" value=\"$id_champ\">";
        echo '<input type="hidden" name="boucle" value="1">';
        echo '<input type="hidden" name="go" value="3">';
        echo "<input type=\"hidden\" name=\"id_journee\" value=\"$id_journee\">";
        $button = ENVOI;
        echo "<input type=\"submit\" value=$button>";
        echo '</form>';
        continue;
    }
    default:
    {
    }
}

echo '<h1 align=center>';
echo ADMIN_MATCHS_TITRE;
echo '</h1>';
// choix du calendrier couple championnat-saison
// choix de la journée à saisir
echo "<form action=\"$PHP_SELF\" method=\"GET\">";
echo '<br><h3>';
echo ADMIN_MATCHS_MSG1;
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
          . $xoopsDB->prefix(
        'journees'
    )
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
$result = $xoopsDB->queryF($query);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    echo("<option value=\"$row[2]\">$row[0] " . SEASON . " $row[1]/" . ($row[1] + 1) . "\n");

    echo("</option>\n>");
}
echo '</select>';
$button = ENVOI;
echo '<input type="hidden" name="go" value="2">';
echo "<input type=\"submit\" value=$button></form><br>";
echo '';

xoops_cp_footer(); ?>


