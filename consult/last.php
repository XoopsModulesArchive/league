<head>
    <link rel="stylesheet" type="text/css" href="../league.css">
    <?
    require "../config.php";
    require "fonctions.php";

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
    }
    // Nom du champ
    $query2  = "SELECT nom from xoops_divisions, xoops_championnats where id_division=xoops_divisions.id";
    $result2 = ($GLOBALS['xoopsDB']->queryF($query2));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
        $nom = $row[0];
    }

    // SELECTION DES xoops_parametres
    $query  = "select * from xoops_parametres where id_champ='$champ' ";
    $result = ($GLOBALS['xoopsDB']->queryF($query));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    // NOM de EQUIPE FAVORITE a partir de son id
    $result = ($GLOBALS['xoopsDB']->queryF("select nom from xoops_clubs, xoops_equipes where xoops_equipes.id='$id_equipe_fetiche' and xoops_clubs.id=xoops_equipes.id_club"));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }

    $query  = "SELECT max(xoops_journees.numero) from xoops_journees, xoops_matchs where xoops_journees.id=xoops_matchs.id_journee and buts_dom is not NULL and xoops_journees.id_champ='$champ' and (id_equipe_ext='$id_equipe_fetiche' or id_equipe_dom='$id_equipe_fetiche')";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $numero = $row[0];

        $query1 = "SELECT cldom.nom as cldom, clext.nom as clext, xoops_matchs.buts_dom, xoops_matchs.buts_ext , xoops_journees.date_prevue, cldom.id as cliddom, clext.id as clidext
                FROM xoops_equipes as dom, xoops_equipes as ext, xoops_matchs, xoops_journees, xoops_clubs as cldom, xoops_clubs as clext
                WHERE xoops_matchs.id_equipe_dom=dom.id
                        AND xoops_matchs.id_equipe_ext=ext.id
                        AND xoops_journees.id_champ='$champ'
                        AND xoops_journees.numero='$numero'
                        AND dom.id_club=cldom.id
                        AND ext.id_club=clext.id
                        AND xoops_matchs.id_journee=xoops_journees.id
                        AND (xoops_matchs.id_equipe_ext='$id_equipe_fetiche'
                        OR xoops_matchs.id_equipe_dom='$id_equipe_fetiche' )";
        $result = $GLOBALS['xoopsDB']->queryF($query1);
        echo "<TABLE   cellspacing=\"0\" align=\"center\" >";
        $x       = 1;
        $legende = "ème journée de $nom";

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $domproba = $row[2];
            $extproba = $row[3];

            if ($x == 1) {
                $date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$', '\\3/\\2/\\1', $row[4]);
                echo "<TR   ><TH   colspan=5 text-align=\"center\"><b> " . $numero . "" . $legende . " le " . $date . "</b></th></tr>";
            }

            if ($row[0] == $equipe_fetiche) {
                $DebMarqueur1 = "<b>";
                $FinMarqueur1 = "</b>";
            } else {
                $DebMarqueur1 = "";
                $FinMarqueur1 = "";
            }

            if ($row[1] == $equipe_fetiche) {
                $DebMarqueur2 = "<b>";
                $FinMarqueur2 = "</b>";
            } else {
                $DebMarqueur2 = "";
                $FinMarqueur2 = "";
            }

            $bgcolor = "#FFFFFF";

            echo "<TR   bgcolor=$bgcolor width=\"100%\"><TD   align=\"right\" width=\"41%\"><a href=\"club.php?id_clubs=$row[5]&champ=$champ\">"
                 . $DebMarqueur1
                 . $row[0]
                 . $FinMarqueur1
                 . "</a><TD   align=\"center\">"
                 . $domproba
                 . "<TD  >-<TD  >"
                 . $extproba
                 . "<TD   align=\"left\" width=\"41%\"><a href=\"club.php?id_clubs=$row[6]&champ=$champ\">"
                 . $DebMarqueur2
                 . $row[1]
                 . $FinMarqueur2
                 . "</a>";
            $x++;
            $color += 1;
        }
        echo "</table>";
    }
    echo "<br><br>";
    $query  = "SELECT max(xoops_journees.numero) from xoops_journees, xoops_matchs where xoops_journees.id=xoops_matchs.id_journee and buts_dom is not NULL and xoops_journees.id_champ='$champ' and (id_equipe_ext='$id_equipe_fetiche' or id_equipe_dom='$id_equipe_fetiche')";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $numero = $row[0] + 1;

        $query1 = "SELECT cldom.nom as cldom, clext.nom as clext, xoops_matchs.buts_dom, xoops_matchs.buts_ext , xoops_journees.date_prevue, cldom.id as cliddom, clext.id as clidext
                FROM xoops_equipes as dom, xoops_equipes as ext, xoops_matchs, xoops_journees, xoops_clubs as cldom, xoops_clubs as clext
                WHERE xoops_matchs.id_equipe_dom=dom.id
                        AND xoops_matchs.id_equipe_ext=ext.id
                        AND xoops_journees.id_champ='$champ'
                        AND xoops_journees.numero='$numero'
                        AND dom.id_club=cldom.id
                        AND ext.id_club=clext.id
                        AND xoops_matchs.id_journee=xoops_journees.id
                        AND (xoops_matchs.id_equipe_ext='$id_equipe_fetiche'
                        OR xoops_matchs.id_equipe_dom='$id_equipe_fetiche' )";
        $result = $GLOBALS['xoopsDB']->queryF($query1);
        echo "<TABLE   cellspacing=\"0\" align=\"center\" >";
        $x       = 1;
        $legende = "ème journée de $nom";

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $domproba = $row[2];
            $extproba = $row[3];

            if ($x == 1) {
                $date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$', '\\3/\\2/\\1', $row[4]);
                echo "<TR   ><TH   colspan=5 text-align=\"center\"><b> " . $numero . "" . $legende . " le " . $date . "</b></th></tr>";
            }

            if ($row[0] == $equipe_fetiche) {
                $DebMarqueur1 = "<b>";
                $FinMarqueur1 = "</b>";
            } else {
                $DebMarqueur1 = "";
                $FinMarqueur1 = "";
            }

            if ($row[1] == $equipe_fetiche) {
                $DebMarqueur2 = "<b>";
                $FinMarqueur2 = "</b>";
            } else {
                $DebMarqueur2 = "";
                $FinMarqueur2 = "";
            }

            $bgcolor = "#FFFFFF";

            echo "<TR   bgcolor=$bgcolor width=\"100%\"><TD   align=\"right\" width=\"40%\"><a href=\"club.php?id_clubs=$row[5]&champ=$champ\">"
                 . $DebMarqueur1
                 . $row[0]
                 . $FinMarqueur1
                 . "</a><TD   align=\"center\">"
                 . $domproba
                 . "<TD  >-<TD  >"
                 . $extproba
                 . "<TD   align=\"left\" width=\"40%\"><a href=\"club.php?id_clubs=$row[6]&champ=$champ\">"
                 . $DebMarqueur2
                 . $row[1]
                 . $FinMarqueur2
                 . "</a>";
            $x++;
            $color += 1;
        }

        echo "</table>";
    }
    ?>
