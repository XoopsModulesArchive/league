<?

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des xoops_clubs (Fiches clubs), mini-xoops_classement,                     //
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

include "avant.php";
if (!$marqueur == '1') {
    require "../config.php";
    require "../consult/fonctions.php";
}
ENTETE2();
$marqueur = "1";

// Choix du championnat
if (!$champ) {
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h4 align=\"center\">";
    echo ADMIN_TAPVERT_MSG2;
    echo "</h4>";
    echo "<select name=\"champ\" align=\"center\">";
    echo "<option value=\"0\" align=\"center\"> </option>";
    $query  = "SELECT DISTINCT xoops_divisions.nom, xoops_saisons.annee, xoops_championnats.id
           FROM xoops_championnats, xoops_divisions, xoops_saisons, xoops_journees
           WHERE xoops_journees.id_champ=xoops_championnats.id
           AND xoops_championnats.id_division=xoops_divisions.id
           AND xoops_championnats.id_saison=xoops_saisons.id
           ORDER BY xoops_saisons.annee DESC, xoops_championnats.id";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }
    echo "</select>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
} // Choix du club à consulter
elseif (!isset($id_clubs)) {
    echo "<center>";
    $query  = "SELECT xoops_clubs.nom from xoops_clubs, xoops_equipes, xoops_championnats
            WHERE xoops_equipes.id_champ=xoops_championnats.id
            AND xoops_championnats.id='$champ'
            AND xoops_equipes.id_club=xoops_clubs.id";
    $color  = 0;
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe[] = $row[0];
    }

    $query  = "SELECT max(xoops_journees.numero) from xoops_journees, xoops_matchs where xoops_journees.id=xoops_matchs.id_journee and buts_dom is not NULL and xoops_journees.id_champ='$champ'";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $numero      = $row[0] + $a;
        $z           = $a;
        $x           = $z - 1;
        $y           = $z + 1;
        $nb_journees = nb_journees($champ);

        if ($numero < 1 or $numero > $nb_journees) {
            echo CONSULT_CALENDAR_1;
        } else {
            echo "<p>&nbsp</p><div align=\"center\"><center><table border=\"0\" width=\"90%\" cellspacing=\"0\"><tr><td>";
            // On affiche le lien "précédent" seulement si la journée n'est pas la première
            if ($numero > 1) {
                echo "<a href=\"division2.php?champ=$champ&a=$x\">" . CONSULT_CALENDAR_2 . "</a>";
            }

            echo "</td></center><td><p align=\"right\">";
            // On affiche le lien "suivant" si la journée n'est pas la dernière
            if ($numero < $nb_journees) {
                echo "<a href=\"division2.php?champ=$champ&a=$y\">" . CONSULT_CALENDAR_3 . "</a>";
            }
            echo "</td></tr></table></div><br>";

            if ($a > 0) {
                $legende = CONSULT_CALENDAR_4;
            } elseif ($a < 0) {
                $legende = CONSULT_CALENDAR_5;
            } else {
                $legende = CONSULT_CLMNT_MSG6;
            }
            $nb_journees = nb_journees($champ);

            aff_journee($champ, $numero, $legende, 0, $fiches_clubs);
            $bgcolor = "#FFFFFF";

            if (($color % 2) == 0) {
                $bgcolor = "#E5E5E5";
            }
            $color += 1;
        }

        echo "</center>";
    }
}
include "apres.php";
?>
